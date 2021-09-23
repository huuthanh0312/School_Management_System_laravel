@extends('admin.admin_master')

@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            @error('amount')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            @error('date')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            @error('image')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{$message}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror
            @error('description')
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
                            <h3 class="box-title">Other Cost List</h3>
                            <a class="btn btn-round btn-success mb-10 float-right" data-toggle="modal"
                                data-target="#myModal">Add Other Cost</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $other_cost)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{date('d-m-Y', strtotime($other_cost->date))}}</td>
                                            <td>{{$other_cost->amount}}$</td>
                                            <td>{{$other_cost->description}}</td>
                                            <td><img 
                                                    src="{{ !empty($other_cost->image) ? url('upload/cost_images/'.$other_cost->image):url('upload/no_image.jpg')}}"
                                                    alt="" style="width:60px; border:1px solid #000000;"> </td>
                                            <td>
                                                <a href="{{route('account.other.cost.edit', $other_cost->id)}}"class="btn btn-rouned btn-primary"> Edit</a>
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
                <h4 class="modal-title" id="myLargeModalLabel">Add Other Cost</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{route('account.other.cost.store')}}" method="post" class="form-group" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>Amount <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="amount" class="form-control" required autofocus>
                                @error('amount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>Date <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="date" name="date" class="form-control" required>
                                @error('date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h5>Image <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="image" class="form-control" id="image">
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="controls">
                                <img id="showimage"
                                    src="{{url('upload/no_image.jpg')}}"
                                    alt="" style="width:100px; border:1px solid #000000;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <h5>Description <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                                @error('description')
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