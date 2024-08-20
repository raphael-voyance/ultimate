<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Spatie\Honeypot\ProtectAgainstSpam;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\LinkToolController;
use App\Http\Controllers\Galaxy\ProfileController;
use App\Http\Controllers\Galaxy\PrevisionsController;
use App\Http\Controllers\Galaxy\AppointmentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/me-consulter', [PublicController::class, 'consultations'])->name('consultations');
Route::get('/temoignages', [PublicController::class, 'testimonies'])->name('testimonies');
Route::get('/me-contacter', [PublicController::class, 'contact'])->name('contact');

Route::prefix('mon-univers')->as('my_universe.')->group(function() {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::get('/get-data-editor/{id}', [BlogController::class, 'getPostDataContent'])->name('getPostData');
    Route::get('/fetchUrl', [LinkToolController::class, 'fetchUrlData']);
    Route::get('/categorie/{slug}', [BlogController::class, 'showCategory'])->name('show.category');
});

// Route d'accés aux images du storage public.posts.thumbnails.filename
Route::get('/storage/public/posts/thumbnails/{filename}', function ($filename) {
    $path = 'posts/thumbnails/' . $filename;

    // Vérification des extensions autorisées
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $allowedExtensions = ['webp', 'jpg', 'jpeg', 'png', 'gif', 'svg'];

    if (!in_array($extension, $allowedExtensions)) {
        abort(404);
    }

    // Vérification de l'existence du fichier
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $image = Storage::disk('public')->get($path);

    // Détection du type de contenu
    $contentType = $extension === 'svg' ? 'image/svg+xml' : 'image/' . $extension;

    return response($image)->header('Content-Type', $contentType);
})->name('image.post.thumbnail');

Route::middleware([ProtectAgainstSpam::class])->group(function() {
    //Method Post Route
    Route::post('/me-contacter', [PublicController::class, 'store_contact'])->name('store_contact');
});

Route::middleware(['auth', 'verified'])->prefix('mon-espace')->as('my_space.')->group(function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/previsions', [PrevisionsController::class, 'index'])->name('previsions');
    Route::get('/get-previsions', [PrevisionsController::class, 'getPrevisions']);
    Route::post('/post-birthdate', [PrevisionsController::class, 'postBirthdate']);

    Route::get('/previsions/tarot', [PrevisionsController::class, 'tarotPage'])->name('previsions.tarot');
    Route::get('/previsions/tarot/interpretation', [PrevisionsController::class, 'getDrawInterpretation'])->name('previsions.tarot.interpretation');

    Route::get('/mes-rendez-vous', [AppointmentsController::class, 'index'])->name('appointments.index');

});

require __DIR__.'/auth.php';
require __DIR__.'/payment.php';
require __DIR__.'/admin.php';
