<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CustomerService
{
    public function getAllCustomers(Request $request): Collection
    {
        return Customer::query()
            ->with('business')
            ->with('bookings')
            ->get();
    }
}
