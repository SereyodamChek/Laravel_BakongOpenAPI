<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    private function products()
    {
        return [
            [
                'id' => 1,
                'name' => 'KDMV ',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/6.2_b5325f61-f6b8-473e-a38d-48ff808cdc14.jpg?v=1749629132&width=360', // Updated to cyber watch style
                'description' => 'Immersive audio with glowing neon accents and noise-cancellation from the future.'
            ],
            [
                'id' => 2,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/7.2_9da51afa-b18c-49a0-8ba8-9c133568f539.jpg?v=1749629059&width=533',
                'description' => 'Holo-display, AI assistant, and biometric tracking in one sleek wrist device.'
            ],
            [
                'id' => 3,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/blackshirtpinkgraphic.png?v=1764256786&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
             [
                'id' => 4,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/Group5.png?v=1755081180&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
             [
                'id' => 5,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/Untitled-4.png?v=1743995015&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
             [
                'id' => 6,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/1.1_5e6bcf05-cb92-4528-90e0-1c793d85ea13.jpg?v=1749629495&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
             [
                'id' => 7,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/kdmhlongsleeveyellowprint.png?v=1764869221&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
             [
                'id' => 8,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/kdmhlongsleeveyellowprint.png?v=1764869221&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
             [
                'id' => 9,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/kdmhlongsleeveyellowprint.png?v=1764869221&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
             [
                'id' => 10,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/asdfdsaff.png?v=1751779568&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
             [
                'id' => 11,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/asdfdsafdfdf.png?v=1751779526&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
             [
                'id' => 12,
                'name' => 'KDMV',
                'price' => 0.01,
                'image' => 'https://kdmv.io/cdn/shop/files/asdfadsfdsfads.png?v=1751779257&width=533',
                'description' => 'Self-adjusting fit, LED reactive soles, built for night runs in the neon city.'
            ],
        ];
    }

    public function index()
    {
        return view('home', ['products' => $this->products()]);
    }

    public function detail($id)
    {
        $product = collect($this->products())->firstWhere('id', (int)$id);
        if (!$product) abort(404);
        return view('product.detail', compact('product'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = collect($this->products())->firstWhere('id', (int)$id);
        if (!$product) abort(404);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = $product;
            $cart[$id]['quantity'] = 1; // explicitly set
        }

        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function increase(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $request->session()->put('cart', $cart);
        }
        return redirect()->route('cart');
    }

    public function decrease(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } elseif (isset($cart[$id]) && $cart[$id]['quantity'] == 1) {
            unset($cart[$id]); // Remove if qty becomes 0
        }
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    public function removeFromCart(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$id]);
        $request->session()->put('cart', $cart);
        return redirect()->route('cart');
    }

    public function cart(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        // Fix old items without quantity
        foreach ($cart as $id => &$item) {
            if (!isset($item['quantity'])) {
                $item['quantity'] = 1;
            }
        }
        unset($item); // break reference

        $request->session()->put('cart', $cart);

        $cartProducts = collect($cart);
        $cartTotal = $cartProducts->sum(fn($item) => $item['price'] * ($item['quantity'] ?? 1));

        return view('cart', compact('cartProducts', 'cartTotal'));
    }

    public function checkout(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart');

        $cartProducts = collect($cart);
        $cartTotal = $cartProducts->sum('price');

        return view('checkout', compact('cartProducts', 'cartTotal'));
    }
}