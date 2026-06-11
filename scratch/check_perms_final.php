<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\User;

$u = User::find(3);
if ($u) {
    echo "User 3 Role: " . implode(', ', $u->getRoleNames()->toArray()) . "\n";
    echo "Can view crm-lead: " . var_export($u->can('crm-lead-view'), true) . "\n";
}
