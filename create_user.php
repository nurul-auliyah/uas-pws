<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

// Check if user exists
$user = User::where('email', 'admin@example.com')->first();
if (!$user) {
    $user = User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password123')
    ]);
    echo "User created: " . $user->email . "\n";
} else {
    echo "User already exists: " . $user->email . "\n";
}
