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

    public function getPrivateFile($folder, $file)
    {
        $path = '/' . $folder . '/' . $file;
    
        // Vérification des extensions autorisées
        // $extension = pathinfo($file, PATHINFO_EXTENSION);
        // $allowedExtensions = ['webp', 'jpg', 'jpeg', 'png', 'gif', 'svg'];
    
        // if (!in_array($extension, $allowedExtensions)) {
        //     abort(404);
        // }
    
        // Vérification de l'existence du fichier
        if (!Storage::disk('private')->exists($path)) {
            abort(404);
        }
    
        // $image = Storage::disk('private')->get($path);
        $fileContent = Storage::disk('private')->get($path);
        $mimeType = Storage::disk('private')->mimeType($path);

        return response($fileContent)->header('Content-Type', $mimeType);

    }

    public function getPublicFile($folder, $file)
    {
        $path = '/' . $folder . '/' . $file;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        $fileContent = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);
        return response($fileContent)->header('Content-Type', $mimeType);
    }

    // Route::get('/get-files/{disk}/{folder?}', [FilesController::class, 'getFiles'])->name('get-files');
    public function getFiles(string $disk, string $folder = '')
    {
        // Vérifie que le disque existe
        $disks = Config::get('filesystems.disks');
        if (!array_key_exists($disk, $disks)) {
            abort(404, 'Disque introuvable');
        }
    
        // Récupère les sous-dossiers et fichiers dans le dossier spécifié
        $directories = Storage::disk($disk)->directories($folder);
        $files = Storage::disk($disk)->files($folder);
    
        // Liste des extensions non visibles
        $extensionsNotVisibles = ['gitignore'];
    
        // Filtrer les fichiers pour exclure ceux avec des extensions non visibles
        $files = array_filter($files, function($file) use ($extensionsNotVisibles) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            return !in_array($extension, $extensionsNotVisibles);
        });
    
        if ($folder == '') {
            $folder = $disk;
        }
    
        // Retourne une vue pour afficher le contenu du dossier et les fichiers
        return view('universe.files.list', compact('disk', 'folder', 'directories', 'files'));
    }

    public function downloadFile(string $disk, string $folder, string $file) {

        $file = $folder . '/' . $file;

        // Afficher pour vérification
        // dd($file);
    
        // Vérifier si le fichier existe sur le disque 'backups'
        if (Storage::disk($disk)->exists($file)) {
            // Télécharger le fichier
            return Storage::disk($disk)->download($file);
        }
        
        // Retourner une erreur 404 si le fichier n'existe pas
        return abort(404, 'File not found');
    }

    public function removeFile(string $disk, string $folder, string $file)
    {
        $filePath = $folder . '/' . $file;

        // dd($filePath);

        // Vérifier si le fichier existe sur le disque spécifié
        if (Storage::disk($disk)->exists($filePath)) {
            // Suppression du fichier
            Storage::disk($disk)->delete($filePath);

            // Retourner une réponse de succès ou redirection
            return response()->json(['message' => 'File deleted successfully'], 200);
        }

        // Retourner une erreur 404 si le fichier n'existe pas
        return abort(404, 'File not found');
    }
}
