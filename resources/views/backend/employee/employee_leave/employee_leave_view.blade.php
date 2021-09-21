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
                            <h3 class="box-title">Employee Leave List</h3>
                            <a href class="btn btn-round btn-success mb-10 float-right" data-toggle="modal"
                                data-target="#myModal">Add Employee Leave</a>
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
                                            <th>PurPose</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th width="25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $leave)
                                        <tr>
                                            <td>{{ $key+1 }} </td>
                                            <td>{{$leave['user']['name']}}</td>
                                            <td>{{$leave['user']['id_no']}}</td>
                                            <td>{{$leave['purpose']['name']}}</td>
                                            <td>{{$leave->start_date}}</td>
                                            <td>{{$leave->end_date}}</td>
                                            <td>
                                                <a href="{{route('employee.leave.edit', $leave->id)}}"
                                                    class="btn btn-round btn-info">Edit</a>
                                                <a href="{{route('employee.leave.delete', $leave->id)}}"
                                                    class="btn btn-round btn-danger" id="delete">Delete</a>
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

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Employee Leave</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{route('employee.leave.store')}}" method="post" class="form-group">
                @csrf
                <div class="modal-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>Employee Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="employee_id" id="employee_id" class="form-control">
                                    <option value="" selected disabled>Select Employee Name</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{ $employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>Start Date <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="date" name="start_date" class="form-control" required>
                                @error('start_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>Leave Purpose <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="leave_purpose_id" id="leave_purpose_id" class="form-control">
                                    <option value="" selected disabled>Select Leave Purpose</option>
                                    @foreach($leave_purpose as $purpose)
                                    <option value="{{$purpose->id}}">{{ $purpose->name}}</option>
                                    @endforeach
                                    <option value="0">New Purpose</option>
                                </select>
                                <br>
                                <input type="text" name="name" id="add_another" class="form-control" placeholder="Write Purpose" style="display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>End Date <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="date" name="end_date" class="form-control" required>
                                @error('end_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="pr-10 float-right">
                    <button type="submit" class="btn btn-success btn-rounded ">Submit</button>
                    <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $(document).on('change', '#leave_purpose_id',function(){
        var leave_purpose_id = $(this).val();
        if(leave_purpose_id == '0'){
            $('#add_another').show();
        }else{
            $('#add_another').hide();
        }
    });
});
</script>

@endsection