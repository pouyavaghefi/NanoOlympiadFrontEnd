@extends('layouts.master')

@section('title','Booklets')

@section('head-css')
    <link href="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/web/pdf_viewer.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/build/pdf.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        .pdf-nav-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
            width: 100%;
            padding: 10px 20px;  /* Padding for better spacing */
            background-color: rgba(0, 123, 255, 0.9); /* Semi-transparent background */
        }

        /* Add padding to the PDF viewer to prevent it from being covered by the nav bar */
        #viewer {
            margin-top: 70px;  /* Adjust according to the nav bar height */
        }

        /* Make sure the canvas inside the viewer is responsive */
        canvas {
            width: 100%;
            height: auto;
        }

        /* Ensure the buttons are displayed horizontally on desktop */
        .download-buttons {
            display: flex;
            gap: 20px;  /* Space between buttons */
            justify-content: center;  /* Center the buttons horizontally */
        }

        /* Make sure buttons are styled properly on desktop */
        .download-btn {
            width: auto;  /* Make the buttons auto-sized on desktop */
            max-width: none;  /* Remove max width on desktop */
        }

        /* Adjust top nav bar and button spacing for mobile */
        @media (max-width: 767px) {
            .pdf-nav {
                flex-direction: column;
                align-items: flex-start;
                padding: 10px;
            }

            .pdf-nav .btn-nav {
                font-size: 14px;  /* Smaller font for mobile */
                margin: 5px 0;    /* Reduce margin between buttons */
            }

            .pdf-nav .page-count {
                font-size: 14px;
                margin: 10px 0;
            }

            /* Optional: Hide some controls on very small screens */
            #darkModeToggle, #reloadPDF {
                display: none;
            }

            #fullScreenBtn {
                display: none;
            }

            /* Adjust the PDF viewer */
            #viewer {
                margin-top: 120px !important;  /* Increased margin to give more space between nav and PDF */
            }

            .download-buttons {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .download-btn {
                width: 100%;  /* Make the button take full width on mobile */
                max-width: 300px;  /* Limit the max width on mobile */
            }
        }

        /* Ensure that the bottom navigation fits better on smaller screens */
        .pdf-nav-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 10;
            background-color: rgba(0, 123, 255, 0.9); /* Same color as top nav */
            padding: 10px 20px;
        }

        /* Make the PDF viewer's container flexible for all screen sizes */
        #pdf-container {
            width: 100%;
            padding: 0 15px;  /* Adjust for mobile screens */
        }
        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            display: none; /* Hide by default */
        }

        #loader p {
            color: #3498db;
            font-size: 16px;
            margin-top: 10px;
            text-align: center;
        }

        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #viewer {
            width: 100%;
            height: auto;
            overflow: hidden;
            display: flex;
            justify-content: center;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }

        /* Container for the PDF viewer */
        #pdf-container {
            text-align: center;
            margin-top: 20px;
            position: relative;
        }

        /* Styling for the PDF viewer area */
        .pdfViewer {
            padding-top: 50px !important;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            height: auto;
            overflow-x: auto;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Navigation bars (top and bottom) */
        .pdf-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 8px;
            margin: 10px 0;
        }

        .pdf-nav .btn-nav {
            background-color: #0056b3;
            border: none;
            padding: 8px 16px;
            margin: 0 10px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .pdf-nav .btn-nav:hover {
            background-color: #004494;
        }

        .page-count {
            font-size: 18px;
            font-weight: bold;
            margin: 0 15px;
        }

        /* Top navigation bar */
        .pdf-nav-top {
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            z-index: 10;
        }

        /* Bottom navigation bar */
        .pdf-nav-bottom {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            z-index: 10;
        }

        #pdf-nav {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-nav {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
            font-weight: 500;
        }

        .btn-nav:hover {
            background-color: #0056b3;
        }

        .page-count {
            font-size: 1rem;
            color: #333;
        }

        .download-buttons {
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

        .download-btn .btn-icon {
            transform: translateX(0);
            transition: transform 0.4s ease-in-out;
            font-size: 20px;
        }

        .download-btn:hover {
            background: linear-gradient(135deg, #0072ff, #00c6ff);
            box-shadow: 0 12px 30px rgba(0, 114, 255, 0.5);
            transform: translateY(-3px);
        }

        .download-btn:hover .btn-icon {
            transform: translateX(8px);
        }

        /* Alternate style */
        .download-btn.alt {
            background: linear-gradient(135deg, #f7971e, #ffd200);
            color: #333;
            box-shadow: 0 8px 20px rgba(255, 210, 0, 0.3);
        }

        .download-btn.alt:hover {
            background: linear-gradient(135deg, #ffd200, #f7971e);
            box-shadow: 0 12px 30px rgba(255, 210, 0, 0.5);
        }

        /* Fade animation on appearance */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            opacity: 0;
            animation: fadeIn 1.2s ease-in forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Fullscreen button styles */
        .full-screen-btn {
            background: linear-gradient(45deg, #ff6a00, #ff6347); /* Gradient background */
            color: white;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 30px; /* Rounded corners */
            border: none;
            transition: all 0.3s ease;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            display: flex;
            align-items: center; /* Aligning icon and text */
            gap: 8px;
        }

        .full-screen-btn:hover {
            background: linear-gradient(45deg, #ff6347, #ff6a00); /* Hover state: reversed gradient */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
        }

        .full-screen-btn:focus {
            outline: none;
        }

        /* Vertical flip animation for the icon */
        .fullscreen-icon {
            display: inline-block;
            animation: flipIcon 2s ease-in-out infinite;
            transform-style: preserve-3d; /* Necessary for 3D effect */
        }

        /* Flip keyframes */
        @keyframes flipIcon {
            0% {
                transform: rotateX(0deg);
            }
            50% {
                transform: rotateX(180deg); /* Flipping halfway */
            }
            100% {
                transform: rotateX(360deg); /* Completing the flip */
            }
        }

        /* Optional: Adding a smooth hover effect to other buttons for consistency */
        button.btn {
            transition: all 0.3s ease;
        }

        button.btn:hover {
            transform: scale(1.05); /* Slight zoom effect */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }


    </style>
@endsection

@section('wrapper')
    <div class="about-area mt-4">
        <div id="pdf-container" class="pdf-viewer-container">
            <div id="pdf-nav" class="navbar pdf-nav-top d-flex justify-content-center align-items-center gap-3 py-2">
                <button id="reloadPDF" class="btn btn-secondary">🔄 Reload</button>
                <button id="prevPage" class="btn btn-outline-primary px-4">← Previous</button>
                <div id="pageCount" class="page-count fw-semibold">
                    Page: <span id="currentPage">1</span> of <span id="totalPages">Loading...</span>
                </div>
                <button id="nextPage" class="btn btn-outline-primary px-4">Next →</button>
                <button id="darkModeToggle" class="btn btn-dark">🌙 Dark Mode</button>
            </div>

            <!-- ✅ Hint goes here, outside the flexbox -->


            <div id="viewer" class="pdfViewer"></div>

            <div id="loader" style="display: none;">
                <p>Loading PDF...<br>Please wait for a while</p>
            </div>

            <div class="download-buttons mt-4 d-flex justify-content-center gap-4">
                <a href="https://ino-official.org/dl/Nanotechnology_booklet.pdf" download class="download-btn" target="_blank" rel="noopener noreferrer">
                    <span class="btn-text">Download PDF</span>
                    <span class="btn-icon">⬇️</span>
                </a>
                <button class="download-btn alt" onclick="saveToGoogleDrive()">
                    <span class="btn-text">Save to Drive</span>
                    <span class="btn-icon">💾</span>
                </button>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <div class="d-flex align-items-center gap-2">
                    <input type="number" id="jumpToPage" class="form-control" placeholder="Page #" style="width: 100px;" min="1">
                    <button id="goToPage" class="btn btn-primary">Go</button>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <a href="https://ino-official.org/dl/Nanotechnology_booklet.pdf" id="sharePdfLink" class="btn btn-outline-primary" target="_blank" rel="noopener noreferrer">
                    Share PDF Link
                </a>
                <button id="copyUrlBtn" class="btn btn-outline-secondary">
                    Copy URL
                </button>
                <button id="bookmarkBtn" class="btn btn-outline-success">
                    Bookmark Page
                </button>
                <button id="printBtn" class="btn btn-outline-info">
                    Print Page
                </button>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <button id="fullScreenBtn" class="btn full-screen-btn">
                    <span class="fullscreen-icon">🌐</span> Fullscreen
                </button>
            </div>

            <div id="keyHint" class="text-center text-muted small mt-2 fade-in">
                You can also use your ← and → keyboard arrows to navigate pages.
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const url = 'https://ino-official.org/dl/Nanotechnology_booklet.pdf';
        const pdfjsLib = window['pdfjs-dist/build/pdf'];

        // Set the workerSrc property to the correct PDF.js worker URL
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/build/pdf.worker.min.js';

        let pdfDoc = null;
        let pageNum = 1;
        let pageRendering = false;
        let pageNumPending = null;
        const scale = 1.5;
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        const viewer = document.getElementById('viewer');

        // Function to render the page
        function renderPage(num) {
            if (!pdfDoc) return; // Prevent calling before PDF is ready
            pageRendering = true;

            // Show loader
            document.getElementById('loader').style.display = 'block';

            const currentScale = getResponsiveScale();
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({ scale: currentScale });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                const renderTask = page.render(renderContext);

                renderTask.promise.then(function() {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }

                    // Hide loader once page is rendered
                    document.getElementById('loader').style.display = 'none';
                });

                viewer.innerHTML = ''; // Clear previous page content
                viewer.appendChild(canvas); // Append the new page to the viewer

                document.getElementById('pageCount').textContent = 'Page: ' + pageNum + ' of ' + pdfDoc.numPages;
            });
        }

        // Fetch the PDF document
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('totalPages').textContent = pdfDoc.numPages;
            renderPage(pageNum);
        });

        // Display previous page
        document.getElementById('prevPage').addEventListener('click', function() {
            if (pageNum <= 1) return;
            pageNum--;
            renderPage(pageNum);
        });

        // Display next page
        document.getElementById('nextPage').addEventListener('click', function() {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            renderPage(pageNum);
        });

        function saveToGoogleDrive() {
            const clientId = '419586832465-vqhlm340ruteeke8tmo0ob9h1drdri62.apps.googleusercontent.com';
            const scope = ['https://www.googleapis.com/auth/drive.file'];
            const tokenClient = google.accounts.oauth2.initTokenClient({
                client_id: clientId,
                scope: scope.join(' '),
                callback: async (tokenResponse) => {
                    const accessToken = tokenResponse.access_token;

                    const fileUrl = 'https://nanolympiad.org/dl/Nanotechnology_booklet.pdf';
                    const fileName = 'Nanotechnology_booklet.pdf';

                    const fileBlob = await fetch(fileUrl).then(res => res.blob());

                    const metadata = {
                        name: fileName,
                        mimeType: fileBlob.type
                    };

                    const form = new FormData();
                    form.append('metadata', new Blob([JSON.stringify(metadata)], { type: 'application/json' }));
                    form.append('file', fileBlob);

                    fetch('https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart', {
                        method: 'POST',
                        headers: new Headers({ 'Authorization': 'Bearer ' + accessToken }),
                        body: form
                    })
                        .then(response => response.json())
                        .then(data => {
                            alert('File saved to your Google Drive!');
                            console.log(data);
                        });
                }
            });

            tokenClient.requestAccessToken();
        }

        function getResponsiveScale() {
            const containerWidth = document.getElementById('viewer').offsetWidth;
            if (containerWidth <= 480) return 0.6; // Adjust for small screens
            if (containerWidth <= 768) return 0.9; // Adjust for tablets
            return 1.2; // Default for larger screens
        }

        window.addEventListener('resize', function() {
            renderPage(pageNum); // Re-render the current page to update scaling
        });

        // Show loader
        document.getElementById('loader').style.display = 'block';

        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('totalPages').textContent = pdfDoc.numPages;
            renderPage(pageNum);

            // Hide loader after PDF is loaded
            document.getElementById('loader').style.display = 'none';
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                e.preventDefault();
                if (e.key === 'ArrowLeft' && pageNum > 1) {
                    pageNum--;
                    renderPage(pageNum);
                } else if (e.key === 'ArrowRight' && pageNum < pdfDoc.numPages) {
                    pageNum++;
                    renderPage(pageNum);
                }
            }
        });

        // Reload current page
        document.getElementById('reloadPDF').addEventListener('click', function () {
            renderPage(pageNum);
        });

        // Jump to a specific page
        document.getElementById('goToPage').addEventListener('click', function () {
            const targetInput = document.getElementById('jumpToPage');
            const targetPage = parseInt(targetInput.value, 10);

            if (!isNaN(targetPage) && targetPage >= 1 && targetPage <= pdfDoc.numPages) {
                pageNum = targetPage;
                renderPage(pageNum);
            } else {
                alert('Please enter a valid page number between 1 and ' + pdfDoc.numPages);
            }
        });

        // Allow Enter key in the input to trigger Go button
        document.getElementById('jumpToPage').addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('goToPage').click();
            }
        });

        // Dark mode toggle
        let darkMode = false;

        document.getElementById('darkModeToggle').addEventListener('click', function () {
            darkMode = !darkMode;
            if (darkMode) {
                document.body.classList.add('dark-mode');
                this.textContent = '☀️ Light Mode';
            } else {
                document.body.classList.remove('dark-mode');
                this.textContent = '🌙 Dark Mode';
            }
        });

        // Simple dark mode styles
        const darkStyle = document.createElement('style');
        darkStyle.innerHTML = `
    .dark-mode {
        background-color: #121212;
        color: #e0e0e0;
    }
    .dark-mode .btn {
        border-color: #bbb;
    }
    .dark-mode #viewer {
        background-color: #1e1e1e;
    }
`;
        document.head.appendChild(darkStyle);

        // Copy URL button functionality
        // Copy URL button functionality
        // Copy URL button functionality
        document.getElementById('copyUrlBtn').addEventListener('click', function() {
            const currentUrl = window.location.href;  // Get current page URL
            navigator.clipboard.writeText(currentUrl)  // Copy URL to clipboard
                .then(function() {
                    const btn = document.getElementById('copyUrlBtn');
                    btn.innerHTML = 'Copied! ✅';  // Change button text
                    setTimeout(function() {
                        btn.innerHTML = 'Copy URL';  // Reset button text after a delay
                    }, 2000); // Reset after 2 seconds
                })
                .catch(function(error) {
                    console.error('Error copying URL: ', error);
                });
        });

        // Bookmark button functionality
        document.getElementById('bookmarkBtn').addEventListener('click', function() {
            const pageTitle = document.title;
            const pageUrl = window.location.href;

            // For most browsers, we can't add a bookmark via JS, but we can show a prompt
            if (window.sidebar && window.sidebar.addPanel) {  // Firefox <= 22
                window.sidebar.addPanel(pageTitle, pageUrl, '');
            } else if (window.external && ('AddFavorite' in window.external)) {  // IE Favorites
                window.external.AddFavorite(pageUrl, pageTitle);
            } else {
                // For other browsers (Chrome, Safari, Edge), prompt the user to bookmark manually
                alert('Press Ctrl+D (Windows) or Cmd+D (Mac) to bookmark this page.');
            }
        });

        // Print button functionality
        document.getElementById('printBtn').addEventListener('click', function() {
            window.print();  // Trigger the print dialog
        });

        document.getElementById('fullScreenBtn').addEventListener('click', function() {
            // Get the element that you want to make fullscreen
            const viewer = document.getElementById('viewer');

            // Check if fullscreen is already supported
            if (viewer.requestFullscreen) {
                viewer.requestFullscreen();  // For most browsers
            } else if (viewer.mozRequestFullScreen) {
                viewer.mozRequestFullScreen();  // For Firefox
            } else if (viewer.webkitRequestFullscreen) {
                viewer.webkitRequestFullscreen();  // For Chrome and Safari
            } else if (viewer.msRequestFullscreen) {
                viewer.msRequestFullscreen();  // For IE/Edge
            } else {
                alert('Fullscreen is not supported by your browser.');
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'f' || event.key === 'F') {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen()
                        .catch(err => {
                            console.error('Failed to enter fullscreen:', err);
                        });
                } else {
                    document.exitFullscreen()
                        .catch(err => {
                            console.error('Failed to exit fullscreen:', err);
                        });
                }
            }
        });

    </script>
@endsection