<?php

use App\Http\Livewire\ActivityLog\ActivityLogTable;
use App\Http\Livewire\AdminPanel\Extras\PaymentCategoryTable;
use App\Http\Livewire\AdminPanel\ManageAccounts\AdminTable;
use App\Http\Livewire\AdminPanel\ManageAccounts\CashierTable;
use App\Http\Livewire\AdminPanel\ManageClient\StudentTable;
use App\Http\Livewire\AdminPanel\ManageReport\DailyReportTable;
use App\Http\Livewire\AdminPanel\ManageReport\ManageReportTable;
use App\Http\Livewire\AdminPanel\ManageServices\ModeOfPaymentTable;
use App\Http\Livewire\AdminPanel\ManageServices\PaymentDetailTable;
use App\Http\Livewire\CashierPanel\Sales\DaySalesTable;
use App\Http\Livewire\CashierPanel\Sales\SalesTable;
use App\Http\Livewire\CashierPanel\Transaction\TransactionTable;
use App\Http\Livewire\CashierPanel\TransactionHistory\TransactionHistoryTable;
use App\Http\Livewire\DashBoard\DashBoard;
use App\Http\Livewire\Profile\EditProfileForm;
use App\Http\Livewire\Profile\PasswordUpdate;
use App\Http\Livewire\QueueingSystem\QueueingDisplay;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    
    Route::get('/dashboard', DashBoard::class)->name('dashboard');
    Route::get('/editprofileform', EditProfileForm::class)->name('editprofileform');
    Route::get('/passwordupdate', PasswordUpdate::class)->name('passwordupdate');
    
    
    // Admin Panel
    Route::get('/admin-table', AdminTable::class)->name('admin-table')->middleware('checkRulepermissionadmin');
    Route::get('/cashier-table', CashierTable::class)->name('cashier-table')->middleware('checkRulepermissionadmin');
    // Route::get('/payor-table', StudentTable::class)->name('payor-table')->middleware('checkRulepermissionadmin');
    Route::get('/payment-category-table', PaymentCategoryTable::class)->name('payment-category-table')->middleware('checkRulepermissionadmin');
    Route::get('/payment-detail-table', PaymentDetailTable::class)->name('payment-detail-table')->middleware('checkRulepermissionadmin');
    Route::get('/mode-of-payment-table', ModeOfPaymentTable::class)->name('mode-of-payment-table')->middleware('checkRulepermissionadmin');
    Route::get('/manage-report-table', DailyReportTable::class)->name('manage-report-table')->middleware('checkRulepermissionadmin');
    Route::get('/admin-activity-log-table', ActivityLogTable::class)->name('admin-activity-log-table')->middleware('checkRulepermissionadmin');
    
    // Cashier Panel
    Route::get('/transaction-table', TransactionTable::class)->name('transaction-table')->middleware('checkRulepermissioncashier');
    Route::get('/transaction-history-table', TransactionHistoryTable::class)->name('transaction-history-table')->middleware('checkRulepermissioncashier');
    // Route::get('/cashier-payor-table', StudentTable::class)->name('cashier-payor-table')->middleware('checkRulepermissioncashier');
    Route::get('/cashier-activity-log-table', ActivityLogTable::class)->name('cashier-activity-log-table')->middleware('checkRulepermissioncashier');
    Route::get('/sales-table', DaySalesTable::class)->name('sales-table')->middleware('checkRulepermissioncashier');
});
