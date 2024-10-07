<?php

use App\Livewire\Login;

use App\Livewire\Outils\Client;
use App\Livewire\DossiersExport;
use App\Livewire\DossiersImport;
use App\Livewire\Outils\Vehicule;
use App\Livewire\Outils\Chauffeur;
use App\Livewire\Outils\Destination;
use App\Livewire\Outils\Marchandise;
use App\Livewire\TransportsInternes;
use Illuminate\Support\Facades\Route;
use App\Livewire\Outils\BureauDeDouane;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\IconsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\WidgetsController;
use App\Http\Controllers\ElementsController;
use App\Http\Controllers\AdvanceduiController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\DashboardsController;
use App\Livewire\Home;
use App\Livewire\Outils\CreateProfile;
use App\Livewire\Outils\Fournisseur;
use App\Livewire\Outils\Profile;
use App\Livewire\Outils\User;
use App\Models\Dossier;
use App\Models\TransportInterne;
use GuzzleHttp\Promise\Create;

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
Route::get('/new-role', CreateProfile::class)->middleware("auth");



Route::get('/print-dossier/{dossier}', function (Dossier $dossier){
    $dossier->print();
})->name('print-dossier')->middleware("auth");

Route::get('/print-transport/{dossier}', function (TransportInterne $dossier){
    $dossier->print();
})->name('print-transport')->middleware("auth");
