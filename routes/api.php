<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\PlatformController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MissionController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserMissionController;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Normal User
Route::middleware(['auth:sanctum', 'verified', 'checkApiPassword', 'changeLanguage'])->name('user.')->prefix('user')->group(function () {
    Route::apiResources([
        'mission' => MissionController::class,
        'platform' => PlatformController::class,
    ]);
    Route::post('mission-done/{mission_id}', [UserMissionController::class, 'mission_done'])->name('mission_done');
    Route::get('total-stars-of-user/{user_id}', [UserMissionController::class, 'total_stars_of_user'])->name('total_stars_of_user');
    Route::get('top-10-last-month', [UserMissionController::class, 'top_10_last_month'])->name('top_10_last_month');
    Route::get('top-10-all-time', [UserMissionController::class, 'top_10_all_time'])->name('top_10_all_time');
    Route::get('missions-of-platform/{platform_id}', [MissionController::class, 'missions_of_platform'])->name('missions_of_platform');
    Route::get('faqs', [SettingController::class, 'list_of_faqs'])->name('list_of_faqs');

    Route::get('search-for-mission', [MissionController::class, 'search_for_mission'])->name('search_for_mission');

    // Route::get('contact' , [ContactController::class , 'index'])->name('contact_index');
    Route::post('contact' , [ContactController::class , 'store'])->name('contact_store');
    Route::delete('contact/{id}/delete' , [ContactController::class , 'destroy'])->name('contact_delete');
    Route::get('slider' , [SliderController::class , 'index'])->name('slider.index');

    // Route::apiResource('profile', UserController::class)->only(['show']);
    Route::get('/profile/{id}', [UserController::class, 'show'])->name('show');
    Route::post('/profile/{id}', [UserController::class, 'update'])->name('update');
    Route::post('/profile-password/{id}', [UserController::class, 'updatePassword'])->name('updatePassword');

    Route::get('/home', [HomeController::class, 'home'])->name('home');

    Route::get('/show-notifications', [NotificationController::class, 'show_notifications'])->name('notifications.show_notifications');
    Route::patch('/mark-notification-as-readed/{id}', [NotificationController::class, 'mark_notification_as_readed'])->name('notifications.mark_notification_as_readed');
    Route::patch('/mark-all-notifications-as-readed', [NotificationController::class, 'mark_all_notifications_as_readed'])->name('notifications.mark_all_notifications_as_readed');


});

// Super User
Route::middleware(['auth:sanctum', 'verified', 'checkApiPassword', 'changeLanguage', 'isSuper'])->name('user.')->prefix('user')->group(function () {
    Route::post('mission/super-user', [MissionController::class, 'store'])->name('mission.super-user.store');
});
Route::post('contacts' , [ContactController::class , 'store'])->name('contact_store');
Route::get('profile-show/{id}', [UserController::class, 'show'])->name('show');



require __DIR__.'/auth-api.php';
