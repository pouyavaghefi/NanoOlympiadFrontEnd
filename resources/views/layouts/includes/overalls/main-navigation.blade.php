<div class="main-navigation">
    @php
    $languageCode = app()->getLocale(); // e.g., 'en', 'ar'
    @endphp
    @if(app()->getLocale() === 'ar')
        @include('layouts.includes.sections.ar.nav')
    @else
        @include('layouts.includes.sections.en.nav')
    @endif
</div>