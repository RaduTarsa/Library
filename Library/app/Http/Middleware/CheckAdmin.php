<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $right
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $right)
    {
        $userTypeId = Auth::user()->group()->pluck('id');

        // if we have the permission in the array of rights for this user we return true
        $ok = in_array($right, \App\Models\Right::where('group_id', $userTypeId)
            ->pluck('permission')->toArray()) ? true : false;

        if($ok) {
            return $next($request); // can perform action
        }
        else {
            return redirect('/nopermission'); // access denied
        }
    }
}
