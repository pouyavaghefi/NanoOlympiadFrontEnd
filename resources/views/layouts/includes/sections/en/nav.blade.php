<nav class="navbar navbar-expand-lg">
    <div class="container position-relative">
        {{-- Brand Logo --}}
        <a class="navbar-brand" href="{{ env('APP_URL') }}">
            @php
                $server = env('URL_ADMIN');
                $path = $bases['siteLogo'];
                $full = $server."/".$path;
            @endphp
            <img src="{{ $full }}" alt="logo">
        </a>

        {{-- Mobile Menu Toggle --}}
        <div class="mobile-menu-right">
            <button class="navbar-toggler" type="button" id="navbar-toggler">
                <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
            </button>
        </div>

        {{-- Navbar Items --}}
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav me-auto" style="margin-left:50px !important;">
                @foreach($topmenu_navigation->where('parent_id', null)->sortByDesc('priority') as $menu)
                    @php
                        $hasChildren = $topmenu_navigation->where('parent_id', $menu->id)->count() > 0;
                        $translation = $menu->showTrans($languageCode);
                        $displayLabel = $translation ? $translation->translate_name : $menu->label;
                        $isActive = request()->url() === url($menu->url) ? 'active' : '';
                    @endphp

                    <li class="nav-item {{ $hasChildren ? 'dropdown' : '' }} {{ $isActive }} {{ $loop->last ? 'desktop-only-style' : '' }}">
                         <a href="{{ $menu->url }}" class="nav-link {{ $hasChildren ? 'dropdown-toggle' : '' }} {{ $isActive }}" @if($hasChildren) data-bs-toggle="dropdown" @endif>
                            {{ $displayLabel }}
                         </a>

                        @if($hasChildren)
                            <ul class="dropdown-menu fade-down">
                                @foreach($topmenu_navigation->where('parent_id', $menu->id) as $child)
                                    @php
                                        $childTranslation = $child->showTrans($languageCode);
                                        $childDisplayLabel = $childTranslation ? $childTranslation->translate_name : $child->label;
                                        $childIsActive = request()->url() === url($child->url) ? 'active' : '';
                                    @endphp
                                    <li class="{{ $childIsActive }}">
                                        <a class="dropdown-item {{ $childIsActive }}" href="{{ $child->url }}">
                                            {{ $childDisplayLabel }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>

            {{-- Right Menu --}}
            <div class="nav-right d-lg-flex align-items-center w-100 justify-content-end">
                {{-- Language Switcher --}}
                @php
                    $availableLangs = array_filter(explode(',', $bases['siteLangs'] ?? 'en'));
                    $langLabels = ['en' => 'English', 'ar' => 'العربية (Arabic)', 'fr' => 'Français', 'de' => 'Deutsch'];
                    $mainDomain = env('MAIN_DOMAIN');
                @endphp

                @if (count($availableLangs) > 1)
                    <div class="dropdown language-switcher">
                        <button class="btn btn-secondary dropdown-toggle nav-right-link" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i> {{ strtoupper(app()->getLocale()) }}
                        </button>
                        <ul class="dropdown-menu language-dropdown" aria-labelledby="languageDropdown">
                            @foreach ($availableLangs as $lang)
                                @php $langUrl = ($lang === 'en') ? "https://$mainDomain" : "https://$lang.$mainDomain"; @endphp
                                <li>
                                    <a class="dropdown-item {{ app()->getLocale() === $lang ? 'active' : '' }}" href="{{ $langUrl }}">
                                        {{ $langLabels[$lang] ?? strtoupper($lang) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- Profile/Login Button --}}
            @php
                $token = request()->cookie('user_token');
                    $userToken = null;
                    if ($token) {
                        $userToken = \DB::table('user_access_tokens')
                            ->where('token', $token)
                            ->where('expires_at', '>', now())
                            ->first();
                    }
            @endphp

            <div class="nav-right-btn mt-2 d-flex gap-2">
                @if (auth()->check())
                    <a href="{{ env('URL_PANEL') }}" class="theme-btn profile-btn">
                        <span class="{{ $static_pages['call-to-action-icon']->value ?? '' }}"></span> Profile
                    </a>
                    <a href="https://ino-official.org/clientarea/logout" class="theme-btn login-btn" style="color: #fff; background-color: #116E63; border-color: #116E63;">
                        Logout
                    </a>
                @else
                    <a href="{{ env('APP_URL') }}/{{ $static_pages['call-to-action']->value }}" class="theme-btn login-btn">
                        <span class="{{ $static_pages['call-to-action-icon']->value ?? '' }}"></span>
                        {{ $static_pages['call-to-action-name']->value ?? '' }}
                    </a>
                    <a href="https://ino-official.org/clientarea/login" class="theme-btn login-btn" style="color: #fff; background-color: #116E63; border-color: #116E63;">
                        Login
                    </a>
                @endif
            </div>
        </div>
    </div>
</nav>

{{-- JavaScript for Navbar Toggling --}}

