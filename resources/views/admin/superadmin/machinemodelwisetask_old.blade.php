@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Master Screen For Project</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Task Master</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

<?php
//  $countService=App\Helpers\UserHelper::countService();
// echo count($countService);
?>

@endsection
@section('body')
    @php
        //print_r( $mastermenu);
        //exit;

    @endphp




    <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
            <h3 class="mb-0">Please fill the form below</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form method="post" action="{{url('admin/insertmastertask')}}" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Model No</label>
                            <select name="model_no" id="model_id" class="form-control">
                             <option value="" selected="selected">select</option>
                                    @foreach($modelno as  $model)
                                    <option value="{{$model->id}}">
                                        {{$model->model_no}}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Task/Subtask</label>
                            <input type="text" class="form-control" id="" placeholder="name" name="name">
                            @if($errors->has('task_name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('	task_name')}}</div>
                            @endif
                        </div>
                    </div>

					<div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Parent Task</label>
                            <select class="form-control" name="parent">
							 <option value="" selected="selected">Select</option>
                             @foreach(  $selecttask as  $task)
                                <option value="{{$task->id}}">
                                    {{ $task->name}}
                                </option>
                             @endforeach
                            </select>
                        </div>
                    </div>

				    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Sort Order</label>
                            <input type="number" class="form-control" id="" placeholder="input order" name="sort_order">
                            @if($errors->has('sort_order'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('sort_order')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Turn Around Time(TAT)</label>
                            <input type="number" class="form-control" id="" placeholder="input in days" name="tat">
                            @if($errors->has('tat'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('tat')}}</div>
                            @endif
                        </div>
                    </div>
                      
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Predecessor</label>
                            <select class="form-control select2" multiple="multiple" name="predicessor[]" id="predicessor">
                                <option selected="selected">Select </option>
                                <?php if(!empty($predicessor)){
                                        foreach($predicessor as $pred){
                                    ?>
                                    <option value="<?php echo $pred['name']; ?>"><?php echo $pred['name']; ?></option>
                                    <?php }} ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label  machmodel" for="model">Department name</label>
                            <select name="dept_id" id="dept_id" class="form-control">
                                <option value="" selected="selected"> Select </option>
                                @foreach( $deptname as  $name)
                                    <option value="{{$name->id}}">
                                        {{ $name->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <lable for="tat">Activity</lable>
                            <select class="form-control select2 custom-select" name="checkSheet_section_id" id="checkSheet_section_id">
                                <option value="" selected>-- Select --</option>
                                {{--@foreach($checkSheet_sec as $val)--}}
                                    {{--<option value="{{$val->id}}">{{$val->name}}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Relation Type</label>
                            <select class="form-control" name="relation_type">
                                <option>Select relation</option>
                                @foreach($relation as $val)
                                    <option value="{{$val->name}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('relation_type'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('relation_type')}}</div>
                            @endif
                        </div>
                    </div>

                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="question">Description</label>
                            <input type="text" class="form-control" id="" placeholder="" name="description">
                            @if($errors->has('description'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('description')}}</div>
                            @endif
                        </div>
                     </div>
				{{--</div>--}}
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Submit</button>
                <button class="btn btn-warning" type="cancel">Cancel</button>
                </div>
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
            console.log('Saheli')
            var dept_id=$(this).val();
            $.ajax({
                type: "POST",
                url: "{{url('admin/get-activity-by-dept')}}",
                data:{'dept_id':dept_id,'_token':'{{csrf_token()}}'},
                success: function(response){
                    $('#checkSheet_section_id').html(response);
                }
            });

        });
    </script>

@endsection

