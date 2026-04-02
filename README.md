# 💳 Laravel KHQR Shop with Telegram Notifications

### 👨‍💻 Built by Sereyodam

---

## 📌 About This Project

This project is a **Laravel-based e-commerce checkout system** integrated with **Bakong KHQR payments** and **real-time Telegram notifications**.

It demonstrates how Cambodian online stores can accept KHQR payments and instantly notify admins when a customer completes a transaction.

---

## 🚀 Key Features

* 💳 **Bakong KHQR Payment Integration**
* 🔄 **Realtime Payment Confirmation (Polling)**
* 🛍️ **Shopping Cart System (Session-based)**
* 🎉 **Success Animation on Payment Completion**
* 📩 **Instant Telegram Notifications**
* 🧾 Detailed order info sent to admin (items, total, customer, accounts)
* 🧹 Cart auto-clears after successful payment

---

## 🛠️ Tech Stack

* 🐘 **Laravel (PHP Framework)**
* ⚡ **Vite (Frontend build tool)**
* 🎨 **Blade Templates**
* 📡 **Bakong KHQR API**
* 🤖 **Telegram Bot API**

---

## 📂 Project Structure

```
/app        → Controllers & core logic
/api        → API-related logic
/routes     → Web & API routes
/resources  → Blade views (UI)
/public     → Public assets
/config     → App configuration
/database   → Database setup (optional)
/storage    → Storage files
/tests      → Testing
```

---

## ⚙️ Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/YOUR_USERNAME/YOUR_REPO.git
cd YOUR_REPO
```

### 2. Install dependencies

```bash
composer install
npm install
npm run dev
```

### 3. Environment setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure `.env`

```env
APP_NAME="Your Shop"
APP_URL=http://localhost:8000

# Bakong KHQR
BAKONG_TOKEN=your_bakong_token
BAKONG_ACCOUNT=your_account@wing

# Telegram
TELEGRAM_BOT_TOKEN=your_bot_token
TELEGRAM_ADMIN_CHAT_ID=your_chat_id
```

---

## ▶️ Run the Project

```bash
php artisan serve
```

Open in browser:
👉 [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🧪 How It Works

1. Add products to cart
2. Go to checkout
3. Generate KHQR
4. Scan & pay via Bakong app
5. System detects payment in realtime
6. 🎉 Success animation shows
7. 📩 Telegram notification sent instantly

---

## 📩 Telegram Notification Example

```
🔔 New Order Received!

• 2 × Product A — $30
• 1 × Product B — $15

Total: $45
Paid via KHQR
```

---

## 📈 Future Improvements

* 🗄️ Database order persistence
* 🔐 Authentication system
* 📊 Admin dashboard
* 💳 Multiple payment methods
* 🌐 Production-ready security

---

## ⚠️ Notes

* This is a **demo / showcase project** (not production-ready)
* Cart is stored in **session**
* SSL verification may be disabled locally

---

## 📫 Contact

* GitHub: [https://github.com/YOUR_USERNAME](https://github.com/YOUR_USERNAME)
* Email: [sereyodamc011@gmail.com](mailto:sereyodamc011@gmail.com)

---

⭐ *Focused on building real-world payment systems for Cambodia.*
