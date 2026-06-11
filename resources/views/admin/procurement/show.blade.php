@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
<style>
    .procurement-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        margin-top: 10px;
    }
    .procurement-breadcrumb {
        display: flex;
        align-items: center;
        list-style: none;
        padding: 0;
        margin: 0;
        font-size: 14px;
        font-weight: 500;
    }
    .procurement-breadcrumb li {
        display: flex;
        align-items: center;
    }
    .procurement-breadcrumb li a {
        color: #2563eb;
        text-decoration: none;
        transition: color 0.2s;
    }
    .procurement-breadcrumb li a:hover {
        color: #1d4ed8;
    }
    .procurement-breadcrumb li::after {
        content: "/";
        margin: 0 8px;
        color: #2563eb;
    }
    .procurement-breadcrumb li:last-child::after {
        content: "";
    }
    .procurement-breadcrumb li.active {
        color: #718096;
    }
    .procurement-card {
        background: #ffffff;
        border-radius: 6px;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
        padding: 30px;
        margin-bottom: 30px;
    }
    .detail-label {
        font-weight: 700;
        color: #2563eb;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .detail-value {
        font-size: 15px;
        color: #2d3748;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf2f7;
    }
    .btn-back {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 4px;
        border: none;
        box-shadow: 0 2px 4px rgba(37, 99, 235, 0.15);
        transition: all 0.2s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }
    .btn-back:hover {
        background-color: #1d4ed8 !important;
        border-color: #1d4ed8 !important;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.25);
        transform: translateY(-1px);
    }
</style>
@endsection

@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <div class="procurement-header">
            <ul class="procurement-breadcrumb">
                <li><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.procurement.index') }}">Procurement</a></li>
                <li class="active">Procurement Details</li>
            </ul>
            <div>
                @if($row->status != 2)
                <form action="{{ route('admin.procurement.approve', $row->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success me-2" onclick="return confirm('Are you sure you want to approve this request?');"><i class="fas fa-check"></i> Approve</button>
                </form>
                @endif
                <a href="{{ route('admin.procurement.index') }}" class="btn btn-back"><i class="fas fa-arrow-left"></i> Back to List</a>
            </div>
        </div>
        <div class="procurement-card">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-label">Procurement Number</div>
                    <div class="detail-value">{{ $row->procurement_number }}</div>
                </div>
                <div class="col-md-6">
                    <div class="detail-label">Staff Name</div>
                    <div class="detail-value">{{ $row->name }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="detail-label">Request Date</div>
                    <div class="detail-value">{{ optional($row->request_date)->format('d M, Y') ?? '' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="detail-label">Urgency</div>
                    <div class="detail-value">
                        {{ $row->urgency ?? 'N/A' }}
                        @if($row->urgency == 'Other' && $row->urgency_reason)
                            ({{ $row->urgency_reason }})
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-label">{{ __('field_status') }}</div>
                    <div class="detail-value">
                        @if( $row->status == \App\Models\Procurement::STATUS_APPROVED )
                        <span class="badge badge-pill badge-success">Approved</span>
                        @elseif( $row->status == \App\Models\Procurement::STATUS_PENDING )
                        <span class="badge badge-pill badge-warning">Pending</span>
                        @else
                        <span class="badge badge-pill badge-danger">Rejected</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="detail-label">Purpose</div>
                    <div class="detail-value">{{ $row->purpose ?? 'N/A' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="detail-label">Created At</div>
                    <div class="detail-value">{{ $row->created_at->format('d M, Y h:i A') }}</div>
                </div>
            </div>

            <!-- Assets Table -->
            <h5 class="mt-4 mb-3 text-primary font-weight-bold"><i class="fas fa-box-open"></i> Requested Assets</h5>
            <hr class="mb-4">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: #2563eb; color: white;">
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th class="text-center">Quantity</th>
                            <th>Specification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $assets = $row->assets ?? [];
                        @endphp
                        @forelse($assets as $key => $asset)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $asset['type_title'] ?? 'N/A' }}</td>
                            <td>{{ $asset['brand_title'] ?? 'N/A' }}</td>
                            <td class="text-center">{{ $asset['quantity'] ?? 0 }}</td>
                            <td>{{ $asset['specification'] ?? 'N/A' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No assets requested.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
