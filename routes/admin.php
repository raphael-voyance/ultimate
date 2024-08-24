<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Universe\BlogController;
use App\Http\Controllers\Universe\AdminController;
use App\Http\Controllers\Universe\BackupsController;
use App\Http\Controllers\Universe\DrawsController;
use App\Http\Controllers\Universe\FilesController;
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
            Route::get('/duplicate/{id}', [BlogController::class, 'duplicate'])->name('duplicate');
            Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [BlogController::class, 'update'])->name('update');
            Route::post('/store', [BlogController::class, 'store'])->name('store');
            Route::delete('/destroy/{id}', [BlogController::class, 'destroy'])->name('destroy');
            Route::get('/get-data-editor/{id}', [BlogController::class, 'getPostDataContent'])->name('getPostData');
        });

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
    Route::get('/download-backup/raphael_save/{filename}', [BackupsController::class, 'download'])->name('download-backup');

    // Folders & Files Routes
    Route::get('/private-files/{folder?}/{file}', [FilesController::class, 'getPrivateFile'])->where('folder', '.*')->name('private-file');
    Route::get('/public-files/{folder?}/{file}', [FilesController::class, 'getPublicFile'])->where('folder', '.*')->name('public-file');

    Route::get('/list-folders', [FilesController::class, 'index'])->name('list-folders');
    Route::get('/get-files/{disk}/{folder?}', [FilesController::class, 'getFiles'])->where('folder', '.*')->name('get-files');
    Route::get('/download-file/{disk}/{folder?}/{file}', [FilesController::class, 'downloadFile'])->where('folder', '.*')->name('download-file');
    Route::get('/remove-file/{disk}/{folder}/{file}', [FilesController::class, 'removeFile'])->where('folder', '.*')->name('remove-file');

    

});

    //--------------TIPS--------------
    //--------------------------------
    // Cette Route protégées affiche
    // les images d'un disque local créé
    // 1 - Créer le disque dans le fichier: config/filesystems.php
    // 2 - Créer la route associée comme la suivante
    // 3 - Pour accéder à la ressource <img src="{{ route('image.private', ['filename' => 'image.svg']) }}" alt="Votre Image Protégée">
    
    Route::get('/private/posts/{postSlug}/{filename}', function ($postSlug, $filename) {

        $path = 'media/' . $postSlug . '/thumbnails/' . $filename; // Retrait du / au début du chemin
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowedExtensions = ['webp', 'jpg', 'jpeg', 'png', 'gif', 'svg'];
    
        $absolutePath = storage_path('app/private/media/test-thumbnail-1/bg-bloc.png');
// dd(file_exists($absolutePath));

    // dd(Storage::disk('private')->exists($path));

        // Test du chemin
        if (!in_array($extension, $allowedExtensions) || !Storage::disk('private')->exists($path)) {
            abort(404);
        }
    
        $image = Storage::disk('private')->get($path);
        $contentType = $extension === 'svg' ? 'image/svg+xml' : 'image/' . $extension;
    
        return response($image)->header('Content-Type', $contentType);
    })->middleware(['auth', 'can:admin'])->name('image.private');
