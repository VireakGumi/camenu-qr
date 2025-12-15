<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CaMenu-QR — Built for Modern Restaurants</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description"
        content="A modern QR menu system that helps restaurants move faster, look professional, and sell smarter.">

    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-soft: #f1f5f9;
            --bg-dark: #0f172a;
            --primary: #8b5e3c;
            --accent: #d6a56a;
            --text-dark: #020617;
            --text-muted: #64748b;
            --radius: 24px;
        }

        body {
            background: var(--bg-main);
            font-family: Inter, system-ui, sans-serif;
            color: var(--text-dark);
        }

        section {
            padding: 120px 0;
        }

        h1,
        h2 {
            font-weight: 900;
            letter-spacing: -0.8px;
        }

        h1 {
            font-size: 3.6rem;
            line-height: 1.05;
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* NAV */
        .navbar {
            backdrop-filter: blur(12px);
        }

        /* BUTTON */
        .btn-main {
            background: linear-gradient(135deg, var(--primary), #6f4427);
            color: #fff;
            padding: 14px 40px;
            border-radius: 999px;
            font-weight: 600;
            border: none;
            box-shadow: 0 20px 50px rgba(139, 94, 60, .35);
            transition: .25s;
        }

        .btn-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 30px 80px rgba(139, 94, 60, .45);
        }

        /* HERO */
        .hero {
            background:
                radial-gradient(circle at right, rgba(214, 165, 106, .25), transparent 55%),
                linear-gradient(180deg, #fff, var(--bg-main));
        }

        .hero p {
            color: var(--text-muted);
            font-size: 1.15rem;
            max-width: 560px;
        }

        /* STORY BLOCK */
        .story-box {
            background: #fff;
            padding: 56px;
            border-radius: var(--radius);
            box-shadow: 0 25px 70px rgba(0, 0, 0, .08);
        }

        /* FLOW */
        .flow-step {
            background: #fff;
            padding: 44px;
            border-radius: var(--radius);
            height: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .08);
        }

        .flow-step span {
            font-size: 2.6rem;
            font-weight: 900;
            color: var(--primary);
        }

        /* DARK SECTION */
        .section-dark {
            background: linear-gradient(135deg, var(--bg-dark), #1e293b);
            color: #fff;
        }

        .section-dark p {
            color: #cbd5e1;
        }

        /* PRICING */
        .price-card {
            background: #fff;
            border-radius: 40px;
            padding: 64px;
            box-shadow: 0 40px 120px rgba(0, 0, 0, .15);
            height: 100%;
            transition: .3s;
        }

        .price-card.active {
            border: 4px solid var(--primary);
            transform: scale(1.05);
        }

        .price {
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary);
        }

        /* CTA */
        .cta {
            background: linear-gradient(135deg, var(--primary), #6f4427);
            color: #fff;
            border-radius: 70px;
            padding: 140px 40px;
            text-align: center;
        }

        footer {
            padding: 50px 0;
            text-align: center;
            color: var(--text-muted);
        }
    </style>
</head>

<body>

    {{-- NAV --}}
    <nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
        <div class="container">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-3 text-decoration-none">
                <img src="{{ asset('img/logo.png') }}" width="65" class="rounded-circle brand-logo" alt="CaMenu QR">
            </a>
            <button class="btn-main" data-bs-toggle="modal" data-bs-target="#registerModal">
                Get Started
            </button>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <small class="text-muted">Built for restaurants, not tech people</small>
                    <h1 class="mt-3">
                        Your Menu.<br>
                        <span class="gradient-text">Faster. Smarter. Digital.</span>
                    </h1>
                    <p class="mt-4">
                        CaMenu-QR replaces paper menus with a fast, modern QR experience
                        that customers love and owners control.
                    </p>

                    <div class="mt-4">
                        <button class="btn-main" data-bs-toggle="modal" data-bs-target="#registerModal">
                            Start My Digital Menu
                        </button>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="story-box">
                        ❌ Printing menus again and again
                        <br><br>
                        ❌ Prices changing but menus outdated
                        <br><br>
                        ✅ One QR. One dashboard. Always updated.
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FLOW --}}
    <section>
        <div class="container text-center">
            <h2>How Restaurants Win with CaMenu-QR</h2>
            <p class="text-muted mb-5">Simple process. Real impact.</p>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="flow-step">
                        <span>1</span>
                        <h5 class="mt-3">Create Menu</h5>
                        <p>Add items, prices & categories in minutes.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="flow-step">
                        <span>2</span>
                        <h5 class="mt-3">Place QR</h5>
                        <p>On tables, counters, or takeaway bags.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="flow-step">
                        <span>3</span>
                        <h5 class="mt-3">Sell Faster</h5>
                        <p>Customers decide quicker. Staff works less.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TRUST --}}
    <section class="section-dark">
        <div class="container text-center">
            <h2>Trusted by Growing Restaurants</h2>
            <p class="mb-5">
                Built to scale with your business — from one outlet to many.
            </p>

            <div class="row g-4">
                <div class="col-md-4">
                    <h2 class="gradient-text">100+</h2>
                    Restaurants Ready
                </div>
                <div class="col-md-4">
                    <h2 class="gradient-text">0$</h2>
                    Printing Cost
                </div>
                <div class="col-md-4">
                    <h2 class="gradient-text">24/7</h2>
                    Menu Access
                </div>
            </div>
        </div>
    </section>

    {{-- PRICING --}}
    <section id="pricing">
        <div class="container text-center">
            <h2>Choose Your Growth Plan</h2>
            <p class="text-muted mb-5">Upgrade anytime. Cancel anytime.</p>

            <div class="row g-4 justify-content-center">
                @foreach ($plans as $plan)
                    <div class="col-md-4">
                        <div class="price-card {{ $loop->iteration === 2 ? 'active' : '' }}">
                            <h5>{{ $plan->name }}</h5>
                            <div class="price">${{ number_format($plan->price, 2) }}</div>
                            <p class="text-muted">{{ $plan->duration_days }} days</p>

                            <ul class="text-start mt-4">
                                @foreach ($plan->features as $f)
                                    <li>✔ {{ $f }}</li>
                                @endforeach
                            </ul>

                            <button class="btn-main w-100 mt-4" data-bs-toggle="modal" data-bs-target="#registerModal"
                                data-plan="{{ $plan->id }}">
                                Start with {{ $plan->name }}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FINAL CTA --}}
    <section>
        <div class="container">
            <div class="cta">
                <h2>Your Menu Is the First Impression</h2>
                <p>Make it modern. Make it fast. Make it digital.</p>
                <button class="btn btn-light btn-lg mt-4" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Create My Menu Now
                </button>
            </div>
        </div>
    </section>

    {{-- SOCIAL MEDIA / CAMBODIA FOCUS --}}
    <section style="background: var(--bg-soft);">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <small class="text-muted">🇰🇭 Built for Phnom Penh Restaurants</small>

                    <h2 class="mt-3">
                        Built for<br>
                        <span class="gradient-text">Social Media Marketing</span>
                    </h2>

                    <p class="text-muted mt-4">
                        In Cambodia, customers find restaurants through
                        Facebook, Instagram, TikTok, and direct messages.
                        CaMenu-QR is designed to work perfectly with
                        the platforms Phnom Penh restaurants already use.
                    </p>

                    <p class="text-muted">
                        One menu link. Share it everywhere.
                    </p>
                </div>

                <div class="col-lg-6">
                    <div class="story-box">
                        <strong>Share your menu on:</strong>
                        <hr>

                        <a href="https://www.facebook.com/" target="_blank"
                            class="d-flex align-items-center gap-3 mb-3 text-decoration-none text-dark">
                            <i class="bi bi-facebook fs-3 text-primary"></i>
                            <span>Facebook Pages & Groups</span>
                        </a>

                        <a href="https://www.instagram.com/" target="_blank"
                            class="d-flex align-items-center gap-3 mb-3 text-decoration-none text-dark">
                            <i class="bi bi-instagram fs-3 text-danger"></i>
                            <span>Instagram Bio & Stories</span>
                        </a>

                        <a href="https://www.tiktok.com/" target="_blank"
                            class="d-flex align-items-center gap-3 mb-3 text-decoration-none text-dark">
                            <i class="bi bi-tiktok fs-3"></i>
                            <span>TikTok Profile & Videos</span>
                        </a>

                        <a href="mailto:info@camenuqr.com"
                            class="d-flex align-items-center gap-3 text-decoration-none text-dark">
                            <i class="bi bi-envelope fs-3 text-secondary"></i>
                            <span>Email (Gmail, business inquiries)</span>
                        </a>

                        <hr>
                        <small class="text-muted">
                            Customers open instantly — no app, no download.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        © {{ date('Y') }} CaMenu-QR
    </footer>

    {{-- REGISTER MODAL (unchanged logic) --}}
    <div class="modal fade" id="registerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 rounded-4">
                <form method="POST">
                    @csrf
                    <h5>Create Account</h5>
                    <select class="form-select mt-3" id="planSelect" name="subscription_plan_id">
                        <option value="">Select plan</option>
                        @foreach ($plans as $plan)
                            <option value="{{ $plan->id }}" data-price="{{ number_format($plan->price, 2) }}">
                                {{ $plan->name }} — ${{ number_format($plan->price, 2) }}
                            </option>
                        @endforeach
                    </select>

                    <input id="planPrice" class="form-control mt-3" readonly>

                    <input class="form-control mt-3" name="restaurant_name" placeholder="Restaurant Name">
                    <input class="form-control mt-3" type="name" name="name" placeholder="Name">
                    <input class="form-control mt-3" name="email" placeholder="Email">

                    <button class="btn-main w-100 mt-4">Continue</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modal = document.getElementById('registerModal');
        const planSelect = document.getElementById('planSelect');
        const planPrice = document.getElementById('planPrice');
        const form = modal.querySelector('form');

        document.querySelectorAll('[data-plan]').forEach(btn => {
            btn.onclick = () => {
                planSelect.value = btn.dataset.plan;
                planSelect.dispatchEvent(new Event('change'));
            };
        });

        planSelect.onchange = () => {
            const price = planSelect.selectedOptions[0]?.dataset.price;
            planPrice.value = price ? '$' + price : '';
        };

        modal.addEventListener('hidden.bs.modal', () => {
            form.reset();
            planPrice.value = '';
        });
    </script>

</body>

</html>
