<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container position-relative">
        {{-- Profile/Member Area Button --}}
        <div class="nav-right-btn mt-2">
            @if(auth()->check())
            @php
            $findToken = \DB::table('user_access_tokens')->where('user_id', auth()->user()->id)->first();
            @endphp
            <a href="{{ env('URL_PANEL') }}/?auth_token={{ $findToken->token }}" class="theme-btn profile-btn no-arabic-font">
                Profile
                <span class="{{ $static_pages['call-to-action-icon']->value ?? '' }}"></span>
            </a>
            @else
            <a href="{{ env('APP_URL') }}/{{ $static_pages['call-to-action']->value }}" class="theme-btn login-btn no-arabic-font" id="login-btn">
                {{ $static_pages['call-to-action-name']->value ?? '' }}
                <i class="{{ $static_pages['call-to-action-icon']->value ?? 'fa-user' }}"></i>
            </a>
            @endif
        </div>

        {{-- Mobile Menu Button --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar Menu Items --}}
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav ms-auto">
                @foreach($topmenu_navigation->where('parent_id', null)->sortBy('priority') as $menu)
                @php
                $hasChildren = $topmenu_navigation->where('parent_id', $menu->id)->count() > 0;
                $translation = $menu->showTrans($languageCode);
                $displayLabel = $translation ? $translation->translate_name : $menu->label;
                $isActive = request()->url() === url($menu->url) ? 'active' : '';
                @endphp

                <li class="nav-item {{ $hasChildren ? 'dropdown' : '' }} {{ $isActive }}">
                    <a href="{{ $menu->url }}"
                       class="nav-link {{ $hasChildren ? 'dropdown-toggle' : '' }} {{ $isActive }}"
                       @if($hasChildren) data-bs-toggle="dropdown" @endif>
                        {{ $displayLabel }}
                    </a>

                    @if($hasChildren)
                    <ul class="dropdown-menu">
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

            {{-- Language Switcher --}}
            <div class="nav-right">
                @php
                $availableLangs = explode(',', $bases['siteLangs']->value ?? 'en');
                $langLabels = ['en' => 'English', 'ar' => 'العربية (Arabic)', 'fr' => 'Français', 'de' => 'Deutsch'];
                $currentHost = request()->getHost();
                $mainDomain = env('MAIN_DOMAIN');
                @endphp

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="langDropdown" data-bs-toggle="dropdown">
                        {{ strtoupper(app()->getLocale()) }} <i class="fas fa-globe"></i>
                    </button>
                    <ul class="dropdown-menu">
                        @foreach ($availableLangs as $lang)
                        @php
                        $langUrl = ($lang === 'en') ? "https://$mainDomain" : "https://$lang.$mainDomain";
                        @endphp
                        <li><a class="dropdown-item {{ app()->getLocale() === $lang ? 'active' : '' }}" href="{{ $langUrl }}">
                                {{ $langLabels[$lang] ?? strtoupper($lang) }}
                            </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Logo --}}
            <a class="navbar-brand" href="{{ env('APP_URL') }}">
                @php
                $server = env('URL_ADMIN');
                $path = $bases['siteLogo'] ?? '';
                $full = $server . "/" . $path;
                @endphp
                <img src="{{ $full }}" style="width:200px" alt="logo">
            </a>
        </div>
    </div>
</nav>
