<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FutureStore - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

   <style>
/* ===============================
   PREMIUM DESIGN SYSTEM
================================ */
:root {
    --bg: #f5f7fb;
    --bg-secondary: #ffffff;
    --glass: rgba(255, 255, 255, 0.75);

    --text: #0f172a;
    --text-muted: #64748b;

    --border: rgba(15, 23, 42, 0.08);

    --accent: linear-gradient(135deg, #2563eb, #4f46e5);
    --accent-solid: #4f46e5;
    --accent-hover: #4338ca;

    --radius-sm: 10px;
    --radius-md: 14px;
    --radius-lg: 20px;

    --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.04);
    --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 20px 50px rgba(0, 0, 0, 0.12);
}

/* ===============================
   RESET
================================ */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

/* ===============================
   BASE
================================ */
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: radial-gradient(
        circle at top,
        #ffffff 0%,
        var(--bg) 45%
    );
    color: var(--text);
    line-height: 1.6;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    -webkit-font-smoothing: antialiased;
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.75rem;
}

/* Make header container match home page width/padding for consistent navbar sizing */
.container.header-content {
    max-width: 1100px;
    padding: 0 1.5rem;
}

/* ===============================
   HEADER (GLASS EFFECT)
================================ */
header {
    position: sticky;
    top: 0;
    z-index: 100;
    background: var(--glass);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--border);
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem 0;
}

/* Ensure logo container centers its image vertically */
.logo {
    display: flex;
    align-items: center;
}

/* Make header-content positioned so centered nav can be absolute */
.header-content { position: relative; }

/* Per-page logo nudge for cart page */
.cart-page .logo img {
    transform: translateX(14px);
}

@media (max-width: 420px) {
    .cart-page .logo img {
        transform: translateX(6px);
    }
}

.logo img {
    height: 78px;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.logo:hover img {
    transform: scale(1.04);
    opacity: 0.85;
}

/* ===============================
   NAVIGATION
================================ */
nav {
    display: flex;
    align-items: center;
    gap: 2.25rem;
    margin-left: auto; /* push nav to the right */
}

nav a {
    position: relative;
    text-decoration: none;
    color: var(--text-muted);
    font-weight: 500;
    font-size: 0.95rem;
    font-family: 'Antonio', sans-serif;
    transition: color 0.25s ease;
}

nav a::after {
   content: '';
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 0;
    height: 2px;
    background: blue;
    
    transition: width 0.3s ease;
}

nav a:hover {
        color: blue;

    }

nav a:hover::after {
    width: 100%;

}

/* ===============================
   CART ICON
================================ */
.cart-icon {
    position: relative;
    font-size: 1.6rem;
    color: var(--text);
    display: inline-flex;
    align-items: center;
    transition: transform 0.25s ease;
}

.cart-icon:hover {
    transform: translateY(-2px);
}

.cart-count {
    position: absolute;
    top: -10px;
    right: -14px;
    background: var(--accent-solid);
    color: #fff;
    width: 22px;
    height: 22px;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-sm);
}

/* ===============================
   MAIN
================================ */
main {
    flex: 1;
    padding: 3rem 0;
}

/* ===============================
   FOOTER
================================ */
footer {
    background: linear-gradient(
        180deg,
        var(--bg-secondary),
        #eef2ff
    );
    border-top: 1px solid var(--border);
}

footer h3 {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--accent-solid);
    letter-spacing: 0.03em;
    text-transform: uppercase;
}

footer a {
    position: relative;
    color: var(--text);
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.3s ease;
}

footer a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 0;
    height: 2px;
    background: blue;
    transition: width 0.3s ease;
}

footer a:hover {
    color: blue;
}

footer a:hover::after {
    width: 100%;
}

footer ul li {
    font-size: 0.875rem;
    color: var(--text-muted);
}

/* Footer layout helpers (responsive) */
.footer-top {
    display: grid;
    grid-template-columns: 1.2fr 1fr 1fr;
    gap: 4.5rem;
    margin: 4rem 0 3rem;
    justify-items: center;
    text-align: center;
}
.footer-brand {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
}
.footer-brand img.logo { height: 80px; }
.footer-brand img.payments { height: 45px; max-width:100%; object-fit:contain; }
.footer-links h3, .footer-contact h3 { font-size: 0.9rem; font-weight:600; color: blue; margin-bottom:1.25rem; }
.footer-links ul, .footer-contact ul { list-style: none; padding:0; margin:0; }
.footer-links li, .footer-contact li { margin-bottom:1.25rem; }

@media (max-width: 768px) {
    .footer-top { grid-template-columns: 1fr; gap: 1.5rem; margin: 2.5rem 0; }
    .footer-brand img.logo { height: 58px; }
    .footer-brand img.payments { height: 36px; }
}

/* ===============================
   PREMIUM CARD (FOR PRODUCTS)
================================ */
.card {
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-md);
    padding: 2rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
}

/* Premium styling for order summary */
.order-summary .card {
    background: linear-gradient(180deg, #ffffff, #f8fbff);
    border-radius: 18px;
    border: 1px solid rgba(79,70,229,0.12);
    box-shadow: 0 30px 80px rgba(15, 23, 42, 0.08);
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.order-summary .card::before {
    content: '';
    position: absolute;
    left: -40%;
    top: -40%;
    width: 180%;
    height: 200px;
    background: radial-gradient(circle at 20% 20%, rgba(79,70,229,0.06), transparent 20%), radial-gradient(circle at 80% 80%, rgba(37,99,235,0.04), transparent 20%);
    transform: rotate(12deg);
    pointer-events: none;
}

.order-summary .card h2 {
    font-size: 1.25rem;
    font-weight: 800;
    color: #0b1330;
    margin-bottom: 1.25rem;
}

.order-summary .card .total-block {
    padding: 1.25rem;
    background: linear-gradient(90deg, rgba(79,70,229,0.06), rgba(99,102,241,0.02));
    border-radius: 12px;
    margin-bottom: 1.25rem;
    border: 1px solid rgba(79,70,229,0.08);
}

.order-summary .card .total-block .label { color: var(--text-muted); font-weight:600; }
.order-summary .card .total-block .total-value { font-size:1.9rem; font-weight:900; color:#07102a; }

.order-summary .card .checkout-btn {
    width: 100%;
    padding: 1.05rem 1.2rem;
    font-size: 1rem;
    border-radius: 12px;
    box-shadow: 0 14px 40px rgba(79,70,229,0.18);
}

.order-summary .card .security-badge {
    margin-top: 1rem;
    padding: .9rem;
    background: rgba(79,70,229,0.04);
    border-radius: 10px;
    border: 1px solid rgba(79,70,229,0.08);
    text-align: center;
}

/* Animated premium checkout button */
.order-summary .card .checkout-btn {
    position: relative;
    overflow: hidden;
    color: #fff !important;
    background: linear-gradient(90deg, #4f46e5 0%, #2563eb 100%) !important;
    border: none;
    transition: transform 220ms cubic-bezier(.2,.9,.2,1), box-shadow 220ms ease;
}

.order-summary .card .checkout-btn::after {
    content: '';
    position: absolute;
    top: -40%;
    left: -20%;
    width: 40%;
    height: 200%;
    background: linear-gradient(120deg, rgba(255,255,255,0.18), rgba(255,255,255,0.04), rgba(255,255,255,0.18));
    transform: rotate(18deg) translateX(-120%);
    transition: transform 900ms cubic-bezier(.2,.9,.2,1);
    pointer-events: none;
    filter: blur(6px);
}

.order-summary .card .checkout-btn:hover::after {
    transform: rotate(18deg) translateX(20%);
}

.order-summary .card .checkout-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 24px 60px rgba(37,99,235,0.22);
}

.order-summary .card .checkout-btn:active {
    transform: translateY(-2px) scale(0.998);
}

.order-summary .card .checkout-btn:focus {
    outline: 3px solid rgba(79,70,229,0.15);
    outline-offset: 4px;
}

/* Security badge subtle animation */
.order-summary .card .security-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    color: #334155;
    transition: transform 220ms ease, box-shadow 220ms ease, background 220ms ease;
}

.order-summary .card .security-badge .lock {
    font-size: 1.05rem;
    color: #4f46e5;
    transform-origin: center;
    animation: lock-bob 2200ms ease-in-out infinite;
}

@keyframes lock-bob {
    0% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
    100% { transform: translateY(0); }
}

.order-summary .card .security-badge:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(37,99,235,0.08);
    background: rgba(79,70,229,0.06);
}

/* Make checkout button text slightly bolder on larger screens */
@media (min-width: 768px) {
    .order-summary .card .checkout-btn { font-weight: 800; }
}

/* ===============================
   BUTTON (LUXURY CTA)
================================ */
.btn-primary {
    background: var(--accent);
    color: #fff;
    padding: 0.75rem 1.75rem;
    border-radius: 999px;
    border: none;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 16px 40px rgba(79, 70, 229, 0.4);
}

/* Responsive header tweaks for mobile: center nav, keep logo left, cart pinned right */
@media (max-width: 768px) {
    .header-content {
        padding: 0.8rem 0;
        position: relative;
        align-items: center;
    }

    .logo img {
        height: 60px;
    }

    nav {
        flex: 0 0 auto;
        justify-content: flex-end;
        gap: 1rem;
        margin-left: auto;
    }

    nav a {
        font-size: 0.92rem;
        color: var(--text-muted);
        padding: 0.25rem 0.35rem;
    }

    /* Cart sits inside nav now; tweak sizes */
    .cart-icon {
        font-size: 1.3rem;
    }

    /* Slightly increase navbar link size on mobile for readability */
    nav a {
        font-size: 0.98rem;
    }
}

@media (max-width: 420px) {
    .logo img { height: 56px; }
    .cart-icon { right: 1rem; font-size: 1.2rem; }
}

/* Cart page responsive rules */
@media (max-width: 992px) {
    .cart-grid {
        grid-template-columns: 1fr !important;
        gap: 1.25rem !important;
    }

    .cart-item {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 1rem !important;
        padding: 1.25rem !important;
    }

    .product-thumb {
        width: 100% !important;
        height: 220px !important;
        flex-shrink: 0;
    }

    .product-info { width: 100% !important; }

    .product-price {
        width: 100% !important;
        text-align: left !important;
        display: flex !important;
        justify-content: space-between !important;
        gap: 1rem !important;
        margin-top: 0.5rem !important;
    }

    .order-summary {
        position: static !important;
        top: auto !important;
    }

    .btn-primary { width: 100%; }
}

/* Checkout form styles and responsiveness */
.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    align-items: stretch; /* ensure both columns match height */
}

.form-row { margin-bottom: 1.25rem; }
.form-row label { display:block; margin-bottom:0.5rem; font-weight:600; color:var(--text); font-size:0.95rem; }
.form-control {
    width:100%;
    padding:0.85rem 1rem;
    border-radius:10px;
    border:1px solid var(--border);
    background:var(--bg-secondary);
    font-size:0.95rem;
    color:var(--text);
    transition: box-shadow 0.18s ease, transform 0.12s ease;
}
.form-control:focus { box-shadow: 0 6px 18px rgba(79,70,229,0.08); outline: none; transform: translateY(-1px); }

.form-card { padding:1.5rem; }

/* Make form card visually match the premium order summary card */
.form-card,
.checkout-grid .card {
    background: linear-gradient(180deg, #ffffff, #f8fbff);
    border-radius: 18px;
    border: 1px solid rgba(79,70,229,0.12);
    box-shadow: 0 30px 80px rgba(15, 23, 42, 0.08), inset 0 1px 0 rgba(255,255,255,0.6);
    padding: 2rem;
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    min-height: 420px; /* give cards a robust height */
}

.form-card::before,
.order-summary .card::before {
    content: '';
    position: absolute;
    left: -40%;
    top: -40%;
    width: 180%;
    height: 200px;
    background: radial-gradient(circle at 20% 20%, rgba(79,70,229,0.06), transparent 20%), radial-gradient(circle at 80% 80%, rgba(37,99,235,0.04), transparent 20%);
    transform: rotate(12deg);
    pointer-events: none;
}

/* subtle glossy highlight */
.form-card::after,
.checkout-grid .card::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 60%;
    height: 40%;
    background: linear-gradient(180deg, rgba(255,255,255,0.35), rgba(255,255,255,0.02));
    transform: translateY(-10%);
    pointer-events: none;
    opacity: 0.6;
}

/* Ensure card content expands and footer/cta sits at the bottom */
.checkout-grid .card > * {
    z-index: 1;
}
.checkout-grid .card .card-footer {
    margin-top: auto;
    display: flex;
    gap: 0.75rem;
    align-items: center;
    justify-content: space-between;
}

/* Card body takes available space so footer pins to bottom */
.checkout-grid .card .card-body {
    flex: 1 1 auto;
}

/* Premium form controls */
.form-control {
    background: linear-gradient(180deg, #ffffff, #fbfdff);
    border: 1px solid rgba(15,23,42,0.06);
    box-shadow: inset 0 6px 18px rgba(15,23,42,0.03);
    padding: 0.95rem 1rem;
    border-radius: 12px;
}
.form-control::placeholder { color: #9aa6bb; }
.form-row label { color: #0b1330; font-weight:700; margin-bottom:0.5rem; }

/* Larger, premium CTA */
.pay-btn {
    padding: 0.95rem 1.2rem;
    border-radius: 12px;
    font-weight: 700;
    letter-spacing: 0.2px;
    box-shadow: 0 18px 48px rgba(79,70,229,0.18);
}

/* Shipping card header and responsive form grid */
.shipping-header {
    display:flex;
    align-items:center;
    gap:0.9rem;
    margin-bottom:1rem;
}
.shipping-header .icon {
    width:44px;
    height:44px;
    border-radius:10px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(135deg, rgba(79,70,229,0.12), rgba(37,99,235,0.06));
    color:#3b3f9a;
    font-size:1.2rem;
}
.shipping-header h2 { margin:0; font-size:1.15rem; font-weight:800; color:#07102a; }
.shipping-sub { color:var(--text-muted); font-size:0.9rem; }

.form-grid {
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem 1rem;
}
.form-grid .full { grid-column: 1 / -1; }

@media (max-width: 768px) {
    .form-grid { grid-template-columns: 1fr; }
}

/* Make sure mobile keeps good spacing and stacked cards still feel premium */
@media (max-width: 992px) {
    .checkout-grid .card { min-height: auto; }
    .checkout-grid { grid-template-columns: 1fr; }
}

@media (max-width: 992px) {
    .checkout-grid { grid-template-columns: 1fr; }
    .order-summary { position: static !important; top: auto !important; }
}

/* Mobile-first adjustments to ensure full visibility */
@media (max-width: 600px) {
    .container { padding: 0 1rem; }

    /* Stack cards, remove sticky behavior, allow full-width CTAs */
    .checkout-grid { gap: 1.25rem; }
    .order-summary { position: static !important; top: auto !important; }
    .checkout-grid .card { padding: 1.25rem; border-radius: 14px; }

    /* Center cards and limit width for premium look on phones */
    .checkout-grid { justify-items: center; }
    .checkout-grid .card { width: 100%; max-width: 520px; margin: 0 auto; }

    /* Make footer/CTA stack vertically */
    .checkout-grid .card .card-footer { flex-direction: column; align-items: stretch; gap: 0.75rem; }
    .checkout-grid .card .card-footer .card-footer-right,
    .checkout-grid .card .card-footer > div { width: 100%; }

    /* CTA full width */
    .pay-btn, .btn-primary { width: 100%; display: inline-block; }

    /* Reduce input padding for smaller screens while keeping touch targets comfortable */
    .form-control { padding: 0.75rem 0.9rem; border-radius: 10px; }

    /* Reduce min-height so stacked cards don't force long whitespace */
    .checkout-grid .card { min-height: auto; }
}
</style>

</head>

<body class="@yield('body-class')">
<header>
    <div class="container header-content">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo">
        </a>

        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#products">Products</a>

            <a href="{{ route('cart') }}" class="cart-icon">
                🛒
                @php
                    $cart = session('cart', []);
                    $totalItems = collect($cart)->sum('quantity');
                @endphp

                @if ($totalItems > 0)
                    <span class="cart-count">
                        {{ $totalItems }}
                    </span>
                @endif
            </a>
        </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer>
    <div class="container">
        <!-- Top Footer -->
        <div class="footer-top">
            <!-- Brand -->
            <div class="footer-brand">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="logo">

                <p style="font-size: 0.975rem; color: var(--text);">
                    Secure & trusted payments
                </p>

                <img src="{{ asset('bank.png') }}" alt="Payment methods" class="payments">
            </div>

            <!-- Links -->
            <div class="footer-links">
                <h3>Links</h3>

                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('home') }}">Products</a></li>
                    <li><a href="{{ route('cart') }}">Cart</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-contact">
                <h3>Contact Us</h3>

                <ul>
                    <li>086 420 410</li>
                    <li>dsdigitalservice.com</li>
                    <li>Sereyodam Chek</li>
                </ul>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div style="border-top: 1px solid var(--border); padding: 1rem 0; text-align: center;">
            <p style="font-size: 0.8rem; color: var(--text-muted);">
                © 2026 All Rights Reserved by
                <a href="https://dsdigitalservice.com" style="color: var(--accent); font-weight: 500;">
                    DsDigital Service
                </a>
            </p>
        </div>
    </div>
</footer>
</body>
</html>
