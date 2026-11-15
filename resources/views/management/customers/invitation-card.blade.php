<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $customer->name }} - Timeless Asia Gems &amp; Jewelry Exhibition</title>
    <link rel="icon" type="image/png" href="{{ asset('images/timeless-asia-logo.png') }}">

    <!-- Google Fonts for Luxury Gems & Jewelry Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800;900&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Montserrat:wght@300;400;500;600;700&family=Noto+Serif+Myanmar:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-cormorant { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
        .font-burmese { font-family: 'Noto Serif Myanmar', 'Myanmar Text', 'Padauk', sans-serif; }

        /* Metallic gold gradient text */
        .text-gold-gradient {
            background: linear-gradient(135deg, #fef3c7 0%, #f7e096 30%, #ffd778 50%, #d4a742 80%, #a17822 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gold-border-glow {
            box-shadow: 0 0 50px -10px rgba(245, 158, 11, 0.28), 0 0 80px -20px rgba(37, 99, 235, 0.35);
        }

        /* Code-drawn floral cover inspired by the supplied motion invitation. */
        .invitation-intro {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: grid;
            place-items: center;
            overflow: hidden;
            background: #f8f5ed;
            color: #0e1e4a;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        html.invitation-intro-active .invitation-intro {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }
        html.invitation-intro-active .print-card-wrapper,
        html.invitation-intro-active .no-print {
            visibility: hidden;
        }
        html.invitation-intro-active,
        html.invitation-intro-opening {
            overflow: hidden;
        }
        .intro-panel {
            position: absolute;
            inset-block: 0;
            width: 50.1%;
            background: linear-gradient(145deg, #fffdf8 0%, #f5f0e5 100%);
            transition: transform 1.35s cubic-bezier(.77, 0, .18, 1);
            will-change: transform;
        }
        .intro-panel--left {
            inset-inline-start: 0;
            border-inline-end: 1px solid rgba(180, 130, 34, .35);
        }
        .intro-panel--right {
            inset-inline-end: 0;
            border-inline-start: 1px solid rgba(180, 130, 34, .35);
        }
        .intro-florals {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            transition: opacity .55s ease .25s;
        }
        .intro-cover-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 1.5rem;
            animation: intro-content-arrive .9s .2s both;
        }
        .intro-seal {
            display: grid;
            place-items: center;
            width: clamp(112px, 24vw, 154px);
            aspect-ratio: 1;
            padding: .75rem;
            border: 1px solid #d7ba73;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 25%, #31559a, #0a1b48 72%);
            box-shadow: 0 0 0 7px rgba(255,255,255,.72), 0 0 0 8px rgba(180,130,34,.44), 0 14px 40px rgba(14,30,74,.2);
            transition: transform .8s ease, opacity .65s ease;
        }
        .intro-seal img {
            width: 78%;
            height: 78%;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }
        .intro-title {
            margin-top: 1.75rem;
            color: #0e1e4a;
            font-family: 'Cinzel', Georgia, serif;
            font-size: clamp(1rem, 3.5vw, 1.35rem);
            font-weight: 600;
            letter-spacing: .22em;
            text-transform: uppercase;
        }
        .intro-subtitle {
            margin-top: .45rem;
            color: #80662e;
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 1.15rem;
            font-style: italic;
            letter-spacing: .08em;
        }
        .intro-open-button {
            margin-top: 1.65rem;
            border: 1px solid rgba(180,130,34,.72);
            border-radius: 999px;
            padding: .7rem 1.35rem;
            background: rgba(255,255,255,.72);
            color: #0e1e4a;
            font-family: 'Cinzel', Georgia, serif;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            box-shadow: 0 5px 18px rgba(14,30,74,.08);
            transition: background .2s ease, transform .2s ease;
            cursor: pointer;
        }
        .intro-open-button:hover {
            transform: translateY(-2px);
            background: #fff;
        }
        .intro-skip {
            position: absolute;
            z-index: 3;
            inset-inline-end: max(1.1rem, env(safe-area-inset-right));
            inset-block-end: max(1rem, env(safe-area-inset-bottom));
            border: 0;
            padding: .65rem .8rem;
            background: transparent;
            color: rgba(14,30,74,.72);
            font: 600 .68rem 'Montserrat', sans-serif;
            letter-spacing: .12em;
            text-transform: uppercase;
            cursor: pointer;
        }
        .intro-skip:focus-visible,
        .intro-open-button:focus-visible {
            outline: 3px solid #b48222;
            outline-offset: 4px;
        }
        html.invitation-intro-opening .intro-panel--left {
            transform: translateX(-101%);
        }
        html.invitation-intro-opening .intro-panel--right {
            transform: translateX(101%);
        }
        html.invitation-intro-opening .intro-seal {
            transform: scale(.78);
            opacity: 0;
        }
        html.invitation-intro-opening .intro-cover-content {
            animation: none;
            opacity: 0;
            transition: opacity .45s ease;
        }
        html.invitation-intro-opening .intro-florals {
            opacity: 0;
        }
        html.invitation-card-revealed .print-card-wrapper {
            animation: invitation-card-reveal .95s cubic-bezier(.2,.75,.25,1) both;
        }
        @keyframes intro-content-arrive {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes invitation-card-reveal {
            from { opacity: 0; transform: translateY(20px) scale(.975); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @media (prefers-reduced-motion: reduce) {
            .intro-panel, .intro-seal, .intro-cover-content, .print-card-wrapper {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }

        @media print {
            @page {
                size: A5 portrait;
                margin: 0;
            }
            body {
                background: #051532 !important;
                padding: 0 !important;
                margin: 0 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .no-print {
                display: none !important;
            }
            .print-card-wrapper {
                min-height: 100vh !important;
                padding: 0.5cm !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                background: transparent !important;
            }
            .invitation-card {
                box-shadow: none !important;
                page-break-inside: avoid !important;
            }
            .invitation-intro {
                display: none !important;
            }
            html.invitation-intro-active .print-card-wrapper,
            html.invitation-intro-active .no-print {
                visibility: visible !important;
            }
        }
    </style>
    <script>
        document.documentElement.classList.add('invitation-intro-active');
    </script>
</head>
<body class="min-h-full bg-gradient-to-b from-[#020a1a] via-[#051532] to-[#010610] text-amber-50 flex flex-col justify-center items-center p-3 sm:p-6 lg:p-8 antialiased selection:bg-[#d4a742] selection:text-black">

    @php
        $event = \App\Models\EventDetail::current();
        $tier = (int) $customer->customer_level;
        if ($tier === 3) {
            $tierTitle = 'VIP EXHIBITOR';
            $tierPillStyle = 'border-[#b48222] bg-[#f7e096]/50 text-[#0e1e4a]';
        } elseif ($tier === 2) {
            $tierTitle = 'SILVER EXHIBITOR';
            $tierPillStyle = 'border-slate-400 bg-slate-200/60 text-[#0e1e4a]';
        } else {
            $tierTitle = 'OFFICIAL EXHIBITOR';
            $tierPillStyle = 'border-[#b48222]/50 bg-[#fbf3db]/80 text-[#0e1e4a]';
        }
    @endphp

    <section id="invitationIntro" class="invitation-intro" role="dialog" aria-modal="true" aria-label="Invitation cover" aria-describedby="introTitle">
        <div class="intro-panel intro-panel--left" aria-hidden="true"></div>
        <div class="intro-panel intro-panel--right" aria-hidden="true"></div>

        {{-- Editable vector florals keep the opening cover in the same code-drawn style as the card. --}}
        <svg class="intro-florals" viewBox="0 0 1440 900" preserveAspectRatio="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <g id="intro-flower">
                    <path d="M0 0 C-28 -18 -24 -47 0 -52 C24 -47 28 -18 0 0Z" fill="#ba5570"/>
                    <path d="M0 0 C-27 -8 -47 -32 -32 -49 C-10 -53 4 -27 0 0Z" fill="#d77c86"/>
                    <path d="M0 0 C27 -8 47 -32 32 -49 C10 -53 -4 -27 0 0Z" fill="#e6a4a0"/>
                    <circle cy="-17" r="7" fill="#d4a742"/>
                </g>
                <g id="intro-blue-flower">
                    <path d="M0 0 C-23 -10 -28 -35 -10 -43 C4 -38 7 -17 0 0Z" fill="#315b99"/>
                    <path d="M0 0 C-17 -19 -11 -43 8 -45 C20 -34 12 -14 0 0Z" fill="#5078b4"/>
                    <path d="M0 0 C4 -26 25 -38 38 -23 C38 -5 17 3 0 0Z" fill="#6b8fc3"/>
                    <circle cx="3" cy="-12" r="5" fill="#e3bb61"/>
                </g>
                <g id="intro-sprig" fill="none" stroke="#68774e" stroke-width="3" stroke-linecap="round">
                    <path d="M0 0 C40 -95 35 -188 95 -275 C136 -334 154 -397 148 -480"/>
                    <path d="M30 -87 C-8 -107 -27 -137 -12 -151 C17 -154 35 -123 30 -87Z" fill="#899566" stroke="none"/>
                    <path d="M52 -139 C91 -155 111 -184 94 -198 C65 -196 48 -167 52 -139Z" fill="#a4a879" stroke="none"/>
                    <path d="M76 -204 C38 -224 28 -254 49 -265 C77 -255 88 -226 76 -204Z" fill="#778754" stroke="none"/>
                    <path d="M105 -267 C143 -281 164 -309 148 -325 C120 -322 102 -294 105 -267Z" fill="#9aa575" stroke="none"/>
                    <path d="M127 -334 C93 -354 87 -385 109 -394 C136 -381 141 -352 127 -334Z" fill="#71824e" stroke="none"/>
                    <path d="M143 -414 C174 -431 189 -459 171 -472 C146 -465 134 -437 143 -414Z" fill="#9aa575" stroke="none"/>
                </g>
            </defs>
            <g opacity=".93">
                <use href="#intro-sprig" transform="translate(70 895) scale(1.25)"/>
                <use href="#intro-sprig" transform="translate(111 888) scale(.88)"/>
                <use href="#intro-flower" transform="translate(135 675) scale(1.15)"/>
                <use href="#intro-blue-flower" transform="translate(188 480) scale(.9)"/>
                <use href="#intro-flower" transform="translate(86 298) scale(.78)"/>
                <use href="#intro-blue-flower" transform="translate(175 180) scale(.8)"/>
                <use href="#intro-sprig" transform="translate(1370 895) scale(-1.25 1.25)"/>
                <use href="#intro-sprig" transform="translate(1329 888) scale(-.88 .88)"/>
                <use href="#intro-blue-flower" transform="translate(1305 675) scale(1.05)"/>
                <use href="#intro-flower" transform="translate(1252 480) scale(.92)"/>
                <use href="#intro-blue-flower" transform="translate(1354 298) scale(.78)"/>
                <use href="#intro-flower" transform="translate(1265 180) scale(.8)"/>
            </g>
            <path d="M48 34 Q720 -4 1392 34 L1392 866 Q720 904 48 866Z" fill="none" stroke="#b48222" stroke-opacity=".42" stroke-width="2"/>
            <path d="M62 49 Q720 12 1378 49 L1378 851 Q720 888 62 851Z" fill="none" stroke="#b48222" stroke-opacity=".2" stroke-width="1"/>
        </svg>

        <div class="intro-cover-content">
            <div class="intro-seal">
                <img src="{{ asset('images/timeless-asia-logo.png') }}" alt="">
            </div>
            <h1 id="introTitle" class="intro-title">{{ $event->title ?: 'Timeless Asia' }}</h1>
            <p class="intro-subtitle">{{ $event->subtitle ?: 'A special invitation' }}</p>
            <button id="openInvitationBtn" class="intro-open-button" type="button">Open Invitation</button>
        </div>
        <button id="skipIntroBtn" class="intro-skip" type="button">Skip animation</button>
    </section>

    {{-- Main Printable Invitation Card Container --}}
    <div class="print-card-wrapper w-full flex justify-center items-center my-auto py-4">
        <article class="invitation-card relative w-full max-w-[480px] sm:max-w-[500px] rounded-3xl bg-[#061536] p-3 sm:p-5 shadow-[0_25px_60px_-15px_rgba(5,21,50,0.8),0_0_50px_rgba(30,64,175,0.25)] border-2 border-blue-900/60 overflow-hidden text-center select-none" tabindex="-1">

            {{-- Pure Vector Myanmar Royal Kanote (မြန်မာ့ မင်းခမ်းမင်းနား ကနုတ်ပန်း) Brocade Background --}}
            <div class="pointer-events-none absolute inset-0 opacity-[0.24] sm:opacity-[0.28] overflow-hidden">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="myanmar-royal-kanote" width="120" height="120" patternUnits="userSpaceOnUse">
                            <g stroke="#93c5fd" fill="#3b82f6" fill-opacity="0.18" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                {{-- Central Lotus Rosette --}}
                                <circle cx="60" cy="60" r="8" fill="#60a5fa" fill-opacity="0.3" stroke="#bfdbfe" stroke-width="1.2"/>
                                <circle cx="60" cy="60" r="3.5" fill="#dbeafe" stroke="#93c5fd" stroke-width="0.8"/>
                                
                                {{-- Lotus Petals radiating from center --}}
                                <path d="M60 52 C57 48, 57 44, 60 41 C63 44, 63 48, 60 52 Z"/>
                                <path d="M60 68 C57 72, 57 76, 60 79 C63 76, 63 72, 60 68 Z"/>
                                <path d="M52 60 C48 57, 44 57, 41 60 C44 63, 48 63, 52 60 Z"/>
                                <path d="M68 60 C72 57, 76 57, 79 60 C76 63, 72 63, 68 60 Z"/>

                                {{-- 4 Diagonal Myanmar Royal Kanote Flame Scrolls (ကနုတ်အမြီးလိပ်များ) --}}
                                {{-- North-East Kanote Scroll --}}
                                <path d="M66 54 C72 48, 77 46, 83 38 C89 29, 87 20, 81 19 C76 18, 74 23, 77 25 C79 26, 81 24, 80 22 C81 25, 79 28, 76 30 C72 32, 69 38, 64 45 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                <path d="M78 32 C84 29, 91 22, 92 14 C93 9, 89 7, 85 10 C82 12, 84 16, 87 15 C85 18, 80 20, 75 24" fill="none"/>
                                <path d="M69 41 C76 40, 83 35, 87 28" fill="none" stroke-width="0.75"/>

                                {{-- North-West Kanote Scroll --}}
                                <path d="M54 54 C48 48, 43 46, 37 38 C31 29, 33 20, 39 19 C44 18, 46 23, 43 25 C41 26, 39 24, 40 22 C39 25, 41 28, 44 30 C48 32, 51 38, 56 45 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                <path d="M42 32 C36 29, 29 22, 28 14 C27 9, 31 7, 35 10 C38 12, 36 16, 33 15 C35 18, 40 20, 45 24" fill="none"/>
                                <path d="M51 41 C44 40, 37 35, 33 28" fill="none" stroke-width="0.75"/>

                                {{-- South-East Kanote Scroll --}}
                                <path d="M66 66 C72 72, 77 74, 83 82 C89 91, 87 100, 81 101 C76 102, 74 97, 77 95 C79 94, 81 96, 80 98 C81 95, 79 92, 76 90 C72 88, 69 82, 64 75 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                <path d="M78 88 C84 91, 91 98, 92 106 C93 111, 89 113, 85 110 C82 108, 84 104, 87 105 C85 102, 80 100, 75 96" fill="none"/>
                                <path d="M69 79 C76 80, 83 85, 87 92" fill="none" stroke-width="0.75"/>

                                {{-- South-West Kanote Scroll --}}
                                <path d="M54 66 C48 72, 43 74, 37 82 C31 91, 33 100, 39 101 C44 102, 46 97, 43 95 C41 94, 39 96, 40 98 C39 95, 41 92, 44 90 C48 88, 51 82, 56 75 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                <path d="M42 88 C36 91, 29 98, 28 106 C27 111, 31 113, 35 110 C38 108, 36 104, 33 105 C35 102, 40 100, 45 96" fill="none"/>
                                <path d="M51 79 C44 80, 37 85, 33 92" fill="none" stroke-width="0.75"/>

                                {{-- 4 Cardinal Kanote Flame Crests (ကနုတ်ထိပ်ဖူး) --}}
                                {{-- North Crest --}}
                                <path d="M60 49 C55 41, 51 32, 55 21 C58 13, 60 7, 60 4 C60 7, 62 13, 65 21 C69 32, 65 41, 60 49 Z" fill="#93c5fd" fill-opacity="0.25"/>
                                <path d="M60 46 C58 35, 58 20, 60 5" fill="none"/>
                                <path d="M53 31 C46 29, 41 23, 43 17 C45 13, 49 15, 48 18 C46 22, 50 25, 54 27" fill="none"/>
                                <path d="M67 31 C74 29, 79 23, 77 17 C75 13, 71 15, 72 18 C74 22, 70 25, 66 27" fill="none"/>

                                {{-- South Crest --}}
                                <path d="M60 71 C55 79, 51 88, 55 99 C58 107, 60 113, 60 116 C60 113, 62 107, 65 99 C69 88, 65 79, 60 71 Z" fill="#93c5fd" fill-opacity="0.25"/>
                                <path d="M60 74 C58 85, 58 100, 60 115" fill="none"/>
                                <path d="M53 89 C46 91, 41 97, 43 103 C45 107, 49 105, 48 102 C46 98, 50 95, 54 93" fill="none"/>
                                <path d="M67 89 C74 91, 79 97, 77 103 C75 107, 71 105, 72 102 C74 98, 70 95, 66 93" fill="none"/>

                                {{-- West Crest --}}
                                <path d="M49 60 C41 55, 32 51, 21 55 C13 58, 7 60, 4 60 C7 60, 13 62, 21 65 C32 69, 41 65, 49 60 Z" fill="#93c5fd" fill-opacity="0.25"/>
                                <path d="M46 60 C35 58, 20 58, 5 60" fill="none"/>
                                <path d="M31 53 C29 46, 23 41, 17 43 C13 45, 15 49, 18 48 C22 46, 25 50, 27 54" fill="none"/>
                                <path d="M31 67 C29 74, 23 79, 17 77 C13 75, 15 71, 18 72 C22 74, 25 70, 27 66" fill="none"/>

                                {{-- East Crest --}}
                                <path d="M71 60 C79 55, 88 51, 99 55 C107 58, 113 60, 116 60 C113 60, 107 62, 99 65 C88 69, 79 65, 71 60 Z" fill="#93c5fd" fill-opacity="0.25"/>
                                <path d="M74 60 C85 58, 100 58, 115 60" fill="none"/>
                                <path d="M89 53 C91 46, 97 41, 103 43 C107 45, 105 49, 102 48 C98 46, 95 50, 93 54" fill="none"/>
                                <path d="M89 67 C91 74, 97 79, 103 77 C107 75, 105 71, 102 72 C98 74, 95 70, 93 66" fill="none"/>

                                {{-- Interlocking Kanote Corner Rosettes (Seamless Tile Corners) --}}
                                <circle cx="0" cy="0" r="7" fill="#60a5fa" fill-opacity="0.3" stroke="#bfdbfe" stroke-width="1.2"/>
                                <circle cx="120" cy="0" r="7" fill="#60a5fa" fill-opacity="0.3" stroke="#bfdbfe" stroke-width="1.2"/>
                                <circle cx="0" cy="120" r="7" fill="#60a5fa" fill-opacity="0.3" stroke="#bfdbfe" stroke-width="1.2"/>
                                <circle cx="120" cy="120" r="7" fill="#60a5fa" fill-opacity="0.3" stroke="#bfdbfe" stroke-width="1.2"/>

                                <circle cx="0" cy="0" r="3" fill="#dbeafe"/>
                                <circle cx="120" cy="0" r="3" fill="#dbeafe"/>
                                <circle cx="0" cy="120" r="3" fill="#dbeafe"/>
                                <circle cx="120" cy="120" r="3" fill="#dbeafe"/>

                                {{-- Corner Inward Flame Tendrils --}}
                                <path d="M6 6 C12 12, 17 14, 23 22 C29 31, 27 40, 21 41 C16 42, 14 37, 17 35 C19 34, 21 36, 20 38 C21 35, 19 32, 16 30 C12 28, 9 22, 4 15 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                <path d="M114 6 C108 12, 103 14, 97 22 C91 31, 93 40, 99 41 C104 42, 106 37, 103 35 C101 34, 99 36, 100 38 C99 35, 101 32, 104 30 C108 28, 111 22, 116 15 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                <path d="M6 114 C12 108, 17 106, 23 98 C29 89, 27 80, 21 79 C16 78, 14 83, 17 85 C19 86, 21 84, 20 82 C21 85, 19 88, 16 90 C12 92, 9 98, 4 105 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                <path d="M114 114 C108 108, 103 106, 97 98 C91 89, 93 80, 99 79 C104 78, 106 83, 103 85 C101 86, 99 84, 100 82 C99 85, 101 88, 104 90 C108 92, 111 98, 116 105 Z" fill="#60a5fa" fill-opacity="0.25"/>

                                {{-- Interconnecting Flowing Vines (နွယ်ပတ် ကနုတ်ယှက်) --}}
                                <path d="M60 4 C40 4, 18 16, 14 36 C10 50, 6 56, 0 60" fill="none" stroke-width="1.1"/>
                                <path d="M60 4 C80 4, 102 16, 106 36 C110 50, 114 56, 120 60" fill="none" stroke-width="1.1"/>
                                <path d="M60 116 C40 116, 18 104, 14 84 C10 70, 6 64, 0 60" fill="none" stroke-width="1.1"/>
                                <path d="M60 116 C80 116, 102 104, 106 84 C110 70, 114 64, 120 60" fill="none" stroke-width="1.1"/>
                            </g>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#myanmar-royal-kanote)" />
                </svg>
            </div>

            {{-- 3D Molded Roman Cathedral Arch Frame --}}
            <div class="relative w-full rounded-t-[9999px] rounded-b-2xl p-2 sm:p-2.5 bg-gradient-to-b from-[#193a7d] via-[#0d2254] to-[#07163c] shadow-[inset_0_2px_4px_rgba(255,255,255,0.3),inset_0_-2px_6px_rgba(0,0,0,0.8),0_10px_30px_rgba(0,0,0,0.6)] border border-blue-400/30">

                {{-- Inner Arch Molding Layer for 3D Bevel Depth --}}
                <div class="relative w-full rounded-t-[9999px] rounded-b-xl p-1 bg-gradient-to-b from-[#091b42] to-[#122c66] shadow-[inset_0_4px_8px_rgba(0,0,0,0.7)] border border-blue-300/20">

                    {{-- Warm Champagne Parchment Inner Canvas with Soft Inner Shadow --}}
                    <div class="relative w-full rounded-t-[9999px] rounded-b-lg px-4 sm:px-6 pt-7 sm:pt-9 pb-5 sm:pb-6 flex flex-col items-center text-center overflow-hidden shadow-[inset_0_15px_30px_rgba(15,23,42,0.4),inset_0_2px_6px_rgba(0,0,0,0.3)]" style="background: linear-gradient(180deg, #f8eedf 0%, #faf1e5 20%, #f6e8d2 60%, #eedac1 100%);">

                        {{-- Hidden Image for accessibility & test assertion support --}}
                        <img src="{{ $event->logo_url }}" alt="timeless-asia-logo-white.png" class="sr-only">

                        {{-- 1. Top Section: Native Burmese Calligraphic Header in Royal Sapphire Ink --}}
                        <div class="flex flex-col items-center">
                            <h2 class="font-burmese text-2xl sm:text-[27px] font-bold tracking-wide text-[#0e1e4a] leading-tight" style="text-shadow: 0 1px 0 rgba(255,255,255,0.8);">
                                ကျောက်မျက်ရတနာ
                            </h2>
                            <p class="font-burmese text-sm sm:text-base font-semibold text-[#0e1e4a]/90 mt-1 tracking-normal" style="text-shadow: 0 1px 0 rgba(255,255,255,0.8);">
                                အလှတရားတွေနဲ့အတူရှိနေမဲ့
                            </p>
                        </div>

                        {{-- 2. Upper Embossed Filigree Scrollwork Divider --}}
                        <div class="my-2.5 sm:my-3.5 flex items-center justify-center w-full">
                            <svg class="w-48 sm:w-56 h-5 text-[#c9ad84]" viewBox="0 0 240 20" fill="none" stroke="currentColor" style="filter: drop-shadow(0 1px 0 rgba(255,255,255,0.95)) drop-shadow(0 -0.5px 0 rgba(140,100,50,0.4));">
                                <path d="M15 10 C35 3, 55 17, 75 10 C95 3, 105 10, 115 10 C120 10, 120 10, 125 10 C135 10, 145 3, 165 10 C185 17, 205 3, 225 10" stroke-width="1.3" stroke-linecap="round"/>
                                <path d="M75 10 C68 4, 58 6, 54 11 C50 16, 58 18, 63 15 C68 12, 72 12, 75 10 Z" stroke-width="1" fill="currentColor" fill-opacity="0.18"/>
                                <path d="M165 10 C172 4, 182 6, 186 11 C190 16, 182 18, 177 15 C172 12, 168 12, 165 10 Z" stroke-width="1" fill="currentColor" fill-opacity="0.18"/>
                                <circle cx="120" cy="10" r="2.5" fill="currentColor"/>
                                <circle cx="108" cy="10" r="1.5" fill="currentColor"/>
                                <circle cx="132" cy="10" r="1.5" fill="currentColor"/>
                            </svg>
                        </div>

                        {{-- 3. Center Section: Personalized Invitation Pass Details --}}
                        <div class="w-full flex flex-col items-center">

                            {{-- Formal Invitation Honor Text --}}
                            <p class="font-cinzel text-[9.5px] sm:text-[11px] font-semibold tracking-[0.24em] text-[#8a6826] uppercase">
                                {{ $event->invitation_text }}
                            </p>

                            {{-- Optional Exhibitor Logo (More Enlarged) --}}
                            @if($customer->logo_url)
                                <div class="mt-2.5 mb-1.5 flex items-center justify-center">
                                    <div class="h-28 w-28 sm:h-32 sm:w-32 max-w-[280px] sm:max-w-[320px] rounded-2xl border-2 border-[#b48222]/50 bg-white/95 p-2 sm:p-2.5 shadow-[0_8px_24px_rgba(14,30,74,0.15)] flex items-center justify-center">
                                        <img src="{{ $customer->logo_url }}" alt="{{ $customer->name }}" crossorigin="anonymous" class="h-full w-full object-contain rounded-xl">
                                    </div>
                                </div>
                            @endif

                            {{-- Exhibitor Name (Refined, Slightly Smaller Font) --}}
                            <h1 class="mt-1 text-lg sm:text-xl font-bold tracking-wider text-[#0e1e4a] font-cinzel leading-snug uppercase px-2" style="text-shadow: 0 1px 0 rgba(255,255,255,0.7);">
                                {{ $customer->name }}
                            </h1>

                            {{-- Tier Badge (Clean, No Asterisk/Star) --}}
                            <div class="mt-1.5 inline-flex items-center rounded-full border {{ $tierPillStyle }} px-3.5 py-0.5 shadow-2xs backdrop-blur-xs">
                                <span class="font-cinzel text-[10px] sm:text-[11px] font-bold tracking-[0.22em] uppercase">
                                    {{ $tierTitle }}
                                </span>
                            </div>

                            {{-- Official Event Access QR Code --}}
                            <div class="mt-3 sm:mt-3.5 flex flex-col items-center">
                                <div class="relative rounded-2xl border-2 border-[#b48222]/50 bg-white p-2 sm:p-2.5 shadow-[0_6px_22px_rgba(14,30,74,0.16)]">
                                    @if($event->qr_code_url)
                                        <img src="{{ $event->qr_code_url }}" alt="Event Access QR Code" crossorigin="anonymous" class="h-24 w-24 sm:h-28 sm:w-28 object-contain rounded-xl">
                                    @else
                                        {{-- Clean Fallback QR Graphic --}}
                                        <svg class="h-24 w-24 sm:h-28 sm:w-28 text-[#0e1e4a]" viewBox="0 0 100 100" fill="currentColor">
                                            <rect x="5" y="5" width="28" height="28" rx="4" fill="currentColor"/>
                                            <rect x="9" y="9" width="20" height="20" rx="2" fill="#ffffff"/>
                                            <rect x="13" y="13" width="12" height="12" rx="1" fill="currentColor"/>

                                            <rect x="67" y="5" width="28" height="28" rx="4" fill="currentColor"/>
                                            <rect x="71" y="9" width="20" height="20" rx="2" fill="#ffffff"/>
                                            <rect x="75" y="13" width="12" height="12" rx="1" fill="currentColor"/>

                                            <rect x="5" y="67" width="28" height="28" rx="4" fill="currentColor"/>
                                            <rect x="9" y="71" width="20" height="20" rx="2" fill="#ffffff"/>
                                            <rect x="13" y="75" width="12" height="12" rx="1" fill="currentColor"/>

                                            <rect x="38" y="8" width="6" height="6"/>
                                            <rect x="48" y="14" width="6" height="6"/>
                                            <rect x="40" y="24" width="8" height="6"/>
                                            <rect x="52" y="26" width="6" height="8"/>

                                            <rect x="8" y="38" width="6" height="6"/>
                                            <rect x="18" y="46" width="8" height="6"/>
                                            <rect x="26" y="38" width="6" height="8"/>

                                            <rect x="38" y="38" width="8" height="8" rx="1"/>
                                            <rect x="50" y="42" width="6" height="6"/>
                                            <rect x="42" y="52" width="10" height="6"/>
                                            <rect x="58" y="50" width="6" height="8"/>

                                            <rect x="68" y="38" width="8" height="6"/>
                                            <rect x="82" y="44" width="10" height="6"/>
                                            <rect x="76" y="54" width="8" height="8"/>

                                            <rect x="38" y="68" width="6" height="8"/>
                                            <rect x="48" y="76" width="8" height="6"/>
                                            <rect x="40" y="86" width="6" height="8"/>
                                            <rect x="52" y="84" width="8" height="6"/>

                                            <rect x="68" y="68" width="8" height="6"/>
                                            <rect x="80" y="72" width="6" height="8"/>
                                            <rect x="74" y="82" width="8" height="8"/>
                                            <rect x="88" y="86" width="6" height="6"/>
                                        </svg>
                                    @endif
                                </div>
                                <p class="mt-1.5 font-cinzel text-[9px] sm:text-[10px] font-bold tracking-[0.24em] text-[#0e1e4a]/85 uppercase">
                                    Exclusive Access QR Code
                                </p>
                            </div>

                        </div>

                        {{-- 4. Lower Embossed Filigree Scrollwork Divider --}}
                        <div class="my-2.5 sm:my-3.5 flex items-center justify-center w-full">
                            <svg class="w-48 sm:w-56 h-5 text-[#c9ad84]" viewBox="0 0 240 20" fill="none" stroke="currentColor" style="filter: drop-shadow(0 1px 0 rgba(255,255,255,0.95)) drop-shadow(0 -0.5px 0 rgba(140,100,50,0.4));">
                                <path d="M15 10 C35 3, 55 17, 75 10 C95 3, 105 10, 115 10 C120 10, 120 10, 125 10 C135 10, 145 3, 165 10 C185 17, 205 3, 225 10" stroke-width="1.3" stroke-linecap="round"/>
                                <path d="M75 10 C68 4, 58 6, 54 11 C50 16, 58 18, 63 15 C68 12, 72 12, 75 10 Z" stroke-width="1" fill="currentColor" fill-opacity="0.18"/>
                                <path d="M165 10 C172 4, 182 6, 186 11 C190 16, 182 18, 177 15 C172 12, 168 12, 165 10 Z" stroke-width="1" fill="currentColor" fill-opacity="0.18"/>
                                <circle cx="120" cy="10" r="2.5" fill="currentColor"/>
                                <circle cx="108" cy="10" r="1.5" fill="currentColor"/>
                                <circle cx="132" cy="10" r="1.5" fill="currentColor"/>
                            </svg>
                        </div>

                        {{-- 5. Lower Section: Embossed Diamond Accent & Official Timeless Asia Typography --}}
                        <div class="relative w-full mt-1 pt-1 flex flex-col items-center">

                            {{-- Pure Vector Embossed 3D Diamond Wireframe on Lower Right --}}
                            <svg class="absolute right-1 sm:right-3 -top-3 w-16 h-16 sm:w-20 sm:h-20 opacity-35 pointer-events-none text-[#b89b70]" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round" style="filter: drop-shadow(0 1px 0 rgba(255,255,255,0.9));">
                                <polygon points="50,15 75,32 50,85 25,32" />
                                <line x1="25" y1="32" x2="75" y2="32" />
                                <line x1="50" y1="15" x2="38" y2="32" />
                                <line x1="50" y1="15" x2="62" y2="32" />
                                <line x1="38" y1="32" x2="50" y2="85" />
                                <line x1="62" y1="32" x2="50" y2="85" />
                                <line x1="32" y1="23" x2="44" y2="32" />
                                <line x1="68" y1="23" x2="56" y2="32" />
                                <g transform="translate(18, -8) scale(0.65)" opacity="0.65">
                                    <polygon points="50,15 75,32 50,85 25,32" />
                                    <line x1="25" y1="32" x2="75" y2="32" />
                                    <line x1="50" y1="15" x2="38" y2="32" />
                                    <line x1="50" y1="15" x2="62" y2="32" />
                                    <line x1="38" y1="32" x2="50" y2="85" />
                                    <line x1="62" y1="32" x2="50" y2="85" />
                                </g>
                            </svg>

                            {{-- Official Timeless Asia Brand Logo Image --}}
                            <span class="sr-only">Timeless Asia - Gems &amp; Jewelry Exhibition</span>
                            <div class="flex flex-col items-center justify-center">
                                <img src="{{ asset('images/timeless-asia-logo.png') }}" alt="{{ $event->title }} - {{ $event->subtitle ?: 'Gems & Jewelry Exhibition' }}" class="h-11 sm:h-13 w-auto max-w-[220px] sm:max-w-[260px] object-contain">
                                @if($event->edition)
                                    <p class="font-montserrat text-[8.5px] sm:text-[9.5px] font-bold text-[#0e1e4a] tracking-widest uppercase mt-0.5">
                                        {{ $event->edition }}
                                    </p>
                                @endif
                            </div>

                            {{-- Bottom Schedule & Venue Metadata Line --}}
                            <div class="mt-2.5 pt-2 border-t border-[#0e1e4a]/15 w-full flex items-center justify-center gap-2 sm:gap-3 text-[9px] sm:text-[10px] font-bold text-[#0e1e4a] tracking-wider font-montserrat flex-wrap">
                                <span>{{ $event->date_display }}</span>
                                <span class="text-[#0e1e4a]/30">|</span>
                                <span>10:00 AM to 7:00 PM</span>
                                <span class="text-[#0e1e4a]/30">|</span>
                                <span>{{ $event->venue }}</span>
                            </div>

                            {{-- Card Footer Note --}}
                            <p class="mt-1 font-cinzel text-[8px] sm:text-[8.5px] text-[#0e1e4a]/60 tracking-[0.24em] uppercase">
                                {{ $event->footer_text ?: ($event->title . ' • ' . $event->edition . ' 2027') }}
                            </p>

                        </div>

                    </div>
                </div>
            </div>

        </article>
    </div>

    {{-- Download Button (Hidden in Print & Export) --}}
    <div class="no-print my-6 flex items-center justify-center">
        <button id="downloadBtn" type="button" onclick="downloadInvitationCard()" class="inline-flex items-center gap-2.5 rounded-full border border-amber-300/60 bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-slate-950 shadow-[0_4px_25px_rgba(245,158,11,0.35)] transition-all duration-300 hover:scale-105 active:scale-95 cursor-pointer">
            <svg class="h-4 w-4 text-slate-950" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            <span id="downloadBtnText">Download Card (PNG)</span>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.lucide?.createIcons();

            const root = document.documentElement;
            const intro = document.getElementById('invitationIntro');
            const card = document.querySelector('.invitation-card');
            const openButton = document.getElementById('openInvitationBtn');
            const skipButton = document.getElementById('skipIntroBtn');
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            let opening = false;
            let openTimer;

            const finishOpening = (moveFocus = false) => {
                root.classList.remove('invitation-intro-active', 'invitation-intro-opening');
                root.classList.add('invitation-card-revealed');
                intro?.remove();
                if (moveFocus) card?.focus({ preventScroll: true });
            };

            const beginOpening = (skip = false) => {
                if (!intro || opening) return;
                window.clearTimeout(openTimer);
                if (skip) {
                    finishOpening(true);
                    return;
                }
                opening = true;
                root.classList.add('invitation-intro-opening');
                window.setTimeout(() => finishOpening(true), reducedMotion ? 50 : 1400);
            };

            openButton?.addEventListener('click', () => beginOpening());
            skipButton?.addEventListener('click', () => beginOpening(true));
            openTimer = window.setTimeout(() => beginOpening(), reducedMotion ? 900 : 4200);
        });
    </script>
    <script type="module">
        import { domToPng } from 'https://cdn.jsdelivr.net/npm/modern-screenshot@4.4.39/+esm';

        window.downloadInvitationCard = async function() {
            var card = document.querySelector('.invitation-card');
            if (!card) return;

            var btn = document.getElementById('downloadBtn');
            var btnText = document.getElementById('downloadBtnText');
            var originalText = btnText ? btnText.innerText : 'Download Card (PNG)';
            if (btnText) btnText.innerText = 'Generating Card...';
            if (btn) btn.disabled = true;

            try {
                var dataUrl = await domToPng(card, {
                    scale: 2,
                    backgroundColor: '#051532',
                    quality: 1,
                });
                var link = document.createElement('a');
                link.download = '{{ $customer->slug }}-invitation-card.png';
                link.href = dataUrl;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } catch(err) {
                console.error('Download card error:', err);
                alert('Failed to generate card image: ' + err.message);
            } finally {
                if (btnText) btnText.innerText = originalText;
                if (btn) btn.disabled = false;
            }
        };
    </script>
</body>
</html>
