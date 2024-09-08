@extends('../layouts.app')
@section('content')




    <div class="page-wrapper">
        <div class="content">
           <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-2">
                      <h4>  Edit Form</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a href="{{route('users.index')}}" class="btn btn-danger">Back</a>
                    </div>
                </div>

               
            </div>
            <div class="col-md-12">
                <form action="{{route('users.update',$user->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row">

                
            <div class="col-md-6 mt-2">
                <div class="mt-2 form-group">
                    <label for="" class="form-label">First Name</label>
                    <input type="text" name="f_name" value="{{$user->f_name}}" class="form-control">
                    @error('f_name')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2 form-group">
                    <label for="" class="form-label">Last Name</label>
                    <input type="text" name="l_name" value="{{$user->l_name}}" class="form-control">
                    @error('l_name')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2 form-group">
                    <label for="" class="form-label">User Name</label>
                    <input type="text" name="username" value="{{$user->username}}" class="form-control">
                    @error('username')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2 form-group">
                    <label for="" class="form-label">User id</label>
                    <input type="text" name="userid" value="{{$user->userid}}" class="form-control">
                    @error('userid')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
              
               
                <div class="mt-2 form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control">
                    @error('email')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="mt-2 form-group">
                    <label for="" class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{$user->phone}}" class="form-control">
                    @error('phone')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="mt-2 form-group">
                    <label class="form-label d-block">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="User_active" value="1" {{($user->status == 1) ? 'checked' : ''}}>
                        <label class="form-check-label" for="User_active">
                        Active
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="User_inactive" value="0" {{($user->status == 0) ? 'checked' : ''}}>
                        <label class="form-check-label" for="User_inactive">
                        Inactive
                        </label>
                    </div>
                    @error('status')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                @if ($user->image != '')
                    <div class="container d-flex justify-content-center mt-5">
                        <img src="{{asset('storage/'.$user->image)}}" class="img-fluid" style="height: 225px" alt="">
                    </div>
                @endif
                <div class="mt-2 form-group">
                    <label for="" class="form-label">Date of joining</label>
                    <input type="date" name="dateofjoining" value="{{$user->dateofjoining}}" class="form-control">
                    @error('dateofjoining')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2 form-group">
                    <label for="" class="form-label">Password</label>
                    <input type="text" name="password" value="" class="form-control">
                    @error('password')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2 form-group">
                    <label class="form-label">Role</label>
                    <select class="form-select d-block" name="role">
                        {{-- NOTE : FIXED ROLE
                                    ADMIN = 1
                                    Receptionist(TOKENIST) = 2  --}}
                        @if ($user->id == auth()->user()->id)
                        <option value="1" selected >Selected-Admin</option>
                        @else

                            @if ($user->role == 1)
                            <option value="1" selected >Selected-Admin</option>
                            <option value="2" >Receptionist</option>
                            @else
                            <option value="1"  >Admin</option>
                            <option value="2" Selected>Selected-Receptionist</option>
                            @endif

                        @endif
                 
                    </select>
                    @error('role')
                        <span class="mt-1 fs-6 text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2 form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-secondary">Save Changes</button>
                </div>
            </div>

        </div>
    </form>
</div>
           </div>
        </div>
    </div>

  
@endsection


<!-- Users23:22-->
