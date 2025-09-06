<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Header -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    <!-- Alpine.js (for dropdowns, modals, etc.) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Preload Audio -->
  <audio id="msg-sound" src="{{ asset('sounds/message.mp3') }}" preload="auto"></audio>

    <!-- Laravel Echo Listener for Private Chat -->
<script>
    document.addEventListener('livewire:load', function () {
        const form = document.getElementById('chat-form');
        const audio = document.getElementById('msg-sound');

        if (!form) {
            console.warn("⚠️ chat-form not found");
            return;
        }
        if (!audio) {
            console.warn("⚠️ msg-sound not found");
            return;
        }

        form.addEventListener('submit', () => {
            // Slight delay to ensure Livewire doesn't interrupt playback
            setTimeout(() => {
                audio.play()
                    .then(() => console.log("✅ Send sound played"))
                    .catch(err => console.warn("❌ Sound blocked:", err));
            }, 50); // Slight delay helps with some Livewire sync issues
        });
    });
</script>

</body>
</html>
