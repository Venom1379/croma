<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleCertificate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
require_once app_path('Libraries/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

require_once app_path('Libraries/fpdf/fpdf.php');

class VehicleCertificateController extends Controller
{

    public function index()
    {
        $supervisors = User::where('role', 0)->get();

        return view('certificates.index', compact('supervisors'));
    }

    private function validateRequest($request, $id = null)
    {
        return $request->validate([
            'vehicle_registration_no' => 'required|max:50|unique:vehicle_certificates,vehicle_registration_no,' . $id,
            'certificate_type' => 'required',
            'transporter_name' => 'required|max:255',
            'vin_no' => 'required|max:100',
            'tank_type' => 'required|max:100',
            'vehicle_emission_norm' => 'nullable|max:50',
            'suraksha_centre_location' => 'nullable|max:255',
            'inspector_name' => 'required|max:255',
            'certificate_no' => 'required|max:100',
            'certificate_date' => 'required|date',
            'certificate_valid_to' => 'required|date',
            'inspection_result' => 'required|in:certificate,rejection',
        ]);
    }

    public function datatable(Request $request)
    {

        $columns = [
            0 => 'id',
            1 => 'vehicle_registration_no',
            2 => 'transporter_name',
            3 => 'certificate_no',
            4 => 'certificate_date',
            5 => 'status'
        ];

        $query = VehicleCertificate::where('is_deleted', 0);

        if ($request->supervisor_id) {
            $query->where('supervisor_id', $request->supervisor_id);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if (!empty($request->search['value'])) {

            $search = $request->search['value'];

            $query->where(function ($q) use ($search) {

                $q->where('vehicle_registration_no', 'like', "%$search%")
                    ->orWhere('transporter_name', 'like', "%$search%")
                    ->orWhere('certificate_no', 'like', "%$search%");
            });
        }

        $totalData = VehicleCertificate::where('is_deleted', 0)->count();
        $totalFiltered = $query->count();

        $orderColumnIndex = $request->order[0]['column'] ?? 0;
        $orderColumn = $columns[$orderColumnIndex] ?? 'id';
        $orderDir = $request->order[0]['dir'] ?? 'desc';

        $query->orderBy($orderColumn, $orderDir);

        $start = $request->start ?? 0;
        $length = $request->length ?? 10;

        $certificates = $query->skip($start)->take($length)->get();

        $data = [];
        $i = $start + 1;

        foreach ($certificates as $row) {

            $statusBadge = match ($row->status) {
                'approved' => '<span class="badge bg-success">Approved</span>',
                'rejected' => '<span class="badge bg-danger">Rejected</span>',
                default => '<span class="badge bg-warning">Pending</span>',
            };

            $actions = '

            <div class="hstack gap-2">

                <a href="' . route('certificates.edit', $row->id) . '" class="avatar-text avatar-md">
                    <i class="feather feather-edit"></i>
                </a>

                <a href="' . route('certificates.approve', $row->id) . '" 
                onclick="return confirm(\'Approve this certificate?\')" 
                class="avatar-text avatar-md text-success">
                    <i class="feather feather-check"></i>
                </a>

                <a href="' . route('certificates.reject', $row->id) . '" 
                onclick="return confirm(\'Reject this certificate?\')" 
                class="avatar-text avatar-md text-warning">
                    <i class="feather feather-x"></i>
                </a>

                <a href="' . route('certificates.destroy', $row->id) . '" 
                onclick="return confirm(\'Delete this certificate?\')" 
                class="avatar-text avatar-md text-danger">
                    <i class="feather feather-trash"></i>
                </a>
                 <a href="' . route('certificates.download', $row->id) . '" 
                class="avatar-text avatar-md text-info">
                    <i class="feather feather-download"></i>
                </a>
            </div>';

            $data[] = [
                'id' => $i++,
                'vehicle' => $row->vehicle_registration_no,
                'transporter' => $row->transporter_name,
                'certificate_no' => $row->certificate_no,
                'date' => $row->certificate_date,
                'status' => $statusBadge,
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
        $supervisors = User::where('role', 0)->get();
        $companies = Company::all();
        return view('certificates.form', [
            'mode' => 'create',
            'certificate' => new VehicleCertificate(),
            'supervisors' => $supervisors,
            'companies' => $companies
        ]);
    }



    public function store(Request $request)
    {
        $data = $request->all();
    
        $data['created_by'] = Auth::id();
        $data['certificate_date'] = today()->toDateString();
        $data['certificate_valid_to'] = today()->addMonths(6)->toDateString();
        $data['last_suraksha_details'] = today()->toDateString();
        $data['status'] = 'pending';
    
        /* PHOTO UPLOAD */
    
        if ($request->hasFile('vehicle_photo')) {
    
            $file = $request->file('vehicle_photo');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('vehicle_photos'), $name);
    
            $data['vehicle_photo'] = 'vehicle_photos/'.$name;
        }
    
        /* CAMERA CAPTURE */
    
        if ($request->captured_image) {
    
            $image = $request->captured_image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = base64_decode($image);
    
            $name = 'vehicle_'.time().'.png';
    
            file_put_contents(public_path('vehicle_photos/'.$name), $image);
    
            $data['vehicle_photo'] = 'vehicle_photos/'.$name;
        }
    
        /* SAVE CERTIFICATE */
    
        $certificate = VehicleCertificate::create($data);
    
        /* LOAD DOMPDF */
    
        require_once app_path('Libraries/dompdf/autoload.inc.php');
    
        $dompdf = new Dompdf();
    
        /* LOAD BLADE VIEW */
    
        $html = view('certificates.pdf', compact('certificate'))->render();
    
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->render();
    
        /* CREATE FOLDER */
    
        $folder = public_path('certificates_pdf');
    
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
    
        /* SAVE PDF */
    
        $fileName = 'certificate_'.$certificate->id.'.pdf';
    
        file_put_contents($folder.'/'.$fileName, $dompdf->output());
    
        /* SAVE PATH IN DATABASE */
    
        $certificate->pdf_file = 'certificates_pdf/'.$fileName;
        $certificate->save();
    
        return redirect()->route('certificates.index')
            ->with('success', 'Certificate created successfully');
    }



    public function edit($id)
    {
        $certificate = VehicleCertificate::findOrFail($id);


        $supervisors = User::where('role', 0)->get();

        $companies = Company::all();


        return view('certificates.form', [
            'mode' => 'edit',
            'certificate' => $certificate,
            'supervisors' => $supervisors,
            'companies' => $companies

        ]);
    }
    public function download($id)
{
    $certificate = VehicleCertificate::findOrFail($id);

    $path = public_path($certificate->pdf_file);
    // echo $path;
    if (!file_exists($path)) {
        // die('File not found.');
        return back()->with('error', 'File not found.');
    }

    return response()->download($path);
}


    public function update(Request $request, $id)
    {
        $certificate = VehicleCertificate::findOrFail($id);
        $data = $this->validateRequest($request, $id);

        $certificate->update($data);

        return redirect()->route('certificates.index')
            ->with('success', 'Certificate updated');
    }



    public function approve($id)
    {
        $certificate = VehicleCertificate::findOrFail($id);

        $certificate->status = 'approved';
        $certificate->save();

        return back();
    }



    public function reject($id)
    {
        $certificate = VehicleCertificate::findOrFail($id);

        $certificate->status = 'rejected';
        $certificate->save();

        return back();
    }



    public function destroy($id)
    {
        $certificate = VehicleCertificate::findOrFail($id);

        $certificate->is_deleted = 1;
        $certificate->save();

        return back();
    }
}
