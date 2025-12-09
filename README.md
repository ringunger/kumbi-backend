# Kumbi Project

## Project Structure
- Abstraction will be used and Most functionalities will be implemented under Services (mostly) and Models

## Packages choices:
- RBAC: @spatie/laravel-permission
- Media: @spatie/laravel-media-library
- Trends: @flowframe/laravel-trend


## Models / entities
- **User**: Authentication and system access.
- **Business**: The core tenant entity; a user can own/manage multiple businesses.
- **Asset**: Represents the social halls or venues being booked.
- **Service**: Add-on services available for bookings (e.g., Catering, DJ).
- **Customer**: The client/guest information.
- **Booking**: Central entity linking a Customer to an Asset for a specific time.
- **Payment**: Financial records linked to a Booking.
- **BusinessUser** (Pivot): Manages the relationship between Users and Businesses (Team members).
- **BookingService** (Pivot): Manages Services attached to a Booking (with specific pricing/quantity at time of booking).
