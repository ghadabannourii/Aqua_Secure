<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Landing Page (Public)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Auth routes GET
Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/register', function () {
    return view('auth.register');
})->name('auth.register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('auth.forgot-password');

// Auth routes POST (DEMO - connexion simulée)
Route::post('/login', function (Request $request) {
    $email = $request->input('email');
    
    // Comptes démo
    $demoAccounts = [
        'citoyen@aquasecure.tn' => ['role' => 'citizen', 'name' => 'Yassine Hamdi'],
        'amira@aquasecure.tn' => ['role' => 'technician', 'name' => 'Amira Ben Ali'],
        'gestionnaire@aquasecure.tn' => ['role' => 'manager', 'name' => 'Ines Mansouri'],
        'admin@aquasecure.tn' => ['role' => 'admin', 'name' => 'Amina Kacem'],
    ];
    
    if (isset($demoAccounts[$email])) {
        $user = $demoAccounts[$email];
        session([
            'user' => [
                'name' => $user['name'],
                'email' => $email,
                'role' => $user['role'],
            ]
        ]);
        
        // Rediriger selon le rôle
        switch ($user['role']) {
            case 'citizen':
                return redirect()->route('citizen.dashboard');
            case 'technician':
                return redirect()->route('technician.dashboard');
            case 'manager':
                return redirect()->route('manager.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            default:
                return redirect()->route('landing');
        }
    }
    
    return back()->with('error', 'Email ou mot de passe incorrect');
})->name('login.post');

Route::post('/register', function (Request $request) {
    // Simuler une inscription réussie
    return redirect()->route('auth.login')->with('success', 'Compte créé avec succès ! Connectez-vous.');
})->name('register.post');

Route::post('/forgot-password', function (Request $request) {
    return back()->with('success', 'Si ce compte existe, un email a été envoyé.');
})->name('forgot-password.post');

// Logout
Route::post('/logout', function () {
    session()->forget('user');
    return redirect()->route('landing');
})->name('logout');

// Citizen Space (FrontOffice) - DEMO
Route::get('/citizen/dashboard', function () {
    if (!session('user') || session('user.role') !== 'citizen') {
        return redirect()->route('auth.login');
    }
    return view('citizen.dashboard');
})->name('citizen.dashboard');

// Technician Space (BackOffice) - DEMO
Route::get('/technician/dashboard', function () {
    if (!session('user') || session('user.role') !== 'technician') {
        return redirect()->route('auth.login');
    }
    return view('technician.dashboard');
})->name('technician.dashboard');

// Manager Space (BackOffice) - DEMO
Route::get('/manager/dashboard', function () {
    if (!session('user') || session('user.role') !== 'manager') {
        return redirect()->route('auth.login');
    }
    return view('manager.dashboard');
})->name('manager.dashboard');

// Admin Space (BackOffice) - DEMO
Route::get('/admin/dashboard', function () {
    if (!session('user') || session('user.role') !== 'admin') {
        return redirect()->route('auth.login');
    }
    return view('admin.dashboard');
})->name('admin.dashboard');
