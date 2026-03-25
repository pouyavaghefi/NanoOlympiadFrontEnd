<style>
    .impossible-card {
        left:35%;
        width: 400px;
        height: 500px;
        position: relative;
        transform-style: preserve-3d;
        animation: float 6s ease-in-out infinite;
    }

    @media (max-width: 768px) {
        .impossible-card {
            left:0px;
        }
    }

    .card-face {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.5),
                inset 0 -5px 15px rgba(255, 255, 255, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 30px;
        text-align: center;
        color: white;
        overflow: hidden;
        backface-visibility: hidden;
        transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card-front {
        transform: rotateY(0deg);
    }

    .card-back {
        transform: rotateY(180deg);
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .impossible-card.flipped .card-front {
        transform: rotateY(-180deg);
    }

    .impossible-card.flipped .card-back {
        transform: rotateY(0deg);
    }

    .impossible-shape {
        position: absolute;
        width: 200px;
        height: 200px;
        background: linear-gradient(45deg, #ff6b6b, #ffa726);
        clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);
        opacity: 0.3;
        animation: rotate 20s linear infinite;
        z-index: 0;
    }

    .shape-1 {
        top: -50px;
        left: -50px;
        animation-delay: 0s;
    }

    .shape-2 {
        bottom: -50px;
        right: -50px;
        animation-delay: -5s;
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        background: linear-gradient(45deg, #4ecdc4, #44a08d);
    }

    .shape-3 {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        height: 300px;
        opacity: 0.15;
        animation-delay: -10s;
        clip-path: polygon(20% 0%, 80% 0%, 100% 20%, 100% 80%, 80% 100%, 20% 100%, 0% 80%, 0% 20%);
        background: linear-gradient(45deg, #ffeaa7, #fab1a0);
    }

    .pdf-icon {
        font-size: 80px;
        margin-bottom: 20px;
        text-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .card-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .card-description {
        font-size: 16px;
        margin-bottom: 25px;
        position: relative;
        z-index: 1;
        opacity: 0.9;
    }

    .btn-impossible {
        background: transparent;
        border: 2px solid white;
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.4s ease;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    .btn-impossible:before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: 0.5s;
    }

    .btn-impossible:hover:before {
        left: 100%;
    }

    .btn-impossible:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .flip-hint {
        position: absolute;
        bottom: 20px;
        font-size: 12px;
        opacity: 0.7;
        animation: pulse 2s infinite;
    }

    .impossible-border {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 20px;
        padding: 3px;
        background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #ffeaa7, #fdcb6e, #ff6b6b);
        background-size: 400% 400%;
        animation: gradientShift 3s ease infinite;
        z-index: -1;
    }

    .holographic-effect {
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(125deg,
        transparent 0%,
        rgba(255,255,255,0.1) 30%,
        transparent 60%,
        rgba(255,255,255,0.1) 70%,
        transparent 100%);
        opacity: 0;
        animation: hologram 4s linear infinite;
        pointer-events: none;
        z-index: 2;
    }

    .neon-glow {
        position: absolute;
        width: calc(100% + 10px);
        height: calc(100% + 10px);
        border-radius: 25px;
        background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1);
        filter: blur(15px);
        opacity: 0.7;
        z-index: -2;
        animation: neonPulse 3s ease-in-out infinite alternate;
    }

    .parallax-layer {
        position: absolute;
        width: 100%;
        height: 100%;
        background:
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
        border-radius: 20px;
        z-index: 0;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotateX(5deg) rotateY(5deg); }
        50% { transform: translateY(-20px) rotateX(-5deg) rotateY(-5deg); }
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes pulse {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 1; }
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes hologram {
        0% { opacity: 0; transform: translateX(-100%); }
        10% { opacity: 0.5; }
        20% { opacity: 0; transform: translateX(100%); }
        100% { opacity: 0; transform: translateX(100%); }
    }

    @keyframes neonPulse {
        0% { opacity: 0.5; filter: blur(15px) brightness(1); }
        100% { opacity: 0.8; filter: blur(20px) brightness(1.2); }
    }

    .impossible-card:hover {
        animation-duration: 3s;
    }

    .impossible-card:hover .pdf-icon {
        transform: scale(1.2) rotate(10deg);
    }

    .back-content {
        position: relative;
        z-index: 1;
    }

    .file-info {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 15px;
        margin: 20px 0;
        backdrop-filter: blur(5px);
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .info-label {
        opacity: 0.8;
    }

    .info-value {
        font-weight: 600;
    }

    .morphing-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 20px;
        overflow: hidden;
        z-index: 0;
    }

    .morph-shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: morph 8s ease-in-out infinite;
    }

    .morph-1 {
        width: 100px;
        height: 100px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .morph-2 {
        width: 150px;
        height: 150px;
        bottom: 10%;
        right: 10%;
        animation-delay: -2s;
    }

    .morph-3 {
        width: 80px;
        height: 80px;
        top: 60%;
        left: 20%;
        animation-delay: -4s;
    }

    .morph-4 {
        width: 120px;
        height: 120px;
        top: 20%;
        right: 20%;
        animation-delay: -6s;
    }

    @keyframes morph {
        0%, 100% {
            border-radius: 50%;
            transform: scale(1) rotate(0deg);
        }
        25% {
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
            transform: scale(1.1) rotate(90deg);
        }
        50% {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            transform: scale(1.2) rotate(180deg);
        }
        75% {
            border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
            transform: scale(1.1) rotate(270deg);
        }
    }
</style>

<div class="impossible-card" id="card">
    <div class="neon-glow"></div>
    <div class="impossible-border"></div>
    <div class="holographic-effect"></div>
    <div class="parallax-layer"></div>

    <div class="morphing-shapes">
        <div class="morph-shape morph-1"></div>
        <div class="morph-shape morph-2"></div>
        <div class="morph-shape morph-3"></div>
        <div class="morph-shape morph-4"></div>
    </div>

    <div class="card-face card-front">
        <div class="impossible-shape shape-1"></div>
        <div class="impossible-shape shape-2"></div>
        <div class="impossible-shape shape-3"></div>

        <i class="fa fa-download pdf-icon"></i>
        <h2 class="card-title">Answer Sheet PDF</h2>
        <p class="card-description">Answer sheet of first International nanoolympiad for students</p>
        <button class="btn-impossible" onclick="flipCard()">
            Explore Details
        </button>
        <div class="flip-hint">Click to flip the card</div>
    </div>

    <div class="card-face card-back">
        <div class="back-content">
            <i class="fa fa-download pdf-icon"></i>
            <h2 class="card-title">Download Now</h2>

            <div class="file-info">
                <div class="info-item">
                    <span class="info-label">File Size:</span>
                    <span class="info-value">1.52 MB</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Pages:</span>
                    <span class="info-value">21</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Format:</span>
                    <span class="info-value">PDF</span>
                </div>
            </div>

            <button class="btn-impossible" id="downloadBtn" onclick="window.open('https://ino-official.org/dl/answer_sheet.pdf', '_blank')">
                <i class="fa fa-download"></i> Download PDF
            </button>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function flipCard() {
        document.getElementById('card').classList.toggle('flipped');
    }

    $(document).ready(function() {
        // Download button animation
        $('#downloadBtn').click(function() {
            var $btn = $(this);
            var originalText = $btn.html();

            $btn.html('<i class="fa fa-spinner fa-spin"></i> Downloading...');
            $btn.prop('disabled', true);

            // Create ripple effect
            createRipple($btn);

            // Simulate download
            setTimeout(function() {
                $btn.html('<i class="fa fa-check"></i> Downloaded!');

                setTimeout(function() {
                    $btn.html(originalText);
                    $btn.prop('disabled', false);
                    flipCard(); // Flip back to front
                }, 2000);
            }, 2500);
        });

        // Create ripple effect on button click
        function createRipple($button) {
            $button.css('overflow', 'hidden');

            var ripple = $('<span class="ripple"></span>');
            $button.append(ripple);

            var diameter = Math.max($button.outerWidth(), $button.outerHeight());
            var radius = diameter / 2;

            ripple.css({
                width: diameter,
                height: diameter,
                top: '50%',
                left: '50%',
                transform: 'translate(-50%, -50%) scale(0)',
                'background': 'radial-gradient(circle, rgba(255,255,255,0.8) 0%, transparent 70%)',
                'position': 'absolute',
                'border-radius': '50%',
                'animation': 'ripple 0.6s linear'
            });

            setTimeout(function() {
                ripple.remove();
            }, 600);
        }

        // Add CSS for ripple animation
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                    @keyframes ripple {
                        to {
                            transform: translate(-50%, -50%) scale(4);
                            opacity: 0;
                        }
                    }
                `)
            .appendTo('head');

        // Mouse move parallax effect
        $(document).on('mousemove', function(e) {
            var card = $('.impossible-card');
            var cardOffset = card.offset();
            var cardWidth = card.outerWidth();
            var cardHeight = card.outerHeight();
            var cardCenterX = cardOffset.left + cardWidth / 2;
            var cardCenterY = cardOffset.top + cardHeight / 2;

            var mouseX = e.pageX - cardCenterX;
            var mouseY = e.pageY - cardCenterY;

            var rotateY = (mouseX / cardWidth) * 20;
            var rotateX = -(mouseY / cardHeight) * 20;

            card.css({
                'transform': `translateY(-10px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`
            });
        });

        // Reset rotation when mouse leaves
        $('.impossible-card').mouseleave(function() {
            $(this).css({
                'transform': 'translateY(0) rotateX(0) rotateY(0)'
            });
        });
    });
</script>