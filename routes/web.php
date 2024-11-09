<?php

use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailComposerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', Role::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::post('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    // Admin Profile Routes
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    // Admin Password Change Routes
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    Route::get('admin/users', [AdminController::class, 'list'])->name('admin.users.list');
    Route::get('admin/users/add', [AdminController::class, 'add'])->name('admin.users.add');
    Route::post('admin/users/store', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('admin/users/view/{id}', [AdminController::class, 'view'])->name('admin.users.view');
    Route::get('admin/users/edit/{id}', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::post('admin/users/update/{id}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::get('admin/users/delete/{id}', [AdminController::class, 'delete'])->name('admin.users.delete');
    Route::put('admin/users/update/{id}', [AdminController::class, 'update'])->name('admin.users.update');


    Route::get('admin/users/search', [AdminController::class, 'search'])->name('admin.users.search');

    Route::get('admin/admin_dashboard', [AdminController::class, 'registrationChartData'])->name('admin.registration.chart');

    Route::get('admin/email/composer', [EmailComposerController::class, 'composer'])->name('admin.email.composer');
    Route::post('admin/email/send', [EmailComposerController::class, 'sendEmail'])->name('admin.email.send');
    Route::get('admin/email/sent', [EmailComposerController::class, 'sent'])->name('admin.email.sent');
    Route::get('admin/email/read/{id}', [EmailComposerController::class, 'read'])->name('admin.email.read');
    Route::post('admin/email/draft', [EmailComposerController::class, 'storeDraft'])->name('admin.email.draft');
    Route::get('admin/email/drafts', [EmailComposerController::class, 'getDrafts'])->name('admin.email.drafts');
    Route::put('admin/email/draft/{id}', [EmailComposerController::class, 'updateDraft'])->name('admin.email.draft.update');

});


// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
//     // Add other user routes here
// });

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    // Add other agent routes here
});


// Route to show the set password form
Route::post('set_password/{token}', [AdminController::class, 'setNewPassword'])->name('save_new_password');
Route::get('set_new_password/{token}', [AdminController::class, 'showSetPasswordForm'])->name('set_new_password');
Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

require __DIR__.'/auth.php';
