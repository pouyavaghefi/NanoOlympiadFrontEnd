@extends('layouts.master')

@section('title','Single Members Country')

@section('wrapper')
    <div class="about-area mt-4">
        @include('layouts.includes.partials.alerts')
        @include('layouts.includes.gadgets.members-country')
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.team-social-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const name = btn.getAttribute('data-name');
                const url = btn.getAttribute('data-url');

                if (navigator.share) {
                    navigator.share({
                        title: `Check out ${name}`,
                        text: `${name} is on our team!`,
                        url: url
                    }).catch(err => console.error('Error sharing:', err));
                } else {
                    // Fallback for unsupported browsers
                    alert(`Copy this link: ${url}`);
                }
            });
        });
    </script>
@endsection