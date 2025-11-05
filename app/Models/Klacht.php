<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Klacht extends Model
{
    /** @use HasFactory<\Database\Factories\KlachtFactory> */
    use HasFactory;
    
    private $ID;

    function __construct(){

    }

    public static function throwInDB($complainerID, $complaint, $complaintType, $location){
        // Use Laravel's query builder
        return DB::table('klacht')->insert([
            'melder_idmelder' => $complainerID,
            'omschrijving' => $complaint,
            'klacht_type' => $complaintType,
            'locatie' => $location,
        ]);
    }
}