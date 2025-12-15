@extends('admin.layout')

@section('title', 'Subscription Plans')

@section('content')

    {{-- ================= PAGE HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Subscription Plans</h3>
            <p class="text-muted mb-0">
                Manage pricing plans and feature limits for restaurants
            </p>
        </div>

        <a href="{{ route('admin.subscription-plans.create') }}" class="btn btn-outline-warning">
            <i class="bi bi-plus-circle"></i> Create Plan
        </a>
    </div>

    {{-- Success --}}
    @if (session('success'))
        <div class="alert alert-success shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ================= CARD ================= --}}
    <div class="card">
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Menu Limit</th>
                            <th>Staff Limit</th>
                            <th class="text-end" style="width:200px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($plans as $plan)
                            <tr>

                                <td class="text-muted">
                                    {{ $plan->id }}
                                </td>

                                {{-- Plan --}}
                                <td>
                                    <div class="fw-semibold">{{ $plan->name }}</div>
                                    <div class="small text-muted">
                                        {{ $plan->duration_days ? $plan->duration_days . ' days validity' : 'No expiration' }}
                                    </div>
                                </td>

                                {{-- Price --}}
                                <td class="fw-semibold">
                                    ${{ number_format($plan->price, 2) }}
                                </td>

                                {{-- Duration --}}
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary">
                                        {{ $plan->duration_days }} days
                                    </span>
                                </td>

                                {{-- Menu limit --}}
                                <td>
                                    <span class="badge bg-primary-subtle text-primary">
                                        {{ $plan->menu_limit }}
                                    </span>

                                </td>

                                {{-- Staff limit --}}
                                <td>
                                    <span class="badge bg-info-subtle text-info">
                                        {{ $plan->staff_limit }}
                                    </span>

                                </td>

                                {{-- Actions --}}
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.subscription-plans.show', $plan->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.subscription-plans.edit', $plan->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.subscription-plans.destroy', $plan->id) }}"
                                            method="POST" onsubmit="return confirm('Delete this plan?');">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-outline-warning btn-delete" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    No subscription plans found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Showing {{ $plans->firstItem() ?? 0 }}
                    – {{ $plans->lastItem() ?? 0 }}
                    of {{ $plans->total() ?? 0 }}
                </div>

                <div>
                    {{ $plans->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>

@endsection
