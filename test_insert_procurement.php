<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Procurement;

$procurement = Procurement::create([
    'procurement_number' => 'TEST'.time(),
    'name' => 'John Doe',
    'purpose' => 'Test purpose',
    'assets' => [],
    'request_date' => date('Y-m-d'),
    'status' => Procurement::STATUS_PENDING,
    'urgency' => 'Other',
    'urgency_reason' => 'Testing urgent',
    'staff_id' => null,
    'asset_id' => null,
]);

echo "Inserted ID: ".$procurement->id.PHP_EOL;

$found = Procurement::find($procurement->id);
if($found) {
    echo "Record exists: ".json_encode($found->toArray()).PHP_EOL;
} else {
    echo "Record not found".PHP_EOL;
}
?>
