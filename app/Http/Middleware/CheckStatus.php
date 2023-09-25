<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('email',$request->email)->where('password', Hash::make($request->password))->first();
        if($user->status == 1)
            return $next($request);
        else
            return redirect(route('login'))->with('danger', 'This user is Blocked');
        dd('aldod');
    }
}
