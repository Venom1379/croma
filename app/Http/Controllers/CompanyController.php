<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{

    public function index()
    {
        return view('companies.index');
    }

    public function datatable(Request $request)
    {

        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'contact',
            3 => 'email',
            4 => 'is_active'
        ];

        $query = Company::where('is_deleted',0);

        // SEARCH
        if($request->search['value']){
            $search = $request->search['value'];

            $query->where(function($q) use ($search){
                $q->where('name','like',"%$search%")
                ->orWhere('email','like',"%$search%")
                ->orWhere('contact','like',"%$search%");
            });
        }

        $totalData = Company::where('is_deleted',0)->count();
        $totalFiltered = $query->count();

        $orderColumnIndex = $request->order[0]['column'] ?? 0;
        $orderColumn = $columns[$orderColumnIndex];
        $orderDir = $request->order[0]['dir'] ?? 'desc';

        $query->orderBy($orderColumn,$orderDir);

        $start = $request->start;
        $length = $request->length;

        $companies = $query->skip($start)->take($length)->get();

        $data = [];
        $i = $start + 1;

        foreach($companies as $company){

            $status = $company->is_active
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>';

            $actions = '
            <div class="hstack gap-2">

                <a href="javascript:void(0)" 
                    class="avatar-text avatar-md editBtn"
                    data-id="'.$company->id.'">
                    <i class="feather feather-edit"></i>
                </a>

                <a href="javascript:void(0)" 
                    class="avatar-text avatar-md text-danger deleteBtn"
                    data-id="'.$company->id.'">
                    <i class="feather feather-trash"></i>
                </a>

            </div>';

            $data[] = [
                'id'=>$i++,
                'name'=>$company->name,
                'contact'=>$company->contact,
                'email'=>$company->email,
                'status'=>$status,
                'action'=>$actions
            ];
        }

        return response()->json([
            "draw"=>intval($request->draw),
            "recordsTotal"=>$totalData,
            "recordsFiltered"=>$totalFiltered,
            "data"=>$data
        ]);
    }

    public function store(Request $request)
    {
        Company::create($request->all());

        return response()->json(['success'=>true]);
    }

    public function edit($id)
    {
        return Company::findOrFail($id);
    }

    public function update(Request $request,$id)
    {
        $company = Company::findOrFail($id);

        $company->update($request->all());

        return response()->json(['success'=>true]);
    }

    public function destroy($id)
    {
        Company::where('id',$id)->update([
            'is_deleted'=>1
        ]);

        return response()->json(['success'=>true]);
    }

}