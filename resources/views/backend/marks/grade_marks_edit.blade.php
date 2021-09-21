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
                            <h3 class="box-title">Grade Marks Edit</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{route('marks.grade.update',$editData->id)}}" method="post"
                                class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Grade Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="grade_name" class="form-control" required
                                                  value="{{$editData->grade_name}}"  autofocus>
                                                @error('grade_name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Grade Point <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="grade_point" class="form-control" required
                                                value="{{$editData->grade_point}}">
                                                @error('grade_point')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Start Marks <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="start_marks" class="form-control" required
                                                value="{{$editData->start_marks}}">
                                                @error('start_marks')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>End Marks <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="end_marks" class="form-control" required
                                                value="{{$editData->end_marks}}">
                                                @error('end_marks')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Start Point <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="start_point" class="form-control" required
                                                value="{{$editData->start_point}}">
                                                @error('start_point')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>End Point <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="end_point" class="form-control" required
                                                value="{{$editData->end_point}}">
                                                @error('end_point')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Remarks <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="remarks" class="form-control" required
                                                value="{{$editData->remarks}}">
                                                @error('remarks')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <hr>
                        <div class="pr-10 float-right">
                            <button type="submit" class="btn btn-success btn-rounded ">Update</button>
                            <a href="{{route('marks.grade.view')}}" class="btn btn-danger btn-rounded">Return</a>
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