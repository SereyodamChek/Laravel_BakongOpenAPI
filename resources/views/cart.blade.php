@extends('layouts.app')

@section('title', 'Cart')
@section('body-class', 'cart-page')

@section('content')
    <section style="padding:2rem 0 5rem; background:linear-gradient(135deg, #f5f7fb 0%, #ffffff 100%);">
        <div class="container">
            <!-- Header -->
            <div style="margin-bottom:3.0rem;">
                <h1
                    style="font-size:2.5rem; font-weight:700; margin-bottom:0.5rem; letter-spacing:-0.8px; background:linear-gradient(135deg, #0f172a, #4f46e5); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">
                    Shopping Cart
                </h1>
                <p style="color:#64748b; font-size:1rem; margin:0;">Curated items ready for checkout</p>
            </div>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="cart-grid" style="display:grid; grid-template-columns:1.8fr 1.1fr; gap:2.5rem; align-items:start;">
                    <!-- Products List -->
                    <div>
                        <div class="card"
                            style="padding:0; border:1px solid rgba(15, 23, 42, 0.08); border-radius:20px; overflow:hidden; box-shadow:0 10px 40px rgba(0, 0, 0, 0.06);">
                            @foreach($cartProducts as $index => $item)
                                <div class="cart-item"
                                    style="display:flex; align-items:center; gap:1.75rem; padding:2rem; {{ $index > 0 ? 'border-top:1px solid rgba(15, 23, 42, 0.06);' : '' }} transition:all 0.3s ease; position:relative;">
                                    <!-- Product Image -->
                                    <div class="product-thumb"
                                        style="border-radius:16px; overflow:hidden; width:120px; height:120px; flex-shrink:0; background:linear-gradient(135deg, #f5f7fb, #ffffff); box-shadow:0 8px 25px rgba(0, 0, 0, 0.08); position:relative;">
                                        <img src="{{ $item['image'] }}"
                                            style="width:100%; height:100%; object-fit:cover; display:block; transition:transform 0.3s ease;">
                                    </div>

                                    <!-- Product Info -->
                                    <div class="product-info" style="flex:1; min-width:0;">
                                        <h3
                                            style="font-size:1.1rem; font-weight:600; margin:0 0 0.75rem 0; letter-spacing:-0.3px; color:#0f172a;">
                                            {{ $item['name'] }}</h3>
                                        <p style="color:#64748b; font-size:0.875rem; margin:0 0 1.25rem 0; line-height:1.5;">Premium
                                            quality product</p>

                                        <!-- Quantity Controls -->
                                        <div
                                            style="display:flex; align-items:center; gap:0.75rem; border:1px solid #e2e8f0; border-radius:12px; overflow:hidden; width:fit-content; background:#ffffff;">
                                            <form action="{{ route('cart.decrease', $item['id']) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit"
                                                    style="padding:0.6rem 1rem; background:none; border:none; font-size:1.1rem; cursor:pointer; color:#64748b; transition:all 0.2s ease; font-weight:600;">−</button>
                                            </form>
                                            <input type="text" value="{{ $item['quantity'] }}" readonly
                                                style="width:50px; text-align:center; border:none; background:transparent; font-weight:700; padding:0.6rem 0; color:#0f172a; font-size:1rem;">
                                            <form action="{{ route('cart.increase', $item['id']) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit"
                                                    style="padding:0.6rem 1rem; background:none; border:none; font-size:1.1rem; cursor:pointer; color:#4f46e5; transition:all 0.2s ease; font-weight:600;">+</button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Price & Remove -->
                                    <div class="product-price"
                                        style="text-align:right; display:flex; flex-direction:column; align-items:flex-end; gap:1.5rem;">
                                        <p
                                            style="font-size:1.5rem; font-weight:700; padding:0; letter-spacing:-0.4px; color:#0f172a;">
                                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                        </p>
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                style="background:rgba(239, 68, 68, 0.1); border:none; color:#ef4444; font-weight:600; font-size:1.3rem; padding:0.5rem 0.75rem; cursor:pointer; transition:all 0.2s ease; border-radius:8px; display:flex; align-items:center; justify-content:center; width:40px; height:40px;"
                                                onmouseover="this.style.background='rgba(239, 68, 68, 0.2)'"
                                                onmouseout="this.style.background='rgba(239, 68, 68, 0.1)'">
                                                <i class="fa-solid fa-delete-left"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary" style="position:sticky; top:140px;">
                        <div class="card"
                            style="border:1px solid rgba(15, 23, 42, 0.08); border-radius:20px; padding:2rem; box-shadow:0 10px 40px rgba(0, 0, 0, 0.06); background:linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                            <h2
                                style="font-size:1.35rem; font-weight:700; margin:0 0 2rem 0; letter-spacing:-0.4px; color:#0f172a;">
                                Order Summary</h2>

                            <!-- Summary Lines -->
                            <div style="margin-bottom:2rem; space:1.5rem 0;">
                                <div
                                    style="display:flex; justify-content:space-between; margin-bottom:1rem; padding-bottom:1rem; border-bottom:1px solid rgba(15, 23, 42, 0.06);">
                                    <span style="color:#64748b; font-size:0.95rem; font-weight:500;">Subtotal</span>
                                    <span style="color:#0f172a; font-weight:600;">${{ number_format($cartTotal, 2) }}</span>
                                </div>
                                <div
                                    style="display:flex; justify-content:space-between; margin-bottom:1rem; padding-bottom:1rem; border-bottom:1px solid rgba(15, 23, 42, 0.06);">
                                    <span style="color:#64748b; font-size:0.95rem; font-weight:500;">Shipping</span>
                                    <span style="color:#4f46e5; font-weight:700; font-size:0.95rem;">Free</span>
                                </div>
                                <div style="display:flex; justify-content:space-between;">
                                    <span style="color:#64748b; font-size:0.95rem; font-weight:500;">Tax</span>
                                    <span style="color:#0f172a; font-weight:600;">$0.00</span>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="total-block"
                                style="padding:1.5rem; background:linear-gradient(135deg, #f0f4ff, #f8fafc); border-radius:14px; margin-bottom:1.75rem; border:1px solid rgba(79, 70, 229, 0.15);">
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span class="label" style="font-size:1rem; font-weight:600; color:#64748b;">Total Amount</span>
                                    <span class="total-value" style="font-size:2rem; font-weight:800; letter-spacing:-0.6px; color:#0f172a;">
                                        ${{ number_format($cartTotal, 2) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <a href="{{ route('checkout') }}"
   class="checkout-btn"
   style="
        display:block;
        width:100%; 
        padding:14px 18px;
        text-align:center;
        background:linear-gradient(135deg, #4f46e5 0%, #2563eb 100%);
        color:#ffffff;
        font-weight:700;
        font-size:0.95rem;
        letter-spacing:-0.2px;
        border-radius:10px;
        text-decoration:none;
        box-shadow:0 8px 22px rgba(79,70,229,0.28);
        transition:transform 0.15s ease, box-shadow 0.15s ease, filter 0.15s ease;
   "
   onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 12px 28px rgba(79,70,229,0.35)';"
   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 22px rgba(79,70,229,0.28)';"
   onmousedown="this.style.transform='translateY(0) scale(0.98)';"
>
    Proceed to Checkout
</a>
<div style="height: 18px;x;"></div>
<!-- Payment Logos -->
<div style="
    display:flex;
    justify-content:center;
    align-items:center;
    gap:6px;
">
    <img src="{{ asset('KHQR.png') }}"
         alt="KHQR Payment"
         style="width:55px; height:auto; display:block;" />

    <img src="{{ asset('ABA.png') }}"
         alt="ABA Bank"
         style="width:40px; height:auto; display:block;" />
</div>

</div>

            @else
                <div class="card"
                    style="text-align:center; padding:4rem 2rem; border-radius:20px; background:linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); box-shadow:0 10px 40px rgba(0, 0, 0, 0.06); border:1px solid rgba(15, 23, 42, 0.08);">
                    <div style="font-size:4rem; margin-bottom:1.5rem; opacity:0.4;">🛒</div>
                    <h2
                        style="font-size:1.75rem; font-weight:700; margin-bottom:0.75rem; letter-spacing:-0.5px; color:#0f172a;">
                        Your cart is empty</h2>
                    <p style="font-size:1rem; color:#64748b; margin-bottom:2.5rem; line-height:1.6;">Explore our premium
                        collection and start shopping</p>
                    <a href="{{ route('home') }}" class="btn-primary"
                        style="padding:1.1rem 2.5rem; background:linear-gradient(135deg, #4f46e5, #2563eb); font-weight:700; font-size:0.95rem; letter-spacing:-0.3px; border-radius:12px; display:inline-block; transition:all 0.3s ease;">
                        Browse Products
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection 