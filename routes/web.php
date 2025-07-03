<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NGOController;
use App\Http\Controllers\NeedyPersonController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/signup', function () {
    return view('auth.signup');
})->name('signup');
Route::get('/forget_password', function () {
    return view('auth.forget');
})->name('forget');
Route::get('signup_details', function () {
    return view('auth.signup_details');
});
Route::get('user_type', function () {
    return view('auth.user_type');
})->name('user_type');

Route::get('aboutus', function () {
    return view('about');
})->name('about_us');

Route::get('NGO', [NGOController::class, 'index'])->name('ngo');

Route::get('/contact-us', function () {
    return view('contact_us');
})->name('contact_us');

Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact_us.submit');

Route::post('signup',[UserController::class,'signup'])->name(name: 'user.signup');
// Route::post('/user/details', [UserController::class, 'storeDetails'])->name('user_details');


Route::get('user-details/step1', function () {
    return view('auth.signup_details', ['step' => 1]);
})->name('user_details.step1');
Route::post('user-details/step1', [UserController::class, 'step1']);
Route::get('user-details/step2', function () {
    return view('auth.signup_details', ['step' => 2]);
})->name('user_details.step2');
Route::post('user-details/step2', [UserController::class, 'step2']);
Route::get('user-details/step3', function () {
    return view('auth.signup_details', ['step' => 3]);
})->name('user_details.step3');
Route::post('user-details/step3', [UserController::class, 'step3']);
Route::post('/select-role', [UserController::class, 'selectRole'])->name('user.selectRole');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

 Route::post('/user_login', [UserController::class, 'login'])->name('user.login');

Route::get('/test-email', function () {
    Mail::raw('This is a test email.', function ($message) {
        $message->to('shehryarshafique46@gmail.com')
                ->subject('Test Email');
    });

    return 'Test email sent!';
});


//POSTS
    Route::post('/add donation',[PostController::class,'add_donation'])->name('add.donation');


#simple Post Creation 
Route::post('/simple_post',[PostController::class,'simple_Post'])->name('simple.post');

#image post creation
Route::post('/image_post',[PostController::class,'image_Post'])->name('image.post');

#video post creation
Route::post('/video_post',[PostController::class,'video_Post'])->name('video.post');

Route::post('/request_food_post',[PostController::class,'donation_request'])->name('request.donation');

# fetch posts 
Route::get('/post', [PostController::class, 'fetch_posts'])->name('post');

Route::post('/posts/{id}/like', [PostController::class, 'toggleLike'])->middleware('auth')->name('posts.like');

Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

Route::get('/latest-post', [PostController::class, 'show_latest_post'])->name('latest.post');

Route::get('/posts/{id}/comments', [PostController::class, 'getComments'])->name('posts.comments');





# Admin Routes
Route::get('/admin_login', function () {
    return view('admin.auth.login');
})->name('admin.login');

Route::post('/login_admin', [AdminController::class, 'login'])->name('admin.login.submit');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/manage-users', [App\Http\Controllers\AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/manage-users/{id}', [App\Http\Controllers\AdminController::class, 'manageUser'])->name('admin.users.manage');
    Route::put('/admin/manage-users/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/manage-users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::post('/admin/manage-users/ajax', [App\Http\Controllers\AdminController::class, 'ajaxManageUsers'])->name('admin.users.ajax');
    
    // Admin Needy Persons Routes
    Route::get('/admin/needy-persons', [App\Http\Controllers\NeedyPersonController::class, 'index'])->name('admin.needypersons');
    Route::post('/admin/needy-persons/{id}/approve', [App\Http\Controllers\NeedyPersonController::class, 'approve'])->name('admin.needypersons.approve');
    Route::post('/admin/needy-persons/{id}/reject', [App\Http\Controllers\NeedyPersonController::class, 'reject'])->name('admin.needypersons.reject');
    Route::get('/admin/needy-persons/{id}/edit', [App\Http\Controllers\NeedyPersonController::class, 'edit'])->name('admin.needypersons.edit');
    Route::delete('/admin/needy-persons/{id}', [App\Http\Controllers\NeedyPersonController::class, 'destroy'])->name('admin.needypersons.delete');
    Route::put('/admin/needy-persons/{id}', [App\Http\Controllers\NeedyPersonController::class, 'update'])->name('admin.needypersons.update');
    Route::post('/admin/needy-persons/ajax-pending', [App\Http\Controllers\NeedyPersonController::class, 'ajaxPendingTable'])->name('admin.needypersons.ajaxPending');
    Route::post('/admin/needy-persons/ajax-approved', [App\Http\Controllers\NeedyPersonController::class, 'ajaxApprovedTable'])->name('admin.needypersons.ajaxApproved');
    
    // Admin Profile Routes
    Route::get('/admin/profile', [App\Http\Controllers\AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile/update', [App\Http\Controllers\AdminController::class, 'updateProfile'])->name('admin.profile.update');
    
    // Admin Logout Route
    Route::post('/admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    
    // Admin Settings Route (placeholder)
    Route::get('/admin/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');
    
    // Admin Reports Route (placeholder)
    Route::get('/admin/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');
});

Route::post('/forget_password', [UserController::class, 'forgotPassword'])->name('forgot.password');
Route::get('/reset_password/{token}', [UserController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset_password', [UserController::class, 'resetPassword'])->name('password.reset.submit');

Route::get('/notifications', [UserController::class, 'getNotifications'])->middleware('auth')->name('notifications.get');
Route::post('/notifications/clear', [UserController::class, 'clearNotifications'])->middleware('auth')->name('notifications.clear');

// Profile routes
Route::get('/profile', [UserController::class, 'showProfile'])->middleware('auth')->name('profile');
Route::post('/profile/update', [UserController::class, 'updateProfile'])->middleware('auth')->name('profile.update');
Route::post('/profile/update-password', [UserController::class, 'updatePassword'])->middleware('auth')->name('profile.update-password');
Route::delete('/profile/delete', [UserController::class, 'deleteAccount'])->middleware('auth')->name('profile.delete');

Route::middleware('auth')->group(function () {
    Route::get('/donation-requests/{post}', [PostController::class, 'showRequests'])->name('donation.requests');
    Route::post('/donation-requests/{request}/approve', [PostController::class, 'approveRequest'])->name('donation.requests.approve');
    Route::post('/donation-requests/{request}/reject', [PostController::class, 'rejectRequest'])->name('donation.requests.reject');
});

Route::get('/my-donation-requests', [PostController::class, 'myDonationRequests'])
    ->middleware('auth')
    ->name('my.donation.requests');

Route::get('/ngos/{ngo}/needy-persons', [App\Http\Controllers\NGOController::class, 'showNeedyPersons'])->name('ngos.needy_persons');
Route::get('/ngos/name/{ngoName}', [App\Http\Controllers\NGOController::class, 'showByName'])->name('ngos.showByName');

Route::resource('needy-person', NeedyPersonController::class)->only(['create', 'store']);

Route::get('/received-donations', [UserController::class, 'receivedDonations'])->middleware('auth')->name('received.donations');
Route::get('/pending-donations', [UserController::class, 'pendingDonations'])->middleware('auth')->name('pending.donations');

// Google OAuth routes
Route::get('auth/google', [UserController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback']);