@extends('admin.layout')

@section('title', 'Restaurant')

@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
@endphp

@section('content')
    {{-- ================= PAGE HEADER ================= --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">{{ $restaurant->name }}</h3>
        <p class="text-muted mb-0">Restaurant details & QR menu</p>
    </div>

    <div class="row g-4 mb-4">

        {{-- ================= RESTAURANT INFO ================= --}}
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
                                Active Restaurant
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
                            <i class="bi bi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST"
                            onsubmit="return confirm('Delete this restaurant?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-trash"></i> Delete
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

                    <h6 class="fw-semibold mb-3">QR Menu</h6>

                    <div class="bg-white rounded-4 p-3 mx-auto mb-3" style="box-shadow: inset 0 0 0 1px var(--border);">
                        {!! QrCode::size(180)->generate(route('public.menu.show', $restaurant->slug)) !!}
                    </div>

                    <p class="small text-muted mb-3">
                        Scan to view the restaurant menu
                    </p>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('public.menu.show', $restaurant->slug) }}" target="_blank"
                            class="btn btn-outline-warning btn-sm">
                            Open Menu
                        </a>

                        <button class="btn btn-outline-warning btn-sm" onclick="downloadPrintQR()">
                            Download QR
                        </button>

                        <button class="btn btn-outline-warning btn-sm" onclick="printQR()">
                            Print QR
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- ================= PRINT QR (OFF-SCREEN) ================= --}}
        <div id="print-area" style=" position: fixed; top: -9999px; left: -9999px; z-index: -1; ">
            <div
                style=" width: 100%; max-width: 420px; margin: 0 auto; text-align: center; font-family: 'Segoe UI', Arial, sans-serif; padding: 36px 28px; background: #ffffff; border-radius: 20px; box-shadow: 0 12px 30px rgba(0,0,0,.12); ">
                {{-- Accent --}} <div
                    style=" width: 60px; height: 5px; background: #198754; border-radius: 999px; margin: 0 auto 20px; ">
                </div> {{-- Logo --}} @if ($restaurant->logo)
                    <img src="{{ asset('storage/logos/' . $restaurant->logo) }}"
                        style="max-width:110px;margin-bottom:14px;object-fit:contain;">
                @endif {{-- Name --}} <h2
                    style="margin:0 0 6px;font-size:22px;font-weight:700;">
                    {{ $restaurant->name }} </h2>
                <p style="margin:0 0 20px;font-size:13px;color:#6c757d;"> Scan to view menu </p> {{-- QR --}}
                <div
                    style=" display:inline-block; padding:16px; background:#fff; border-radius:16px; box-shadow: inset 0 0 0 1px rgba(0,0,0,.06), 0 8px 20px rgba(0,0,0,.15); margin-bottom:18px; ">
                    {!! QrCode::format('svg')->size(240)->generate(route('public.menu.show', $restaurant->slug)) !!} </div> {{-- Address --}} <p
                    style="margin:0;font-size:12px;color:#868e96;line-height:1.5;"> {{ $restaurant->address }}
                    @if ($restaurant->phone)
                        <br>{{ $restaurant->phone }}
                    @endif
                </p> {{-- Divider --}} <div style="height:1px;background:#eee;margin:22px 0 14px;">
                </div> {{-- Branding --}} <div style="font-size:11px;color:#adb5bd;letter-spacing:.4px;"> Powered by
                    <strong style="color:#495057;">CaMenu-QR</strong>
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
                        Menu Items
                        <span class="text-muted small">#{{ $menu->id }}</span>
                    </h6>

                    <a href="{{ route('admin.menu-items.create', [
                        'menu_id' => $menu->id,
                        'restaurant_id' => $restaurant->id,
                    ]) }}"
                        class="btn btn-outline-warning btn-sm">
                        <i class="bi bi-plus"></i> Add Item
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width:70px;">ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th style="width:120px;">Price</th>
                                <th class="text-end" style="width:120px;">Actions</th>
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
                                                method="POST" onsubmit="return confirm('Delete this item?');">
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
                                        No menu items.
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
            No menus found for this restaurant.
        </div>
    @endforelse

    @push('scripts')
        {{-- REQUIRED --}}
        <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
        <script>
            function downloadPrintQR() {
                const printArea = document.getElementById('print-area');
                html2canvas(printArea, {
                    backgroundColor: '#ffffff',
                    scale: 2,
                    useCORS: true
                }).then(canvas => {
                    const link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = '{{ Str::slug($restaurant->name) }}-table-qr.png';
                    link.click();
                });
            }

            function printQR() {
                const content = document.getElementById('print-area').innerHTML;
                const win = window.open('', '', 'width=800,height=1000');
                win.document.write(
                    `<html><head><title>Print QR</title><style> body { margin:0; font-family:Arial,sans-serif; } </style></head><body>${content}</body></html>`
                );
                win.document.close();
                win.focus();
                win.print();
                win.close();
            }
        </script>
    @endpush
@endsection
