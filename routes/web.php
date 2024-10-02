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
use App\Livewire\Outils\Fournisseur;
use App\Models\Dossier;

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


Route::get('/', [DashboardsController::class, 'index']);

Route::get('/dossiers-import', DossiersImport::class);
Route::get('/dossiers-export', DossiersExport::class);
Route::get('/dossiers-internes', TransportsInternes::class);
Route::get('/login', Login::class);
Route::get('/chauffeurs', Chauffeur::class);
Route::get('/vehicules', Vehicule::class);
Route::get('/bureaux-de-douane', BureauDeDouane::class);
Route::get('/destinations', Destination::class);
Route::get('/marchandises', Marchandise::class);
Route::get('/clients', Client::class);
Route::get('/fournisseurs', Fournisseur::class);

Route::get('/print-dossier/{dossier}', function (Dossier $dossier){
    $dossier->print();
})->name('print-dossier');
