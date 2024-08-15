<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Universe\BlogController;
use App\Http\Controllers\Universe\AdminController;
use App\Http\Controllers\Universe\BackupsController;
use App\Http\Controllers\Universe\DrawsController;
use App\Http\Controllers\Universe\TarotController;
use App\Http\Controllers\Universe\MessagingController;
use App\Http\Controllers\Universe\NumerologyController;

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

    // TAROT ROUTES
    Route::prefix('tarot')->as('tarot.')->group(function() {
        Route::get('/', [TarotController::class, 'index'])->name('index');
        Route::get('/{slug}', [TarotController::class, 'view'])->name('view');
        Route::put('/update/{slug}', [TarotController::class, 'update'])->name('update');
    });

    // NUMEROLOGY ROUTES
    Route::prefix('numerology')->as('numerology.')->group(function() {
        Route::get('/', [NumerologyController::class, 'index'])->name('index');
        Route::get('/{number}', [NumerologyController::class, 'view'])->name('view');
        Route::put('/update/{number}', [NumerologyController::class, 'update'])->name('update');
    });

    // MESSAGERIE ROUTES
    Route::get('/messagerie', [MessagingController::class, 'index'])->name('messaging');

    // POSTS ROUTES
    Route::prefix('blog')->as('blog.')->group(function() {
        Route::prefix('post')->as('post.')->group(function() {
            Route::get('/all', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [BlogController::class, 'update'])->name('update');
            Route::post('/store', [BlogController::class, 'store'])->name('store');
            Route::delete('/destroy/{id}', [BlogController::class, 'destroy'])->name('destroy');
        });
        

        Route::get('/post/get-data-editor/{id}', [BlogController::class, 'getPostDataContent']);

        Route::prefix('category')->as('category.')->group(function() {
            Route::get('/all', [BlogController::class, 'indexCategory'])->name('index');
            Route::get('/create', [BlogController::class, 'createCategory'])->name('create');
            Route::post('/store', [BlogController::class, 'storeCategory'])->name('store');
            Route::get('/edit/{id}', [BlogController::class, 'editCategory'])->name('edit');
            Route::post('/update/{id}', [BlogController::class, 'updateCategory'])->name('update');
            Route::delete('/destroy/{id}', [BlogController::class, 'destroyCategory'])->name('destroy');
        });
    });

    // Backups Routes
    Route::post('/run-backup', [BackupsController::class, 'run'])->name('run-backup');
    Route::get('/list-backups', [BackupsController::class, 'index'])->name('list-backups');

});

    //--------------TIPS--------------
    //--------------------------------
    // Cette Route protégées affiche
    // les images d'un disque local créé
    // 1 - Créer le disque dans le fichier: config/filesystems.php
    // 2 - Créer la route associée comme la suivante
    // 3 - Pour accéder à la ressource <img src="{{ route('image.private', ['filename' => 'image.svg']) }}" alt="Votre Image Protégée">
    
    Route::get('/storage/private/images/{filename}', function ($filename) {
        $path = 'images/' . $filename;  // Assure-toi d'utiliser le bon chemin relatif
    
        // Vérification des extensions autorisées
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $allowedExtensions = ['webp', 'jpg', 'jpeg', 'png', 'gif', 'svg'];
    
        if (!in_array($extension, $allowedExtensions)) {
            abort(404);
        }
    
        // Vérification de l'existence du fichier
        if (!Storage::disk('private')->exists($path)) {
            abort(404);
        }
    
        $image = Storage::disk('private')->get($path);
    
        // Détection du type de contenu
        $contentType = $extension === 'svg' ? 'image/svg+xml' : 'image/' . $extension;
    
        return response($image)->header('Content-Type', $contentType);
    })->middleware(['auth', 'can:admin'])->name('image.private');
