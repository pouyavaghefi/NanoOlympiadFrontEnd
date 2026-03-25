<style>

    /* All existing CSS remains the same */
    :root {
        --ino-gold: linear-gradient(135deg, #FFD700, #FFEC8B, #FFD700);
        --ino-silver: linear-gradient(135deg, #C0C0C0, #E8E8E8, #C0C0C0);
        --ino-bronze: linear-gradient(135deg, #CD7F32, #E6B17E, #CD7F32);
        --ino-primary: #1a237e;
        --ino-primary-light: #283593;
        --ino-dark: #121212;
        --ino-light: #f8f9fa;
        --ino-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --ino-transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .ino-body {
        font-family: 'Poppins', sans-serif;
        background:
            /* jQuery UI Sliders as background elements */
                linear-gradient(135deg, #0c0e2b 0%, #1a237e 50%, #0c0e2b 100%),
                    /* Slider track backgrounds */
                repeating-linear-gradient(90deg,
                rgba(255, 215, 0, 0.1) 0px,
                rgba(255, 215, 0, 0.1) 280px,
                transparent 280px,
                transparent 500px
                ),
                repeating-linear-gradient(90deg,
                rgba(192, 192, 192, 0.08) 0px,
                rgba(192, 192, 192, 0.08) 100px,
                transparent 100px,
                transparent 200px
                );
        color: var(--ino-light);
        line-height: 1.6;
        overflow-x: hidden;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        position: relative;
    }

    .ino-body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background:
            /* Slider handle indicators */
                radial-gradient(circle at 20% 30%, rgba(255, 215, 0, 0.3) 0%, transparent 5%),
                radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.2) 0%, transparent 3%),
                    /* Range indicators */
                radial-gradient(circle at 50% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 215, 0, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(192, 192, 192, 0.15) 0%, transparent 50%);
        z-index: -2;
    }

    .ino-body::after {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background:
            /* Slider track lines */
                linear-gradient(90deg, transparent 279px, rgba(255, 215, 0, 0.4) 280px, rgba(255, 215, 0, 0.4) 282px, transparent 283px),
                linear-gradient(90deg, transparent 99px, rgba(255, 255, 255, 0.3) 100px, rgba(255, 255, 255, 0.3) 102px, transparent 103px);
        pointer-events: none;
        z-index: -1;
        opacity: 0.6;
    }

    .ino-particles-js {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
    }

    .ino-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    .ino-header {
        text-align: center;
        padding: 4rem 1rem;
        position: relative;
        overflow: hidden;
    }

    .ino-header-content {
        position: relative;
        z-index: 2;
    }

    .ino-title {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(to right, #FFD700, #FFEC8B, #C0C0C0, #FFEC8B, #FFD700);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-align: center;
        animation: ino-title-glow 3s ease-in-out infinite alternate;
    }

    @keyframes ino-title-glow {
        0% {
            text-shadow:
                    0 0 5px rgba(255, 215, 0, 0.5),
                    0 0 10px rgba(255, 215, 0, 0.3),
                    0 0 15px rgba(255, 215, 0, 0.2),
                    0 0 20px rgba(255, 215, 0, 0.1);
        }
        100% {
            text-shadow:
                    0 0 10px rgba(255, 215, 0, 0.8),
                    0 0 20px rgba(255, 215, 0, 0.6),
                    0 0 30px rgba(255, 215, 0, 0.4),
                    0 0 40px rgba(255, 215, 0, 0.2),
                    0 0 50px rgba(255, 215, 0, 0.1);
        }
    }

    .ino-subtitle {
        font-size: 1.6rem;
        margin-bottom: 2rem;
        opacity: 0.9;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        animation: ino-fadeIn 2s ease-out;
    }

    .ino-hosted-by {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        padding: 0.8rem 2rem;
        border-radius: 50px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-weight: 100;
        animation: ino-bounceIn 1s ease-out;
    }

    .ino-medal-filters {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin: 3rem 0;
        flex-wrap: wrap;
    }

    .ino-filter-btn {
        padding: 1.2rem 2.5rem;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: var(--ino-transition);
        display: flex;
        align-items: center;
        gap: 0.8rem;
        box-shadow: var(--ino-shadow);
        position: relative;
        overflow: hidden;
        transform-style: preserve-3d;
        perspective: 1000px;
    }

    .ino-filter-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: 0.8s;
    }

    .ino-filter-btn:hover::before {
        left: 100%;
    }

    .ino-filter-btn.ino-active {
        transform: translateY(-8px) scale(1.05);
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.3);
    }

    .ino-filter-btn.ino-gold {
        background: var(--ino-gold);
        color: #8B7500;
    }

    .ino-filter-btn.ino-silver {
        background: var(--ino-silver);
        color: #5A5A5A;
    }

    .ino-filter-btn.ino-bronze {
        background: var(--ino-bronze);
        color: #8B4513;
    }

    .ino-filter-btn.ino-all {
        background: var(--ino-primary-light);
        color: white;
    }

    .ino-stats-container {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin: 3rem 0;
        flex-wrap: wrap;
    }

    .ino-stat-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: var(--ino-transition);
        min-width: 200px;
        position: relative;
        overflow: hidden;
    }

    .ino-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
    }

    .ino-stat-card:nth-child(1)::before {
        background: linear-gradient(90deg, #FFD700, #FFEC8B, #C0C0C0, #CD7F32);
    }
    .ino-stat-card:nth-child(2)::before {
        background: var(--ino-gold);
    }
    .ino-stat-card:nth-child(3)::before {
        background: var(--ino-silver);
    }
    .ino-stat-card:nth-child(4)::before {
        background: var(--ino-bronze);
    }

    .ino-stat-card:hover {
        transform: translateY(-15px) rotateX(5deg);
        box-shadow: 0 25px 40px rgba(0, 0, 0, 0.25);
        background: rgba(255, 255, 255, 0.15);
    }

    .ino-stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        background: linear-gradient(to right, #FFD700, #FFEC8B, #C0C0C0);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .ino-stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
        font-weight: 500;
    }

    .ino-winners-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2.5rem;
        margin-top: 3rem;
    }

    .ino-winner-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 25px;
        padding: 2.5rem;
        transition: var(--ino-transition);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        opacity: 0;
        transform: translateY(50px) rotateY(10deg);
        animation: ino-fadeInUp 0.8s forwards;
        transform-style: preserve-3d;
        cursor: pointer;
    }

    @keyframes ino-fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0) rotateY(0);
        }
    }

    .ino-winner-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
    }

    .ino-winner-card.ino-gold::before {
        background: var(--ino-gold);
    }

    .ino-winner-card.ino-silver::before {
        background: var(--ino-silver);
    }

    .ino-winner-card.ino-bronze::before {
        background: var(--ino-bronze);
    }

    .ino-winner-card:hover {
        transform: translateY(-15px) rotateX(5deg) scale(1.03);
        box-shadow: 0 30px 50px rgba(0, 0, 0, 0.3);
        background: rgba(255, 255, 255, 0.15);
    }

    .ino-medal-badge {
        position: absolute;
        top: 2rem;
        right: 2rem;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        animation: ino-rotate 10s linear infinite;
        transform-style: preserve-3d;
    }

    @keyframes ino-rotate {
        from {
            transform: rotateY(0);
        }
        to {
            transform: rotateY(360deg);
        }
    }

    .ino-gold .ino-medal-badge {
        background: var(--ino-gold);
        color: #8B7500;
    }

    .ino-silver .ino-medal-badge {
        background: var(--ino-silver);
        color: #5A5A5A;
    }

    .ino-bronze .ino-medal-badge {
        background: var(--ino-bronze);
        color: #8B4513;
    }

    .ino-winner-name {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 1.2rem;
        padding-right: 80px;
        background: linear-gradient(to right, #ffffff, #e0e0e0);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .ino-winner-country {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.8rem;
    }

    .ino-flag {
        width: 40px;
        height: 25px;
        border-radius: 4px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: var(--ino-transition);
    }

    .ino-winner-card:hover .ino-flag {
        transform: scale(1.2) rotate(5deg);
    }

    .ino-country-name {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .ino-winner-info {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .ino-winner-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: var(--ino-transition);
    }

    .ino-winner-card:hover .ino-winner-avatar {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .ino-winner-details {
        flex: 1;
    }

    .ino-winner-quote {
        font-style: italic;
        opacity: 0.9;
        font-size: 1rem;
        margin-top: 0.8rem;
        position: relative;
        padding-left: 1.5rem;
    }

    .ino-winner-quote::before {
        content: '"';
        position: absolute;
        left: 0;
        top: -0.5rem;
        font-size: 2rem;
        opacity: 0.7;
    }

    .ino-celebration {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 100;
        display: none;
    }

    .ino-confetti {
        position: absolute;
        width: 12px;
        height: 25px;
        background: var(--ino-confetti-color, #FFD700);
        top: -25px;
        animation: ino-fall linear forwards;
        border-radius: 2px;
    }

    @keyframes ino-fall {
        to {
            transform: translateY(100vh) rotate(720deg);
        }
    }

    .ino-footer {
        text-align: center;
        padding: 4rem 1rem;
        margin-top: 6rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .ino-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
    }

    .ino-footer-content {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .ino-footer-logo {
        font-size: 3rem;
        margin-bottom: 1.5rem;
        color: #FFD700;
        animation: ino-pulse 2s infinite alternate;
    }

    @keyframes ino-pulse {
        from {
            transform: scale(1);
        }
        to {
            transform: scale(1.1);
        }
    }

    .ino-social-links {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        margin: 2.5rem 0;
    }

    .ino-social-link {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: var(--ino-transition);
        position: relative;
        overflow: hidden;
    }

    .ino-social-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: 0.5s;
    }

    .ino-social-link:hover::before {
        left: 100%;
    }

    .ino-social-link:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-8px) scale(1.1);
    }

    .ino-copyright {
        opacity: 0.8;
        font-size: 1rem;
    }

    /* New floating elements */
    .ino-floating-medal {
        position: fixed;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        z-index: -1;
        opacity: 0.2;
        animation: ino-float 15s infinite linear;
    }

    @keyframes ino-float {
        0% {
            transform: translateY(0) rotate(0);
        }
        50% {
            transform: translateY(-30px) rotate(180deg);
        }
        100% {
            transform: translateY(0) rotate(360deg);
        }
    }

    .ino-floating-medal:nth-child(1) {
        top: 10%;
        left: 5%;
        background: var(--ino-gold);
        animation-delay: 0s;
    }

    .ino-floating-medal:nth-child(2) {
        top: 70%;
        left: 10%;
        background: var(--ino-silver);
        animation-delay: -5s;
    }

    .ino-floating-medal:nth-child(3) {
        top: 20%;
        right: 5%;
        background: var(--ino-bronze);
        animation-delay: -10s;
    }

    .ino-floating-medal:nth-child(4) {
        top: 80%;
        right: 10%;
        background: var(--ino-gold);
        animation-delay: -7s;
    }

    /* Country filter */
    .ino-country-filter {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin: 2rem 0;
        flex-wrap: wrap;
    }

    .ino-country-btn {
        padding: 0.7rem 1.5rem;
        border: none;
        border-radius: 30px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-weight: 500;
        cursor: pointer;
        transition: var(--ino-transition);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .ino-country-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    .ino-country-btn.ino-active {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .ino-title {
            font-size: 2.8rem;
        }

        .ino-medal-filters {
            flex-wrap: wrap;
        }

        .ino-stats-container {
            flex-wrap: wrap;
        }

        .ino-winners-container {
            grid-template-columns: 1fr;
        }

        .ino-filter-btn {
            padding: 1rem 2rem;
        }
    }

    .ino-footer {
        padding: 3rem 1rem;
        border-top: 1px solid rgba(100, 100, 255, 0.2);
        margin-top: auto;
    }

    .ino-footer-content {
        max-width: 1200px;
        margin: 0 auto;
        text-align: center;
    }

    .ino-footer-logo {
        font-size: 3rem;
        color: #4d9aff;
        margin-bottom: 1.5rem;
        text-shadow: 0 0 10px #4d9aff, 0 0 20px #4d9aff;
        animation: pulse 2s infinite alternate;
    }

    @keyframes pulse {
        0% {
            text-shadow: 0 0 10px #4d9aff, 0 0 20px #4d9aff;
        }
        100% {
            text-shadow: 0 0 15px #4d9aff, 0 0 30px #4d9aff, 0 0 40px #4d9aff;
        }
    }

    /* Neon Text Effect for h3 */
    .ino-footer h3 {
        font-size: 2.2rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: #fff;
        text-shadow:
                0 0 5px #fff,
                0 0 10px #fff,
                0 0 15px #fff,
                0 0 20px #4d9aff,
                0 0 35px #4d9aff,
                0 0 40px #4d9aff,
                0 0 50px #4d9aff,
                0 0 75px #4d9aff;
        animation: neon-flicker 3s infinite alternate;
        margin-bottom: 1.5rem;
    }

    @keyframes neon-flicker {
        0%, 18%, 22%, 25%, 53%, 57%, 100% {
            text-shadow:
                    0 0 5px #fff,
                    0 0 10px #fff,
                    0 0 15px #fff,
                    0 0 20px #4d9aff,
                    0 0 35px #4d9aff,
                    0 0 40px #4d9aff,
                    0 0 50px #4d9aff,
                    0 0 75px #4d9aff;
        }
        20%, 24%, 55% {
            text-shadow:
                    0 0 2px #fff,
                    0 0 5px #fff,
                    0 0 7px #fff,
                    0 0 10px #4d9aff,
                    0 0 17px #4d9aff,
                    0 0 20px #4d9aff,
                    0 0 25px #4d9aff,
                    0 0 37px #4d9aff;
        }
    }

    .ino-footer p {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 1rem;
        color: #b8c7ff;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .ino-copyright {
        font-size: 0.9rem;
        color: #8a9bff;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(100, 100, 255, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .ino-footer h3 {
            font-size: 1.8rem;
            letter-spacing: 2px;
        }

        .ino-footer-logo {
            font-size: 2.5rem;
        }
    }

    .ino-footer p {
        max-width: 600px;
        margin: 15px auto;
        font-size: 1rem;
        color: #ccc;
        line-height: 1.6;
        animation: fadeInUp 2s ease-in-out;
        position: relative;
    }

    .ino-footer p::before {
        content: "✦";
        color: #FFD700;
        position: absolute;
        left: -20px;
        opacity: 0.7;
        animation: sparkle 3s infinite ease-in-out;
    }

    .ino-hosted-by {
        color: #fff;
        font-size: 1.5rem;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 4px;
        text-shadow:
                0 0 5px #0fa,
                0 0 10px #0fa,
                0 0 20px #0fa,
                0 0 40px #0fa,
                0 0 80px #0fa;
        animation: neon-flicker 2s infinite alternate;
        padding: 20px;
        border-radius: 10px;
    }

    @keyframes neon-flicker {
        0%, 19%, 21%, 23%, 25%, 54%, 56%, 100% {
            text-shadow:
                    0 0 5px #0fa,
                    0 0 10px #0fa,
                    0 0 20px #0fa,
                    0 0 40px #0fa,
                    0 0 80px #0fa;
            opacity: 1;
        }
        20%, 24%, 55% {
            text-shadow:
                    0 0 2px #0fa,
                    0 0 5px #0fa,
                    0 0 10px #0fa,
                    0 0 20px #0fa,
                    0 0 40px #0fa;
            opacity: 0.9;
        }
    }

    @media (max-width: 480px) {
        .ino-footer h3 {
            font-size: 1.4rem;
            letter-spacing: 1px;
        }

        .ino-footer-logo {
            font-size: 2rem;
        }

        .ino-footer p {
            font-size: 1rem;
        }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes sparkle {
        0%, 100% { opacity: 0.7; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.3); }
    }

    .ino-footer p:hover {
        color: #fff;
        text-shadow: 0 0 10px #FFD700;
        transition: 0.3s;
    }

    .ino-footer-logo i {
        display: inline-block;
        font-size: 40px;
        color: #FFD700;
        animation: spin 4s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* New styles for celebration effects */
    .ino-celebration {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 100;
        display: none;
    }

    .ino-confetti {
        position: absolute;
        width: 12px;
        height: 25px;
        background: var(--ino-confetti-color, #FFD700);
        top: -25px;
        animation: ino-fall linear forwards;
        border-radius: 2px;
    }

    @keyframes ino-fall {
        to {
            transform: translateY(100vh) rotate(720deg);
        }
    }

    .ino-sparkle {
        position: absolute;
        width: 10px;
        height: 10px;
        background: #FFD700;
        border-radius: 50%;
        animation: ino-sparkle-fall 2s linear forwards;
        box-shadow: 0 0 10px #FFD700;
    }

    @keyframes ino-sparkle-fall {
        0% {
            transform: translateY(-10px) scale(0);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) scale(1);
            opacity: 0;
        }
    }

    .ino-winner-card.ino-celebrating {
        animation: ino-celebrate 0.8s ease-out;
    }

    @keyframes ino-celebrate {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    /* scroll reveal - styles */
    .ino-winners-container .ino-winner-card {
        opacity: 0;
        transform: translateY(28px) scale(.98);
        filter: blur(6px) saturate(.95);
        transition:
                opacity .75s cubic-bezier(.2,.9,.3,1) var(--delay,0s),
                transform .78s cubic-bezier(.2,.9,.3,1) var(--delay,0s),
                filter .6s var(--delay,0s),
                box-shadow .6s var(--delay,0s);
        will-change: transform, opacity, filter;
        backface-visibility: hidden;
        perspective: 1000px;
    }

    /* variant presets */
    .ino-winners-container .ino-winner-card[data-effect="left"] {
        transform: translateX(-60px) translateY(10px) scale(.97);
    }
    .ino-winners-container .ino-winner-card[data-effect="right"] {
        transform: translateX(60px) translateY(10px) scale(.97);
    }
    .ino-winners-container .ino-winner-card[data-effect="zoom"] {
        transform: translateY(30px) scale(.82);
    }
    .ino-winners-container .ino-winner-card[data-effect="rotate"] {
        transform: translateY(18px) rotateX(18deg);
        transform-origin: top center;
    }
    .ino-winners-container .ino-winner-card[data-effect="flip"] {
        transform: translateY(8px) rotateY(88deg);
        transform-origin: left center;
    }

    /* reveal state */
    .ino-winners-container .ino-winner-card.visible {
        opacity: 1;
        transform: none;
        filter: none;
    }

    /* medal pop */
    .ino-winners-container .ino-winner-card .ino-medal-badge {
        transform-origin: center;
        opacity: 0;
        transform: translateY(-8px) scale(.6);
        transition: transform .6s cubic-bezier(.2,.9,.3,1) var(--delay,0s),
        opacity .5s var(--delay,0s);
    }
    .ino-winners-container .ino-winner-card.visible .ino-medal-badge {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* subtle shine sweep */
    .ino-winners-container .ino-winner-card::after {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        background: linear-gradient(120deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.08) 18%, rgba(255,255,255,0) 40%);
        transform: translateX(-120%);
        transition: transform .95s cubic-bezier(.2,.9,.3,1) var(--delay,0s), opacity .6s var(--delay,0s);
        opacity: 0;
        mix-blend-mode: screen;
    }
    .ino-winners-container .ino-winner-card.visible::after {
        transform: translateX(120%);
        opacity: 1;
    }

    /* color-tailored glow when revealed */
    .ino-winners-container .ino-winner-card.visible.ino-gold { box-shadow: 0 20px 45px rgba(255,200,30,0.12); }
    .ino-winners-container .ino-winner-card.visible.ino-silver { box-shadow: 0 16px 36px rgba(180,180,190,0.08); }
    .ino-winners-container .ino-winner-card.visible.ino-bronze { box-shadow: 0 14px 32px rgba(200,120,60,0.07); }

    /* accessibility: reduce motion */
    @media (prefers-reduced-motion: reduce) {
        .ino-winners-container .ino-winner-card,
        .ino-winners-container .ino-winner-card .ino-medal-badge,
        .ino-winners-container .ino-winner-card::after {
            transition: none !important;
            transform: none !important;
            opacity: 1 !important;
            filter: none !important;
        }
    }

    /* Sphere Visualization Styles */
    .ino-sphere-container {
        position: fixed;
        top: 50%;
        right: 50px;
        transform: translateY(-50%);
        z-index: 10;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        min-width: 350px;
    }

    #ino-sphere-visualization {
        position: relative;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .ino-sphere {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%,
        rgba(255, 215, 0, 0.8) 0%,
        rgba(255, 215, 0, 0.4) 30%,
        rgba(255, 215, 0, 0.2) 70%,
        transparent 100%);
        box-shadow:
                0 0 50px rgba(255, 215, 0, 0.6),
                inset 0 0 50px rgba(255, 255, 255, 0.3);
        animation: ino-sphere-rotate 20s infinite linear;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .ino-sphere.ino-secondary {
        background: radial-gradient(circle at 30% 30%,
        rgba(192, 192, 192, 0.6) 0%,
        rgba(192, 192, 192, 0.3) 30%,
        rgba(192, 192, 192, 0.15) 70%,
        transparent 100%);
        box-shadow:
                0 0 30px rgba(192, 192, 192, 0.4),
                inset 0 0 30px rgba(255, 255, 255, 0.2);
        animation: ino-sphere-rotate 15s infinite linear reverse;
    }

    @keyframes ino-sphere-rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .ino-slider-controls {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .ino-slider-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .ino-slider-group label {
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .ino-slider {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        height: 8px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .ino-slider .ui-slider-handle {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--ino-gold);
        border: 2px solid white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .ino-slider .ui-slider-handle:hover {
        transform: scale(1.2);
        box-shadow: 0 0 15px rgba(255, 215, 0, 0.8);
    }

    /* Update the existing body background to remove conflicting gradients */
    .ino-body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #0c0e2b 0%, #1a237e 50%, #0c0e2b 100%);
        color: var(--ino-light);
        line-height: 1.6;
        overflow-x: hidden;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        position: relative;
    }

    /* Particle effects from bottom to top */
    .ino-rising-particles {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
        overflow: hidden;
    }

    .ino-rising-particle {
        position: absolute;
        bottom: -20px;
        width: 4px;
        height: 4px;
        background: rgba(255, 215, 0, 0.6);
        border-radius: 50%;
        animation: ino-rise linear forwards;
        box-shadow: 0 0 8px rgba(255, 215, 0, 0.8);
    }

    .ino-rising-particle.silver {
        background: rgba(192, 192, 192, 0.6);
        box-shadow: 0 0 8px rgba(192, 192, 192, 0.8);
    }

    .ino-rising-particle.bronze {
        background: rgba(205, 127, 50, 0.6);
        box-shadow: 0 0 8px rgba(205, 127, 50, 0.8);
    }

    @keyframes ino-rise {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) rotate(360deg);
            opacity: 0;
        }
    }

    /* Popup Modal Styles */
    .ino-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(10px);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .ino-popup-overlay.active {
        opacity: 1;
    }

    .ino-popup-content {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 3rem;
        max-width: 500px;
        width: 90%;
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        transform: scale(0.7);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .ino-popup-overlay.active .ino-popup-content {
        transform: scale(1);
    }

    .ino-popup-close {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        background: none;
        border: none;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--ino-transition);
    }

    .ino-popup-close:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);
    }

    .ino-popup-medal {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        animation: ino-rotate 8s linear infinite;
    }

    .ino-popup-medal.gold {
        background: var(--ino-gold);
        color: #8B7500;
    }

    .ino-popup-medal.silver {
        background: var(--ino-silver);
        color: #5A5A5A;
    }

    .ino-popup-medal.bronze {
        background: var(--ino-bronze);
        color: #8B4513;
    }

    .ino-popup-name {
        font-size: 2.2rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 1.5rem;
        background: linear-gradient(to right, #ffffff, #e0e0e0);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .ino-popup-country {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .ino-popup-flag {
        width: 50px;
        display:none;
        height: 30px;
        border-radius: 5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .ino-popup-country-name {
        font-size: 1.3rem;
        font-weight: 600;
    }

    .ino-popup-details {
        text-align: center;
        margin-bottom: 2rem;
    }

    .ino-popup-medal-type {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        display: inline-block;
    }

    .ino-popup-medal-type.gold {
        background: rgba(255, 215, 0, 0.2);
        color: #FFD700;
    }

    .ino-popup-medal-type.silver {
        background: rgba(192, 192, 192, 0.2);
        color: #C0C0C0;
    }

    .ino-popup-medal-type.bronze {
        background: rgba(205, 127, 50, 0.2);
        color: #CD7F32;
    }

    .ino-popup-quote {
        font-style: italic;
        font-size: 1.1rem;
        opacity: 0.9;
        margin-top: 1.5rem;
        position: relative;
        padding: 0 2rem;
    }

    .ino-popup-quote::before,
    .ino-popup-quote::after {
        content: '';
        position: absolute;
        font-size: 2rem;
        opacity: 0.7;
    }

    .ino-popup-quote::before {
        left: 0;
        top: -0.5rem;
    }

    .ino-popup-quote::after {
        right: 0;
        bottom: -1rem;
    }

    .ino-footer-logo i {
        display: inline-block; /* already correct */
        transform-origin: center; /* ensure rotation around center */
        animation: spin 4s linear infinite;
        font-size: 2rem;
        color: #FFD700;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }

    .ino-footer-logo span {
        display: inline-block;
        animation: spin 4s linear infinite;
        transform-origin: center;
    }

</style>

<div class="ino-body">
    <!-- Floating medals -->
    <div class="ino-floating-medal"><i class="fas fa-medal"></i></div>
    <div class="ino-floating-medal"><i class="fas fa-medal"></i></div>
    <div class="ino-floating-medal"><i class="fas fa-medal"></i></div>
    <div class="ino-floating-medal"><i class="fas fa-medal"></i></div>

    <!-- Rising particles container -->
    <div class="ino-rising-particles" id="ino-rising-particles"></div>

    <!-- Celebration container -->
    <div id="ino-celebration" class="ino-celebration"></div>

    <!-- Popup Modal -->
    <div class="ino-popup-overlay" id="ino-popup-overlay">
        <div class="ino-popup-content">
            <button class="ino-popup-close" id="ino-popup-close">&times;</button>
            <div class="ino-popup-medal" id="ino-popup-medal">
                <i class="fas fa-medal"></i>
            </div>
            <h2 class="ino-popup-name" id="ino-popup-name"></h2>
            <div class="ino-popup-country">
                <div class="ino-popup-flag" id="ino-popup-flag"></div>
                <span class="ino-popup-country-name" id="ino-popup-country-name"></span>
            </div>
            <div class="ino-popup-details">
                <div class="ino-popup-medal-type" id="ino-popup-medal-type"></div>
                <p class="ino-popup-quote" id="ino-popup-quote"></p>
            </div>
        </div>
    </div>

    <div id="ino-particles-js" class="ino-particles-js"></div>

    <div class="ino-container">
        <header class="ino-header">
            <div class="ino-header-content">
                <h1 class="ino-title">International Nanotechnology Olympiad</h1>
                <p class="ino-subtitle">Celebrating the brightest young minds in nanotechnology from around the World</p>
                <div class="ino-hosted-by">Hosted by Islamic Republic of Iran</div>

                <div class="ino-medal-filters">
                    <button class="ino-filter-btn ino-gold" data-filter="gold">
                        <i class="fas fa-medal"></i> Gold Medals
                    </button>
                    <button class="ino-filter-btn ino-silver" data-filter="silver">
                        <i class="fas fa-medal"></i> Silver Medals
                    </button>
                    <button class="ino-filter-btn ino-bronze" data-filter="bronze">
                        <i class="fas fa-medal"></i> Bronze Medals
                    </button>
                </div>

                <div class="ino-stats-container">
                    <div class="ino-stat-card">
                        <div class="ino-stat-number">11</div>
                        <div class="ino-stat-label">Gold Medals</div>
                    </div>
                    <div class="ino-stat-card">
                        <div class="ino-stat-number">5</div>
                        <div class="ino-stat-label">Silver Medals</div>
                    </div>
                    <div class="ino-stat-card">
                        <div class="ino-stat-number">6</div>
                        <div class="ino-stat-label">Bronze Medals</div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <div class="ino-winners-container" id="ino-winnersContainer">
                <!-- Gold Medal Winners -->
                <div class="ino-winner-card ino-gold" data-country="iran" data-medal="gold" data-name="Parsa Aghasi">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Parsa Aghasi</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(135deg, #239F40 50%, #DA0000 50%);"></div>
                        <span class="ino-country-name">Iran</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="iran" data-medal="gold" data-name="Soroush Ali Mohammadi">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Soroush Ali Mohammadi</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(135deg, #239F40 50%, #DA0000 50%);"></div>
                        <span class="ino-country-name">Iran</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="iran" data-medal="gold" data-name="Hesam Sahranavard">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Hesam Sahranavard</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(135deg, #239F40 50%, #DA0000 50%);"></div>
                        <span class="ino-country-name">Iran</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="iran" data-medal="gold" data-name="Amir Ali Khayyati">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Amir Ali Khayyati</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(135deg, #239F40 50%, #DA0000 50%);"></div>
                        <span class="ino-country-name">Iran</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="iran" data-medal="gold" data-name="Seyed Mohammad Mahdi Hosseini Sharif">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Seyed Mohammad Mahdi Hosseini Sharif</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(135deg, #239F40 50%, #DA0000 50%);"></div>
                        <span class="ino-country-name">Iran</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="iran" data-medal="gold" data-name="Hooman Aziminia">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Hooman Aziminia</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(135deg, #239F40 50%, #DA0000 50%);"></div>
                        <span class="ino-country-name">Iran</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="iran" data-medal="gold" data-name="Ali Hazrati">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Ali Hazrati</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(135deg, #239F40 50%, #DA0000 50%);"></div>
                        <span class="ino-country-name">Iran</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="iran" data-medal="gold" data-name="Yasin Talebiyan Rizi">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Yasin Talebiyan Rizi</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(135deg, #239F40 50%, #DA0000 50%);"></div>
                        <span class="ino-country-name">Iran</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="malaysia" data-medal="gold" data-name="Shajeev Krsna Maheswaran">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Shajeev Krsna Maheswaran</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cc0001 50%, white 50%);"></div>
                        <span class="ino-country-name">Malaysia</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="malaysia" data-medal="gold" data-name="Nour Iddeen Mohd Afif">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Nour Iddeen Mohd Afif</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cc0001 50%, white 50%);"></div>
                        <span class="ino-country-name">Malaysia</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-gold" data-country="venezuela" data-medal="gold" data-name="Juan Jose Martinez Barreto">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Juan Jose Martinez Barreto</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cf142b 33%, #00247D 33%, #00247D 66%, #FFCC00 66%);"></div>
                        <span class="ino-country-name">Venezuela</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Gold Medalist</div>
                        </div>
                    </div>
                </div>

                <!-- Silver Medal Winners -->
                <div class="ino-winner-card ino-silver" data-country="iran" data-medal="silver" data-name="Ali Shamsi Mofakhar">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Ali Shamsi Mofakhar</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(135deg, #239F40 50%, #DA0000 50%);"></div>
                        <span class="ino-country-name">Iran</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Silver Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-silver" data-country="venezuela" data-medal="silver" data-name="Caridad Guerrero">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Caridad Guerrero</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cf142b 33%, #00247D 33%, #00247D 66%, #FFCC00 66%);"></div>
                        <span class="ino-country-name">Venezuela</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Silver Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-silver" data-country="thailand" data-medal="silver" data-name="Jarupat Bulpakdi">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Jarupat Bulpakdi</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #ED1C24 33%, white 33%, white 66%, #ED1C24 66%);"></div>
                        <span class="ino-country-name">Thailand</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Silver Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-silver" data-country="venezuela" data-medal="silver" data-name="Samuel Galban">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Samuel Galban</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cf142b 33%, #00247D 33%, #00247D 66%, #FFCC00 66%);"></div>
                        <span class="ino-country-name">Venezuela</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Silver Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-silver" data-country="saudi-arabia" data-medal="silver" data-name="Abdullah Alzahrani">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Abdullah Alzahrani</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag"><img src="https://admin.nanolympiad.org/members-country/sa.png"></div>
                        <span class="ino-country-name">Saudi Arabia</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Silver Medalist</div>
                        </div>
                    </div>
                </div>

                <!-- Bronze Medal Winners -->
                <div class="ino-winner-card ino-bronze" data-country="malaysia" data-medal="bronze" data-name="Muhammad Ammar bin Abdul Halim">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Muhammad Ammar bin Abdul Halim</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cc0001 50%, white 50%);"></div>
                        <span class="ino-country-name">Malaysia</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Bronze Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-bronze" data-country="venezuela" data-medal="bronze" data-name="Luis Bermudez">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Luis Bermudez</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cf142b 33%, #00247D 33%, #00247D 66%, #FFCC00 66%);"></div>
                        <span class="ino-country-name">Venezuela</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Bronze Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-bronze" data-country="venezuela" data-medal="bronze" data-name="Isis Camacho">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Isis Camacho</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cf142b 33%, #00247D 33%, #00247D 66%, #FFCC00 66%);"></div>
                        <span class="ino-country-name">Venezuela</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Bronze Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-bronze" data-country="venezuela" data-medal="bronze" data-name="Paola Planas">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Paola Planas</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cf142b 33%, #00247D 33%, #00247D 66%, #FFCC00 66%);"></div>
                        <span class="ino-country-name">Venezuela</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Bronze Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-bronze" data-country="malaysia" data-medal="bronze" data-name="Mirza Zahirah bt Mazlan">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Mirza Zahirah bt Mazlan</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cc0001 50%, white 50%);"></div>
                        <span class="ino-country-name">Malaysia</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Bronze Medalist</div>
                        </div>
                    </div>
                </div>

                <div class="ino-winner-card ino-bronze" data-country="malaysia" data-medal="bronze" data-name="Nur Qaireen Alisha Binti Rozman">
                    <div class="ino-medal-badge">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="ino-winner-name">Nur Qaireen Alisha Binti Rozman</h3>
                    <div class="ino-winner-country">
                        <div class="ino-flag" style="background: linear-gradient(to bottom, #cc0001 50%, white 50%);"></div>
                        <span class="ino-country-name">Malaysia</span>
                    </div>
                    <div class="ino-winner-info">
                        <div class="ino-winner-avatar">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="ino-winner-details">
                            <div>Bronze Medalist</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <br>

        <footer class="ino-footer">
            <div class="ino-footer-content">
                <div class="ino-footer-logo">
                    <span><i class="fas fa-atom"></i></span>
                </div>

                <h3><a title="ino-official" href="http://ino-official.org"><span>INO</span><span>-Official.org</span></a></h3>
                <p>Congratulations to all winners of the 1st International Nanotechnology Olympiad for High School Students</p>

                <p class="ino-copyright">© 2025 International Nanotechnology Olympiad. All rights reserved <small style="font-size:10px"></small></p>
            </div>
        </footer>

        @include('layouts.includes.gadgets.correct_answers')

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

    <script>
        // Rising particles effect
        function createRisingParticles() {
            const container = document.getElementById('ino-rising-particles');
            const colors = ['gold', 'silver', 'bronze'];

            setInterval(() => {
                const particle = document.createElement('div');
                particle.className = `ino-rising-particle ${colors[Math.floor(Math.random() * colors.length)]}`;
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.animationDuration = (Math.random() * 10 + 5) + 's';
                particle.style.animationDelay = (Math.random() * 2) + 's';
                container.appendChild(particle);

                // Remove particle after animation
                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.parentNode.removeChild(particle);
                    }
                }, 15000);
            }, 100);
        }

        // Popup functionality
        document.addEventListener('DOMContentLoaded', function() {
            const winnerCards = document.querySelectorAll('.ino-winner-card');
            const popupOverlay = document.getElementById('ino-popup-overlay');
            const popupClose = document.getElementById('ino-popup-close');
            const popupName = document.getElementById('ino-popup-name');
            const popupMedal = document.getElementById('ino-popup-medal');
            const popupFlag = document.getElementById('ino-popup-flag');
            const popupCountryName = document.getElementById('ino-popup-country-name');
            const popupMedalType = document.getElementById('ino-popup-medal-type');
            const popupQuote = document.getElementById('ino-popup-quote');

            // Add click event to all winner cards
            winnerCards.forEach(card => {
                card.addEventListener('click', function() {
                    const name = this.getAttribute('data-name');
                    const medal = this.getAttribute('data-medal');
                    const country = this.getAttribute('data-country');
                    const quote = this.getAttribute('data-quote');

                    // Get flag from the card
                    const flagElement = this.querySelector('.ino-flag');
                    const flagStyle = flagElement.style.background;

                    // Get country name from the card
                    const countryName = this.querySelector('.ino-country-name').textContent;

                    // Update popup content
                    popupName.textContent = name;
                    popupQuote.textContent = quote;
                    popupCountryName.textContent = countryName.toUpperCase();
                    popupFlag.style.background = flagStyle;

                    // Update medal type and styling
                    popupMedal.className = `ino-popup-medal ${medal}`;
                    popupMedalType.className = `ino-popup-medal-type ${medal}`;

                    switch(medal) {
                        case 'gold':
                            popupMedalType.textContent = 'Gold Medalist';
                            break;
                        case 'silver':
                            popupMedalType.textContent = 'Silver Medalist';
                            break;
                        case 'bronze':
                            popupMedalType.textContent = 'Bronze Medalist';
                            break;
                    }

                    // Show popup
                    popupOverlay.style.display = 'flex';
                    setTimeout(() => {
                        popupOverlay.classList.add('active');
                    }, 10);
                });
            });

            // Close popup
            popupClose.addEventListener('click', function() {
                popupOverlay.classList.remove('active');
                setTimeout(() => {
                    popupOverlay.style.display = 'none';
                }, 300);
            });

            // Close popup when clicking outside
            popupOverlay.addEventListener('click', function(e) {
                if (e.target === popupOverlay) {
                    popupOverlay.classList.remove('active');
                    setTimeout(() => {
                        popupOverlay.style.display = 'none';
                    }, 300);
                }
            });

            // Start rising particles
            createRisingParticles();
        });

        // Filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.ino-filter-btn');
            const winnerCards = document.querySelectorAll('.ino-winner-card');
            const celebrationContainer = document.getElementById('ino-celebration');

            // Initialize with all winners visible
            filterWinners('all');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');

                    // Update active button
                    filterButtons.forEach(btn => btn.classList.remove('ino-active'));
                    this.classList.add('ino-active');

                    // Filter winners
                    filterWinners(filter);

                    // Trigger celebration effect
                    triggerCelebration(filter);
                });
            });

            function filterWinners(filter) {
                winnerCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0) rotateY(0)';
                        }, 50);
                    } else {
                        if (card.classList.contains(`ino-${filter}`)) {
                            card.style.display = 'block';
                            setTimeout(() => {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0) rotateY(0)';
                            }, 50);
                        } else {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(50px) rotateY(10deg)';
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 500);
                        }
                    }
                });
            }

            function triggerCelebration(filter) {
                // Clear previous celebration
                celebrationContainer.innerHTML = '';
                celebrationContainer.style.display = 'block';

                // Create confetti based on filter
                let colors;
                switch(filter) {
                    case 'gold':
                        colors = ['#FFD700', '#FFEC8B', '#FFA500'];
                        break;
                    case 'silver':
                        colors = ['#C0C0C0', '#E8E8E8', '#A9A9A9'];
                        break;
                    case 'bronze':
                        colors = ['#CD7F32', '#E6B17E', '#8B4513'];
                        break;
                    default:
                        colors = ['#FFD700', '#C0C0C0', '#CD7F32', '#4d9aff', '#0fa'];
                }

                // Create confetti
                for (let i = 0; i < 150; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'ino-confetti';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    confetti.style.animationDelay = (Math.random() * 5) + 's';
                    confetti.style.setProperty('--ino-confetti-color', colors[Math.floor(Math.random() * colors.length)]);
                    celebrationContainer.appendChild(confetti);
                }

                // Create sparkles
                for (let i = 0; i < 50; i++) {
                    const sparkle = document.createElement('div');
                    sparkle.className = 'ino-sparkle';
                    sparkle.style.left = Math.random() * 100 + 'vw';
                    sparkle.style.animationDuration = (Math.random() * 2 + 1) + 's';
                    sparkle.style.animationDelay = (Math.random() * 2) + 's';
                    sparkle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    celebrationContainer.appendChild(sparkle);
                }

                // Animate visible cards
                const visibleCards = document.querySelectorAll(`.ino-winner-card.ino-${filter}`);
                visibleCards.forEach((card, index) => {
                    setTimeout(() => {
                        card.classList.add('ino-celebrating');
                        setTimeout(() => {
                            card.classList.remove('ino-celebrating');
                        }, 800);
                    }, index * 100);
                });

                // Hide celebration after animation
                setTimeout(() => {
                    celebrationContainer.style.display = 'none';
                }, 5000);
            }
        });

        // Existing flag loading function
        async function loadFlags() {
            try {
                const res = await fetch("https://flagcdn.com/en/codes.json");
                if (!res.ok) throw new Error("Failed to fetch country codes");
                const codes = await res.json();

                const map = {};
                for (const [code, name] of Object.entries(codes)) {
                    map[name.toLowerCase()] = code;
                }

                document.querySelectorAll(".ino-winner-card").forEach(card => {
                    const country = card.getAttribute("data-country")?.toLowerCase().trim();
                    const code = map[country];
                    const flag = card.querySelector(".ino-flag");

                    if (code && flag) {
                        if (code === "sa") {
                            flag.style.background = `url('http://admin.nanolympiad.org/members-country/sa.png') center/cover no-repeat`;
                        } else {
                            flag.style.background = `url('https://flagcdn.com/w80/${code}.png') center/cover no-repeat`;
                        }
                    }
                });
            } catch (err) {
                console.error("Flag load error:", err);
            }
        }

        document.addEventListener("DOMContentLoaded", loadFlags);

        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('ino-winnersContainer');
            if (!container) return;
            const cards = Array.from(container.querySelectorAll('.ino-winner-card'));
            if (!cards.length) return;
            const effects = ['left', 'zoom', 'right', 'rotate', 'flip'];

            function assignEffects() {
                const containerWidth = container.clientWidth || document.documentElement.clientWidth;
                const columns = Math.max(1, Math.floor(containerWidth / 320));
                cards.forEach((card, i) => {
                    const row = Math.floor(i / columns);
                    const col = i % columns;
                    const effect = effects[col % effects.length];
                    card.dataset.effect = effect;
                    const delay = (row * 0.08) + (col * 0.03) + (Math.random() * 0.03);
                    card.style.setProperty('--delay', `${delay.toFixed(3)}s`);
                });
            }

            function debounce(fn, wait) {
                let t;
                return function () {
                    clearTimeout(t);
                    t = setTimeout(() => fn.apply(this, arguments), wait);
                };
            }

            assignEffects();
            window.addEventListener('resize', debounce(assignEffects, 160));

            let inited = false;
            let observer;
            function initObserver() {
                if (inited) return;
                inited = true;
                observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.18, rootMargin: '0px 0px -12% 0px' });
                cards.forEach(c => observer.observe(c));
            }

            window.addEventListener('scroll', initObserver, { passive: true, once: true });
            window.addEventListener('wheel', initObserver, { passive: true, once: true });
            window.addEventListener('touchstart', initObserver, { passive: true, once: true });
        });
    </script>
</div>