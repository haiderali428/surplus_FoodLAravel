<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $data = $request->validate([
            'email' => [
                'required',
                'email',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    $allowedDomains = [
                        'gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com', 'aol.com',
                        'icloud.com', 'protonmail.com', 'mail.com', 'yandex.com', 'zoho.com'
                    ];

                    $domain = substr(strrchr($value, "@"), 1);

                    if (!in_array($domain, $allowedDomains)) {
                        $fail('The email domain is not allowed. Please use a popular email provider.');
                    }
                },
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'c_password' => 'required|same:password',
        ], [
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one letter, one number, and one special character.',
            'c_password.same' => 'The confirmation password must match the password.',
        ]);

        session(['email' => $data['email']]);
        session(['password' => $data['password']]);
        session(['step' => 1]);

        return redirect()->route('user_details.step1')->with('success', 'Step 1 Complete: Email and password validated successfully!');
    }

    public function step1(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Handle profile picture upload
        $profilePicturePath = session('profile_picture');
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
            $profilePicturePath = $file->storeAs('profile_pictures', $filename, 'public');
        }

        session(['email' => $data['email']]);
        session(['fname' => $data['fname']]);
        session(['lname' => $data['lname']]);
        session(['address' => $data['address']]);
        session(['city' => $data['city']]);
        session(['profile_picture' => $profilePicturePath]);
        session(['step' => 2]);

        return redirect()->route('user_details.step2')->with('success', 'Step 2 Complete: Personal details saved successfully!');
    }

    public function step2(Request $request)
    {
        $data = $request->validate([
            'number' => 'required|numeric|unique:users,phone_number',
        ], [
            'number.unique' => 'This phone number is already registered. Please use a different number.',
        ]);

        session(['number' => $data['number']]);
        $otp = strval(rand(1000, 9999));
        session(['otp' => $otp]);
        session(['step' => 3]);
        Mail::to(session('email'))->send(new OtpMail($otp));

        return redirect()->route('user_details.step3')->with('success', 'Step 3 Ready: Phone number saved! Please enter the OTP sent to your email.');
    }

    public function step3(Request $request)
    {
        $data = $request->validate([
            'otp' => 'required|array|size:4',
            'otp.*' => 'required|numeric',
        ]);

        $enteredOtp = implode('', $data['otp']);
        $sessionOtp = session('otp');

        if ($enteredOtp === $sessionOtp) {
            session(['step' => 4]);
            return redirect()->route('user_type')->with('success', 'OTP Verified: Your OTP has been successfully verified.');
        } else {
            session(['step' => 3]);
            return redirect()->route('user_details.step3')->with('error', 'Invalid OTP: The OTP you entered is incorrect. Please try again.');
        }
    }

    public function finalSubmit()
    {
        return view('auth.user_type');
    }

    public function selectRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:volunteer,donor,receiver',
        ]);

        $data = session()->all();
        // Check for all required fields before creating the user
        $required = ['email', 'password', 'fname', 'lname', 'address', 'city', 'number', 'otp'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                \Log::error('Registration session missing field: ' . $field, $data);
                return redirect()->route('signup')->with('error', 'Registration session expired or incomplete. Please start again.');
            }
        }

        session(['selected_role' => $request->role]);

        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'first_name' => $data['fname'],
            'last_name' => $data['lname'],
            'address' => $data['address'],
            'city' => $data['city'],
            'phone_number' => $data['number'],
            'otp' => $data['otp'],
            'role' => $request->role,
            'profile_picture' => $data['profile_picture'] ?? null,
        ]);

        session()->flush();

        Alert::success('Success', 'Account created successfully!');
        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => 'required',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('post')->with('success', 'Login Successful! Welcome back!');
        } else {
            return redirect()->route('login')->with('error', 'Login Failed! Invalid email or password.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Alert::info('Logged Out', 'You have been logged out.');
        return redirect('/');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'No account found with this email address.',
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Generate reset token
        $token = \Str::random(64);
        
        // Store reset token in database
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        // Send reset email
        Mail::to($request->email)->send(new \App\Mail\PasswordResetMail($token));

        return redirect()->back()->with('success', 'Password reset link has been sent to your email!');
    }

    public function showResetForm($token)
    {
        $resetToken = \DB::table('password_reset_tokens')
            ->where('token', $token)
            ->where('created_at', '>', now()->subHours(1))
            ->first();

        if (!$resetToken) {
            Alert::error('Error', 'Invalid or expired reset link.');
            return redirect()->route('login');
        }

        return view('auth.update_password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'password_confirmation' => 'required|same:password',
        ], [
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one letter, one number, and one special character.',
            'password_confirmation.same' => 'The confirmation password must match the password.',
        ]);

        $resetToken = \DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->where('created_at', '>', now()->subHours(1))
            ->first();

        if (!$resetToken) {
            Alert::error('Error', 'Invalid or expired reset link.');
            return redirect()->route('login');
        }

        // Update user password
        $user = User::where('email', $resetToken->email)->first();
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        // Delete the reset token
        \DB::table('password_reset_tokens')
            ->where('email', $resetToken->email)
            ->delete();

        Alert::success('Success', 'Your password has been reset successfully!');
        return redirect()->route('login');
    }

    public function getNotifications(Request $request)
    {
        \Log::info('getNotifications method called');
        
        if (!Auth::check()) {
            \Log::warning('User not authenticated');
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        
        $user = Auth::user();
        \Log::info('User authenticated: ' . $user->email);
        
        $notifications = $user->notifications()->orderBy('created_at', 'desc')->take(20)->get();
        \Log::info('Notifications found: ' . $notifications->count());
        
        $unreadCount = $user->unreadNotifications()->count();
        \Log::info('Unread count: ' . $unreadCount);
        
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    public function clearNotifications(Request $request)
    {
        $user = Auth::user();
        $user->notifications()->delete();
        return response()->json(['success' => true]);
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|unique:users,phone_number,' . $user->id,
            'address' => 'required|string',
            'city' => 'required|string',
            'role' => 'required|in:donor,receiver,volunteer',
        ]);

        $data = $request->only(['first_name', 'last_name', 'email', 'phone_number', 'address', 'city', 'role']);

        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:8',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'confirm_password' => 'required|same:new_password',
        ], [
            'new_password.min' => 'The password must be at least 8 characters long.',
            'new_password.regex' => 'The password must contain at least one letter, one number, and one special character.',
            'confirm_password.same' => 'The confirmation password must match the new password.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile')->with('error', 'Current password is incorrect.');
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('profile')->with('success', 'Password updated successfully!');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        
        // Delete profile picture if exists
        if ($user->profile_picture) {
            \Storage::disk('public')->delete($user->profile_picture);
        }
        
        // Delete user's notifications
        $user->notifications()->delete();
        
        // Delete user
        $user->delete();
        
        Auth::logout();
        
        return redirect()->route('home')->with('success', 'Account deleted successfully.');
    }

    public function receivedDonations()
    {
        $user = Auth::user();
        $receivedRequests = \App\Models\RequestDonation::with('post')
            ->where('user_id', $user->id)
            ->where('status', 'approved')
            ->get();
        return view('donation_requests.received', compact('receivedRequests'));
    }

    public function pendingDonations()
    {
        $user = Auth::user();
        $pendingRequests = \App\Models\RequestDonation::with('post')
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->get();
        return view('donation_requests.pending', compact('pendingRequests'));
    }

    // Google OAuth Login
    public function redirectToGoogle()
    {
        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')->stateless()->user();

            $user = \App\Models\User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'first_name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'profile_picture' => $googleUser->getAvatar(),
                    'role' => 'user', // or your default role
                ]
            );

            \Auth::login($user);

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to login with Google.');
        }
    }
}
