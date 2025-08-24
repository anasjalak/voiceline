<x-app-layout>
    {{-- الهيدر مع اسم المستخدم + بروفايل + تسجيل الخروج --}}
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h2 class="m-0 heading-hero">{{ __('Dashboard') }}</h2>

            <div class="d-flex align-items-center gap-3">
                <span class="fw-semibold" style="color:#6C3A30;">
                    👋 {{ Auth::user()->name }}
                </span>

                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-brand">
                    <i class="bi bi-person-circle me-1"></i> Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-brand">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    {{-- الخلفية بنفس طابع صفحة الدخول --}}
    <div class="brand-canvas">
        <img class="corner-bottom-left" src="{{ asset('assets/bottomleft.svg') }}" alt="" draggable="false">
        <img class="corner-top-right"  src="{{ asset('assets/topright.svg')  }}" alt="" draggable="false">

        
    </div>

    {{-- ستايلات وأدوات بسيطة (يمكن نقلها لملف CSS لاحقاً) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root{
            --brand-brown: #6C3A30;
            --brand-gold:  #B77848;
            --bg-50:       #faf8f6;
            --white:       #ffffff;
            --shadow-soft: 0 10px 30px rgba(0,0,0,.08);
            --radius-2xl:  1.25rem;
        }
        .heading-hero{ color: var(--brand-brown); font-weight: 700; }
        .btn-brand{
            background: var(--brand-brown); color:#fff; border:none; border-radius:.7rem; padding:.45rem .8rem;
            box-shadow: var(--shadow-soft);
        }
        .btn-outline-brand{
            color: var(--brand-brown); border-color: var(--brand-brown); border-radius:.7rem; padding:.45rem .8rem;
        }
        .btn-outline-brand:hover{ background: var(--brand-brown); color:#fff; }
        .brand-canvas{
            position: relative; min-height: 100%;
            background:
                radial-gradient(1200px 600px at 110% -10%, rgba(183,120,72,.08), transparent 60%),
                radial-gradient(900px 500px at -10% 110%, rgba(108,58,48,.08), transparent 55%),
                linear-gradient(180deg, #fff, #fff0);
            overflow: hidden; padding-bottom: 50px;
        }
        .corner-bottom-left, .corner-top-right{
            position:absolute; pointer-events:none; user-select:none; opacity:.8; z-index:0; width:220px;
        }
        .corner-bottom-left{ bottom:-10px; left:-10px; }
        .corner-top-right { top:-10px;   right:-10px; }
        .paper{
            background: var(--white); border:1px solid rgba(0,0,0,.06); border-radius:var(--radius-2xl);
            box-shadow: var(--shadow-soft); position:relative; z-index:1;
        }
        .content-wrap{ position: relative; z-index: 1; }
    </style>
</x-app-layout>
