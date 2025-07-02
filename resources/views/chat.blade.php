<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <h2 class="text-xl sm:text-2xl font-bold flex items-center gap-2 text-[#25D366]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.04 2.003a9.948 9.948 0 0 0-8.6 14.89L2 22l5.234-1.375a9.948 9.948 0 0 0 4.806 1.229h.002c5.523 0 10-4.477 10-10s-4.478-9.998-10.002-9.998zm0 18.262a8.306 8.306 0 0 1-4.23-1.168l-.302-.179-3.107.815.829-3.031-.197-.31a8.309 8.309 0 1 1 15.09-4.729 8.31 8.31 0 0 1-8.083 8.602zm4.545-6.206c-.249-.124-1.472-.729-1.7-.812-.228-.083-.394-.124-.56.124s-.645.812-.79.98c-.145.165-.29.186-.54.062-.249-.125-1.053-.389-2.004-1.242-.74-.656-1.24-1.465-1.385-1.713-.144-.249-.015-.384.11-.509.113-.112.249-.29.373-.436.124-.145.165-.248.249-.414.083-.165.042-.31-.02-.435-.062-.124-.56-1.352-.765-1.856-.202-.486-.408-.42-.56-.427l-.478-.01c-.165 0-.435.062-.662.31-.228.248-.868.847-.868 2.06 0 1.212.89 2.382 1.014 2.548.124.165 1.751 2.672 4.246 3.742.593.256 1.056.408 1.416.521.595.19 1.137.163 1.565.1.477-.071 1.472-.601 1.678-1.183.206-.58.206-1.076.145-1.183-.062-.104-.228-.165-.477-.289z" />
                </svg>
                WhatsApp123
            </h2>
            <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">Live Chat</span>
        </div>
    </x-slot>

    <div class="py-4 sm:py-6">
        <div class="max-w-6xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-lg rounded-lg sm:rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 transition-all">
                <div class="bg-gradient-to-r from-green-400 to-green-600 px-4 py-3 sm:px-6 sm:py-4">
                    <div class="flex items-center gap-2">
                        <h3 class="text-base sm:text-lg font-semibold text-white">👥 Chat Room</h3>
                        <span class="hidden xs:inline-block px-2 py-1 text-xs bg-green-700 bg-opacity-50 rounded-full">Live</span>
                    </div>
                    <p class="text-xs sm:text-sm text-green-100 mt-1">Connect and chat in real-time.</p>
                </div>

                <div class="p-3 sm:p-4 bg-gray-50 dark:bg-gray-800">
                    @livewire('chat')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>