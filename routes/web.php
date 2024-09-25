<?php

use App\Livewire\Login;

use App\Livewire\DossiersExport;
use App\Livewire\DossiersImport;
use App\Livewire\TransportsInternes;
use Illuminate\Support\Facades\Route;
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

Route::get('index', [DashboardsController::class, 'index']);
Route::get('index2', [DashboardsController::class, 'index2']);
Route::get('index3', [DashboardsController::class, 'index3']);
Route::get('index4', [DashboardsController::class, 'index4']);
Route::get('index5', [DashboardsController::class, 'index5']);


Route::get('widgets', [WidgetsController::class, 'widgets']);


Route::get('maps', [MapsController::class, 'maps']);
Route::get('maps1', [MapsController::class, 'maps1']);
Route::get('maps2', [MapsController::class, 'maps2']);


Route::get('cards', [ComponentsController::class, 'cards']);
Route::get('calendar', [ComponentsController::class, 'calendar']);
Route::get('calendar2', [ComponentsController::class, 'calendar2']);
Route::get('chat', [ComponentsController::class, 'chat']);
Route::get('notify', [ComponentsController::class, 'notify']);
Route::get('sweetalert', [ComponentsController::class, 'sweetalert']);
Route::get('rangeslider', [ComponentsController::class, 'rangeslider']);
Route::get('scroll', [ComponentsController::class, 'scroll']);
Route::get('loaders', [ComponentsController::class, 'loaders']);
Route::get('counters', [ComponentsController::class, 'counters']);
Route::get('rating', [ComponentsController::class, 'rating']);
Route::get('timeline', [ComponentsController::class, 'timeline']);
Route::get('treeview', [ComponentsController::class, 'treeview']);


Route::get('alerts', [ElementsController::class, 'alerts']);
Route::get('buttons', [ElementsController::class, 'buttons']);
Route::get('colors', [ElementsController::class, 'colors']);
Route::get('avatarsquare', [ElementsController::class, 'avatarsquare']);
Route::get('avatar-round', [ElementsController::class, 'avatar_round']);
Route::get('avatar-radius', [ElementsController::class, 'avatar_radius']);
Route::get('dropdown', [ElementsController::class, 'dropdown']);
Route::get('list', [ElementsController::class, 'list']);
Route::get('tags', [ElementsController::class, 'tags']);
Route::get('toast', [ElementsController::class, 'toast']);
Route::get('pagination', [ElementsController::class, 'pagination']);
Route::get('navigation', [ElementsController::class, 'navigation']);
Route::get('typography', [ElementsController::class, 'typography']);
Route::get('breadcrumbs', [ElementsController::class, 'breadcrumbs']);
Route::get('badge', [ElementsController::class, 'badge']);
Route::get('panels', [ElementsController::class, 'panels']);
Route::get('thumbnails', [ElementsController::class, 'thumbnails']);


Route::get('mediaobject', [AdvanceduiController::class, 'mediaobject']);
Route::get('accordion', [AdvanceduiController::class, 'accordion']);
Route::get('tabs', [AdvanceduiController::class, 'tabs']);
Route::get('chart', [AdvanceduiController::class, 'chart']);
Route::get('modal', [AdvanceduiController::class, 'modal']);
Route::get('tooltipandpopover', [AdvanceduiController::class, 'tooltipandpopover']);
Route::get('progress', [AdvanceduiController::class, 'progress']);
Route::get('carousel', [AdvanceduiController::class, 'carousel']);
Route::get('footers', [AdvanceduiController::class, 'footers']);
Route::get('users-list', [AdvanceduiController::class, 'users_list']);
Route::get('search', [AdvanceduiController::class, 'search']);
Route::get('crypto-currencies', [AdvanceduiController::class, 'crypto_currencies']);


// Route::get('login', [PagesController::class, 'login']);
Route::get('register', [PagesController::class, 'register']);
Route::get('forgot-password', [PagesController::class, 'forgot_password']);
Route::get('lockscreen', [PagesController::class, 'lockscreen']);
Route::get('error400', [PagesController::class, 'error400']);
Route::get('error401', [PagesController::class, 'error401']);
Route::get('error403', [PagesController::class, 'error403']);
Route::get('error404', [PagesController::class, 'error404']);
Route::get('error500', [PagesController::class, 'error500']);
Route::get('error503', [PagesController::class, 'error503']);
Route::get('file-manager', [PagesController::class, 'file_manager']);
Route::get('filemanager-list', [PagesController::class, 'filemanager_list']);
Route::get('filemanager-details', [PagesController::class, 'filemanager_details']);
Route::get('file-attachments', [PagesController::class, 'file_attachments']);
Route::get('shop', [PagesController::class, 'shop']);
Route::get('shop-description', [PagesController::class, 'shop_description']);
Route::get('cart', [PagesController::class, 'cart']);
Route::get('add-product', [PagesController::class, 'add_product']);
Route::get('wishlist', [PagesController::class, 'wishlist']);
Route::get('checkout', [PagesController::class, 'checkout']);
Route::get('blog', [PagesController::class, 'blog']);
Route::get('blog-details', [PagesController::class, 'blog_details']);
Route::get('blog-post', [PagesController::class, 'blog_post']);
Route::get('profile', [PagesController::class, 'profile']);
Route::get('editprofile', [PagesController::class, 'editprofile']);
Route::get('email', [PagesController::class, 'email']);
Route::get('emailservices', [PagesController::class, 'emailservices']);
Route::get('mail-read', [PagesController::class, 'mail_read']);
Route::get('gallery', [PagesController::class, 'gallery']);
Route::get('about', [PagesController::class, 'about']);
Route::get('services', [PagesController::class, 'services']);
Route::get('faq', [PagesController::class, 'faq']);
Route::get('terms', [PagesController::class, 'terms']);
Route::get('invoice', [PagesController::class, 'invoice']);
Route::get('notify-list', [PagesController::class, 'notify_list']);
Route::get('pricing', [PagesController::class, 'pricing']);
Route::get('switcher', [PagesController::class, 'switcher']);
Route::get('emptypage', [PagesController::class, 'emptypage']);
Route::get('construction', [PagesController::class, 'construction']);


Route::get('form-elements', [FormsController::class, 'form_elements']);
Route::get('form-editor', [FormsController::class, 'form_editor']);
Route::get('form-wizard', [FormsController::class, 'form_wizard']);
Route::get('form-validation', [FormsController::class, 'form_validation']);
Route::get('form-layouts', [FormsController::class, 'form_layouts']);


Route::get('icons', [IconsController::class, 'icons']);
Route::get('icons2', [IconsController::class, 'icons2']);
Route::get('icons3', [IconsController::class, 'icons3']);
Route::get('icons4', [IconsController::class, 'icons4']);
Route::get('icons5', [IconsController::class, 'icons5']);
Route::get('icons6', [IconsController::class, 'icons6']);
Route::get('icons7', [IconsController::class, 'icons7']);
Route::get('icons8', [IconsController::class, 'icons8']);
Route::get('icons9', [IconsController::class, 'icons9']);
Route::get('icons10', [IconsController::class, 'icons10']);
Route::get('icons11', [IconsController::class, 'icons11']);


Route::get('chart-chartist', [ChartsController::class, 'chart_chartist']);
Route::get('chart-flot', [ChartsController::class, 'chart_flot']);
Route::get('chart-echart', [ChartsController::class, 'chart_echart']);
Route::get('chart-morris', [ChartsController::class, 'chart_morris']);
Route::get('charts', [ChartsController::class, 'charts']);
Route::get('chart-line', [ChartsController::class, 'chart_line']);
Route::get('chart-donut', [ChartsController::class, 'chart_donut']);
Route::get('chart-pie', [ChartsController::class, 'chart_pie']);


Route::get('tables', [TablesController::class, 'tables']);
Route::get('datatable', [TablesController::class, 'datatable']);
Route::get('edit-table', [TablesController::class, 'edit_table']);
