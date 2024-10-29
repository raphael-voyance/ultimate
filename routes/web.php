<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Spatie\Honeypot\ProtectAgainstSpam;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PublicController;
use App\Concern\StatusAppointmentNotifications;
use App\Http\Controllers\Galaxy\ProfileController;
use App\Http\Controllers\Galaxy\PrevisionsController;
use App\Http\Controllers\Galaxy\AppointmentsController;
use App\Http\Controllers\Galaxy\DashboardController;
use App\Http\Controllers\Galaxy\NotificationsController;

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

//Public
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/me-consulter', [PublicController::class, 'consultations'])->name('consultations');
Route::get('/temoignages', [PublicController::class, 'testimonies'])->name('testimonies');
Route::get('/me-contacter', [PublicController::class, 'contact'])->name('contact');

//Blog
Route::prefix('mon-univers')->as('my_universe.')->group(function() {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/article/{slug}', [BlogController::class, 'show'])->name('show');
    Route::get('/get-data-editor/{id}', [BlogController::class, 'getPostDataContent'])->name('getPostData');
    Route::get('/categorie/{slug}', [BlogController::class, 'showCategory'])->name('show.category');

    Route::post('/article/getImage', [ImageController::class, 'getImage']);
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

//Tarot
Route::prefix('tarot')->as('tarot.')->group(function() {
    Route::get('/', [PrevisionsController::class, 'tarotPage'])->name('index');
    Route::get('/interpretation', [PrevisionsController::class, 'getDrawInterpretation'])->name('interpretation');
    Route::get('/tirage/{id}', [PrevisionsController::class, 'getDrawCards'])->name('get-draw-cards');
    Route::get('/tirages', [PrevisionsController::class, 'drawCardsIndex'])->name('draw-cards-index');
    Route::post('/save-draw-cards', [PrevisionsController::class, 'saveDraw'])->name('save-draw-cards');
});

Route::middleware(['auth', 'verified'])->prefix('mon-espace')->as('my_space.')->group(function() {
    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    //Profile
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Previsions
    Route::get('/previsions', [PrevisionsController::class, 'index'])->name('previsions');
    Route::get('/get-previsions', [PrevisionsController::class, 'getPrevisions']);
    Route::post('/post-birthdate', [PrevisionsController::class, 'postBirthdate']);

    //RDV
    Route::get('/mes-rendez-vous', [AppointmentsController::class, 'index'])->name('appointments.index');
    Route::get('/mes-rendez-vous/{invoice_token}', [StatusAppointmentNotifications::class, 'redirectToAppointment'])->name('appointment.view');
    Route::get('/rendez-vous/{user_name}/{appointment_id}', [AppointmentsController::class, 'show'])->name('appointment.show');
    Route::delete('/mes-rendez-vous/{payment_invoice_token}', [AppointmentsController::class, 'delete'])->name('appointment.delete');

    //Notifications
    Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/get', [NotificationsController::class, 'get'])->name('notifications.get');
    Route::post('/notification/mark-as-read', [NotificationsController::class, 'markAsRead'])->name('notifications.markasread');

});

require __DIR__.'/auth.php';
require __DIR__.'/payment.php';
require __DIR__.'/admin.php';
