@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

    {{-- ================= HEADER ================= --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Dashboard</h2>
        <p class="text-muted mb-0">
            Welcome back, {{ auth()->user()->name }} 👋
            Here’s an overview of your system.
        </p>
    </div>

    {{-- ================= QUICK OVERVIEW (REAL DATA) ================= --}}
    <div class="row g-3 mb-4">

        {{-- Restaurants --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card card-lift">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-circle">
                        <i class="bi bi-shop"></i>
                    </div>
                    <div>
                        <div class="small text-muted">Restaurants</div>
                        <div class="fw-bold fs-5">
                            {{ $stats['restaurants'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card card-lift">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-circle">
                        <i class="bi bi-tags"></i>
                    </div>
                    <div>
                        <div class="small text-muted">Categories</div>
                        <div class="fw-bold fs-5">
                            {{ $stats['categories'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Users --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card card-lift">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-circle">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <div class="small text-muted">Users</div>
                        <div class="fw-bold fs-5">
                            {{ $stats['users'] ?? 0 }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Subscriptions (Admin only) --}}
        @if ($role->name === 'admin')
            <div class="col-12 col-md-6 col-xl-3">
                <div class="card card-lift">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="icon-circle">
                            <i class="bi bi-card-checklist"></i>
                        </div>
                        <div>
                            <div class="small text-muted">Subscriptions</div>
                            <div class="fw-bold fs-5">
                                {{ $stats['subscriptions'] ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    {{-- ================= MAIN MODULES ================= --}}
    <div class="row g-4">

        {{-- Restaurants --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card card-lift h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-circle-lg mb-3">
                        <i class="bi bi-shop"></i>
                    </div>
                    <h5 class="fw-semibold">Restaurants</h5>
                    <p class="text-muted small mb-2">
                        {{ $stats['restaurants'] ?? 0 }} total restaurants
                    </p>
                    <a href="{{ route('admin.restaurants.index') }}" class="btn btn-outline-warning btn-sm">
                        Open Restaurants
                    </a>
                </div>
            </div>
        </div>

        {{-- Menus (Admin only)
        @if ($role->name === 'admin')
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card card-lift h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle-lg mb-3">
                            <i class="bi bi-list"></i>
                        </div>
                        <h5 class="fw-semibold">Menus</h5>
                        <p class="text-muted small">
                            Manage restaurant menus
                        </p>
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-warning btn-sm">
                            Open Menus
                        </a>
                    </div>
                </div>
            </div>
        @endif --}}

        {{-- Categories --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card card-lift h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-circle-lg mb-3">
                        <i class="bi bi-tags"></i>
                    </div>
                    <h5 class="fw-semibold">Categories</h5>
                    <p class="text-muted small mb-2">
                        {{ $stats['categories'] ?? 0 }} categories
                    </p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-warning btn-sm">
                        Open Categories
                    </a>
                </div>
            </div>
        </div>

        {{-- Users --}}
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card card-lift h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-circle-lg mb-3">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5 class="fw-semibold">Users</h5>
                    <p class="text-muted small">
                        {{ $role->name === 'admin' ? 'Manage owners and staff' : 'Manage restaurant staff' }}
                    </p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-warning btn-sm">
                        Open Users
                    </a>
                </div>
            </div>
        </div>

        {{-- Subscriptions & Plans (Admin only) --}}
        @if ($role->name === 'admin')
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card card-lift h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle-lg mb-3">
                            <i class="bi bi-card-checklist"></i>
                        </div>
                        <h5 class="fw-semibold">Subscriptions</h5>
                        <p class="text-muted small">
                            Active plans & renewals
                        </p>
                        <a href="{{ route('admin.restaurant-subscriptions.index') }}"
                            class="btn btn-outline-warning btn-sm">
                            Open Subscriptions
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card card-lift h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle-lg mb-3">
                            <i class="bi bi-stickies"></i>
                        </div>
                        <h5 class="fw-semibold">Plans</h5>
                        <p class="text-muted small">
                            Subscription pricing plans
                        </p>
                        <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-outline-warning btn-sm">
                            Open Plans
                        </a>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
