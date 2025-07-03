<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/signup', function () {
    return view('auth.signup');
})->name('signup');
Route::get('/forget_password', function () {
    return view('404');
})->name('forget');
Route::get('signup_details', function () {
    return view('auth.signup_details');
});
Route::get('user_type', function () {
    return view('auth.user_type');
});

Route::get('aboutus', function () {
    return view('404');
})->name('about_us');

Route::get('NGO', function () {
    return view('404');
})->name('ngo');

Route::get('contact us', function () {
    return view('404');
})->name('contact_us');



Route::post('signup',[UserController::class,'signup'])->name(name: 'user.signup');
// Route::post('/user/details', [UserController::class, 'storeDetails'])->name('user_details');


Route::post('user-details/step1', [UserController::class, 'step1'])->name('user_details.step1');
// Show the form// Submit the form
Route::post( 'user-details/step2', [UserController::class, 'step2'])->name('user_details.step2');
Route::post('user-details/step3', [UserController::class, 'step3'])->name('user_details.step3');
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

Route::get('/post', [PostController::class, 'show_latest_post'])->name('latest.post');





# Admin Routes
Route::get('/admin_login', function () {
    return view('admin.auth.login');
})->name('admin.login');


Route::post('/login_admin', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/manage_user', [UserController::class, 'fetch_users'])->name('manage_user');
Route::get('/manage_donar', [UserController::class, 'fetch_donars'])->name('manage_donar');
Route::get('/manage_reciver', [UserController::class, 'fetch_reciver'])->name('manage_reciver');
Route::get('/manage_volanteer', [UserController::class, 'fetch_volanteer'])->name('manage_volanteer');

Route::middleware('auth:admin')->group(function () {
});