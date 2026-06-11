@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Assign Asset to User</h5>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.asset-assignment.store') }}" method="post">
                    @csrf
                    <div class="card-block">
                        <div class="form-group">
                            <label class="form-label">Asset <span>*</span></label>
                            <select class="form-control" name="asset_id" required>
                                <option value="">-- Select Asset --</option>
                                @foreach($assets as $asset)
                                <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                    {{ $asset->name }} {{ $asset->serial_number ? '('.$asset->serial_number.')' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Assign To (User) <span>*</span></label>
                            <select class="form-control" name="user_id" required>
                                <option value="">-- Select User --</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Assigned Date <span>*</span></label>
                                    <input type="date" class="form-control" name="assigned_date" value="{{ old('assigned_date', date('Y-m-d')) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Expected Return Date</label>
                                    <input type="date" class="form-control" name="return_date" value="{{ old('return_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Note</label>
                            <textarea class="form-control" name="note" rows="3" placeholder="Optional note...">{{ old('note') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.asset-assignment.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Assign Asset</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
