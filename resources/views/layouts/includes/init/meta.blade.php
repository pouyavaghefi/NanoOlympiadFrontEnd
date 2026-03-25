<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{--<title>{{ $seoSettings->meta_title ?? 'Default Title' }}</title>--}}

<meta name="description" content="{{ $seoSettings->meta_description ?? 'Default description for the site' }}">
<meta name="keywords" content="{{ $seoSettings->meta_keywords ?? 'default, keywords' }}">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ $seoSettings->og_title ?? $seoSettings->meta_title ?? 'Default OG Title' }}">
<meta property="og:description" content="{{ $seoSettings->og_description ?? $seoSettings->meta_description ?? 'Default OG Description' }}">
<meta property="og:image" content="{{ asset($seoSettings->og_image) ?? asset('default-og-image.jpg') }}">

<!-- Twitter Meta Tags -->
<meta name="twitter:title" content="{{ $seoSettings->twitter_title ?? $seoSettings->meta_title ?? 'Default Twitter Title' }}">
<meta name="twitter:description" content="{{ $seoSettings->twitter_description ?? $seoSettings->meta_description ?? 'Default Twitter Description' }}">
<meta name="twitter:image" content="{{ asset($seoSettings->twitter_image) ?? asset('default-twitter-image.jpg') }}">

<!-- Robots Meta Tags -->
<meta name="robots" content="{{ $seoSettings->robots ?? 'index, follow' }}">

<meta name="author" content="Pouya Vaghefi">
<meta name="copyright" content="Pouya Vaghefi">
<meta name="generator" content="ThemeF UI Bts Themes">
<meta name="keywords" content="Pouya Vaghefi, developer">

