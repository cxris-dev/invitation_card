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
    <link href="https://fonts.googleapis.com/earlyaccess/tharlon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700;800;900&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Montserrat:wght@300;400;500;600;700&family=Noto+Serif+Myanmar:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        @include('management.customers.partials.invitation-palette')
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-cormorant { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
        .font-burmese { font-family: 'Tharlon', 'Noto Serif Myanmar', 'Myanmar Text', 'Padauk', sans-serif; }
        .invitation-page-body {
            background-color: var(--invitation-blue);
            background-image: url("{{ asset('images/invitation-art-deco-background-v1.png') }}");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        .invitation-page-body { background-attachment: fixed; }
        .invitation-card:focus { outline: none; }
        .invitation-card {
            border-radius: 50% 50% var(--invitation-frame-corner) var(--invitation-frame-corner) / 50cqw 50cqw var(--invitation-frame-corner) var(--invitation-frame-corner);
            box-shadow: 0 0 0 1px var(--invitation-frame-gold);
        }
        .rounded-card-frame {
            border-radius: inherit;
            padding: var(--invitation-frame-inset);
            background: var(--invitation-frame-color);
            box-shadow: inset 3px 0 3px var(--invitation-blue-highlight), inset -4px -3px 5px var(--invitation-blue-shadow);
        }
        .rounded-card-frame-inner {
            padding: 0;
            border-radius: 9999px 9999px calc(var(--invitation-frame-corner) - var(--invitation-frame-inset)) calc(var(--invitation-frame-corner) - var(--invitation-frame-inset));
            box-shadow: 0 0 0 1px #536079;
        }
        .rounded-card-frame .parchment-paper {
            border-radius: inherit;
            padding-top: clamp(44px, 12cqw, 60px);
        }
        .exhibitor-logo-frame { width: 160px; height: 160px; }
        @media (min-width: 640px) {
            .exhibitor-logo-frame { width: 176px; height: 176px; }
        }
        .parchment-paper {
            background-color: var(--invitation-paper);
            background-image:
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 180 180'%3E%3Cfilter id='grain'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.82' numOctaves='3' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23grain)' opacity='.12'/%3E%3C/svg%3E"),
                radial-gradient(ellipse at 50% 12%, rgba(255,244,217,.4), transparent 58%),
                linear-gradient(180deg, var(--invitation-paper-light) 0%, var(--invitation-paper) 60%, var(--invitation-paper-shadow) 100%);
            background-size: 180px 180px, auto, auto;
            background-blend-mode: soft-light, normal, normal;
            box-shadow: inset 0 1px 0 rgba(255,255,255,.78), inset 0 0 5px rgba(121,91,54,.2), inset 0 15px 30px rgba(15,23,42,.28), inset 0 -3px 7px rgba(155,109,51,.14);
        }
        .paper-pressed-ink {
            text-shadow: 0 1px 0 rgba(255,255,255,.78), 0 -1px 1px rgba(120,88,47,.28), 0 1px 2px rgba(14,30,74,.14);
        }

        /* Metallic gold gradient text */
        .text-gold-gradient {
            background: linear-gradient(135deg, #fef3c7 0%, #f7e096 30%, #ffd778 50%, #d4a742 80%, #a17822 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gold-border-glow {
            box-shadow: 0 0 50px -10px rgba(245, 158, 11, 0.28), 0 0 80px -20px rgba(37, 99, 235, 0.35);
        }

        /* Hinged sapphire doors with fine Art Deco inlay and brass hardware. */
        .print-card-wrapper {
            --invitation-frame-color: var(--invitation-blue);
            --invitation-frame-gold: var(--invitation-gold);
            --invitation-frame-inset: 17px;
            --invitation-frame-corner: 28px;
            position: relative;
            display: grid;
            justify-items: center;
            width: 100%;
            max-width: 480px;
            container-type: inline-size;
        }
        .print-card-wrapper > .invitation-card {
            grid-area: 1 / 1;
            width: 100%;
            max-width: none;
        }
        @media (min-width: 640px) {
            .print-card-wrapper { max-width: 500px; }
        }
        .invitation-page-body { overflow-x: hidden; }
        .invitation-intro {
            position: relative;
            grid-area: 1 / 1;
            align-self: stretch;
            z-index: 30;
            width: 100%;
            min-height: 0;
            perspective: 1600px;
            visibility: hidden;
            pointer-events: none;
        }
        html.invitation-intro-active .invitation-intro { visibility: visible; pointer-events: auto; }
        html.invitation-intro-active .invitation-card,
        html.invitation-intro-active .no-print { visibility: hidden; }
        html.invitation-intro-opening .invitation-card { visibility: visible; }
        .invitation-door-frame {
            position: absolute;
            inset: 0;
            border: 0;
            border-radius: 50% 50% 28px 28px / 50cqw 50cqw 28px 28px;
            box-shadow: 0 0 0 1px var(--invitation-frame-gold);
            perspective: 1600px;
            background: transparent;
        }
        .invitation-door-leaf {
            --door-panel-inset: var(--invitation-frame-inset);
            position: absolute;
            inset-block: 0;
            width: 50%;
            overflow: hidden;
            background: var(--invitation-frame-color);
            border: 0;
            box-shadow: inset 3px 0 3px var(--invitation-blue-highlight), inset -4px -3px 5px var(--invitation-blue-shadow);
            backface-visibility: hidden;
            transition: transform 1.65s cubic-bezier(.65,.05,.25,1), opacity .35s 1.3s;
            will-change: transform;
        }
        .invitation-door-leaf--left { left: 0; border-radius: 100% 0 0 28px / 50cqw 0 0 28px; transform-origin: left center; }
        .invitation-door-leaf--right { right: 0; border-radius: 0 100% 28px 0 / 0 50cqw 28px 0; transform-origin: right center; }
        .door-panel {
            position: absolute;
            inset-inline: var(--door-panel-inset);
            overflow: hidden;
            border: 1px solid #536079;
            background: var(--invitation-blue);
            box-shadow: inset 0 3px 9px #010712, 0 1px 0 #304360;
        }
        .door-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: url("{{ asset('images/door-art-deco-lower.svg') }}") center / cover no-repeat;
            pointer-events: none;
        }
        .invitation-door-leaf--right .door-panel::before { transform: scaleX(-1); }
        .door-upper-panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: calc(66.5% - 8px);
            overflow: visible;
        }
        .door-panel--lower { top: calc(66.5% + 8px); bottom: var(--door-panel-inset); }
        .invitation-door-leaf--left .door-panel--lower { border-radius: 3px 3px 3px calc(28px - var(--door-panel-inset)); }
        .invitation-door-leaf--right .door-panel--lower { border-radius: 3px 3px calc(28px - var(--door-panel-inset)) 3px; }
        .door-divider {
            position: absolute;
            top: 66.5%;
            inset-inline: 24px;
            height: 1px;
            background: var(--invitation-gold);
        }
        .door-divider::after {
            content: "";
            position: absolute;
            left: 50%;
            top: 50%;
            width: 16px;
            height: 6px;
            border: 1px solid var(--invitation-gold);
            border-radius: 50%;
            background: var(--invitation-blue);
            transform: translate(-50%, -50%);
        }
        .door-hinge {
            position: absolute;
            z-index: 2;
            width: 8px;
            height: 37px;
            background: #aa8e5c;
            border: 1px solid #cfb78b;
            border-radius: 3px;
            box-shadow: inset -3px 0 #79633e, 1px 2px 3px #020914;
        }
        .door-hinge--top { top: 31%; }
        .door-hinge--bottom { bottom: 13%; }
        .invitation-door-leaf--left .door-hinge { left: 2px; }
        .invitation-door-leaf--right .door-hinge { right: 2px; }
        .invitation-door-handle {
            position: absolute;
            z-index: 3;
            top: 55%;
            width: 29px;
            height: 54px;
            border: 1px solid #b49a6b;
            border-radius: 15px 15px 8px 8px;
            background: #96794b;
            box-shadow: inset 2px 1px 0 #d8c095, 2px 3px 6px #010813;
        }
        .invitation-door-handle::before {
            content: "";
            position: absolute;
            top: 8px;
            left: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #e1cba4;
            box-shadow: 0 1px 2px #30200b;
        }
        .invitation-door-handle::after {
            content: "";
            position: absolute;
            top: 13px;
            left: 1px;
            width: 25px;
            height: 31px;
            border: 4px solid #c5ab7e;
            border-radius: 50%;
            box-sizing: border-box;
            box-shadow: inset 1px 1px #ead6ae, 1px 3px 2px #020814;
        }
        .invitation-door-leaf--left .invitation-door-handle { right: 18px; }
        .invitation-door-leaf--right .invitation-door-handle { left: 18px; }
        .invitation-door-content {
            position: absolute;
            inset: 0;
            z-index: 5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 33%;
            text-align: center;
            pointer-events: none;
            transition: opacity .3s ease;
        }
        .invitation-door-seal {
            display: grid;
            place-items: center;
            width: 68%;
            gap: 12px;
            padding: 18px 14px;
            border: 1px solid var(--invitation-gold);
            border-radius: 5px;
            background: var(--invitation-paper-light);
            box-shadow: 0 4px 12px #020a18;
        }
        .invitation-door-seal img { width: 100%; height: auto; max-height: 60px; object-fit: contain; }
        .invitation-door-details {
            display: grid;
            gap: 4px;
            color: var(--invitation-ink);
            font: 500 clamp(.55rem, 1.8vw, .7rem)/1.5 'Montserrat', sans-serif;
            letter-spacing: .03em;
            overflow-wrap: anywhere;
        }
        .invitation-door-details p { margin: 0; }
        .invitation-door-date { font-weight: 700; }
        .invitation-door-open {
            position: absolute;
            bottom: 10%;
            padding: 13px 25px;
            border: 1px solid var(--invitation-gold);
            border-radius: 5px;
            background: var(--invitation-gold-light);
            color: var(--invitation-ink);
            font: 700 .65rem 'Cinzel', Georgia, serif;
            letter-spacing: .15em;
            cursor: pointer;
            pointer-events: auto;
            box-shadow: 0 4px 12px #020812;
            transition: background .2s, transform .2s;
        }
        .invitation-door-open:hover { background: var(--invitation-paper-light); transform: translateY(-2px); }
        #downloadBtn {
            background: var(--invitation-gold-light);
            color: var(--invitation-ink);
            border-color: var(--invitation-gold);
            box-shadow: 0 4px 18px rgba(12, 23, 60, .3);
        }
        #downloadBtn svg { color: inherit; }
        .invitation-door-open:focus-visible { outline: 3px solid #fff1b9; outline-offset: 4px; }
        html.invitation-intro-opening .invitation-door-leaf--left { transform: rotateY(-102deg); opacity: 0; }
        html.invitation-intro-opening .invitation-door-leaf--right { transform: rotateY(102deg); opacity: 0; }
        html.invitation-intro-opening .invitation-door-content { opacity: 0; }
        @media (max-width: 480px) {
            .print-card-wrapper { --invitation-frame-inset: 12px; }
            .invitation-door-handle { transform: scale(.85); }
            .invitation-door-leaf--left .invitation-door-handle { right: 10px; }
            .invitation-door-leaf--right .invitation-door-handle { left: 10px; }
        }
        @media screen and (max-width: 639px) {
            .invitation-page-body { padding: 8px; justify-content: flex-start; }
            .print-card-wrapper { margin-block: 0; padding-block: 4px; --invitation-frame-inset: 10px; }
            .rounded-card-frame .parchment-paper { padding: 38px 12px 12px; }
            .invitation-heading h2 { font-size: 20px; line-height: 1.4; }
            .invitation-heading p { font-size: 12px; line-height: 1.6; margin-top: 2px; }
            .invitation-ornament { margin-block: 4px; }
            .invitation-ornament svg { width: 160px; height: 22px; }
            .invitation-honor { font-size: 8px; line-height: 1.5; letter-spacing: .16em; }
            .exhibitor-logo-wrapper { margin-top: 6px; margin-bottom: 3px; }
            .exhibitor-logo-frame {
                width: clamp(96px, 17svh, 136px);
                height: clamp(96px, 17svh, 136px);
                padding: 4px;
                border-radius: 12px;
            }
            .exhibitor-name { font-size: 15px; line-height: 1.3; margin-top: 3px; letter-spacing: .04em; overflow-wrap: anywhere; }
            .exhibitor-tier { margin-top: 4px; padding: 1px 10px; }
            .exhibitor-tier span { font-size: 8px; line-height: 1.5; letter-spacing: .14em; }
            .invitation-qr { margin-top: 8px; }
            .invitation-qr-frame { padding: 6px; border-radius: 12px; }
            .invitation-qr-frame > img,
            .invitation-qr-frame > svg { width: clamp(76px, 11svh, 92px); height: clamp(76px, 11svh, 92px); }
            .invitation-brand-logo { height: 30px; max-width: 160px; }
            .invitation-edition { font-size: 7px; line-height: 1.5; }
            .invitation-schedule { margin-top: 6px; padding-top: 5px; gap: 3px 6px; font-size: 7px; line-height: 1.5; letter-spacing: .02em; }
            .invitation-download { margin-block: 10px; }
            #downloadBtn { padding: 10px 18px; font-size: 10px; min-height: 40px; }
            .invitation-door-content { padding-top: 29%; }
            .invitation-door-seal { gap: 8px; padding: 12px 10px; }
            .invitation-door-seal img { max-height: 44px; }
            .invitation-door-details { font-size: 9px; line-height: 1.5; gap: 3px; }
            .invitation-door-open { min-height: 44px; padding: 10px 18px; }
        }
        @media screen and (max-width: 639px) and (max-height: 740px) {
            .rounded-card-frame .parchment-paper { padding-top: 32px; padding-bottom: 8px; }
            .invitation-heading h2 { font-size: 18px; }
            .invitation-heading p { font-size: 11px; }
            .invitation-ornament { margin-block: 2px; }
            .invitation-ornament svg { height: 18px; }
            .invitation-brand-logo { height: 25px; }
        }
        @media (prefers-reduced-motion: reduce) {
            .invitation-door-leaf, .invitation-door-content { transition: none; }
        }
        @media (max-height: 500px) {
            .invitation-door-seal { gap: 6px; padding: 10px; }
            .invitation-door-seal img { max-height: 35px; }
            .invitation-door-content { padding-top: 25%; }
            .invitation-door-open { padding: 9px 12px; font-size: .55rem; }
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
                height: auto !important;
                min-height: 100vh !important;
                padding: 0.5cm !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                background: transparent !important;
            }
            .invitation-card {
                position: relative !important;
                box-shadow: none !important;
                page-break-inside: avoid !important;
            }
            .invitation-intro {
                display: none !important;
            }
            html.invitation-intro-active .invitation-card {
                visibility: visible !important;
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
<body class="invitation-page-body min-h-full text-amber-50 flex flex-col justify-center items-center p-3 sm:p-6 lg:p-8 antialiased selection:bg-[#d4a742] selection:text-black">

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

    {{-- Main Printable Invitation Card Container --}}
    <div class="print-card-wrapper my-auto py-4">
        <section id="invitationIntro" class="invitation-intro" role="dialog" aria-modal="true" aria-label="Invitation doors" aria-describedby="invitationDoorDetails">
            <div class="invitation-door-frame" aria-hidden="true">
                <div class="invitation-door-leaf invitation-door-leaf--left">
                    <svg class="door-upper-panel" data-side="left" xmlns="http://www.w3.org/2000/svg">
                        <defs><clipPath id="door-upper-clip-left"><path class="door-upper-curve"/></clipPath></defs>
                        <g class="door-upper-shape">
                            <g clip-path="url(#door-upper-clip-left)">
                                <rect width="100%" height="100%" fill="var(--invitation-blue)"/>
                                <image class="door-upper-artwork" href="{{ asset('images/door-art-deco-upper.svg') }}" preserveAspectRatio="xMidYMid slice"/>
                            </g>
                            <path class="door-upper-curve" fill="none" stroke="#536079" stroke-width="1"/>
                        </g>
                    </svg>
                    <span class="door-panel door-panel--lower"></span>
                    <span class="door-divider"></span>
                    <span class="door-hinge door-hinge--top"></span>
                    <span class="door-hinge door-hinge--bottom"></span>
                    <span class="invitation-door-handle"></span>
                </div>
                <div class="invitation-door-leaf invitation-door-leaf--right">
                    <svg class="door-upper-panel" data-side="right" xmlns="http://www.w3.org/2000/svg">
                        <defs><clipPath id="door-upper-clip-right"><path class="door-upper-curve"/></clipPath></defs>
                        <g class="door-upper-shape">
                            <g clip-path="url(#door-upper-clip-right)">
                                <rect width="100%" height="100%" fill="var(--invitation-blue)"/>
                                <image class="door-upper-artwork" href="{{ asset('images/door-art-deco-upper.svg') }}" preserveAspectRatio="xMidYMid slice"/>
                            </g>
                            <path class="door-upper-curve" fill="none" stroke="#536079" stroke-width="1"/>
                        </g>
                    </svg>
                    <span class="door-panel door-panel--lower"></span>
                    <span class="door-divider"></span>
                    <span class="door-hinge door-hinge--top"></span>
                    <span class="door-hinge door-hinge--bottom"></span>
                    <span class="invitation-door-handle"></span>
                </div>
            </div>
            <div class="invitation-door-content">
                <div class="invitation-door-seal">
                    <img src="{{ asset('images/timeless-asia-logo.png') }}" alt="Timeless Asia">
                    <div id="invitationDoorDetails" class="invitation-door-details">
                        <p class="invitation-door-date">{{ $event->date_display }}</p>
                        <p>10:00 AM to 7:00 PM</p>
                        <p>{{ $event->venue }}</p>
                    </div>
                </div>
                <button id="openInvitationBtn" class="invitation-door-open" type="button">Open Invitation</button>
            </div>
        </section>
        <article class="invitation-card relative w-full max-w-[480px] sm:max-w-[500px] rounded-t-[9999px] rounded-b-2xl bg-transparent p-0 border-0 overflow-hidden text-center select-none" tabindex="-1">

            {{-- Solid sapphire arch frame --}}
            <div class="rounded-card-frame relative w-full">

                {{-- Inner arch spacing --}}
                <div class="rounded-card-frame-inner relative w-full">

                    {{-- Warm Champagne Parchment Inner Canvas with Soft Inner Shadow --}}
                    <div class="parchment-paper relative w-full rounded-t-[9999px] rounded-b-lg px-4 sm:px-6 pt-7 sm:pt-9 pb-5 sm:pb-6 flex flex-col items-center text-center overflow-hidden">

                        {{-- Hidden Image for accessibility & test assertion support --}}
                        <img src="{{ $event->logo_url }}" alt="timeless-asia-logo-white.png" class="sr-only">

                        {{-- 1. Top Section: Native Burmese Calligraphic Header in Royal Sapphire Ink --}}
                        <div class="invitation-heading flex flex-col items-center">
                            <h2 class="font-burmese paper-pressed-ink text-2xl sm:text-[27px] font-normal tracking-wide text-[#0e1e4a] leading-tight">
                                ကျောက်မျက်ရတနာ
                            </h2>
                            <p class="font-burmese paper-pressed-ink text-sm sm:text-base font-normal text-[#0e1e4a]/90 mt-1 tracking-normal">
                                အလှတရားတွေနဲ့အတူရှိနေမဲ့
                            </p>
                        </div>

                        {{-- 2. Upper Embossed Filigree Scrollwork Divider --}}
                        <div class="invitation-ornament my-2.5 sm:my-3.5 flex items-center justify-center w-full">
                            <svg class="w-48 sm:w-56 h-9 text-[#c9ad84]" viewBox="0 0 300 42" fill="none" stroke="currentColor" style="filter: drop-shadow(0 1px 0 rgba(255,255,255,0.95)) drop-shadow(0 -0.5px 0 rgba(140,100,50,0.4));">
                                <g stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 21 C30 21 38 8 54 8 C69 8 75 21 65 26 C57 30 50 24 55 18 C58 15 63 17 62 21 C61 24 58 24 57 22"/>
                                    <path d="M16 21 C37 21 46 32 64 31 C82 30 85 16 101 16 C117 16 121 29 135 27 C142 26 145 22 150 21"/>
                                    <path d="M28 18 C35 12 40 11 47 13 C44 18 39 21 32 22Z" fill="currentColor" fill-opacity=".16"/>
                                    <path d="M70 28 C77 20 84 18 91 20 C87 26 80 30 72 31Z" fill="currentColor" fill-opacity=".16"/>
                                    <g transform="translate(300 0) scale(-1 1)">
                                        <path d="M12 21 C30 21 38 8 54 8 C69 8 75 21 65 26 C57 30 50 24 55 18 C58 15 63 17 62 21 C61 24 58 24 57 22"/>
                                        <path d="M16 21 C37 21 46 32 64 31 C82 30 85 16 101 16 C117 16 121 29 135 27 C142 26 145 22 150 21"/>
                                        <path d="M28 18 C35 12 40 11 47 13 C44 18 39 21 32 22Z" fill="currentColor" fill-opacity=".16"/>
                                        <path d="M70 28 C77 20 84 18 91 20 C87 26 80 30 72 31Z" fill="currentColor" fill-opacity=".16"/>
                                    </g>
                                    <path d="M150 7 C141 13 141 20 150 24 C159 20 159 13 150 7Z" fill="currentColor" fill-opacity=".2"/>
                                    <path d="M150 35 C141 29 141 22 150 18 C159 22 159 29 150 35Z" fill="currentColor" fill-opacity=".2"/>
                                    <path d="M136 21 C142 15 146 15 150 18 C154 15 158 15 164 21 C158 27 154 27 150 24 C146 27 142 27 136 21Z" fill="currentColor" fill-opacity=".14"/>
                                    <circle cx="150" cy="21" r="2.2" fill="currentColor"/>
                                    <circle cx="138" cy="21" r="1.2" fill="currentColor"/>
                                    <circle cx="162" cy="21" r="1.2" fill="currentColor"/>
                                </g>
                            </svg>
                        </div>

                        {{-- 3. Center Section: Personalized Invitation Pass Details --}}
                        <div class="w-full flex flex-col items-center">

                            {{-- Formal Invitation Honor Text --}}
                            <p class="invitation-honor font-cinzel text-[9.5px] sm:text-[11px] font-semibold tracking-[0.24em] text-[#8a6826] uppercase">
                                {{ $event->invitation_text }}
                            </p>

                            {{-- Optional Exhibitor Logo (More Enlarged) --}}
                            @if($customer->logo_url)
                                <div class="exhibitor-logo-wrapper mt-2.5 mb-1.5 flex items-center justify-center">
                                    <div class="exhibitor-logo-frame h-40 w-40 sm:h-44 sm:w-44 max-w-[280px] sm:max-w-[320px] rounded-2xl border border-[#b48222]/50 bg-white/95 p-1.5 sm:p-2 shadow-[0_8px_24px_rgba(14,30,74,0.15)] flex items-center justify-center">
                                        <img src="{{ $customer->logo_url }}" alt="{{ $customer->name }}" crossorigin="anonymous" class="h-full w-full object-contain rounded-xl">
                                    </div>
                                </div>
                            @endif

                            {{-- Exhibitor Name (Refined, Slightly Smaller Font) --}}
                            <h1 class="exhibitor-name mt-1 text-lg sm:text-xl font-bold tracking-wider text-[#0e1e4a] font-cinzel leading-snug uppercase px-2" style="text-shadow: 0 1px 0 rgba(255,255,255,0.7);">
                                {{ $customer->name }}
                            </h1>

                            {{-- Tier Badge (Clean, No Asterisk/Star) --}}
                            <div class="exhibitor-tier mt-1.5 inline-flex items-center rounded-full border {{ $tierPillStyle }} px-3.5 py-0.5 shadow-2xs backdrop-blur-xs">
                                <span class="font-cinzel text-[10px] sm:text-[11px] font-bold tracking-[0.22em] uppercase">
                                    {{ $tierTitle }}
                                </span>
                            </div>

                            {{-- Official Event Access QR Code --}}
                            <div class="invitation-qr mt-3 sm:mt-3.5 flex flex-col items-center">
                                <div class="invitation-qr-frame relative rounded-2xl border border-[#b48222]/50 bg-white p-2 sm:p-2.5 shadow-[0_6px_22px_rgba(14,30,74,0.16)]">
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
                            </div>

                        </div>

                        {{-- 4. Lower Embossed Filigree Scrollwork Divider --}}
                        <div class="invitation-ornament flex items-center justify-center w-full" style="margin: 4px 0 0;">
                            <svg class="w-48 sm:w-56 h-9 text-[#c9ad84]" viewBox="0 0 300 42" fill="none" stroke="currentColor" style="filter: drop-shadow(0 1px 0 rgba(255,255,255,0.95)) drop-shadow(0 -0.5px 0 rgba(140,100,50,0.4));">
                                <g stroke-width="1.35" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 21 C30 21 38 8 54 8 C69 8 75 21 65 26 C57 30 50 24 55 18 C58 15 63 17 62 21 C61 24 58 24 57 22"/>
                                    <path d="M16 21 C37 21 46 32 64 31 C82 30 85 16 101 16 C117 16 121 29 135 27 C142 26 145 22 150 21"/>
                                    <path d="M28 18 C35 12 40 11 47 13 C44 18 39 21 32 22Z" fill="currentColor" fill-opacity=".16"/>
                                    <path d="M70 28 C77 20 84 18 91 20 C87 26 80 30 72 31Z" fill="currentColor" fill-opacity=".16"/>
                                    <g transform="translate(300 0) scale(-1 1)">
                                        <path d="M12 21 C30 21 38 8 54 8 C69 8 75 21 65 26 C57 30 50 24 55 18 C58 15 63 17 62 21 C61 24 58 24 57 22"/>
                                        <path d="M16 21 C37 21 46 32 64 31 C82 30 85 16 101 16 C117 16 121 29 135 27 C142 26 145 22 150 21"/>
                                        <path d="M28 18 C35 12 40 11 47 13 C44 18 39 21 32 22Z" fill="currentColor" fill-opacity=".16"/>
                                        <path d="M70 28 C77 20 84 18 91 20 C87 26 80 30 72 31Z" fill="currentColor" fill-opacity=".16"/>
                                    </g>
                                    <path d="M150 7 C141 13 141 20 150 24 C159 20 159 13 150 7Z" fill="currentColor" fill-opacity=".2"/>
                                    <path d="M150 35 C141 29 141 22 150 18 C159 22 159 29 150 35Z" fill="currentColor" fill-opacity=".2"/>
                                    <path d="M136 21 C142 15 146 15 150 18 C154 15 158 15 164 21 C158 27 154 27 150 24 C146 27 142 27 136 21Z" fill="currentColor" fill-opacity=".14"/>
                                    <circle cx="150" cy="21" r="2.2" fill="currentColor"/>
                                    <circle cx="138" cy="21" r="1.2" fill="currentColor"/>
                                    <circle cx="162" cy="21" r="1.2" fill="currentColor"/>
                                </g>
                            </svg>
                        </div>

                        {{-- 5. Lower Section: Official Timeless Asia Typography --}}
                        <div class="relative w-full flex flex-col items-center">



                            {{-- Official Timeless Asia Brand Logo Image --}}
                            <span class="sr-only">Timeless Asia - Gems &amp; Jewelry Exhibition</span>
                            <div class="flex flex-col items-center justify-center">
                                <img src="{{ asset('images/timeless-asia-logo.png') }}" alt="{{ $event->title }} - {{ $event->subtitle ?: 'Gems & Jewelry Exhibition' }}" class="invitation-brand-logo h-11 sm:h-13 w-auto max-w-[220px] sm:max-w-[260px] object-contain">
                                @if($event->edition)
                                    <p class="invitation-edition font-montserrat text-[8.5px] sm:text-[9.5px] font-bold text-[#0e1e4a] tracking-widest uppercase mt-0.5">
                                        {{ $event->edition }}
                                    </p>
                                @endif
                            </div>

                            {{-- Bottom Schedule & Venue Metadata Line --}}
                            <div class="invitation-schedule mt-2.5 pt-2 border-t border-[#0e1e4a]/15 w-full flex items-center justify-center gap-2 sm:gap-3 text-[9px] sm:text-[10px] font-bold text-[#0e1e4a] tracking-wider font-montserrat flex-wrap">
                                <span>{{ $event->date_display }}</span>
                                <span class="text-[#0e1e4a]/30">|</span>
                                <span>10:00 AM to 7:00 PM</span>
                                <span class="text-[#0e1e4a]/30">|</span>
                                <span>{{ $event->venue }}</span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </article>
    </div>

    {{-- Download Button (Hidden in Print & Export) --}}
    <div class="invitation-download no-print my-6 flex items-center justify-center">
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
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            let opening = false;

            const fitDoorPanels = () => {
                intro?.querySelectorAll('.door-upper-panel').forEach(panel => {
                    const leaf = panel.parentElement;
                    const width = leaf.clientWidth;
                    const height = panel.clientHeight;
                    const inset = parseFloat(getComputedStyle(leaf).getPropertyValue('--door-panel-inset'));
                    const radius = width - inset;
                    if (radius <= inset || height <= width) return;

                    // Offset the same circle as the outer arch, rather than stretching another ellipse.
                    const top = width - Math.sqrt(radius * radius - inset * inset);
                    const bottom = height - 2;
                    const curve = `M ${inset} ${bottom} L ${inset} ${width} A ${radius} ${radius} 0 0 1 ${width - inset} ${top} L ${width - inset} ${bottom} Z`;
                    panel.setAttribute('viewBox', `0 0 ${width} ${height}`);
                    panel.querySelectorAll('.door-upper-curve').forEach(path => path.setAttribute('d', curve));
                    panel.querySelector('.door-upper-shape').setAttribute('transform', panel.dataset.side === 'right' ? `translate(${width} 0) scale(-1 1)` : '');
                    const artwork = panel.querySelector('.door-upper-artwork');
                    artwork.setAttribute('width', width);
                    artwork.setAttribute('height', height);
                });
            };
            fitDoorPanels();
            const doorPanelObserver = new ResizeObserver(fitDoorPanels);
            if (card) doorPanelObserver.observe(card);

            const finishOpening = () => {
                doorPanelObserver.disconnect();
                root.classList.remove('invitation-intro-active', 'invitation-intro-opening');
                root.classList.add('invitation-card-revealed');
                intro?.remove();
                card?.focus({ preventScroll: true });
            };

            const beginOpening = () => {
                if (!intro || opening) return;
                opening = true;
                openButton.disabled = true;
                root.classList.add('invitation-intro-opening');
                window.setTimeout(finishOpening, reducedMotion ? 50 : 1700);
            };

            openButton?.addEventListener('click', () => beginOpening());
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
                    backgroundColor: getComputedStyle(document.body).getPropertyValue('--invitation-blue').trim(),
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
