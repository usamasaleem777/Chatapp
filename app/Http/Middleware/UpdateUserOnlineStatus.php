<?php

// app/Http/Middleware/UpdateUserOnlineStatus.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UpdateUserOnlineStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Cache::put('user-is-online-' . Auth::id(), true, now()->addSecond(30));
        }

        return $next($request);
    }
}
