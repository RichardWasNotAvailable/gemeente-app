<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Melder extends Model{
    /** @use HasFactory<\Database\Factories\MelderFactory> */
    use HasFactory;

    protected $table = 'melder';
    public $timestamps = false;

    public static function throwInDB($name, $email, $phone)
    {
        // Use Laravel's query builder
        return DB::table('melder')->insert([
            'naam' => $name,
            'email' => $email,
            'mobiel' => $phone,
        ]);
    }

    public static function returnID($naam) {
        return DB::table('melder')->where('naam', $naam)->value('idmelder');
    }
}
