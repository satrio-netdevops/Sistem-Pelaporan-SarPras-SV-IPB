<section>
    {{-- Tambahkan Style Khusus untuk menimpa warna hijau bawaan --}}
    <style>
        /* Paksa warna Navy untuk Label */
        .text-navy-custom {
            color: #001f5f !important;
        }

        /* Override total untuk modern-input-group agar menjadi Biru */
        .modern-input-group-ipb {
            display: flex;
            align-items: center;
            background-color: #f8f9fa !important;
            border: 1px solid #ced4da !important; /* Border default abu */
            border-radius: 12px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        /* Saat input diklik (Focus) -> Jadi Biru Navy */
        .modern-input-group-ipb:focus-within {
            border-color: #001f5f !important;
            box-shadow: 0 0 0 4px rgba(0, 31, 95, 0.1) !important; /* Glow Biru */
            background-color: #fff !important;
        }

        /* Warna Ikon di dalam input */
        .modern-input-group-ipb i {
            color: #001f5f !important; /* Ikon Navy */
            opacity: 0.7;
            transition: opacity 0.3s;
        }
        .modern-input-group-ipb:focus-within i {
            opacity: 1;
        }

        /* Reset input field bawaan */
        .modern-input-group-ipb input {
            border: none !important;
            background: transparent !important;
            outline: none !important;
            box-shadow: none !important;
            width: 100%;
            color: #333;
        }

        /* Tombol IPB */
        .btn-ipb {
            background: linear-gradient(135deg, #001f5f 0%, #0056b3 100%) !important;
            border: none !important;
            color: white !important;
        }
        .btn-ipb:hover {
            opacity: 0.9;
            box-shadow: 0 4px 12px rgba(0, 31, 95, 0.3);
        }
    </style>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="d-flex align-items-center mb-4">
            <div class="me-3">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" 
                         alt="Avatar" 
                         {{-- Border avatar dipaksa biru (#001f5f) --}}
                         class="rounded-circle p-1" 
                         style="width: 80px; height: 80px; object-fit: cover; border: 2px solid #001f5f;">
                @else
                    {{-- Avatar placeholder biru --}}
                    <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold fs-3" 
                         style="width: 80px; height: 80px; background-color: rgba(0, 31, 95, 0.1); color: #001f5f; border: 2px solid rgba(0, 31, 95, 0.3);">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="flex-grow-1">
                <label class="form-label fw-bold small text-navy-custom">Profile Picture</label>
                <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*" style="border-color: #ced4da;">
                <div class="form-text small text-muted">Allowed: jpg, jpeg, png. Max: 2MB</div>
                @error('avatar') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-navy-custom">Full Name</label>
            {{-- Tambahkan class modern-input-group-ipb --}}
            <div class="modern-input-group modern-input-group-ipb">
                <i class="fas fa-user"></i>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
            </div>
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold small text-navy-custom">Email Address</label>
            <div class="modern-input-group modern-input-group-ipb">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
            </div>
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert alert-warning mt-2 small">
                    {{ __('Your email address is unverified.') }}
                    <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline small fw-bold">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </div>
                @if (session('status') === 'verification-link-sent')
                    <div class="text-success small mt-1 fw-bold">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                @endif
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-ipb px-4 text-white">
                {{ __('Save Changes') }}
            </button>
        </div>
    </form>
</section>