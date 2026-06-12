<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('title', 'Products')
    @include('admin.layouts.common.header_script')
    <style>
        .sp-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border: none;
            margin-bottom: 24px;
        }
        .sp-card-header {
            background: #0d6efd;
            color: #fff;
            border-radius: 10px 10px 0 0;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .sp-card-header h5 { margin: 0; font-weight: 600; font-size: 16px; }
        .btn-sp-add {
            background: #fff;
            color: #0d6efd;
            border: none;
            border-radius: 6px;
            padding: 6px 16px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-sp-add:hover { background: #e8f0fe; color: #0d6efd; text-decoration: none; }
        .sp-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .sp-table th { background: #f8f9fa; color: #888; font-weight: 600; padding: 12px 18px; border-bottom: 1px solid #eee; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; }
        .sp-table td { padding: 14px 18px; border-bottom: 1px solid #f0f0f0; color: #333; vertical-align: middle; }
        .sp-table tr:last-child td { border-bottom: none; }
        .badge-active   { background: #d4edda; color: #155724; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-inactive { background: #f8d7da; color: #721c24; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .btn-action { padding: 4px 10px; border-radius: 5px; font-size: 12px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; margin-right: 4px; display: inline-flex; align-items: center; gap: 4px; }
        .btn-view   { background: #17a2b8; color: #fff; }
        .btn-edit   { background: #28a745; color: #fff; }
        .btn-delete { background: #dc3545; color: #fff; }
        .btn-action:hover { opacity: 0.85; color: #fff; text-decoration: none; }
        #autocomplete_suggestions {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-height: 200px;
            overflow-y: auto;
            position: absolute;
            z-index: 1050;
            width: 100%;
        }
        #autocomplete_suggestions .list-group-item {
            border: none;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            text-align: left;
        }
        #autocomplete_suggestions .list-group-item:last-child {
            border-bottom: none;
        }
        #autocomplete_suggestions .list-group-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <div class="loader-bg"><div class="loader-track"><div class="loader-fill"></div></div></div>

    @include('supplier.layouts.sidebar')

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed header-lightblue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            @if(isset($setting) && !empty($setting->logo_path) && file_exists(public_path('uploads/setting/'.$setting->logo_path)))
            <a href="{{ route('supplier.dashboard.index') }}" class="b-brand">
                <div class="b-bg"><img src="{{ asset('uploads/setting/'.$setting->logo_path) }}" alt="logo" height="20"></div>
            </a>
            @endif
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!"><i class="feather icon-more-horizontal"></i></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li><a href="#!" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li><h4 class="topbar-title">{{ $setting->title ?? 'Supplier Portal' }}</h4></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-user"></i></a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{ asset('dashboard/images/user/avatar-2.jpg') }}" class="img-radius" alt="User">
                                <span>{{ Auth::guard('supplier')->user()->title ?? 'Supplier' }}</span>
                                <a href="javascript:void(0);" class="dud-logout" onclick="event.preventDefault(); document.getElementById('supplier-logout-form').submit();">
                                    <i class="feather icon-log-out"></i>
                                </a>
                                <form id="supplier-logout-form" action="{{ route('supplier.logout') }}" method="POST" style="display:none;">@csrf</form>
                            </div>
                            <ul class="pro-body">
                                <li><a href="{{ route('supplier.dashboard.index') }}" class="dropdown-item"><i class="feather icon-home"></i> Dashboard</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item" onclick="document.getElementById('supplier-logout-form').submit()"><i class="feather icon-log-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <!-- [ Main Content ] -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">

                            <div class="page-header mb-4">
                                <div class="page-block">
                                    <ul class="breadcrumb" style="background:transparent;padding:0;margin-bottom:4px;">
                                        <li class="breadcrumb-item"><a href="{{ route('supplier.dashboard.index') }}" class="text-muted">Pages</a></li>
                                        <li class="breadcrumb-item text-muted">Products</li>
                                        <li class="breadcrumb-item text-muted">List</li>
                                    </ul>
                                    <h5 style="font-weight:700;color:#333;margin:0;">Products</h5>
                                </div>
                            </div>

                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <script>
                                setTimeout(function() {
                                    let alertElement = document.getElementById('successAlert');
                                    if(alertElement) {
                                        alertElement.classList.remove('show');
                                        setTimeout(() => alertElement.remove(), 150);
                                    }
                                }, 1500); // 1.5 seconds timer
                            </script>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <script>
                                setTimeout(function() {
                                    let alertElement = document.getElementById('errorAlert');
                                    if(alertElement) {
                                        alertElement.classList.remove('show');
                                        setTimeout(() => alertElement.remove(), 150);
                                    }
                                }, 3000); // 3 seconds timer
                            </script>
                            @endif

                            <div class="sp-card">
                                <div class="sp-card-header">
                                    <h5><i class="fas fa-box me-2"></i> My Products</h5>
                                    <button type="button" class="btn-sp-add" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                        <i class="fas fa-plus"></i> Add More Product
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="sp-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Category</th>
                                                <th>Total Stock</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($items as $key => $item)
                                            <tr>
                                                <td>{{ $items->firstItem() + $key }}</td>
                                                <td><strong>{{ $item->name }}</strong></td>
                                                <td>{{ $item->category->title ?? '-' }}</td>
                                                <td><span class="badge bg-primary" style="font-size: 11px; padding: 4px 10px;">{{ $item->stocks->where('supplier_id', Auth::guard('supplier')->user()->id)->sum('quantity') }}</span></td>
                                                <td>{{ $item->description ? \Str::limit($item->description, 50) : '-' }}</td>
                                                <td>
                                                    @if($item->status == 1)
                                                        <span class="badge-active">Active</span>
                                                    @else
                                                        <span class="badge-inactive">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('supplier.stock.create', ['item_id' => $item->id]) }}" class="btn-action" style="background-color: #17a2b8; color: white;"><i class="fas fa-plus"></i> Add Stock</a>
                                                    <a href="{{ route('supplier.product.edit', $item->id) }}" class="btn-action btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                                    <form action="{{ route('supplier.product.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Remove this product?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn-action btn-delete"><i class="fas fa-trash"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted" style="padding:30px;">No products found. Click "Add More Product" to select products.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if($items->hasPages())
                                <div style="padding: 15px 18px;">{{ $items->links() }}</div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('supplier.product.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="product_id" id="modal_product_id">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add More Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 position-relative">
                            <label for="modal_product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="product_name" id="modal_product_name" placeholder="Type product name..." required autocomplete="off">
                            <div id="autocomplete_suggestions" class="list-group d-none">
                                <!-- Suggestions will be appended here dynamically -->
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="modal_category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" name="category_id" id="modal_category_id" required>
                                <option value="">Select Category</option>
                                @foreach($all_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="modal_product_description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="modal_product_description" rows="3" placeholder="Optional description..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const allItems = @json($all_items);
            const nameInput = document.getElementById('modal_product_name');
            const idInput = document.getElementById('modal_product_id');
            const categorySelect = document.getElementById('modal_category_id');
            const descriptionInput = document.getElementById('modal_product_description');
            const suggestionsContainer = document.getElementById('autocomplete_suggestions');

            nameInput.addEventListener('input', function() {
                const value = this.value.trim().toLowerCase();
                idInput.value = ''; // Reset ID on manual typing
                suggestionsContainer.innerHTML = '';
                
                if (value.length < 1) {
                    suggestionsContainer.classList.add('d-none');
                    return;
                }

                const matches = allItems.filter(item => {
                    const nameLower = item.name.toLowerCase();
                    return nameLower.startsWith(value) || nameLower.includes(' ' + value);
                });
                
                if (matches.length > 0) {
                    suggestionsContainer.classList.remove('d-none');
                    matches.forEach(item => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'list-group-item list-group-item-action text-start d-flex justify-content-between align-items-center';
                        btn.style.padding = '8px 12px';
                        btn.style.fontSize = '13px';
                        btn.innerHTML = `<span><strong>${item.name}</strong></span> <span class="badge bg-secondary text-white">${item.category ? item.category.title : ''}</span>`;
                        
                        btn.addEventListener('click', function() {
                            nameInput.value = item.name;
                            idInput.value = item.id;
                            if (item.category_id) {
                                categorySelect.value = item.category_id;
                            }
                            descriptionInput.value = item.description || '';
                            suggestionsContainer.classList.add('d-none');
                            suggestionsContainer.innerHTML = '';
                        });
                        
                        suggestionsContainer.appendChild(btn);
                    });
                } else {
                    suggestionsContainer.classList.add('d-none');
                }
            });

            // Close suggestions dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (e.target !== nameInput && e.target !== suggestionsContainer) {
                    suggestionsContainer.classList.add('d-none');
                }
            });
        });
    </script>

    @include('admin.layouts.common.footer_script')
</body>
</html>
