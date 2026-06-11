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
        padding: 25px;
        margin-bottom: 30px;
    }
    .section-title {
        color: #2563eb;
        font-weight: 700;
        font-size: 16px;
        margin-top: 15px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .table-assets {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        border: 1px solid #e2e8f0;
    }
    .table-assets thead th {
        background-color: #2563eb;
        color: #ffffff;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
        text-align: left;
    }
    .table-assets tbody td {
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        font-size: 14px;
        color: #4a5568;
    }
    .btn-add-to-list {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
        color: #ffffff !important;
        font-size: 13px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 4px;
        border: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-add-to-list:hover {
        background-color: #1d4ed8 !important;
        border-color: #1d4ed8 !important;
    }
    .readonly-bg {
        background-color: #f7fafc !important;
        cursor: not-allowed;
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
                <li class="active">Edit Procurement</li>
            </ul>
        </div>
        <div class="procurement-card">
            <form method="POST" action="{{ route('admin.procurement.update', $row->id) }}" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <h5 class="section-title"><i class="fas fa-edit"></i> Edit Procurement</h5>
                <hr class="mb-4">
                
                <div class="row">
                    <!-- Request Number -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="procurement_number" class="form-label">Request Number <span>*</span></label>
                        <input type="text" class="form-control readonly-bg" name="procurement_number" id="procurement_number" value="{{ old('procurement_number', $row->procurement_number) }}" readonly required>
                        <div class="invalid-feedback">{{ __('required_field') }} Request Number</div>
                    </div>

                    <!-- Department Dropdown -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="department_id" class="form-label">Department <span>*</span></label>
                        <select class="form-control select2" name="department_id" id="department_id" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" @if(old('department_id', ($row->staff ? $row->staff->department_id : '')) == $department->id) selected @endif>
                                    {{ $department->title }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __('required_field') }} Department</div>
                    </div>
                    
                    <!-- Supplier Name Dropdown -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="supplier_select" class="form-label">Assign Person</label>
                        <select class="form-control select2" name="staff_id" id="supplier_select">
                            <option value="">Select Assign Person</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" data-department-id="{{ $supplier->department_id }}"
                                    @if(old('staff_id', $row->staff_id) == $supplier->id) selected @endif>
                                    @if($supplier->staff_id){{ $supplier->staff_id }} - @endif{{ $supplier->first_name }} {{ $supplier->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __('required_field') }} Assign Person</div>
                    </div>
                </div>

                <div class="row">
                    <!-- Request Date -->
                    <div class="form-group col-md-3 mb-3">
                        <label for="request_date" class="form-label">Request Date <span>*</span></label>
                        <input type="date" class="form-control" name="request_date" id="request_date" value="{{ old('request_date', $row->request_date->format('Y-m-d')) }}" required>
                        <div class="invalid-feedback">{{ __('required_field') }} Request Date</div>
                    </div>
                    
                    <!-- Urgency -->
                    <div class="form-group col-md-3 mb-3">
                        <label for="urgency" class="form-label">Urgency <span>*</span></label>
                        <select class="form-control" name="urgency" id="urgency" required>
                            <option value="">Select Urgency</option>
                            <option value="Immediate" @if(old('urgency', $row->urgency) == 'Immediate') selected @endif>Immediate</option>
                            <option value="Within 7 days" @if(old('urgency', $row->urgency) == 'Within 7 days') selected @endif>Within 7 days</option>
                            <option value="Within 15 days" @if(old('urgency', $row->urgency) == 'Within 15 days') selected @endif>Within 15 days</option>
                            <option value="Within 30 days" @if(old('urgency', $row->urgency) == 'Within 30 days') selected @endif>Within 30 days</option>
                            <option value="Other" @if(old('urgency', $row->urgency) == 'Other') selected @endif>Other</option>
                        </select>
                        <div class="form-group mt-2" id="urgency_reason_div" style="display: {{ old('urgency', $row->urgency) == 'Other' ? 'block' : 'none' }};">
                            <label for="urgency_reason" class="form-label">Urgency Reason <span>*</span></label>
                            <input type="text" class="form-control" name="urgency_reason" id="urgency_reason" value="{{ old('urgency_reason', $row->urgency_reason) }}" {{ old('urgency', $row->urgency) == 'Other' ? 'required' : '' }}>
                        </div>
                        <div class="invalid-feedback">{{ __('required_field') }} Urgency</div>
                    </div>

                    <!-- Status -->
                    <div class="form-group col-md-3 mb-3">
                        <label for="status" class="form-label">{{ __('field_status') }} <span>*</span></label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="1" @if( old('status', $row->status) == 1 ) selected @endif>Pending</option>
                            <option value="2" @if( old('status', $row->status) == 2 ) selected @endif>Approved</option>
                            <option value="0" @if( old('status', $row->status) == 0 ) selected @endif>Rejected</option>
                        </select>
                        <div class="invalid-feedback">{{ __('required_field') }} Status</div>
                    </div>
                    
                    <!-- Purpose -->
                    <div class="form-group col-md-3 mb-3">
                        <label for="purpose" class="form-label">Purpose</label>
                        <textarea class="form-control" name="purpose" id="purpose" rows="2" placeholder="Enter Purpose">{{ old('purpose', $row->purpose) }}</textarea>
                    </div>
                </div>

                <!-- Add Asset Section -->
                <h5 class="section-title mt-4"><i class="fas fa-box-open"></i> Add Product</h5>
                <hr class="mb-4">
                
                <div class="row">
                    <!-- Brand / Category -->
                    <div class="form-group col-md-3 mb-3">
                        <label for="asset_brand" class="form-label">Category <span>*</span></label>
                        <select class="form-control select2" id="asset_brand">
                            <option value="">Select Category</option>
                            @foreach($asset_brands as $brand)
                                <option value="{{ $brand->id }}" data-title="{{ $brand->title }}">{{ $brand->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Type -->
                    <div class="form-group col-md-3 mb-3">
                        <label for="asset_type" class="form-label">Type <span>*</span></label>
                        <select class="form-control select2" id="asset_type">
                            <option value="">Select Type</option>
                            @foreach($asset_types as $type)
                                <option value="{{ $type->id }}" data-title="{{ $type->name }}" data-category-id="{{ $type->category_id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Quantity -->
                    <div class="form-group col-md-2 mb-3">
                        <label for="asset_quantity" class="form-label">Quantity <span>*</span></label>
                        <input type="number" class="form-control" id="asset_quantity" min="1" placeholder="Enter Quantity">
                    </div>
                    
                    <!-- Specification -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="asset_specification" class="form-label">Specification <span>*</span></label>
                        <input type="text" class="form-control" id="asset_specification" placeholder="Enter Requirement">
                    </div>
                </div>

                <!-- Add to List Button -->
                <div class="row mb-3">
                    <div class="col-md-12 text-end text-right">
                        <button type="button" class="btn btn-add-to-list" id="btn-add-asset"><i class="fas fa-plus"></i> Add to List</button>
                    </div>
                </div>

                <!-- Assets List Table -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table-assets table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th class="text-center">Quantity</th>
                                        <th>Specification</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="assets_table_body">
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No assets added yet.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Hidden inputs to submit assets data and foreign keys -->
                <input type="hidden" name="assets" id="assets_input" value="[]">
                <input type="hidden" name="product_id" id="product_id_input" value="{{ old('product_id', $row->product_id) }}">

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.procurement.index') }}" class="btn btn-secondary me-2">{{ __('btn_cancel') }}</a>
                    <button type="submit" class="btn btn-add-request"><i class="fas fa-check"></i> {{ __('btn_update') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('page_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productIdInput = document.getElementById('product_id_input');

        // ── Filter Type by Category ──
        const assetTypes = @json($asset_types->map(function($t) { return ['id' => $t->id, 'category_id' => $t->category_id, 'name' => $t->name]; }));
        
        const $categorySelect = $('#asset_brand');
        const $typeSelect = $('#asset_type');
        
        if ($categorySelect.length && $typeSelect.length) {
            function filterType() {
                const categoryId = $categorySelect.val();
                const currentTypeId = $typeSelect.val();
                
                $typeSelect.empty();
                $typeSelect.append('<option value="">Select Type</option>');
                
                if (categoryId) {
                    assetTypes.forEach(type => {
                        if (type.category_id == categoryId) {
                            const isSelected = (type.id == currentTypeId) ? 'selected' : '';
                            $typeSelect.append(`<option value="${type.id}" data-title="${type.name}" data-category-id="${type.category_id}" ${isSelected}>${type.name}</option>`);
                        }
                    });
                }
                
                $typeSelect.trigger('change.select2');
            }

            $categorySelect.on('change', function() {
                $typeSelect.val('');
                filterType();
            });
            
            // Initial filter
            filterType();
        }

        // ── Filter Staff by Department ──
        const staffs = @json($suppliers->map(function($s) { return ['id' => $s->id, 'department_id' => $s->department_id, 'name' => ($s->staff_id ? $s->staff_id . ' - ' : '') . $s->first_name . ' ' . $s->last_name]; }));
        
        const $departmentSelect = $('#department_id');
        const $staffSelect = $('#supplier_select');
        
        if ($departmentSelect.length && $staffSelect.length) {
            function filterStaff() {
                const deptId = $departmentSelect.val();
                const currentStaffId = $staffSelect.val() || "{{ old('staff_id', $row->staff_id) }}";
                
                $staffSelect.empty();
                $staffSelect.append('<option value="">Select Staff</option>');
                
                if (deptId) {
                    staffs.forEach(staff => {
                        if (staff.department_id == deptId) {
                            const isSelected = (staff.id == currentStaffId) ? 'selected' : '';
                            $staffSelect.append(`<option value="${staff.id}" ${isSelected}>${staff.name}</option>`);
                        }
                    });
                }
                
                $staffSelect.trigger('change.select2');
            }

            $departmentSelect.on('change', function() {
                $staffSelect.val('');
                filterStaff();
            });
            
            // Initial filter
            filterStaff();
        }

        // ── Urgency reason toggle ──
        const urgencySelect    = document.getElementById('urgency');
        const urgencyReasonDiv = document.getElementById('urgency_reason_div');
        if (urgencySelect && urgencyReasonDiv) {
            const toggleUrgencyReason = function() {
                if (urgencySelect.value === 'Other') {
                    urgencyReasonDiv.style.display = 'block';
                    document.getElementById('urgency_reason').setAttribute('required', 'required');
                } else {
                    urgencyReasonDiv.style.display = 'none';
                    document.getElementById('urgency_reason').removeAttribute('required');
                }
            };
            urgencySelect.addEventListener('change', toggleUrgencyReason);
            toggleUrgencyReason();
        }

        // ── asset type → auto-fill brand ─────────────────────────────────
        const typeSelect  = document.getElementById('asset_type');
        const brandSelect = document.getElementById('asset_brand');
        if (typeSelect && brandSelect) {
            typeSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const categoryId = selectedOption ? selectedOption.getAttribute('data-category-id') : '';
                if (categoryId) {
                    brandSelect.value = categoryId;
                    if (typeof $(brandSelect).select2 === 'function') {
                        $(brandSelect).val(categoryId).trigger('change');
                    }
                } else {
                    brandSelect.value = '';
                    if (typeof $(brandSelect).select2 === 'function') {
                        $(brandSelect).val('').trigger('change');
                    }
                }
            });
        }
        
        // ── assets list ───────────────────────────────────────────────────
        // Load existing assets from PHP backend
        let assets = @json($row->assets ?? []);
        
        // Handle fallback if old assets exist (validation error redirect)
        @if(old('assets'))
            try {
                let oldAssets = JSON.parse({!! json_encode(old('assets')) !!});
                if (typeof oldAssets === 'string') oldAssets = JSON.parse(oldAssets);
                if (Array.isArray(oldAssets)) assets = oldAssets;
            } catch(e) { console.error('Error parsing old assets', e); }
        @endif

        renderAssetsTable();
        updateHiddenInput();
        
        function renderAssetsTable() {
            let tbody = document.getElementById('assets_table_body');
            tbody.innerHTML = '';
            if (assets.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center text-muted">No assets added yet.</td></tr>`;
                return;
            }
            assets.forEach((asset, index) => {
                let tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${escapeHtml(asset.type_title)}</td>
                    <td>${escapeHtml(asset.brand_title)}</td>
                    <td class="text-center">${asset.quantity}</td>
                    <td>${escapeHtml(asset.specification)}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="window.removeAsset(${index})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }
        
        function escapeHtml(text) {
            if (!text) return '';
            return text.toString()
                .replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }
        
        function addAssetToList() {
            let typeSelect    = document.getElementById('asset_type');
            let brandSelect   = document.getElementById('asset_brand');
            let quantityInput = document.getElementById('asset_quantity');
            let specInput     = document.getElementById('asset_specification');
            
            let typeId     = typeSelect.value;
            let typeTitle  = typeSelect.selectedIndex > -1 ? (typeSelect.options[typeSelect.selectedIndex].getAttribute('data-title') || '') : '';
            let brandId    = brandSelect.value;
            let brandTitle = brandSelect.selectedIndex > -1 ? (brandSelect.options[brandSelect.selectedIndex].getAttribute('data-title') || '') : '';
            let quantity   = quantityInput.value;
            let spec       = specInput.value;
            
            if (!typeId || !brandId || !quantity || !spec) {
                alert('Please fill out all asset fields (Type, Category, Quantity, Specification).');
                return;
            }
            if (parseInt(quantity) <= 0) { alert('Quantity must be greater than zero.'); return; }
            
            assets.push({ type_id: typeId, type_title: typeTitle, brand_id: brandId, brand_title: brandTitle, quantity: parseInt(quantity), specification: spec });
            
            // Clear inputs
            typeSelect.value = ''; brandSelect.value = ''; quantityInput.value = ''; specInput.value = '';
            if (typeof $(typeSelect).select2  === 'function') $(typeSelect).val('').trigger('change');
            if (typeof $(brandSelect).select2 === 'function') $(brandSelect).val('').trigger('change');
            
            renderAssetsTable();
            updateHiddenInput();
        }
        
        window.removeAsset = function(index) {
            assets.splice(index, 1);
            renderAssetsTable();
            updateHiddenInput();
        };
        
        function updateHiddenInput() {
            document.getElementById('assets_input').value = JSON.stringify(assets);
            // ── product_id: always the type_id of the FIRST asset ──
            if (productIdInput) {
                productIdInput.value = (assets.length > 0) ? (assets[0].type_id || '') : (productIdInput.value || '');
            }
        }
        
        let btnAddAsset = document.getElementById('btn-add-asset');
        if (btnAddAsset) {
            btnAddAsset.addEventListener('click', function(e) { e.preventDefault(); addAssetToList(); });
        }
    });
</script>
@endsection
