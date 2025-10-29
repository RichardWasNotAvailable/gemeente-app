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
  <h2>Welkom, {{ $naam }}!</h2>
  <a href="/logout">Uitloggen</a>

  <h3>📋 Klachten overzicht</h3>
  <table>
    <tr><th>Naam</th><th>Locatie</th><th>Bericht</th><th>Datum</th></tr>
    @foreach($klachten as $klacht)
      <tr>
        <td>{{ $klacht->naam }}</td>
        <td>{{ $klacht->locatie }}</td>
        <td>{{ $klacht->bericht }}</td>
        <td>{{ $klacht->created_at }}</td>
      </tr>
    @endforeach
  </table>

  <h3>Klachtenportaal - Gemeente</h3>
  <div id="map"></div>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    const map = L.map('map').setView([52.3676, 4.9041], 7); // Default: Netherlands
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const klachten = @json($klachten);

    klachten.forEach(k => {
      if (k.latitude && k.longitude) {
        L.marker([k.latitude, k.longitude])
          .addTo(map)
          .bindPopup(`<b>${k.naam}</b><br>${k.locatie}<br>${k.bericht}`);
      }
    });
  </script>
</body>
</html>
