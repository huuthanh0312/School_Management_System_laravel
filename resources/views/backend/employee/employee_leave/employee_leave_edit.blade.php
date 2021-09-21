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
                            <h3 class="box-title">Edit Employee Leave</h3>
                            
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{route('employee.leave.update', $editData->id)}}" method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Employee Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="employee_id" id="employee_id" class="form-control">
                                                    <option value="" selected disabled>Select Employee Name</option>
                                                    @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}" {{$editData->employee_id == $employee->id ? "selected" : ""}}>{{ $employee->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Start Date <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="start_date" class="form-control" required value="{{$editData->start_date}}">
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
                                                <select name="leave_purpose_id" id="leave_purpose_id"
                                                    class="form-control">
                                                    <option value="" selected disabled>Select Leave Purpose</option>
                                                    @foreach($leave_purpose as $purpose)
                                                    <option value="{{$purpose->id}}" {{$editData->leave_purpose_id == $purpose->id ? "selected" : ""}}>{{ $purpose->name}}</option>
                                                    @endforeach
                                                    <option value="0">New Purpose</option>
                                                </select>
                                                <br>
                                                <input type="text" name="name" id="add_another" class="form-control"
                                                    placeholder="Write Purpose" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>End Date <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="end_date" class="form-control" required value="{{$editData->end_date}}">
                                                @error('end_date')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="pr-10 float-right">
                                    <button type="submit" class="btn btn-success btn-rounded ">Update</button>
                                    <a href="{{route('employee.leave.view')}}" class="btn btn-round btn-danger" >Return</a>
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

@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $(document).on('change', '#leave_purpose_id', function() {
        var leave_purpose_id = $(this).val();
        if (leave_purpose_id == '0') {
            $('#add_another').show();
        } else {
            $('#add_another').hide();
        }
    });
});
</script>

@endsection