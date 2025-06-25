<div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
    <!-- Users List -->
    <div class="w-full md:w-1/4 bg-white dark:bg-gray-800 p-3 sm:p-4 shadow rounded-lg h-[400px] sm:h-[500px] overflow-y-auto">
        <h2 class="font-bold text-base sm:text-lg mb-3 sm:mb-4 dark:text-white">Users</h2>
        <div class="space-y-2">
            @foreach($users as $user)
                <div wire:click="selectUser({{ $user->id }})"
                    class="cursor-pointer px-3 py-2 rounded-lg mb-1 hover:bg-blue-100 dark:hover:bg-gray-700 transition-colors
                    {{ $selectedUser && $selectedUser->id === $user->id ? 'bg-blue-200 dark:bg-gray-600' : 'bg-gray-50 dark:bg-gray-900' }}">
                    <div class="flex items-center justify-between">
                        <span class="text-sm sm:text-base dark:text-gray-200">{{ $user->name }}</span>
                        @if($user->isOnline())
                            <span class="flex items-center text-green-500 text-xs sm:text-sm">
                                <span class="h-2 w-2 bg-green-500 rounded-full mr-1"></span>Online
                            </span>
                        @else
                            <span class="flex items-center text-gray-400 text-xs sm:text-sm">
                                <span class="h-2 w-2 bg-gray-400 rounded-full mr-1"></span>Offline
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Chat Box -->
    <div class="w-full md:w-3/4 bg-white dark:bg-gray-800 p-3 sm:p-4 shadow rounded-lg h-[400px] sm:h-[500px] flex flex-col">
        @if($selectedUser)
            <div class="font-bold text-base sm:text-lg mb-2 dark:text-white">
                Chatting with {{ $selectedUser->name }}
                <span class="text-xs text-blue-500 dark:text-blue-400 ml-2">({{ $selectedUser->email }})</span>
            </div>

            <!-- Messages Container -->
            <div class="flex-1 overflow-y-auto mb-3 sm:mb-4 space-y-3 pr-2">
                @foreach($chatMessages as $msg)
                    <div class="{{ $msg->user_id == auth()->id() ? 'text-right' : 'text-left' }}">
                        <div class="inline-block max-w-xs xs:max-w-sm sm:max-w-md px-3 py-2 rounded-lg
                            {{ $msg->user_id == auth()->id() 
                                ? 'bg-blue-500 text-white rounded-tr-none' 
                                : 'bg-gray-200 dark:bg-gray-700 dark:text-white rounded-tl-none' }}">
                            <span class="text-sm sm:text-base">{{ $msg->message }}</span>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            @php
                                $pakistanTime = $msg->created_at->timezone('Asia/Karachi');
                            @endphp
                            {{ $pakistanTime->format('h:i A') }}
                            @if($pakistanTime->isToday())
                                (Today)
                            @elseif($pakistanTime->isYesterday())
                                (Yesterday)
                            @else
                                ({{ $pakistanTime->format('M d') }})
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Box -->
            <form wire:submit.prevent="sendMessage" class="flex space-x-2">
                <input type="text" wire:model="message"
                    class="flex-1 border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:text-white"
                    placeholder="Type message...">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                    <span class="hidden sm:inline">Send</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:hidden" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        @else
            <div class="flex-1 flex items-center justify-center text-gray-500 dark:text-gray-400">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 dark:text-gray-600 mb-2"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <p class="text-sm sm:text-base">Select a user to start chatting</p>
                </div>
            </div>
        @endif
    </div>
</div>
