<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SupervisorController extends Controller
{

    public function index()
    {
        return view('supervisors.index');
    }

    public function datatable(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'contact',
            4 => 'is_active'
        ];

        $query = User::where('role', 0);

        if (!empty($request->search['value'])) {

            $search = $request->search['value'];

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('contact', 'like', "%$search%");
            });
        }

        $totalData = User::where('role', 0)->count();
        $totalFiltered = $query->count();

        $orderColumnIndex = $request->order[0]['column'] ?? 0;
        $orderColumn = $columns[$orderColumnIndex] ?? 'id';
        $orderDir = $request->order[0]['dir'] ?? 'desc';

        $query->orderBy($orderColumn, $orderDir);

        $start = $request->start ?? 0;
        $length = $request->length ?? 10;

        $supervisors = $query->skip($start)->take($length)->get();

        $data = [];
        $i = $start + 1;

        foreach ($supervisors as $row) {

            $status = $row->is_active
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>';

            $statusBtn = $row->is_active
                ? '<a href="' . route('supervisors.status', $row->id) . '" 
                class="avatar-text avatar-md text-warning"
                onclick="return confirm(\'Make this supervisor inactive?\')">
                <i class="fa fa-ban"></i>
            </a>'
                : '<a href="' . route('supervisors.status', $row->id) . '" 
                class="avatar-text avatar-md text-success"
                onclick="return confirm(\'Activate this supervisor?\')">
                <i class="fa fa-check"></i>
            </a>';

            $actions = '
            <div class="hstack gap-2">
            
            <a href="' . route('supervisors.show', $row->id) . '" class="avatar-text avatar-md">
            <i class="fa fa-eye"></i>
            </a>
            
            <a href="' . route('supervisors.edit', $row->id) . '" class="avatar-text avatar-md">
            <i class="fa fa-edit"></i>
            </a>
            
            ' . $statusBtn . '
            
            <a href="' . route('supervisors.destroy', $row->id) . '"
            onclick="return confirm(\'Delete this supervisor?\')"
            class="avatar-text avatar-md text-danger">
            <i class="fa fa-trash"></i>
            </a>
            
            </div>';

            $data[] = [

                'id' => $i++,
                'name' => $row->name,
                'email' => $row->email,
                'contact' => $row->contact ?? '-',
                'status' => $status,
                'action' => $actions
            ];
        }

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ]);
    }

    public function create()
    {
        return view('supervisors.form');
    }

    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|numeric|digits_between:8,15',
            'password' => 'required|min:6|confirmed'
        ]);

        $data = $request->all();

        $data['role'] = 0;
        $data['password'] = Hash::make($request->password);
        $data['is_active'] = $request->is_active ?? 0;

        User::create($data);

        return redirect()->route('supervisors.index')
            ->with('success', 'Supervisor created');
    }

    public function show($id)
    {
        $supervisor = User::findOrFail($id);
        return view('supervisors.show', compact('supervisor'));
    }

    public function edit($id)
    {
        $supervisor = User::findOrFail($id);
        return view('supervisors.form', compact('supervisor'));
    }

    public function update(Request $request, $id)
    {

        $supervisor = User::findOrFail($id);

        $request->validate([

            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'contact' => 'required|numeric|digits_between:8,15',
            'password' => 'nullable|min:6|confirmed'
        ]);

        $data = $request->all();

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $data['is_active'] = $request->is_active ?? 0;

        $supervisor->update($data);

        return redirect()->route('supervisors.index')
            ->with('success', 'Supervisor updated');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('supervisors.index')
            ->with('success', 'Supervisor deleted');
    }
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        $user->is_active = $user->is_active ? 0 : 1;

        $user->save();

        return redirect()->route('supervisors.index')
        ->with('success','Status updated');
    }
}
