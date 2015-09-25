<?php

namespace App\Http\Middleware;

use Closure;

class NotUser {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if ($request->user()->role->slug != 'admin' && $request->user()->role->slug != 'redactor') {
			return redirect('/');
		}
		return $next($request);
	}
}
