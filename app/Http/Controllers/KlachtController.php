<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKlachtRequest;
use App\Http\Requests\UpdateKlachtRequest;
use App\Models\Klacht;

class KlachtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('Klachtenformulier');
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
    public function store(StoreKlachtRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Klacht $klacht)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Klacht $klacht)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKlachtRequest $request, Klacht $klacht)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Klacht $klacht)
    {
        //
    }
}
