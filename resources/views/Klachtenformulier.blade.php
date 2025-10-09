<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klachtenpagina</title>
</head>
<body>

    <nav class="formBody">

        <form action="">
            <label for="email-adres">E-mail:</label><br>
            <input type="email" id="email-adres" name="email-adres"><br><br>
            <label for="Naam">Naam:</label><br>
            <input type="text" id="name" name="name"><br><br>
            <label for="type_klacht">Type Klacht:</label><br>
            <input type="radio" id="Klacht_vuil" name="Klacht_vuil" value="Zwerfafval">
            <label for="klacht_vuil">Zwerfafval</label><br>
            <input type="radio" id="Klacht_dood_dier" name="Klacht_dood_dier" value="Dood dier">
            <label for="Klacht_dood_dier">Dood dier</label><br>
            <input type="radio" id="Klacht_Kapot_Stoplicht" name="Klacht_Kapot_Stoplicht" value="Kapot Stoplicht">
            <label for="Klacht_Kapot_Stoplicht">Kapot Stoplicht</label><br>
            <input type="radio" id="Klacht_overig" name="Klacht_overig" value="Overig">
            <label for="klacht_overig">Overig</label><br><br>
            <label for="Klacht">Uw klacht:</label><br>
            <input type="text" id="klacht" name="klacht"><br>
            <br><input type="submit" value="Klacht Verzenden">


        </form>
    </nav>
</body>
</html>
