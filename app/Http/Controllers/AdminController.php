<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\RegisteredMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function AdminDashboard(Request $request)
    {
        $totalUsers = User::count();
        return view('admin.index', compact('totalUsers'));
    }

    public function AdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        return view('admin.admin_login');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

    return redirect('admin/login');
    }


    public function AdminProfile(Request $request)
    {
        return view('admin.admin_profile');
    }

    public function AdminProfileEdit(Request $request)
    {
        $id = Auth::user()->id;
        $adminData = Auth::user();
        return view('admin.admin_edit_profile', compact('adminData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = Auth::user();
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        //$data->role = $request->role; // Added role field

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        if ($request->password) {
            $data->password = bcrypt($request->password);
        }

        $data->save();

        $notification = [
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        session()->flash('notification', $notification);

        return redirect()->route('admin.profile')->with($notification);
    }


    public function list(Request $request)
    {
        $users = User::paginate(10);
        return view('admin.users.list', compact('users'));
    }

    public function search(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $role = $request->role;

        $users = User::where('name', 'like', '%' . $name . '%')
                    ->where('email', 'like', '%' . $email . '%')
                    ->where('role', 'like', '%' . $role . '%')
                    ->paginate(10);

        return view('admin.users.list', compact('users'));
    }

    public function add(Request $request)
    {
        return view('admin.users.add');
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'nullable|string|max:20',
        'role' => 'required|in:admin,agent,user',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->role = $request->role;
    $user->remember_token = Str::random(50);  // Generate token for password setup
    $user->status = $request->has('status') ? 1 : 0;

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = date('YmdHi') . $file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'), $filename);
        $user->photo = $filename;
    }

    // Set a default password for the user
    $user->password = bcrypt('defaultpassword');

    $user->save();

    // Send the password setup email
    \Mail::to($user->email)->send(new \App\Mail\RegisteredMail($user, $user->remember_token));

    $notification = [
        'message' => 'User Added Successfully',
        'alert-type' => 'success'
    ];

    return redirect()->route('admin.users.list')->with($notification);
    }


    public function sendMailtrapEmail($user, $rememberToken)
   {
        \Mail::to($user->email)->send(new \App\Mail\RegisteredMail($user, $rememberToken));
   }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // This for user update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,agent,user',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->status = $request->has('status') ? 1 : 0;
        $user->address = $request->address;


    // Handle the photo upload and delete the old photo if it exists
    if ($request->hasFile('photo')) {
        // Delete the old photo
        if ($user->photo && file_exists(public_path('upload/admin_images/' . $user->photo))) {
            unlink(public_path('upload/admin_images/' . $user->photo));
        }

        // Save the new photo
        $file = $request->file('photo');
        $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload/admin_images'), $filename);
        $user->photo = $filename; // Save the filename to the database
    }

    $user->save();

        $notification = [
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.users.list')->with($notification);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        // Soft delete the user
        $user->delete();

        $notification = [
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.users.list')->with($notification);
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        $notification = [
            'message' => 'User Restored Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.users.list')->with($notification);
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        // Delete user's photo if it exists
        if ($user->photo && file_exists(public_path('upload/admin_images/'.$user->photo))) {
            unlink(public_path('upload/admin_images/'.$user->photo));
        }

        $user->forceDelete();

        $notification = [
            'message' => 'User Permanently Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.users.list')->with($notification);
    }

    // public function showSetPasswordForm($token)
    // {
    //     return view('auth.reset_pass');
    // }

    // for set password
    public function showSetPasswordForm($token)
    {
    // Find the user with the matching token
    $user = User::where('remember_token', $token)->first();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Invalid or expired token.');
    }

    return view('auth.reset_pass', compact('user'));
    }

    public function setNewPassword(Request $request, $token)
    {
    // Validate the password fields
    $request->validate([
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::where('remember_token', $token)->first();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Invalid or expired token.');
    }

    // Update the password
    $user->password = Hash::make($request->password);
    $user->remember_token = null; // Clear the token after setting password
    $user->save();

    return redirect()->route('login')->with('success', 'Password set successfully. Please login.');
    }

    public function view($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.view', compact('user'));
    }


    public function registrationChartData()
    {
        $currentYear = Carbon::now()->year;
        $registrations = User::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
                             ->whereYear('created_at', $currentYear)
                             ->groupBy('month')
                             ->orderBy('month')
                             ->pluck('count', 'month')
                             ->toArray();

        $userCounts = array_map(function ($month) use ($registrations) {
            return $registrations[$month] ?? 0;
        }, range(1, 12));

        return response()->json([
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => array_values($userCounts)
        ]);
    }
}
