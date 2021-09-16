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
                            <h3 class="box-title">Student Fee Amount Edit</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{route('fee.amount.update',$editData['0']->fee_category_id)}}" method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="add_item">
                                            <div class="form-group">
                                                <h5>Student Fee Category <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="fee_category_id" id="" class="form-control">
                                                        <option value="" selected disabled>Select Fee Category</option>
                                                        @foreach($fee_categories as $fee_cat)
                                                        <option value="{{$fee_cat->id}}"
                                                            {{$editData['0']->fee_category_id == $fee_cat->id ? "selected" : ""}}>
                                                            {{ $fee_cat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            @foreach ($editData as $fee_amount)
                                            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                                <div class="row">
                                                    <div class="col-md-5 ">
                                                        <div class="form-group">
                                                            <h5>Student Class <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="class_id[]" id="" class="form-control">
                                                                    <option value="" selected disabled>Select Class
                                                                    </option>
                                                                    @foreach($classes as $class)
                                                                    <option value="{{$class->id}}"
                                                                        {{$fee_amount->class_id == $class->id ? "selected" : ""}}>
                                                                        {{ $class->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <h5>Amount <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="amount[]" class="form-control"
                                                                    required value="{{$fee_amount->amount}}" autofocus>
                                                                @error('amount')
                                                                <span class="text-danger">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <br>
                                                        <span class="btn btn-success addeventmore"><i
                                                                class="fa fa-plus-circle"></i></span>
                                                        <span class="btn btn-danger removeeventmore"><i
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
                                    <a href="{{route('fee.amount.view')}}" class="btn btn-danger btn-rounded">Return</a>
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
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <h5>Student Class <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="class_id[]" id="" class="form-control">
                                <option value="" selected disabled>Select Class</option>
                                @foreach($classes as $class)
                                <option value="{{$class->id}}">{{ $class->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <h5>Amount <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="amount[]" class="form-control" required placeholder="Enter amount"
                                autofocus>
                            @error('amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="col-md-2">
                    <br>
                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
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