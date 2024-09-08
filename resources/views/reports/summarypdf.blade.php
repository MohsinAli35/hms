
@php
    $setting = App\Models\Setting::first();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/storage/'.$setting->favicon)}}">
    <title>{{$setting->name ??'Gov.AL AZIZ'}}</title>
    <style>
   table {
  border-collapse: collapse;
 
}
th, td {
  
  width: 30%;
  border: 1px solid #dee2e6; 
  padding: 0.75rem; 
  word-wrap: break-word;
}

    </style>
</head>
<body>

    
    
        <div class="container ">
            <div class="content">
                <div class="text-center" > <img class="circle-rounded "  width="70" src="{{asset('public/storage/'.$setting->logo)}}" alt="Company logo"> </div>
                <div class="text-center">{{$setting->name}}</div>
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Department-Wise Summary Report </h4>
                    </div>
  <table  border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Serial No</th>
            <th>Department</th>
            <th>Token No</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
               

                {{$patient['department_name']}}
            </td>
            <td>{{ $patient['total_tokens']}}</td>
            <td>{{ $patient['total_price'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div></div>
        <!-- patients23:19-->
    

</body>
</html>