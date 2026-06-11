@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Asset</h5>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.asset.store') }}" method="post">
                    @csrf
                    <div class="card-block">
                        <div class="form-group">
                            <label class="form-label">Asset Name <span>*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter asset name" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Asset Type</label>
                                    <select class="form-control" name="asset_type_id">
                                        <option value="">-- Select Type --</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ old('asset_type_id') == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Asset Brand</label>
                                    <select class="form-control" name="asset_brand_id">
                                        <option value="">-- Select Brand --</option>
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('asset_brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Serial Number</label>
                                    <input type="text" class="form-control" name="serial_number" value="{{ old('serial_number') }}" placeholder="Serial number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Purchased Date</label>
                                    <input type="date" class="form-control" name="purchased_date" value="{{ old('purchased_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Purchased Cost</label>
                            <input type="number" step="0.01" class="form-control" name="purchased_cost" value="{{ old('purchased_cost') }}" placeholder="0.00">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Optional description...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.asset.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Save Asset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
