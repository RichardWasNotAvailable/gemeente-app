<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKlachtRequest;
use App\Http\Requests\UpdateKlachtRequest;
use App\Models\Klacht;

require_once "../Models/klacht.php";

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
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['Naam'];
                $email = $_POST['Email'];
                $phone = $_POST['Phone'];
                $complaint = $_POST['klacht'];
                $typeComplaint = $_POST['type_klacht'];

                melder::initializeDatabase();
                melder::throwInDB($name, $email, $phone); // putting the user in the database

                $complainerID = melder::getComplainerID(); // getting the ID that is generated for the complainer

                klacht::initializeDatabase();
                klacht::throwInDB($complainerID, $complaint, $typeComplaint); // putting the complaint in the database
            }
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
