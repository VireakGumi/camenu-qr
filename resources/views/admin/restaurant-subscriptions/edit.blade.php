@extends('admin.layout')

@section('title', 'Extend Subscription')

@section('content')

    {{-- ================= PAGE HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                Extend Subscription #{{ $subscription->id }}
            </h3>
            <p class="text-muted mb-0">
                Extend subscription based on selected plan duration
            </p>
        </div>

        <a href="{{ route('admin.restaurant-subscriptions.show', $subscription->id) }}"
            class="btn btn-outline-warning btn-sm">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    {{-- ================= ERRORS ================= --}}
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

            <form method="POST" action="{{ route('admin.restaurant-subscriptions.update', $subscription->id) }}"
                onsubmit="return confirm('Confirm payment received and extend this subscription?');">
                @csrf
                @method('PATCH')

                {{-- Restaurant --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Restaurant
                    </label>
                    <input class="form-control" value="{{ $subscription->restaurant->name ?? '—' }}" disabled>
                </div>

                {{-- Current Plan --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Current Plan
                    </label>
                    <input class="form-control"
                        value="{{ $subscription->plan->name ?? ($subscription->subscriptionPlan->name ?? '—') }}" disabled>
                </div>

                {{-- Current End Date --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Current Expiration Date
                    </label>
                    <input class="form-control" value="{{ optional($subscription->ends_at)->format('Y-m-d') ?? '—' }}"
                        disabled>
                </div>

                {{-- Divider --}}
                <hr class="my-4">

                {{-- Select New Plan --}}
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Select Plan to Extend <span class="text-danger">*</span>
                    </label>
                    <select name="subscription_plan_id" class="form-select" required>
                        <option value="">— Select Plan —</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}"
                                {{ $subscription->subscription_plan_id == $plan->id ? 'selected' : '' }}>
                                {{ $plan->name }}
                                @if (isset($plan->duration_days))
                                    ({{ $plan->duration_days }} days)
                                @endif
                            </option>
                        @endforeach
                    </select>

                    <div class="form-text">
                        Subscription end date will be extended automatically based on plan duration.
                    </div>
                </div>

                {{-- Divider --}}
                <hr class="my-4">

                {{-- Actions --}}
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Subscription ID #{{ $subscription->id }}
                    </div>

                    <button class="btn btn-outline-warning px-4">
                        <i class="bi bi-arrow-repeat"></i> Extend Subscription
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
