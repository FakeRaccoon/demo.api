<?php

use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\DistrictController;
use App\Http\Controllers\API\FeeController;
use App\Http\Controllers\API\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ProvinceController;
use App\Http\Controllers\API\TechnicianController;
use App\Http\Controllers\API\TransportationController;
use App\Http\Controllers\API\UploadController;
use App\Http\Controllers\API\GetImageController;
use App\Http\Controllers\API\LogController;
use App\Http\Controllers\API\RentalController;
use App\Models\Notification;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', [RegisterController::class, 'user']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [RegisterController::class, 'login']);
Route::post('/user/update', [RegisterController::class, 'updateUser']);

Route::middleware('auth:api')->group( function () {
    Route::resource('/item', ItemController::class);
});
// Route::get('item', [ItemController::class, 'index']);

Route::post('/form/create', [FormController::class, 'createForm']);
Route::get('/form', [FormController::class, 'getData'])->middleware('auth:api');
Route::get('/form/{id}', [FormController::class, 'formId']);
Route::get('/form/status/{status}', [FormController::class, 'form']);
Route::post('/form/update/status', [FormController::class, 'statusUpdate']);
Route::post('/form/update/status/reject', [FormController::class, 'statusAndRejecReasonUpdate']);
Route::post('/form/update', [FormController::class, 'formUpdate']);
Route::post('/form/update/image', [FormController::class, 'imageUpdate']);
Route::post('/form/update/codeImage', [FormController::class, 'codeImageUpdate']);
Route::post('/form/update/returnImage', [FormController::class, 'returnImageUpdate']);

Route::get('/transport', [TransportationController::class, 'transportation']);
Route::get('/transport/{id}', [TransportationController::class, 'transportationDetail']);
Route::post('/transport/create', [TransportationController::class, 'createData']);
Route::post('/transport/update', [TransportationController::class, 'updateTransport']);

Route::get('/technician', [TechnicianController::class, 'techname']);
Route::get('/technician/final', [TechnicianController::class, 'techFinal']);
Route::delete('/technician/clear/{id}', [TechnicianController::class, 'clear']);
Route::post('/technician/create', [TechnicianController::class, 'create']);
Route::post('/technician/update', [TechnicianController::class, 'update']);
Route::post('/technician/update/final', [TechnicianController::class, 'updateFinal']);
Route::delete('/technician/delete/{id}', [TechnicianController::class, 'destroy']);

Route::get('/notification', [NotificationController::class, 'getData']);

Route::post('/fee', [FeeController::class, 'createFee']);

Route::get('/province', [ProvinceController::class, 'getData']);
Route::get('/city', [CityController::class, 'getData']);
Route::get('/district', [DistrictController::class, 'getData']);

Route::post('/image/upload', [UploadController::class, 'uploadTest']);
Route::post('/image/upload/transport', [UploadController::class, 'uploadTransport']);
Route::post('/image/delete', [UploadController::class, 'deleteImage']);
Route::get('/image', [GetImageController::class, 'getData']);

Route::post('/log/create', [LogController::class, 'createLog']);
Route::get('/log', [LogController::class, 'getData']);

Route::get('/rental', [RentalController::class, 'rental']);
Route::get('/rental/status', [RentalController::class, 'rentalStatus']);
Route::get('/rental/user', [RentalController::class, 'rentalPerUser']);
Route::post('/rental/create', [RentalController::class, 'createData']);
Route::post('/rental/update/status', [RentalController::class, 'updateRentalStatus']);