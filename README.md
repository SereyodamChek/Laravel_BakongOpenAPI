# Laravel KHQR Integration with Telegram Notification

A Laravel project demonstrating **Bakong KHQR integration** with **realtime payment confirmation** and **instant Telegram admin notification** on successful payment.

Perfect for Cambodian e-commerce stores using Bakong — get notified in your Telegram chat the moment a customer pays!

---

## Features

- Full Bakong KHQR payment flow (generate QR → realtime polling → confirm payment)
- Beautiful checkout page with cart management
- Stunning success animation with particles on payment confirmation
- **New**: Instant Telegram notification to admin on every successful payment
  - Shows customer details, order items, total, sender/receiver accounts, and reference
- Cart automatically cleared after successful payment
- No database required for orders (session-based cart)

---

## Project Structure

* **Controllers**
  * `ShopController.php` → product listing, cart actions
  * `KHQRController.php` → KHQR generation and payment checking
* **Services**
  * `TelegramNotificationService.php` → clean, reusable Telegram messaging
* **Views**
  * Blade templates: home, products, cart, checkout with KHQR modal
* **Scripts**
  * Realtime polling + success animation + Telegram notification trigger

---

## Setup

1. Clone the repository:
```bash
git clone https://github.com/DaraTheGod/laravel-bakong-khqr-realtime.git
cd laravel-bakong-khqr-realtime
```

2. Install dependencies:
```bash
composer install
npm install
npm run dev
```

3. Copy `.env.example` to `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your `.env` file:

```env
APP_NAME="Your Shop"
APP_URL=http://localhost:8000

# Database (optional - only if you add persistence later)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# Bakong KHQR API
BAKONG_TOKEN=your_real_bakong_token_here
BAKONG_ACCOUNT=your_username@wing   # e.g., chhinchheang_dara@wing

# Telegram Notification (NEW!)
TELEGRAM_BOT_TOKEN=123456789:AAFxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
TELEGRAM_ADMIN_CHAT_ID=1234567890   # Your personal or group chat ID
```

> Register for Bakong API: https://api-bakong.nbc.gov.kh/register  
> Create a Telegram bot via @BotFather and get your bot token  
> Get your chat ID by messaging @userinfobot or adding the bot to a group

---

## Usage

1. Start the server:
```bash
php artisan serve
```

2. Visit: http://127.0.0.1:8000

3. Add products to cart → go to **Checkout**

4. Fill in customer info → click **Pay with Bakong KHQR**

5. Scan the QR code with your Bakong app and complete payment

6. On success:
   - Success animation plays
   - Cart is cleared
   - **Admin receives instant Telegram notification** with full order details

---

## Telegram Notification Example

You’ll receive a beautifully formatted message like this:

```
🔔 New Order Received!

Order Items
• 2 × T-Shirt — $30.00
• 1 × Coffee Mug — $15.00

Total Amount: $45.00

Payment Details
Paid via Bakong KHQR
From: `customer123@aba`
To: `chhinchheang_dara@wing`
Date: 07/01/2026, 15:30

Customer Information
Name: Sok Piseth
Email: piseth@example.com
Phone: +855 96 123 4567
Address: #45, Street 2004, Phnom Penh

Order Reference: `A1B2C3D4`

By Chhinchheang Dara
```

---

## Notes

- This is a **demo/project showcase** — not fully production-hardened (e.g., no order persistence yet).
- Telegram notifications use a dedicated service class for clean, reusable code.
- SSL verification is disabled locally (`verify => false`) — remove in production or fix root CA issues.
- Cart is stored in session (cleared automatically on success).
You can copy-paste this directly into your repo’s `README.md`.
