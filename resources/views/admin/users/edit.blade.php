@extends('admin.layout')

@section('title', 'Edit User')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- ================= PAGE HEADER ================= --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Edit User</h3>
                    <p class="text-muted mb-0">
                        Update user information and role
                    </p>
                </div>

                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-light">
                    ← Back
                </a>
            </div>

            {{-- ================= CARD ================= --}}
            <div class="card">
                <div class="card-body p-4">

                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                                required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        {{-- Passwords --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    New Password
                                </label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Leave blank to keep current">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Confirm Password
                                </label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Repeat new password">
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
                                            {{ old('restaurant_id', $user->restaurant_id) == $restaurant->id ? 'selected' : '' }}>
                                            {{ $restaurant->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="form-text">
                                    Change which restaurant this staff belongs to
                                </div>
                            </div>

                        @endif

                        {{-- Role --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Role <span class="text-danger">*</span>
                            </label>
                            <select name="role_id" class="form-select" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
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
                                User ID #{{ $user->id }}
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-light">
                                    Cancel
                                </a>

                                <button class="btn btn-outline-warning px-4">
                                    <i class="bi bi-save"></i> Save Changes
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
