<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use KHQR\BakongKHQR;
use KHQR\Models\IndividualInfo;
use KHQR\Helpers\KHQRData;

class KHQRController extends Controller
{
    /**
     * CREATE KHQR
     */
    public function create(Request $request)
    {
        try {
            Log::info('▶️ KHQR CREATE: request received');

            $request->validate([
                'amount' => 'required|numeric|min:0.01',
            ]);

            $rawAmount = (float) $request->amount;
            $amount = round($rawAmount, 2);

            Log::info('💰 Raw amount', ['raw' => $rawAmount]);
            Log::info('💰 Normalized amount', ['amount' => $amount]);

            $individualInfo = new IndividualInfo(
                bakongAccountID: env('BAKONG_ACCOUNT'),
                merchantName: 'Dsdigital Service',
                merchantCity: 'Phnom Penh',
                currency: KHQRData::CURRENCY_USD,
                amount: $amount
            );

            Log::info('⚙️ Generating KHQR...');

            $result = BakongKHQR::generateIndividual($individualInfo);

            Log::info('📤 KHQR RAW RESULT', json_decode(json_encode($result), true));

            if (!isset($result->data['qr'], $result->data['md5'])) {
                Log::error('❌ KHQR returned no data');
                return response()->json(['error' => 'KHQR returned no data'], 500);
            }

            Log::info('✅ KHQR generated successfully', [
                'md5' => $result->data['md5'],
            ]);

            return response()->json([
                'qr'  => $result->data['qr'],
                'md5' => $result->data['md5'],
            ]);

        } catch (\Throwable $e) {
            Log::error('🔥 KHQR CREATE ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['error' => 'Server error'], 500);
        }
    }

    /**
     * CHECK PAYMENT (RAW BAKONG API — SAME AS NEXT.JS)
     */
    public function check(Request $request)
    {
        $request->validate([
            'md5' => 'required|string',
        ]);

        $md5 = $request->query('md5');
        $token = env('BAKONG_TOKEN');

        try {
            Log::info('▶️ BAKONG CHECK START');
            Log::info('🔐 MD5', ['md5' => $md5]);
            Log::info('🔑 TOKEN EXISTS', ['exists' => !empty($token)]);

            $response = Http::withOptions([
                'verify' => false, // 🔴 Disable SSL check (LOCAL ONLY)
            ])->withHeaders([
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
            ])->post(
                'https://api-bakong.nbc.gov.kh/v1/check_transaction_by_md5',
                ['md5' => $md5]
            );

            if (!$response->successful()) {
                Log::error('❌ BAKONG HTTP ERROR', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'paid' => false,
                    'error' => 'Bakong API error',
                ], 500);
            }

            $result = $response->json();

            Log::info('📥 RAW BAKONG RESPONSE', $result);

            $responseCode = $result['responseCode'] ?? null;
            $errorCode    = $result['errorCode'] ?? null;

            Log::info('📊 BAKONG STATUS', [
                'responseCode' => $responseCode,
                'errorCode'    => $errorCode,
            ]);

            /**
             * ✅ PAYMENT SUCCESS
             */
            if ($responseCode === 0 && !empty($result['data'])) {
                Log::info('✅ PAYMENT SUCCESS', $result['data']);

                session()->forget('cart');

                $bakongData = $result['data'];

                return response()->json([
                    'paid' => true,
                    'fromAccountId' => $bakongData['fromAccountId'] ?? 'Unknown',
                    'toAccountId'   => $bakongData['toAccountId'] ?? env('BAKONG_ACCOUNT', 'chhinchheang_dara@wing'),
                    'amount'       => $bakongData['amount'] ?? null,
                    'currency'     => $bakongData['currency'] ?? 'USD',
                    'hash'         => $bakongData['hash'] ?? null,
                    'md5'          => $md5,
                ]);
            }

            /**
             * ❌ PAYMENT FAILED (cancelled / rejected)
             */
            if ($responseCode === 1 && $errorCode === 3) {
                Log::warning('❌ PAYMENT FAILED', $result);

                return response()->json([
                    'paid' => false,
                    'failed' => true,
                    'message' => 'Payment failed',
                    'data' => $result,
                ]);
            }

            /**
             * ⏳ PENDING
             */
            Log::info('⏳ PAYMENT PENDING');

            return response()->json([
                'paid' => false,
                'pending' => true,
                'md5' => $md5,
            ]);

        } catch (\Throwable $e) {
            Log::error('🔥 BAKONG CHECK ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['error' => 'Verification failed'], 500);
        }
    }
}
