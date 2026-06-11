<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\User;
use Illuminate\Support\Facades\Hash;

$u = User::find(3);
if ($u) {
    $u->password = Hash::make('password123');
    $u->save();
    echo "Password updated for user 3\n";
}
