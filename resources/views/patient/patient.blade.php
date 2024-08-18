@extends('../layouts.app')
@section('content')





    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Patients</h4>
                </div>
                <!-- <div class="col-sm-8 col-9 text-right m-b-20">
                                    <a href="add-patient.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
                                </div> -->
            </div>
            <div class="row filter-row justify-content-end">
               
                <div class="col-sm-4 col-md-2 mb-1" id="all-department" style="display: none">
                    <a href="{{route('patients.index')}}"  class="btn btn-primary btn-block"> Refresh Search  </a>
                </div>
<div class="col-md-12">
    <form action="{{route('dateSearch')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-6 col-md-3" >
                <div class="form-group form-focus select-focus">
                    <label class="focus-label">By Department</label>
                    <select class="form-select" id="department_search">
                        <option value="">Select Department</option>
                        @foreach ($departments as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                        
                    
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">From</label>
                    <div class="cal-icon">
                        <input required class="form-control  " name="start" type="date">
                        @error('start')
                            <span class="text-danger fs-6">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">To</label>
                    <div class="cal-icon">
                        <input required class="form-control floating " name="end" type="date">
                        @error('end')
                        <span class="text-danger fs-6">{{$message}}</span>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
        </div>
    </form>
</div>
                
            </div>
            <div class="row">
                @if (session('danger'))
                    <div class="col-md-12">
                        <span class="text-danger fs-6">{{ session('danger') }}</span>
                    </div>
                @endif
                @if (session('success'))
                    <div class="col-md-12">
                        <span class="text-danger fs-6">{{ session('success') }}</span>
                    </div>
                @endif
                <div class="col-md-12">
                    @if (count($patients) > 0)
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Token No</th>
                                        <th>Department</th>
                                        <th>Name</th>
                                        <th>CNIC</th>
                                        <th>Age</th>
                                        <th>Phone</th>
                                        <th>Genger</th>
                                        <th>Date of Visit</th>
                                        <th>Slip</th>
                                        <th>View</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @foreach ($tokens as $item)
                                                    @if ($item->paitent_id == $patient->id)
                                                        {{ $item->token }}
                                                        {{-- -{{ $item->departement }}-{{ $item->date }} --}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $patient->department->name }}</td>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $patient->cnic }}</td>
                                            <td>{{ $patient->age }}</td>
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
                                            <td><a href="{{ route('patients.showSlip', $patient->id) }}"
                                                    class="btn btn-sm btn-outline-secondary">Slip</a></td>
                                            <td><a href="{{ route('patients.show', $patient->id) }}"
                                                    class="btn btn-sm btn-outline-info">View</a></td>

                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{route('patients.edit',$patient->id)}}"><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#delete_patient{{ $patient->id }}"><i
                                                                class="fa fa-trash-o m-r-5"></i> Delete</a>


                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        {{-- model --}}
                                        <div id="delete_patient{{ $patient->id }}" class="modal fade delete-modal"
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
                                                            <form action="{{ route('patients.destroy', $patient->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="ml-1 btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- end model --}}
                                    @endforeach



                                </tbody>
                            </table>
                        </div>
                        @if (!isset($paginate))
                        <div class="container my-2 mt-5">
                            {{$patients->links()}}

                        </div>
                            
                        @endif
                    @else
                    @endif
                </div>
            </div>
        </div>
        <div class="notification-box">
            <div class="msg-sidebar notifications msg-noti">
                <div class="topnav-dropdown-header">
                    <span>Messages</span>
                </div>
                <div class="drop-scroll msg-list-scroll" id="msg_list">
                    <ul class="list-box">
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">R</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Richard Miles </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item new-message">
                                    <div class="list-left">
                                        <span class="avatar">J</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">John Doe</span>
                                        <span class="message-time">1 Aug</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">T</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Tarah Shropshire </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">M</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Mike Litorus</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">C</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Catherine Manseau </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">D</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Domenic Houston </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">B</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Buster Wigton </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">R</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Rolland Webber </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">C</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Claire Mapes </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">M</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Melita Faucher</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">J</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Jeffery Lalor</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">L</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Loren Gatlin</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">T</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Tarah Shropshire</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="chat.php">See all messages</a>
                </div>
            </div>
        </div>
    </div>

    </div>


    <script src="{{ asset('assets/jquery/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {

            // search
            $('#department_search').on('change', function() {
                var value = $(this).val();
                if (value != "") {
                    $.ajax({
                        url: "paitents/search/department/"+value,
                        type: "GET",
                        success: function(data) {
                            console.log(data);

                            $('#tbody').html(data);
                            $('#all-department').css('display','block');
                           
                        }
                    });
                }
                
            });
        });
    </script>

    <!-- patients23:19-->

@endsection
