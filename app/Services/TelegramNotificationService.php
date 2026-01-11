<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramNotificationService
{
    protected string $botToken;
    protected string $chatId;

    public function __construct()
    {
        $this->botToken = config('services.telegram.bot_token', env('TELEGRAM_BOT_TOKEN'));
        $this->chatId   = config('services.telegram.chat_id', env('TELEGRAM_ADMIN_CHAT_ID'));
    }

    public function sendOrderNotification(array $data): void
    {
        if (!$this->botToken || !$this->chatId) {
            Log::warning('Telegram notification skipped: missing config');
            return;
        }

        $message = $this->buildMessage($data);

        try {
            Http::withOptions([
                'verify' => false // 🔴 Disable SSL check (LOCAL ONLY)
            ])->post("https://api.telegram.org/bot{$this->botToken}/sendMessage", [
                'chat_id'    => $this->chatId,
                'text'       => $message,
                'parse_mode' => 'Markdown',
            ]);
            Log::info('Telegram order notification sent');
        } catch (\Exception $e) {
            Log::error('Telegram notification failed: ' . $e->getMessage());
        }
    }

    private function buildMessage(array $data): string
    {
        $items = $data['items'] ?? [];
        $total = number_format($data['total'], 2);

        $from = $data['paid_from_account'] ?? 'Unknown';
        $to   = $data['paid_to_account'] ?? 'Not specified';

        $message = "*🔔 New Order Received!*\n\n";
        $message .= "*Order Items*\n";

        foreach ($items as $item) {
            $itemTotal = number_format($item['price'] * $item['quantity'], 2);
            $message .= "• {$item['quantity']} × {$item['name']} — \${$itemTotal}\n";
        }

        $message .= "\n*Total Amount*: \${$total}\n\n";

        $message .= "*Payment Details*\n";
        $message .= "Paid via *Bakong KHQR*\n";
        $message .= "From: `{$from}`\n";
        $message .= "To: `{$to}`\n";
        $message .= "Date: {$data['date']}\n\n";

        $message .= "*Customer Information*\n";
        $message .= "Name: {$data['customer_name']}\n";
        $message .= "Email: {$data['email']}\n";
        if (!empty($data['phone'])) {
            $message .= "Phone: {$data['phone']}\n";
        }
        $message .= "Address: {$data['address']}\n\n";

        // Simple reference
        $ref = strtoupper(substr(md5($data['date'] . $data['customer_name']), 0, 8));
        $message .= "*Order Reference*: `{$ref}`";

        $message .= "\nwww.dsdigitalservice.com";

        return $message;
    }
}