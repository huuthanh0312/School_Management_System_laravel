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
                            <h3 class="box-title">Edit Employee</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form action="{{route('employee.registration.update', $editData->id)}}" method="post" class="form-group" enctype="multipart/form-data">
                                @csrf
                                <div class="row">        
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Employee Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" required value="{{$editData->name}}">
                                                @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Father's Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="fname" class="form-control" required value="{{$editData->fname}}">
                                                @error('fname')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Mother's Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mname" class="form-control" required value="{{$editData->mname}}">
                                                @error('mname')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Mobile Number <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mobile" class="form-control" required value="{{$editData->mobile}}">
                                                @error('mobile')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Address <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="address" class="form-control" required value="{{$editData->address}}">
                                                @error('address')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Gender <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="gender" id="gender" class="form-control" required>
                                                    <option selected disabled>Select Gender</option>
                                                    <option value="Male" {{ (@$editData->gender == 'Male') ? "selected" : ""}} >Male</option>
                                                    <option value="Female" {{ (@$editData->gender == 'Female') ? "selected" : ""}} >Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Religion <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="religion" id="religion" class="form-control" required>
                                                    <option selected disabled>Select Religion</option>
                                                    <option value="No" {{ (@$editData->religion == 'No') ? "selected" : ""}}>No</option>
                                                    <option value="Buddhism" {{ (@$editData->religion == 'Buddhism') ? "selected" : ""}}>Buddhism</option>
                                                    <option value="Christian" {{ (@$editData->religion == 'Christian') ? "selected" : ""}}>Christian</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Date of Birth <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="dob" class="form-control" required value="{{$editData->dob}}">
                                                @error('dob')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Designation <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="designation_id" id="" class="form-control" required>
                                                    <option selected disabled>Select Group</option>
                                                    @foreach($designation as $design)
                                                    <option value="{{$design->id}}" {{ (@$editData->designation_id == $design->id) ? "selected" : ""}}>{{$design->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Profile Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="image" class="form-control" id="image">
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <input type="hidden" name="old_image" value="{{$editData->image}}">
                                                <img id="showimage" src="{{ !empty($editData->image) ? url('upload/employee_images/'.$editData->image):url('upload/no_image.jpg')}}" alt=""
                                                    style="width:100px; border:1px solid #000000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                <div class="pr-10 ">
                                    <button type="submit" class="btn btn-success btn-rounded ">Submit</button>
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
<script>
$(document).ready(function() {
    $('#image').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#showimage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});
</script>
@endsection
