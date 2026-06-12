<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('title', 'Edit Stock')
    @include('admin.layouts.common.header_script')
</head>
<body>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    @include('supplier.layouts.sidebar')

    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-lightblue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            @if(isset($setting) && !empty($setting->logo_path) && file_exists(public_path('uploads/setting/'.$setting->logo_path)))
            <a href="{{ route('supplier.dashboard.index') }}" class="b-brand">
                <div class="b-bg">
                    <img src="{{ asset('uploads/setting/'.$setting->logo_path) }}" alt="logo" height="20">
                </div>
            </a>
            @endif
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li>
                    <h4 class="topbar-title">{{ $setting->title ?? 'Supplier Portal' }}</h4>
                </li>
            </ul>
        </div>
    </header>

    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="page-header mb-4">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <ul class="breadcrumb" style="background: transparent; padding: 0; margin-bottom: 5px;">
                                                <li class="breadcrumb-item"><a href="{{ route('supplier.dashboard.index') }}" class="text-muted">Pages</a></li>
                                                <li class="breadcrumb-item"><a href="{{ route('supplier.stock.index') }}" class="text-muted">My Stocks</a></li>
                                                <li class="breadcrumb-item text-muted">Edit Stock</li>
                                            </ul>
                                            <div class="page-header-title">
                                                <h5 class="m-b-10" style="font-weight: 700; color: #333;">Edit Stock</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card" style="border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: none;">
                                        <div class="card-header text-white" style="background-color: #198754; border-radius: 10px 10px 0 0; padding: 20px;">
                                            <h5 class="text-white m-0" style="font-weight: 600;">Edit Stock Record</h5>
                                        </div>
                                        
                                        <form class="needs-validation" novalidate action="{{ route('supplier.stock.update', $stock->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul class="mb-0">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="item_id" class="form-label">Item <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="item_id" id="item_id" required>
                                                        <option value="">Select Item</option>
                                                        @foreach( $items as $item )
                                                        <option value="{{ $item->id }}" @if(old('item_id', $stock->item_id) == $item->id) selected @endif>{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="store_id" class="form-label">Store <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="store_id" id="store_id" required>
                                                        <option value="">Select Store</option>
                                                        @foreach( $stores as $store )
                                                        <option value="{{ $store->id }}" @if(old('store_id', $stock->store_id) == $store->id) selected @endif>{{ $store->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{ old('quantity', $stock->quantity) }}" required min="1">
                                                </div>

                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                                    <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{ old('price', $stock->price) }}" required min="0">
                                                </div>

                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="date" id="date" value="{{ old('date', $stock->date) }}" required>
                                                </div>

                                                <div class="form-group col-md-12 mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $stock->description) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer" style="background-color: #f8f9fa; border-radius: 0 0 10px 10px;">
                                            <a href="{{ route('supplier.stock.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</a>
                                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Update Stock</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.common.footer_script')
</body>
</html>
