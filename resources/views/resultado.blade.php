<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Resultados OSM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        .table-bordered {
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Resultados del CSV</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Dispositivo</th>
                                    <th>IMEI</th>
                                    <th>Tiempo</th>
                                    <th>Placa</th>
                                    <th>Versión</th>
                                    <th>Longitud</th>
                                    <th>Latitud</th>
                                    <th>Fecha Recepción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                    <tr>
                                        <td>{{ $row['dispositivo'] }}</td>
                                        <td>{{ $row['imei'] }}</td>
                                        <td>{{ $row['tiempo'] }}</td>
                                        <td>{{ $row['placa'] }}</td>
                                        <td>{{ $row['version'] }}</td>
                                        <td>{{ $row['longitud'] }}</td>
                                        <td>{{ $row['latitud'] }}</td>
                                        <td>{{ $row['fecha_recepcion'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div id="map"></div>
                <br>
                <a href="{{ route('cargar.form') }}" class="btn btn-primary mt-3">Volver a Cargar Archivo</a>
            </div>
        </div>
    </div>

    <script>
        function initMap() {
            var map = L.map('map').setView([{{ $data[0]['longitud'] }}, {{ $data[0]['latitud'] }}], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var resultados = @json($data);

            resultados.forEach(function(resultado) {
                var marker = L.marker([resultado.longitud, resultado.latitud]).addTo(map);
                marker.bindTooltip(resultado.placa).openTooltip();
            });
        }
    </script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
        });
    </script>
</body>
</html>
