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
                            <h4 class="box-title">Manage<strong> Student ID Card Report</strong></h4>
                        </div>
                        <div class="box-body">
                        <form action="{{route('student.idcard.get')}}" method="get" class="form-group" target="_blanks">
                                @csrf
                                <div class="row">        
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <h5 class="mt-2 ">Year: </h5>
                                            <div class="controls">         
                                                <select name="year_id" id="year_id" class="form-control" required>
                                                    <option selected disabled>Select Year</option>
                                                    @foreach($student_years as $year)
                                                    <option value="{{$year->id}}" >{{$year->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group ">
                                            <h5 class="mt-2 ">Class: </h5>
                                            <div class="controls ">   
                                                <select name="class_id" id="class_id" class="form-control" required>
                                                    <option selected disabled>Select Class</option>
                                                    @foreach($student_classes as $class)
                                                    <option value="{{$class->id}}" >{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
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
