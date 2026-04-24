<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\StandsController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\VitrineController;
use Illuminate\Support\Facades\Auth; // Conservé bien qu'inutilisé
use App\Models\Produit; // Conservé bien qu'inutilisé
use App\Http\Controllers\EntrepreneursController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ForgotPasswordController;

// Routes publiques non protégées
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Routes Mot de passe oublié (OTP)
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::get('/', [VitrineController::class, 'index'])->name('vitrine.index');

// Routes publiques pour le panier
Route::get('/panier', [CommandesController::class, 'panier'])->name('commandes.panier');
Route::post('/panier/ajouter/{produit}', [CommandesController::class, 'ajouterAuPanier'])->name('commandes.ajouter-au-panier');
Route::delete('/panier/supprimer/{produit}', [CommandesController::class, 'supprimerDuPanier'])->name('commandes.supprimer-du-panier');
Route::delete('/panier/vider', [CommandesController::class, 'viderPanier'])->name('commandes.vider-panier');
Route::post('/commande/soumettre', [CommandesController::class, 'soumettreCommande'])->name('commandes.soumettre');
Route::delete('/panier/vider-historique', [App\Http\Controllers\CommandesController::class, 'viderHistorique'])->name('commandes.vider-historique');

// Routes publiques pour la vitrine
Route::get('/vitrine/stand/{stand}', [VitrineController::class, 'showStand'])->name('vitrine.stand');
Route::get('/vitrine/recherche', [VitrineController::class, 'rechercher'])->name('vitrine.recherche');

// Routes protégées (auth)
Route::middleware(['auth'])->group(function () {

    // --- Routes ADMIN en premier ---
    Route::prefix('admin')->group(function () {
        // Routes POST (doivent être avant les GET)
        Route::post('/users/{id}/approve', [AdminController::class, 'approve'])->name('admin.users.approve');
        Route::post('/users/{id}/reject', [AdminController::class, 'reject'])->name('admin.users.reject');

        // Routes GET
        Route::get('/commandes', [CommandesController::class, 'adminCommandes'])->name('admin.commandes');
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    });

    // --- Routes Produits ---
    Route::resource('produits', ProduitsController::class);

    // --- Routes Stands ---
    Route::get('stands', [StandsController::class, 'index'])->name('stands.index');
    Route::get('stands/create', [StandsController::class, 'create'])->name('stands.create');
    Route::post('stands', [StandsController::class, 'store'])->name('stands.store');
    Route::get('stands/{stand}/edit', [StandsController::class, 'edit'])->name('stands.edit');
    Route::put('stands/{stand}', [StandsController::class, 'update'])->name('stands.update');
    Route::patch('stands/{stand}', [StandsController::class, 'update']);
    Route::get('stands/{stand}', [StandsController::class, 'show'])->name('stands.show');

    // --- Routes Commandes ---
    Route::get('/commandes/historique', [CommandesController::class, 'historique'])->name('commandes.historique');
    Route::get('/commandes/{commande}', [CommandesController::class, 'show'])->name('commandes.show');

    // --- Autres routes ---
    Route::get('/attente', [EntrepreneursController::class, 'attente'])->name('attente');
    Route::get('/dashboard', [EntrepreneursController::class, 'dashboard'])->name('admin.dashboard');

    // Test email
    Route::get('/test-gmail', function() {
        Mail::raw('Test SMTP Gmail', function($m) {
            $m->to('destinataire@example.com')->subject('Test');
        });
        return "Email envoyé !";
    });
});
