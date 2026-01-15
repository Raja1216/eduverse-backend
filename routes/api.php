<?php

use App\Http\Controllers\Admin\EventImportController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProgramImportController;
use App\Http\Controllers\Admin\PublicationImportController;
use App\Http\Controllers\Assessment\AssessmentDetailController;
use App\Http\Controllers\Assessment\AssessmentListController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cart\AddToCartController;
use App\Http\Controllers\Cart\CartListController;
use App\Http\Controllers\Cart\ClearCartController;
use App\Http\Controllers\Cart\RemoveCartController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Event\EventDetailController;
use App\Http\Controllers\Event\EventListController;
use App\Http\Controllers\Event\UpcomingEventController;
use App\Http\Controllers\Order\CreateOrderController;
use App\Http\Controllers\Order\OrderDetailController;
use App\Http\Controllers\Order\OrderListController;
use App\Http\Controllers\Payment\InitiatePaymentController;
use App\Http\Controllers\Payment\PaymentFailureController;
use App\Http\Controllers\Payment\PaymentSuccessController;
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

Route::get('cms/page-content', [CmsController::class, 'getAll']);

Route::get('cms/{key}', [CmsController::class, 'get']);


Route::middleware(['auth:sanctum','admin'])->group(function () {
    Route::put('cms/{key}', [CmsController::class, 'set']);
    Route::post('admin/media/upload', [MediaController::class, 'upload']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', LogoutController::class);
    Route::get('user/profile', [ProfileController::class, 'show']);
    Route::put('user/profile', [ProfileController::class, 'update']);

    Route::get('cart', CartListController::class);
    Route::post('cart/add', AddToCartController::class);
    Route::delete('cart/{id}', RemoveCartController::class);
    Route::delete('cart', ClearCartController::class);

    Route::post('orders', CreateOrderController::class);
    Route::get('orders', OrderListController::class);
    Route::get('orders/{id}', OrderDetailController::class);

    Route::post('payments/initiate/{orderId}', InitiatePaymentController::class);
});

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

    Route::post('/contact-us', [ContactController::class, 'store']);


Route::post('payments/success', PaymentSuccessController::class);
Route::post('payments/failure', PaymentFailureController::class);

Route::post('/admin/programs/import', [ProgramImportController::class, 'import']);
Route::post('/admin/events/import', [EventImportController::class, 'import']);
Route::post('/admin/publications/import', [PublicationImportController::class, 'import']);
