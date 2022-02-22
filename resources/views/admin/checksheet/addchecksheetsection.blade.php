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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Create New section</h6>
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
            <form method="post" action="{{url('admin/checksheetsection-add-save')}}" enctype="multipart/form-data">
          <h3>Section Selection</h3>


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

                                    @php
                                        $sect=App\Helpers\UserHelper::sectionforchecksheet();
                                        $i=1;
                                    @endphp

                                    @foreach($sect as $sec)
                                        <div class="custom-control form-control-lg custom-checkbox">
                                            <input type="checkbox"  name="section_id[]" value="{{$sec->id}}" class="custom-control-input getsection" id="customCheck{{$i}}">
                                            <label class="custom-control-label" for="customCheck{{$i}}">{{$sec->name}}</label>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach

                            </div>
                        </div>


                        <div class="col-md-3 " >
                            <div class="form-group"  style="height: 335px;
        overflow-x: scroll">

                                   <label for="" class="form-control-label  childsection">Child Section</label>
                                            <div id="childsectionContainer">
                                    {{--<input type="checkbox" class="check" id="childSection_2">--}}
                                    </div>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" style="height: 335px;
    overflow-x: scroll">


                                <label for="subsection_id" class="form-control-label  subchildsection">Sub child Section</label>

                                    <div id="subchildsectionContainer1">

                                        @php
                                            $subchildsecnew=App\Helpers\UserHelper::subchildpopulate();
                                            //echo '<pre>'; print_r($subchildsecnew);exit;
                                        $sub=1;
                                        @endphp
                                        @foreach ($subchildsecnew as $key => $value)
                                            <div class="custom-control form-control-lg custom-checkbox">
                                            <input type="checkbox"  name="subsection_id[]" value="{{$value['id']}}" class="custom-control-input" id="subcustomCheck{{$key}}">
                                            <label class="custom-control-label" for="subcustomCheck{{$key}}">{{$value['sub_child_section']}}</label>
                                            </div>

                                       @endforeach
                                        @php
                                            $sub++;
                                        //exit;
                                        @endphp

                                    </div>


                            </div>
                        </div>



                    </div>



                <!-- /row -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
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
        $('.getsection').change(function(event) {
            var checkshtchild = [];
            $.each($("input[name='section_id[]']:checked"), function(){
                checkshtchild.push($(this).val());
            });

            //alert("section: " + favorite.join(", "));

            //console.log(model);

            $.ajax({
                url: '{{ url("/admin/child-section-show") }}',
                type: 'POST',
                data: {checkshtchild:checkshtchild,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);





                    $('.childsection').show();

                    $('#childsectionContainer').html(response);

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

    <script type="text/javascript">
        /*component model no*/
       $('.childSection_1').click(function(event) {
        console.log(2);
        //$('#childSection').change(function(event) {
          //  var subsect = $(this).val();
            var subsect = [];
            $.each($("input[name='child_id[]']:checked"), function(){
                subsect.push($(this).val());
            });
            //alert("section: " + favorite.join(", "));

            //console.log(model);

            $.ajax({
                url: '{{ url("/admin/sub-child-section-show") }}',
                type: 'POST',
                data: {subsect:subsect,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);

                    $('.subchildsection').show();

                    $('#subchildsectionContainer').html(response);

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