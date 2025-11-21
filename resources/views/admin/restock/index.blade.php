<x-app-layout>
    <div class="container py-5">
        <div class="mb-4">
            <h3 class="fw-bold text-dark m-0">Restock Requests</h3>
            <small class="text-muted">Manage stock replenishment requests from staff</small>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <table class="table table-hover align-middle datatable" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 5%;">#</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Date Requested</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Staff</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Product</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Qty Needed</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Notes</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Status</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $req)
                            <tr>
                                <td class="px-3 fw-bold text-secondary text-center">{{ $loop->iteration }}</td>
                                <td class="px-3 text-muted small fw-bold">{{ $req->created_at->format('M d, Y h:i A') }}</td>
                                <td class="px-3 fw-bold small text-dark">
                                    <div class="d-flex align-items-center gap-2">
                                        
                                        @if($req->user->avatar)
                                            <img src="{{ asset('storage/' . $req->user->avatar) }}" 
                                                alt="{{ $req->user->name }}" 
                                                class="rounded-circle" 
                                                style="width: 30px; height: 30px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" 
                                                style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                {{ substr($req->user->name, 0, 1) }}
                                            </div>
                                        @endif
                                        {{ $req->user->name }}
                                    </div>
                                </td>
                                <td class="px-3 text-dark small fw-bold">{{ $req->product->name }}</td>
                                <td class="px-3 text-center fw-bold text-dark"><span class="badge bg-success">{{ $req->quantity }}</span></td>
                                <td class="px-3 text-muted small fst-italic" style="max-width: 100px;"><div class="text-truncate" title="{{ $req->notes }}">{{ Str::limit($req->notes, 30) ?? '-' }}</div></td>
                                
                                <td class="px-3 text-center">
                                    @if($req->status == 'pending')
                                        <span class="badge bg-warning text-dark shadow-sm">Pending</span>
                                    @elseif($req->status == 'approved')
                                        <span class="badge bg-success shadow-sm">Approved</span>
                                    @else
                                        <span class="badge bg-danger shadow-sm">Rejected</span>
                                    @endif
                                </td>

                                <td class="px-3 text-center">
                                    @if($req->status == 'pending')
                                        <div class="btn-group" role="group">
                                            <form action="{{ route('admin.restock.approve', $req->id) }}" method="POST" class="d-inline">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-sm btn-light text-primary border me-2 rounded" title="Approve & Add Stock" onclick="return confirm('Approve this request? This will add {{ $req->quantity }} stocks to the product.')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.restock.reject', $req->id) }}" method="POST" class="d-inline">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-sm btn-light text-danger border rounded" title="Reject Request" onclick="return confirm('Reject this request?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <form action="{{ route('admin.restock.destroy', $req->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-light text-danger border rounded" title="Delete Record" onclick="return confirm('Delete this record?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>