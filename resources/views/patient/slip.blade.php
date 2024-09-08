@php
    $setting = App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/storage/'.$setting->favicon)}}">
    <title>{{$setting->name ??'Gov.AL AZIZ'}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0; /* Remove any default margin */
            padding: 0; /* Remove any default padding */
        }
    
        @page {
            margin: 0; /* Remove page margin for printing */
        }
    
        .container {
            width: 300px;
            margin: 0 auto; /* Center the container horizontally */
            background-color: white;
        }
    
        .header, .footer {
            text-align: center;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }
    
        .content {
            background-color: lightblue;
            border-radius: 5px;
            text-align: left;
            padding: 10px; /* Add minimal padding for readability */
            margin: 0; /* Remove margin */
        }
    
        .header img {
            width: 120px;
            border-radius: 50%;
        }
    
        .my-5 {
            margin: 15px 0 35px 0; /* Adjusted for consistency */
        }
    </style>
    
</head>
{{-- <body onload="window.print()"> --}}
    <div class="container">
        <div class="header">
            <div style="margin-top: 50px;">Patient Token Slip</div>
            <img src="{{ asset('public/storage/'.$setting->logo) }}" alt="Hospital Logo">
           <div> <h4>{{$setting->name}} <br><span> <small>2-km G.T Road Muridke, Village Nangal Sahdan, District Sheikhupura</small></span> <br> <span><small >Register By: ({{ auth()->user()->f_name }})</small></span> </h4>
           
        </div>
           
                
        </div>

        <div class="content">
            <h5>Date and Time: {{ date('Y-m-d H:i:s A') }}</h5>
            <h5>Department: <span style="font-weight:bold;"><strong> {{ $patient->department->name }} </strong></span> </h5>
            <h4>Token No: <strong>{{ $token->token }} </strong></h4>
            <h5>Name: <strong>{{ $patient->name }}</strong></h5>
            <h6>Age: {{ $patient->age }} Years</h6>
            <h6>Gender: 
                @switch($patient->gender)
                    @case(1)
                        MALE
                        @break
                    @case(2)
                        FEMALE
                        @break
                    @case(3)
                        TRANSGENDER
                        @break
                    @default
                        N/A
                @endswitch
            </h6>
            <h5>Cnic: {{ $patient->cnic }}</h5>
            <h5>Remark: {{ $patient->remark }}</h5>
            <h5>Charges: {{ $patient->price }}Rs</h5>
            <h4>Serial No: {{ $patient->id }}</h4>

        </div>
    </div>

<script>
    window.onafterprint = function() {
        window.location.href = "{{ route('patients.index') }}";
    }
</script>

</body>
</html>
