<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BookingService
{
    public function getAllBookings(Request $request): Collection
    {
        return Booking::query()
            ->with('business')
            ->with('asset')
            ->with('customer')
            ->with('user')
            ->with('services')
            ->with('payments')
            ->get();
    }
}
