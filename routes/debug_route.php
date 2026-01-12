<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/debug-user', function () {
    if (!Auth::check()) {
        return 'Not Logged In';
    }

    $user = Auth::user();

    echo "<h1>Debug User Info</h1>";
    echo "<pre>";
    print_r($user->toArray());
    echo "</pre>";

    echo "<h2>Role Check</h2>";
    echo "Role property: " . ($user->role ?? 'NULL') . "<br>";
    echo "isAdmin(): " . ($user->isAdmin() ? 'YES' : 'NO') . "<br>";
    echo "isAgent(): " . ($user->isAgent() ? 'YES' : 'NO') . "<br>";

    echo "<h2>Instructions</h2>";
    echo "If Role is NULL or 'user', please manually update the 'profiles' table in Supabase.";
    echo "Set 'role' column to 'admin' for user ID: " . $user->id;
});
