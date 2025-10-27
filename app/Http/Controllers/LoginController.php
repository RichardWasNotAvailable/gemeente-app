<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedewerkersList;
use App\Http\Requests\UpdateMedewerkersPage;
use  App\Models\User;

class LoginController extends Controller{
    public function index(){
        return view("medewerker");
}
public function login(StoreMedewerkersList $request){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    medewerker:throwInDB($name, $email, $password);
}}
