<?php

use App\Http\Controllers\InvestorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});


// Admin Routes
Route::middleware(['auth','role:admin'])->group(function() {

    // Investors
    Route::get('/delete-investor/{investor}', [InvestorController::class,'destroy'])->name('investor.delete');

    // managers
    
    Route::get('/managers', [ManagerController::class,  'index'])->name('managers');

    Route::get('/add-manager', [ManagerController::class, 'create'])->name('manager.add');
    Route::post('/add-manager', [ManagerController::class, 'store'])->name('manager.save');

    Route::get('/edit-manager/{manager}', [ManagerController::class,'edit'])->name('manager.edit');
    Route::post('/edit-manager/{manager}', [ManagerController::class,'update'])->name('manager.update');

    Route::post('/manager/change-password/{manager}', [ManagerController::class,'change_password'])->name('manager.change-password');
    Route::get('/delete-manager/{manager?}',[ManagerController::class , 'destroy'])->name('manager.delete');

});   


Route::middleware(['auth','verified'])->group(function () {


    // dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    

    // investors
    Route::get('/investors', [InvestorController::class , 'index'])->name('investors');
    Route::get('/view-investor/{investor?}', [InvestorController::class, 'view'])->name('investor.view');

    Route::get('/add-investor', [InvestorController::class,'create'])->name('investor.add');
    Route::post('/add-investor', [InvestorController::class,'store'])->name('investor.save');

    Route::get('/edit-investor/{investor}', [InvestorController::class, 'edit' ])->name('investor.edit');
    Route::post('/edit-investor/{investor}',[InvestorController::class, 'update'])->name('investor.update');


    // plans
    Route::get('/plans', [PlanController::class, 'index'])->name('plans');
    Route::get('/add-plan', [PlanController::class,'create'])->name('plan.add');
    Route::post('/add-plan', [PlanController::class,'store'])->name('plan.save');
    Route::get('/edit-plan/{plan}', [PlanController::class, 'edit' ])->name('plan.edit');
    Route::post('/edit-plan/{plan}',[PlanController::class, 'update'])->name('plan.update');
    

    // transactions
    Route::get('/transactions', [TransactionController::class , 'index'])->name('transactions');
    Route::get('/transaction/status/{transaction}', [TransactionController::class , 'status'])->name('transaction.status');

    
    // investments
    Route::get('/investments', [InvestmentController::class, 'index'])->name('investments');
    Route::get('/view-investment/{investment?}', [InvestmentController::class, 'show'])->name('investment.view');

    Route::get('/add-investment/{investment?}', [InvestmentController::class, 'create'])->name('investment.add');
    Route::post('/add-investment/{investment?}', [InvestmentController::class, 'store'])->name('investment.save');

    // Route::get('/edit-investment/{investment?}', [InvestmentController::class, 'edit'])->name('investment.edit');
    // Route::post('/edit-investment/{investment?}', [InvestmentController::class, 'update'])->name('investment.update');

    // User Profile  
    Route::get('/logout', function( Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-password', [ProfileController::class, 'update_password'])->name('profile.update_password');
    
});

require __DIR__.'/auth.php';