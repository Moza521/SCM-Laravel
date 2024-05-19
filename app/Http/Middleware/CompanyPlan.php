<?php

namespace App\Http\Middleware;

use App\SCM\Admin\Companies\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company_id = Auth::user()->company_id;
        $company = Company::findOrFail($company_id);
        $status = $company->status;
        if ($status === "active") {
            return $next($request);
        }

        return response()->json(['status' => 'Error', 'msg' => 'Company Subscription Expired'], 400);
    }
}
