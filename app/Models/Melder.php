<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Melder extends Model{
    /** @use HasFactory<\Database\Factories\MelderFactory> */
    use HasFactory;

    public static function throwInDB($name, $email, $phone){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO melder (naam, email, mobiel) VALUES (:name, :email, :phoneNumber)");
        $stmt->bindParam(':imgLink', $imgLink, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        return $stmt->execute();
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