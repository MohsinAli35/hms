<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('users.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validated = $request->validate(
            [
                'f_name'=>'required|max:30',
                'l_name'=>'required|max:30',
                'username'=>'required|max:50',
                'email'=>'required|max:75',
                'password'=>'required|max:16|min:8',
                'userid'=>'required|max:5',
                'dateofjoining'=>'required',
                'phone'=>'required|max:15',
                'role'=>'required|max:2',
                'status'=>'required|max:2'
            ]
            );
            $date= Carbon::parse($validated['dateofjoining'])->format('Y-m-d');

            // seting user id in HMS-A-01 format
            // Admin
            if ($validated['role'] == 1) {
                $validated['userid'] = "HMS-A-".$validated['role'];
            }
            // Receptionist
            if ($validated['role'] == 2) {
                $validated['userid'] = "HMS-R-".$validated['role'];
            }
        $new = User::create(
            [
                'f_name'=>$validated['f_name'],
                'l_name'=>$validated['l_name'],
                'username'=>$validated['username'],
                'userid'=>$validated['userid'],
                'dateofjoining'=>$date,
                'email'=>$validated['email'],
                'status'=>$validated['status'],
                'password'=>Hash::make($validated['password']),
                'role'=>$validated['role'],
                'phone'=>$validated['phone'],
                
            ]
        ) ;
        if($new){
            return to_route('users.index')->with('success','Successfully User Created');
        }
        else{
            return redirect()->back()
                                ->with('danger','Something wrong please try again.');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
         $validated = $request->validate(
            [
                'f_name'=>'required|max:30',
                'l_name'=>'required|max:30',
                'username'=>'required|max:50',
                'email'=>'required|max:75',
                'userid'=>'required|max:5',
                'dateofjoining'=>'required',
                'phone'=>'required|max:15',
                'role'=>'required|max:2',
                'status'=>'required|max:2'
            ]
            );

            // seting user id in HMS-A-01 format
            // Admin
            if ($validated['role'] == 1) {
                $validated['role'] = "HMS-A-".$validated['role'];
            }
            // Receptionist
            if ($validated['role'] == 2) {
                $validated['role'] = "HMS-R-".$validated['role'];
            }

            if ($request->input('password') != '') {
                $request->validate([
                    'password'=>'min:8|max:12'
                ]);
                $validated['password'] =$request->password;
            }
            $validated['dateofjoining']= Carbon::parse($validated['dateofjoining'])->format('Y-m-d');
            $update = $user->update($validated);
            if($update)
            {
                return to_route('users.index')->with('success','User Updated Successfully');
            }
            else{
                return to_route('users.index')->with('danger','User Something wrong please try again.');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if(auth()->user()->id != $id){

       
        $user = User::find($id);
        if($user->image !== null){
            Storage::disk('public')->delete($user->image);
        }
        $userid=$user->userid;
        if($user->delete()){
            return to_route('users.index')->with('success','User '.$userid.' deleted successfully');
        }else{
            return to_route('users.index')->with('danger','Something wrong please try again.');
        }
    }else{
        return redirect()->back();
    }

    }

    public function searchId($id){
        $users = User::where('userid','LIKE','%'.$id.'%')->get();
        $data = '';
        foreach($users as $user){
            $data .= '
                <tr>
                    <td>
                    <h2>'.$user->f_name.' '.$user->l_name.'</h2>
                    </td>
                    <td>'.$user->userid.'</td>
                    <td>'.$user->email.'</td>
                    <td>'.$user->phone.'</td>
                    <td>'.$user->dateofjoining.'</td>
                    <td>';
                        if ($user->role == 1){
                            $data .='<span class="custom-badge status-green">Admin</span>';

                        }
                        if($user->role == 2){
                            $data .=' <span class="custom-badge status-blue">Receptionist</span>';

                        }
                    $data .='</td>
                    <td class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/users/'.$user->id.'/edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                if (auth()->user()->id != $user->id){
                                    $data .='<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_User'.$user->id.'"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                }
                                $data .='</div>
                        </div>
                    </td>
                </tr>


                 <!-- model -->
                    <div id="delete_User'.$user->id.'" class="modal fade delete-modal" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                                    <h3>Are you sure want to delete this User?</h3>
                                    <div class="m-t-20 d-flex justify-content-center">
                                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                        <form action="users/distroy/'.$user->id.'" method="post">
                                            @csrf
                                            @method("DELETE")
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end model -->                                    
            ';
        }
        return response()->json($data);
    }
    public function searchName($name){
        $users = User::where('username','LIKE','%'.$name.'%')
                 ->orwhere('f_name','LIKE','%'.$name.'%')
                 ->orwhere('l_name','LIKE','%'.$name.'%')
                 ->get();
        $data = '';
        foreach($users as $user){
            $data .= '
                <tr>
                    <td>
                    <h2>'.$user->f_name.' '.$user->l_name.'</h2>
                    </td>
                    <td>'.$user->userid.'</td>
                    <td>'.$user->email.'</td>
                    <td>'.$user->phone.'</td>
                    <td>'.$user->dateofjoining.'</td>
                    <td>';
                        if ($user->role == 1){
                            $data .='<span class="custom-badge status-green">Admin</span>';

                        }
                        if($user->role == 2){
                            $data .=' <span class="custom-badge status-blue">Receptionist</span>';

                        }
                    $data .='</td>
                    <td class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/users/'.$user->id.'/edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                if (auth()->user()->id != $user->id){
                                    $data .='<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_User'.$user->id.'"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                }
                                $data .='</div>
                        </div>
                    </td>
                </tr>


                 <!-- model -->
                    <div id="delete_User'.$user->id.'" class="modal fade delete-modal" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                                    <h3>Are you sure want to delete this User?</h3>
                                    <div class="m-t-20 d-flex justify-content-center">
                                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                        <form action="users/distroy/'.$user->id.'" method="post">
                                            @csrf
                                            @method("DELETE")
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end model -->  
            ';
        }
        return response()->json($data);
    }
    public function searchRole($role){
        $users = User::where('role','LIKE','%'.$role.'%')
                 ->get();
        $data = '';
        foreach($users as $user){
            $data .= '
                <tr>
                    <td>
                    <h2>'.$user->f_name.' '.$user->l_name.'</h2>
                    </td>
                    <td>'.$user->userid.'</td>
                    <td>'.$user->email.'</td>
                    <td>'.$user->phone.'</td>
                    <td>'.$user->dateofjoining.'</td>
                    <td>';
                        if ($user->role == 1){
                            $data .='<span class="custom-badge status-green">Admin</span>';

                        }
                        if($user->role == 2){
                            $data .=' <span class="custom-badge status-blue">Receptionist</span>';

                        }
                    $data .='</td>
                    <td class="text-right">
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/users/'.$user->id.'/edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                                if (auth()->user()->id != $user->id){
                                    $data .='<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_User'.$user->id.'"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                                }
                                $data .='</div>
                        </div>
                    </td>
                </tr>


                 <!-- model -->
                    <div id="delete_User'.$user->id.'" class="modal fade delete-modal" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                                    <h3>Are you sure want to delete this User?</h3>
                                    <div class="m-t-20 d-flex justify-content-center">
                                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                        <form action="users/distroy/'.$user->id.'" method="post">
                                            @csrf
                                            @method("DELETE")
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end model -->  
            ';
        }
        return response()->json($data);
    }

}
