
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
                <h4 class="page-title">Daily Departmnet-Wise Sale </h4>
            </div>
            <div>

                @foreach ($patients as $patient)

                @endforeach
                <h3 style="margin: 20px">
                    {{$patient->department->name}}
                    
                </h3>
            </div>

                    
  <table>
    <thead>
        <tr>
            <th>Serial No</th>
            <th>Token No</th>
            {{-- <th>Department</th> --}}
            <th> Patient Name</th>
            <th>Age</th>
            <th>Rate</th>
            <th>Phone # </th>
            <th>Address</th>
            <th>Date of Visit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @foreach ($tokens as $item)
                @if ($item->paitent_id == $patient->id)
                {{ $item->token }}
                @endif
                @endforeach
            </td>
            <td>{{ $patient->name }}</td>
            <td>{{ $patient->age }}</td>
            <td>{{ $patient->price }}</td>
            <td>{{ $patient->phone }}</td>
            <td>
                @if ($patient->gender == 1)
                Male
                @elseif ($patient->gender == 2)
                Female
                @elseif ($patient->gender == 3)
                Transgender
                @endif
            </td>
            <td>{{ $patient->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div></div>
        <!-- patients23:19-->
    
    </body>
</html>