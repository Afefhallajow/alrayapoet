<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class validuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
        public function handle(Request $request, Closure $next)
    {
        if( auth()->user()->status == 0){
            Auth::logout();
//toastr()->error('انتهت صلاحية حسابك');
            flash()->addError('انتهت صلاحية حسابك.', 'خطأ!');

            return redirect()->route('login');

        }else{
if(Auth::user()->validetime==null){
    return $next($request);

}
            $validetime=Auth::user()->validetime;
$now=Date::now();

           if ($now >= $validetime){
$user=\App\Models\User::findorfail(Auth::user()->id);
$user->status=0;
$user->save;
$request->session()->invalidate();
                Auth::logout();

                $request->session()->regenerateToken();

                return redirect()->route('login')->with('error', 'انتهت صلاحية حسابك.');

            }else
                return $next($request);

        }

    }
}
