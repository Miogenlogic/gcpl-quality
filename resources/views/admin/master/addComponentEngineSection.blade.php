@extends('admin.include.layout')
<!-- Project List -->
@section('after_styles')
    <link href="https://raw.githack.com/jamiebicknell/Toggle-Switch/master/toggleswitch.css" rel="stylesheet" />
@endsection

@section('head')
    
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Create new Component Section</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">New Component Section</li>
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
            <form method="post" action="{{url('admin/component-section-add-save')}}" enctype="multipart/form-data">
                <div class="row">
                     <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="service">Name*</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" id="service" value="" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <label for='status'>Status</label>
                        <input type='checkbox' name='status' id='status' value='1' class='toggleswitch' />
                    </div>
                </div><!-- /row -->
                <div class="row">
                     <div id="clone-container">

                    
                        <div class="mb-3 row border p-4 main-parent" style="margin-left: 0;">
                            <div class="col-md-8">
                                <input type="text" name="parent[0][name]" placeholder="Enter Child Section Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success add" >Add</button>
                            </div>
                            <div id="clone-container-child-0 " >

                    
                                <div class="mb-3 row  p-4">
                                    <div class="col-md-8">
                                        <input type="text" name="parent[0][child][]" placeholder="Enter Sub Child Section" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success add-child" data-id="0" >Add</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button class="btn btn-primary" type="submit">Save</button>

                <button type="reset" class="btn btn-warning" onclick='location.href ="{{url('admin/component-section-list')}}"'>Cancel</button>
            </form>
        </div>
    </div>



@endsection
@section('after_script')

    <!-- Optional JS -->
    <script src="{{URL::asset('public/assets/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script type='text/javascript' src='https://raw.githack.com/jamiebicknell/Toggle-Switch/master/jquery.toggleswitch.js'></script>
    <script>
        $('#section').select2();
        $('#child').select2();

            function cloneHtmlReturn(){
            parent = document.querySelectorAll('.main-parent');
            console.log(parent.length);
            var cloneHtml = `
                <div class="mb-3 row border p-4 main-parent" style="margin-left: 0;">
                    <div class="col-md-8">
                        <input type="text" name="parent[${parent.length}][name]" placeholder="Enter Child Section Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success  add" >Add</button>
                        <button type="submit" class="btn btn-danger d-inline remove">Remove</button>
                    </div>
                    <div id="clone-container-child-${parent.length}" >

                                        
                        <div class="mb-3 row  p-4">
                            <div class="col-md-8">
                                <input type="text" name="parent[${parent.length}][child][]" placeholder="Enter Sub Child Section" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success add-child" data-id="${parent.length}">Add</button>

                            </div>
                            
                        </div>
                    </div>
                `;
            return cloneHtml;
        }
        function cloneHtmlChildReturn(id){
            parent = document.querySelectorAll('.main-parent');
            var cloneHtml = `                 
                <div class="mb-3 row  p-4">
                    <div class="col-md-8">

                        <input type="text" name="parent[${id}][child][]" class="form-control" placeholder="Enter Sub Child Section" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="col-md-4" style='display: flex;'>
                        <button type="submit" class="btn btn-success add-child" data-id="${id}">Add</button>
                        <button type="submit" class="btn btn-danger d-inline remove-child">Remove</button>

                    </div>
                    
                </div>
            `;
            return cloneHtml;
        }
        $(document).ready(function(){
            $(document).on('click','.add',function(e){
                e.preventDefault();
                $('#clone-container').append(cloneHtmlReturn());
            });
            $(document).on('click','.remove',function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
            });
            $(document).on('click','.add-child',function(e){
                e.preventDefault();
                var id = $(this).data('id');
                $(this).parent().parent().parent().append(cloneHtmlChildReturn(id));
            });
            $(document).on('click','.remove-child',function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
            });
        });
    </script>



@endsection