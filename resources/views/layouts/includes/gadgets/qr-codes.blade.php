<style>
    /* Replace the existing qrboard-container styles with these: */
    .qrboard-container {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: calc(100vh - 200px); /* Ensure it takes enough height */
    }

    /* FIX: Allow full scrolling inside the modal without breaking layout */
    .qr-modal {
        overflow-y: auto !important;
        -webkit-overflow-scrolling: touch !important;
        padding: 40px 0;
    }

    /* FIX: Prevent inner modal from growing outside horizontally */
    .qr-modal-content {
        max-height: none;
        width: 92%;
        margin: auto;
    }

    .close-modal {
        position: sticky;
        top: 20px;
        right: 20px;
        margin-left: auto;
        z-index: 20;
    }


    /* Add this to ensure the grid container has enough space */
    .qrboard-grid {
        min-height: 600px; /* Ensure grid has minimum height */
        position: relative;
    }

    /* Update the qrboard-reveal-wrapper to handle proper scrolling */
    .qrboard-reveal-wrapper {
        max-height: 0;
        overflow: hidden; /* CHANGED from visible to hidden */
        transition: max-height 1.2s cubic-bezier(0.87, 0, 0.13, 1);
    }

    .qrboard-reveal-wrapper.revealed {
        max-height: 5000px; /* CHANGED from none to 5000px */
        overflow: visible;
        padding-bottom: 50px;
    }

    .qrboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .qrboard-title {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .qrboard-title h2 {
        margin: 0;
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        font-size: 32px;
        font-weight: 800;
    }

    .qrboard-subtitle {
        margin: 0;
        color: #666;
        font-size: 16px;
        font-weight: 500;
    }

    .qrboard-title-icon {
        color: #3498db;
        font-size: 28px;
        margin-bottom: 8px;
    }

    .qrboard-print-btn {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(44, 62, 80, 0.3);
    }

    .qrboard-print-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(44, 62, 80, 0.4);
    }

    .qrboard-print-btn:active {
        transform: translateY(-1px);
    }

    .qrboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 30px;
    }

    .qrboard-item {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease, transform 0.6s ease, box-shadow 0.3s ease;
    }

    .qrboard-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .qrboard-item.fade-in:nth-child(1) { transition-delay: 0.1s; }
    .qrboard-item.fade-in:nth-child(2) { transition-delay: 0.2s; }
    .qrboard-item.fade-in:nth-child(3) { transition-delay: 0.3s; }
    .qrboard-item.fade-in:nth-child(4) { transition-delay: 0.4s; }
    .qrboard-item.fade-in:nth-child(5) { transition-delay: 0.5s; }
    .qrboard-item.fade-in:nth-child(6) { transition-delay: 0.6s; }
    .qrboard-item.fade-in:nth-child(7) { transition-delay: 0.7s; }
    .qrboard-item.fade-in:nth-child(8) { transition-delay: 0.8s; }
    .qrboard-item.fade-in:nth-child(9) { transition-delay: 0.9s; }
    .qrboard-item.fade-in:nth-child(10) { transition-delay: 1.0s; }
    .qrboard-item.fade-in:nth-child(11) { transition-delay: 1.1s; }
    .qrboard-item.fade-in:nth-child(12) { transition-delay: 1.2s; }
    .qrboard-item.fade-in:nth-child(13) { transition-delay: 1.3s; }
    .qrboard-item.fade-in:nth-child(14) { transition-delay: 1.4s; }
    .qrboard-item.fade-in:nth-child(15) { transition-delay: 1.5s; }
    .qrboard-item.fade-in:nth-child(16) { transition-delay: 1.6s; }
    .qrboard-item.fade-in:nth-child(17) { transition-delay: 1.7s; }
    .qrboard-item.fade-in:nth-child(18) { transition-delay: 1.8s; }
    .qrboard-item.fade-in:nth-child(19) { transition-delay: 1.9s; }
    .qrboard-item.fade-in:nth-child(20) { transition-delay: 2.0s; }
    .qrboard-item.fade-in:nth-child(21) { transition-delay: 2.1s; }

    .qrboard-item:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        border-color: #3498db;
    }

    .qrboard-item:active {
        transform: translateY(-5px) scale(1.01);
    }

    .qrboard-country-flag {
        font-size: 40px;
        margin-bottom: 15px;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
    }

    .qrboard-img-container {
        width: 100%;
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        background: white;
        border-radius: 12px;
        padding: 15px;
        position: relative;
        border: 1px solid #f0f0f0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .qrboard-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        max-width: 100%;
        max-height: 100%;
        display: block;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
    }

    .qrboard-color-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        z-index: 2;
    }

    .qrboard-country-name {
        font-size: 16px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
        line-height: 1.4;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .qrboard-name {
        font-size: 18px;
        font-weight: 600;
        color: #3498db;
        line-height: 1.4;
        margin-top: 5px;
    }

    /* Print-specific styles for QR codes only */
    @media print {
        /* Hide everything except QR codes and basic info */
        body * {
            visibility: hidden;
        }

        .qrboard-container,
        .qrboard-container * {
            visibility: visible;
        }

        .qrboard-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 0;
            margin: 0;
            background: white !important;
        }

        /* Hide header in print */
        .qrboard-header {
            display: none !important;
        }

        /* Optimize QR grid for printing */
        .qrboard-grid {
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 15px !important;
            padding: 20px !important;
        }

        .qrboard-item {
            break-inside: avoid;
            page-break-inside: avoid;
            border: 2px solid #000 !important;
            box-shadow: none !important;
            padding: 15px !important;
            transform: none !important;
            margin: 0 !important;
            opacity: 1 !important;
        }

        .qrboard-item:hover {
            transform: none !important;
            border-color: #000 !important;
        }

        /* Convert colorful QR codes to black and white */
        .qrboard-img-container {
            border: 1px solid #ccc !important;
            box-shadow: none !important;
            padding: 10px !important;
        }

        .qrboard-img {
            filter: grayscale(100%) contrast(150%) !important;
        }

        .qrboard-country-flag {
            font-size: 24px !important;
            margin-bottom: 5px !important;
        }

        .qrboard-country-name {
            font-size: 12px !important;
            font-weight: bold !important;
            color: black !important;
        }

        .qrboard-name {
            font-size: 14px !important;
            font-weight: bold !important;
            color: black !important;
        }

        .qrboard-color-badge {
            display: none !important;
        }

        /* Hide modal in print */
        .qr-modal {
            display: none !important;
        }
    }

    .qr-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        backdrop-filter: blur(10px);
        z-index: 10000;
        align-items: center;
        justify-content: center;
        animation: qrboard-fadeIn 0.4s ease;
        overflow-y: auto; /* Make modal scrollable */
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
    }

    .qr-modal.active {
        display: flex;
    }

    .qr-modal-content {
        background: white;
        border-radius: 20px;
        width: 90%;
        max-width: 800px;
        position: relative;
        animation: qrboard-slideUp 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
        overflow: hidden;
    }

    .close-modal {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        background: #e74c3c;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all 0.3s ease;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
    }

    .close-modal:hover {
        background: #c0392b;
        transform: rotate(90deg) scale(1.1);
    }

    .modal-header {
        padding: 40px 40px 20px;
        text-align: center;
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: white;
    }

    .modal-title {
        margin: 0 0 5px 0;
        font-size: 32px;
        font-weight: 800;
        color: white;
    }

    .modal-subtitle {
        margin: 0;
        opacity: 0.9;
        font-size: 16px;
    }

    .modal-body {
        padding: 40px;
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
    }

    .modal-qr-container {
        flex: 1;
        min-width: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .modal-qr-wrapper {
        width: 100%;
        max-width: 350px;
        height: 350px;
        background: white;
        border-radius: 15px;
        padding: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        border: 3px solid #3498db;
        box-shadow: 0 15px 35px rgba(52, 152, 219, 0.3);
    }

    .modal-qr-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .scan-instructions {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        border-left: 4px solid #3498db;
        width: 100%;
        max-width: 350px;
    }

    .scan-instructions h5 {
        margin: 0 0 10px 0;
        color: #2c3e50;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .scan-instructions p {
        margin: 0;
        color: #555;
        font-size: 14px;
        line-height: 1.5;
    }

    .modal-info {
        flex: 1;
        min-width: 300px;
    }

    .modal-info h4 {
        color: #3498db;
        margin-bottom: 15px;
        font-size: 20px;
        font-weight: 700;
    }

    .modal-info p {
        color: #555;
        margin-bottom: 20px;
        line-height: 1.6;
        font-size: 15px;
    }

    .modal-features {
        list-style: none;
        padding: 0;
        margin-bottom: 30px;
    }

    .modal-features li {
        color: #555;
        margin-bottom: 10px;
        padding-left: 25px;
        position: relative;
        font-size: 15px;
    }

    .modal-features li:before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #2ecc71;
        font-weight: bold;
        font-size: 16px;
    }

    .modal-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .modal-btn {
        flex: 1;
        min-width: 150px;
        padding: 12px 20px;
        border-radius: 8px;
        border: none;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .modal-btn-primary {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
    }

    .modal-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.4);
    }

    .modal-btn-secondary {
        background: white;
        color: #3498db;
        border: 2px solid #3498db;
    }

    .modal-btn-secondary:hover {
        background: #f8f9fa;
        transform: translateY(-3px);
    }

    /* Animations */
    @keyframes qrboard-fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes qrboard-slideUp {
        from {
            opacity: 0;
            transform: translateY(50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .qrboard-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .qrboard-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 20px;
        }

        .qrboard-print-btn {
            width: 100%;
            justify-content: center;
        }

        .qrboard-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .modal-body {
            flex-direction: column;
            gap: 30px;
        }

        .modal-qr-container,
        .modal-info {
            min-width: 100%;
        }

        .modal-qr-wrapper {
            max-width: 300px;
            height: 300px;
        }

        .qr-modal-content {
            width: 95%;
            max-width: 500px;
        }
    }

    @media (max-width: 480px) {
        .qrboard-container {
            padding: 15px;
        }

        .qrboard-title h2 {
            font-size: 26px;
        }

        .qrboard-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .qrboard-item {
            padding: 20px;
        }

        .modal-qr-wrapper {
            max-width: 250px;
            height: 250px;
            padding: 20px;
        }

        .modal-body {
            padding: 30px 20px;
        }

        .modal-actions {
            flex-direction: column;
        }

        .modal-btn {
            width: 100%;
        }
    }

    /* QR Code Modal Animation */
    .modal-qr-wrapper {
        transform-origin: center center;
    }

    /* Reset state when modal is closed */
    .qr-modal:not(.active) .modal-qr-wrapper img {
        opacity: 0;
        transform: scale(0.5) rotate(0deg);
    }

    /* Animation when modal opens */
    .qr-modal.active .modal-qr-wrapper img {
        animation: qrCodeEntrance 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    @keyframes qrCodeEntrance {
        0% {
            opacity: 0;
            transform: scale(0.3) rotate(-180deg);
            filter: blur(4px);
        }
        40% {
            opacity: 1;
            transform: scale(0.8) rotate(20deg);
            filter: blur(0px);
        }
        70% {
            transform: scale(1.05) rotate(-10deg);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
    }

    /* Optional: Add a subtle continuous breathing animation after entrance */
    @keyframes qrCodeBreathing {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 15px 35px rgba(52, 152, 219, 0.3);
        }
        50% {
            transform: scale(1.02);
            box-shadow: 0 20px 40px rgba(52, 152, 219, 0.4);
        }
    }

    .qr-modal.active .modal-qr-wrapper {
        animation: qrCodeBreathing 3s ease-in-out infinite 1.2s;
    }
</style>

<style>
    /* NEW QR MODAL SYSTEM STYLES - ADDED AT THE END */
    .qr-modal {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .qr-modal.active {
        opacity: 1;
        visibility: visible;
    }

    .qr-modal-content {
        transform: scale(0.8);
        opacity: 0;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.4s ease;
    }

    .qr-modal.active .qr-modal-content {
        transform: scale(1);
        opacity: 1;
    }

    .qr-modal.closing {
        opacity: 0;
    }

    .qr-modal.closing .qr-modal-content {
        transform: scale(0.8);
        opacity: 0;
    }

    /* NEW MODAL ANIMATIONS */
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            backdrop-filter: blur(0px);
        }
        to {
            opacity: 1;
            backdrop-filter: blur(10px);
        }
    }

    @keyframes modalScaleUp {
        from {
            transform: scale(0.7) translateY(50px);
            opacity: 0;
        }
        to {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
    }

    @keyframes modalFadeOut {
        from {
            opacity: 1;
            backdrop-filter: blur(10px);
        }
        to {
            opacity: 0;
            backdrop-filter: blur(0px);
        }
    }

    @keyframes modalScaleDown {
        from {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
        to {
            transform: scale(0.7) translateY(50px);
            opacity: 0;
        }
    }
</style>

<div class="qr-modal" id="qrModal">
    <div class="qr-modal-content">
        <div class="close-modal" id="closeModal">
            <i class="fas fa-times"></i>
        </div>

        <div class="modal-header">
            <h2 class="modal-title" id="modalCountryName">Country Name</h2>
            <p class="modal-subtitle" id="modalCountryInfo">Detailed information about the country</p>
        </div>

        <div class="modal-body">
            <div class="modal-qr-container">
                <div class="modal-qr-wrapper">
                    <img id="modalQrImage" src="" alt="Large QR Code">
                </div>
                <div class="scan-instructions">
                    <h5><i class="fas fa-mobile-alt"></i> Scan Instructions</h5>
                    <p>Hold your phone steady about 6-12 inches from the screen. Ensure good lighting for optimal scanning.</p>
                </div>
            </div>

            <div class="modal-info">
                <h4>About This QR Code</h4>
                <p id="modalDescription">This QR code contains encoded information about the country, including cultural insights, key landmarks, historical facts, and travel information.</p>

                <h4>Encoded Data</h4>
                <ul class="modal-features">
                    <li>Student Information & Profile</li>
                    <li>Country Cultural Insights</li>
                    <li>Academic Records & Achievements</li>
                    <li>Contact Information</li>
                    <li>Digital Student Portfolio</li>
                </ul>

                <div class="modal-actions">
                    <button class="modal-btn modal-btn-primary" id="downloadBtn">
                        <i class="fas fa-download"></i> Download QR Code
                    </button>
                    <button class="modal-btn modal-btn-secondary" id="shareBtn">
                        <i class="fas fa-share-alt"></i> Share
                    </button>
                    <button class="modal-btn modal-btn-secondary" id="copyLinkBtn">
                        <i class="fas fa-link"></i> Copy Name
                    </button>
                    <button class="modal-btn modal-btn-secondary" id="copyUrlBtn">
                        <i class="fas fa-external-link-alt"></i> Copy URL
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this at the beginning of your Laravel Blade template, before the qrboard-container -->
<div class="universal-download-container">
    <button class="legendary-download-btn" id="legendaryDownloadBtn">
        <!-- Animated gradient background -->
        <div class="btn-bg-gradient"></div>

        <!-- Glass morphism layer -->
        <div class="btn-glass-layer"></div>

        <!-- Pulsing neon border -->
        <div class="btn-neon-border"></div>
        <div class="btn-neon-border btn-neon-border-delayed"></div>

        <!-- Main content -->
        <div class="btn-content">
            <!-- Animated download icon -->
            <div class="download-icon">
                <svg viewBox="0 0 24 24" class="icon-arrow">
                    <path d="M12 2v14m0 0l-5-5m5 5l5-5"/>
                    <path d="M5 17v4a1 1 0 001 1h12a1 1 0 001-1v-4"/>
                </svg>
                <div class="icon-ring"></div>
                <div class="icon-particles">
                    <span></span><span></span><span></span><span></span>
                </div>
            </div>

            <!-- Button text with gradient -->
            <span class="btn-text">
                <span class="text-gradient">Download link for students' submitted videos</span>
                <span class="text-subtitle">on the Sustainable Business Model Canvas</span>
            </span>

            <!-- Sparkle effects -->
            <div class="sparkle sparkle-1"></div>
            <div class="sparkle sparkle-2"></div>
            <div class="sparkle sparkle-3"></div>
        </div>

        <!-- 3D shadow -->
        <div class="btn-shadow"></div>

        <!-- Click ripple effect -->
        <div class="ripple-container"></div>
    </button>
</div>

<!-- Wrap your existing qrboard-container in this reveal wrapper -->
<div class="qrboard-reveal-wrapper" id="qrRevealWrapper">
    <div class="qrboard-container">

        <!-- Title/Header Area -->
        <div class="qrboard-header">
            <div class="qrboard-title">
                <i class="qrboard-title-icon fas fa-qrcode"></i>
                <h2>International Student QR Codes</h2>
                <p class="qrboard-subtitle">QR codes from students around the world - Click any card to enlarge</p>
            </div>
            <button class="qrboard-print-btn" id="qrboard-print-codes">
                <i class="fas fa-print"></i> Print QR Codes Only
            </button>
        </div>

        <!-- QR Code Grid -->
        <div class="qrboard-grid">
            <!-- Item 1 -->
            <div class="qrboard-item fade-in" data-student-id="001" data-person-name="Samuel Gal Ban" data-country="Venezuela" data-flag="🇻🇪" data-country-code="VE" data-qr-color="3C3B6E" data-bg-color="FEFEFF">
                <div class="qrboard-country-flag">🇻🇪</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/1.png"
                         alt="QR Code for Samuel Gal Ban"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #3C3B6E, #B22234);"></div>
                </div>
                <div class="qrboard-country-name">Venezuela</div>
                <div class="qrboard-name">Samuel Gal Ban</div>
            </div>

            <!-- Item 2 -->
            <div class="qrboard-item fade-in" data-student-id="002" data-person-name="Parsa Aghasi" data-country="Iran" data-flag="🇮🇷" data-country-code="IR" data-qr-color="BC002D" data-bg-color="3C3A74">
                <div class="qrboard-country-flag">🇮🇷</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/2.png"
                         alt="QR Code for Parsa Aghasi"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #BC002D, #FFFFFF);"></div>
                </div>
                <div class="qrboard-country-name">Iran</div>
                <div class="qrboard-name">Parsa Aghasi</div>
            </div>

            <!-- Item 3 -->
            <div class="qrboard-item fade-in" data-student-id="003" data-person-name="Nour Ideen" data-country="Malaysia" data-flag="🇲🇾" data-country-code="MY" data-qr-color="000000" data-bg-color="FFCC00">
                <div class="qrboard-country-flag">🇲🇾</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/3.png"
                         alt="QR Code for Nour Ideen"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #000000, #DD0000);"></div>
                </div>
                <div class="qrboard-country-name">Malaysia</div>
                <div class="qrboard-name">Nour Ideen</div>
            </div>

            <!-- Item 4 -->
            <div class="qrboard-item fade-in" data-student-id="004" data-person-name="Soroush Ali Mohamadi" data-country="Iran" data-flag="🇮🇷" data-country-code="IR" data-qr-color="009C3B" data-bg-color="FFDF00">
                <div class="qrboard-country-flag">🇮🇷</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/4.png"
                         alt="QR Code for Soroush Ali Mohamadi"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #009C3B, #FFDF00);"></div>
                </div>
                <div class="qrboard-country-name">Iran</div>
                <div class="qrboard-name">Soroush Ali Mohamadi</div>
            </div>

            <!-- Item 5 -->
            <div class="qrboard-item fade-in" data-student-id="005" data-person-name="Shajeev Krsna Maheswaran" data-country="Malaysia" data-flag="🇲🇾" data-country-code="MY" data-qr-color="FF9933" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇲🇾</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/5.png"
                         alt="QR Code for Shajeev Krsna Maheswaran"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #FF9933, #138808);"></div>
                </div>
                <div class="qrboard-country-name">Malaysia</div>
                <div class="qrboard-name">Shajeev Krsna Maheswaran</div>
            </div>

            <!-- Item 6 -->
            <div class="qrboard-item fade-in" data-student-id="006" data-person-name="Seyyed Mohammad Mahdi Sharif" data-country="Iran" data-flag="🇮🇷" data-country-code="IR" data-qr-color="0055A4" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇮🇷</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/6.png"
                         alt="QR Code for Seyyed Mohammad Mahdi Sharif"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #0055A4, #EF4135);"></div>
                </div>
                <div class="qrboard-country-name">Iran</div>
                <div class="qrboard-name">Seyyed Mohammad Mahdi Sharif</div>
            </div>

            <!-- Item 7 -->
            <div class="qrboard-item fade-in" data-student-id="007" data-person-name="Isis Camacho" data-country="Venezuela" data-flag="🇻🇪" data-country-code="VE" data-qr-color="012169" data-bg-color="C8102E">
                <div class="qrboard-country-flag">🇻🇪</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/7.png"
                         alt="QR Code for Isis Camacho"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #012169, #C8102E);"></div>
                </div>
                <div class="qrboard-country-name">Venezuela</div>
                <div class="qrboard-name">Isis Camacho</div>
            </div>

            <!-- Item 8 -->
            <div class="qrboard-item fade-in" data-student-id="008" data-person-name="Cardid Guerrero" data-country="Venezuela" data-flag="🇻🇪" data-country-code="VE" data-qr-color="012169" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇻🇪</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/8.png"
                         alt="QR Code for Cardid Guerrero"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #012169, #E4002B);"></div>
                </div>
                <div class="qrboard-country-name">Venezuela</div>
                <div class="qrboard-name">Cardid Guerrero</div>
            </div>

            <!-- Item 9 -->
            <div class="qrboard-item fade-in" data-student-id="009" data-person-name="Yasin Telebian" data-country="Iran" data-flag="🇮🇷" data-country-code="IR" data-qr-color="FF0000" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇮🇷</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/9.png"
                         alt="QR Code for Yasin Telebian"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #FF0000, #FFFFFF);"></div>
                </div>
                <div class="qrboard-country-name">Iran</div>
                <div class="qrboard-name">Yasin Telebian</div>
            </div>

            <!-- Item 10 -->
            <div class="qrboard-item fade-in" data-student-id="010" data-person-name="Ali Shamsi Mo Fakhar" data-country="Iran" data-flag="🇮🇷" data-country-code="IR" data-qr-color="C60B1E" data-bg-color="FFC400">
                <div class="qrboard-country-flag">🇮🇷</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/10.png"
                         alt="QR Code for Ali Shamsi Mo Fakhar"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #C60B1E, #FFC400);"></div>
                </div>
                <div class="qrboard-country-name">Iran</div>
                <div class="qrboard-name">Ali Shamsi Mo Fakhar</div>
            </div>

            <!-- Item 11 -->
            <div class="qrboard-item fade-in" data-student-id="011" data-person-name="Ali Hazrati" data-country="Iran" data-flag="🇮🇷" data-country-code="IR" data-qr-color="009246" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇮🇷</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/11.png"
                         alt="QR Code for Ali Hazrati"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #009246, #CE2B37);"></div>
                </div>
                <div class="qrboard-country-name">Iran</div>
                <div class="qrboard-name">Ali Hazrati</div>
            </div>

            <!-- Item 12 -->
            <div class="qrboard-item fade-in" data-student-id="012" data-person-name="Abdullah Alzahrani" data-country="Saudi Arabia" data-flag="🇸🇦" data-country-code="SA" data-qr-color="003478" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇸🇦</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/12.png"
                         alt="QR Code for Abdullah Alzahrani"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #003478, #CD2E3A);"></div>
                </div>
                <div class="qrboard-country-name">Saudi Arabia</div>
                <div class="qrboard-name">Abdullah Alzahrani</div>
            </div>

            <!-- Item 13 -->
            <div class="qrboard-item fade-in" data-student-id="013" data-person-name="Hooman Azimi Nia" data-country="Iran" data-flag="🇮🇷" data-country-code="IR" data-qr-color="006847" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇮🇷</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/13.png"
                         alt="QR Code for Hooman Azimi Nia"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #006847, #CE1126);"></div>
                </div>
                <div class="qrboard-country-name">Iran</div>
                <div class="qrboard-name">Hooman Azimi Nia</div>
            </div>

            <!-- Item 14 -->
            <div class="qrboard-item fade-in" data-student-id="014" data-person-name="Hesam Sahra Navard" data-country="Iran" data-flag="🇮🇷" data-country-code="IR" data-qr-color="DE2910" data-bgcolor="FFFFFF">
                <div class="qrboard-country-flag">🇮🇷</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/14.png"
                         alt="QR Code for Hesam Sahra Navard"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #DE2910, #FFDE00);"></div>
                </div>
                <div class="qrboard-country-name">Iran</div>
                <div class="qrboard-name">Hesam Sahra Navard</div>
            </div>

            <!-- Item 15 -->
            <div class="qrboard-item fade-in" data-student-id="015" data-person-name="Amir Ali Khayati" data-country="Iran" data-flag="🇮🇷" data-country-code="IR" data-qr-color="D52B1E" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇮🇷</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/15.png"
                         alt="QR Code for Amir Ali Khayati"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #D52B1E, #0039A6);"></div>
                </div>
                <div class="qrboard-country-name">Iran</div>
                <div class="qrboard-name">Amir Ali Khayati</div>
            </div>

            <!-- Item 16 -->
            <div class="qrboard-item fade-in" data-student-id="016" data-person-name="Muhammad Ammar bin Abdul Halim" data-country="Malaysia" data-flag="🇲🇾" data-country-code="MY" data-qr-color="CE1126" data-bgcolor="FFFFFF">
                <div class="qrboard-country-flag">🇲🇾</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/16.png"
                         alt="QR Code for Muhammad Ammar bin Abdul Halim"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #CE1126, #000000);"></div>
                </div>
                <div class="qrboard-country-name">Malaysia</div>
                <div class="qrboard-name">
                    Muhammad Ammar bin Abdul Halim
                </div>
            </div>

            <!-- Item 17 -->
            <div class="qrboard-item fade-in" data-student-id="017" data-person-name="Luis Bermudez" data-country="Venezuela" data-flag="🇻🇪" data-country-code="VE" data-qr-color="007A4D" data-bgcolor="000000">
                <div class="qrboard-country-flag">🇻🇪</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/17.png"
                         alt="QR Code for Luis Bermudez"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #007A4D, #FFB915);"></div>
                </div>
                <div class="qrboard-country-name">Venezuela</div>
                <div class="qrboard-name">Luis Bermudez</div>
            </div>

            <!-- Item 18 -->
            <div class="qrboard-item fade-in" data-student-id="018" data-person-name="Juan Martinez" data-country="Venezuela" data-flag="🇻🇪" data-country-code="VE" data-qr-color="006AA7" data-bgcolor="FECC00">
                <div class="qrboard-country-flag">🇻🇪</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/18.png"
                         alt="QR Code for Juan Martinez"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #006AA7, #FECC00);"></div>
                </div>
                <div class="qrboard-country-name">Venezuela</div>
                <div class="qrboard-name">Juan Martinez</div>
            </div>

            <!-- Item 19 -->
            <div class="qrboard-item fade-in" data-student-id="019" data-person-name="Paolo Planas" data-country="Venezuela" data-flag="🇻🇪" data-country-code="VE" data-qr-color="E30A17" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇻🇪</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/19.png"
                         alt="QR Code for Paolo Planas"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #E30A17, #FFFFFF);"></div>
                </div>
                <div class="qrboard-country-name">Venezuela</div>
                <div class="qrboard-name">Paolo Planas</div>
            </div>

            <!-- Item 20 -->
            <div class="qrboard-item fade-in" data-student-id="020" data-person-name="Nur Qaireen" data-country="Malaysia" data-flag="🇲🇾" data-country-code="MY" data-qr-color="74ACDF" data-bg-color="FFFFFF">
                <div class="qrboard-country-flag">🇲🇾</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/20.png"
                         alt="QR Code for Nur Qaireen"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #74ACDF, #FFFFFF);"></div>
                </div>
                <div class="qrboard-country-name">Malaysia</div>
                <div class="qrboard-name">Nur Qaireen</div>
            </div>

            <!-- Item 21 -->
            <div class="qrboard-item fade-in" data-student-id="021" data-person-name="Mirzazahirah" data-country="Malaysia" data-flag="🇲🇾" data-country-code="MY" data-qr-color="00247D" data-bg-color="003275">
                <div class="qrboard-country-flag">🇲🇾</div>
                <div class="qrboard-img-container">
                    <img src="{{ env('APP_URL') }}/img/qr/final/21.png"
                         alt="QR Code for Mirzazahirah"
                         class="qrboard-img"
                         loading="lazy">
                    <div class="qrboard-color-badge" style="background: linear-gradient(135deg, #00247D, #CC0000);"></div>
                </div>
                <div class="qrboard-country-name">Malaysia</div>
                <div class="qrboard-name">Mirzazahirah</div>
            </div>

        </div>
    </div>
</div>

<style>
    /* LEGENDARY DOWNLOAD BUTTON STYLES - The most beautiful button in the universe */
    .universal-download-container {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 50px 20px;
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 100%);
        min-height: 300px;
        overflow: hidden;
    }

    .universal-download-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.3), transparent);
        z-index: 1;
    }

    .legendary-download-btn {
        position: relative;
        width: 800px;
        max-width: 90%;
        height: 100px;
        border: none;
        background: transparent;
        cursor: pointer;
        padding: 0;
        border-radius: 25px;
        overflow: visible;
        transform-style: preserve-3d;
        perspective: 1000px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .legendary-download-btn:hover {
        transform: translateY(-5px) scale(1.02);
    }

    .legendary-download-btn:active {
        transform: translateY(0) scale(0.98);
        transition: all 0.1s ease;
    }

    /* Animated gradient background */
    .btn-bg-gradient {
        position: absolute;
        inset: 0;
        border-radius: 25px;
        background: linear-gradient(
                135deg,
                #0ea5e9 0%,
                #3b82f6 20%,
                #8b5cf6 40%,
                #ec4899 60%,
                #f97316 80%,
                #fbbf24 100%
        );
        background-size: 400% 400%;
        animation: gradientFlow 8s ease infinite;
        opacity: 0.9;
        filter: blur(0px);
    }

    @keyframes gradientFlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Glass morphism layer */
    .btn-glass-layer {
        position: absolute;
        inset: 1px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow:
                inset 0 2px 10px rgba(255, 255, 255, 0.1),
                inset 0 -2px 10px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Pulsing neon border effect */
    .btn-neon-border {
        position: absolute;
        inset: -2px;
        border-radius: 27px;
        background: linear-gradient(
                45deg,
                #00ffff,
                #ff00ff,
                #ffff00,
                #00ff00,
                #00ffff
        );
        background-size: 400% 400%;
        animation: neonPulse 3s linear infinite, borderRotate 20s linear infinite;
        filter: blur(8px);
        opacity: 0.7;
        z-index: 0;
    }

    .btn-neon-border-delayed {
        animation-delay: 0.5s;
        filter: blur(12px);
        opacity: 0.4;
    }

    @keyframes neonPulse {
        0%, 100% { opacity: 0.7; filter: blur(8px); }
        50% { opacity: 1; filter: blur(12px); }
    }

    @keyframes borderRotate {
        0% { background-position: 0% 50%; transform: rotate(0deg); }
        100% { background-position: 400% 50%; transform: rotate(360deg); }
    }

    /* Main button content */
    .btn-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        height: 100%;
        padding: 0 50px;
        border-radius: 25px;
        overflow: hidden;
    }

    /* Animated download icon */
    .download-icon {
        position: relative;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-arrow {
        width: 40px;
        height: 40px;
        stroke: white;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        fill: none;
        filter: drop-shadow(0 0 10px rgba(0, 255, 255, 0.7));
        animation: arrowBounce 2s ease-in-out infinite;
    }

    @keyframes arrowBounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(5px); }
    }

    .icon-ring {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 2px solid rgba(0, 255, 255, 0.5);
        border-radius: 50%;
        animation: ringPulse 3s ease-in-out infinite;
    }

    @keyframes ringPulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .icon-particles {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .icon-particles span {
        position: absolute;
        width: 4px;
        height: 4px;
        background: #00ffff;
        border-radius: 50%;
        filter: blur(1px);
    }

    .icon-particles span:nth-child(1) {
        top: 10%;
        left: 50%;
        animation: particleFloat 3s ease-in-out infinite;
    }

    .icon-particles span:nth-child(2) {
        top: 50%;
        left: 10%;
        animation: particleFloat 3s ease-in-out infinite 0.5s;
    }

    .icon-particles span:nth-child(3) {
        top: 50%;
        right: 10%;
        animation: particleFloat 3s ease-in-out infinite 1s;
    }

    .icon-particles span:nth-child(4) {
        bottom: 10%;
        left: 50%;
        animation: particleFloat 3s ease-in-out infinite 1.5s;
    }

    @keyframes particleFloat {
        0%, 100% { transform: translate(0, 0); opacity: 0; }
        50% { transform: translate(10px, -10px); opacity: 1; }
    }

    /* Button text styling */
    .btn-text {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }

    .text-gradient {
        font-size: 22px;
        font-weight: 800;
        letter-spacing: 0.5px;
        background: linear-gradient(
                to right,
                #ffffff 0%,
                #a5f3fc 25%,
                #67e8f9 50%,
                #22d3ee 75%,
                #06b6d4 100%
        );
        background-size: 200% auto;
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textShine 3s ease-in-out infinite;
        text-shadow: 0 0 20px rgba(103, 232, 249, 0.5);
    }

    @keyframes textShine {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .text-subtitle {
        font-size: 14px;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.8);
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* Sparkle effects */
    .sparkle {
        position: absolute;
        width: 20px;
        height: 20px;
        background: radial-gradient(circle at center, #ffffff, transparent);
        border-radius: 50%;
        filter: blur(2px);
        opacity: 0;
    }

    .sparkle-1 {
        top: 20px;
        left: 20px;
        animation: sparkleTwinkle 3s ease-in-out infinite;
    }

    .sparkle-2 {
        top: 20px;
        right: 20px;
        animation: sparkleTwinkle 3s ease-in-out infinite 0.7s;
    }

    .sparkle-3 {
        bottom: 20px;
        right: 50%;
        animation: sparkleTwinkle 3s ease-in-out infinite 1.4s;
    }

    @keyframes sparkleTwinkle {
        0%, 100% { opacity: 0; transform: scale(0.5); }
        50% { opacity: 1; transform: scale(1); }
    }

    /* 3D Shadow effect */
    .btn-shadow {
        position: absolute;
        bottom: -15px;
        left: 10%;
        right: 10%;
        height: 40px;
        background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.4) 0%, transparent 70%);
        border-radius: 50%;
        filter: blur(10px);
        z-index: -1;
        transition: all 0.4s ease;
    }

    .legendary-download-btn:hover .btn-shadow {
        bottom: -20px;
        filter: blur(15px);
        opacity: 0.6;
    }

    /* Ripple effect container */
    .ripple-container {
        position: absolute;
        inset: 0;
        border-radius: 25px;
        overflow: hidden;
        pointer-events: none;
        z-index: 3;
    }

    /* QR Board Reveal Animation */
    .qrboard-reveal-wrapper {
        max-height: 0;
        overflow: hidden;
        transition: max-height 1.2s cubic-bezier(0.87, 0, 0.13, 1);
    }

    .qrboard-reveal-wrapper.revealed {
        max-height: 5000px;
    }

    .qrboard-container {
        opacity: 0;
        transform: translateY(50px) scale(0.95);
        transition: all 1s cubic-bezier(0.34, 1.56, 0.64, 1) 0.3s;
        filter: blur(10px);
    }

    .qrboard-reveal-wrapper.revealed .qrboard-container {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
        display: block !important;
    }

    /* Hover glow effect */
    .legendary-download-btn::after {
        content: '';
        position: absolute;
        inset: -20px;
        background: radial-gradient(circle at center, rgba(0, 255, 255, 0.1) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: -1;
        pointer-events: none;
    }

    .legendary-download-btn:hover::after {
        opacity: 1;
    }

    /* Click animation */
    @keyframes clickPress {
        0% { transform: scale(1); }
        50% { transform: scale(0.95); }
        100% { transform: scale(1); }
    }

    @keyframes rippleEffect {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .legendary-download-btn {
            height: 80px;
        }

        .btn-content {
            gap: 20px;
            padding: 0 20px;
        }

        .text-gradient {
            font-size: 18px;
        }

        .text-subtitle {
            font-size: 12px;
        }

        .download-icon {
            width: 50px;
            height: 50px;
        }

        .icon-arrow {
            width: 30px;
            height: 30px;
        }
    }

    @media (max-width: 480px) {
        .legendary-download-btn {
            height: 70px;
        }

        .btn-content {
            flex-direction: column;
            gap: 10px;
            padding: 15px;
        }

        .text-gradient {
            font-size: 16px;
            text-align: center;
        }

        .text-subtitle {
            font-size: 10px;
            text-align: center;
        }
    }

    /* Micro-interaction hover effects */
    .legendary-download-btn:hover .btn-bg-gradient {
        animation-duration: 4s;
        opacity: 1;
    }

    .legendary-download-btn:hover .btn-neon-border {
        filter: blur(15px);
        opacity: 0.9;
    }

    .legendary-download-btn:hover .icon-arrow {
        animation-duration: 1s;
    }

    .legendary-download-btn:hover .text-gradient {
        animation-duration: 2s;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const downloadBtn = document.getElementById('legendaryDownloadBtn');
        const qrRevealWrapper = document.getElementById('qrRevealWrapper');
        const qrContainer = document.querySelector('.qrboard-container');
        const qrModal = document.getElementById('qrModal');
        let isRevealed = false;

        // Create ripple effect
        function createRipple(event) {
            const rippleContainer = downloadBtn.querySelector('.ripple-container');
            const ripple = document.createElement('div');

            const rect = downloadBtn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = event.clientX - rect.left - size / 2;
            const y = event.clientY - rect.top - size / 2;

            ripple.style.cssText = `
            position: absolute;
            top: ${y}px;
            left: ${x}px;
            width: ${size}px;
            height: ${size}px;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            border-radius: 50%;
            transform: scale(0);
            animation: rippleEffect 0.6s ease-out;
            pointer-events: none;
        `;

            rippleContainer.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        }

        // Legendary download button click handler - PROPERLY FIXED SCROLLING
        downloadBtn.addEventListener('click', function(e) {
            // Prevent any default behavior
            e.preventDefault();

            // Create ripple effect
            createRipple(e);

            // Add click press animation
            downloadBtn.style.animation = 'clickPress 0.3s ease';
            setTimeout(() => {
                downloadBtn.style.animation = '';
            }, 300);

            // Check if QR modal is open and close it if it is
            if (qrModal.classList.contains('active')) {
                // Close the QR modal with premium animation
                qrModal.classList.remove('active');
                document.body.style.overflow = 'auto';

                // Add special visual feedback for closing modal
                const btnText = downloadBtn.querySelector('.text-gradient');
                const originalText = btnText.textContent;
                btnText.textContent = 'Modal Closed ✓';
                btnText.style.animation = 'none';
                btnText.style.color = '#10b981';

                setTimeout(() => {
                    btnText.style.animation = 'textShine 3s ease-in-out infinite';
                    btnText.textContent = originalText;
                    btnText.style.color = '';
                }, 1500);

                return; // Exit early since we handled modal close
            }

            // Toggle QR board reveal (original functionality)
            if (!isRevealed) {
                // Reveal the QR board
                qrRevealWrapper.classList.add('revealed');

                // Force a reflow to trigger animation
                void qrRevealWrapper.offsetWidth;

                // Add scroll animation for QR items
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                });

                document.querySelectorAll('.qrboard-item.fade-in').forEach(item => {
                    observer.observe(item);
                });

                // Wait a bit for the animation to start, then scroll
                setTimeout(() => {
                    // Get the position of the revealed content
                    const revealRect = qrRevealWrapper.getBoundingClientRect();
                    const containerRect = qrContainer.getBoundingClientRect();

                    // Calculate the scroll position
                    const scrollToPosition = revealRect.top + window.pageYOffset - 100; // 100px offset for better visibility

                    // Smooth scroll to the revealed content
                    window.scrollTo({
                        top: scrollToPosition,
                        behavior: 'smooth'
                    });
                }, 300); // Wait for CSS transition to start

                isRevealed = true;

                // Change button text subtly
                const btnText = downloadBtn.querySelector('.text-gradient');
                const originalText = btnText.textContent;
                btnText.textContent = 'Access Granted ✓';
                btnText.style.animation = 'none';
                btnText.style.color = '#10b981';

                setTimeout(() => {
                    btnText.style.animation = 'textShine 3s ease-in-out infinite';
                    btnText.textContent = originalText;
                    btnText.style.color = '';
                }, 1500);

            } else {
                // Toggle hide/show when QR board is already revealed
                if (qrRevealWrapper.classList.contains('revealed')) {
                    // Hide the QR board
                    qrRevealWrapper.classList.remove('revealed');
                    isRevealed = false;

                    // Change button text
                    const btnText = downloadBtn.querySelector('.text-gradient');
                    const originalText = btnText.textContent;
                    btnText.textContent = 'QR Board Hidden';
                    btnText.style.animation = 'none';

                    setTimeout(() => {
                        btnText.style.animation = 'textShine 3s ease-in-out infinite';
                        btnText.textContent = originalText;
                    }, 1500);
                } else {
                    // Show the QR board
                    qrRevealWrapper.classList.add('revealed');
                    isRevealed = true;

                    // Wait for animation then scroll
                    setTimeout(() => {
                        // Get the position of the revealed content
                        const revealRect = qrRevealWrapper.getBoundingClientRect();
                        const scrollToPosition = revealRect.top + window.pageYOffset - 100;

                        window.scrollTo({
                            top: scrollToPosition,
                            behavior: 'smooth'
                        });
                    }, 300);

                    // Change button text
                    const btnText = downloadBtn.querySelector('.text-gradient');
                    const originalText = btnText.textContent;
                    btnText.textContent = 'QR Board Visible ✓';
                    btnText.style.animation = 'none';

                    setTimeout(() => {
                        btnText.style.animation = 'textShine 3s ease-in-out infinite';
                        btnText.textContent = originalText;
                    }, 1500);
                }
            }
        });

        // Hover effects
        downloadBtn.addEventListener('mouseenter', function() {
            // Add floating particles on hover
            for (let i = 0; i < 5; i++) {
                setTimeout(() => {
                    createFloatingParticle();
                }, i * 100);
            }
        });

        // Create floating particles on hover
        function createFloatingParticle() {
            const particle = document.createElement('div');
            const size = Math.random() * 10 + 5;
            const x = Math.random() * downloadBtn.offsetWidth;

            particle.style.cssText = `
            position: absolute;
            top: 100%;
            left: ${x}px;
            width: ${size}px;
            height: ${size}px;
            background: radial-gradient(circle, rgba(0,255,255,0.8) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(2px);
            animation: floatParticle 1.5s ease-out forwards;
            pointer-events: none;
            z-index: 10;
        `;

            downloadBtn.appendChild(particle);

            setTimeout(() => {
                particle.remove();
            }, 1500);
        }

        // Add CSS for floating particles animation
        const style = document.createElement('style');
        style.textContent = `
        @keyframes floatParticle {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Add a pulsing animation when modal is open */
        .qr-modal.active ~ .universal-download-container .legendary-download-btn {
            animation: modalAlertPulse 2s ease-in-out infinite;
        }

        @keyframes modalAlertPulse {
            0%, 100% {
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.5);
            }
            50% {
                box-shadow: 0 0 40px rgba(239, 68, 68, 0.8);
            }
        }

        /* Style for modal-closed text state */
        .text-gradient.modal-closed {
            color: #10b981 !important;
            animation: textShineGreen 2s ease-in-out infinite !important;
        }

        @keyframes textShineGreen {
            0%, 100% {
                background-position: 0% 50%;
                text-shadow: 0 0 20px rgba(16, 185, 129, 0.5);
            }
            50% {
                background-position: 100% 50%;
                text-shadow: 0 0 30px rgba(16, 185, 129, 0.8);
            }
        }
    `;
        document.head.appendChild(style);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get modal elements
        const qrModal = document.getElementById('qrModal');
        const closeModal = document.getElementById('closeModal');
        const modalCountryName = document.getElementById('modalCountryName');
        const modalCountryInfo = document.getElementById('modalCountryInfo');
        const modalQrImage = document.getElementById('modalQrImage');
        const modalDescription = document.getElementById('modalDescription');
        const downloadBtn = document.getElementById('downloadBtn');
        const shareBtn = document.getElementById('shareBtn');
        const copyLinkBtn = document.getElementById('copyLinkBtn');
        const copyUrlBtn = document.getElementById('copyUrlBtn');
        const printBtn = document.getElementById('qrboard-print-codes');

        // Variables to track modal state
        let isModalOpen = false;
        let scrollPosition = 0;
        let originalBodyHeight = '';
        let currentQrNumber = '';

        // Extract number from image URL
        function extractNumberFromUrl(url) {
            // Extract the number from URL like /img/qr/final/2.png
            const match = url.match(/\/(\d+)\.png$/);
            return match ? match[1] : '';
        }

        // Open modal function
        function openModal(qrItem) {
            if (isModalOpen) return;

            // Store current scroll position
            storeScrollPosition();

            // Extract data from the clicked item
            const personName = qrItem.getAttribute('data-person-name');
            const country = qrItem.getAttribute('data-country');
            const flag = qrItem.getAttribute('data-flag');

            // Extract number from the image source
            const imgSrc = qrItem.querySelector('.qrboard-img').src;
            const qrNumber = extractNumberFromUrl(imgSrc);
            currentQrNumber = qrNumber;

            // Set modal content according to requirements
            modalCountryName.textContent = country;
            modalCountryInfo.textContent = `QR Code for ${personName} from ${country}`;

            // Set QR image URLs exactly as required
            const appUrl = '{{ env('APP_URL') }}';
            modalQrImage.src = `${appUrl}/img/qr/null/${qrNumber}.png`;
            modalDescription.textContent = `This QR code belongs to ${personName} (${country}).`;

            // Set download button data
            downloadBtn.dataset.downloadUrl = `${appUrl}/img/qr/titles/${qrNumber}.png`;

            // Show modal with animation
            qrModal.classList.remove('closing');
            qrModal.classList.add('active');
            isModalOpen = true;

            // Prevent body scrolling
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.top = `-${scrollPosition}px`;
            document.body.style.width = '100%';
            document.body.style.height = '100vh';
        }

        // Close modal function
        function closeModalFunc() {
            if (!isModalOpen) return;

            // Add closing animation
            qrModal.classList.add('closing');

            setTimeout(() => {
                qrModal.classList.remove('active');
                qrModal.classList.remove('closing');
                isModalOpen = false;

                // Restore body styles
                document.body.style.overflow = '';
                document.body.style.position = '';
                document.body.style.top = '';
                document.body.style.width = '';
                document.body.style.height = '';

                // Restore scroll position
                restoreScrollPosition();
            }, 300);
        }

        // Store scroll position and prevent page jumping
        function storeScrollPosition() {
            scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            originalBodyHeight = document.body.style.height;
        }

        // Restore scroll position
        function restoreScrollPosition() {
            window.scrollTo(0, scrollPosition);
            document.body.style.height = originalBodyHeight;
        }

        // Add click event to all QR board items
        document.querySelectorAll('.qrboard-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                openModal(this);
            });
        });

        // Close modal when close button is clicked
        closeModal.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeModalFunc();
        });

        // Close modal when clicking outside the modal content
        qrModal.addEventListener('click', function(e) {
            if (e.target === qrModal) {
                e.preventDefault();
                e.stopPropagation();
                closeModalFunc();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isModalOpen) {
                e.preventDefault();
                closeModalFunc();
            }
        });

        // Download QR code functionality
        downloadBtn.addEventListener('click', function() {
            const downloadUrl = this.dataset.downloadUrl;
            if (!downloadUrl) return;

            const fileName = `qr_code_${currentQrNumber}.png`;
            const link = document.createElement('a');
            link.href = downloadUrl;
            link.download = fileName;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });

        // Share functionality
        shareBtn.addEventListener('click', function() {
            const studentName = modalCountryName.textContent;
            const countryInfo = modalCountryInfo.textContent;

            if (navigator.share) {
                navigator.share({
                    title: `${studentName}'s QR Code`,
                    text: countryInfo,
                    url: window.location.href
                });
            } else {
                // Fallback for browsers without Web Share API
                const shareText = `${studentName}'s QR Code - ${countryInfo}\n${window.location.href}`;
                navigator.clipboard.writeText(shareText).then(() => {
                    const originalText = shareBtn.innerHTML;
                    shareBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                    setTimeout(() => {
                        shareBtn.innerHTML = originalText;
                    }, 2000);
                });
            }
        });

        // Copy link functionality
        copyLinkBtn.addEventListener('click', function() {
            const studentName = modalCountryName.textContent;
            const countryInfo = modalCountryInfo.textContent;
            const textToCopy = `${studentName}'s QR Code - ${countryInfo}\n${window.location.href}`;

            navigator.clipboard.writeText(textToCopy).then(() => {
                const originalText = copyLinkBtn.innerHTML;
                copyLinkBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                setTimeout(() => {
                    copyLinkBtn.innerHTML = originalText;
                }, 2000);
            });
        });

        // Copy URL functionality
        copyUrlBtn.addEventListener('click', function() {
            const urlToCopy = window.location.href;

            navigator.clipboard.writeText(urlToCopy).then(() => {
                const originalText = copyUrlBtn.innerHTML;
                copyUrlBtn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                setTimeout(() => {
                    copyUrlBtn.innerHTML = originalText;
                }, 2000);
            });
        });

        // Print QR codes only (in black and white)
        printBtn.addEventListener('click', function() {
            const printWindow = window.open('', '_blank');

            // Create a clean print version
            const printContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>QR Codes Print</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 20px;
                            font-family: Arial, sans-serif;
                        }
                        .print-title {
                            text-align: center;
                            margin-bottom: 30px;
                            font-size: 24px;
                            font-weight: bold;
                        }
                        .print-grid {
                            display: grid;
                            grid-template-columns: repeat(4, 1fr);
                            gap: 15px;
                        }
                        .print-item {
                            border: 1px solid #000;
                            padding: 15px;
                            text-align: center;
                            page-break-inside: avoid;
                        }
                        .print-flag {
                            font-size: 20px;
                            margin-bottom: 5px;
                        }
                        .print-country {
                            font-size: 12px;
                            font-weight: bold;
                            margin-bottom: 5px;
                        }
                        .print-name {
                            font-size: 14px;
                            font-weight: bold;
                            margin-top: 5px;
                        }
                        .print-qr {
                            width: 120px;
                            height: 120px;
                            margin: 10px auto;
                            filter: grayscale(100%) contrast(150%);
                        }
                        @media print {
                            .print-grid {
                                grid-template-columns: repeat(4, 1fr) !important;
                            }
                        }
                    </style>
                </head>
                <body>
                    <h1 class="print-title">International Student QR Codes</h1>
                    <div class="print-grid">
                        ${Array.from(document.querySelectorAll('.qrboard-item')).map(item => `
                            <div class="print-item">
                                <div class="print-flag">${item.getAttribute('data-flag')}</div>
                                <div class="print-country">${item.getAttribute('data-country')}</div>
                                <img class="print-qr" src="${item.querySelector('img').src}" alt="QR Code">
                                <div class="print-name">${item.getAttribute('data-person-name')}</div>
                            </div>
                        `).join('')}
                    </div>
                </body>
                </html>
            `;

            printWindow.document.write(printContent);
            printWindow.document.close();

            // Print after content loads
            printWindow.onload = function() {
                printWindow.print();
                printWindow.close();
            };
        });

        // Scroll animation for QR items
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all QR items for scroll animation
        document.querySelectorAll('.qrboard-item.fade-in').forEach(item => {
            observer.observe(item);
        });

        // Handle window resize when modal is open
        window.addEventListener('resize', function() {
            if (isModalOpen) {
                // Update the top position to maintain scroll position
                document.body.style.top = `-${scrollPosition}px`;
            }
        });
    });
</script>
<script>
    const qrModal = document.getElementById("qrModal");
    const closeModalBtn = document.getElementById("closeModal");

    closeModalBtn.addEventListener("click", () => {
        qrModal.classList.add("closing");

        setTimeout(() => {
            qrModal.classList.remove("active", "closing");
        }, 350);
    });

    // Close by clicking outside
    qrModal.addEventListener("click", (e) => {
        if (e.target === qrModal) {
            qrModal.classList.add("closing");
            setTimeout(() => {
                qrModal.classList.remove("active", "closing");
            }, 350);
        }
    });

    // Disable background scroll when modal opens
    function openQrModal() {
        qrModal.classList.add("active");
        document.body.style.overflow = "hidden";
    }

    // Re-enable scroll when modal closes
    qrModal.addEventListener("transitionend", () => {
        if (!qrModal.classList.contains("active")) {
            document.body.style.overflow = "";
        }
    });

</script>
