<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{

    public function index()
    {
        $companies = Company::where('is_deleted',0)
                    ->where('is_active',1)
                    ->get();

        return response()->json([
            'status'=>true,
            'data'=>$companies
        ]);
    }

}