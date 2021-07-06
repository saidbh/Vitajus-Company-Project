<?php

namespace  App\Http\Controllers;


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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/*-----------------------------Admin dashboard routes---------------------------------*/
Route::prefix('dashboard')->middleware(['auth:sanctum','verified'])->group(function () {
    /*-----------------------------Start GET M-workers routes---------------------------------*/
    Route::get('checkin', [WorkersManager::class, 'checkInWorkers'])->name('checkin');
    Route::get('salary', [WorkersManager::class, 'salaryWorkers'])->name('salary');
    Route::get('update-workers', [WorkersManager::class, 'updateWorker'])->name('update-workers');
    /*-----------------------------End GET M-workers routes---------------------------------*/


    /*-----------------------------Start POST M-workers routes (update workers)---------------------------------*/
    Route::post('delete/{id}', [WorkersManager::class, 'deleteStore'])->name('delete-worker');
    Route::post('edit/{id}', [WorkersManager::class, 'editStore'])->name('edit-worker');
    Route::post('add', [WorkersManager::class, 'addStore'])->name('add-workers');
    /*-----------------------------End POST M-workers routes---------------------------------*/

    /*-----------------------------Start POST M-workers routes (salary and advanced payment)---------------------------------*/
    Route::post('setadvance/{id}/{name}/{family}',[WorkersManager::class, 'setAdvance'])->name('setadvance');
    /*-----------------------------Start POST M-workers routes (salary and advanced payment)---------------------------------*/

    /*-----------------------------Start POST M-workers routes (Set checkIn)---------------------------------*/
    Route::post('checkin',[WorkersManager::class, 'checkIn'])->name('setcheckin');
    Route::post('checkin/update/{id}',[WorkersManager::class, 'updateCheckin'])->name('updatecheckin');
    /*-----------------------------Start POST M-workers routes (Set checkIn)---------------------------------*/


    /*-----------------------------Start GET M-Stock routes---------------------------------*/
    Route::get('pri-suplies', [StockManager::class, 'priSuplies'])->name('pri-suplies');
    Route::get('stock-distribution', [StockManager::class, 'stockDis'])->name('stock-distribution');
    Route::get('total-stock', [StockManager::class, 'totalAll'])->name('total-stock');
    /*-----------------------------End GET M-Stock routes---------------------------------*/

    /*-----------------------------Start POST M-Stock routes---------------------------------*/
    Route::post('suplies/add',[StockManager::class,'AddPriStck'])->name('pri-supliesadd');
    /*-----------------------------Start POST M-Stock routes---------------------------------*/

    /*-----------------------------Start GET M-Payment routes---------------------------------*/
    Route::get('monthly-pay', [PaiymentManager::class, 'monthlyPay'])->name('monthly-pay');
    Route::get('charges-topay', [PaiymentManager::class, 'chargesToPay'])->name('charges-topay');
    Route::get('total-charges', [PaiymentManager::class, 'totalCharges'])->name('total-charges');
    /*-----------------------------End GET M-Payment routes---------------------------------*/


    /*-----------------------------Start , these routes is only for ajax requests---------------------------------*/
    Route::post('/search', [WorkersManager::class, 'searchAdvPay'])->name('ajax-advpayname');

    Route::get('/code', [StockManager::class, 'searchCode'])->name('codev');
    /*-----------------------------Start , these routes is only for ajax requests---------------------------------*/


    /*This route is for downloading pdf start here*/
    Route::get('/employee/pdf/{id}', [WorkersManager::class, 'createPDF'])->name('createPDF');
    /*This route is for downloading pdf end here*/

});
/*-----------------------------End Admin dashboard routes---------------------------------*/
