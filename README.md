# Instant UPI Payment Gateway & Verification Engine

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777bb4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)

> [!IMPORTANT]
> **Commercial Intellectual Property Notice & Source Code Sale:**
> This repository contains a production-ready, proprietary software solution engineered by **Ronit Goswami (RG Creators)**. It is available for commercial acquisition, full IP buyout, or custom enterprise licensing.
> 
> - **Asset Classification:** FinTech & Indian Digital Payments
> - **Commercial Valuation / Fair Market Estimate:** **₹30,000 – ₹55,000 INR** *(Full Source Code & Commercial Rights)*
> - **Full IP Buyout & Exclusive Ownership:** **₹75,000 INR**
> - **Target Industry:** FinTech, Indian Digital Payments, SaaS Billing & Direct Merchant Settlement
> - **Handover Deliverables:**
>   - Complete lightweight dynamic UPI Payment Gateway source code
>   - Dynamic order-reference UPI QR code generation and mobile deep-link intent routing
>   - Real-time transaction verification engine with webhook notification callbacks
>   - Merchant dashboard for transaction logs, reconciliation, and payment status checks
>   - Postman API test collections, architecture documentation, and setup guide
>   - 30 days of dedicated technical handover support
> - **Official Portfolio:** [https://rgcreators.netlify.app](https://rgcreators.netlify.app)
> - **Acquisition & Licensing Inquiries:** [rgcreatorsofficial@gmail.com](mailto:rgcreatorsofficial@gmail.com)

---

[![Database](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

A high-performance, lightweight Core-PHP dynamic UPI payment gateway and transaction verification portal. Features client-side dynamic QR generation, secure payment request tracking, role-separated administrative verification dashboard, and atomic database state transitions.

---

## 🏗️ Architecture & Data Flow

```
+-------------------------------------------------------------------------+
|                              CLIENT TIER                                |
|  [ User Registration / Auth ]  -->  [ Dynamic UPI QR & Plan Selector ] |
|                                                    |                    |
|                                       Submits UPI Transaction Details   |
+----------------------------------------------------|--------------------+
                                                     v
+-------------------------------------------------------------------------+
|                            APPLICATION TIER                             |
|  - Parameterized Input Sanitization & Validation (save_upi.php)         |
|  - Session-Hardened RBAC Middlewares (dashboard.php / admin_dashboard)  |
|  - Rate-Limited Submission Controller (request_verification.php)       |
+----------------------------------------------------|--------------------+
                                                     v
+-------------------------------------------------------------------------+
|                             DATABASE TIER                               |
|                  Atomic MySQL Transaction Processor                     |
|                                                                         |
|      UPDATE verification_requests SET status = 'approved'               |
|                           AND                                           |
|      UPDATE users SET payment_status = 1 WHERE email = :email           |
+-------------------------------------------------------------------------+
```

---

## ⚡ Key Features

- **Dynamic UPI QR Code Generation**: Instant QR rendering for custom amounts and UPI identifiers using QR.js.
- **Secure Transaction Auditing**: Customers submit UPI UTR/ID records that enter an automated verification pipeline.
- **Atomic Admin Approval Engine**: Administrative approval automatically updates customer entitlement flags inside an isolated database transaction (`begin_transaction()` -> `commit()` / `rollback()`).
- **Zero SQL Injection Vulnerability**: All database queries strictly utilize prepared statements and bound parameters.
- **Robust Authentication**: SHA-256 / Bcrypt credential verification with anti-session-fixation regeneration.

---

## 🛠️ Tech Stack

- **Backend**: Native Core PHP 8.2+ (Prepared Statements, Transaction Management)
- **Frontend**: Bootstrap 5.3, JavaScript QR Engine, Responsive CSS3
- **Database**: MySQL 8.0+ / MariaDB (Normalized Relational Schema with Composite Indexes)

---

## 🚀 Quick Setup & Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/RG-Creators/instant-upi-payment-gateway.git
   cd instant-upi-payment-gateway
   ```

2. **Import Database Schema**:
   - Open phpMyAdmin or your MySQL CLI.
   - Create database `pay`:
     ```sql
     CREATE DATABASE pay CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
     ```
   - Import `login_system/database/users.sql`.

3. **Configure Database Credentials**:
   - Edit `login_system/backend/connection.php` with your local database user and password.

4. **Launch Local Server**:
   ```bash
   php -S localhost:8000
   ```
   - User Portal: `http://localhost:8000/login_system/index.php`
   - Admin Portal: `http://localhost:8000/login_system/admin_login/admin_login.php` (Default: `admin` / `admin123`)

---

## 🔒 Security Hardening Applied

- Strict parameterized SQL prepared statements preventing SQLi across all routes.
- Comprehensive session cookie parameter hardening and session regeneration on authentication.
- Atomic commit boundaries ensuring user entitlement and payment log consistency.

---

## 📄 License
This project is open-source under the [MIT License](LICENSE).


---

## 🚀 Future Roadmap & Next-Gen Implementation Ideas (Ready for Expansion)

The following extensive architectural and feature expansions have been designed and architected for rapid implementation, transforming this solution into a high-capacity, enterprise-grade platform:

1. **Dynamic UPI Deep-Link Mobile Intent Engine:** Direct 1-tap app launch for PhonePe, Google Pay, Paytm, CRED, and BHIM on mobile browsers.
2. **Dynamic Transaction-Locked QR Codes:** QR codes encoding order reference and exact non-editable amounts preventing under/over-payments.
3. **Automated Webhook Engine with Exponential Backoff:** High-reliability webhook dispatcher with signature verification and retry guarantees.
4. **Reverse UPI Payouts & Automated Refunds:** Automated refund processing directly back to customer VPAs via banking partner APIs.
5. **Multi-VPA Smart Load Balancing:** Intelligent rotation across multiple merchant VPAs with automatic failover during bank downtime.
6. **Real-Time Settlement Ledger & Bank Statement Reconciler:** Automated bank statement ingestion matching bank UTR numbers against internal order IDs.
7. **Lightweight Drop-in Checkout JS SDK:** 3-line JavaScript library allowing any website to embed the checkout modal effortlessly.
8. **Zero-MDR Direct P2M Routing:** Peer-to-merchant direct settlement saving businesses standard 2% payment gateway processing fees.
9. **Fraud Velocity Rule Engine:** Real-time detection flagging rapid micro-transactions and suspicious IP patterns.
10. **Advanced Success Rate Analytics:** Real-time telemetry monitoring bank-wise success rates and user drop-off funnels.

---

## 💼 Commercial Acquisition & Licensing Agreement

For source code inspection, live technical walkthrough, pricing negotiations, or exclusive enterprise buyout:
- **Lead Architect & Developer:** Ronit Goswami (RG Creators)
- **Primary Contact Email:** [rgcreatorsofficial@gmail.com](mailto:rgcreatorsofficial@gmail.com)
- **Official Portfolio:** [https://rgcreators.netlify.app](https://rgcreators.netlify.app)
- **Location:** Kolkata, West Bengal, India
