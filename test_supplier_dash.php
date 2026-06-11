<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$supplier = App\Models\ItemSupplier::where('email', 'satudo@mailinator.com')->first();

$request = Illuminate\Http\Request::create('/supplier/dashboard', 'GET', [], [], [], ['HTTP_HOST' => 'localhost']);
$request->setUserResolver(function() use ($supplier) {
    return $supplier;
});
Auth::guard('supplier')->login($supplier);

$response = $kernel->handle($request);

echo "STATUS: " . $response->status() . "\n";
echo "EXCEPTION: " . ($response->exception ? $response->exception->getMessage() : "None") . "\n";
echo substr($response->getContent(), 0, 500);
