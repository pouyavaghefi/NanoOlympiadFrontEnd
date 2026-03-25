<div class="site-breadcrumb" style="background: url('{{ getWallpaperUrl() }}')">
    <div class="container">
        @php
            $segments = request()->segments();
            $lastSegment = end($segments);
        @endphp
        <h2 class="breadcrumb-title">{{ ucfirst($lastSegment) }}</h2>
        <ul class="breadcrumb-menu">
            <li><a href="{{ url('/') }}">Home</a></li>
            @php
                $url = '';
            @endphp

            @foreach ($segments as $segment)
                @php
                    $url .= '/' . $segment;
                @endphp
                <li><a href="{{ url($url) }}">{{ ucfirst($segment) }}</a></li>
            @endforeach
        </ul>
    </div>
</div>

@php
    function getWallpaperUrl() {
        $routeName = Route::currentRouteName();
        $currentUri = request()->path();

        $page = \App\Models\WebPage::where('route_name', $routeName)
                    ->orWhere('slug', $currentUri)
                    ->first();

        if ($page) {
            if ($page->slug == "contact") {
                $contactInfo = \App\Models\ContactPage::first();
                return $contactInfo->cover_image ? env('URL_ADMIN') . '/contact/' . $contactInfo->cover_image : asset('assets/img/breadcrumb/01.jpg');
            } elseif ($page->slug == "iran") {
                 return $page->wall_paper ? env('URL_ADMIN') . '/storage/' . $page->wall_paper : asset('assets/img/breadcrumb/01.jpg');
            } else {
                if(!is_null($page->wall_paper)){
                    return env('URL_ADMIN') . '/storage/' . $page->wall_paper;
                }else{
                    return asset('assets/img/breadcrumb/01.jpg');
                }
            }
        } else {
            return asset('assets/img/breadcrumb/01.jpg');
        }
    }
@endphp

