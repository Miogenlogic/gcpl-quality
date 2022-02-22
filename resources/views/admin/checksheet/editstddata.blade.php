@extends('admin.include.layout')
<!-- Project List -->



@section('head')
<style>
    .custom-control-label::before,
    .custom-control-label::after {
        top: 0.2rem;
        width: 1.25rem;
        height: 1.25rem;
    }
</style>



    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Edit STd Data</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('body')

    <!-- Project List -->
    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{url('admin/stddata-edit-save')}}" enctype="multipart/form-data">
          <h3>STd Data Selection</h3>
           @php
          //dd($errors);
           @endphp


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id">Department</label>
                            <select name="dept_id" class="form-control" required>
                                <option value="">Select</option>
                                @php
                                    $dept=App\Helpers\UserHelper::departmentforchecksheet();
                                @endphp

                                @foreach($dept as $dep)

                                    <option value="{{$dep->id}}" {{($errors->dept_id==$dep->id)? 'selected=selected':''}}>{{$dep->name}}</option>

                                @endforeach

                            </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id">Model No</label>
                            <select name="model_id" class="form-control" required>
                                <option value="">Select</option>
                                @php
                                    $mchmodel=App\Helpers\UserHelper::machinemodelno();
                                @endphp

                                @foreach($mchmodel as $model)

                                    <option value="{{$model->id}}" {{($errors->model_id==$model->id)? 'selected=selected':''}}>{{$model->model_no}}</option>

                                @endforeach

                            </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group " >
                            <label for="" class="form-control-label">Section Name</label>

                            <input id="" type="text" class="form-control" name="section_name" value="{{$namefind}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group " >
                            <label for="" class="form-control-label">Name</label>

                            <select name="name" class="form-control" >
                                <option value="">Select</option>
                                @php
                                    $mchmodel=App\Helpers\UserHelper::viewstdDataName();
                                @endphp

                                @foreach($mchmodel as $model)

                                    <option value="{{$model->name}}" {{($errors->name==$model->name)? 'selected=selected':''}}>{{$model->name}}</option>

                                @endforeach

                            </select>

                        </div>
                    </div>




                    <div class="col-md-3">
                        <div class="form-group" >
                            <label for="role">Lower Limit in MM</label>
                            <input id="" type="text" class="form-control" name="lower_limit_mm" value="{{$errors->lower_limit_mm}}">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" >
                            <label for="role">Upper Limit in MM</label>
                            <input id="" type="text" class="form-control" name="upper_limit_mm" value="{{$errors->upper_limit_mm}}">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" >
                            <label for="role">Lower Limit in INCH</label>
                            <input id="" type="text" class="form-control" name="lower_limit_inch" value="{{$errors->lower_limit_inch}}">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="role">Upper Limit in INCH</label>
                            <input id="" type="text" class="form-control" name="lower_limit_inch" value="{{$errors->lower_limit_inch}}">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="role">Description</label>
                            <input id="" type="text" class="form-control" name="description" value="{{$errors->description}}" required>

                        </div>
                    </div>

                </div>



                <!-- /row -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="id" value="{{$errors['id']}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                <button class="btn btn-warning" type="cancel">Cancel</button>
            </form>
        </div>


    </div>



@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>






    <script type="text/javascript">
        /*component model no*/
        $('.mainsection').change(function(event) {
            var columnchksht = [];
            $.each($("input[name='section_id1']:checked"), function(){
                columnchksht.push($(this).val());
            });

            //alert("section: " + favorite.join(", "));

            //console.log(model);

            $.ajax({
                url: '{{ url("/admin/column-section-show") }}',
                type: 'POST',
                data: {columnchksht:columnchksht,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);





                    $('.childsection').show();

                    $('#columnContainer').html(response);

                    //$('.compserial').show();

                    // $('#compserial').html(response);

                    //mctype= jQuery.parseJSON(response);

                    console.log("success");

                })

                .fail(function() {

                    console.log("error");

                })

                .always(function() {

                    console.log("complete");

                });



        });
    </script>

@endsection