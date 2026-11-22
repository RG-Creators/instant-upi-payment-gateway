# Instant UPI Payment Gateway & Verification Engine

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777bb4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Database](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

A high-performance, lightweight Core-PHP dynamic UPI payment gateway and transaction verification portal. Features client-side dynamic QR generation, secure payment request tracking, role-separated administrative verification dashboard, and atomic database state transitions.

---

## ?? Architecture & Data Flow

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

## ? Key Features

- **Dynamic UPI QR Code Generation**: Instant QR rendering for custom amounts and UPI identifiers using QR.js.
- **Secure Transaction Auditing**: Customers submit UPI UTR/ID records that enter an automated verification pipeline.
- **Atomic Admin Approval Engine**: Administrative approval automatically updates customer entitlement flags inside an isolated database transaction (`begin_transaction()` -> `commit()` / `rollback()`).
- **Zero SQL Injection Vulnerability**: All database queries strictly utilize prepared statements and bound parameters.
- **Robust Authentication**: SHA-256 / Bcrypt credential verification with anti-session-fixation regeneration.

---

## ?? Tech Stack

- **Backend**: Native Core PHP 8.2+ (Prepared Statements, Transaction Management)
- **Frontend**: Bootstrap 5.3, JavaScript QR Engine, Responsive CSS3
- **Database**: MySQL 8.0+ / MariaDB (Normalized Relational Schema with Composite Indexes)

---

## ?? Quick Setup & Installation

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

## ?? Security Hardening Applied

- Strict parameterized SQL prepared statements preventing SQLi across all routes.
- Comprehensive session cookie parameter hardening and session regeneration on authentication.
- Atomic commit boundaries ensuring user entitlement and payment log consistency.

---

## ?? License
This project is open-source under the [MIT License](LICENSE).
