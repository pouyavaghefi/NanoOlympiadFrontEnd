@extends('layouts.master')

@section('title','Sample Questions')

@section('style')
<style>
    .btn:hover {
        transform: translateY(-2px);
        transition: transform 0.2s ease;
    }

    .btn i {
        transition: transform 0.2s ease;
    }

    .btn:hover i {
        transform: translateX(4px);
    }

    h2 {
        font-size: 2rem;
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 1.5rem;
        }
    }

    .download-buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        animation: fadeInUp 1s ease-in-out;
    }

    .download-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        padding: 12px 24px;
        font-size: 18px;
        font-weight: bold;
        background: linear-gradient(135deg, #00c6ff, #0072ff);
        color: #fff;
        border: none;
        border-radius: 50px;
        box-shadow: 0 8px 20px rgba(0, 114, 255, 0.3);
        cursor: pointer;
        transition: all 0.4s ease;
        overflow: hidden;
        text-transform: uppercase;
        gap: 12px;
    }

    .download-btn:hover {
        background: linear-gradient(135deg, #0072ff, #00c6ff);
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 114, 255, 0.5);
    }

    .download-btn .btn-icon {
        transition: transform 0.4s ease-in-out;
    }

    .download-btn:hover .btn-icon {
        transform: translateX(8px);
    }

    .download-btn.alt {
        background: linear-gradient(135deg, #f7971e, #ffd200);
        color: #333;
        box-shadow: 0 8px 20px rgba(255, 210, 0, 0.3);
    }

    .download-btn.alt:hover {
        background: linear-gradient(135deg, #ffd200, #f7971e);
        box-shadow: 0 12px 30px rgba(255, 210, 0, 0.5);
    }

    .full-screen-btn {
        background: linear-gradient(45deg, #ff6a00, #ff6347);
        color: white;
        font-weight: bold;
        padding: 12px 20px;
        border-radius: 30px;
        border: none;
        font-size: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .full-screen-btn:hover {
        background: linear-gradient(45deg, #ff6347, #ff6a00);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    }

    .fullscreen-icon {
        animation: flipIcon 2s ease-in-out infinite;
        transform-style: preserve-3d;
    }

    @keyframes flipIcon {
        0% { transform: rotateX(0deg); }
        50% { transform: rotateX(180deg); }
        100% { transform: rotateX(360deg); }
    }

    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('scripts')
<script>
    document.getElementById('copyUrlBtn')?.addEventListener('click', function() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            this.textContent = 'Copied! ✅';
            setTimeout(() => this.textContent = 'Copy URL', 2000);
        });
    });

    document.getElementById('bookmarkBtn')?.addEventListener('click', function () {
        alert('Press Ctrl+D (Windows) or Cmd+D (Mac) to bookmark this page.');
    });

    document.getElementById('printBtn')?.addEventListener('click', function () {
        window.print();
    });

    document.getElementById('fullScreenBtn')?.addEventListener('click', function () {
        const el = document.documentElement;
        if (!document.fullscreenElement) {
            el.requestFullscreen?.() || el.webkitRequestFullscreen?.() || el.msRequestFullscreen?.();
        } else {
            document.exitFullscreen?.() || document.webkitExitFullscreen?.() || document.msExitFullscreen?.();
        }
    });

    function saveToGoogleDrive() {
        alert("Google Drive integration is not active in this context.");
        // You can reuse the full Google OAuth + upload logic from the 'Booklets' page if needed
    }
</script>
@endsection


@section('wrapper')
<div class="container my-5 text-center">
    <h2 class="fw-bold mb-3">📘 Download Our Sample Questions</h2><br>

    <div class="d-flex justify-content-center flex-wrap gap-3">
        {{-- Download PDF Button --}}
        <a href="{{ asset('dl/sampleq2.pdf') }}" download class="btn btn-lg btn-primary px-4 py-2 d-flex align-items-center gap-2 shadow">
            <i class="bi bi-download fs-5"></i> Download PDF
        </a>

        {{-- Save to Drive Button --}}
        <button class="btn btn-lg btn-warning px-4 py-2 d-flex align-items-center gap-2 shadow" onclick="saveToGoogleDrive()">
            <i class="bi bi-cloud-arrow-up fs-5"></i> Save to Drive
        </button>
    </div>

    {{-- Sharing and Utility Actions --}}
    <div class="d-flex justify-content-center mt-4 gap-3 flex-wrap">
        <a href="{{ asset('dl/sampleq2.pdf') }}" id="sharePdfLink" class="btn btn-outline-primary" target="_blank" rel="noopener noreferrer">
            Share PDF Link
        </a>
        <button id="copyUrlBtn" class="btn btn-outline-secondary">Copy URL</button>
        <button id="bookmarkBtn" class="btn btn-outline-success">Bookmark Page</button>
        <button id="printBtn" class="btn btn-outline-info">Print Page</button>
    </div>

    @php $locale = app()->getLocale(); @endphp

    @if(request()->ip() !== '84.241.11.116')
    <div class="row mt-5">
        <div class="col-12 text-center">
            <a target="_blank" href="{{ route('frt.crs.bookshelf') }}" class="btn btn-digital-library">
                <i class="fas fa-book-open"></i>
                {{ $locale === 'ar' ? 'دخول المكتبة الرقمية' : 'Enter Digital Library' }}
            </a>
        </div>
    </div>
    @endif

    <style>
        .btn-digital-library {
            background: linear-gradient(135deg, #3a7bd5, #00d2ff);
            border: none;
            border-radius: 50px;
            padding: 15px 40px;
            font-size: 1.25rem;
            font-weight: 600;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-digital-library:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .btn-digital-library:active {
            transform: translateY(1px);
        }

        .btn-digital-library i {
            margin-right: 8px;
        }
    </style>
</div>
@endsection

