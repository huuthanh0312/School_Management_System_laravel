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
                            <h3 class="box-title">Employee Attendance Details</h3>
                            <a href="{{route('employee.attendance.add')}}" class="btn btn-round btn-success mb-10 float-right">Add Attendance</a>
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
                                            <th>Date</th>
                                            <th>Attend Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($details as $key => $attend)
                                        <tr>
                                            <td>{{ $key+1 }} </td>
                                            <td>{{$attend['user']['name']}}</td>
                                            <td>{{$attend['user']['id_no']}}</td>
                                            <td>{{date('d-m-Y', strtotime($attend->date))}}</td>
                                            <td>{{$attend->attend_status}}</td>
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

