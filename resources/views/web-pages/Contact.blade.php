@extends('layouts.master')

@section('title','Contactus')

@section('styles')
    <style>
        .feature-area,
        .about-area,
        .counter-area {
            margin-bottom: 20px;
        }

        /* Loading spinner styles */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 70px;
            height: 70px;
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .content {
            display: none; /* Hidden initially */
        }
    </style>
@endsection

@section('head-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('wrapper')
    <!-- Loading overlay -->
    <div id="loading-overlay">
        <div class="spinner"></div>
    </div>

    <!-- Content that will be shown after loading -->
    <div class="content">
        @include('layouts.includes.parsers.bread-crumb')

        <div class="about-area mt-4">
            @include('layouts.includes.gadgets.contact')
        </div>

        <div id="map" style="height: 500px;"></div>

        <script>
            // Wait for everything to load
            window.addEventListener('load', function() {
                // Initialize map
                var sites = {!! json_encode($contacts->toArray(), JSON_HEX_TAG) !!};
                var coords = sites[0].map_embed_url.split(',');
                var lat = parseFloat(coords[0]);
                var lon = parseFloat(coords[1]);

                var map = L.map('map').setView([lat, lon], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([lat, lon]).addTo(map)
                    .bindPopup("<b>Iran Nanotechnology Innovation Council</b><br>Educational institution in Tehran")
                    .openPopup();

                // Hide loading overlay and show content
                document.getElementById('loading-overlay').style.display = 'none';
                document.querySelector('.content').style.display = 'block';

                // Form submission handler
                $('#contact-form').on('submit', function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();

                    // Show loading spinner during AJAX request
                    $('#loading-overlay').show();

                    $.ajax({
                        url: '{{ route('frt.contact.submit') }}',
                        type: 'POST',
                        data: formData,
                        complete: function() {
                            // Hide loading spinner when AJAX completes
                            $('#loading-overlay').hide();
                        },
                        success: function(response) {
                            if(response.success) {
                                $('.form-messege').text(response.success);
                                $('#contact-form')[0].reset();
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    </div>
@endsection