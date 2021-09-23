@extends('admin.admin_master')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                            <h4 class="box-title">Manage<strong> Employee Attendance Report</strong></h4>
                        </div>
                        <div class="box-body">
                        <form action="{{route('attend.report.get')}}" method="get" class="form-group" target="_blanks">
                                @csrf
                                <div class="row">        
                                    <div class="col-lg-5 mt-2">
                                        <div class="form-group row">
                                            <h5 class="mt-2 col-md-5">Employee Name :</h5>
                                            <div class="controls col-md-7">
                                                <select name="employee_id" id="employee_id" class="form-control" required>
                                                    <option selected disabled>Select Employee :</option>
                                                    @foreach($employees as $employee)
                                                    <option value="{{$employee->id}}" >{{$employee->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 mt-2">
                                        <div class="form-group row">
                                            <h5 class="mt-2 col-md-3">Date :</h5>
                                            <div class="controls  col-md-8">
                                                <input type="date" class="form-control" name="date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                    <button type="submit" id="search" class="btn btn-primary btn-rounded ">Search</button>
                                    </div>
                                </div> <!-- /.row -->
                                <br>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>

@endsection
