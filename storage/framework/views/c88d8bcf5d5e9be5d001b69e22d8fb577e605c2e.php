<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('page_css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="main-body">
    <div class="page-wrapper">
        <div class="procurement-header">
            <ul class="procurement-breadcrumb">
                <li><a href="<?php echo e(route('admin.dashboard.index')); ?>">Dashboard</a></li>
                <li><a href="<?php echo e(route('admin.procurement.index')); ?>">Procurement</a></li>
                <li class="active">Add Procurement</li>
            </ul>
        </div>
        <div class="procurement-card">
            <form method="POST" action="<?php echo e(route('admin.procurement.store')); ?>" class="needs-validation" novalidate>
                <?php echo csrf_field(); ?>
                
                <h5 class="section-title"><i class="fas fa-edit"></i> Create Procurement</h5>
                <hr class="mb-4">
                
                <div class="row">
                    <!-- Request Number -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="procurement_number" class="form-label">Request Number <span>*</span></label>
                        <input type="text" class="form-control readonly-bg" name="procurement_number" id="procurement_number" value="<?php echo e(old('procurement_number', $generated_procurement_number)); ?>" readonly required>
                        <div class="invalid-feedback"><?php echo e(__('required_field')); ?> Request Number</div>
                    </div>

                    <!-- Department Dropdown -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="department_id" class="form-label">Department <span>*</span></label>
                        <select class="form-control select2" name="department_id" id="department_id" required>
                            <option value="">Select Department</option>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($department->id); ?>" <?php if(old('department_id') == $department->id): ?> selected <?php endif; ?>>
                                    <?php echo e($department->title); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e(__('required_field')); ?> Department</div>
                    </div>
                    
                    <!-- Supplier Name Dropdown -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="supplier_select" class="form-label">Assign Person</label>
                        <select class="form-control select2" name="staff_id" id="supplier_select">
                            <option value="">Select Assign Person</option>
                            <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($supplier->id); ?>" data-department-id="<?php echo e($supplier->department_id); ?>"
                                    <?php if(old('staff_id') == $supplier->id): ?> selected <?php endif; ?>>
                                    <?php if($supplier->staff_id): ?><?php echo e($supplier->staff_id); ?> - <?php endif; ?><?php echo e($supplier->first_name); ?> <?php echo e($supplier->last_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback"><?php echo e(__('required_field')); ?> Assign Person</div>
                    </div>
                </div>

                <div class="row">
                    <!-- Request Date -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="request_date" class="form-label">Request Date <span>*</span></label>
                        <input type="date" class="form-control" name="request_date" id="request_date" value="<?php echo e(old('request_date', date('Y-m-d'))); ?>" required>
                        <div class="invalid-feedback"><?php echo e(__('required_field')); ?> Request Date</div>
                    </div>
                    
                    <!-- Urgency -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="urgency" class="form-label">Urgency <span>*</span></label>
                        <select class="form-control" name="urgency" id="urgency" required>
                            <option value="">Select Urgency</option>
                            <option value="Immediate" <?php if(old('urgency') == 'Immediate'): ?> selected <?php endif; ?>>Immediate</option>
                            <option value="Within 7 days" <?php if(old('urgency') == 'Within 7 days'): ?> selected <?php endif; ?>>Within 7 days</option>
                            <option value="Within 15 days" <?php if(old('urgency') == 'Within 15 days'): ?> selected <?php endif; ?>>Within 15 days</option>
                            <option value="Within 30 days" <?php if(old('urgency') == 'Within 30 days'): ?> selected <?php endif; ?>>Within 30 days</option>
                            <option value="Other" <?php if(old('urgency') == 'Other'): ?> selected <?php endif; ?>>Other</option>
                        </select>
                        <div class="form-group mt-2" id="urgency_reason_div" style="display: <?php echo e(old('urgency') == 'Other' ? 'block' : 'none'); ?>;">
                            <label for="urgency_reason" class="form-label">Urgency Reason <span>*</span></label>
                            <input type="text" class="form-control" name="urgency_reason" id="urgency_reason" value="<?php echo e(old('urgency_reason')); ?>" <?php echo e(old('urgency') == 'Other' ? 'required' : ''); ?>>
                        </div>
                        <div class="invalid-feedback"><?php echo e(__('required_field')); ?> Urgency</div>
                    </div>
                    
                    <!-- Purpose -->
                    <div class="form-group col-md-4 mb-3">
                        <label for="purpose" class="form-label">Purpose</label>
                        <textarea class="form-control" name="purpose" id="purpose" rows="2" placeholder="Enter Purpose"><?php echo e(old('purpose')); ?></textarea>
                    </div>
                </div>

                <!-- Add Product Section -->
                <h5 class="section-title mt-4"><i class="fas fa-box-open"></i> Add Product</h5>
                <hr class="mb-4">
                
                <div class="row">
                    <!-- Brand / Category -->
                    <div class="form-group col-md-3 mb-3">
                        <label for="asset_brand" class="form-label">Category <span>*</span></label>
                        <select class="form-control select2" id="asset_brand">
                            <option value="">Select Category</option>
                            <?php $__currentLoopData = $asset_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($brand->id); ?>" data-title="<?php echo e($brand->title); ?>"><?php echo e($brand->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Type -->
                    <div class="form-group col-md-3 mb-3">
                        <label for="asset_type" class="form-label">Type <span>*</span></label>
                        <select class="form-control select2" id="asset_type">
                            <option value="">Select Type</option>
                            <?php $__currentLoopData = $asset_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->id); ?>" data-title="<?php echo e($type->name); ?>" data-category-id="<?php echo e($type->category_id); ?>"><?php echo e($type->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                        <td colspan="6" class="text-center text-muted">No assets added yet.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Hidden inputs to submit assets data and foreign keys -->
                <input type="hidden" name="assets" id="assets_input" value="[]">
                <input type="hidden" name="product_id" id="product_id_input" value="">

                <div class="d-flex justify-content-end">
                    <a href="<?php echo e(route('admin.procurement.index')); ?>" class="btn btn-secondary me-2"><?php echo e(__('btn_cancel')); ?></a>
                    <button type="submit" class="btn btn-add-request"><i class="fas fa-check"></i> <?php echo e(__('btn_save')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productIdInput = document.getElementById('product_id_input');
        const typeSelect     = document.getElementById('asset_type');
        const brandSelect    = document.getElementById('asset_brand');
        let assets = [];

        // ── Filter Type by Category ──
        const assetTypes = <?php echo json_encode($asset_types->map(function($t) { return ['id' => $t->id, 'category_id' => $t->category_id, 'name' => $t->name]; })) ?>;
        
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
        const staffs = <?php echo json_encode($suppliers->map(function($s) { return ['id' => $s->id, 'department_id' => $s->department_id, 'name' => ($s->staff_id ? $s->staff_id . ' - ' : '') . $s->first_name . ' ' . $s->last_name]; })) ?>;
        
        const $departmentSelect = $('#department_id');
        const $staffSelect = $('#supplier_select');
        
        if ($departmentSelect.length && $staffSelect.length) {
            function filterStaff() {
                const deptId = $departmentSelect.val();
                const currentStaffId = $staffSelect.val() || "<?php echo e(old('staff_id')); ?>";
                
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

        // ── Assets table ──
        function renderAssetsTable() {
            const tbody = document.getElementById('assets_table_body');
            tbody.innerHTML = '';
            if (assets.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">No assets added yet.</td></tr>';
                return;
            }
            assets.forEach((asset, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${escapeHtml(asset.type_title)}</td>
                    <td>${escapeHtml(asset.brand_title)}</td>
                    <td class="text-center">${asset.quantity}</td>
                    <td>${escapeHtml(asset.specification)}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="window.removeAsset(${index})">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>`;
                tbody.appendChild(tr);
            });
        }

        function escapeHtml(text) {
            if (!text) return '';
            return text.toString()
                .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
                .replace(/"/g,'&quot;').replace(/'/g,'&#039;');
        }

        function updateHiddenInput() {
            document.getElementById('assets_input').value = JSON.stringify(assets);
            // product_id = type_id of the first asset
            if (productIdInput) {
                productIdInput.value = assets.length > 0 ? (assets[0].type_id || '') : '';
            }
        }

        function addAssetToList() {
            const typeId     = typeSelect.value;
            const typeTitle  = typeSelect.selectedIndex > -1 ? (typeSelect.options[typeSelect.selectedIndex].getAttribute('data-title') || '') : '';
            const categoryId    = brandSelect.value;
            const categoryTitle = brandSelect.selectedIndex > -1 ? (brandSelect.options[brandSelect.selectedIndex].getAttribute('data-title') || '') : '';
            const quantity   = document.getElementById('asset_quantity').value;
            const spec       = document.getElementById('asset_specification').value;

            if (!typeId || !categoryId || !quantity || !spec) {
                alert('Please fill out all asset fields (Type, Category, Quantity, Specification).');
                return;
            }
            if (parseInt(quantity) <= 0) { alert('Quantity must be greater than zero.'); return; }

            assets.push({ type_id: typeId, type_title: typeTitle, brand_id: categoryId, brand_title: categoryTitle, quantity: parseInt(quantity), specification: spec });

            // Clear inputs
            document.getElementById('asset_quantity').value = '';
            document.getElementById('asset_specification').value = '';
            typeSelect.value = ''; brandSelect.value = '';
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

        const btnAddAsset = document.getElementById('btn-add-asset');
        if (btnAddAsset) btnAddAsset.addEventListener('click', function(e) { e.preventDefault(); addAssetToList(); });

        // Restore old assets on validation error redirect
        <?php if(old('assets')): ?>
            try {
                assets = JSON.parse(<?php echo json_encode(old('assets')); ?>);
                if (typeof assets === 'string') assets = JSON.parse(assets);
                renderAssetsTable();
                updateHiddenInput();
            } catch(e) { console.error('Error parsing old assets', e); }
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views\admin\procurement\create.blade.php ENDPATH**/ ?>