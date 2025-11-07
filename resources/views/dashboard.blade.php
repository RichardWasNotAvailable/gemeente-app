<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    body { font-family: sans-serif; margin: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    table, th, td { border: 1px solid #ccc; padding: 8px; }
    #map { height: 500px; margin-top: 20px; border-radius: 8px; }
  </style>
</head>
<body>
    <h3>📋 Klachten overzicht</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Omschrijving</th>
            <th>Datum</th> <!-- Column for date, assuming this is required -->
        </tr>
        @if($klachten->isEmpty())
            <tr>
                <td colspan="3">Geen klachten beschikbaar.</td>
            </tr>
        @else
            @foreach($klachten as $klacht)
                <tr>
                    <td>{{ $klacht->idklacht }}</td> <!-- Corrected property access -->
                    <td>{{ $klacht->omschrijving }}</td> <!-- Ensure this matches your database schema -->
                    <td>{{ $klacht->created_at ?? 'N/A' }}</td> <!-- Display created_at if available -->
                </tr>
            @endforeach
        @endif
    </table>

    <h3>Klachtenportaal - Gemeente</h3>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="/js/map.js"></script>
</body>
</html>
