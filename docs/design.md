# Alate Platform - Technical Design Document

## 1. Executive Summary
Alate is a SaaS platform for Tanzanian social hall owners to manage assets, bookings, and finances. The system deals with multi-tenancy (multiple businesses per owner), asset availability (calendar management), and financial tracking.

## 2. System Architecture
The application will be built as a monolithic Laravel application serving a RESTful API (and potentially a server-side rendered UI if needed later).

- **Framework:** Laravel 12.x
- **Language:** PHP 8.2+
- **Database:** MySQL 8.0+ / MariaDB
- **Authentication:** Laravel Sanctum (API Token) or Session-based (Web). Fortify for 2FA.
- **Storage:** Local/S3 for Asset images and Payment proofs.

### 2.1 Multi-Tenancy Strategy
Since a user can own multiple businesses, we will use a "Team/Organization" based multi-tenancy model.
- **Scope:** Most data (Assets, Bookings, Customers) will be scoped to a `business_id`.
- **Context:** Middleware will detect the active business context (e.g., via header `X-Business-ID` or route parameter) to scope queries.

## 3. Database Schema Design

### 3.1 Users & Authentication
- **users**
    - `id`, `name`, `email`, `password`, `phone`, `locale` (en/sw), `timestamps`
- **password_reset_tokens**
- **sessions**

### 3.2 Business & Access Control
- **businesses**
    - `id`, `name`, `slug` (unique), `logo_path`, `contact_email`, `contact_phone`, `address`, `timestamps`
- **business_user** (Pivot)
    - `user_id`, `business_id`, `role` (owner, manager, receptionist, viewer), `timestamps`

### 3.3 Assets (Social Halls)
- **assets**
    - `id`, `business_id`, `name`, `type` (hall, garden, etc.), `capacity` (int), `description` (text), `amenities` (json), `base_price` (decimal), `location_details`, `is_active` (bool), `timestamps`
- **asset_images**
    - `id`, `asset_id`, `path`, `is_featured` (bool), `timestamps`

### 3.4 Services
- **services**
    - `id`, `business_id`, `name`, `description`, `price_type` (fixed, per_person, hourly), `price` (decimal), `timestamps`

### 3.5 Customers (CRM)
- **customers**
    - `id`, `business_id`, `name`, `email`, `phone`, `notes`, `timestamps`
    - *Note:* Scoped to business to protect client lists, though a global lookup could be considered in future.

### 3.6 Bookings
- **bookings**
    - `id`, `business_id`, `asset_id`, `customer_id`, `user_id` (created_by), `booking_reference` (unique string), `start_time` (datetime), `end_time` (datetime), `event_type`, `guest_count`, `status` (pending, confirmed, cancelled, completed), `total_amount` (decimal), `notes`, `timestamps`
- **booking_services** (Pivot)
    - `booking_id`, `service_id`, `quantity`, `unit_price`, `total_price`

### 3.7 Financials
- **payments**
    - `id`, `booking_id`, `business_id`, `amount`, `payment_method` (bank, cash, mobile_money), `reference_number` (transaction id), `proof_file_path`, `status` (pending, verified, rejected), `recorded_by` (user_id), `paid_at`, `timestamps`

## 4. API Structure (High Level)

### Auth
- `POST /api/login`
- `POST /api/register`
- `POST /api/password/email`

### Business Management
- `GET /api/businesses` (List my businesses)
- `POST /api/businesses`
- `GET /api/businesses/{id}`

### Resource Routes (Scoped by Business)
*All following routes typically require a selected business context.*

- **Assets**: `GET/POST/PUT/DELETE /api/businesses/{business}/assets`
- **Services**: `GET/POST/PUT/DELETE /api/businesses/{business}/services`
- **Customers**: `GET/POST/PUT/DELETE /api/businesses/{business}/customers`
- **Bookings**:
    - `GET /api/businesses/{business}/bookings` (Filters: date range, status)
    - `POST /api/businesses/{business}/bookings`
    - `GET /api/businesses/{business}/bookings/calendar` (Availability check)
- **Payments**: `POST /api/businesses/{business}/bookings/{booking}/payments`

## 5. Key Logic & Constraints
- **Availability Check:** Before creating a booking, the system must check `bookings` table for overlap on the same `asset_id` where status is NOT cancelled.
- **Double Booking Prevention:** Database transactions and pessimistic/optimistic locking when confirming dates.
- **Payment Calculation:** `(Asset Price) + sum(Service Price * Qty) = Total`.
- **Balance Due:** `Total - sum(Verified Payments)`.

## 6. Integrations (Future)
- **SMS Gateway:** For notifications (Twilio/local provider).
- **Payment Gateway:** AzamPay/Selcom/DPO (for automated mobile money).

