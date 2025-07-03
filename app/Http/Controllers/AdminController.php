<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //

    function index()
    {
        $query=User::paginate(10);  
        $totalUsers = User::count();
        $totalDonors = User::where('role', 'donor')->count();
        $totalReceivers = User::where('role', 'receiver')->count();
        $totalVolunteers = User::where('role', 'volunteer')->count();

        $currentYear = now()->year;
        $donationsData = [];
        $simplePostsData = [];
        $requestsData = [];
        $donorsData = [];
        $volunteersData = [];
        $receiversData = [];
        for ($month = 1; $month <= 12; $month++) {
            $donationsData[] = DB::table('add_donation')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
            $simplePostsData[] = DB::table('simple_post')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
            $requestsData[] = DB::table('reqeust_donation')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
            $donorsData[] = \App\Models\User::where('role', 'donor')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
            $volunteersData[] = \App\Models\User::where('role', 'volunteer')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
            $receiversData[] = \App\Models\User::where('role', 'receiver')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
        }

        // Get authenticated admin data
        $admin = Auth::guard('admin')->user();

        return view('admin.dashboard',compact(
            'query','totalUsers', 'totalDonors', 'totalReceivers', 'totalVolunteers',
            'donationsData', 'simplePostsData', 'requestsData', 'donorsData', 'volunteersData', 'receiversData', 'admin'
        ));
    }
     
public function login(Request $request)
{

    $request->validate([
        "email" => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');
        // dd(Auth::guard('admin')->attempt($credentials)); // This will dump the result of the authentication attempt
    if (Auth::guard('admin')->attempt($credentials)) {
        Alert::success('Login Successful', 'Welcome back Admin!');
        return redirect()->route('admin.dashboard'); // update with your route
    } else {
        Alert::error('Login Failed', 'Invalid email or password.');
        return redirect()->route('admin.login'); // update with your route
    }
}

public function manageUsers(Request $request)
{
    $query = User::query();
    if ($search = $request->input('search')) {
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('role', 'like', "%$search%")
              ->orWhere('id', $search);
        });
    }
    $users = $query->orderBy('id', 'desc')->paginate(10);
    
    // Get authenticated admin data
    $admin = Auth::guard('admin')->user();
    
    return view('admin.manage_user', compact('users', 'admin'));
}

public function manageUser($id)
{
    $user = User::findOrFail($id);
    return view('admin.manage_single_user', compact('user'));
}

public function logout(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login')->with('success', 'Admin logged out successfully!');
}

public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);
    $data = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'nullable|string|max:255',
        'status' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if ($request->hasFile('profile_picture')) {
        // Delete old profile picture if exists
        if ($user->profile_picture) {
            \Storage::disk('public')->delete($user->profile_picture);
        }
        $file = $request->file('profile_picture');
        $filename = 'profile_' . time() . '.' . $file->getClientOriginalExtension();
        $data['profile_picture'] = $file->storeAs('profile_pictures', $filename, 'public');
    }

    $user->update($data);
    return redirect()->back()->with('success', 'User updated successfully!');
}

public function deleteUser($id)
{
    $user = User::findOrFail($id);
    if ($user->profile_picture) {
        \Storage::disk('public')->delete($user->profile_picture);
    }
    $user->delete();
    return redirect()->back()->with('success', 'User deleted successfully!');
}

public function ajaxManageUsers(Request $request)
{
    $query = User::query();
    if ($search = $request->input('search')) {
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('role', 'like', "%$search%")
              ->orWhere('id', $search);
        });
    }
    $users = $query->orderBy('id', 'desc')->paginate(10);
    return view('admin.partials.users_table', compact('users'))->render();
}

public function profile()
{
    $admin = Auth::guard('admin')->user();
    return view('admin.profile', compact('admin'));
}

public function updateProfile(Request $request)
{
    $admin = Auth::guard('admin')->user();
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admin,email,' . $admin->id,
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $data = $request->only(['name', 'email']);

    if ($request->hasFile('profile_picture')) {
        // Delete old profile picture if exists
        if ($admin->profile_picture) {
            \Storage::disk('public')->delete($admin->profile_picture);
        }
        $file = $request->file('profile_picture');
        $filename = 'admin_profile_' . time() . '.' . $file->getClientOriginalExtension();
        $data['profile_picture'] = $file->storeAs('admin_profiles', $filename, 'public');
    }

    $admin->update($data);
    
    Alert::success('Success', 'Profile updated successfully!');
    return redirect()->back();
}

}

