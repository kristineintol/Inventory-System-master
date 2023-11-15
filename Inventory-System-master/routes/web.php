<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequisitionController;
use App\Models\Requisition;
use App\Models\Product;
use App\Models\User;
use App\Models\Technician;
use Carbon\Carbon;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    $requisitions = Requisition::where('status', '0')->where('user_id', auth()->id())->get();
    $procurements = Requisition::where('status', '1')->where('user_id', auth()->id())->get();
    $technicians = Technician::all();
    $products = Product::all();
    $users = User::all();
    $customers = User::where('is_admin', '0')->get();
    $admins = User::where('is_admin', '1')->get();

    if(auth()->user()->is_admin){
        $requisitions = Requisition::where('status', '0')->get();
        $procurements = Requisition::where('status', '1')->get();
    }

    $chartData = $procurements->groupBy(function($date) {
        return Carbon::parse($date->created_at)->format('Y-m-d'); // grouping by date
    })->map(function ($row) {
        return $row->sum('quantity');
    });

    return view('dashboard.index', compact('requisitions', 'procurements', 'technicians', 'users', 'customers', 'admins', 'products', 'chartData'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/customers', CustomerController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/units', UnitController::class);

    // Route Technicians
    Route::resource('technicians', TechnicianController::class);

    // Route Requisition
    Route::resource('requisitions', RequisitionController::class);
    Route::get('/requisitions/createselected/{id}', [RequisitionController::class, 'createSelected'])->name('requisitions.createSelected');

    // Route Procurement
    Route::resource('procurements', ProcurementController::class);

    // Route Report
    Route::get('/report', [Controller::class, 'report'])->name('report');



    // Route Products
    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    Route::get('/products/import', [ProductController::class, 'import'])->name('products.import');
    Route::post('/products/import', [ProductController::class, 'handleImport'])->name('products.handleImport');
    Route::resource('/products', ProductController::class);

    // Route POS
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/cart/add', [PosController::class, 'addCartItem'])->name('pos.addCartItem');
    Route::post('/pos/cart/update/{rowId}', [PosController::class, 'updateCartItem'])->name('pos.updateCartItem');
    Route::delete('/pos/cart/delete/{rowId}', [PosController::class, 'deleteCartItem'])->name('pos.deleteCartItem');
    Route::post('/pos/invoice', [PosController::class, 'createInvoice'])->name('pos.createInvoice');

    Route::post('/pos', [OrderController::class, 'createOrder'])->name('pos.createOrder');

    // Route Orders
    Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('order.pendingOrders');
    Route::get('/orders/pending/{order_id}', [OrderController::class, 'orderDetails'])->name('order.orderPendingDetails');
    Route::get('/orders/complete', [OrderController::class, 'completeOrders'])->name('order.completeOrders');
    Route::get('/orders/complete/{order_id}', [OrderController::class, 'orderDetails'])->name('order.orderCompleteDetails');
    Route::get('/orders/details/{order_id}/download', [OrderController::class, 'downloadInvoice'])->name('order.downloadInvoice');
    Route::get('/orders/due', [OrderController::class, 'dueOrders'])->name('order.dueOrders');
    Route::get('/orders/due/pay/{order_id}', [OrderController::class, 'dueOrderDetails'])->name('order.dueOrderDetails');
    Route::put('/orders/due/pay/update', [OrderController::class, 'updateDueOrder'])->name('order.updateDueOrder');
    Route::put('/orders/update', [OrderController::class, 'updateOrder'])->name('order.updateOrder');

    // Default Controller
    Route::get('/get-all-product', [DefaultController::class, 'GetProducts'])->name('get-all-product');

    // Route Purchases
    Route::get('/purchases', [PurchaseController::class, 'allPurchases'])->name('purchases.allPurchases');
    Route::get('/purchases/approved', [PurchaseController::class, 'approvedPurchases'])->name('purchases.approvedPurchases');
    Route::get('/purchases/create', [PurchaseController::class, 'createPurchase'])->name('purchases.createPurchase');
    Route::post('/purchases', [PurchaseController::class, 'storePurchase'])->name('purchases.storePurchase');
    Route::put('/purchases/update', [PurchaseController::class, 'updatePurchase'])->name('purchases.updatePurchase');
    Route::get('/purchases/details/{purchase_id}', [PurchaseController::class, 'purchaseDetails'])->name('purchases.purchaseDetails');
    Route::delete('/purchases/delete/{purchase_id}', [PurchaseController::class, 'deletePurchase'])->name('purchases.deletePurchase');

    Route::get('/purchases/report', [PurchaseController::class, 'dailyPurchaseReport'])->name('purchases.dailyPurchaseReport');
    Route::get('/purchases/report/export', [PurchaseController::class, 'getPurchaseReport'])->name('purchases.getPurchaseReport');
    Route::post('/purchases/report/export', [PurchaseController::class, 'exportPurchaseReport'])->name('purchases.exportPurchaseReport');

    // User Management
    Route::resource('/users', UserController::class)->except(['show']);
    Route::put('/user/change-password/{username}', [UserController::class, 'updatePassword'])->name('users.updatePassword');
});

require __DIR__.'/auth.php';
