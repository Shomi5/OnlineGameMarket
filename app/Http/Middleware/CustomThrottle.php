<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Symfony\Component\HttpFoundation\Response;

class CustomThrottle extends ThrottleRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, ...$parameters): Response
    {
        try {
          
            return parent::handle($request,$next, ...$parameters);
        } catch (ThrottleRequestsException $e) {
            $retryAfter = $e->getHeaders()['Retry-After'] ?? 60;

            $minutes = floor($retryAfter / 60);
            $seconds = $retryAfter % 60;

            $message = 'Previše pokušaja logovanja. Pokušajte ponovo za ';
            if ($minutes > 0) $message .= $minutes . ' min';
            if ($seconds > 0) $message .= ($minutes > 0 ? ' i ' : '') . $seconds . ' sekundi';
            $message .= '.';

            // ako je login ruta
            if ($request->routeIs('login.store')) {
                return redirect()->back()->withErrors([
                    'logintry' => $message
                ]);
            }

            // fallback poruka
            return redirect()->back()->withErrors([
                'error' => 'Previše zahteva, pokušajte ponovo kasnije.'
            ]);
        }
    }
}
