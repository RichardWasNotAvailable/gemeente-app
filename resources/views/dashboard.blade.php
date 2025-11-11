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
            <th>is opgelost</th>
        </tr>

        @if($klachten->isEmpty())
            <tr>
                <td colspan="3">Geen klachten beschikbaar.</td>
            </tr>
        @else
            @foreach($klachten as $klacht)
                <tr class="klacht-row">
                    <td class="klachtCell">{{ $klacht->idklacht }}</td> 
                    <td class="klachtCell">{{$klacht->klacht_type}} </td>
                    <td class="klachtCell">{{$klacht->omschrijving }}</td>
                    <td class="klachtCell">{{$klacht->datum }}</td>
                    <td class="klachtCell">
                        <button class="view-on-map" data-loc="{{ $klacht->locatie }}">
                            {{ $klacht->locatie }}
                        </button>
                    </td>

                    <td class="klachtCell">{{$klacht->is_opgelost}}
                        <button >nee</button>
                    </td>

                </tr>
            @endforeach
        @endif
    </table>

    </div>
    <div id="map"></div>
       <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="/js/map.js"></script>
</div>
</body>
</html>