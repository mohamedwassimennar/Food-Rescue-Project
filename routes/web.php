<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataCustomerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProfileCustomerController;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Http\Controllers\ConsigneController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\AssociationController;

use App\Http\Controllers\EvenementCollecteController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StocksController;



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

Route::get('/', [FoodController::class, 'home'])->name('home');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/list_food', [FoodController::class, 'allFood'])->name('list_food');
    Route::get('/food/{id}/editadmin', [FoodController::class, 'adminEdit'])->name('adminEdit');
    Route::put('/food/{id}', [FoodController::class, 'update'])->name('adminupdate');
    Route::delete('/food/{food}', [FoodController::class, 'destroy'])->name('admin.food.destroy');
    Route::get('/verify_restaurant', [RestaurantController::class, 'indexunverified'])->name('verify_restaurant');
    Route::post('/verify_restaurant/{id}', [RestaurantController::class, 'accept'])->name('restaurant.accept');
    Route::delete('/verify_restaurant/{id}', [RestaurantController::class, 'destroy'])->name('restaurant.destroy');

    Route::get('/food/export/excel', [FoodController::class, 'exportExcel'])->name('food.export.excel');
    Route::get('/admin/statistics', [FoodController::class, 'stats'])->name('admin.statistics');


    Route::get('stockss/export', [StocksController::class, 'export'])->name('stockss.export');

    Route::resource('stockss', StocksController::class);

    Route::resource('categories', CategoriesController::class);
});


Route::middleware(['auth', 'role:restaurant'])->group(function () {

    Route::resource('menus', MenuController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('orders', OrderController::class);
    Route::prefix('restaurant')->group(function () {
        Route::get('dashboard', function () { return view('restaurant.dashboard');})->name('restaurant.dashboard');
        Route::get('food', [FoodController::class, 'index'])->name('food.index');
        Route::get('/food/create', [FoodController::class, 'create'])->name('food.create');
        Route::post('/food', [FoodController::class, 'store'])->name('food.store');
        Route::get('/food/{id}/edit', [FoodController::class, 'edit'])->name('food.edit');
        Route::put('/food/{id}', [FoodController::class, 'update'])->name('food.update');
        Route::delete('/food/{food}', [FoodController::class, 'destroy'])->name('food.destroy');
    });
    
});


Route::get('/menu', [MenuController::class, 'landingPage']);
Route::get('/promo', [PromoController::class, 'landingPage']);
Route::get('/menu_customer', [MenuController::class, 'landingPageCustomer']);
Route::post('/add_to_cart', [MenuController::class, 'addToCart']);
Route::get('/promo_customer', [PromoController::class, 'landingPageCustomer']);






Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});


Route::get('/banner-1', function () {
    return view('banner.banner-1');
});

Route::get('/banner-2', function () {
    return view('banner.banner-2');
});

Route::get('/banner-3', function () {
    return view('banner.banner-3');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [AuthController::class, 'reset'])->name('password.update');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('data_customer', DataCustomerController::class)->parameters([
        'data_customer' => 'user'
    ]);
    Route::resource('promos', PromoController::class);
    Route::get('/daftar-toko', [RestaurantController::class, 'dataNamaToko'])->name('daftar_toko.index');

    Route::prefix('admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        //Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');
        //Route::get('/food', [FoodController::class, 'index'])->name('food.index');
        //Route::get('/food/create', [FoodController::class, 'create'])->name('food.create');
        //Route::post('/food', [FoodController::class, 'store'])->name('food.store');
        //Route::get('/food/{food}/edit', [FoodController::class, 'edit'])->name('food.edit');
        //Route::put('/food/{food}', [FoodController::class, 'update'])->name('food.update');
        //Route::delete('/food/{food}', [FoodController::class, 'destroy'])->name('food.destroy');
    });
});



Route::middleware('auth')->group(function () {
    Route::prefix('customer')->group(function () {
        Route::get('dashboard', [FoodController::class, 'customerhome'])->name('customer.dashboard');
    });
});
Route::post('/add_to_cart', [MenuController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::post('/apply-promo', [CartController::class, 'applyPromo'])->name('applyPromo');
Route::post('/cart/store-order', [PromoController::class, 'storeOrder'])->name('orders.create');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/customer/orders', [CustomerController::class, 'orders'])->name('customer.orders');

Route::get('/registrasi_restaurant', function () {
    return view('customer.form');
});
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});


Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
Route::post('/restaurant/store', [RestaurantController::class, 'store'])->name('restaurant.store');



Route::get('/lihat_data_restaurant', function () {
    return view('admin.list_restaurant.show');
});
Route::get('/restaurant/{id}', [RestaurantController::class, 'show'])->name('admin.list_restaurant.show');
Route::post('/restaurant/{id}/accept', [RestaurantController::class, 'accept'])->name('restaurant.accept');
Route::get('/profil_customer', function () {
    return view('customer.profil');
});
Route::get('/customer/food', [FoodController::class, 'reading'])->name('customer.food');
Route::get('/landing_page/food', [FoodController::class, 'read'])->name('landing_page.food');




Route::get('/menus/create', [RestaurantController::class, 'listNamaToko'])->name('menus.create');
Route::middleware(['auth'])->group(function () {
    Route::resource('menus', MenuController::class);
});
Route::delete('cart/{rowId}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::patch('/cart/update/{rowId}', [CartController::class, 'update']);
Route::get('/cart/total', [CartController::class, 'getTotal']);


Route::post('/check-association', [DemandeController::class, 'checkAssociation'])->name('check.association');
Route::get('/demandes/create', [DemandeController::class, 'create'])->name('demandes.create');
Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');

Route::get('/mes-demandes', [DemandeController::class, 'mesDemandes'])->name('demandes.mesdemandes');

Route::delete('/demandes/{id}', [DemandeController::class, 'destroy'])->name('demandes.destroy');
Route::get('/demandes/{id}/edit', [DemandeController::class, 'edit'])->name('demandes.edit');
Route::put('/demandes/{id}', [DemandeController::class, 'update'])->name('demandes.update');

Route::get('/edit', [RestaurantController::class, 'edit'])->name('restaurant.edit');
Route::put('/update', [RestaurantController::class, 'update'])->name('restaurant.update');


// Routes pour EvenementCollecte
Route::middleware(['auth'])->group(function () {
    Route::resource('evenement-collecte', EvenementCollecteController::class);
});

// Routes pour Notification
Route::middleware(['auth'])->group(function () {
    Route::resource('notification', NotificationController::class);
});

Route::get('evenements/pdf', [EvenementCollecteController::class, 'downloadPDF'])->name('evenements.pdf');

Route::get('/notification/{id}/qrcode', [NotificationController::class, 'generateQrCode'])->name('notification.qrcode');


Route::get('/customer/{id}/profile', [ProfileCustomerController::class, 'show'])->name('customer.profil');
Route::post('/customer/{id}/profile/photo', [ProfileCustomerController::class, 'updatePhoto'])->name('customer.profil.updatePhoto');
Route::put('/customer/{id}/profile', [ProfileCustomerController::class, 'update'])->name('customer.profil.update');
// Routes pour gérer les demandes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/list_demandes', [DemandeController::class, 'index'])->name('list_demandes.index');
    Route::put('/list_demandes/{demande}', [DemandeController::class, 'updatee'])->name('list_demandes.update');
});

Route::get('consignes', [ConsigneController::class, 'index'])->name('consignes.index');
Route::get('consignes/create', [ConsigneController::class, 'create'])->name('consignes.create');
Route::post('consignes', [ConsigneController::class, 'store'])->name('consignes.store');
Route::get('consignes/{consigne}', [ConsigneController::class, 'show'])->name('consignes.show');
Route::get('consignes/{consigne}/edit', [ConsigneController::class, 'edit'])->name('consignes.edit');
Route::put('consignes/{consigne}/update', [ConsigneController::class, 'update'])->name('consignes.update');
Route::delete('consignes/{consigne}/delete', [ConsigneController::class, 'destroy'])->name('consignes.destroy');


Route::get('feedbacks', [FeedBackController::class, 'index'])->name('feedbacks.index');
Route::get('feedbacks/create', [FeedBackController::class, 'create'])->name('feedbacks.create');
Route::post('feedbacks', [FeedBackController::class, 'store'])->name('feedbacks.store');
Route::get('feedbacks/{feedback}', [FeedBackController::class, 'show'])->name('feedbacks.show');
Route::get('feedbacks/{feedback}/edit', [FeedBackController::class, 'edit'])->name('feedbacks.edit');
Route::put('feedbacks/{feedback}/update', [FeedBackController::class, 'update'])->name('feedbacks.update');
Route::delete('feedbacks/{feedback}/delete', [FeedBackController::class, 'destroy'])->name('feedbacks.destroy');

Route::get('/associations', [AssociationController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/assosfeedback', [FeedBackController::class, 'assosFeedback'])->name('assosfeedback.index');

