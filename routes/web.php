<?php

use App\Models\Depot;
use App\Livewire\Home;

use App\Livewire\Login;
use App\Models\Dossier;
use App\Livewire\Caisse;
use App\Livewire\BonDeCaisse;
use App\Livewire\Outils\User;
use App\Livewire\UserProfile;
use GuzzleHttp\Promise\Create;
use App\Livewire\Outils\Client;
use App\Livewire\DossiersExport;
use App\Livewire\DossiersImport;
use App\Livewire\Outils\Profile;
use App\Models\TransportInterne;
use App\Livewire\Outils\Vehicule;
use App\Livewire\Outils\Chauffeur;
use App\Livewire\Outils\Destination;
use App\Livewire\Outils\Fournisseur;
use App\Livewire\Outils\Marchandise;
use App\Livewire\TransportsInternes;
use Illuminate\Support\Facades\Route;
use App\Livewire\Outils\BureauDeDouane;
use App\Models\BonDeCaisse as ModelsBonDeCaisse;

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


Route::get('/login', Login::class)->name('login');
Route::get('/', Home::class)->middleware("auth");

Route::get('/dossiers-import', DossiersImport::class)->middleware("auth");
Route::get('/dossiers-export', DossiersExport::class)->middleware("auth");
Route::get('/dossiers-internes', TransportsInternes::class)->middleware("auth");
Route::get('/chauffeurs', Chauffeur::class)->middleware("auth");
Route::get('/vehicules', Vehicule::class)->middleware("auth");
Route::get('/bureaux-de-douane', BureauDeDouane::class)->middleware("auth");
Route::get('/destinations', Destination::class)->middleware("auth");
Route::get('/marchandises', Marchandise::class)->middleware("auth");
Route::get('/clients', Client::class);
Route::get('/fournisseurs', Fournisseur::class)->middleware("auth");


Route::get('/users', User::class)->middleware("auth");
Route::get('/roles', Profile::class)->middleware("auth");
Route::get('/profile', UserProfile::class)->middleware("auth");


Route::get('/bons-de-caisse', BonDeCaisse::class)->middleware("auth");

Route::get('/caisse', Caisse::class)->middleware("auth");



Route::get('/print-dossier/{dossier}', function (Dossier $dossier){
    $dossier->print();
})->name('print-dossier')->middleware("auth");

Route::get('/print-bon/{bon}', function (ModelsBonDeCaisse $bon){
    $bon->print();
})->name('print-bon')->middleware("auth");

Route::get('/print-depot/{depot}', function (Depot $depot){
    $depot->print();
})->name('print-depot')->middleware("auth");

Route::get('/print-transport/{dossier}', function (TransportInterne $dossier){
    $dossier->print();
})->name('print-transport')->middleware("auth");

Route::get('/print-delivery/{dossier}', function (Dossier $dossier){
    $dossier->print_delivery_slip();
})->name('print-delivery')->middleware("auth");