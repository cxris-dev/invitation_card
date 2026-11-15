@extends('layouts.management')

@section('title', 'Event Details & Card Settings')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Cormorant+Garamond:ital,wght@1,500;1,600&family=Montserrat:wght@400;500;600;700&family=Noto+Serif+Myanmar:wght@500;600;700&display=swap" rel="stylesheet">
<style>
    .font-cinzel { font-family: 'Cinzel', serif; }
    .font-cormorant { font-family: 'Cormorant Garamond', Georgia, serif; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }
    .font-burmese { font-family: 'Noto Serif Myanmar', 'Myanmar Text', 'Padauk', sans-serif; }
</style>
@endpush

@section('content')
<div class="space-y-6">

    {{-- Breadcrumb & Title Bar --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <nav class="flex items-center gap-2 text-xs font-medium text-gray-400">
                <a href="{{ route('management.exhibitors.index') }}" class="hover:text-gray-600">Management</a>
                <i data-lucide="chevron-right" class="h-3.5 w-3.5"></i>
                <span class="text-[#465fff]">Event Details</span>
            </nav>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">Event Details &amp; Invitation Card</h1>
            <p class="mt-0.5 text-sm text-gray-500">Configure official exhibition branding, dates, venue, and invitation card presentation.</p>
        </div>

        @if($sampleCustomer)
            <div class="flex items-center gap-3">
                <a href="{{ $sampleCustomer->invitation_url }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 hover:text-gray-900">
                    <i data-lucide="external-link" class="h-4 w-4 text-gray-500"></i>
                    <span>Preview Live Card</span>
                </a>
            </div>
        @endif
    </div>

    {{-- Summary Metric Cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Exhibition</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><i data-lucide="gem" class="h-4 w-4"></i></span>
            </div>
            <p class="mt-2 text-lg font-bold text-gray-900 truncate">{{ $event->title }}</p>
            <p class="text-xs font-medium text-blue-600">{{ $event->edition }}</p>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Dates</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-50 text-amber-600"><i data-lucide="calendar" class="h-4 w-4"></i></span>
            </div>
            <p class="mt-2 text-base font-bold text-gray-900 truncate">{{ $event->date_display }}</p>
            <p class="text-xs font-medium text-amber-600">Official Schedule</p>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Venue</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600"><i data-lucide="map-pin" class="h-4 w-4"></i></span>
            </div>
            <p class="mt-2 text-base font-bold text-gray-900 truncate">{{ $event->venue }}</p>
            <p class="text-xs font-medium text-rose-600">Event Location</p>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Exhibitors</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600"><i data-lucide="users" class="h-4 w-4"></i></span>
            </div>
            <p class="mt-2 text-2xl font-bold text-gray-900">{{ $totalExhibitors }}</p>
            <p class="text-xs font-medium text-emerald-600">Registered Delegates</p>
        </div>
    </div>

    {{-- Main 2-Column Content Grid --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

        {{-- Left Column: Event Configuration Form (7 cols) --}}
        <div class="lg:col-span-7">
            <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="border-b border-gray-100 pb-4">
                    <h2 class="text-lg font-bold text-gray-900">Official Exhibition Details</h2>
                    <p class="mt-0.5 text-xs text-gray-500">Update event information. Changes are instantly reflected across all invitation cards.</p>
                </div>

                @if($errors->any())
                    <div class="mt-4 rounded-xl border border-red-200 bg-red-50 p-4 text-xs text-red-700">
                        <div class="flex items-center gap-2 font-semibold text-red-800">
                            <i data-lucide="alert-circle" class="h-4 w-4"></i>
                            <span>Please fix the following errors:</span>
                        </div>
                        <ul class="mt-2 list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('management.events.update') }}" enctype="multipart/form-data" class="mt-5 space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Event Title *</label>
                            <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="mt-1 w-full rounded-xl border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 focus:border-[#465fff] focus:ring-1 focus:ring-[#465fff]">
                            @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Subtitle</label>
                            <input type="text" name="subtitle" value="{{ old('subtitle', $event->subtitle) }}" class="mt-1 w-full rounded-xl border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 focus:border-[#465fff] focus:ring-1 focus:ring-[#465fff]">
                            @error('subtitle') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Edition *</label>
                            <input type="text" name="edition" value="{{ old('edition', $event->edition) }}" required placeholder="e.g. 4th Edition" class="mt-1 w-full rounded-xl border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 focus:border-[#465fff] focus:ring-1 focus:ring-[#465fff]">
                            @error('edition') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Display Dates *</label>
                            <input type="text" name="date_display" value="{{ old('date_display', $event->date_display) }}" required placeholder="e.g. JANUARY 22 - 24 , 2027" class="mt-1 w-full rounded-xl border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 focus:border-[#465fff] focus:ring-1 focus:ring-[#465fff]">
                            @error('date_display') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Venue / Location *</label>
                        <input type="text" name="venue" value="{{ old('venue', $event->venue) }}" required placeholder="e.g. Lotte Hotel Yangon Level 2" class="mt-1 w-full rounded-xl border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 focus:border-[#465fff] focus:ring-1 focus:ring-[#465fff]">
                        @error('venue') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Invitation Honor Text</label>
                        <input type="text" name="invitation_text" value="{{ old('invitation_text', $event->invitation_text) }}" placeholder="e.g. Cordially Requests The Honor Of Your Presence" class="mt-1 w-full rounded-xl border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 focus:border-[#465fff] focus:ring-1 focus:ring-[#465fff]">
                        @error('invitation_text') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Organizer Contact Phone</label>
                            <input type="text" name="contact_phone" value="{{ old('contact_phone', $event->contact_phone) }}" placeholder="e.g. 09450011223" class="mt-1 w-full rounded-xl border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 focus:border-[#465fff] focus:ring-1 focus:ring-[#465fff]">
                            @error('contact_phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Organizer Email</label>
                            <input type="email" name="contact_email" value="{{ old('contact_email', $event->contact_email) }}" placeholder="e.g. info@timelessasia.com" class="mt-1 w-full rounded-xl border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 focus:border-[#465fff] focus:ring-1 focus:ring-[#465fff]">
                            @error('contact_email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Card Footer Note</label>
                        <input type="text" name="footer_text" value="{{ old('footer_text', $event->footer_text) }}" placeholder="e.g. Timeless Asia • 4th Edition 2027" class="mt-1 w-full rounded-xl border border-gray-200 px-3.5 py-2.5 text-sm text-gray-900 focus:border-[#465fff] focus:ring-1 focus:ring-[#465fff]">
                        @error('footer_text') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- Image & QR Code Uploads --}}
                    <div class="pt-3 border-t border-gray-100 space-y-4">
                        {{-- Event Logo --}}
                        <div x-data="{ logoPreview: null }">
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Event Logo (Card Header)</label>
                            <div class="mt-2 flex items-center gap-4">
                                <div class="h-14 w-28 rounded-xl bg-slate-900 p-2 border border-slate-700 flex items-center justify-center shrink-0">
                                    <template x-if="logoPreview">
                                        <img :src="logoPreview" alt="New Logo Preview" class="h-full w-auto object-contain">
                                    </template>
                                    <template x-if="!logoPreview">
                                        <img src="{{ $event->logo_url }}" alt="Event Logo" class="h-full w-auto object-contain">
                                    </template>
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="logo" @change="logoPreview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null" accept="image/png,image/jpeg,image/svg+xml,image/webp,.png,.jpg,.jpeg,.svg,.webp" class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                    <p class="mt-1 text-[11px] text-gray-400">PNG, SVG or WEBP with transparent background recommended (Max 10MB).</p>
                                </div>
                            </div>
                            @error('logo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        {{-- Official Event QR Code --}}
                        <div x-data="{ qrPreview: null }" class="pt-3 border-t border-gray-100">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Official Event QR Code (For All Invitation Cards)</label>
                                @if($event->qr_code_url)
                                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">
                                        <i data-lucide="check" class="h-3 w-3"></i> Custom QR Uploaded
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-amber-600 bg-amber-50 px-2 py-0.5 rounded-md">
                                        <i data-lucide="info" class="h-3 w-3"></i> Using Default QR Graphic
                                    </span>
                                @endif
                            </div>
                            <p class="mt-0.5 text-xs text-gray-500">All invitation cards across the entire exhibition will display this single QR code.</p>

                            <div class="mt-2.5 flex items-center gap-4">
                                <div class="h-16 w-16 rounded-xl bg-white p-1.5 border-2 border-amber-300/60 shadow-xs flex items-center justify-center shrink-0">
                                    <template x-if="qrPreview">
                                        <img :src="qrPreview" alt="Selected QR Preview" class="h-full w-full object-contain rounded">
                                    </template>
                                    <template x-if="!qrPreview">
                                        @if($event->qr_code_url)
                                            <img src="{{ $event->qr_code_url }}" alt="Event QR Code" class="h-full w-full object-contain rounded">
                                        @else
                                            <div class="h-full w-full bg-slate-900 rounded flex flex-col items-center justify-center text-amber-300">
                                                <i data-lucide="qr-code" class="h-6 w-6"></i>
                                            </div>
                                        @endif
                                    </template>
                                </div>
                                <div class="flex-1 space-y-1.5">
                                    <input type="file" name="qr_code" @change="qrPreview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null" accept="image/png,image/jpeg,image/svg+xml,image/webp,.png,.jpg,.jpeg,.svg,.webp" class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                    <p class="text-[11px] text-gray-400">Square PNG, JPG, or SVG recommended (Max 10MB).</p>

                                    @if($event->qr_code_path)
                                        <label class="inline-flex items-center gap-1.5 text-xs text-red-600 hover:text-red-700 font-medium cursor-pointer pt-1">
                                            <input type="checkbox" name="remove_qr_code" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            <span>Remove uploaded QR and revert to default graphic</span>
                                        </label>
                                    @endif
                                </div>
                            </div>
                            @error('qr_code') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-[#465fff] px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#3d54e6] focus:outline-none focus:ring-2 focus:ring-[#465fff] focus:ring-offset-2">
                            <i data-lucide="save" class="h-4 w-4"></i>
                            <span>Save Event Details</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Right Column: Live Card Preview & Details (5 cols) --}}
        <div class="lg:col-span-5 space-y-6">

            {{-- Miniature Live Invitation Card Preview --}}
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Card Layout Preview</h3>
                        <p class="text-xs text-gray-400">Current visual design for exhibitors</p>
                    </div>
                    @if($sampleCustomer)
                        <a href="{{ $sampleCustomer->invitation_url }}" target="_blank" class="inline-flex items-center gap-1 rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-600 hover:bg-blue-100 transition">
                            <span>Open Card</span>
                            <i data-lucide="arrow-up-right" class="h-3.5 w-3.5"></i>
                        </a>
                    @endif
                </div>

                {{-- Mini Render of Card (100% Pure Code: HTML, CSS & SVG) --}}
                <div class="relative w-full rounded-2xl bg-[#061536] p-2.5 sm:p-3 shadow-xl border border-blue-900/60 overflow-hidden text-center select-none">
                    {{-- Myanmar Royal Kanote Background Pattern --}}
                    <div class="pointer-events-none absolute inset-0 opacity-[0.24] overflow-hidden">
                        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="myanmar-royal-kanote-mini" width="70" height="70" patternUnits="userSpaceOnUse">
                                    <g stroke="#93c5fd" fill="#3b82f6" fill-opacity="0.2" stroke-width="0.8" stroke-linecap="round">
                                        <circle cx="35" cy="35" r="5" fill="#60a5fa" stroke="#bfdbfe" stroke-width="0.8"/>
                                        <circle cx="35" cy="35" r="2" fill="#dbeafe"/>
                                        <path d="M35 30 C33 27, 33 24, 35 22 C37 24, 37 27, 35 30 Z"/>
                                        <path d="M35 40 C33 43, 33 46, 35 48 C37 46, 37 43, 35 40 Z"/>
                                        <path d="M30 35 C27 33, 24 33, 22 35 C24 37, 27 37, 30 35 Z"/>
                                        <path d="M40 35 C43 33, 46 33, 48 35 C46 37, 43 37, 40 35 Z"/>
                                        <path d="M38 32 C43 28, 47 26, 50 20 C54 14, 52 8, 48 8 C45 8, 43 12, 46 14 C44 16, 40 18, 36 24 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                        <path d="M32 32 C27 28, 23 26, 20 20 C16 14, 18 8, 22 8 C25 8, 27 12, 24 14 C26 16, 30 18, 34 24 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                        <path d="M38 38 C43 42, 47 44, 50 50 C54 56, 52 62, 48 62 C45 62, 43 58, 46 56 C44 54, 40 52, 36 46 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                        <path d="M32 38 C27 42, 23 44, 20 50 C16 56, 18 62, 22 62 C25 62, 27 58, 24 56 C26 54, 30 52, 34 46 Z" fill="#60a5fa" fill-opacity="0.25"/>
                                        <circle cx="0" cy="0" r="4" fill="#60a5fa" stroke="#bfdbfe" stroke-width="0.8"/>
                                        <circle cx="70" cy="0" r="4" fill="#60a5fa" stroke="#bfdbfe" stroke-width="0.8"/>
                                        <circle cx="0" cy="70" r="4" fill="#60a5fa" stroke="#bfdbfe" stroke-width="0.8"/>
                                        <circle cx="70" cy="70" r="4" fill="#60a5fa" stroke="#bfdbfe" stroke-width="0.8"/>
                                    </g>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#myanmar-royal-kanote-mini)" />
                        </svg>
                    </div>

                    {{-- 3D Molded Roman Cathedral Arch Frame --}}
                    <div class="relative w-full rounded-t-[9999px] rounded-b-xl p-1.5 bg-gradient-to-b from-[#193a7d] via-[#0d2254] to-[#07163c] shadow-[inset_0_2px_4px_rgba(255,255,255,0.3),inset_0_-2px_6px_rgba(0,0,0,0.8),0_6px_16px_rgba(0,0,0,0.5)] border border-blue-400/30">
                        {{-- Inner Arch Molding Layer --}}
                        <div class="relative w-full rounded-t-[9999px] rounded-b-lg p-0.5 bg-gradient-to-b from-[#091b42] to-[#122c66] shadow-[inset_0_3px_6px_rgba(0,0,0,0.7)] border border-blue-300/20">
                            {{-- Champagne Parchment Canvas --}}
                            <div class="relative w-full rounded-t-[9999px] rounded-b-md px-3 pt-5 pb-3.5 flex flex-col items-center text-center overflow-hidden shadow-[inset_0_10px_20px_rgba(15,23,42,0.35)]" style="background: linear-gradient(180deg, #f8eedf 0%, #faf1e5 20%, #f6e8d2 60%, #eedac1 100%);">
                                
                                {{-- 1. Burmese Calligraphic Header --}}
                                <div class="flex flex-col items-center">
                                    <h4 class="font-burmese text-sm sm:text-base font-bold text-[#0e1e4a] leading-tight" style="text-shadow: 0 1px 0 rgba(255,255,255,0.7);">
                                        ကျောက်မျက်ရတနာ
                                    </h4>
                                    <p class="font-burmese text-[10px] sm:text-[11px] font-semibold text-[#0e1e4a]/90 mt-0.5">
                                        အလှတရားတွေနဲ့အတူရှိနေမဲ့
                                    </p>
                                </div>

                                {{-- 2. Upper Filigree Scrollwork Divider --}}
                                <div class="my-1.5 flex items-center justify-center w-full">
                                    <svg class="w-32 h-3.5 text-[#c9ad84]" viewBox="0 0 240 20" fill="none" stroke="currentColor" style="filter: drop-shadow(0 1px 0 rgba(255,255,255,0.95));">
                                        <path d="M15 10 C35 3, 55 17, 75 10 C95 3, 105 10, 115 10 C120 10, 120 10, 125 10 C135 10, 145 3, 165 10 C185 17, 205 3, 225 10" stroke-width="1.3" stroke-linecap="round"/>
                                        <circle cx="120" cy="10" r="2.5" fill="currentColor"/>
                                        <circle cx="108" cy="10" r="1.5" fill="currentColor"/>
                                        <circle cx="132" cy="10" r="1.5" fill="currentColor"/>
                                    </svg>
                                </div>

                                {{-- 3. Center Section: Personalized Exhibitor Pass Details --}}
                                <div class="w-full flex flex-col items-center">
                                    <p class="font-cinzel text-[7px] sm:text-[8px] font-semibold tracking-wider text-[#8a6826] uppercase line-clamp-1">
                                        {{ $event->invitation_text }}
                                    </p>
                                    {{-- Optional Exhibitor Logo --}}
                                    @if($sampleCustomer?->logo_url)
                                        <div class="mt-1 mb-0.5 flex items-center justify-center">
                                            <div class="h-14 w-14 sm:h-16 sm:w-16 max-w-[150px] rounded-xl border border-[#b48222]/50 bg-white/95 p-1 shadow-xs flex items-center justify-center">
                                                <img src="{{ $sampleCustomer->logo_url }}" alt="Exhibitor Logo" class="h-full w-full object-contain rounded-lg">
                                            </div>
                                        </div>
                                    @endif

                                    <p class="mt-0.5 text-[11px] sm:text-xs font-bold uppercase tracking-wider text-[#0e1e4a] truncate max-w-full font-cinzel">
                                        {{ $sampleCustomer?->name ?? 'Exhibitor Name' }}
                                    </p>
                                    <div class="mt-1 inline-flex items-center rounded-full border border-[#b48222] bg-[#f7e096]/50 px-2.5 py-0.5">
                                        <span class="font-cinzel text-[7px] sm:text-[8px] font-bold text-[#0e1e4a] tracking-wider uppercase">
                                            VIP EXHIBITOR
                                        </span>
                                    </div>

                                    <div class="mt-2 flex flex-col items-center">
                                        <div class="rounded-xl border-2 border-[#b48222]/50 bg-white p-1.5 shadow-sm">
                                            @if($event->qr_code_url)
                                                <img src="{{ $event->qr_code_url }}" alt="Event Access QR" class="h-12 w-12 sm:h-14 sm:w-14 object-contain rounded">
                                            @else
                                                <div class="h-12 w-12 sm:h-14 sm:w-14 bg-slate-900 rounded flex flex-col items-center justify-center text-[7px] text-amber-200">
                                                    <i data-lucide="qr-code" class="h-5 w-5 mb-0.5 text-amber-300"></i>
                                                    <span>QR</span>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="mt-1 font-cinzel text-[6.5px] sm:text-[7.5px] font-bold tracking-widest text-[#0e1e4a]/85 uppercase">
                                            Exclusive Access QR
                                        </p>
                                    </div>
                                </div>

                                {{-- 4. Lower Filigree Scrollwork Divider --}}
                                <div class="my-1.5 flex items-center justify-center w-full">
                                    <svg class="w-32 h-3.5 text-[#c9ad84]" viewBox="0 0 240 20" fill="none" stroke="currentColor" style="filter: drop-shadow(0 1px 0 rgba(255,255,255,0.95));">
                                        <path d="M15 10 C35 3, 55 17, 75 10 C95 3, 105 10, 115 10 C120 10, 120 10, 125 10 C135 10, 145 3, 165 10 C185 17, 205 3, 225 10" stroke-width="1.3" stroke-linecap="round"/>
                                        <circle cx="120" cy="10" r="2.5" fill="currentColor"/>
                                        <circle cx="108" cy="10" r="1.5" fill="currentColor"/>
                                        <circle cx="132" cy="10" r="1.5" fill="currentColor"/>
                                    </svg>
                                </div>

                                {{-- 5. Lower Section: Official Timeless Asia Typography & Event Metadata --}}
                                <div class="relative w-full flex flex-col items-center">
                                    {{-- Wireframe Diamond SVG Accent --}}
                                    <svg class="absolute right-0 -top-2 w-10 h-10 opacity-30 pointer-events-none text-[#b89b70]" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <polygon points="50,15 75,32 50,85 25,32" />
                                        <line x1="25" y1="32" x2="75" y2="32" />
                                        <line x1="50" y1="15" x2="38" y2="32" />
                                        <line x1="50" y1="15" x2="62" y2="32" />
                                        <line x1="38" y1="32" x2="50" y2="85" />
                                        <line x1="62" y1="32" x2="50" y2="85" />
                                    </svg>

                                    <div class="flex flex-col items-center justify-center">
                                        <img src="{{ asset('images/timeless-asia-logo.png') }}" alt="{{ $event->title }}" class="h-6 sm:h-7 w-auto max-w-[130px] object-contain">
                                        @if($event->edition)
                                            <p class="font-montserrat text-[6px] sm:text-[7px] font-bold text-[#0e1e4a] tracking-widest uppercase mt-0.5">
                                                {{ $event->edition }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="mt-1.5 pt-1 border-t border-[#0e1e4a]/15 w-full flex items-center justify-center gap-1.5 text-[6.5px] sm:text-[7.5px] font-bold text-[#0e1e4a] tracking-wider font-montserrat flex-wrap">
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
                </div>

                {{-- Card Settings Summary --}}
                <div class="mt-4 space-y-2 border-t border-gray-100 pt-3 text-xs text-gray-600">
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-1.5 text-gray-500"><i data-lucide="check-circle-2" class="h-3.5 w-3.5 text-emerald-500"></i> Global Event QR Code</span>
                        <span class="font-medium text-emerald-600">{{ $event->qr_code_url ? 'Custom Uploaded' : 'Default Active' }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-1.5 text-gray-500"><i data-lucide="minus-circle" class="h-3.5 w-3.5 text-gray-400"></i> Barcode Graphic</span>
                        <span class="font-medium text-gray-400">Disabled</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-1.5 text-gray-500"><i data-lucide="minus-circle" class="h-3.5 w-3.5 text-gray-400"></i> Pass ID &amp; Location</span>
                        <span class="font-medium text-gray-400">Disabled</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-1.5 text-gray-500"><i data-lucide="palette" class="h-3.5 w-3.5 text-indigo-500"></i> Color Theme</span>
                        <span class="font-medium text-indigo-600">Royal Sapphire &amp; Gold</span>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
