<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Universe\AdminController;
use App\Http\Controllers\Universe\MessagingController;
use App\Http\Controllers\Universe\DrawsController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
|
*/

// Route::middleware(['auth', 'admin'])->prefix('test')->as('test.')->group(function() {

//     Route::get('/', [AdminController::class, 'index'])->name('index');
// });

Route::prefix('admin')->as('admin.')->group(function() {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    // DRAWS ROUTES
    Route::prefix('draw')->as('draw.')->group(function() {
        Route::get('/', [DrawsController::class, 'index'])->name('index');
        Route::get('/create', [DrawsController::class, 'create'])->name('create');
        Route::get('/edit/{name}', [DrawsController::class, 'edit'])->name('edit');
    });

    Route::get('/messagerie', [MessagingController::class, 'index'])->name('messaging');

    //--------------TIPS--------------
    //--------------------------------
    // Cette Route protégées affiche
    // les images d'un disque local créé
    // 1 - Créer le disque dans le fichier: config/filesystems.php
    // 2 - Créer la route associée comme la suivante
    // 3 - Pour accéder à la ressource <img src="{{ route('image.protected', ['filename' => 'image.svg']) }}" alt="Votre Image Protégée">
    Route::get('/image/{filename}', function ($filename) {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg']; // Définir les extensions autorisées ici

        // Vérifier si l'extension est autorisée
        if (in_array($extension, $allowedExtensions)) {
            $image = Storage::disk('protected')->get($filename);

            if ($extension === 'svg') {
                $contentType = 'image/svg+xml';
            } else {
                $contentType = 'image/' . $extension;
            }

            return response($image)->header('Content-Type', $contentType);
        } else {
            abort(404); // Ou une autre réponse appropriée pour les extensions non autorisées
        }
    })->name('image.protected');

});
