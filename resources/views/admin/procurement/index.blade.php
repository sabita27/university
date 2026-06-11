@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
<style>
    /* Premium visual styling to match the screenshot */
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
    
    .btn-add-request {
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
    
    .btn-add-request:hover {
        background-color: #1d4ed8 !important;
        border-color: #1d4ed8 !important;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.25);
        transform: translateY(-1px);
    }
    
    .procurement-card {
        background: #ffffff;
        border-radius: 6px;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
        padding: 20px;
        margin-bottom: 30px;
    }
 
    /* DataTable Overrides */
    div.dataTables_length {
        display: none !important;
    }
    
    .dataTables_filter {
        margin-bottom: 20px;
    }
    
    .dataTables_filter label {
        font-weight: 500;
        color: #4a5568;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .dataTables_filter input {
        border: 1px solid #2563eb !important;
        outline: none !important;
        border-radius: 4px !important;
        padding: 6px 12px !important;
        font-size: 14px;
        color: #4a5568;
        background-color: #ffffff;
        box-shadow: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    
    .dataTables_filter input:focus {
        border-color: #1d4ed8 !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
    }
 
    /* Table Styling */
    .table-procurement {
        width: 100% !important;
        border-collapse: collapse !important;
        border: 1px solid #e2e8f0 !important;
    }
    
    .table-procurement thead th {
        background-color: #2563eb !important;
        color: #ffffff !important;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        border: 1px solid #e2e8f0 !important;
        padding: 12px 16px !important;
        text-align: center;
        vertical-align: middle;
        position: relative;
    }
 
    /* DataTables sorting arrow overrides */
    table.dataTable thead .sorting:before, 
    table.dataTable thead .sorting_asc:before, 
    table.dataTable thead .sorting_desc:before, 
    table.dataTable thead .sorting_asc_disabled:before, 
    table.dataTable thead .sorting_desc_disabled:before {
        right: 1em !important;
        content: "↑" !important;
        color: rgba(255,255,255,0.7) !important;
        opacity: 0.8 !important;
    }
    
    table.dataTable thead .sorting:after, 
    table.dataTable thead .sorting_asc:after, 
    table.dataTable thead .sorting_desc:after, 
    table.dataTable thead .sorting_asc_disabled:after, 
    table.dataTable thead .sorting_desc_disabled:after {
        right: 0.5em !important;
        content: "↓" !important;
        color: rgba(255,255,255,0.7) !important;
        opacity: 0.8 !important;
    }
 
    table.dataTable thead .sorting_asc:before, 
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc:after {
        color: #ffffff !important;
        opacity: 1 !important;
    }
    
    .table-procurement tbody td {
        padding: 12px 16px !important;
        border: 1px solid #e2e8f0 !important;
        vertical-align: middle;
    }
 
    /* Empty state styling */
    .table-procurement tbody td.dataTables_empty {
        background-color: #f8fafc !important;
        color: #4a5568 !important;
        font-size: 14px;
        text-align: center !important;
        padding: 16px !important;
    }
    
    /* Footer & Pagination */
    .dataTables_info {
        font-size: 14px;
        color: #4a5568;
        padding-top: 15px !important;
    }
    
    .dataTables_paginate {
        padding-top: 15px !important;
    }
    
    .dataTables_paginate .paginate_button {
        padding: 6px 12px !important;
        margin-left: 2px !important;
        border-radius: 4px !important;
        border: 1px solid #e2e8f0 !important;
        background-color: #ffffff !important;
        color: #4a5568 !important;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
    }
    
    .dataTables_paginate .paginate_button:hover {
        background-color: #f8fafc !important;
        color: #2563eb !important;
        border-color: #cbd5e0 !important;
    }
    
    .dataTables_paginate .paginate_button.current {
        background-color: #2563eb !important;
        background: #2563eb !important;
        color: #ffffff !important;
        border-color: #2563eb !important;
    }
    
    .dataTables_paginate .paginate_button.current:hover {
        color: #ffffff !important;
    }
    
    .dataTables_paginate .paginate_button.disabled {
        cursor: default !important;
        color: #a0aec0 !important;
        border-color: #edf2f7 !important;
        background-color: #ffffff !important;
    }
    
    .dataTables_paginate .paginate_button.disabled:hover {
        color: #a0aec0 !important;
        background-color: #ffffff !important;
        border-color: #edf2f7 !important;
    }
</style>
@endsection

@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <!-- Header area with Breadcrumbs and Add button -->
        <div class="procurement-header">
            <ul class="procurement-breadcrumb">
                <li><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                <li><a href="#!">Procurement</a></li>
                <li class="active">Procurements</li>
            </ul>
            <a href="{{ route('admin.procurement.create') }}" class="btn btn-add-request"><i class="fas fa-plus"></i> Add Request</a>
        </div>

        <!-- Main Card with Table -->
        <div class="procurement-card">
            <div class="table-responsive">
                <table id="basic-table" class="table table-procurement display nowrap table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Procurement Number</th>
                            <th>Name</th>
                            <th>Request Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $rows as $key => $row )
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row->procurement_number }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ optional($row->request_date)->format('d M, Y') ?? '' }}</td>
                            <td>
                                @if( $row->status == \App\Models\Procurement::STATUS_APPROVED )
                                <span class="badge badge-pill badge-success">Approved</span>
                                @elseif( $row->status == \App\Models\Procurement::STATUS_PENDING )
                                <span class="badge badge-pill badge-warning">Pending</span>
                                @else
                                <span class="badge badge-pill badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route($route.'.show', $row->id) }}" class="btn btn-icon btn-success btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if( $row->status != \App\Models\Procurement::STATUS_APPROVED )
                                <a href="{{ route($route.'.edit', $row->id) }}" class="btn btn-icon btn-primary btn-sm">
                                    <i class="far fa-edit"></i>
                                </a>
                                @endif
                                <button type="button" class="btn btn-icon btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <!-- Delete modal -->
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
@endsection
