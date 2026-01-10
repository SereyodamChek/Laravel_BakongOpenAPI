@extends('layouts.app')
@section('title', 'Checkout')

@php
  $subtotal = 0;
  foreach($cartProducts as $product){
    $subtotal += ($product['price'] * $product['quantity']);
  }
@endphp

@section('content')

<style>
  :root {
    --primary: #2563eb;
    --border: #e5e7eb;
    --text-muted: #6b7280;
    --radius: 12px;
  }

  * { box-sizing: border-box; }

  /* Page */
  .checkout-section {
    padding: 3rem 1rem 4rem;
    background: #f9fafb;
  }
  .container {
    max-width: 1100px;
    margin: 0 auto;
  }
  .checkout-header {
    margin-bottom: 2rem;
  }
  .checkout-header h1 {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }
  .checkout-header p {
    font-size: 0.95rem;
    color: var(--text-muted);
  }

  /* Grid */
  .checkout-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
    align-items: start;
  }

  /* Card */
  .card {
    background: #fff;
    border-radius: var(--radius);
    padding: 1.75rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
  }
  .card h2 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
  }

  /* Form */
  .form-group { margin-bottom: 1.25rem; }
  label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.4rem;
  }
  input {
    width: 100%;
    padding: 0.75rem 0.85rem;
    font-size: 0.95rem;
    border-radius: 8px;
    border: 1px solid var(--border);
    outline: none;
    transition: border 0.2s, box-shadow 0.2s;
  }
  input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
  }

  /* Button */
  .btn-primary {
    width: 100%;
    padding: 0.95rem;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 10px;
    border: none;
    background: var(--primary);
    color: #fff;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
  }
  .btn-primary:hover { background: #1d4ed8; }
  .btn-primary:active { transform: scale(0.98); }

  /* Order summary */
  .order-summary { position: static; }
  .card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
  }
  .order-item {
    display: flex;
    align-items: center;
    gap: 0.9rem;
    padding: 0.75rem 0;
  }
  .order-item.bordered {
    border-top: 1px solid var(--border);
    margin-top: 1rem;
    padding-top: 1rem;
  }
  .order-item img {
    width: 64px;
    height: 64px;
    border-radius: 10px;
    border: 1px solid var(--border);
    object-fit: cover;
    flex-shrink: 0;
  }
  .order-item-info { flex: 1; min-width: 0; }
  .order-item-name {
    font-size: 0.9rem;
    font-weight: 600;
    line-height: 1.3;
  }
  .order-item-price {
    font-weight: 600;
    font-size: 0.95rem;
    white-space: nowrap;
  }
  .order-empty {
    text-align: center;
    padding: 2rem 0;
    font-size: 0.95rem;
    color: var(--text-muted);
  }
  .divider {
    margin: 1.5rem 0;
    border: none;
    border-top: 1px solid var(--border);
  }
  .summary-lines { margin-bottom: 1.25rem; }
  .summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.6rem;
    font-size: 0.95rem;
    color: var(--text-muted);
  }
  .summary-row .free {
    color: var(--primary);
    font-weight: 500;
  }
  .total-box {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    padding: 1.25rem;
    background: #f3f4f6;
    border-radius: 12px;
  }
  .total-box span {
    font-size: 0.95rem;
    font-weight: 500;
  }
  .total-amount {
    font-size: 1.75rem;
    font-weight: 600;
    letter-spacing: -0.5px;
  }

  /* Desktop layout */
  @media (min-width: 992px) {
    .checkout-grid {
      grid-template-columns: 1.2fr 0.8fr;
    }
    .checkout-header h1 { font-size: 2rem; }
    .order-summary {
      
      top: 120px;
    }
  }

  /* Mobile adjustments */
  @media (max-width: 768px) {
    /* Make order summary card and content larger for mobile */
    .checkout-grid { grid-template-columns: 1fr; gap: 1.5rem; }
    .checkout-grid > .card, .checkout-grid > .order-summary { width: 100%; }
    .order-summary { width: 120%; display: block; }
    .order-summary .card {
      padding: 1.75rem;
      width: 120%;
      max-width: none;
      /* Nudge slightly left to align visually with shipping card */
      margin: 1.20rem -10%;
      box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    }

    .card-title { font-size: 1.2rem; }
    .order-item img { width: 72px; height: 72px; }
    .order-item { gap: 1rem; padding: 1rem 0; }
    .order-item-name { font-size: 1rem; }
    .order-item-price { font-size: 1rem; }

    .summary-row { font-size: 1rem; }
    .total-box { padding: 1.5rem; }
    .total-amount { font-size: 1.9rem; }
  }

  /* =======================
     KHQR MODAL (single)
     ======================= */
  .khqr-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    justify-content: center;
    align-items: center;
    z-index: 9999;
    padding: 1rem;
    opacity: 0;
    transition: opacity 0.35s ease;
  }
  .khqr-modal.show { opacity: 1; }

  .khqr-card {
    max-width: 420px;
    width: 100%;
    background: #ffffff;
    border-radius: 24px;
    padding: 2.5rem 2rem;
    text-align: center;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.18);
    overflow: hidden;
    position: relative;
  }

  .khqr-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: #f5f5f5;
    border: none;
    font-size: 1.5rem;
    color: #888;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
  }
  .khqr-close:hover {
    background: #ffebee;
    color: #d32f2f;
  }

  .khqr-logo {
    display: block;
    margin: -30px auto 0;
    width: 100px;
  }

  .khqr-tag {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #e3f2fd;
    color: #1976d2;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 1px;
    border-radius: 30px;
    margin-bottom: 1.5rem;
  }

  .khqr-amount {
    font-size: 2.8rem;
    font-weight: 700;
    margin: 0 0 2rem 0;
    color: #1976d2;
  }

  .khqr-content-wrapper {
    position: relative;
    min-height: 340px;
    margin-bottom: 1.5rem;
  }

  .khqr-qr-wrapper {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 20px;
    border: 2px dashed #ddd;
    opacity: 1;
    transition: opacity 0.6s ease, transform 0.6s ease;
  }
  .khqr-qr-wrapper.hide {
    opacity: 0;
    transform: translateX(-50%) scale(0.85);
  }
  .khqr-qr-wrapper img {
    width: 260px;
    height: 260px;
    display: block;
  }

  .khqr-success-wrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    display: flex;
    flex-direction: column;
    align-items: center;
    opacity: 0;
    transition: opacity 0.7s ease, transform 0.7s ease;
    pointer-events: none;
  }
  .khqr-success-wrapper.show {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
    pointer-events: auto;
  }

  .success-circle {
    position: relative;
    width: 150px;
    height: 150px;
    margin-bottom: 1.5rem;
  }

  .checkmark-circle {
    fill: #4caf50;
    stroke: #4caf50;
    stroke-width: 4;
    stroke-dasharray: 280;
    stroke-dashoffset: 280;
    animation: drawCircle 0.9s ease forwards;
  }

  .checkmark-tick {
    fill: none;
    stroke: #fff;
    stroke-width: 7;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 80;
    stroke-dashoffset: 80;
    animation: drawTick 0.6s 0.6s ease forwards;
  }

  @keyframes drawCircle { to { stroke-dashoffset: 0; } }
  @keyframes drawTick { to { stroke-dashoffset: 0; } }

  .success-circle::before {
    content: '';
    position: absolute;
    inset: -15px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(76,175,80,0.35) 0%, transparent 70%);
    animation: glowPulse 2s ease-in-out infinite;
  }
  @keyframes glowPulse {
    0%, 100% { transform: scale(1); opacity: 0.6; }
    50% { transform: scale(1.15); opacity: 0.9; }
  }

  .success-text h3 {
    font-size: 1.6rem;
    color: #2e7d32;
    margin: 0 0 0.5rem 0;
    font-weight: 600;
  }
  .success-text p {
    font-size: 1.1rem;
    color: #555;
    margin: 0;
  }

  .khqr-status-box {
    background: #e3f2fd;
    border: 1px solid #bbdefb;
    padding: 1.25rem;
    border-radius: 16px;
    font-size: 0.95rem;
    color: #1565c0;
    transition: all 0.5s ease;
  }
  .khqr-status-box.success {
    background: #e8f5e9;
    border-color: #a5d6a7;
    color: #2e7d32;
  }

  .khqr-waiting {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #555;
  }
  .khqr-waiting span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #1976d2;
    animation: dots 1.4s infinite ease-in-out;
  }
  .khqr-waiting span:nth-child(1) { animation-delay: 0s; }
  .khqr-waiting span:nth-child(2) { animation-delay: 0.2s; }
  .khqr-waiting span:nth-child(3) { animation-delay: 0.4s; }
  @keyframes dots {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }

  .particle {
    position: absolute;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    pointer-events: none;
    animation: particle 1.4s ease-out forwards;
  }
  @keyframes particle {
    to {
      transform: translate(var(--x), var(--y)) scale(0);
      opacity: 0;
    }
  }
</style>

<section class="checkout-section">
  <div class="container">
    <div class="checkout-header">
      <h1>Checkout</h1>
      <p>Complete your purchase securely</p>
    </div>

    <div class="checkout-grid">

      <!-- LEFT: Shipping + Payment -->
      <div class="card">
        <h2>Shipping Information</h2>

        <form id="checkoutForm" onsubmit="return false;">
          <div class="form-group">
            <label for="customer_name">Full Name</label>
            <input type="text" id="customer_name" required placeholder="John Doe">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" required placeholder="john@example.com">
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" required placeholder="123 Main Street, Phnom Penh">
          </div>

          <div class="form-group">
            <label for="phone">Phone (optional)</label>
            <input type="tel" id="phone" placeholder="+855 12 345 678">
          </div>

          <button type="button" class="btn-primary" onclick="startKHQR()">
            Pay with Bakong KHQR
          </button>

          <div class="form-group" style="margin-top: 1rem; text-align: center;">
            <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">
              Supported Payment Methods
            </div>

            <div style="display:flex; justify-content:center; align-items:center; gap:10px;">
              <img src="{{ asset('KHQR.png') }}" alt="KHQR Payment" style="width: 60px; height:auto; display:block;" />
              <img src="{{ asset('ABA.png') }}" alt="ABA Bank" style="width: 42px; height:auto; display:block;" />
            </div>
          </div>
        </form>
      </div>

      <!-- RIGHT: Order Summary -->
      <div class="order-summary">
        <div class="card">
          <h2 class="card-title">Order Summary</h2>

          @forelse($cartProducts as $index => $product)
            @php $itemTotal = $product['price'] * $product['quantity']; @endphp

            <div class="order-item {{ $index > 0 ? 'bordered' : '' }}">
              <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">

              <div class="order-item-info">
                <p class="order-item-name">
                  {{ $product['name'] }} × {{ $product['quantity'] }}
                </p>
              </div>

              <p class="order-item-price">
                ${{ number_format($itemTotal, 2) }}
              </p>
            </div>
          @empty
            <p class="order-empty">Your cart is empty</p>
          @endforelse

          <hr class="divider">

          <div class="summary-lines">
            <div class="summary-row">
              <span>Subtotal</span>
              <span>${{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="summary-row">
              <span>Shipping</span>
              <span class="free">Free</span>
            </div>
            <div class="summary-row">
              <span>Tax</span>
              <span>$0.00</span>
            </div>
          </div>

          <div class="total-box">
            <span>Total</span>
            <span class="total-amount">${{ number_format($subtotal, 2) }}</span>
          </div>
        </div>
      </div>
        
    </div>
  </div>
</section>

<!-- ✅ SINGLE KHQR MODAL (only once) -->
<div id="khqrModal" class="khqr-modal">
  <div class="khqr-card">
    <button class="khqr-close" onclick="closeModal()">×</button>

    <img src="https://static.tildacdn.one/tild3133-3762-4664-b634-653566333735/bakong-square.png"
         alt="Bakong Logo"
         class="khqr-logo">

    <div class="khqr-tag">BAKONG KHQR PAYMENT</div>

    <p class="khqr-amount">${{ number_format($subtotal, 2) }}</p>

    <div class="khqr-content-wrapper">
      <div class="khqr-qr-wrapper" id="qrWrapper">
        <img id="khqrImg" src="" alt="KHQR Code">
      </div>

      <div class="khqr-success-wrapper" id="successWrapper">
        <div class="success-circle">
          <svg class="checkmark" viewBox="0 0 100 100">
            <circle class="checkmark-circle" cx="50" cy="50" r="44" />
            <path class="checkmark-tick" d="M28 50 L44 66 L72 34" />
          </svg>
        </div>
        <div class="success-text">
          <h3>Payment Successful!</h3>
          <p>Thank you for your purchase 🎉</p>
        </div>
      </div>
    </div>

    <div class="khqr-status-box" id="khqrStatusBox">
      <div class="khqr-waiting" id="waitingDots">
        <span></span><span></span><span></span>
      </div>
      <p id="khqrStatus" style="margin: 0.5rem 0 0 0;">Waiting for payment confirmation...</p>
    </div>
  </div>
</div>

<script>
  let md5 = null;
  let poller = null;
  let processed = false;

  function resetModalUI() {
    document.getElementById('qrWrapper').classList.remove('hide');
    document.getElementById('successWrapper').classList.remove('show');
    document.getElementById('waitingDots').style.display = 'flex';
    document.getElementById('khqrStatus').innerHTML = 'Waiting for payment confirmation...';
    document.getElementById('khqrStatusBox').classList.remove('success');
  }

  function closeModal() {
    const modal = document.getElementById('khqrModal');
    modal.classList.remove('show');
    setTimeout(() => { modal.style.display = 'none'; }, 300);

    if (poller) clearInterval(poller);
    poller = null;
    md5 = null;
    processed = false;

    resetModalUI();
  }

  async function startKHQR() {
    const name    = document.getElementById('customer_name').value.trim();
    const email   = document.getElementById('email').value.trim();
    const address = document.getElementById('address').value.trim();
    const phone   = document.getElementById('phone').value.trim();

    if (!name || !email || !address) {
      alert('Please fill in name, email, and address.');
      return;
    }

    processed = false; // important: allow polling again if reopened

    try {
      const res = await fetch('/khqr/create', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ amount: {{ $subtotal }} })
      });

      const data = await res.json();
      if (data.error) {
        alert('Error: ' + data.error);
        return;
      }

      md5 = data.md5;

      document.getElementById('khqrImg').src =
        'https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=' + encodeURIComponent(data.qr);

      resetModalUI();

      const modal = document.getElementById('khqrModal');
      modal.style.display = 'flex';
      requestAnimationFrame(() => modal.classList.add('show'));

      if (poller) clearInterval(poller);
      poller = setInterval(() => checkPayment(name, email, address, phone), 3000);

    } catch (err) {
      alert('Network error: ' + err.message);
    }
  }

  async function checkPayment(name, email, address, phone) {
    if (!md5 || processed) return;

    try {
      const res = await fetch(`/khqr/check?md5=${md5}`);
      const data = await res.json();

      if (data.paid) {
        processed = true;
        if (poller) clearInterval(poller);

        await fetch('/notify-telegram', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            customer_name: name,
            email: email,
            address: address,
            phone: phone,
            total: {{ $subtotal }},
            items: @json($cartProducts),
            paid_from_account: data.fromAccountId || 'Unknown',
            paid_to_account: data.toAccountId || 'Unknown',
            date: new Date().toLocaleString('en-GB', {
              day: '2-digit', month: '2-digit', year: 'numeric',
              hour: '2-digit', minute: '2-digit'
            })
          })
        });

        await fetch('/cart/clear', {
          method: 'POST',
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        });

        document.getElementById('qrWrapper').classList.add('hide');

        setTimeout(() => {
          document.getElementById('successWrapper').classList.add('show');
          document.getElementById('waitingDots').style.display = 'none';
          document.getElementById('khqrStatus').innerHTML = '✓ Payment confirmed successfully!';
          document.getElementById('khqrStatusBox').classList.add('success');
          addParticles();

          setTimeout(() => {
            closeModal();
            window.location.href = '/';
          }, 3500);
        }, 600);
      }
    } catch (err) {
      console.error('Polling error:', err);
    }
  }

  function addParticles() {
    const colors = ['#4caf50', '#8bc34a', '#ffeb3b', '#ff9800', '#03a9f4', '#e91e63'];
    const container = document.querySelector('.success-circle');
    if (!container) return;

    for (let i = 0; i < 45; i++) {
      const p = document.createElement('div');
      p.className = 'particle';
      p.style.background = colors[Math.floor(Math.random() * colors.length)];
      p.style.left = '50%';
      p.style.top = '50%';

      const angle = Math.random() * Math.PI * 2;
      const velocity = 100 + Math.random() * 100;
      const x = Math.cos(angle) * velocity;
      const y = Math.sin(angle) * velocity;

      p.style.setProperty('--x', x + 'px');
      p.style.setProperty('--y', y + 'px');

      container.appendChild(p);
      setTimeout(() => p.remove(), 1400);
    }
  }
</script>

@endsection
