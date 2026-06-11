<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\CrmLead;

$l = CrmLead::first();
if ($l) {
    $l->counsellor_id = 3;
    $l->save();
    echo "Lead " . $l->id . " assigned to user 3\n";
}
