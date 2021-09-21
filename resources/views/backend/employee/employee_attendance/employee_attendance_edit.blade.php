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
                            <h3 class="box-title">Employee Attendance Edit</h3>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{route('employee.attendance.store')}}" method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Attendance Date <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="date" class="form-control" required value="{{$editData['0']['date']}}">
                                                @error('date')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-striped" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" style="vertical-align: middle;" class="text-center">
                                                        SL</th>
                                                    <th rowspan="2" style="vertical-align: middle;" class="text-center">
                                                        Employee List</th>
                                                    <th colspan="3" style="vertical-align: middle; width: 30%;"
                                                        class="text-center">Attendance Status</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center btn present_all"
                                                        style="display: table-cell;">Present</th>
                                                    <th class="text-center btn leave_all" style="display: table-cell;">
                                                        Leave</th>
                                                    <th class="text-center btn absent_all" style="display: table-cell;">
                                                        Absent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($editData as $key => $data)
                                                <tr id="div{{$data->employee_id}}" class="text-center">
                                                    <input type="hidden" value="{{$data->employee_id}}" name="employee_id[]">
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$data['user']['name']}}</td>
                                                    <td colspan="3">
                                                        <div class="switch-toggle switch-3 switch-candy">
                                                            <input type="radio" name="attend_status{{$key}}" id="present{{$key}}" 
                                                                value="Present" {{$data->attend_status == 'Present' ? 'checked' : ''}}>
                                                            <label for="present{{$key}}">Present</label>

                                                            <input type="radio" name="attend_status{{$key}}" id="leave{{$key}}" 
                                                                value="Leave" {{$data->attend_status == 'Leave' ? 'checked' : ''}}>
                                                            <label for="leave{{$key}}">Leave</label>

                                                            <input type="radio"  name="attend_status{{$key}}" id="absent{{$key}}" 
                                                                value="Absent" {{$data->attend_status == 'Absent' ? 'checked' : ''}}>
                                                            <label for="absent{{$key}}">Absent</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="pr-10 ml-15">
                                        <button type="submit" class="btn btn-success btn-rounded ">Update</button>
                                        <a href="{{route('employee.attendance.view')}}"
                                            class="btn btn-round btn-danger">Return</a>
                                    </div>
                            </form>
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