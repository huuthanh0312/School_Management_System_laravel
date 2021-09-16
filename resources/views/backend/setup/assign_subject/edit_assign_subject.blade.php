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
                            <h3 class="box-title">Assign Subject Edit</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{route('assign.subject.update',$editData['0']->class_id)}}" method="post"
                                class="form-group">
                                @csrf
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="add_item">
                                            <div class="form-group">
                                                <h5>Student Class <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="class_id" id="" class="form-control">
                                                        <option value="" selected disabled>Select Class</option>
                                                        @foreach($classes as $class)
                                                        <option value="{{$class->id}}"
                                                            {{$editData['0']->class_id == $class->id ? 'selected' : ''}}>
                                                            {{ $class->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @foreach ($editData as $assign_subject)
                                            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <h5>Student Subject <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="subject_id[]" id="" class="form-control">
                                                                    <option value="" selected disabled>Select Subject
                                                                    </option>
                                                                    @foreach($school_subjects as $subject)
                                                                    <option value="{{$subject->id}}"
                                                                        {{$assign_subject->subject_id == $subject->id ? "selected" : ""}}>
                                                                        {{ $subject->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <h5>Full Mark <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="full_mark[]"
                                                                    class="form-control" required
                                                                    value="{{$assign_subject->full_mark}}">
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
                                                                <input type="text" name="pass_mark[]"
                                                                    class="form-control" required
                                                                    value="{{$assign_subject->pass_mark}}">
                                                                @error('pass_mark')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <h5>Subjective Mark <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="subjective_mark[]"
                                                                    class="form-control" required
                                                                    value="{{$assign_subject->subjective_mark}}">
                                                                @error('subjective_mark')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <br>
                                                        <span class="btn btn-success addeventmore "><i
                                                                class="fa fa-plus-circle"></i></span>
                                                        <span class="btn btn-danger removeeventmore "><i
                                                                class="fa fa-minus-circle"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="pr-10 float-right">
                                    <button type="submit" class="btn btn-success btn-rounded ">Update</button>
                                    <a href="{{route('assign.subject.view')}}"
                                        class="btn btn-danger btn-rounded">Return</a>
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

<div style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="row ">
                <div class="col-4">
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
                <div class="col-2">
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