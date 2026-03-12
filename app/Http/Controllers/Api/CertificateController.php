<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehicleCertificate;

class CertificateController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'vehicle_registration_no'=>'required',
            'vehicle_make'=>'required',
            'vehicle_model'=>'required',
            'chassis_no'=>'required',
            'engine_no'=>'required'
        ]);


        $exists = VehicleCertificate::where(
            'vehicle_registration_no',
            $request->vehicle_registration_no
        )->first();


        if($exists){

            return response()->json([
                'status'=>true,
                'message'=>'Certificate already exists',
                'data'=>$exists
            ]);
        }


        $data = $request->all();

        $data['supervisor_id'] = auth()->id();
        $data['status'] = 'pending';

        $certificate = VehicleCertificate::create($data);


        return response()->json([
            'status'=>true,
            'message'=>'Certificate created successfully',
            'data'=>$certificate
        ]);
    }



    public function list(Request $request)
    {

        $certificates = VehicleCertificate::orderBy('id','desc')
                        ->paginate(10);

        return response()->json([
            'status'=>true,
            'data'=>$certificates
        ]);
    }



    public function detail($id)
    {

        $certificate = VehicleCertificate::find($id);

        if(!$certificate){
            return response()->json([
                'status'=>false,
                'message'=>'Certificate not found'
            ]);
        }

        return response()->json([
            'status'=>true,
            'data'=>$certificate
        ]);
    }

}
