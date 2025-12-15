@extends('admin.layout')

@section('title', 'Create User')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- ================= PAGE HEADER ================= --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Create User</h3>
                    <p class="text-muted mb-0">
                        Add a new user and assign a role
                    </p>
                </div>

                <a href="{{ route('admin.users.index') }}" class="btn btn-light">
                    ← Back
                </a>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <div class="fw-semibold mb-1">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Please fix the following errors:
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- ================= CARD ================= --}}
            <div class="card">
                <div class="card-body p-4">

                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                placeholder="Full name" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="user@example.com" required>
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Phone <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"
                                placeholder="e.g. 012 345 678" required>
                        </div>

                        {{-- Passwords --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password" class="form-control" placeholder="Create password"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Confirm Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Repeat password" required>
                            </div>
                        </div>
                        
                        {{-- ================= RESTAURANT (OWNER ONLY) ================= --}}
                        @if (auth()->user()->role_id === \App\Models\Role::OWNER)

                            <div class="mb-4">
                                <label class="form-label fw-semibold d-flex align-items-center gap-2">
                                    <i class="bi bi-shop text-warning"></i>
                                    Restaurant
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="restaurant_id" class="form-select" required>
                                    <option value="">— Select Restaurant —</option>

                                    @foreach ($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}"
                                            {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                                            {{ $restaurant->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="form-text">
                                    Select which restaurant this staff belongs to
                                </div>
                            </div>

                        @endif

                        {{-- Role --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Role <span class="text-danger">*</span>
                            </label>
                            <select name="role_id" class="form-select" required>
                                <option value="">— Select Role —</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Divider --}}
                        <hr class="my-4">

                        {{-- Actions --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                All fields marked * are required
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-light">
                                    Cancel
                                </a>

                                <button class="btn btn-outline-warning px-4">
                                    <i class="bi bi-person-plus"></i> Create User
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
