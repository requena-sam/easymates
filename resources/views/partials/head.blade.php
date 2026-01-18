<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<!-- Open Graph -->
<meta property="og:title" content="Easy Mates">
<meta property="og:description"
      content="L’application qui facilite la vie des fans de Gentle Mates. Partage tes créations, prévois tes événemments et restent connecté avec tous les joueurs de la structure !.">
<meta property="og:image" content="{{ asset('storage/images/logo_gentlemates.png') }}">
<meta property="og:url" content="https://easymates.laravel.cloud">
<meta property="og:type" content="website">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Easy Mates">
<meta name="twitter:description" content="Facilite ta vie en tant que fan de Gentle Mates.">
<meta name="twitter:image" content="{{ asset('storage/images/logo_gentlemates.png') }}">


<title>{{ config('app.name') }}</title>

<link rel="icon" href="{{asset('favicon.ico')}}" sizes="any">
<link rel="icon" href="{{asset('favicon.svg')}}" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

@vite(['resources/css/app.css', 'resources/js/app.js'])
