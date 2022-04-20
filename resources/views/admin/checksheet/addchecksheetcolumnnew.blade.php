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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Create New column</h6>
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
            <form method="post" action="{{url('admin/checksheetcolumn-add-save-new')}}" enctype="multipart/form-data">

                  <h3>Columns Selection </h3>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id">Department</label>
                            <select name="dept_id" class="form-control">
                                @php
                                    $dept=App\Helpers\UserHelper::departmentforchecksheet();
                                @endphp

                                @foreach($dept as $dep)

                                    <option value="{{$dep->id}}">{{$dep->name}}</option>

                                @endforeach

                            </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id">Model No</label>
                            <select name="model_id" class="form-control">
                                @php
                                    $mchmodel=App\Helpers\UserHelper::machinemodelno();
                                @endphp

                                @foreach($mchmodel as $model)

                                    <option value="{{$model->id}}">{{$model->model_no}}</option>

                                @endforeach

                            </select>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group " style="height: 335px;
    overflow-x: scroll">
                            <label for="section_id" class="form-control-label  originalsection">Section</label>
                            <select name="section_id" id="section_id" class="form-control mainsection">
                                <option value=''>Select Section</option>
                                @php
                                    $sect=App\Helpers\UserHelper::sectionforcolumnnew($dept[0]->id,$mchmodel[0]->id);
                                    $i=1;
                                @endphp

                                @foreach($sect as $sec)

                                    <option value="{{$sec->id}}">{{$sec->name}}</option>
                                
                                @php
                                    $i++;
                                @endphp
                                    
                                @endforeach

                            </select>
                            

                        </div>
                    </div>




                    <div class="col-md-3">
                        <div class="form-group" style="height: 335px;
    overflow-x: scroll">
                            <label for="role">Columns</label>
                            <div id="columnContainer">

                            </div>

                        </div>
                    </div>
                </div>



                <!-- /row -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                <!-- <button class="btn btn-warning" type="cancel">Cancel</button> -->
                <a class="btn btn-warning" href="{{url('admin/checksheetcolumn-listing-new')}}">Cancel</a>
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
            // $.each($("input[name='section_id']:checked"), function(){
            //     columnchksht.push($(this).val());
            // });

            var section_id = $("#section_id").val();
            columnchksht.push(section_id);
            //alert("section: " + favorite.join(", "));

            // console.log(columnchksht);

            $.ajax({
                url: '{{ url("/admin/column-section-show-new") }}',
                type: 'POST',
                data: {edit:0,columnchksht:columnchksht,'_token':'{{csrf_token()}}'},

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