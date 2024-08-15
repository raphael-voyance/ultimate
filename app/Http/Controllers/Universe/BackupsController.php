<?php

namespace App\Http\Controllers\Universe;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupsController extends Controller
{
    public function run() {

        try {
            $exitCode = Artisan::call('backup:run');
            $output = Artisan::output();
    
            Log::info('Backup Command Output: ', ['output' => $output]);
    
            return response()->json([
                'success' => $exitCode === 0,
                'message' => $exitCode === 0 ? 'Backup successfully initiated.' : 'Backup failed to run.',
                'output' => $output,
                'exit_code' => $exitCode
            ]);
        } catch (\Exception $e) {
            Log::error('Backup Command Error: ', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
        
    }

    public function index() {

        // Storage::disk('backups')->deleteDirectory('Raphaël Voyance');


        $zipFiles = collect(Storage::disk('backups')->files('raphael_save_bdd'))
        ->filter(function($file) {
            return Str::endsWith($file, '.zip');
        })
        ->map(function($file) {
            return [
                'name' => $file,
                'size' => Storage::disk('backups')->size($file),
                'last_modified' => Storage::disk('backups')->lastModified($file),
                'download_url' => url('admin/download-backup/' . $file),
            ];
        });

        return view('universe.backups', ['zipFiles' => $zipFiles]);
    }

    public function download($filename) {
        // Décoder le nom de fichier encodé dans l'URL
        $file = urldecode($filename);
    
        // Afficher pour vérification
        dd($file);
    
        // Vérifier si le fichier existe sur le disque 'backups'
        if (Storage::disk('backups')->exists($file)) {
            // Télécharger le fichier
            return Storage::disk('backups')->download($file);
        }
    
        // Retourner une erreur 404 si le fichier n'existe pas
        return abort(404, 'File not found');
    }
    
}
