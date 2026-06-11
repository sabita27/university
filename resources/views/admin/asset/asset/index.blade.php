@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        <!-- Header -->
        <div class="row align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">{{ $title }}</h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('admin.asset.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Asset
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-block">
                <form method="GET" action="{{ route('admin.asset.index') }}">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Asset Name</label>
                                <input type="text" class="form-control" name="name" value="{{ request('name') }}" placeholder="Search name...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Asset Type</label>
                                <select class="form-control" name="type">
                                    <option value="">All Types</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Working Status</label>
                                <select class="form-control" name="working_status">
                                    <option value="">All</option>
                                    <option value="1" {{ request('working_status') === '1' ? 'selected' : '' }}>Working</option>
                                    <option value="0" {{ request('working_status') === '0' ? 'selected' : '' }}>Not Working</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Availability</label>
                                <select class="form-control" name="availability_status">
                                    <option value="">All</option>
                                    <option value="1" {{ request('availability_status') === '1' ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ request('availability_status') === '0' ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Purchased From</label>
                                <input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Purchased To</label>
                                <input type="date" class="form-control" name="date_to" value="{{ request('date_to') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Search</button>
                            <a href="{{ route('admin.asset.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-sync-alt"></i> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-block">
                <div class="table-responsive">
                    <table id="basic-table" class="display table nowrap table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asset Name</th>
                                <th>Type</th>
                                <th>Brand</th>
                                <th>Serial No.</th>
                                <th>Purchased Date</th>
                                <th>Working</th>
                                <th>Available</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->assetType->title ?? '—' }}</td>
                                <td>{{ $row->assetBrand->title ?? '—' }}</td>
                                <td>{{ $row->serial_number ?? '—' }}</td>
                                <td>{{ $row->purchased_date ? $row->purchased_date->format('d M, Y') : '—' }}</td>
                                <td>
                                    <a href="{{ route('admin.asset.working-status', $row->id) }}" class="badge badge-pill {{ $row->working_status == 1 ? 'badge-success' : 'badge-danger' }}">
                                        {{ $row->working_status == 1 ? 'Working' : 'Not Working' }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.asset.availability-status', $row->id) }}" class="badge badge-pill {{ $row->availability_status == 1 ? 'badge-success' : 'badge-danger' }}">
                                        {{ $row->availability_status == 1 ? 'Available' : 'Not Available' }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.asset.show', $row->id) }}" class="btn btn-icon btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.asset.edit', $row->id) }}" class="btn btn-icon btn-primary btn-sm"><i class="far fa-edit"></i></a>
                                    <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    @include('admin.layouts.inc.delete')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
