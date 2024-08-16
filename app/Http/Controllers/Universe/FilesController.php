<?php

namespace App\Http\Controllers\Universe;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{

    // Lister les dossiers public / private ....
    public function index() {
    $disks = Config::get('filesystems.disks');

    // Filtrer les disques cachés
    $visibleDisks = array_filter($disks, function ($disk) {
        return !($disk['hidden'] ?? false); // N'affiche pas les disques où 'hidden' est true
    });
    // dd($visibleDisks);
    return view('universe.files.list-folders', ['disks' => $visibleDisks]);

    }

    // Route::get('/get-files/{folder}', [FilesController::class, 'getFiles'])->name('get-files');
    public function getFiles(string $disk, string $folder = '')
    {
        // Vérifie que le disque existe
        $disks = config('filesystems.disks');
        if (!array_key_exists($disk, $disks)) {
            abort(404, 'Disque introuvable');
        }
    
        // Récupère les sous-dossiers et fichiers dans le dossier spécifié
        $directories = Storage::disk($disk)->directories($folder);
        $files = Storage::disk($disk)->files($folder);
    
        // Retourne une vue pour afficher le contenu du dossier et les fichiers
        return view('universe.files.list', compact('disk', 'folder', 'directories', 'files'));
    }

    public function downloadFile(string $folder, string $filename) {
        $file = 'raphael_save/' . $filename;

        // Afficher pour vérification
        // dd($file);
    
        // Vérifier si le fichier existe sur le disque 'backups'
        if (Storage::disk('backups')->exists($file)) {
            // Télécharger le fichier
            return Storage::disk('backups')->download($file);
        }
        
        // Retourner une erreur 404 si le fichier n'existe pas
        return abort(404, 'File not found');
    }

    public function removeFile(string $folder, string $filename) {

    }
}
