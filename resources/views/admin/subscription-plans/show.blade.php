@extends('admin.layout')

@section('title', 'Subscription Plan')

@section('content')

    {{-- ================= PAGE HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                {{ $plan->name }}
            </h3>
            <p class="text-muted mb-0">
                Subscription plan details and limits
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.subscription-plans.edit', $plan->id) }}" class="btn btn-outline-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
            </a>

            <a href="{{ route('admin.subscription-plans.index') }}"
                class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>

        </div>
    </div>

    {{-- ================= CARD ================= --}}
    <div class="card">
        <div class="card-body p-4">

            <div class="row g-4">

                {{-- Left column --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="text-muted small fw-semibold">Plan ID</div>
                        <div>#{{ $plan->id }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small fw-semibold">Plan Name</div>
                        <div class="fw-semibold">{{ $plan->name }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small fw-semibold">Price</div>
                        <div class="fw-semibold">
                            ${{ number_format($plan->price, 2) }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small fw-semibold">Duration</div>
                        <span class="badge bg-secondary-subtle text-secondary">
                            {{ $plan->duration_days }} days
                        </span>
                    </div>
                </div>

                {{-- Right column --}}
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="text-muted small fw-semibold">Menu Limit</div>
                        <div class="fw-semibold">
                            {{ $plan->menu_limit }}
                        </div>
                        <div class="text-muted small">
                            0 means menu creation is disabled
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small fw-semibold">Staff Limit</div>
                        <div class="fw-semibold">
                            {{ $plan->staff_limit }}
                        </div>
                        <div class="text-muted small">
                            0 means staff creation is disabled
                        </div>
                    </div>
                </div>

            </div>

            {{-- Divider --}}
            <hr class="my-4">

            {{-- Features --}}
            <div>
                <div class="text-muted small fw-semibold mb-2">
                    Features
                </div>

                @if (is_array($plan->features) && count($plan->features))
                    <ul class="mb-0">
                        @foreach ($plan->features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-muted">
                        No features defined
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection
