<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Token;
use App\Models\Patient;
use App\Models\Department;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::orderBy('id', 'DESC')->paginate(15);
        $departments = Department::where('status', 1)->get();
        $tokens = Token::all();
        return view('patient.patient', compact('patients', 'tokens', 'departments'));
    }

    public function create()
    {
        return view('patient.add');
    }

    public function show(Patient $patient)
    {
        $token = Token::where('paitent_id', $patient->id)->first();
        return view('patient.show', compact('token', 'patient'));
    }

    public function departmentSearch($id)
    {

       
        $patients = Patient::where('department_id','LIKE', '%' . $id . '%')->paginate(15);
        session(['filtered_patients' => $patients]);

        $tokens = Token::all();
        $i=1;
        $data = '';
        foreach($patients as $patient){
            $data .= '<tr>
                        <td>'.$i.'</td>
                        <td>';
                        foreach($tokens as $token){
                            if ($token->paitent_id == $patient->id){

                                $data .= $token->token ;
                            }
                        }
                        
                        $data .='</td>
                        <td>'.$patient->department->name .'</td>
                        <td>'.$patient->name .'</td>
                        <td>'. $patient->cnic .'</td>
                        <td>'. $patient->age .'</td>
                        <td>'. $patient->phone .'</td>
                        <td>';
                            if ($patient->gender == 1)
                                $data .='Male';
                            elseif ($patient->gender == 2)
                                $data .='Female';
                            elseif ($patient->gender == 3)
                                $data .='Transgender';
                            
                        $data .='</td>
                        <td>'. $patient->created_at .'</td>
                        <td><a href="/paitents/view/'.$patient->id.'/slip"
                                class="btn btn-sm btn-outline-secondary">Slip</a></td>
                        <td><a href="/paitents/view/'.$patient->id.'"
                                class="btn btn-sm btn-outline-info">View</a></td>

                         <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false"><i
                                        class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href=""><i
                                            class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" data-toggle="modal"
                                        data-target="#delete_patient'.$patient->id.'"><i
                                            class="fa fa-trash-o m-r-5"></i> Delete</a>


                                </div>
                            </div>
                        </td>
                    </tr>'; 


                    // model -------------
                    $data .= '
                        <div id="delete_patient'.$patient->id.'" class="modal fade delete-modal"
                            role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <img src="assets/img/sent.png" alt="" width="50"
                                            height="46">
                                        <h3>Are you sure want to delete this Patient?</h3>
                                        <div class="m-t-20 d-flex justify-content-center ">
                                            <a href="#" class="btn btn-white"
                                                data-dismiss="modal">Close</a>
                                            <form action="/paitents/delete/'.$patient->id.'"
                                                method="post">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit"
                                                    class="ml-1 btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    ';
                    // end model ---------
                    $i++;
                }
                return response()->json($data);
   
    }

    public function dateSearch(Request $request){
        $request->validate(
            [
                'start'=>'required|date',
                'end'=>'required|date|after_or_equal:start'
            ]
            );
            $from = $request->input('start');
            $to = $request->input('end');
            $patients =Patient::whereDate('created_at','>=',$from)
                        ->whereDate('created_at','<=',$to)
                        ->get();
            $tokens = Token::all();
            $departments = Department::where('status', 1)->get();
            $paginate = 0;
            session(['filtered_patients' => $patients]);
            return view('patient.patient', compact('patients','departments','tokens','paginate'));

    }
    //   generate pdf
    public function downloadPdf()
    {
        // Retrieve the filtered data from the session
        $patients = session('filtered_patients');
       $tokens= Token::all();
       $pdf = Pdf::loadView('reports.index', compact('patients', 'tokens'));

// Stream the PDF
return $pdf->stream('patient_report.pdf');
 }

    public function showSlip(Patient $patient)
    {
        $token = Token::where('paitent_id', $patient->id)->first();
        return view('patient.slip', compact('patient', 'token'));
    }

    public function edit(string $id)
    {
        $patients = Patient::find($id);
        if (is_null($patients)) {
            return redirect()->back();
        }
        $department = Department::all();
        $data = compact('patients','department');

        return view('patient.edit')->with($data);
    }

    public function update(Request $request, string $id)
    {
        $validated=request()->validate([
            'name'=>'required|max:70',
            'department_id'=>'required',
            'cnic'=>'max:20',
            'age'=>'required',
            'phone'=>'max:15',
            'gender'=>'required'
        ]);
        // dd($id); 
        $update = Patient::find($id);
        $update->update($validated);
        // $update->name = $request->input('name');
        // $update->department_id = $request->input('department_id');
        // $update->cnic = $request->input('cnic');
        // $update->age = $request->input('cnic');
        // $update->phone = $request->input('phone');
        // $update->gender = $request->input('gender');
        // $update->save();

        // dd($update);
        // if($update){
            return redirect()->route('patients.index')->with('success','Patient update successfully');
        // }else{
        //     return redirect()->back()->with('danger','Something went wrong. Please try again');

        // }
       
    }

    public function destroy(Patient $patient)
    {
        // dd($patient);
        $name = $patient->name;
        $delete = $patient->delete();
        if ($delete) {
            return redirect(route('patients.index'))
                ->with('success', 'Patient ' . $name . ' deleted successfully');
        } else {
            return redirect()->back()
                ->with('danger', 'Something wrong. Please try again');
        }
    }

    
}
