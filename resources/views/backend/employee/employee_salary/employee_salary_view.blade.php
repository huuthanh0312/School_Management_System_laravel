@extends('admin.admin_master')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Employee Salary List</h3>
                            <a href="{{route('employee.registration.add')}}" class="btn btn-round btn-success mb-10 float-right" >Add Salary Employee</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Name</th>
                                            <th>ID No</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
                                            <th>Join Date</th>
                                            <th>Salary</th>
                                            @if(Auth::user()->role == 'Admin')
                                            <th>Code</th>
                                            @endif
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $salary)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$salary->name}}</td>
                                            <td>{{$salary->id_no}}</td>
                                            <td>{{$salary->mobile}}</td>
                                            <td>{{$salary->gender}}</td>
                                            <td>{{date('d-m-Y', strtotime($salary->join_date))}}</td>
                                            <td>{{$salary->salary}} $</td>
                                            @if(Auth::user()->role == 'Admin')
                                            <td>{{$salary->code}}</td>
                                            @endif
                                            <td>
                                                <a title="Increment" href="{{route('employee.salary.increment', $salary->id)}}" class="btn btn-info">
                                                    <i class="fa fa-plus-circle"></i>
                                                </a>
                                                <a title="Details" href="{{route('employee.salary.increment.details', $salary->id)}}" class="btn btn-primary" >
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>

@endsection