# Alate Development Workplan

This document outlines the step-by-step plan to build the Alate backend.

## Phase 1: Foundation & Authentication
- [ ] **Project Setup**: Verify Laravel installation, configure `.env`, set up Git repo.
- [ ] **Database Setup**: Configure MySQL connection.
- [ ] **User Model**: Migration and Model for `User`.
- [ ] **Authentication API**: Implement Login, Register, Logout using Sanctum.
- [ ] **Testing**: Write Feature tests for Auth endpoints.

## Phase 2: Multi-Tenancy (Business Management)
- [ ] **Business Model**: Create `Business` migration and model.
- [ ] **Business-User Relationship**: Create pivot table `business_user` with roles.
- [ ] **Business CRUD**: API endpoints to create, update, list businesses for the logged-in user.
- [ ] **Middleware**: Create `CheckBusinessAccess` middleware to ensure users only access their own business data.
- [ ] **Testing**: Unit tests for relationship logic and permissions.

## Phase 3: Asset & Service Management
- [ ] **Assets Module**: Migration, Model, Controller for `Asset` (Social Halls).
    - [ ] Handle image upload logic (storage/linking).
- [ ] **Services Module**: Migration, Model, Controller for `Service` (Add-ons).
- [ ] **Scoped Access**: Ensure Assets/Services are always retrieved via `business_id`.
- [ ] **Testing**: Feature tests for creating and listing assets/services.

## Phase 4: CRM (Customers)
- [ ] **Customer Model**: Migration and Model.
- [ ] **Customer CRUD**: Endpoints to manage client database.
- [ ] **Testing**: Verify customers are isolated by business.

## Phase 5: The Booking Engine (Core)
- [ ] **Booking Model**: Migration with status enums and dates.
- [ ] **Booking Logic**: Implement `AvailabilityService` to check for date overlaps.
- [ ] **Create Booking**: API to store booking details, link customer, and calculate totals.
- [ ] **Booking Services**: Logic to attach services to a booking.
- [ ] **Calendar View**: Endpoint to return bookings in a format suitable for a calendar UI (e.g., array of events).
- [ ] **Testing**: Critical tests for double-booking scenarios and overlap detection.

## Phase 6: Financials & Payments
- [ ] **Payment Model**: Migration for tracking transaction records.
- [ ] **Payment Logic**: Endpoint to record a payment (upload proof, set amount).
- [ ] **Balance Calculation**: Logic/Accessor to calculate `remaining_balance` for a booking.
- [ ] **Dashboard Stats**: Endpoint to aggregate revenue, occupancy, and pending bookings.

## Phase 7: Refinement & Localization
- [ ] **Localization**: Set up `lang/sw` files and implement `Accept-Language` header handling.
- [ ] **API Documentation**: Generate API docs (Scribe or Swagger) if needed.
- [ ] **Seeders**: Create robust seeders for demo data.
