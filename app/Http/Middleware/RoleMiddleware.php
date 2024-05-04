<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
     protected $role;

    //  public function __construct($role)
    //  {
    //      $this->role = $role;
    //  }
    public function handle($request, Closure $next, $role)
    {
        if (auth()->user()->role !== $role) {
            abort(403, 'Unauthorized'); // Tolak akses jika peran tidak sesuai
        }
    
        return $next($request);

        // Jika bukan admin, arahkan kembali atau tampilkan pesan akses ditolak
        return redirect()->route('user.index')->with('error', 'Access denied.');
    
    }

    
}
