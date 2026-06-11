@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<div class="main-body">
    <div class="page-wrapper">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Asset Details — {{ $row->name }}</h5>
                        <a href="{{ route('admin.asset.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr><th width="40%">Asset Name</th><td>{{ $row->name }}</td></tr>
                                    <tr><th>Type</th><td>{{ $row->assetType->title ?? '—' }}</td></tr>
                                    <tr><th>Brand</th><td>{{ $row->assetBrand->title ?? '—' }}</td></tr>
                                    <tr><th>Serial No.</th><td>{{ $row->serial_number ?? '—' }}</td></tr>
                                    <tr><th>Purchased Date</th><td>{{ $row->purchased_date ? $row->purchased_date->format('d M, Y') : '—' }}</td></tr>
                                    <tr><th>Purchased Cost</th><td>{{ $row->purchased_cost ? number_format($row->purchased_cost, 2) : '—' }}</td></tr>
                                    <tr>
                                        <th>Working Status</th>
                                        <td>
                                            <span class="badge badge-pill {{ $row->working_status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                {{ $row->working_status == 1 ? 'Working' : 'Not Working' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Availability</th>
                                        <td>
                                            <span class="badge badge-pill {{ $row->availability_status == 1 ? 'badge-success' : 'badge-danger' }}">
                                                {{ $row->availability_status == 1 ? 'Available' : 'Not Available' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr><th>Description</th><td>{{ $row->description ?? '—' }}</td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Assignment History</h6>
                                @forelse($row->assignments as $assignment)
                                <div class="card border-left-primary mb-2" style="border-left: 3px solid #2563eb;">
                                    <div class="card-block p-3">
                                        <strong>{{ $assignment->user->first_name ?? '' }} {{ $assignment->user->last_name ?? '' }}</strong><br>
                                        <small>Assigned: {{ $assignment->assigned_date->format('d M, Y') }}</small><br>
                                        @if($assignment->return_date)
                                        <small>Return: {{ $assignment->return_date->format('d M, Y') }}</small><br>
                                        @endif
                                        <span class="badge badge-pill {{ $assignment->is_returned ? 'badge-success' : 'badge-warning' }}">
                                            {{ $assignment->is_returned ? 'Returned' : 'Active' }}
                                        </span>
                                        @if($assignment->is_damaged)
                                        <span class="badge badge-pill badge-danger">Damaged</span>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <p class="text-muted">No assignment history.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
