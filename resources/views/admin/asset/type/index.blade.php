@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
<style>
    /* Premium visual styling to match the screenshot */
    .brand-header {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 25px;
        margin-top: 10px;
    }
    
    .btn-add-brand {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 8px;
        border: none;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2), 0 2px 4px -1px rgba(37, 99, 235, 0.1);
        transition: all 0.2s ease-in-out;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }
    
    .btn-add-brand:hover {
        background-color: #1d4ed8 !important;
        border-color: #1d4ed8 !important;
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3), 0 4px 6px -2px rgba(37, 99, 235, 0.15);
        transform: translateY(-1px);
    }

    .premium-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #f3f4f6;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.025);
        padding: 24px;
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
        color: #4b5563;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .dataTables_filter input {
        border: 1px solid #d1d5db !important;
        outline: none !important;
        border-radius: 6px !important;
        padding: 6px 12px !important;
        font-size: 14px;
        color: #4b5563;
        background-color: #ffffff;
        box-shadow: none;
        transition: all 0.2s;
    }
    
    .dataTables_filter input:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
    }

    /* Table Styling */
    .table-premium {
        width: 100% !important;
        border-collapse: collapse !important;
        border: none !important;
    }
    
    .table-premium thead th,
    table.dataTable.table-premium thead th,
    table.dataTable.table-premium thead th.sorting,
    table.dataTable.table-premium thead th.sorting_asc,
    table.dataTable.table-premium thead th.sorting_desc,
    table.dataTable.table-premium thead tr th {
        border-bottom: 2px solid #f3f4f6 !important;
        border-top: none !important;
        color: #1f2937 !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        padding: 16px 20px !important;
        background: transparent !important;
        background-color: transparent !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    table.dataTable.table-premium thead .sorting:before, 
    table.dataTable.table-premium thead .sorting_asc:before, 
    table.dataTable.table-premium thead .sorting_desc:before,
    table.dataTable.table-premium thead .sorting:after, 
    table.dataTable.table-premium thead .sorting_asc:after, 
    table.dataTable.table-premium thead .sorting_desc:after {
        color: #1f2937 !important;
        opacity: 0.3 !important;
    }
    table.dataTable.table-premium thead .sorting_asc:before,
    table.dataTable.table-premium thead .sorting_desc:after {
        opacity: 1 !important;
    }
    
    .table-premium tbody td {
        border-bottom: 1px solid #f3f4f6 !important;
        padding: 16px 20px !important;
        vertical-align: middle !important;
        color: #374151 !important;
        font-size: 14px !important;
    }

    .table-premium tbody tr:last-child td {
        border-bottom: none !important;
    }

    /* Item Count text */
    .item-count-text {
        color: #2563eb !important;
        font-weight: 600;
    }

    /* Status Switch */
    .status-switch {
        display: inline-block;
        width: 44px;
        height: 24px;
        background-color: #cbd5e1;
        border-radius: 12px;
        position: relative;
        transition: background-color 0.2s ease;
        cursor: pointer;
        vertical-align: middle;
    }

    .status-switch::after {
        content: "";
        width: 20px;
        height: 20px;
        background-color: #ffffff;
        border-radius: 50%;
        position: absolute;
        top: 2px;
        left: 2px;
        transition: transform 0.2s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .status-switch.active {
        background-color: #22c55e;
    }

    .status-switch.active::after {
        transform: translateX(20px);
    }

    /* Action Buttons */
    .btn-action-edit {
        background: transparent !important;
        border: 1.5px solid #2563eb !important;
        color: #2563eb !important;
        border-radius: 6px;
        padding: 6px 8px;
        font-size: 14px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-right: 6px;
    }

    .btn-action-edit:hover {
        background: rgba(37, 99, 235, 0.05) !important;
        color: #1d4ed8 !important;
        border-color: #1d4ed8 !important;
    }

    .btn-action-delete {
        background: transparent !important;
        border: 1.5px solid #2563eb !important;
        color: #2563eb !important;
        border-radius: 6px;
        padding: 6px 8px;
        font-size: 14px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .btn-action-delete:hover {
        background: rgba(37, 99, 235, 0.05) !important;
        color: #1d4ed8 !important;
        border-color: #1d4ed8 !important;
    }
    
    /* Footer & Pagination */
    .dataTables_info {
        font-size: 13px;
        color: #6b7280;
        padding-top: 15px !important;
    }
    
    .dataTables_paginate {
        padding-top: 15px !important;
    }
    
    .dataTables_paginate .paginate_button {
        padding: 6px 12px !important;
        margin-left: 2px !important;
        border-radius: 6px !important;
        border: 1px solid #e5e7eb !important;
        background-color: #ffffff !important;
        color: #4b5563 !important;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 13px;
    }
    
    .dataTables_paginate .paginate_button:hover {
        background-color: #f9fafb !important;
        color: #2563eb !important;
        border-color: #d1d5db !important;
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
        color: #9ca3af !important;
        border-color: #f3f4f6 !important;
        background-color: #ffffff !important;
    }
</style>
@endsection

@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <!-- Header area with Add button -->
        <div class="brand-header">
            <button type="button" class="btn btn-add-brand" data-bs-toggle="modal" data-bs-target="#createModal">
                <i class="fas fa-plus"></i> Add Types
            </button>
        </div>

        <!-- Main Card with Table -->
        <div class="premium-card">
            <div class="table-responsive">
                <table id="basic-table" class="table table-premium display nowrap table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Asset Item Count</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row->title }}</td>
                            <td>
                                <span class="item-count-text">{{ $row->assets_count }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.asset-type.status', $row->id) }}" class="status-toggle-link">
                                    <span class="status-switch @if($row->status == 1) active @endif"></span>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn-action-edit" data-bs-toggle="modal" data-bs-target="#editModal-{{ $row->id }}">
                                    <!-- Feather edit icon -->
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle;">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </button>
                                @include($view . '.edit')

                                <button type="button" class="btn-action-delete" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                    <!-- Custom SVG label tag with 'x' inside for delete -->
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle;">
                                        <path d="M6 12L11 6H21V18H11L6 12Z"></path>
                                        <line x1="13" y1="9" x2="17" y2="13"></line>
                                        <line x1="17" y1="9" x2="13" y2="13"></line>
                                    </svg>
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

<!-- Add Modal -->
<div id="createModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="needs-validation" novalidate action="{{ route('admin.asset-type.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Asset Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="type_title">Type Name <span>*</span></label>
                        <input type="text" class="form-control" name="title" id="type_title" placeholder="Enter type name" value="{{ old('title') }}" required>
                        <div class="invalid-feedback">Type name is required.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
