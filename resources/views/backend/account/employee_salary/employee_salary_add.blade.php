@extends('admin.admin_master')

@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                            <h4 class="box-title">Add<strong> Student Fee</strong></h4>
                        </div>

                        <div class="box-body">
                            <form action="{{route('account.salary.store')}}" method="post" class="form-group">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 mt-2">
                                        <div class="form-group row">
                                            <h5 class="mt-2 col-md-2">Date <span class="text-danger">*</span> </h5>
                                            <div class="controls col-md-10">
                                                <input type="date" name="date" id="date" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <a id="search" class="btn btn-primary btn-rounded ">Search</a>
                                    </div>
                                </div> <!-- /.row -->
                                <br>
                                <!-- Marks Entry Table -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="document-results">
                                            <script id="document-template" type="text/x-handlebars-template">
                                                <table class="table table-striped table-bordered" width="100%">
                                                <thead>
                                                    <tr> @{{{thsource}}}</tr>
                                                </thead>
                                                <tbody>
                                                    @{{#each this}}
                                                    <tr>
                                                        @{{{tdsource}}}
                                                    </tr>
                                                    @{{/each}}
                                                </tbody>
                                                </table>
                                                <button type="Submit" class="btn btn-rounded btn-primary">Submit</button>
                                            </script>
                                        </div>
                                        <br>

                                    </div>
                                </div>

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


<script type="text/javascript">
$(document).on('click', '#search', function() {
    var date = $('#date').val();
    $.ajax({
        url: "{{route('account.salary.getemployee')}}",
        type: 'GET',
        data: {
            'date': date,
        },
        beforeSend: function() {},
        success: function(data) {
            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var html = template(data);
            $('#document-results').html(html);
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
});

</script>
@endsection