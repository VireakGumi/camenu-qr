@extends('admin.layout')

@section('title', 'Edit Restaurant')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- ================= PAGE HEADER ================= --}}
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Edit Restaurant</h3>
                <p class="text-muted mb-0">
                    Update restaurant information and branding
                </p>
            </div>
            {{-- ================= CARD ================= --}}
            <div class="card">
                <div class="card-body p-4 p-lg-5">

                    <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Restaurant Name --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Restaurant Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $restaurant->name) }}" required>
                        </div>

                        {{-- Address --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Address
                            </label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Street, city, country">{{ old('address', $restaurant->address) }}</textarea>
                        </div>

                        {{-- Phone --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Phone Number
                            </label>
                            <input type="text" name="phone" class="form-control" placeholder="e.g. +855 12 345 678"
                                value="{{ old('phone', $restaurant->phone) }}">
                        </div>

                        {{-- Current Logo --}}
                        @if ($restaurant->logo)
                            <div class="mb-4">
                                <label class="form-label fw-semibold d-block">
                                    Current Logo
                                </label>

                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ asset('storage/logos/' . $restaurant->logo) }}"
                                        class="rounded-circle border" style="width:96px;height:96px;object-fit:cover;">

                                    <div class="small text-muted">
                                        This logo is currently used on the public menu and QR code
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Change Logo --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Change Logo
                            </label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                            <div class="form-text">
                                Optional • JPG / PNG • Max 2MB • Leave empty to keep current logo
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-outline-warning">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>

                            <button class="btn btn-outline-warning px-4">
                                <i class="bi bi-save"></i> Save Changes
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
