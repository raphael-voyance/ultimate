<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Universe\AdminController;
use App\Http\Controllers\Universe\DrawsController;
use App\Http\Controllers\Universe\MessagingController;
use App\Http\Controllers\Universe\TarotController;

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

Route::prefix('admin')->as('admin.')->middleware(['auth', 'can:admin'])->group(function() {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    // DRAWS ROUTES
    Route::prefix('draw')->as('draw.')->group(function() {
        Route::get('/', [DrawsController::class, 'index'])->name('index');
        Route::get('/create', [DrawsController::class, 'create'])->name('create');
        Route::post('/store', [DrawsController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [DrawsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [DrawsController::class, 'update'])->name('update');
        Route::post('/save-keywords', [DrawsController::class, 'saveKeywords'])->name('save.keywords');
        Route::delete('/destroy/{id}', [DrawsController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('tarot')->as('tarot.')->group(function() {
        Route::get('/', [TarotController::class, 'index'])->name('index');
        Route::get('/{slug}', [TarotController::class, 'view'])->name('view');
        Route::put('/update/{slug}', [TarotController::class, 'update'])->name('update');
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
