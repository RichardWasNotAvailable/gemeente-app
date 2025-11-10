<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    body { font-family: sans-serif; margin: 20px; }
    
  </style>
</head>
<body>
    <h3>Klachtenportaal - Gemeente</h3>

    <div class="dashboard-container">
    <div class="klacht-row">

        <h3>📋 Klachten overzicht</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>type</th>
            <th>Omschrijving</th>
            <th>Datum</th>
            <th>locatie</th>
        </tr>

        @if($klachten->isEmpty())
            <tr>
                <td colspan="3">Geen klachten beschikbaar.</td>
            </tr>
        @else
            @foreach($klachten as $klacht)
                <tr class="klacht-row">
                    <td class="klachtCell">{{ $klacht->idklacht }}</td> <!-- Corrected property access -->
                    <td class="klachtCell">{{$klacht->klacht_type}} </td>
                    <td class="klachtCell">{{$klacht->omschrijving }}</td> <!-- Ensure this matches your database schema -->
                    <td class="klachtCell">{{$klacht->datum }}</td> <!-- Display created_at if available -->
                    <td class="klachtCell">{{$klacht->locatie}} </td>
                    <td class="klachtCell">
                        <!-- Attach the raw locatie value so the map can geocode or use coordinates -->
                        <button class="view-on-map" data-loc="{{ $klacht->locatie }}">Bekijk op kaart</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </table>

        <!-- Your complaints content here -->
    </div>
    <div id="map">
        <!-- Your map content here -->
    </div>
       <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="/js/map.js"></script>
</div>
</body>
</html>