@extends('../layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="container">
            <form action="{{route('myprofile.update',$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                    <div class="my-2 text-success">{{session('success')}}</div>
                        
                    @endif
                    @if (session('danger'))
                    <div class="my-2 text-danger">{{session('danger')}}</div>
                        
                    @endif
                </div>
                <div class="col-md-12 d-flex justify-content-center">
                  
                    @if ($user->image)
                        <div class="my-2">
                            <img src="{{asset('storage/' .$user->image)}}" class="img-fluid rounded-circle" style="height:180px;width:180px;" alt="">
                        </div>
                    @else
                    <span class="text-info fs-6 d-block">Please Upload Your Profile Picture</span>
                    @endif
                </div>
                
                <div class="col-md-6">
                    <div class="container">
                        <div class="form-gorup mt-2">
                            <label class="form-label">First name</label>
                            <input type="text" name="f_name" value="{{$user->f_name}}" class="form-control">
                            @error('f_name')
                                <span class="fs-6 text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-gorup mt-2">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{$user->email}}" class="form-control">
                            @error('email')
                                <span class="fs-6 text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-gorup mt-2">
                            <label class="form-label">Password</label>
                            <input type="text" name="password"  class="form-control">
                            @error('password')
                                <span class="fs-6 text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-gorup mt-2">
                            <label class="form-label">Image</label>
                            <input type="file" name="image"  class="form-control">
                            @error('image')
                                <span class="fs-6 text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container">
                        <div class="form-gorup mt-2">
                            <label class="form-label">Last name</label>
                            <input type="text" name="l_name" value="{{$user->l_name}}" class="form-control">
                            @error('l_name')
                                <span class="fs-6 text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-gorup mt-2">
                            <label class="form-label">User name</label>
                            <input type="text" name="username" value="{{$user->username}}" class="form-control">
                            @error('username')
                                <span class="fs-6 text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-gorup mt-2">
                            <label class="form-label">Phone Number</label>
                            <input type="number" name="phone" value="{{$user->phone}}" class="form-control">
                            @error('phone')
                                <span class="fs-6 text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="container mt-4 d-flex justify-content-end">
                        <button class="btn btn-secondary mt-2" type="submit">Save Changes</button>
                    </div>
                </div>
            </div>
        </form>

        </div>
    </div>
</div>
@endsection