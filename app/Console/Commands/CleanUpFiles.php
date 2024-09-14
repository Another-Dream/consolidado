<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Certificado;
use App\Models\Cotizacion;

class CleanUpFiles extends Command
{
    protected $signature = 'cleanup:files';
    protected $description = 'Eliminar archivos huérfanos en certificados y cotizaciones';

    public function handle()
    {
        // Directorios donde están los archivos
        $certificadosDirectory = 'public/certificados';
        $cotizacionesDirectory = 'public/cotizaciones';

        // Archivos registrados en la base de datos
        $certificadosFiles = Certificado::pluck('archivo')->toArray();
        $cotizacionesFiles = Cotizacion::pluck('archivo')->toArray();

        // Eliminar archivos huérfanos de certificados
        $this->deleteOrphanFiles($certificadosDirectory, $certificadosFiles);

        // Eliminar archivos huérfanos de cotizaciones
        $this->deleteOrphanFiles($cotizacionesDirectory, $cotizacionesFiles);

        $this->info('Archivos huérfanos eliminados correctamente.');
    }

    protected function deleteOrphanFiles($directory, $filesInDatabase)
    {
        // Obtener todos los archivos en el directorio
        $allFiles = Storage::files($directory);

        foreach ($allFiles as $file) {
            // Comparar si el archivo está registrado en la base de datos
            $filePath = str_replace('public/', '', $file); // Ajuste para coincidir con la ruta almacenada

            if (!in_array($filePath, $filesInDatabase)) {
                // Si no está en la base de datos, eliminarlo
                Storage::delete($file);
                $this->info("Eliminado archivo huérfano: $file");
            }
        }
    }
}
