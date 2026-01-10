@extends('layouts.app')

@section('title', $product['name'])

@section('content')
<section style="padding:4rem 0 6rem;">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:start;">
            <div style="position:sticky; top:140px;">
                <div style="border-radius:16px; overflow:hidden; background:var(--bg); border:1px solid var(--border);">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" style="width:100%; display:block;">
                </div>
            </div>
            <div>
                <h1 style="font-size:2.5rem; font-weight:600; margin-bottom:1rem; line-height:1.2; letter-spacing:-1px;">
                    {{ $product['name'] }}
                </h1>
                <p style="font-size:1rem; color:var(--text-muted); line-height:1.7; margin-bottom:2rem;">
                    {{ $product['description'] }}
                </p>
                <div style="background:var(--bg); border:1px solid var(--border); border-radius:12px; padding:1.5rem; margin-bottom:2rem;">
                    <p style="font-size:0.9375rem; color:var(--text-muted); line-height:1.7; margin:0;">
                        Cutting-edge technology meets thoughtful design. Engineered for the modern user who values both performance and aesthetics. Experience innovation that enhances your daily life.
                    </p>
                </div>
                <div style="display:flex; align-items:baseline; gap:1rem; margin-bottom:2rem;">
                    <span style="font-size:2.5rem; font-weight:600; letter-spacing:-1px;">
                        ${{ number_format($product['price'], 2) }}
                    </span>
                </div>
                <div style="background:var(--bg); border:1px solid var(--border); border-radius:12px; padding:1.25rem; margin-bottom:2rem;">
                    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:1rem; font-size:0.8125rem; color:var(--text-muted);">
                        <div>✓ Free shipping</div>
                        <div>✓ 2-year warranty</div>
                        <div>✓ 30-day returns</div>
                    </div>
                </div>
                <form action="{{ route('cart.add', $product['id']) }}" method="POST" style="margin-bottom:1.5rem;">
                    @csrf
                    <button type="submit" class="btn-primary" style="padding:1rem 2rem; font-size:1rem; width:100%;">
                        Add to Cart
                    </button>
                </form>
                <a href="{{ route('home') }}" style="display:inline-flex; align-items:center; gap:0.375rem; color:var(--text-muted); text-decoration:none; font-size:0.9375rem; font-weight:500; transition:color 0.2s ease;" onmouseover="this.style.color='var(--text)'" onmouseout="this.style.color='var(--text-muted)'">
                    <span>←</span> <span>Back to Products</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection