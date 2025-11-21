<x-app-layout>
    <div class="container py-5">
        <div class="mb-4">
            <h3 class="fw-bold text-dark m-0">My Profile</h3>
            <small class="text-muted">Manage your account, security, and activity history</small>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-6">
                <div class="card card-modern h-100">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success bg-opacity-10 p-2 me-2">
                                <i class="fas fa-user-edit text-success"></i>
                            </div>
                            <h6 class="fw-bold m-0 text-dark">Profile Information</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-modern h-100">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-2 me-2">
                                <i class="fas fa-key text-warning"></i>
                            </div>
                            <h6 class="fw-bold m-0 text-dark">Security & Password</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-modern">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                <i class="fas fa-history text-primary"></i>
                            </div>
                            <h6 class="fw-bold m-0 text-dark">Recent Activity Logs</h6>
                        </div>
                    </div>
                    <div class="card-body p-4"> <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 datatable" style="width:100%">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 7%;">#</th>
                                        <th class="px-3 py-3 small text-muted text-uppercase" style="width: 25%;">Action</th>
                                        <th class="px-3 py-3 small text-muted text-uppercase" style="width: 50%;">Details</th>
                                        <th class="px-3 py-3 small text-muted text-uppercase" style="width: 25%;">Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                        <tr>
                                            <td class="px-3 fw-bold text-secondary text-center">{{ $loop->iteration }}</td>
                                            <td class="px-3 small text-dark fw-bold">{{ $log->action }}</td>
                                            <td class="px-3 text-muted small">{{ $log->details }}</td>
                                            <td class="px-3 text-muted small fw-bold">
                                                {{ $log->created_at->format('M d, Y h:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-modern border-start border-danger border-4">
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-trash-alt me-2"></i> {{ __('Confirm Deletion') }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. This action is irreversible.') }}
                        </p>

                        <div class="alert alert-warning small d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <span>Please enter your password to confirm deletion.</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control border-start-0" placeholder="Enter your password" required>
                            </div>
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>