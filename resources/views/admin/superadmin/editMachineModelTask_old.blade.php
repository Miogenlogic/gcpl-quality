@extends('admin.include.layout')
<!-- Project List -->

@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Branch Name</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Branch Name</li>
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
                            <label for="question">Model No</label>
                            <select name="model_no" id="model_id" class="form-control">
                                <option value="" selected="selected">select</option>
                                @foreach($modelno as  $model)
                                    <option value="{{$model->model_no}}" {{($errors->model_no==$model->model_no)? 'selected=selected':''}}>
                                        {{$model->model_no}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="name">Name</lable>
                            <input type="text" class="form-control" id=""  name="name" value="{{old('name')?old('name'):$errors->name}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Parent Task</label>
                            <select class="form-control select2" name="parent" id="predicessor">
                                <option value="">Select </option>
                                <?php if(!empty($predicessor)){
                                foreach($predicessor as $pred){
                                ?>
                                <option value="<?php echo $pred['name']; ?>" {{($errors->parent==$pred->parent)? 'selected=selected':''}}><?php echo $pred['name']; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="tat">Sort Order</lable>
                            <input type="text" class="form-control" id=""  name="sort_order" value="{{old('sort_order')?old('sort_order'):$errors->sort_order}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="tat">Turn Around Time(TAT)</lable>
                            <input type="text" class="form-control" id=""  name="tat" value="{{old('tat')?old('tat'):$errors->tat}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="tat">Predecessor</lable>
                            <select name="predicessor[]" class="form-control" multiple>
                                <option disabled>Select Predecessor </option>

                                <?php if(!empty($predicessor)){ foreach ($predicessor as $key=>$predicessors) { if(in_array($predicessors['name'],$pre)){ $select="selected"; }else{ $select=""; } ?>
                                <option value="{{$predicessors['name']}}" {{$select}}>{{$predicessors['name']}}</option>
                                <?php }} ?>

                            </select>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="tat">Department</lable>
                            <select class="form-control select2 custom-select" name="dept_id" id="dept_id">
                                <option value="">-- Select --</option>
                                @foreach($dept as $val)
                                    <option value="{{$val->id}}" {{($errors->dept_id==$val->id)? 'selected=selected':''}}>{{$val->name}}</option>
                                @endforeach
                                {{--<?php if(!empty($dept)){ foreach ($dept as $key=>$dept_employee) { if(in_array($dept_employee['id'],$departments)){ $select="selected"; }else{ $select=""; } ?>--}}
                                {{--<option value="{{$dept_employee['id']}}" {{$select}}>{{$dept_employee['name']}}</option>--}}
                                {{--<?php }} ?>--}}
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="tat">Activity</lable>
                            <select class="form-control select2 custom-select" name="checkSheet_section_id" id="checkSheet_section_id">
                                <option value="{{$errors['checkSheet_section_id']}}" >-- Select --</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="tat">Relation Type</lable>
                            <select class="form-control" name="relation_type">
                                <option>Select relation</option>
                                @foreach($relation as $val)
                                    <option value="{{$val->name}}" {{($errors->relation_type==$val->name)? 'selected=selected':''}}>{{$val->name}}</option>
                                @endforeach
                            </select>
                            {{--<input type="text" class="form-control" id=""  name="relation_type" value="{{old('relation_type')?old('relation_type'):$errors->relation_type}}">--}}
                            {{--</select>--}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Description</label>
                            <input type="text" class="form-control" id="" placeholder="Description" name="description" value="{{old('description')?old('description'):$errors->description}}">
                            {{--@if($errors->has('description'))--}}
                                {{--<div class="invalid-feedback" style="display:block;">{{$errors->first('description')}}</div>--}}
                            {{--@endif--}}
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
        $("#dept_id").click(function () {
            console.log($(this).val())
            // console.log('Saheli')
            var dept_id=$(this).val();
            $.ajax({
                type: "POST",
                url: "{{url('admin/get-activity-by-dept')}}",
                data:{'dept_id':dept_id,'_token':'{{csrf_token()}}'},
                success: function(response){
                    $('#checkSheet_section_id').html(response);
                }
            });
            // console.log('Saheli')
        });
    </script>

@endsection
