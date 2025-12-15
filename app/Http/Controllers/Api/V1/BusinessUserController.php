<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusinessUserRequest;
use App\Http\Requests\UpdateBusinessUserRequest;
use App\Models\BusinessUser;

class BusinessUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BusinessUser $businessUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusinessUser $businessUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessUserRequest $request, BusinessUser $businessUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusinessUser $businessUser)
    {
        //
    }
}
