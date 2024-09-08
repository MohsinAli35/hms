@extends('../layouts/app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            @foreach ($settings as $setting)
            <div class="col-lg-8 offset-lg-2">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <h3 class="page-title">Company Settings</h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="">     ICON &nbsp;&nbsp;&nbsp;&nbsp;
                                     @if($setting->favicon)
                                    <img  class="rounded-circle"src="{{ asset('public/storage/' . $setting->favicon) }}" alt="Favicon" width="40">
                                @endif</label>
                                <input class="form-control" name="favicon" type="file" placeholder="Icon" value="{{old($setting->favicon)}}" >  
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> LOGO  &nbsp;&nbsp;&nbsp;&nbsp; 
                                    @if($setting->logo)
                                    <img class="rounded-circle" src="{{ asset('public/storage/'.$setting->logo) }}" alt="Logo" width="48">
                                @endif</label>
                                <input class="form-control" name="logo" type="file" placeholder="Company Logo" {{old('logo')}}>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label >Web Name <span class="text-danger"></span></label>
                                <input class="form-control" name="name" type="text" value="{{ old('name', $setting->name) }}">
                            </div>
                        </div>
                        <div class=" col-sm-6 m-t-20 text-center">
                            <button class="btn btn-primary submit-btn" type="submit">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
