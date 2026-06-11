@extends('admin.layouts.master')
@section('title', $title)

@section('page_css')
<style>
    :root {
        --primary-blue: #04a9f5;
        --secondary-blue: #e1f5fe;
        --text-dark: #333;
        --text-muted: #666;
        --border-color: #eee;
        --bg-light: #f8f9fa;
    }

    .enquiry-container {
        padding: 25px;
        background: #fff;
    }

    .breadcrumb-custom {
        font-size: 14px;
        margin-bottom: 20px;
    }
    .breadcrumb-custom span {
        color: var(--primary-blue);
    }
    .breadcrumb-custom .separator {
        margin: 0 8px;
        color: #ccc;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
    }
    .btn-enquiry {
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        border: none;
        transition: all 0.3s;
        font-size: 14px;
    }
    .btn-blue {
        background-color: var(--primary-blue);
        color: #fff;
    }
    .btn-blue:hover {
        background-color: #039be5;
        color: #fff;
    }
    .btn-outline-blue {
        background-color: #fff;
        color: var(--text-dark);
        border: 1px solid var(--text-dark);
    }
    .btn-outline-blue:hover {
        background-color: var(--secondary-blue);
    }

    .filter-section {
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    .filter-title {
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 20px;
        color: var(--text-dark);
    }
    .filter-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
    }
    .filter-grid .filter-control {
        flex: 1;
        min-width: 180px;
    }
    .filter-grid .form-control {
        height: 50px;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 0 18px;
        font-size: 14px;
        background-color: #fcfcfc;
        width: 100%;
        transition: all 0.2s;
        margin: 0 !important;
        line-height: 50px;
    }
    .filter-grid .form-control:focus {
        border-color: var(--primary-blue);
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(4, 169, 245, 0.1);
        outline: none;
    }
    .filter-grid select.form-control {
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23666' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 15px center !important;
        padding-right: 40px !important;
        line-height: normal; /* Selects handle line-height differently */
        padding-top: 0;
        padding-bottom: 0;
    }
    .btn-filter {
        background-color: var(--primary-blue);
        color: #fff;
        padding: 0 25px;
        height: 50px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
        border: none;
        transition: all 0.2s;
        white-space: nowrap;
        margin: 0 !important;
    }
    .btn-filter:hover {
        background-color: #039be5;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(4, 169, 245, 0.2);
    }
    .btn-reset {
        background-color: #fff;
        color: var(--text-dark);
        padding: 0 25px;
        height: 50px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-weight: 600;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        text-decoration: none;
        font-size: 14px;
        border: 1px solid #eee;
        transition: all 0.2s;
        white-space: nowrap;
        margin: 0 !important;
    }
    .btn-reset:hover {
        background-color: #fff;
        color: #f44336;
        border-color: #f44336;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(244, 67, 54, 0.1);
    }
    .filter-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-left: auto;
        margin-bottom: 0 !important;
    }

    .table-section {
        background: #fff;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    .tabs-enquiry {
        display: flex;
        padding: 15px 20px;
        border-bottom: 1px solid var(--border-color);
        gap: 20px;
    }
    .tab-item.active {
        color: #fff;
        background: #04a9f5;
        border-radius: 8px;
    }
    .tab-item {
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        padding: 8px 20px;
        color: #04a9f5;
        transition: all 0.3s;
    }
    .lead-form-box {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 20px;
        margin-top: 20px;
        transition: all 0.3s;
    }
    .lead-form-box:hover {
        border-color: #04a9f5;
        box-shadow: 0 5px 15px rgba(4, 169, 245, 0.05);
    }
    .link-copy-area {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }
    .link-text {
        color: #04a9f5;
        font-weight: 500;
        font-size: 15px;
        text-decoration: none;
    }
    .link-text:hover {
        text-decoration: underline;
    }
    .copy-hint {
        color: #90a4ae;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .btn-open-link {
        color: #04a9f5;
        background: #fff;
        border: 1px solid #04a9f5;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-open-link:hover {
        background: #04a9f5;
        color: #fff;
    }

    .table-enquiry {
        width: 100%;
        border-collapse: collapse;
    }
    .table-enquiry th {
        background: #fff;
        padding: 15px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-dark);
        text-transform: uppercase;
        border-bottom: 1px solid var(--border-color);
    }
    .table-enquiry td {
        padding: 15px 20px;
        font-size: 14px;
        color: var(--text-dark);
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }
    .table-enquiry tr:last-child td {
        border-bottom: none;
    }
    
    .status-pill {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-in-process {
        background-color: #e3f2fd;
        color: #1976d2;
    }
    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: currentColor;
    }

    .agent-select-inline {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 6px 30px 6px 12px;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-dark);
        background-color: #fff;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' fill='%23999' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .agent-select-inline:hover {
        border-color: var(--primary-blue);
    }

    .status-select-inline {
        padding: 5px 25px 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        border: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' fill='currentColor' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        cursor: pointer;
    }

    .expire-badge {
        background-color: #f44336;
        color: #fff;
        font-size: 10px;
        padding: 2px 6px;
        border-radius: 4px;
        text-transform: uppercase;
        margin-top: 4px;
        display: inline-block;
    }

    .action-dots {
        color: #999;
        cursor: pointer;
        width: 35px;
        height: 35px;
        border-radius: 8px;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        background: #fff;
    }
    .action-dots:hover {
        background-color: #f8f9fa;
        color: var(--primary-blue);
        border-color: var(--primary-blue);
    }
    
    .dropdown-menu {
        border-radius: 12px;
        padding: 8px;
        min-width: 180px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15) !important;
        border: none !important;
    }
    .dropdown-item {
        border-radius: 8px;
        padding: 10px 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 13px;
        color: #455a64;
        transition: all 0.2s;
    }
    .dropdown-item i {
        font-size: 15px;
        width: 20px;
        text-align: center;
    }
    .dropdown-item:hover {
        background-color: #f3f4f6;
        color: var(--primary-blue);
    }
    .dropdown-item.text-danger {
        color: #f44336 !important;
    }
    .dropdown-item i.fa-eye,
    .dropdown-item i.fa-edit,
    .dropdown-item i.fa-trash-alt {
        color: #04a9f5 !important;
    }
    .dropdown-item i.fa-calendar-plus,
    .dropdown-item i.fa-user-plus {
        color: #263238 !important;
    }
    
    .number-link {
        color: var(--primary-blue);
        text-decoration: none;
    }

    /* CUSTOM CHECKBOX */
    .custom-check {
        width: 18px;
        height: 18px;
        border: 2px solid #ddd;
        border-radius: 4px;
    }
    /* Tabs Content */
    .tab-pane-enquiry {
        display: none;
    }
    .tab-pane-enquiry.active {
        display: block;
    }

    /* Kanban View Embedded CSS (Premium Upgrade) */
    .kb-outer { overflow-x: auto; padding-bottom: 20px; margin-top: 15px; }
    /* Scrollbar styling for a cleaner look */
    .kb-outer::-webkit-scrollbar { height: 8px; }
    .kb-outer::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    .kb-outer::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .kb-outer::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    
    .kb-board { display: inline-flex; gap: 24px; align-items: flex-start; min-height: 400px; padding-bottom: 20px; }
    .kb-col { width: 320px; flex-shrink: 0; display: flex; flex-direction: column; gap: 16px; background: #f8fafc; padding: 16px; border-radius: 20px; border: 1px solid #e2e8f0; }
    
    .kb-col-head { display: flex; align-items: center; justify-content: space-between; text-transform: uppercase; font-weight: 800; font-size: .85rem; color: #0f172a; padding: 0 4px; letter-spacing: 0.5px; border-bottom: none; }
    .kb-col-head .dots { color: #94a3b8; cursor: pointer; font-size: 1rem; transition: color 0.2s; }
    .kb-col-head .dots:hover { color: #0f172a; }
    .kb-col-head-title { display: flex; align-items: center; gap: 10px; }
    .kb-col-head-title span { background:#e2e8f0; color:#475569; font-size:.7rem; padding:4px 8px; border-radius:20px; font-weight: 700; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05); }
    
    .kb-col-body { display: flex; flex-direction: column; gap: 16px; min-height: 100px; overflow-x: visible; padding-bottom: 0; }
    .kb-col.drag-over { background: #eff6ff; border-color: #93c5fd; }
    .kb-col.drag-over .kb-col-body { background: transparent; }
    
    .kb-add-task { background: #ffffff; border: 2px dashed #cbd5e1; color: #64748b; font-size: .75rem; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 8px; cursor: pointer; padding: 14px; border-radius: 14px; width: 100%; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px; }
    .kb-add-task:hover { background: #04a9f5; border-color: #04a9f5; color: #ffffff; transform: translateY(-2px); box-shadow: 0 8px 16px rgba(4, 169, 245, 0.2); }
    
    .kb-card { width: 100%; background: #fff; border-radius: 16px; padding: 22px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.02); border: 1px solid #f1f5f9; cursor: grab; transition: all .3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column; gap: 14px; position: relative; overflow: hidden; text-align: left; }
    .kb-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: transparent; transition: background 0.3s; }
    .kb-card:hover { box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05), 0 10px 10px -5px rgba(0,0,0,0.02); transform: translateY(-4px); border-color: #e2e8f0; }
    .kb-card.dragging { opacity: .7; transform: rotate(3deg) scale(1.05); cursor: grabbing; z-index: 100; box-shadow: 0 25px 30px rgba(0,0,0,0.1); }
    
    .kb-prio { font-size: .65rem; font-weight: 800; text-transform: uppercase; padding: 5px 12px; border-radius: 20px; display: inline-block; width: max-content; letter-spacing: 0.8px; }
    .prio-high { background: #fee2e2; color: #ef4444; border: 1px solid #fca5a5; }
    .prio-med { background: #fef3c7; color: #f59e0b; border: 1px solid #fcd34d; }
    .prio-low { background: #e0f2fe; color: #0ea5e9; border: 1px solid #7dd3fc; }
    .prio-def { background: #f3e8ff; color: #8b5cf6; border: 1px solid #d8b4fe; }
    
    .kb-card:hover .prio-high { box-shadow: 0 4px 10px rgba(239, 68, 68, 0.15); }
    .kb-card:hover .prio-med { box-shadow: 0 4px 10px rgba(245, 158, 11, 0.15); }
    .kb-card:hover .prio-low { box-shadow: 0 4px 10px rgba(14, 165, 233, 0.15); }
    
    .kb-card-title { font-size: 1.15rem; font-weight: 800; color: #0f172a; line-height: 1.4; margin-top: 6px; margin-bottom: 2px; }
    
    .kb-card-avatars { display: flex; align-items: center; gap: 0; margin-top: 4px; }
    .kb-card-avatars .kb-av { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: .75rem; font-weight: 700; color: #fff; border: 3px solid #fff; margin-left: -10px; box-shadow: 0 2px 5px rgba(0,0,0,0.08); transition: transform 0.2s; }
    .kb-card-avatars .kb-av:hover { transform: translateY(-2px) scale(1.1); z-index: 10; }
    .kb-card-avatars .kb-av:first-child { margin-left: 0; }
    .kb-card-avatars .kb-av.plus { background: #f8fafc; color: #64748b; border: 1px dashed #cbd5e1; cursor: pointer; font-size: 1rem; box-shadow: none; }
    .kb-card-avatars .kb-av.plus:hover { background: #f1f5f9; color: #0f172a; border-color: #94a3b8; }
    .kb-staff-name { font-size: .8rem; font-weight: 700; color: #475569; background: #f1f5f9; padding: 6px 12px; border-radius: 20px; margin-left: 10px; transition: all 0.3s; box-shadow: inset 0 1px 2px rgba(0,0,0,0.02); }
    .kb-card:hover .kb-staff-name { background: #04a9f5; color: #fff; box-shadow: 0 4px 10px rgba(4, 169, 245, 0.2); }
    
    .kb-subtasks { display: flex; flex-direction: column; gap: 12px; border-top: 1px dashed #e2e8f0; padding-top: 18px; margin-top: 8px; }
    .kb-st-head { font-size: .8rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none; transition: color 0.2s; }
    .kb-st-head:hover { color: #04a9f5; }
    .kb-st-head.collapsed i.fa-chevron-down { transform: rotate(-90deg); }
    .kb-st-list { display: flex; flex-direction: column; gap: 10px; transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1); overflow: hidden; opacity: 1; max-height: 800px; }
    .kb-st-head.collapsed + .kb-st-list { max-height: 0 !important; padding-top: 0 !important; margin-top: 0 !important; opacity: 0 !important; pointer-events: none; }
    .kb-st-item { display: flex; align-items: center; gap: 12px; font-size: .9rem; color: #475569; font-weight: 500; transition: all 0.2s; padding: 4px 6px; cursor: pointer; border-radius: 8px; }
    .kb-st-item:hover { background: #f8fafc; color: #04a9f5; }
    .kb-st-item input[type="checkbox"] { width: 18px; height: 18px; border-radius: 5px; border: 2px solid #cbd5e1; accent-color: #04a9f5; cursor: pointer; margin-top: 0; transition: all 0.2s; }
    .kb-st-item i { font-size: .9rem; color: #94a3b8; width: 20px; text-align: center; }
    
    .kb-card-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; }
    .kb-stats { display: flex; align-items: center; gap: 16px; }
    .kb-stat { display: flex; align-items: center; gap: 8px; font-size: .85rem; color: #94a3b8; font-weight: 700; background: #f8fafc; padding: 6px 12px; border-radius: 20px; }
    
    .kb-actions { display: flex; gap: 8px; opacity: 0; transform: translateX(10px); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .kb-card:hover .kb-actions { opacity: 1; transform: translateX(0); }
    .kb-btn { width: 36px; height: 36px; border: none; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: .9rem; cursor: pointer; transition: all 0.2s; }
    .kb-btn-edit { background: #eff6ff; color: #3b82f6; }
    .kb-btn-edit:hover { background: #3b82f6; color: #fff; transform: scale(1.1) rotate(5deg); box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3); }
    .kb-btn-del { background: #fef2f2; color: #ef4444; }
    .kb-btn-del:hover { background: #ef4444; color: #fff; transform: scale(1.1) rotate(-5deg); box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); }
    
    .kb-empty { text-align: center; padding: 50px 20px; color: #94a3b8; font-size: .95rem; background: transparent; border-radius: 16px; border: 2px dashed #cbd5e1; font-weight: 600; display: flex; flex-direction: column; align-items: center; gap: 16px; margin-bottom: 12px; transition: all 0.3s; }
    .kb-empty:hover { border-color: #94a3b8; color: #64748b; background: #fff; }
    .kb-empty i { font-size: 2.5rem; color: #e2e8f0; transition: color 0.3s; }
    .kb-empty:hover i { color: #cbd5e1; }
    
    /* Custom Image-matched Toggle */
    .view-toggle-container {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 50px;
        padding: 5px 8px 5px 16px;
        margin-left: auto;
        cursor: pointer;
        user-select: none;
    }
    .view-toggle-label {
        font-size: 14px;
        font-weight: 500;
        color: #1565c0;
        margin: 0;
    }
    .view-toggle-switch {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
        margin: 0;
    }
    .view-toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .view-toggle-slider {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #cce3ff;
        border-radius: 24px;
        transition: .3s;
    }
    .view-toggle-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: #6ea8fe;
        border: 3px solid #ffffff;
        border-radius: 50%;
        transition: .3s;
        box-sizing: border-box;
    }
    .view-toggle-switch input:not(:checked) + .view-toggle-slider {
        background-color: #e2e8f0;
    }
    .view-toggle-switch input:not(:checked) + .view-toggle-slider:before {
        background-color: #94a3b8;
    }
    .view-toggle-switch input:checked + .view-toggle-slider {
        background-color: #cce3ff;
    }
    .view-toggle-switch input:checked + .view-toggle-slider:before {
        transform: translateX(20px);
        background-color: #6ea8fe;
    }
</style>
@endsection

@section('content')
<div class="main-body">
    <div class="page-wrapper">
        <div class="enquiry-container">
            
            {{-- Breadcrumb --}}
            <div class="breadcrumb-custom">
                <span>Lead Enquiry</span> <span class="separator">/</span> Lead Lists
            </div>

            {{-- Action Buttons --}}
            <div class="action-buttons">
                @can($access.'-create')
                <button class="btn-enquiry btn-blue" data-bs-toggle="modal" data-bs-target="#createLeadModal">
                    <i class="fas fa-plus"></i> Add Lead
                </button>
                @endcan
                <a href="{{ route('admin.crm.lead.follow-up-list') }}" class="btn-enquiry btn-blue">
                    <i class="fas fa-history"></i> Follow Up List
                </a>
                <button class="btn-enquiry btn-outline-blue" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="fas fa-file-import"></i> Import
                </button>
                <a href="{{ route('admin.crm.lead.export') }}" class="btn-enquiry btn-outline-blue">
                    <i class="fas fa-file-export"></i> Export
                </a>
            </div>

            {{-- Filters --}}
            <div class="filter-section">
                <div class="filter-title">Lead Filter</div>
                <form action="{{ route('admin.crm.lead.enquiry') }}" method="GET">
                    <div class="filter-grid">
                        <input type="text" name="name" class="form-control filter-control" placeholder="Lead Name" value="{{ request('name') }}">
                        <input type="text" name="email" class="form-control filter-control" placeholder="Email" value="{{ request('email') }}">
                        <select name="status" class="form-control filter-control">
                            <option value="">All Statuses</option>
                            @foreach($statuses as $st)
                            <option value="{{ $st->id }}" @selected(request('status') == $st->id)>{{ $st->title }}</option>
                            @endforeach
                        </select>
                        <select name="agent" class="form-control filter-control">
                            <option value="">All Agents</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" @selected(request('agent') == $user->id)>{{ $user->first_name }} {{ $user->last_name }}</option>
                            @endforeach
                        </select>
                        <div class="filter-actions">
                            <button type="submit" class="btn-filter">
                                <i class="fas fa-filter me-2"></i> Filter
                            </button>
                            <a href="{{ route('admin.crm.lead.enquiry') }}" class="btn-reset">
                                <i class="fas fa-redo me-2"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Table --}}
            <div class="table-section">
                <div class="tabs-enquiry d-flex align-items-center">
                    <div class="d-flex">
                        <div class="tab-item active" data-target="#lead-enquiry-list">Lead Enquiry</div>
                        <div class="tab-item" data-target="#lead-from-list">Lead From</div>
                    </div>
                    <label class="view-toggle-container" for="kanbanToggleView">
                        <span class="view-toggle-label">Kanban View</span>
                        <div class="view-toggle-switch">
                            <input type="checkbox" id="kanbanToggleView">
                            <span class="view-toggle-slider"></span>
                        </div>
                    </label>
                </div>
                
                <div class="tab-content-enquiry">
                    <div id="lead-enquiry-list" class="tab-pane-enquiry active">
                        <div class="table-responsive">
                            <table class="table-enquiry">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="custom-check" id="select-all"></th>
                                        <th>#</th>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>NUMBER</th>
                                        <th>CATEGORY</th>
                                        <th>ASSIGN TO AGENT</th>
                                        <th>NEXT FOLLOW UP DATE</th>
                                        <th>STATUS</th>
                                        <th>CHOOSE ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rows as $key => $row)
                                    <tr>
                                        <td><input type="checkbox" class="custom-check lead-checkbox"></td>
                                        <td>{{ $key + 1 }}</td>
                                        <td class="fw-bold">{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td><a href="tel:{{ $row->phone }}" class="number-link">{{ $row->phone }}</a></td>
                                        <td>{{ $row->source->title ?? 'Marketing' }}</td>
                                        <td>
                                            <select class="agent-select-inline update-agent" data-lead-id="{{ $row->id }}">
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}" @selected($row->counsellor_id == $user->id)>
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            @php $followUp = $row->followUps->first(); @endphp
                                            @if($followUp && $followUp->follow_up_date)
                                                @php $fDate = \Carbon\Carbon::parse($followUp->follow_up_date); @endphp
                                                <div class="fw-bold {{ $fDate->isPast() ? 'text-danger' : 'text-primary' }}">{{ $fDate->format('Y-m-d') }}</div>
                                                @if($fDate->isPast())
                                                    <div class="expire-badge">Expire</div>
                                                @endif
                                            @else
                                                <span class="text-muted">Not Set</span>
                                            @endif
                                        </td>
                                        <td>
                                            <select class="status-select-inline update-status" data-id="{{ $row->id }}" 
                                                    style="background: {{ $row->leadStatus->color ?? '#e3f2fd' }}20; color: {{ $row->leadStatus->color ?? '#1976d2' }};">
                                                @foreach($statuses as $st)
                                                <option value="{{ $st->id }}" data-color="{{ $st->color ?? '#1976d2' }}" @selected($row->lead_status_id == $st->id)>
                                                    {{ $st->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown dropstart">
                                                <div class="action-dots" data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="viewport">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </div>
                                                <ul class="dropdown-menu border-0 shadow">
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $row->id }}">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </li>
                                                    @can($access.'-edit')
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal-{{ $row->id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                    </li>
                                                    @endcan
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addFollowUpModal-{{ $row->id }}">
                                                            <i class="fas fa-calendar-plus"></i> Add Follow Up
                                                        </a>
                                                    </li>
                                                    @can($access.'-delete')
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </a>
                                                    </li>
                                                    @endcan
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="lead-from-list" class="tab-pane-enquiry">
                        <div class="p-4">
                            <h6 class="fw-bold mb-3 text-dark" style="letter-spacing: 0.5px;">LEAD FORM LINK</h6>
                            <div class="link-copy-area" id="copyLeadLink">
                                <span class="link-text" id="leadLinkUrl">{{ route('admission.inquiry.index') }}</span>
                                <div class="copy-hint">
                                    <span>(Tap the link to Copy)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="lead-kanban-view" class="tab-pane-enquiry">
                        @include('admin.crm.lead.kanban-board-partial')
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Re-use existing modals for Edit and Create --}}
@foreach($rows as $row)
    {{-- View Modal --}}
    <div class="modal fade" id="viewModal-{{ $row->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" style="color: var(--primary-blue);">Lead Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-user fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">{{ $row->name }}</h4>
                            <span class="badge" style="background: {{ $row->leadStatus->color ?? '#eee' }}20; color: {{ $row->leadStatus->color ?? '#333' }};">{{ $row->leadStatus->title ?? 'New' }}</span>
                        </div>
                    </div>
                    
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="text-muted small fw-bold text-uppercase">Email</label>
                            <p class="mb-0 fw-semibold">{{ $row->email }}</p>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small fw-bold text-uppercase">Phone</label>
                            <p class="mb-0 fw-semibold">{{ $row->phone }}</p>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small fw-bold text-uppercase">Source</label>
                            <p class="mb-0 fw-semibold">{{ $row->source->title ?? 'N/A' }}</p>
                        </div>
                        <div class="col-6">
                            <label class="text-muted small fw-bold text-uppercase">Assigned To</label>
                            <p class="mb-0 fw-semibold">{{ $row->staff->first_name ?? 'Unassigned' }}</p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small fw-bold text-uppercase">Program</label>
                            <p class="mb-0 fw-semibold">{{ $row->program->title ?? 'N/A' }}</p>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="text-muted small fw-bold text-uppercase">Description</label>
                            <div class="p-2 bg-light rounded-3 small">
                                {{ $row->description ?? 'No description provided.' }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    @can($access.'-edit')
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editModal-{{ $row->id }}">Edit Lead</button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    @can($access.'-edit')
    @include($view.'.edit')
    @endcan

    {{-- Add Follow Up Modal --}}
    <div class="modal fade" id="addFollowUpModal-{{ $row->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div class="modal-header" style="background-color: #04a9f5; border-radius: 12px 12px 0 0; padding: 15px 25px;">
                    <h5 class="modal-title fw-bold text-white" style="font-size: 1.1rem;">Add Follow Up</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.crm.lead.add-follow-up') }}" method="POST">
                    @csrf
                    <input type="hidden" name="lead_id" value="{{ $row->id }}">
                    <div class="modal-body px-4 pt-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark" style="font-size: 0.85rem;">Next Follow Up Date<span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="date" name="follow_up_date" class="form-control" value="{{ date('Y-m-d') }}" style="border-radius: 10px; border: 1px solid #dee2e6; padding: 12px 15px; background-color: #fff; font-size: 0.9rem;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark" style="font-size: 0.85rem;">Next Follow Up Time <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="time" name="follow_up_time" class="form-control" style="border-radius: 10px; border: 1px solid #dee2e6; padding: 12px 15px; background-color: #fff; font-size: 0.9rem;">
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <label class="form-label small fw-bold text-dark" style="font-size: 0.85rem;">Remark <span class="text-danger">*</span></label>
                                <textarea name="follow_up_note" class="form-control" rows="5" style="border-radius: 10px; border: 1px solid #dee2e6; padding: 15px; background-color: #fff; font-size: 0.9rem;" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 justify-content-center pb-5 pt-2">
                        <button type="button" class="btn btn-secondary px-5 py-2 me-2" data-bs-dismiss="modal" style="background-color: #7c8ea1; border: none; border-radius: 10px; font-weight: 700; font-size: 0.9rem; min-width: 120px;">Close</button>
                        <button type="submit" class="btn btn-primary px-5 py-2" style="background-color: #04a9f5; border: none; border-radius: 10px; font-weight: 700; font-size: 0.9rem; min-width: 120px;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @can($access.'-delete')
    @include('admin.layouts.inc.delete')
    @endcan
@endforeach

{{-- Import Modal --}}
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header" style="background-color: #04a9f5; border-radius: 12px 12px 0 0; padding: 15px 25px;">
                <h5 class="modal-title fw-bold text-white" id="importModalLabel">Import Lead Data</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.crm.lead.import.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-4 px-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small">
                            Select Excel File: (Only csv, xlsx Format will be accepted) <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="import" class="form-control" accept=".csv, .xlsx, .xls" required style="border-radius: 8px;">
                    </div>

                    <div class="p-3 rounded-3" style="background: #e1f5fe; border: 1px dashed #04a9f5;">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-lightbulb text-warning mt-1"></i>
                            <div>
                                <h6 class="fw-bold text-primary mb-1">Important Message</h6>
                                <p class="text-muted small mb-1">
                                    You must Download the Demo File, then after filling the data you can import here.
                                </p>
                                <a href="{{ asset('dashboard/sample/leads.xlsx') }}" class="text-primary fw-bold text-decoration-none small" download>
                                    Click Here To Download Demo File
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 justify-content-center pb-4">
                    <button type="button" class="btn btn-secondary px-4 py-2 me-2" data-bs-dismiss="modal" style="background-color: #7c8ea1; border: none; border-radius: 10px; font-weight: 700;">Close</button>
                    <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: #04a9f5; border: none; border-radius: 10px; font-weight: 700;">Import Lead</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Create Modal --}}
@can($access.'-create')
<div class="modal fade" id="createLeadModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content" style="border-radius:18px;overflow:hidden;border:none;">
    <div class="modal-header" style="background:linear-gradient(135deg,#8b5cf6,#6366f1);color:#fff;border:none;">
        <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Create Lead</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
    </div>
    <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post">
    @csrf
    <div class="modal-body p-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Father Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="father_name" value="{{ old('father_name') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Qualification <span class="text-danger">*</span></label>
                <select name="educational_qualification" class="form-control" required>
                    <option value="">Select</option>
                    @foreach($qualifications as $q)
                    <option value="{{ $q->title }}" @selected(old('educational_qualification')==$q->title)>{{ $q->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Board / School <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="board" value="{{ old('board') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Total Mark <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="total_mark" value="{{ old('total_mark') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Total Percentage (%) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" class="form-control" name="total_percentage" value="{{ old('total_percentage') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Program <span class="text-danger">*</span></label>
                <select class="form-control" name="program_id" required>
                    <option value="">Select</option>
                    @foreach($programs as $p)
                    <option value="{{ $p->id }}" @selected(old('program_id')==$p->id)>{{ $p->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Source <span class="text-danger">*</span></label>
                <select class="form-control" name="lead_source_id" required>
                    <option value="">Select</option>
                    @foreach($sources as $s)
                    <option value="{{ $s->id }}" @selected(old('lead_source_id')==$s->id)>{{ $s->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                <select class="form-control" name="lead_status_id" required>
                    <option value="">Select</option>
                    @foreach($statuses as $st)
                    <option value="{{ $st->id }}" @selected(old('lead_status_id')==$st->id)>{{ $st->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Counselor</label>
                <select class="form-control" name="counsellor_id">
                    <option value="">Select</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" @selected(old('counsellor_id')==$user->id)>{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Next Follow-up Date</label>
                <input type="date" class="form-control" name="follow_up_date" value="{{ old('follow_up_date') }}">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer" style="border:none;padding:14px 24px;">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" style="border-radius:10px;padding:9px 22px;font-weight:700;">
            <i class="fas fa-check me-1"></i>Save Lead
        </button>
    </div>
    </form>
</div>
</div>
</div>
@endcan

@endsection

@section('page_js')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Update Agent
    $('.update-agent').on('change', function() {
        var leadId = $(this).data('lead-id');
        var userId = $(this).val();
        
        $.ajax({
            url: "{{ route($route.'.assign-staff') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                lead_id: leadId,
                user_id: userId
            },
            success: function(response) {
                if(response.status == 'success') {
                    toastr.success(response.message);
                }
            }
        });
    });

    // Update Status
    $('.update-status').on('change', function() {
        var leadId = $(this).data('id');
        var statusId = $(this).val();
        var selectedOption = $(this).find('option:selected');
        var color = selectedOption.data('color');
        var selectElement = $(this);
        var urlTemplate = "{{ route($route.'.update-status', ':id') }}";
        
        $.ajax({
            url: urlTemplate.replace(':id', leadId),
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                status_id: statusId
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    // Update pill color
                    selectElement.css({
                        'background': color + '20',
                        'color': color
                    });
                }
            }
        });
    });

    // Tab Switching
    $('.tab-item').on('click', function() {
        var target = $(this).data('target');
        
        $('.tab-item').removeClass('active');
        $(this).addClass('active');
        
        $('.tab-pane-enquiry').removeClass('active');
        $(target).addClass('active');
        
        if (target !== '#lead-kanban-view') {
            $('#kanbanToggleView').prop('checked', false);
        }
    });

    // Toggle Switch
    $('#kanbanToggleView').on('change', function() {
        if($(this).is(':checked')) {
            $('.tab-item').removeClass('active');
            $('.tab-pane-enquiry').removeClass('active');
            $('#lead-kanban-view').addClass('active');
        } else {
            $('.tab-item[data-target="#lead-enquiry-list"]').addClass('active');
            $('#lead-enquiry-list').addClass('active');
            $('#lead-kanban-view').removeClass('active');
        }
    });

    // Copy Lead Link
    $('#copyLeadLink').on('click', function(e) {
        var linkText = $('#leadLinkUrl').text().trim();
        var tempInput = $('<input>');
        $('body').append(tempInput);
        tempInput.val(linkText).select();
        document.execCommand('copy');
        tempInput.remove();
        
        Swal.fire({
            title: 'Link copied to clipboard successfully!',
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#04a9f5',
            customClass: {
                popup: 'rounded-12',
                confirmButton: 'px-4 py-2 fw-bold'
            }
        });
    });
    // Select All functionality
    $(document).on('change', '#select-all', function() {
        $('.lead-checkbox').prop('checked', this.checked);
    });

    // Optional: Uncheck Select All if any lead-checkbox is unchecked
    $(document).on('change', '.lead-checkbox', function() {
        if (!this.checked) {
            $('#select-all').prop('checked', false);
        }
        if ($('.lead-checkbox:checked').length == $('.lead-checkbox').length) {
            $('#select-all').prop('checked', true);
        }
    });
});
</script>
<script>
@include('admin.crm.lead.kanban-js-partial')
</script>
@endsection
