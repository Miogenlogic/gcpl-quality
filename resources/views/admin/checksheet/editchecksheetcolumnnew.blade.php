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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Edit Column</h6>
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
            <form method="post" action="{{url('admin/checksheetcolumn-edit-save-new')}}" enctype="multipart/form-data">
          <h3>Section Selection</h3>
           @php
          //dd($errors);
           @endphp


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id">Department</label>
                                <select name="dept_id" class="form-control" disabled>
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
                                <select name="model_id" class="form-control" disabled>
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
                            <div class="form-group " style="">
                                <label for="section_id" class="form-control-label  mainsection">Section</label>
                                <select name="section_id" id="section_id" class="form-control mainsection" disabled>
                                    <option value=''>Select Section</option>
                                    @php
                                        $sect=App\Helpers\UserHelper::sectionforcolumnnew($errors->dept_id,$errors->model_id);
                                        $i=1;
                                    @endphp

                                    @foreach($sect as $sec)

                                        <option value="{{$sec->id}}" {{($errors->section_id==$sec->id)? 'selected=selected':''}}>{{$sec->name}}</option>
                                    
                                    @php
                                        $i++;
                                    @endphp
                                        
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group " style="">
                                <label for="child_section_id" class="form-control-label  mainsection">Child Section</label>
                                <select name="child_section_id" id="child_section_id" class="form-control childsection" disabled>
                                    <option value=''>Select Child Section</option>
                                    @php
                                        $childsect=App\Helpers\UserHelper::childsectionforcolumnnew($errors->dept_id,$errors->model_id);
                                        $i=1;
                                    @endphp

                                    @foreach($childsect as $sec)

                                        <option value="{{$sec->id}}" {{($errors->child_section_id==$sec->id)? 'selected=selected':''}}>{{$sec->child_section}}</option>
                                    
                                    @php
                                        $i++;
                                    @endphp
                                        
                                    @endforeach

                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group " style="">
                                <label for="sub_child_section_id" class="form-control-label  mainsection">Sub Child Section</label>
                                <select name="sub_child_section_id" id="sub_child_section_id" class="form-control subchildsection" disabled>
                                    <option value=''>Select Sub Child Section</option>
                                    @php
                                        $subchildsect=App\Helpers\UserHelper::subchildsectionforcolumnnew($errors->dept_id,$errors->model_id);
                                        $i=1;
                                    @endphp

                                    @foreach($subchildsect as $sec)

                                        <option value="{{$sec->id}}" {{($errors->sub_child_section_id==$sec->id)? 'selected=selected':''}}>{{$sec->sub_child_section}}</option>
                                    
                                    @php
                                        $i++;
                                    @endphp
                                        
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="col-md-3 " >
                            <div class="form-group"  style="height: 335px;
        overflow-x: scroll">

                                   <label for="" class="form-control-label  childsection">Column</label>
                                            <div id="columnContainer">
                                    {{--<input type="checkbox" class="check" id="childSection_2">--}}
                                           @if(!empty($errors['column_id']))
                                                @php
                                                    $childsecnew=App\Helpers\UserHelper::columnpopulate();
                                                    $did=(explode(',',$errors['column_id']));
                                                $sub=1;
                                                @endphp
                                                @foreach ($childsecnew as $key => $value)
                                                    <div class="custom-control form-control-lg custom-checkbox">
                                                        <input type="checkbox"  name="columnSection[]" value="{{$value['id']}}" @foreach ($did as $val){{$value['id'] == $val ? 'checked' : '' }}@endforeach class="custom-control-input mainsection" id="columnSection{{$key}}">
                                                        <label class="custom-control-label" for="columnSection{{$key}}">{{$value['columns']}}</label>
                                                    </div>

                                                @endforeach
                                                @php
                                                    $sub++;
                                                //exit;
                                                @endphp
                                           @endif
                                    </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="section_id" class="form-control-label  originalsection">No of Row / Column</label>
                                <input type="text" name="no_of_row_column" id="no_of_row_column" class="form-control" value="{{$errors['no_of_row_column']}}">
                            </div>
                        </div>




                    </div>



                <!-- /row -->
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="id" value="{{$errors['id']}}">
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
        $('.mainsection-bck').change(function(event) {
            var columnchksht = [];
            // $.each($("input[name='section_id']:checked"), function(){
            //     columnchksht.push($(this).val());
            // });

            var section_id = $("#section_id").val();
            columnchksht.push(section_id);

            //alert("section: " + favorite.join(", "));

            //console.log(model);

            $.ajax({
                url: '{{ url("/admin/column-section-show-new") }}',
                type: 'POST',
                data: {edit:{{$errors->id}},columnchksht:columnchksht,'_token':'{{csrf_token()}}'},

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