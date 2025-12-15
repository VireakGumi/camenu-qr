@extends('admin.layout')

@section('title', 'Restaurant Subscriptions')

@section('content')

    {{-- ================= PAGE HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Restaurant Subscriptions</h3>
            <p class="text-muted mb-0">
                Manage active plans and renewals
            </p>
        </div>

        <form class="d-flex gap-2" method="get" action="{{ route('admin.restaurant-subscriptions.index') }}">
            <input name="q" class="form-control" placeholder="Search restaurant or plan" value="{{ request('q') }}">
            <button class="btn btn-outline-warning">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    {{-- Success
    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif --}}

    {{-- ================= CARD ================= --}}
    <div class="card">
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:70px;">#</th>
                            <th>Restaurant</th>
                            <th>Plan</th>
                            <th>Status</th>
                            <th>Ends At</th>
                            <th>Created</th>
                            <th class="text-end" style="width:220px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($subscriptions as $sub)
                            <tr>
                                <td class="text-muted">
                                    {{ $sub->id }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $sub->restaurant->name ?? '—' }}
                                </td>

                                <td class="text-muted">
                                    {{ $sub->plan->name ?? ($sub->subscriptionPlan->name ?? '—') }}
                                </td>

                                <td>
                                    @if ($sub->is_active)
                                        <span class="badge bg-success-subtle text-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="text-muted">
                                    {{ optional($sub->ends_at)->format('Y-m-d') ?? '—' }}
                                </td>

                                <td class="text-muted">
                                    {{ $sub->created_at->format('Y-m-d') }}
                                </td>

                                {{-- Actions --}}
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.restaurant-subscriptions.show', $sub->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.restaurant-subscriptions.edit', $sub->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.restaurant-subscriptions.toggle', $sub->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to change the status of this subscription?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-warning"
                                                title="{{ $sub->is_active ? 'Deactivate' : 'Activate' }}">
                                                {{ $sub->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>


                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    No subscriptions found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Showing {{ $subscriptions->firstItem() ?? 0 }}
                    – {{ $subscriptions->lastItem() ?? 0 }}
                    of {{ $subscriptions->total() ?? 0 }}
                </div>

                <div>
                    {{ $subscriptions->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>

@endsection
