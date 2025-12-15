@extends('admin.layout')

@section('title', 'Create Subscription Plan')

@section('content')

    {{-- ================= PAGE HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Create Subscription Plan</h3>
            <p class="text-muted mb-0">
                Define pricing, duration, and feature limits
            </p>
        </div>

        <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-outline-warning">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ================= CARD ================= --}}
    <div class="card">
        <div class="card-body p-4 p-lg-5">

            <form method="POST" action="{{ route('admin.subscription-plans.store') }}">
                @csrf

                {{-- Plan Name --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Plan Name <span class="text-danger">*</span>
                    </label>
                    <input name="name" class="form-control" placeholder="e.g. Starter, Pro, Enterprise"
                        value="{{ old('name') }}" required>
                </div>

                {{-- Price & Duration --}}
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Price (USD) <span class="text-danger">*</span>
                        </label>
                        <input name="price" type="number" step="0.01" class="form-control" placeholder="e.g. 9.99"
                            value="{{ old('price') }}" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Duration (days) <span class="text-danger">*</span>
                        </label>
                        <input name="duration_days" type="number" class="form-control" placeholder="e.g. 30"
                            value="{{ old('duration_days', 30) }}" required>
                        <div class="form-text">
                            Subscription validity period
                        </div>
                    </div>
                </div>

                {{-- Limits --}}
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Menu Limit
                        </label>
                        <input name="menu_limit" type="number" min="0" class="form-control" placeholder="e.g. 10"
                            value="{{ old('menu_limit', 0) }}">
                        <div class="form-text">
                            Set <strong>0</strong> to disable menu creation
                        </div>
                    </div>


                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Staff Limit
                        </label>
                        <input name="staff_limit" type="number" min="0" class="form-control" placeholder="e.g. 5"
                            value="{{ old('staff_limit', 0) }}">
                        <div class="form-text">
                            Set <strong>0</strong> to prevent adding staff users
                        </div>
                    </div>

                </div>

                {{-- Features --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Features
                    </label>
                    <textarea name="features_text" class="form-control" rows="4" placeholder="One feature per line">{{ old('features_text') }}</textarea>
                    <div class="form-text">
                        Example:
                        <br>• Unlimited QR scans
                        <br>• Custom branding
                        <br>• Priority support
                    </div>
                </div>

                {{-- Divider --}}
                <hr class="my-4">

                {{-- Actions --}}
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        All fields marked * are required
                    </div>

                    <button class="btn btn-outline-warning px-4">
                        <i class="bi bi-check-circle"></i> Create Plan
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
