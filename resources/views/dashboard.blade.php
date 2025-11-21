<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark m-0">Inventory Dashboard</h3>
                <small class="text-muted">Staff View - Quick Stock Adjustments</small>
            </div>
            <a href="{{ route('staff.products.create') }}" class="btn btn-primary shadow-sm px-4">
                <i class="fas fa-plus me-2"></i> Add Product
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <table class="table table-hover align-middle datatable" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 7%;">#</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Product</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Description</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Category</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Stock</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 20%;">Quick Actions</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="px-3 fw-bold text-secondary text-center">{{ $loop->iteration }}</td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        @if($product->image_path)
                                            <img src="{{ asset('storage/' . $product->image_path) }}" class="rounded border me-3" width="40" height="40" style="object-fit: cover;">
                                        @else
                                            <div class="rounded border me-3 bg-light d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px;">
                                                <i class="fas fa-box"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold small text-dark">{{ $product->name }}</div>
                                            <div class="small text-muted">₱ {{ number_format($product->price, 2) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 text-muted small" style="max-width: 200px;">
                                    <div class="text-truncate" title="{{ $product->description }}">
                                        {{ Str::limit($product->description, 100) }} 
                                    </div>
                                </td>
                                <td class="px-3 text-center">
                                    <span class="badge bg-light text-dark border">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                </td>
                                <td class="px-3 text-center">
                                    @if($product->quantity <= 10)
                                        <span class="badge bg-danger">Low: {{ $product->quantity }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $product->quantity }}</span>
                                    @endif
                                </td>
                                
                                <td class="px-3 text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" 
                                                class="btn btn-sm btn-light text-primary border me-2  rounded" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#stockModal"
                                                data-id="{{ $product->id }}"
                                                data-name="{{ $product->name }}"
                                                data-type="in"
                                                title="Add Stock">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-light text-danger border me-2  rounded"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#stockModal"
                                                data-id="{{ $product->id }}"
                                                data-name="{{ $product->name }}"
                                                data-type="out"
                                                title="Deduct Stock">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <button type="button" 
                                                class="btn btn-sm btn-light text-warning border me-2 rounded"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#restockModal"
                                                data-id="{{ $product->id }}"
                                                data-name="{{ $product->name }}"
                                                title="Request Restock">
                                            <i class="fas fa-bullhorn"></i>
                                        </button>

                                        <a href="{{ route('staff.products.label', $product->id) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-light text-warning border rounded"
                                           title="Print Label">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </div>
                                </td>

                                <td class="px-3 text-center">
                                    <a href="{{ route('staff.products.edit', $product->id) }}" class="btn btn-sm btn-light text-primary border me-2 rounded"  title="Edit Details">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="stockModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('staff.stock.adjust') }}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="product_id" id="modal_product_id">
                    <input type="hidden" name="type" id="modal_type">

                    <div class="modal-header text-white" id="modal_header_bg">
                        <h5 class="modal-title fw-bold" id="modal_title">Adjust Stock</h5>
                        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">
                        <p class="text-muted mb-3">
                            Adjusting stock for: <strong id="modal_product_name" class="text-dark">Product Name</strong>
                        </p>

                        <label class="form-label fw-bold small text-muted">Quantity</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-light"><i class="fas fa-hashtag"></i></span>
                            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity" min="1" required>
                        </div>

                        <label class="form-label fw-bold small text-muted">Reason / Remarks</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-pen"></i></span>
                            <input type="text" name="remarks" class="form-control" placeholder="e.g. New Delivery, Damaged Item, Sold" required>
                        </div>
                    </div>

                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" id="modal_submit_btn">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="restockModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('staff.restock.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" id="restock_product_id">

                    <div class="modal-header bg-light text-dark">
                        <h5 class="modal-title fw-bold"><i class="fas fa-bullhorn me-2"></i> Request Restock</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">
                        <p class="text-muted mb-3">
                            Notify admin that <strong id="restock_product_name" class="text-dark">Product</strong> needs replenishing.
                        </p>

                        <label class="form-label fw-bold small text-muted">Suggested Quantity (Optional)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-light"><i class="fas fa-cubes"></i></span>
                            <input type="number" name="quantity" class="form-control" placeholder="How many items needed?">
                        </div>

                        <label class="form-label fw-bold small text-muted">Notes to Admin</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="e.g. Stocks are running very low..."></textarea>
                    </div>

                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>