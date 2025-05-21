<?php
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseEnrolledController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\User\VnPayController;
use App\Http\Controllers\User\CourseUserController;
use App\Http\Controllers\User\PaymentUserController;
use App\Http\Controllers\User\ThemeHomeController;
use App\Http\Controllers\User\VideoController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\User\LoginController;

use App\Http\Controllers\User\ChatBotController;

// Trang chính & đăng nhập user
Route::get('/', [ThemeHomeController::class, 'indexuser'])->name('user.index');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register'])->name('user.register');

Route::get('/filter/{id}', [ThemeHomeController::class, 'filter'])->name('user.filter');

// Trang User (Yêu cầu đăng nhập)
Route::middleware('user.auth')->prefix('user')->group(function () {
    // Payment (cho banking)
    Route::get('/course-payment/{id}', [PaymentUserController::class, 'course_payment'])->name('user.course-payment');
    Route::get('/payment/process', function () {
        return redirect()->route('user.index')->with('error', 'Phương thức không được phép!');
    })->name('user.payment.process.get');
    Route::post('/payment/process', [PaymentUserController::class, 'processPayment'])->name('user.payment.process');
    Route::post('/payment/banking/confirm', [PaymentUserController::class, 'confirmBanking'])->name('user.banking.confirm');

    // VNPay
    Route::post('/payment/vnpay/process', [VNPayController::class, 'processPayment'])->name('user.vnpay.process');
    Route::get('/payment/process/return', [VNPayController::class, 'returnPayment'])->name('user.vnpay.return');
    Route::post('/payment/vnpay/ipn', [VNPayController::class, 'ipn'])->name('user.vnpay.ipn');

    // Xử lý Video
    Route::get('/course/{id}/lesson/{lessonId}', [CourseUserController::class, 'showVideo'])->name('user.lessons.show');
    Route::get('/video/signed-url/{lessonId}', [VideoController::class, 'getSignedUrl'])->name('user.get-signed-url');

    // Course
    Route::get('/course', [ThemeHomeController::class, 'course'])->name('user.course');
    Route::get('/course-detail/{id}', [CourseUserController::class, 'course_detail'])->name('user.course-detail');
    Route::get('/course-enrolled', [ThemeHomeController::class, 'course_enrolled'])->name('user.enrolled-courses');

    // Personal Page
    Route::get('/personal/show', [ThemeHomeController::class, 'showPersonal'])->name('user.personal.show');
    Route::put('/personal/update', [ThemeHomeController::class, 'updatePersonal'])->name('user.personal.update');
    Route::post('/personal/avatar/update', [ThemeHomeController::class, 'updateAvatar'])->name('user.avatar.update');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('user.wishlist.index');
    Route::get('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('user.wishlist.toggle');
    Route::delete('/wishlist/{courseId}', [WishlistController::class, 'removeFromWishlist'])->name('user.wishlist.remove');
    Route::post('/wishlist/notification/{notificationId}/read', [WishlistController::class, 'markNotificationAsRead'])->name('user.wishlist.notification.read');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');
});

Route::prefix('/admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware("admin.auth")->group(function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // ------------ admin.admins
        Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
        Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
        Route::post('/admins', [AdminController::class, 'store'])->name('admin.admins.store');
        Route::get('/admins/{id}', [AdminController::class, 'show'])->name('admin.admins.show');
        Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admin.admins.update');
        Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');
        Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admin.admins.edit');

        // ------------ admin.users
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');

        // ------------ admin.payments
        Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
        Route::get('/payments/create', [PaymentController::class, 'create'])->name('admin.payments.create');
        Route::post('/payments', [PaymentController::class, 'store'])->name('admin.payments.store');
        Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('admin.payments.show');
        Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('admin.payments.edit');
        Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('admin.payments.update');
        Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('admin.payments.destroy');

        // ------------ admin.courses
        Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');
        Route::get('/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/courses/{id}', [CourseController::class, 'show'])->name('admin.courses.show');
        Route::put('/courses/{id}', [CourseController::class, 'update'])->name('admin.courses.update');
        Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('admin.courses.destroy');
        Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('admin.courses.edit');

        // ------------ admin.categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('admin.categories.show');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');

        // ------------ admin.lessons
        Route::get('/lessons', [LessonController::class, 'index'])->name('admin.lessons.index');
        Route::get('/lessons/create', [LessonController::class, 'create'])->name('admin.lessons.create');
        Route::post('/lessons', [LessonController::class, 'store'])->name('admin.lessons.store');
        Route::get('/lessons/{id}', [LessonController::class, 'show'])->name('admin.lessons.show');
        Route::put('/lessons/{id}', [LessonController::class, 'update'])->name('admin.lessons.update');
        Route::delete('/lessons/{id}', [LessonController::class, 'destroy'])->name('admin.lessons.destroy');
        Route::get('/lessons/{id}/edit', [LessonController::class, 'edit'])->name('admin.lessons.edit');

        // ------------ admin.reviews
        Route::get('/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
        Route::get('/reviews/create', [ReviewController::class, 'create'])->name('admin.reviews.create');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('admin.reviews.store');
        Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('admin.reviews.show');
        Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('admin.reviews.update');
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
        Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('admin.reviews.edit');

        // ------------ admin.messages
        Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages.index');
        Route::get('/messages/create', [MessageController::class, 'create'])->name('admin.messages.create');
        Route::post('/messages', [MessageController::class, 'store'])->name('admin.messages.store');
        Route::get('/messages/{id}', [MessageController::class, 'show'])->name('admin.messages.show');
        Route::put('/messages/{id}', [MessageController::class, 'update'])->name('admin.messages.update');
        Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');
        Route::get('/messages/{id}/edit', [MessageController::class, 'edit'])->name('admin.messages.edit');

        // ------------ admin.incomes
        Route::get('/incomes', [IncomeController::class, 'index'])->name('admin.incomes.index');
        Route::get('/incomes/create', [IncomeController::class, 'create'])->name('admin.incomes.create');
        Route::post('/incomes', [IncomeController::class, 'store'])->name('admin.incomes.store');
        Route::get('/incomes/{id}', [IncomeController::class, 'show'])->name('admin.incomes.show');
        Route::put('/incomes/{id}', [IncomeController::class, 'update'])->name('admin.incomes.update');
        Route::delete('/incomes/{id}', [IncomeController::class, 'destroy'])->name('admin.incomes.destroy');
        Route::get('/{id}/edit', [IncomeController::class, 'edit'])->name('admin.incomes.edit');
        Route::get('/incomes/autofill/daily', [IncomeController::class, 'autoFillDaily'])->name('admin.incomes.autofill.daily');
        Route::get('/incomes/autofill/monthly', [IncomeController::class, 'autoFillMonthly'])->name('admin.incomes.autofill.monthly');

        // ------------ admin.courseEnrolled
        Route::get('/courseEnrolled', [CourseEnrolledController::class, 'index'])->name('admin.courseEnrolled.index');
        Route::get('/courseEnrolled/create', [CourseEnrolledController::class, 'create'])->name('admin.courseEnrolled.create');
        Route::post('/courseEnrolled', [CourseEnrolledController::class, 'store'])->name('admin.courseEnrolled.store');
        Route::get('/courseEnrolled/{id}', [CourseEnrolledController::class, 'show'])->name('admin.courseEnrolled.show');
        Route::put('/courseEnrolled/{id}', [CourseEnrolledController::class, 'update'])->name('admin.courseEnrolled.update');
        Route::delete('/courseEnrolled/{id}', [CourseEnrolledController::class, 'destroy'])->name('admin.courseEnrolled.destroy');
        Route::get('/courseEnrolled/{id}/edit', [CourseEnrolledController::class, 'edit'])->name('admin.courseEnrolled.edit');
    });
});

// Chatbot
Route::get('/chat', [ChatBotController::class, 'index']);
Route::match(['get', 'post'], '/botman', [ChatBotController::class, 'handle']);
Route::match(['get', 'post'], '/botman-manual', [ChatBotController::class, 'handleManual']);

// Thông báo
// ------------ admin.notifications
Route::prefix('admin/notifications')->name('admin.notifications.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('index');
    Route::get('/{id}/read', [App\Http\Controllers\Admin\NotificationController::class, 'read'])->name('read');
    Route::post('/mark-all-read', [App\Http\Controllers\Admin\NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');
});