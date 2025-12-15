@extends('admin.layout')

@section('title', 'Edit Subscription Plan')

@section('content')

    {{-- ================= PAGE HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Edit Subscription Plan</h3>
            <p class="text-muted mb-0">
                Update pricing, limits, and plan duration
            </p>
        </div>

        <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-outline-warning btn-sm">
            ← Back
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
        <div class="card-body p-4">

            <form method="POST" action="{{ route('admin.subscription-plans.update', $plan->id) }}">
                @csrf
                @method('PATCH')

                {{-- Name --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Plan Name <span class="text-danger">*</span>
                    </label>
                    <input name="name" class="form-control" value="{{ old('name', $plan->name) }}" required>
                </div>

                {{-- Price --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Price (USD) <span class="text-danger">*</span>
                    </label>
                    <input name="price" type="number" step="0.01" min="0" class="form-control"
                        value="{{ old('price', $plan->price) }}" required>
                </div>

                <div class="row">
                    {{-- Duration --}}
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Duration (days) <span class="text-danger">*</span>
                        </label>
                        <input name="duration_days" type="number" min="1" class="form-control"
                            value="{{ old('duration_days', $plan->duration_days) }}" required>
                        <div class="form-text">
                            Number of days this plan is valid
                        </div>
                    </div>

                    {{-- Menu Limit --}}
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-semibold">
                            Menu Limit
                        </label>
                        <input name="menu_limit" type="number" min="0" class="form-control"
                            value="{{ old('menu_limit', $plan->menu_limit) }}">
                        <div class="form-text">
                            Set <strong>0</strong> to disable menu creation
                        </div>
                    </div>
                </div>

                {{-- Staff Limit --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Staff Limit
                    </label>
                    <input name="staff_limit" type="number" min="0" class="form-control"
                        value="{{ old('staff_limit', $plan->staff_limit) }}">
                    <div class="form-text">
                        Set <strong>0</strong> to prevent adding staff users
                    </div>
                </div>

                {{-- Features --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Features
                    </label>
                    <textarea name="features_text" class="form-control" rows="4" placeholder="One feature per line">{{ old('features_text', is_array($plan->features) ? implode("\n", $plan->features) : '') }}</textarea>
                    <div class="form-text">
                        Optional — each line will be stored as a feature
                    </div>
                </div>

                {{-- Divider --}}
                <hr class="my-4">

                {{-- Actions --}}
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Plan ID #{{ $plan->id }}
                    </div>

                    <button class="btn btn-outline-warning px-4">
                        <i class="bi bi-save"></i> Save Changes
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
