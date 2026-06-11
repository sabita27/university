@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Asset</h5>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.asset.update', $row->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-block">
                        <div class="form-group">
                            <label class="form-label">Asset Name <span>*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $row->name }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Asset Type</label>
                                    <select class="form-control" name="asset_type_id">
                                        <option value="">-- Select Type --</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ $row->asset_type_id == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
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
                                        <option value="{{ $brand->id }}" {{ $row->asset_brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Serial Number</label>
                                    <input type="text" class="form-control" name="serial_number" value="{{ $row->serial_number }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Purchased Date</label>
                                    <input type="date" class="form-control" name="purchased_date" value="{{ $row->purchased_date ? $row->purchased_date->format('Y-m-d') : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Purchased Cost</label>
                            <input type="number" step="0.01" class="form-control" name="purchased_cost" value="{{ $row->purchased_cost }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Working Status</label>
                                    <select class="form-control" name="working_status">
                                        <option value="1" {{ $row->working_status == 1 ? 'selected' : '' }}>Working</option>
                                        <option value="0" {{ $row->working_status == 0 ? 'selected' : '' }}>Not Working</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Availability Status</label>
                                    <select class="form-control" name="availability_status">
                                        <option value="1" {{ $row->availability_status == 1 ? 'selected' : '' }}>Available</option>
                                        <option value="0" {{ $row->availability_status == 0 ? 'selected' : '' }}>Not Available</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3">{{ $row->description }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.asset.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Update Asset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
