<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$supplier = \App\Models\ItemSupplier::find(1);
$item = \App\Models\Item::with('stocks')->find(3);

echo "Stocks array: \n";
print_r($item->stocks->toArray());

echo "Filtered sum: \n";
echo $item->stocks->where('supplier_id', $supplier->id)->sum('quantity');
