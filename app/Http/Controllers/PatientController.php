<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Token;
use App\Models\Patient;
use App\Models\Department;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use App\Exports\dailyExport;
use App\Exports\dailydepartExport;
use App\Exports\summaryExport;
class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();
    
        if ($request->has('department')) {
            $query->where('department_id', $request->get('department'));
        }
        $patients = Patient::orderBy('id', 'DESC')->paginate(15);
        $index = Patient::orderBy('id','desc')->get();
        $departments = Department::where('status', 1)->get();
        $tokens = Token::all();
        session(['filtered_patients' => $index]);
        // session(['patient_filter' => $request->all()]);
        return view('patient.patient', compact('patients', 'tokens', 'departments','index'));
    }
    public function reportindex(Request $request){
        $query = Patient::query();
    
        if ($request->has('department')) {
            $query->where('department_id', $request->get('department'));
        }
        $patients = Patient::orderBy('id', 'DESC')->paginate(15);
        $index = Patient::orderBy('id','desc')->get();
        $departments = Department::where('status', 1)->get();
        $tokens = Token::all();
        session(['filtered_patients' => $index]);
        // session(['patient_filter' => $request->all()]);
        return view('patient.report-patient', compact('patients', 'tokens', 'departments','index'));
    }
    public function patientsearch(Request $request){
        $departmentId = $request->input('department');
        $cnic = $request->input('cnic');
        $phone = $request->input('phone');
    
        $query = Patient::query();
    
        if ($departmentId){
            $query->where('department_id' , $departmentId);
        }
    
        // Apply date range filter if both dates are provided
        if ($cnic) {
            $query->where('cnic',  $cnic) ;
                 
        }
        if ($phone) {
            $query->where('cnic',  $phone) ;
                 
        }
        $filteredPatients = $query->orderBy('id', 'DESC')->get();
    
        // Store full filtered results in the session for printing or other purposes
        session(['filtered_patients' => $filteredPatients]);
    
        // Apply pagination to the query to display results on the page
        $patients = $query->orderBy('id', 'DESC')->paginate(15);
    
        $tokens = Token::all();
        $departments = Department::where('status', 1)->get();
    
        return view('patient.patient', compact('patients', 'departments', 'tokens'));
    
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

    // public function departmentSearch($id)
    // {

       
    //     session(['patient_filter' => $id]);
    //     $patients = Patient::where('department_id','LIKE', '%' . $id . '%')->paginate(15);

    //     $tokens = Token::all();


    //     // $i=1;
    //     // $data = '';
    //     // foreach($patients as $patient){
    //     //     $data .= '<tr>
    //     //                 <td>'.$i.'</td>
    //     //                 <td>';

                        
    //     //                 foreach($tokens as $token){
    //     //                     if ($token->paitent_id == $patient->id){

    //     //                         $data .= $token->token ;
    //     //                     }
    //     //                 }
                        
    //     //                 $data .='</td>
    //     //                 <td>'.$patient->department->name .'</td>
    //     //                 <td>'.$patient->name .'</td>
    //     //                 <td>'. $patient->cnic .'</td>
    //     //                 <td>'. $patient->age .'</td>
    //     //                 <td>'. $patient->price .'</td>
    //     //                 <td>'. $patient->remark .'</td>
    //     //                 <td>'. $patient->phone .'</td>
    //     //                 <td>';
    //     //                     if ($patient->gender == 1)
    //     //                         $data .='Male';
    //     //                     elseif ($patient->gender == 2)
    //     //                         $data .='Female';
    //     //                     elseif ($patient->gender == 3)
    //     //                         $data .='Transgender';
                            
    //     //                 $data .='</td>
    //     //                 <td>'. $patient->created_at .'</td>
    //     //                 <td><a href="/paitents/view/'.$patient->id.'/slip"
    //     //                         class="btn btn-sm btn-outline-secondary">Slip</a></td>
    //     //                 <td><a href="/paitents/view/'.$patient->id.'"
    //     //                         class="btn btn-sm btn-outline-info">View</a></td>

    //     //                  <td class="text-right">
    //     //                     <div class="dropdown dropdown-action">
    //     //                         <a href="#" class="action-icon dropdown-toggle"
    //     //                             data-toggle="dropdown" aria-expanded="false"><i
    //     //                                 class="fa fa-ellipsis-v"></i></a>
    //     //                         <div class="dropdown-menu dropdown-menu-right">
    //     //                             <a class="dropdown-item" href=""><i
    //     //                                     class="fa fa-pencil m-r-5"></i> Edit</a>
    //     //                             <a class="dropdown-item" data-toggle="modal"
    //     //                                 data-target="#delete_patient'.$patient->id.'"><i
    //     //                                     class="fa fa-trash-o m-r-5"></i> Delete</a>


    //     //                         </div>
    //     //                     </div>
    //     //                 </td>
    //     //             </tr>'; 


    //     //             // model -------------
    //     //             $data .= '
    //     //                 <div id="delete_patient'.$patient->id.'" class="modal fade delete-modal"
    //     //                     role="dialog">
    //     //                     <div class="modal-dialog modal-dialog-centered">
    //     //                         <div class="modal-content">
    //     //                             <div class="modal-body text-center">
    //     //                                 <img src="assets/img/sent.png" alt="" width="50"
    //     //                                     height="46">
    //     //                                 <h3>Are you sure want to delete this Patient?</h3>
    //     //                                 <div class="m-t-20 d-flex justify-content-center ">
    //     //                                     <a href="#" class="btn btn-white"
    //     //                                         data-dismiss="modal">Close</a>
    //     //                                     <form action="/paitents/delete/'.$patient->id.'"
    //     //                                         method="post">
    //     //                                         @csrf
    //     //                                         @method("DELETE")
    //     //                                         <button type="submit"
    //     //                                             class="ml-1 btn btn-danger">Delete</button>
    //     //                                     </form>
    //     //                                 </div>
    //     //                             </div>
    //     //                         </div>
    //     //                     </div>

    //     //                 </div>
    //     //             ';
    //     //             // end model ---------
    //     //             $i++;
    //     //         }
    //     //         return response()->json($data);
   
    // }

    public function dateSearch(Request $request) 
    {
        // Validate input fields
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
        ]);
    
        // Retrieve filter inputs
        $from = $request->input('start');
        $to = $request->input('end');
        $departmentId = $request->input('department');
        
    
        // Initialize query on the Patient model
        $query = Patient::query();
    
        // Apply department filter if selected
        if ($departmentId){
            $query->where('department_id' , $departmentId);
        }
    
        // Apply date range filter if both dates are provided
        if ($from && $to) {
            $query->wherebetween('created_at',  [$from ,$to]) ;
                 
        }
    
        // Get filtered patients to store in session
        $filteredPatients = $query->orderBy('id', 'DESC')->get();
    
        // Store full filtered results in the session for printing or other purposes
        session(['filtered_patients' => $filteredPatients]);
    
        // Apply pagination to the query to display results on the page
        $patients = $query->orderBy('id', 'DESC')->paginate(15);
    
        $tokens = Token::all();
        $departments = Department::where('status', 1)->get();
    
        return view('patient.report-patient', compact('patients', 'departments', 'tokens'));
    }
    
    
    //   generate pdf
    public function downloadPdf()
    {
        // // Retrieve the filtered data from the session
        $patients = session('filtered_patients');
        if(!isset($patients)){
            $patients = Patient::orderBy('id', 'DESC')->get();
           $tokens= Token::all();
           $pdf = Pdf::loadView('reports.index', compact('patients', 'tokens'));
     
     
     return $pdf->download('patient_report.pdf');
        
        }
        // $patients = Patient::orderBy('id', 'DESC')->get();
       $tokens= Token::all();
       $pdf = Pdf::loadView('reports.index', compact('patients', 'tokens'));


return $pdf->download('patient_report.pdf');
 }


//  dwnload daily record pdf 

 public function dailypdf(){
    
        // Retrieve the filtered data from the session
        $patients = session('filtered_patients');
        if(!isset($patients)){
            $patients = Patient::orderBy('id', 'DESC')->get();
           $tokens= Token::all();
           $pdf = Pdf::loadView('reports.dailypdf', compact('patients', 'tokens'));
           return $pdf->download('today_report.pdf');
        }
        $tokens= Token::all();
        $pdf = Pdf::loadView('reports.dailypdf', compact('patients', 'tokens'));
        
        
        return $pdf->download('today_report.pdf');
        
    }
    // download the depart pdf daily
    
    public function dailydepartpdf(){
        $patients = session('filtered_patients');
        if(!isset($patients)){
            $patients = Patient::orderBy('id', 'DESC')->get();
           $tokens= Token::all();
           $pdf = Pdf::loadView('reports.departdailypdf', compact('patients', 'tokens'));
           return $pdf->download('today_department_report.pdf');
        }
        $tokens= Token::all();
        $pdf = Pdf::loadView('reports.departdailypdf', compact('patients', 'tokens'));
        
        
        return $pdf->download('today_department_report.pdf');
        
    }
    

        // download department summaries    . total departments 

        
        public function summarypdf(){
            $patients = session('summarydepart');
            if(!isset($patients)){
                $patients = Patient::orderBy('id', 'DESC')->get();
               $tokens= Token::all();
               $pdf = Pdf::loadView('reports.summarypdf', compact('patients', 'tokens'));
               return $pdf->stream('saummary_report.pdf');
            }
            $departments = Department::all();
            $tokens= Token::all();
            $pdf = Pdf::loadView('reports.summarypdf', compact('patients','departments', 'tokens'));
     
     
     return $pdf->stream('saummary_report.pdf');
     
        }


        // end pdfs 

        // filetered data
 public function printFilteredData()
{
  
    // Start a new query on the Patient model
    $query = Patient::query();

    $filterCriteria = session('filtered_patients');

    if ($filterCriteria) {
       
        $query->whereIn('id', $filterCriteria->pluck('id')->toArray());
    }

    // Execute the query to get all filtered patients without pagination
    $patients = $query->orderBy('id', 'DESC')->get();
    $tokens= Token::all();


    // Return a view that is designed for printing
    return view('reports.patient_print', compact('patients','tokens'));
}


    public function showSlip(Patient $patient)
    {
        $token = Token::where('paitent_id', $patient->id)->first();
        return view('patient.slip',  ['patient' => $patient, 'token' => $token]);
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


    // download Excel files of patient file 


    public function downloadExcel(){
        $patients = session('filtered_patients');
        if(!isset($patients)){
            $patients = Patient::orderBy('id', 'DESC')->get();
           $tokens= Token::all();
           return Excel::download(new UserExport($patients,$tokens), 'patient_report.xlsx');
        }
        $tokens = Token::all();
    
        return Excel::download(new UserExport($patients,$tokens), 'patient_report.xlsx');
    }
     public function dailyexcel(){
        $patients = session('filtered_patients');
        if(!isset($patients)){
            $patients = Patient::orderBy('id', 'DESC')->get();
            $tokens= Token::all();
            return Excel::download(new dailyExport($patients,$tokens), 'today_report.xlsx');
        }
        $tokens = Token::all();
    
        return Excel::download(new dailyExport($patients,$tokens), 'today_report.xlsx');
   
     }
     public function dailydepartexcel(){
        $patients = session('filtered_patients');
        if(!isset($patients)){
            $patients = Patient::orderBy('id', 'DESC')->get();
           $tokens= Token::all();
           return Excel::download(new dailydepartExport($patients,$tokens), 'today_depart_report.xlsx');
        }
        $tokens = Token::all();
    
        return Excel::download(new dailydepartExport($patients,$tokens), 'today_depart_report.xlsx');
   
     }
     public function summaryexcel(){
        $summary = session('summarydepart');
        // $tokens = Token::all();
        return Excel::download(new summaryExport($summary),'summary_report.xlsx');
     }
    
        //  Prints files

        public function dailyprint(){
            $patients = session('filtered_patients');
            
            $tokens = Token::all();
        
            return view('reports.printdaily',compact('patients','tokens'));
       
        }

        public function dailydepartprint(){
            $patients = session('filtered_patients');
            $tokens = Token::all();
        
            return view('reports.printdepart',compact('patients','tokens'));
       
        }

        public function summaryprint(){

            $summary = session('summarydepart');
            return view('reports.printsummary',compact('summary'));
        }
    public function dailyreport(){
        $recordPatient = $this->dailypatientreport(); 
        $departments = Department::where('status', 1)->get(); 
        $tokens = Token::all(); 
        session(['filtered_patients' => $recordPatient]);

        return view('reports.dailyreport', compact('recordPatient', 'tokens', 'departments'));

    }
    // public function  dailyreportExcel(){
    //     $patients = session('fitered_patients');
    // }
    public function dailydepartReport(Request $request)
    {
        $departmentId = $request->query('department_id'); 
    
        // Correctly filter patients by department if an ID is provided
        $recordPatient = Patient::whereDate('created_at', Carbon::today());
    
        if ($departmentId) {
            $recordPatient->where('department_id', $departmentId);
        }
    
        $recordPatient = $recordPatient->orderBy('id', 'DESC')->paginate(15);
        $department = Department::where('id', $departmentId)->first(); 
        
        $departments = Department::where('status', 1)->get();
        $tokens = Token::all(); // Get all tokens
    
        // Save filtered patients to the session (if necessary)
        session(['filtered_patients' => $recordPatient]);
    
        return view('reports.dailydepartreport', compact('recordPatient', 'tokens', 'departments','department'));
    }

    /*      A private fucnction  for daily record */

    private function dailypatientreport()
    {
        $today = Carbon::today(); 
        $recordPatient = Patient::whereDate('created_at', $today)
            ->orderBy('id', 'DESC')
            ->paginate(15);

        return $recordPatient;
    }
    public function departsummary(Request $request)
    {
        // Validate date inputs
        $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
        ]);
    
        // Get the start and end date from the request
        $from = $request->input('start');
        $to = $request->input('end');
    
        // Fetch all active departments with pagination
        $departments = Department::where('status', 1)->paginate(15);
    
        // Initialize an array to hold the summary data for each department
        $departmentSummaries = [];
    
        // Iterate through each department to calculate totals
        foreach ($departments as $department) {
            // Query for tokens based on department and optional date filter
            $tokensQuery = Token::whereHas('patient', function ($query) use ($department) {
                $query->where('department_id', $department->id);
            });
    
            // Apply date filtering to the tokens query if both dates are provided
            if ($from && $to) {
                $tokensQuery->whereBetween('created_at', [$from, $to]);
            }
    
            // Calculate the total number of tokens for the department
            $totalTokens = $tokensQuery->count();
    
            // Query for patients based on department and optional date filter
            $patientsQuery = Patient::where('department_id', $department->id);
    
            // Apply date filtering to the patients query if both dates are provided
            if ($from && $to) {
                $patientsQuery->whereBetween('created_at', [$from, $to]);
            }
    
            // Calculate the total price for the department
            $totalPrice = $patientsQuery->sum('price');
    
            // Add the calculated totals to the summary array
            $departmentSummaries[] = [
                'department_name' => $department->name,
                'total_tokens' => $totalTokens,
                'total_price' => $totalPrice,
            ];
        }
    
        // Store the summary data in session (if needed)
        session(['summarydepart' => $departmentSummaries]);
    
        // Pass the summary data and departments to the view
        return view('reports.dailydepartsummary', compact('departmentSummaries', 'departments'));
    }
    
    public function update(Request $request, string $id)
    {
        $validated=request()->validate([
            'name'=>'required|max:700',
                'department_id'=>'required',
                'cnic'=>'min:13|max:15',
                'age'=>'required|max:3',
                'phone'=>'min:11|max:15',
                'gender'=>'required',
                'price'=>'max:99',
                'remark'=>'max:99',
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
