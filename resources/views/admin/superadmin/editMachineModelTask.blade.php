@extends('admin.include.layout')
<!-- Project List -->

@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Edit Task/Subtask Details</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Task/Subtask</li>
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
            <?php $departments=explode( ',',$errors[ 'dept_id']); ?>
            <?php $pre=explode( ',',$errors[ 'predicessor']);
//            echo'<pre>';print_r($pre);exit();
            ?>
            <form method="post" action="{{ url('admin/updatemachinetask')}}" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Department</label>
                            <select name="dept_id" id="dept_id" class="form-control">
                                <option value="" selected="selected">select</option>
                                @foreach($dept as  $depart)
                                    <option value="{{$depart->id}}" {{($errors->dept_id==$depart->id)? 'selected=selected':''}}>
                                        {{$depart->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Model No</label>
                            <select name="model_no" id="model_id" class="form-control">
                                <option value="" selected="selected">select</option>
                                @foreach($modelno as  $model)
                                    <option value="{{$model->id}}" {{($errors->model_no==$model->id)? 'selected=selected':''}}>
                                        {{$model->model_no}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id=""  name="name" value="{{old('name')?old('name'):$errors->name}}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tat">Turn Around Time(TAT)</label>
                            <input type="text" class="form-control" id=""  name="tat" value="{{old('tat')?old('tat'):$errors->tat}}">
                        </div>
                    </div>

                   @if(empty($errors->parent) || ($errors->parent == 'NULL'))
                       @php
                       $parentt= 'hidden';

                       @endphp
                    @else
                        @php
                        $parentt= '';
                         @endphp
                    @endif
                    <div class="col-md-6" {{$parentt}}>
                        <div class="form-group">
                            <label for="question" class="form-control-label parent">Parent Task</label>

                            <select class="form-control " name="parent" id="parent">


                           @if(!empty($errors->parent))
                                    @php

                                     $namefind=\App\Helpers\UserHelper::prediorparentname($errors->parent);

                                    @endphp
                             @if(!empty($namefind))
                              <option value="{{$namefind[0]['id']}} ">{{$namefind[0]['name']}}</option>

                            @endif
                           @endif

                            </select>
                        </div>
                    </div>



                    @if(empty($errors->predicessor) || ($errors->predicessor == 'NULL'))
                        @php
                            $predi= 'hidden';
                        @endphp
                    @else
                         @php
                        $predi= ' ';
                         @endphp
                    @endif

                    <div class="col-md-6" {{$predi}}>
                        <div class="form-group">
                            <label for="tat" class="form-control-label predicessor">Predecessor</label>
                            <select name="predicessor" class="form-control" id="predicessor">
                                @if(!empty($errors->predicessor))
                                    @php

                                        $namefindpre=\App\Helpers\UserHelper::prediorparentname($errors->predicessor);

                                    @endphp
                                  @if(!empty($namefindpre))
                                    <option value="{{$namefindpre[0]['id']}} ">{{$namefindpre[0]['name']}}</option>
                                   @endif
                                @endif

                            </select>

                        </div>
                    </div>





                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="tat">Relation Type</lable>
                            <select class="form-control" name="relation_type" required>
                                <option value="">Select relation</option>
                                @foreach($relation as $val)
                                    <option value="{{$val->name}}" {{($errors->relation_type==$val->name)? 'selected=selected':''}} >{{$val->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Description</label>
                            <input type="text" class="form-control" id="" placeholder="Description" name="description" value="{{old('description')?old('description'):$errors->description}}">

                        </div>
                    </div>

                </div>

                <!-- /row -->
                <input type="hidden" name="id" value="{{$errors->id}}">
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
        {{--$("#dept_id").click(function () {--}}
            {{--console.log($(this).val())--}}
            {{--// console.log('Saheli')--}}
            {{--var dept_id=$(this).val();--}}
            {{--$.ajax({--}}
                {{--type: "POST",--}}
                {{--url: "{{url('admin/get-activity-by-dept')}}",--}}
                {{--data:{'dept_id':dept_id,'_token':'{{csrf_token()}}'},--}}
                {{--success: function(response){--}}
                    {{--$('#checkSheet_section_id').html(response);--}}
                {{--}--}}
            {{--});--}}
            {{--// console.log('Saheli')--}}
        {{--});--}}

        $('#model_id').change(function(event) {
            var dept_id=$("#dept_id").val();
            var model_id=$("#model_id").val();
            //alert(model);
            console.log(dept_id);
            console.log(model_id);

            $.ajax({

                url: '{{ url("/admin/predicessor-found") }}',

                type: 'POST',

                data: {dept_id:dept_id,model_id:model_id,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);



                    $('.predicessor').show();

                    $('#predicessor').html(response);

                    console.log("success");

                })

                .fail(function() {

                    console.log("error");

                })

                .always(function() {

                    console.log("complete");

                });



        });

        $('#model_id').change(function(event) {
            var dept_id=$("#dept_id").val();
            var model_id=$("#model_id").val();
            //alert(model);
            console.log(dept_id);
            console.log(model_id);

            $.ajax({

                url: '{{ url("/admin/predicessor-found") }}',

                type: 'POST',

                data: {dept_id:dept_id,model_id:model_id,'_token':'{{csrf_token()}}'},

            })

                .done(function(response) {
                    //console.log(response);



                    $('.parent').show();

                    $('#parent').html(response);

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
