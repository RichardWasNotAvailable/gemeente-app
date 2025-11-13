<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dashboard extends Model
{
    use HasFactory;

    protected $table = 'klacht'; // Make sure the table name is correct
    public $timestamps = false;

    // Insert a new complaint
    public static function throwInDB($idklacht, $omschrijving, $datum)
    {
        return self::insert([ // Using Eloquent features directly
            'idklacht' => $idklacht,
            'omschrijving' => $omschrijving,
            'datum' => $datum,
        ]);
    }

    // Return the ID all unsolved complaints
    public static function returnKlachten()
    {
        return DB::table('klacht')->where('is_opgelost', false)->get();
    }

    // Return all solved complaints
    public static function returnOpgelosteKlachten()
    {
        return DB::table('klacht')->where('is_opgelost', true)->get();
    }
}