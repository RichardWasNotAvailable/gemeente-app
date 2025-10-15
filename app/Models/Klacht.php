<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klacht extends Model
{
    /** @use HasFactory<\Database\Factories\KlachtFactory> */
    use HasFactory;

    private $ID;

    function __construct(){

    }

    public static function throwInDB($complainerID, $complaint, $complaintType){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO klacht (melder_idmelder, omschrijving) VALUES (:complainerID, :complaint)");
        $stmt->bindParam(':imgLink', $imgLink, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        echo "test <br>";
        return $stmt->execute();
    }
}