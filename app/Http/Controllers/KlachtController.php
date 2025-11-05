<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKlachtRequest;
use App\Http\Requests\UpdateKlachtRequest;
use App\Models\Klacht;
use App\Models\Melder;

class KlachtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Klachtenformulier');
    }

    public function store(StoreKlachtRequest $request)
    {
        $name = $_POST['name'];
        $email = $_POST['email-adres'];
        $phone = $_POST['Telefoonnummer'];
        $complaint = $_POST['klachtText'];
        $typeComplaint = $_POST['klachtType'];
        $streetName = $_POST['straatNaam'];

        melder::throwInDB($name, $email, $phone); // putting the user in the database

        $complainerID = melder::returnID($name); // getting the ID that is generated for the complainer

        klacht::throwInDB($complainerID, $complaint, $typeComplaint, $streetName); // putting the complaint in the database
        return redirect()->route('klacht');
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
