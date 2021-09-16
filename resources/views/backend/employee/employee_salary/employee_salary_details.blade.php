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
                            <h3 class="box-title">Employee Salary Details</h3>
                            <a href="{{route('employee.salary.view')}}" class="btn btn-round btn-success mb-10 float-right" >Employee Salary View</a>
                            <h5><strong>Employee Name:</strong> {{$details->name}}</h5>
                            <h5><strong>Employee ID No:</strong> {{$details->id_no}}</h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Previous Salary</th>
                                            <th>Increment Salary</th>
                                            <th>Presented Salary</th>
                                            <th>Effected Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($salary_log as $key => $row)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$row->previous_salary}}</td>
                                            <td>{{$row->increment_salary}}</td>
                                            <td>{{$row->present_salary}}</td>
                                            <td>{{date('d-m-Y',strtotime($row->effected_salary))}}</td>

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