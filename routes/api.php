<?php

use App\Http\Controllers\Assessment\AssessmentDetailController;
use App\Http\Controllers\Assessment\AssessmentListController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Event\EventDetailController;
use App\Http\Controllers\Event\EventListController;
use App\Http\Controllers\Event\UpcomingEventController;
use App\Http\Controllers\Product\FeaturedProductController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductDetailController;
use App\Http\Controllers\Product\ProductListController;
use App\Http\Controllers\Program\ProgramDetailController;
use App\Http\Controllers\Program\ProgramListController;
use App\Http\Controllers\Publication\PublicationDetailController;
use App\Http\Controllers\Publication\PublicationListController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', LogoutController::class);
    Route::get('user/profile', [ProfileController::class, 'show']);
    Route::put('user/profile', [ProfileController::class, 'update']);

    Route::get('programs', ProgramListController::class);
    Route::get('programs/{id}', ProgramDetailController::class);

    Route::get('publications', PublicationListController::class);
    Route::get('publications/{id}', PublicationDetailController::class);

    Route::get('events', EventListController::class);
    Route::get('events/upcoming', UpcomingEventController::class);
    Route::get('events/{id}', EventDetailController::class);

    Route::get('assessments', AssessmentListController::class);
    Route::get('assessments/{id}', AssessmentDetailController::class);

    Route::get('products', ProductListController::class);
    Route::get('products/featured', FeaturedProductController::class);
    Route::get('products/categories', ProductCategoryController::class);
    Route::get('products/{id}', ProductDetailController::class);
});
