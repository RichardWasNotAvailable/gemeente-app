<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klachtenpagina</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<body>

<nav class="topBar">
    <li>
        <a href="/">Home</a>
        <a href="/klacht">Klachtenformulier</a>
    </li>
</nav>

<nav class="formBody">
    <form id="complaintForm" action="{{ route('klacht.store') }}" method="post">
        @csrf
        <label for="email-adres">E-mail:</label><br>
        <input type="email" id="email-adres" name="email-adres" required><br><br>

        <label for="name">Naam:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="Telefoonnummer">Telefoonnummer:</label><br>
        <input type="tel" id="Telefoonnummer" name="Telefoonnummer" pattern="[0-9]{10}" required><br><br>

        <label for="streetName">Straatnaam:</label><br>
        <input type="text" id="streetName" required><br><br>

        <div id="map" style="height: 500px;"></div><br><br>

        <label for="klacht">Type Klacht:</label><br>
        <select name="klacht" id="klacht" required>
            <option value="" selected>- Kies uw klacht -</option>
            <option value="Zwerfafval">Zwerfafval</option>
            <option value="Dood_Dier">Dood dier</option>
            <option value="Kapot_Stoplicht">Kapot Stoplicht</option>
            <option value="Overig">Overig</option>
        </select><br><br>

        <label for="klachtText">Uw klacht:</label><br>
        <textarea id="klachtText" name="klachtText" rows="4" cols="50" required></textarea><br><br>

        <input class="verzendknop" type="submit" value="Klacht Verzenden">
    </form>
</nav>

<script src="/js/map.js"></script>
</body>
</html>
