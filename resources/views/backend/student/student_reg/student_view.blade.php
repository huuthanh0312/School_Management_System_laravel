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
                            <h4 class="box-title">Student <strong>Search</strong></h4>
                        </div>

                        <div class="box-body">
                        <form action="{{route('student.year.class.wise')}}" method="get" class="form-group" >
                                @csrf
                                <div class="row">        
                                    <div class="col-md-5 mt-2">
                                        <div class="form-group row">
                                            <h5 class="mt-2 col-sm-2">Year: </h5>
                                            <div class="controls col-sm-10">
                                                
                                                <select name="year_id" id="" class="form-control" required>
                                                    <option selected disabled>Select Year</option>
                                                    @foreach($student_years as $year)
                                                    <option value="{{$year->id}}" {{ (@$year_id == $year->id) ? "selected" : ""}}>{{$year->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 mt-2">
                                        <div class="form-group row">
                                            <h5 class="mt-2 col-sm-2">Class: </h5>
                                            <div class="controls col-sm-10">
                                                
                                                <select name="class_id" id="" class="form-control" required>
                                                    <option selected disabled>Select Class</option>
                                                    @foreach($student_classes as $class)
                                                    <option value="{{$class->id}}" {{ (@$class_id == $class->id) ? "selected" : ""}}>{{$class->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-rounded ">Search</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Student List</h3>
                            <a href="{{route('student.registration.add')}}"
                                class="btn btn-round btn-success mb-10 float-right">Add Student</a>
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
                                            <th>Roll </th>
                                            <th>Year </th>
                                            <th>Class </th>
                                            <th>Image </th>
                                            @if(Auth::user()->role == 'Admin')
                                            <th>Code </th>
                                            @endif
                                            <th width="25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $row)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$row['student']['name']}}</td>
                                            <td>{{$row['student']['id_no']}}</td>
                                            <td></td>
                                            <td>{{$row['student_year']['name']}}</td>
                                            <td>{{$row['student_class']['name']}}</td>
                                            <td><img id="showimage" src="{{ !empty($row['student']['image']) ? url('upload/student_images/'.$row['student']['image']):url('upload/no_image.jpg')}}" alt=""
                                                    style="width:60px; border:1px solid #000000;"></td>
                                            @if(Auth::user()->role == 'Admin')
                                            <td>{{$row['student']['code']}} </td>
                                            @endif
                                            <td>
                                                <a title="Edit" href="{{route('student.registration.edit', $row->student_id)}}"
                                                    class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                <a title="Promotion" href="{{route('student.registration.promotion', $row->student_id)}}"
                                                    class="btn btn-warning" ><i class="fa fa-check"></i></a>
                                                <a target="_blank" title="Details" href="{{route('student.registration.details', $row->student_id)}}"
                                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
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