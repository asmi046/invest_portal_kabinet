<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateFileDownloadGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Проверяем авторизацию в web или moonshine guard
        if (Auth::guard('web')->check() || Auth::guard('moonshine')->check()) {
            return $next($request);
        }

        // Если не авторизован ни в одном guard - редирект на страницу входа
        return redirect()->guest(route('login'));
    }
}
