@extends('admin.admin_master')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            @error('name')
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
                            <h3 class="box-title">Assign Subject List</h3>
                            <a href class="btn btn-round btn-success mb-10 float-right" data-toggle="modal"
                                data-target="#myModal">Add Assign Subject</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Class Name</th>
                                            <th width="25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $assign_subject)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{$assign_subject['student_class']['name']}}</td>
                                            <td>
                                                <a href="{{route('assign.subject.edit', $assign_subject->class_id)}}"
                                                    class="btn btn-round btn-info">Edit</a>
                                                <a href="{{route('assign.subject.details', $assign_subject->class_id)}}"
                                                    class="btn btn-round btn-primary">Details</a>
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
                <h4 class="modal-title" id="myLargeModalLabel">Add Assign Subject</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{route('assign.subject.store')}}" method="post" class="form-group">
                @csrf
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-12">
                            <div class="add_item">
                                <div class="form-group">
                                    <h5>Student Class <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class_id" id="" class="form-control">
                                            <option value="" selected disabled>Select Class</option>
                                            @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{ $class->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Student Subject <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subject_id[]" id="" class="form-control">
                                                <option value="" selected disabled>Select Subject</option>
                                                @foreach($school_subjects as $subject)
                                                <option value="{{$subject->id}}">{{ $subject->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <h5>Full Mark <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="full_mark[]" class="form-control" required>
                                            @error('full_mark')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <h5>Pass Mark <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="pass_mark[]" class="form-control" required>
                                            @error('pass_mark')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <h5>Subjective Mark <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subjective_mark[]" class="form-control" required>
                                            @error('subjective_mark')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <br>
                                    <span class="btn btn-success addeventmore "><i class="fa fa-plus-circle"></i></span>
                                </div>
                                </div>
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

<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="row ">
                <div class="col-3">
                    <div class="form-group">
                        <h5>Student Subject <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="subject_id[]" id="" class="form-control">
                                <option value="" selected disabled>Select Subject</option>
                                @foreach($school_subjects as $subject)
                                <option value="{{$subject->id}}">{{ $subject->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <h5>Full Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="full_mark[]" class="form-control" required>
                            @error('full_mark')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <h5>Pass Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="pass_mark[]" class="form-control" required>
                            @error('pass_mark')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <h5>Subjective Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="subjective_mark[]" class="form-control" required>
                            @error('subjective_mark')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <br>
                    <span class="btn btn-success addeventmore "><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-danger removeeventmore "><i class="fa fa-minus-circle"></i></span>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {
    var counter = 0;
    $(document).on('click', '.addeventmore', function() {
        var whole_extra_item_add = $('#whole_extra_item_add').html();
        $(this).closest(".add_item").append(whole_extra_item_add);
        counter++;
    });
    $(document).on("click", '.removeeventmore', function(event) {
        $(this).closest(".delete_whole_extra_item_add").remove();
        counter -= 1;
    });
});
</script>
@endsection