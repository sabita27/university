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
                <a href="{{ route('admin.asset-assignment.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Assign to User
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-block">
                <form method="GET" action="{{ route('admin.asset-assignment.index') }}">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">User Name</label>
                                <select class="form-control" name="user_id">
                                    <option value="">All Users</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </option>
                                    @endforeach
                                </select>
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
                                <label class="form-label">Damaged</label>
                                <select class="form-control" name="is_damaged">
                                    <option value="">All</option>
                                    <option value="1" {{ request('is_damaged') === '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ request('is_damaged') === '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Returned</label>
                                <select class="form-control" name="is_returned">
                                    <option value="">All</option>
                                    <option value="1" {{ request('is_returned') === '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ request('is_returned') === '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Assigned Date</label>
                                <input type="date" class="form-control" name="assigned_date" value="{{ request('assigned_date') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="form-label">Return Date</label>
                                <input type="date" class="form-control" name="return_date" value="{{ request('return_date') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Search</button>
                            <a href="{{ route('admin.asset-assignment.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-sync-alt"></i> Reset</a>
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
                                <th>Asset Type</th>
                                <th>Assigned To</th>
                                <th>Assigned Date</th>
                                <th>Return Date</th>
                                <th>Damaged</th>
                                <th>Returned</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $key => $row)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $row->asset->name ?? '—' }}</td>
                                <td>{{ $row->asset->assetType->title ?? '—' }}</td>
                                <td>{{ $row->user->first_name ?? '' }} {{ $row->user->last_name ?? '' }}</td>
                                <td>{{ $row->assigned_date->format('d M, Y') }}</td>
                                <td>{{ $row->return_date ? $row->return_date->format('d M, Y') : '—' }}</td>
                                <td>
                                    <span class="badge badge-pill {{ $row->is_damaged ? 'badge-danger' : 'badge-secondary' }}">
                                        {{ $row->is_damaged ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-pill {{ $row->is_returned ? 'badge-success' : 'badge-warning' }}">
                                        {{ $row->is_returned ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.asset-assignment.edit', $row->id) }}">
                                                <i class="far fa-edit"></i> Edit
                                            </a>
                                            <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </div>
                                    </div>
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
