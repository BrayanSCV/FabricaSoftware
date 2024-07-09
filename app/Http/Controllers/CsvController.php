<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PuntoGps;
use Illuminate\Support\Facades\DB;

class CsvController extends Controller
{
    public function showUploadForm()
    {
        return view('cargar');
    }

    public function processUpload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        DB::table('puntos_gps')->truncate();
        
        $file = $request->file('csv_file');
        $data = [];

        if (($handle = fopen($file, 'r')) !== false) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                $line = rtrim($line, ']');
                $line_parts = explode(',', $line);

                $modelo = trim(trim($line_parts[0], '*'), '"');
                $imei = $line_parts[1];
                $tiempo = $line_parts[2];
                $placa_info = explode(':', $line_parts[4])[1];
                $placa = explode(';', $placa_info);
                $version_firmware = explode(';', $line_parts[4])[1];

                $gps_data = explode(';', explode(':', $line_parts[5])[1]);
                $longitud = str_replace('N', '', $gps_data[2]);
                $latitud = str_replace('W', '-', $gps_data[3]);

                $fecha_recepcion = substr($line, strpos($line, '[') + 1);
                $fecha_final = trim(str_replace(']', '', $fecha_recepcion), '"');

                $data[] = [
                    'dispositivo' => $modelo,
                    'imei' => $imei,
                    'tiempo' => $tiempo,
                    'placa' => $placa[0],
                    'version' => $version_firmware,
                    'longitud' => $longitud,
                    'latitud' => $latitud,
                    'fecha_recepcion' => $fecha_final
                ];

                // Guardar cada registro en la base de datos
                PuntoGps::create([
                    'dispositivo' => $modelo,
                    'imei' => $imei,
                    'tiempo' => $tiempo,
                    'placa' => $placa[0],
                    'version' => $version_firmware,
                    'longitud' => $longitud,
                    'latitud' => $latitud,
                    'fecha_recepcion' => $fecha_final
                ]);
            }
            fclose($handle);
        }

        return view('resultado', compact('data'));
    }


}
