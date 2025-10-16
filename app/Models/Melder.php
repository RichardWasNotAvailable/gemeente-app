<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Melder extends Model{
    /** @use HasFactory<\Database\Factories\MelderFactory> */
    use HasFactory;

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
    

    public static function returnID($naam){
        global $pdo;
        $stmt = $pdo->prepare("SELECT ID FROM melder WHERE naam = :naam");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['naam'] : null;
    }
}