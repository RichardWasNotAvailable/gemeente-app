<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klachtenpagina</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<nav class="topBar">
<li>
    <a href="/">Home</a>
    <a href="/klacht">Klachtenformulier</a>
</li>
</nav>
    <nav class="formBody">
    <form action="">
            <label for="email-adres">E-mail:</label><br>
            <input type="email" id="email-adres" name="email-adres" required><br><br>
            <label for="Naam">Naam:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            <label for="Telefoonnummer">Telefoonnummer:</label><br>
            <input  type="tel" name="Telefoonummer" id="Telefoonnummer" pattern="[0-9]{10}" required><br><br>
             <label for="klacht" required>Type Klacht:</label><br>
             <select name="klacht" id="klacht">
                <option value="KiesKlacht" selected>-Kies uw klacht-</option>
                <option value="Zwerfafval">Zwerfafval</option>
                <option value="Dood_Dier">Dood dier</option>
                <option value="Kapot_Stoplicht">Kapot Stoplicht</option>
                <option value="Overig">Overig</option>
                </select><br><br>
                <label  for="Klacht" required>Uw klacht:</label><br>
                 <textarea rows="4" cols="50">
                </textarea><br><br>
<input class="verzendknop" type="submit" value="Klacht Verzenden">


        </form>
    </nav>
</body>
</html>
