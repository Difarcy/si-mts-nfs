<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminIdleTimeout
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $timeoutMinutes = (int) (env('ADMIN_IDLE_TIMEOUT', config('session.lifetime')));
        if ($timeoutMinutes <= 0) {
            return $next($request);
        }

        $now = time();
        $lastActivity = (int) $request->session()->get('admin_last_activity', 0);

        if ($lastActivity > 0) {
            $elapsedSeconds = $now - $lastActivity;
            if ($elapsedSeconds > ($timeoutMinutes * 60)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/auth')->with('error', 'Sesi Anda telah berakhir karena tidak ada aktivitas. Silakan login kembali.');
            }
        }

        $request->session()->put('admin_last_activity', $now);

        return $next($request);
    }
}

