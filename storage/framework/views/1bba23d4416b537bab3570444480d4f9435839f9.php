<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<style>
    .supplier-register-wrapper {
        background-color: #f8f9fa;
        padding: 60px 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    .register-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    .register-left {
        background-color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }
    .register-left img {
        max-width: 100%;
        height: auto;
    }
    .register-right {
        padding: 50px;
        background-color: #fff;
    }
    .register-title {
        color: #0d6efd; /* Blue color requested */
        font-weight: 600;
        margin-bottom: 10px;
    }
    .register-subtitle {
        color: #6c757d;
        margin-bottom: 30px;
    }
    .form-group label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #333;
    }
    .form-group label span {
        color: #dc3545;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 10px 15px;
        box-shadow: none;
        background-color: #fcfcfc;
    }
    .form-control:focus, .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .btn-custom-blue {
        background-color: #0d6efd;
        color: #fff;
        border-radius: 8px;
        padding: 10px 30px;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-custom-blue:hover {
        background-color: #0b5ed7;
        color: #fff;
    }
    .btn-custom-outline-blue {
        background-color: #fff;
        color: #0d6efd;
        border: 2px solid #0d6efd;
        border-radius: 8px;
        padding: 8px 30px;
        font-weight: 600;
        transition: all 0.3s;
        margin-left: 10px;
    }
    .btn-custom-outline-blue:hover {
        background-color: #0d6efd;
        color: #fff;
    }
    /* Custom Dropdown Styles */
    .custom-dropdown {
        position: relative;
    }
    .dropdown-toggle-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 10px 15px;
        background-color: #fcfcfc;
        cursor: pointer;
        font-size: 14px;
        color: #666;
        transition: border-color 0.2s;
    }
    .dropdown-toggle-btn:hover {
        border-color: #0d6efd;
    }
    .custom-dropdown.open .dropdown-toggle-btn {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    .custom-dropdown.open .dropdown-toggle-btn svg {
        transform: rotate(180deg);
    }
    .dropdown-menu-custom {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #ced4da;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        z-index: 1000;
        max-height: 250px;
        overflow: hidden;
        display: none;
    }
    .custom-dropdown.open .dropdown-menu-custom {
        display: block;
    }
    .dropdown-search {
        padding: 8px 12px;
    }
    .dropdown-search input {
        width: 100%;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 6px 10px;
        font-size: 13px;
        outline: none;
    }
    .dropdown-search input:focus {
        border-color: #0d6efd;
    }
    .dropdown-divider-line {
        border-top: 1px solid #e9ecef;
        margin: 0;
    }
    .dropdown-options {
        max-height: 170px;
        overflow-y: auto;
        padding: 4px 0;
    }
    .dropdown-option {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 14px;
        cursor: pointer;
        font-size: 14px;
        color: #0d6efd !important;
        margin: 0;
        transition: background 0.15s;
    }
    .dropdown-option span {
        color: #0d6efd !important;
    }
    .dropdown-option:hover {
        background-color: #f0f4ff;
    }
    .dropdown-option input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #0d6efd;
        cursor: pointer;
        flex-shrink: 0;
    }
    @media (max-width: 768px) {
        .register-right {
            padding: 30px;
        }
        .register-left {
            padding: 20px;
        }
    }
</style>

<div class="supplier-register-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="register-card">
                    <div class="col-md-5 register-left">
                        <!-- Placeholder for the illustration -->
                        <img src="https://img.freepik.com/free-vector/programming-concept-illustration_114360-1351.jpg" alt="Vendor Registration">
                    </div>
                    <div class="col-md-7 register-right">
                        <h4 class="register-title">Register As Supplier</h4>
                        <p class="register-subtitle">Let's make a relationship towards the growth.</p>
                        
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('supplier.register.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Name <span>*</span></label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Name" value="<?php echo e(old('title')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Email <span>*</span></label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo e(old('email')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Phone <span>*</span></label>
                                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" value="<?php echo e(old('phone')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Choose Category <span>*</span></label>
                                        <div class="custom-dropdown" id="categoryDropdown">
                                            <div class="dropdown-toggle-btn" onclick="toggleDropdown()">
                                                <span id="dropdownLabel">Select Type</span>
                                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" style="transition: transform 0.2s;">
                                                    <path d="M1 1L6 6L11 1" stroke="#666" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu-custom" id="dropdownMenu">
                                                <div class="dropdown-search">
                                                    <input type="text" placeholder="Search..." id="categorySearch" onkeyup="filterCategories()">
                                                </div>
                                                <div class="dropdown-divider-line"></div>
                                                <div class="dropdown-options">
                                                    <label class="dropdown-option">
                                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                                                        <span>Select all</span>
                                                    </label>
                                                    <div class="dropdown-divider-line"></div>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <label class="dropdown-option category-option">
                                                        <input type="checkbox" name="categories[]" value="<?php echo e($category->id); ?>" onchange="updateDropdownLabel()">
                                                        <span><?php echo e($category->title); ?></span>
                                                    </label>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Password <span>*</span></label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label>Confirm Password <span>*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <button type="submit" class="btn-custom-blue">Register</button>
                                <a href="<?php echo e(route('login')); ?>" class="btn-custom-outline-blue">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDropdown() {
        document.getElementById('categoryDropdown').classList.toggle('open');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        var dropdown = document.getElementById('categoryDropdown');
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });

    function filterCategories() {
        var search = document.getElementById('categorySearch').value.toLowerCase();
        var options = document.querySelectorAll('.category-option');
        options.forEach(function(option) {
            var text = option.querySelector('span').textContent.toLowerCase();
            option.style.display = text.includes(search) ? 'flex' : 'none';
        });
    }

    function toggleSelectAll() {
        var selectAll = document.getElementById('selectAll').checked;
        var checkboxes = document.querySelectorAll('.category-option input[type="checkbox"]');
        checkboxes.forEach(function(cb) {
            if (cb.closest('.category-option').style.display !== 'none') {
                cb.checked = selectAll;
            }
        });
        updateDropdownLabel();
    }

    function updateDropdownLabel() {
        var checked = document.querySelectorAll('.category-option input[type="checkbox"]:checked');
        var label = document.getElementById('dropdownLabel');
        if (checked.length === 0) {
            label.textContent = 'Select Type';
            label.style.color = '#666';
        } else {
            var names = [];
            checked.forEach(function(cb) {
                names.push(cb.closest('.category-option').querySelector('span').textContent);
            });
            label.textContent = names.join(', ');
            label.style.color = '#333';
        }

        // Update select-all checkbox state
        var allCheckboxes = document.querySelectorAll('.category-option input[type="checkbox"]');
        var allChecked = allCheckboxes.length > 0 && checked.length === allCheckboxes.length;
        document.getElementById('selectAll').checked = allChecked;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\university\resources\views/web/supplier-register.blade.php ENDPATH**/ ?>