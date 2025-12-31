@extends('admin.layout')

@section('title', __('ui.shops'))

@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

@section('content')
    {{-- ================= PAGE HEADER ================= --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">{{ $restaurant->name }}</h3>
        <p class="text-muted mb-0">{{ __('ui.shop_details_qr') }}</p>
    </div>

    <div class="row g-4 mb-4">

        {{-- ================= SHOP INFO ================= --}}
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body p-4">

                    {{-- Header --}}
                    <div class="d-flex align-items-center gap-3 mb-4">
                        @if ($restaurant->logo)
                            <img src="{{ asset('storage/logos/' . $restaurant->logo) }}" class="rounded-circle border"
                                style="width:80px;height:80px;object-fit:cover;">
                        @endif

                        <div>
                            <h5 class="fw-semibold mb-1">{{ $restaurant->name }}</h5>
                            <span class="badge bg-success-subtle text-success">
                                {{ __('ui.active_shop') }}
                            </span>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="mb-4">
                        <div class="d-flex gap-2 mb-2">
                            <i class="bi bi-geo-alt text-muted"></i>
                            <div class="small text-muted">
                                {{ $restaurant->address ?? '—' }}
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <i class="bi bi-telephone text-muted"></i>
                            <div class="small text-muted">
                                {{ $restaurant->phone ?? '—' }}
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Actions --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}"
                            class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil"></i> {{ __('ui.edit') }}
                        </a>

                        <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST"
                            onsubmit="return confirm('{{ __('ui.delete_shop_confirm') }}');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-trash"></i> {{ __('ui.delete') }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        {{-- ================= QR MENU ================= --}}
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-body text-center p-4 d-flex flex-column justify-content-center">

                    <h6 class="fw-semibold mb-3">{{ __('ui.qr_menu') }}</h6>

                    <div class="bg-white rounded-4 p-3 mx-auto mb-3" style="box-shadow: inset 0 0 0 1px var(--border);">
                        {!! QrCode::size(180)->generate(route('public.menu.show', $restaurant->slug)) !!}
                    </div>

                    <p class="small text-muted mb-3">
                        {{ __('ui.scan_view_menu') }}
                    </p>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('public.menu.show', $restaurant->slug) }}" target="_blank"
                            class="btn btn-outline-warning btn-sm">
                            {{ __('ui.open_menu') }}
                        </a>

                        <button class="btn btn-outline-warning btn-sm" onclick="downloadPrintQR()">
                            {{ __('ui.download_qr') }}
                        </button>

                        <button class="btn btn-outline-warning btn-sm" onclick="printQR()">
                            {{ __('ui.print_qr') }}
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- ================= MENUS & ITEMS ================= --}}
    @forelse($restaurant->menus as $menu)
        <div class="card mb-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold mb-0">
                        {{ __('ui.menu_items') }}
                        <span class="text-muted small">#{{ $menu->id }}</span>
                    </h6>

                    <a href="{{ route('admin.menu-items.create', [
                        'menu_id' => $menu->id,
                        'restaurant_id' => $restaurant->id,
                    ]) }}"
                        class="btn btn-outline-warning btn-sm">
                        <i class="bi bi-plus"></i> {{ __('ui.add_item') }}
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width:70px;">ID</th>
                                <th>{{ __('ui.name') }}</th>
                                <th>{{ __('ui.categories') }}</th>
                                <th style="width:120px;">{{ __('ui.price') }}</th>
                                <th class="text-end" style="width:120px;">{{ __('ui.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menu->menuItems as $item)
                                <tr>
                                    <td class="text-muted">{{ $item->id }}</td>
                                    <td class="fw-semibold">{{ $item->name }}</td>
                                    <td class="text-muted">{{ $item->category->name ?? '—' }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('admin.menu-items.edit', $item->id) }}"
                                                class="btn btn-outline-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.menu-items.destroy', $item->id) }}"
                                                method="POST" onsubmit="return confirm('{{ __('ui.delete') }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-warning btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        {{ __('ui.no_menu_items') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @empty
        <div class="alert alert-info">
            {{ __('ui.no_menus_found') }}
        </div>
    @endforelse
@endsection
