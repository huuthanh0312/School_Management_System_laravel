@extends('admin.admin_master')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            @error('grade_name')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            @error('grade_point')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            @error('start_marks')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            @error('end_marks')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            @error('start_point')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            @error('end_point')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            @error('remarks')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Grade Marks List</h3>
                            <a href class="btn btn-round btn-success mb-10 float-right" data-toggle="modal"
                                data-target="#myModal">Add Grade Marks</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Grade Name</th>
                                            <th>Grade Point</th>
                                            <th>Start Marks</th>
                                            <th>End Marks</th>
                                            <th>Point Range</th>
                                            <th>Remarks</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $grade)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$grade->grade_name}}</td>
                                            <td>{{number_format((float)$grade->grade_point,2)}}</td>
                                            <td>{{$grade->start_marks}}</td>
                                            <td>{{$grade->end_marks}}</td>
                                            <td>{{number_format((float)$grade->start_point,2)}} - {{number_format((float)$grade->end_point,2)}}</td>
                                            <td>{{$grade->remarks}}</td>
                                            <td>
                                                <a href="{{route('marks.grade.edit', $grade->id)}}" class="btn btn-round btn-info">Edit</a>
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
                <h4 class="modal-title" id="myLargeModalLabel">Add Grade Marks</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{route('marks.grade.store')}}" method="post" class="form-group">
                @csrf
                <div class="modal-body row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Grade Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="grade_name" class="form-control" required autofocus>
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
                                <input type="text" name="grade_point" class="form-control" required >
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
                                <input type="text" name="start_marks" class="form-control" required >
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
                                <input type="text" name="end_marks" class="form-control" required >
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
                                <input type="text" name="start_point" class="form-control" required >
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
                                <input type="text" name="end_point" class="form-control" required >
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
                                <input type="text" name="remarks" class="form-control" required >
                                @error('remarks')
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