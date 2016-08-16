<?php namespace App\Http\Middleware;

use Closure;
use Storage;
use Log;
use App\Crypt;
class HttpAuthMaster {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$k = Crypt::find(1);
		$a=hash('sha512','mockingbird');

		Log::info($a);
		if($k->key != $a){
			return redirect('secret');
		}

		return $next($request);
	}

}
