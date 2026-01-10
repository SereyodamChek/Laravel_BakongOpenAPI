@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section class="hero"
    style="
        position:relative;
        overflow:hidden;
        text-align:center;
        padding:7rem 1rem 6rem;
        background:
            radial-gradient(60% 40% at 50% 0%, rgba(99,102,241,0.18), transparent 60%),
            radial-gradient(40% 30% at 80% 20%, rgba(236,72,153,0.15), transparent 60%),
            linear-gradient(180deg, #ffffff, #f8fafc);
        color:#0f172a;
    ">

    <!-- Floating light blobs -->
    <div style="position:absolute; inset:0; pointer-events:none;">
        <div style="
            position:absolute;
            width:420px;
            height:420px;
            background:radial-gradient(circle, rgba(99,102,241,0.35), transparent 70%);
            top:-140px;
            left:50%;
            transform:translateX(-50%);
            filter:blur(90px);
            animation:floatGlow 9s ease-in-out infinite;
        "></div>

        <div style="
            position:absolute;
            width:300px;
            height:300px;
            background:radial-gradient(circle, rgba(236,72,153,0.28), transparent 70%);
            bottom:-120px;
            right:10%;
            filter:blur(80px);
            animation:floatGlow 11s ease-in-out infinite reverse;
        "></div>
    </div>

    <div class="container" style="position:relative; z-index:2;">

        <!-- Headline -->
        <h1 style="
            font-size:clamp(2.8rem, 6vw, 3.8rem);
            font-weight:800;
            line-height:1.05;
            letter-spacing:-1.5px;
            margin-bottom:1.25rem;
            opacity:0;
            transform:translateY(30px);
            animation:fadeUp 1s ease forwards;
        ">
            Premium tech
            <span style="
                background:linear-gradient(90deg, #6366f1, #ec4899);
                -webkit-background-clip:text;
                -webkit-text-fill-color:transparent;
            ">
                for modern living
            </span>
        </h1>

        <!-- Subtext -->
        <p style="
            font-size:1.15rem;
            max-width:560px;
            margin:0 auto 3rem;
            line-height:1.7;
            color:#475569;
            opacity:0;
            transform:translateY(30px);
            animation:fadeUp 1s ease forwards;
            animation-delay:.2s;
        ">
            Discover carefully curated technology that seamlessly fits your lifestyle.
        </p>

        <!-- CTA -->
  <a href="#products" class="premium-btn">
    Browse Collection →
</a>

<style>
.premium-btn {
    display:inline-flex;
    align-items:center;
    gap:.6rem;
    padding:1rem 2.5rem;
    font-size:1rem;
    font-weight:600;
    color:white;
    border-radius:999px;
    text-decoration:none;

    /* Gradient setup */
    background:linear-gradient(
        120deg,
        #6366f1,
        #8b5cf6,
        #ec4899
    );
    background-size:200% 200%;

    box-shadow:
        0 12px 30px rgba(99,102,241,0.35),
        inset 0 1px 0 rgba(255,255,255,0.35);

    transition:
        transform .35s cubic-bezier(.4,0,.2,1),
        box-shadow .35s ease,
        background-position .8s ease;
}

/* Hover magic */
.premium-btn:hover {
    background-position:100% 50%;
    transform:translateY(-3px) scale(1.04);
    box-shadow:
        0 18px 45px rgba(236,72,153,0.45),
        inset 0 1px 0 rgba(255,255,255,0.45);
}

/* Pressed */
.premium-btn:active {
    transform:translateY(-1px) scale(1.01);
}
</style>

    </div>

    <!-- Animations -->
    <style>
        @keyframes fadeUp {
            to {
                opacity:1;
                transform:translateY(0);
            }
        }

        @keyframes floatGlow {
            0%, 100% {
                transform:translate(-50%, 0) scale(1);
            }
            50% {
                transform:translate(-50%, -22px) scale(1.06);
            }
        }
    </style>
</section>



<section id="products" style="padding:4rem 0 6rem;">
    <div class="container">
        <div style="margin-bottom:3rem;">
            <h2 style="font-size:2rem; font-weight:600; margin-bottom:0.5rem; letter-spacing:-0.5px;">
                Featured Products
            </h2>
            <p style="color:var(--text-muted); font-size:0.9375rem;">Handpicked items for you</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:1.5rem;">
            @foreach($products as $product)
            <div class="card" style="padding:0; overflow:hidden;">
                <div style="position:relative; background:var(--bg); overflow:hidden;">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" style="width:100%; height:280px; object-fit:cover; display:block;">
                </div>
                <div style="padding:1.5rem;">
                    <h3 style="font-size:1.125rem; font-weight:600; margin:0 0 0.5rem 0; letter-spacing:-0.3px;">{{ $product['name'] }}</h3>
                    <p style="color:var(--text-muted); font-size:0.875rem; margin-bottom:1.25rem; line-height:1.5;">{{ $product['description'] }}</p>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-size:1.5rem; font-weight:600; letter-spacing:-0.5px;">${{ number_format($product['price'], 2) }}</span>
                        <div style="display:flex; gap:0.5rem;">
                            <a href="{{ route('product.detail', $product['id']) }}" style="padding:0.5rem 1rem; font-size:0.875rem; color:var(--text-muted); background:var(--bg); border:1px solid var(--border); border-radius:8px; text-decoration:none; font-weight:500; transition:all 0.2s ease;" onmouseover="this.style.borderColor='var(--text)'; this.style.color='var(--text)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--text-muted)'">
                                View
                            </a>
                            <form action="{{ route('cart.add', $product['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-primary" style="padding:0.75rem 1rem; font-size:0.875rem;">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection