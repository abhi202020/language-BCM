<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\LiveLessonSlotController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CertificateController;
use App\Http\Controllers\Backend\WishlistController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\Frontend\BundlesController;
use App\Http\Controllers\Frontend\LessonsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SitemapController; // Fully qualified namespace

/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);
Route::get('/sitemap-' . str_slug(config('app.name')) . '/{file?}', [SitemapController::class, 'index']);
Route::get('reset-demo', function () {
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 1000);
    try {
        \Illuminate\Support\Facades\Artisan::call('refresh:site');
        return 'Refresh successful!';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

/*
 * Frontend Routes
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    include_route_files(__DIR__ . '/frontend/');
});

/*
 * Backend Routes
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    include_route_files(__DIR__ . '/backend/');
});

/*
 * Blog Routes
 */
Route::group(['prefix' => 'blog'], function () {
    Route::get('category/{category}/blogs', [BlogController::class, 'getByCategory'])->name('blogs.category');
    Route::get('tag/{tag}/blogs', [BlogController::class, 'getByTag'])->name('blogs.tag');
    Route::get('{slug?}', [BlogController::class, 'getIndex'])->name('blogs.index');
    Route::post('{id}/comment', [BlogController::class, 'storeComment'])->name('blogs.comment');
    Route::get('comment/delete/{id}', [BlogController::class, 'deleteComment'])->name('blogs.comment.delete');
    Route::get('blogs', [BlogController::class, 'index'])->name('admin.blogs.index');

});

/*
 * Teachers Routes
 */
Route::get('teachers', [HomeController::class, 'getTeachers'])->name('teachers.index');
Route::get('teachers/{id}/show', [HomeController::class, 'showTeacher'])->name('teachers.show');

/*
 * Newsletter Routes
 */
Route::post('newsletter/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');

/*
 * Course Routes
 */
Route::group(['prefix' => 'courses'], function () {
    Route::get('/', [CoursesController::class, 'all'])->name('courses.all');
    Route::get('{slug}', [CoursesController::class, 'show'])->name('courses.show')->middleware('subscribed');
    Route::post('{course_id}/rating', [CoursesController::class, 'rating'])->name('courses.rating');
    Route::get('category/{category}', [CoursesController::class, 'getByCategory'])->name('courses.category');
    Route::post('{id}/review', [CoursesController::class, 'addReview'])->name('courses.review');
    Route::get('review/{id}/edit', [CoursesController::class, 'editReview'])->name('courses.review.edit');
    Route::post('review/{id}/edit', [CoursesController::class, 'updateReview'])->name('courses.review.update');
    Route::get('review/{id}/delete', [CoursesController::class, 'deleteReview'])->name('courses.review.delete');
});

/*
 * Bundle Routes
 */
Route::group(['prefix' => 'bundles'], function () {
    Route::get('/', [BundlesController::class, 'all'])->name('bundles.all');
    Route::get('{slug}', [BundlesController::class, 'show'])->name('bundles.show');
    Route::post('{bundle_id}/rating', [BundlesController::class, 'rating'])->name('bundles.rating');
    Route::get('category/{category}', [BundlesController::class, 'getByCategory'])->name('bundles.category');
    Route::post('{id}/review', [BundlesController::class, 'addReview'])->name('bundles.review');
    Route::get('review/{id}/edit', [BundlesController::class, 'editReview'])->name('bundles.review.edit');
    Route::post('review/{id}/edit', [BundlesController::class, 'updateReview'])->name('bundles.review.update');
    Route::get('review/{id}/delete', [BundlesController::class, 'deleteReview'])->name('bundles.review.delete');
});

/*
 * Lesson Routes
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('lesson/{course_id}/{slug}/', [LessonsController::class, 'show'])->name('lessons.show');
    Route::post('lesson/{slug}/test', [LessonsController::class, 'test'])->name('lessons.test');
    Route::post('lesson/{slug}/retest', [LessonsController::class, 'retest'])->name('lessons.retest');
    Route::post('video/progress', [LessonsController::class, 'videoProgress'])->name('update.videos.progress');
    Route::post('lesson/progress', [LessonsController::class, 'courseProgress'])->name('update.course.progress');
    Route::post('lesson/book-slot', [LessonsController::class, 'bookSlot'])->name('lessons.course.book-slot');
});

/*
 * Search Routes
 */
Route::get('/search', [HomeController::class, 'searchCourse'])->name('search');
Route::get('/search-course', [HomeController::class, 'searchCourse'])->name('search-course');
Route::get('/search-bundle', [HomeController::class, 'searchBundle'])->name('search-bundle');
Route::get('/search-blog', [HomeController::class, 'searchBlog'])->name('blogs.search');

/*
 * Static Pages
 */
Route::get('faqs', [HomeController::class, 'getFaqs'])->name('faqs');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('free-trial', function () {
    return view('backend.pages.free-trial');
})->name('free-trial');
Route::get('how-it-works', function () {
    return view('backend.pages.how-it-works');
})->name('how-it-works');
Route::get('download', [HomeController::class, 'getDownload'])->name('download');

/*
 * Cart and Payment Routes
 */
Route::group(['middleware' => 'auth'], function () {
    Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');
    Route::post('cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.removeCoupon');
    Route::post('cart/stripe-payment', [CartController::class, 'stripePayment'])->name('cart.stripe.payment');
    Route::post('cart/paypal-payment', [CartController::class, 'paypalPayment'])->name('cart.paypal.payment');
    Route::get('cart/paypal-payment/status', [CartController::class, 'getPaymentStatus'])->name('cart.paypal.status');
    Route::post('cart/instamojo-payment', [CartController::class, 'instamojoPayment'])->name('cart.instamojo.payment');
    Route::get('cart/instamojo-payment/status', [CartController::class, 'getInstamojoStatus'])->name('cart.instamojo.status');
    Route::post('cart/razorpay-payment', [CartController::class, 'razorpayPayment'])->name('cart.razorpay.payment');
    Route::post('cart/razorpay-payment/status', [CartController::class, 'getRazorpayStatus'])->name('cart.razorpay.status');
    Route::post('cart/cashfree-payment', [CartController::class, 'cashfreeFreePayment'])->name('cart.cashfree.payment');
    Route::post('cart/cashfree-payment/status', [CartController::class, 'getCashFreeStatus'])->name('cart.cashfree.status');
    Route::post('cart/payu-payment', [CartController::class, 'payuPayment'])->name('cart.payu.payment');
    Route::post('cart/payu-payment/status', [CartController::class, 'getPayUStatus'])->name('cart.pauy.status');
    Route::match(['GET', 'POST'], 'cart/flutter-payment', [CartController::class, 'flatterPayment'])->name('cart.flutter.payment');
    Route::get('cart/flutter-payment/status', [CartController::class, 'getFlatterStatus'])->name('cart.flutter.status');
    Route::get('status', function () {
        return view('frontend.cart.status');
    })->name('status');
    Route::post('cart/offline-payment', [CartController::class, 'offlinePayment'])->name('cart.offline.payment');
    Route::post('cart/getnow', [CartController::class, 'getNow'])->name('cart.getnow');
});

/*
 * Menu Manager Routes
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => config('menu.middleware')], function () {
    Route::post('add-custom-menu', [MenuController::class, 'addcustommenu'])->name('admin.add_custom_menu');
    Route::post('delete-item-menu', [MenuController::class, 'deleteitemmenu'])->name('admin.delete_item_menu');
    Route::post('delete-menug', [MenuController::class, 'deletemenug'])->name('admin.delete_menug');
    Route::post('create-new-menu', [MenuController::class, 'createnewmenu'])->name('admin.create_new_menu');
    Route::post('generate-menu-control', [MenuController::class, 'generatemenucontrol'])->name('admin.generate_menu_control');
    Route::post('update-item', [MenuController::class, 'updateitem'])->name('admin.update_item');
    Route::post('save-custom-menu', [MenuController::class, 'saveCustomMenu'])->name('admin.save_custom_menu');
    Route::post('change-location', [MenuController::class, 'updateLocation'])->name('admin.update_location');
});

/*
 * Certificate Routes
 */
Route::get('certificate-verification', [CertificateController::class, 'getVerificationForm'])->name('frontend.certificates.getVerificationForm');
Route::post('certificate-verification', [CertificateController::class, 'verifyCertificate'])->name('frontend.certificates.verify');
Route::get('certificates/download', [CertificateController::class, 'download'])->name('certificates.download');

/*
 * Offers Route
 */
if (config('show_offers') == 1) {
    Route::get('offers', [CartController::class, 'getOffers'])->name('frontend.offers');
}

/*
 * Laravel Filemanager Routes
 */
Route::group(['prefix' => 'LaravelFilemanager', 'middleware' => ['web', 'auth', 'role:teacher|administrator']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
    Route::name('laravel-filemanager.custom_show')->get('/{view?}/{sub?}/{path?}', '\UniSharp\LaravelFilemanager\controllers\LfmController@show');
    Route::name('laravel-filemanager.custom_download')->get('/get/{file}', '\UniSharp\LaravelFilemanager\controllers\DownloadController@get_file');
});

/*
 * Subscription Routes
 */
Route::group(['prefix' => 'subscription'], function () {
    Route::get('plans', [SubscriptionController::class, 'plans'])->name('subscription.plans');
    Route::get('{plan}/{name}', [SubscriptionController::class, 'showForm'])->name('subscription.form');
    Route::post('subscribe/{plan}', [SubscriptionController::class, 'subscribe'])->name('subscription.subscribe');
    Route::post('update/{plan}', [SubscriptionController::class, 'updateSubscription'])->name('subscription.update');
    Route::get('status', [SubscriptionController::class, 'status'])->name('subscription.status');
    Route::post('subscribe', [SubscriptionController::class, 'courseSubscribed'])->name('subscription.course_subscribe');
});

/*
 * Wishlist Routes
 */
Route::post('add-to-wishlist', [WishlistController::class, 'store'])->name('add-to-wishlist');

/*
 * Catch-All Route
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/{page?}', [HomeController::class, 'index'])->name('index');
});

/*
 * Live Lesson Slot Booking
 */
Route::post('/book-slot/{slotId}', [LiveLessonSlotController::class, 'bookSlot'])->name('book.slot');
