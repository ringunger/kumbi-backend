<?php

namespace App\Services;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PaymentService
{
    public function getAllPayments(Request $request): Collection
    {
        return Payment::query()
            ->with('booking')
            ->with('business')
            ->with('recorder')
            ->get();
    }
}
