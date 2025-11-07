<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medewerker extends Model
{
    protected $table = 'medewerkers';
    protected $primaryKey = 'MedewerkerID';
    protected $fillable = ['Naam', 'email', 'wachtwoord'];
    protected $hidden = ['wachtwoord'];
    public $timestamps = true;
};