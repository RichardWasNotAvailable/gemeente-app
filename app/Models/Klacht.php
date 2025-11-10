<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Klacht extends Model
{
    protected $table = 'klacht';

    protected $fillable = [
        'melder_idmelder',
        'omschrijving',
        'klacht_type',
        'locatie',
    ];

    use HasFactory;
    
    public static function throwInDB($complainerID, $complaint, $complaintType, $location, $date){
        // Use Laravel's query builder
        return DB::table('klacht')->insert([
            'melder_idmelder' => $complainerID,
            'omschrijving' => $complaint,
            'klacht_type' => $complaintType,
            'locatie' => $location,
            'datum' => $date,
        ]);
    }
}