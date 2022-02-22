@extends('admin.include.layout')

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Checksheet Details</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')
    <div class="row">

        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <h3 class="mb-0">All Users Details</h3>

                        </div>


                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">id</th>



                                    <th scope="col" class="sort" data-sort="name">Status</th>
                                <th scope="col" class="sort" data-sort="name">Show Check Sheet</th>
                                   <!-- <th scope="col" class="sort" data-sort="name">Action</th>-->
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <!--<input type="radio" name="" value="submit">Approved
                    <input type="radio" name="" value="cancel">Reject-->

                </div>
            </div>
                        </div>
                    </div>
                    @endsection

                    @section('after_script')

                        <script src="{{URL::asset('public/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
                        <script src="{{URL::asset('public/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#tabe1').DataTable({
                                    processing: true,
                                    serverSide: true,

                                    ajax:{
                                        url: '{{ url("admin/fetchservichecksheet-get-table") }}',
                                    },
                                    columns: [
                                        {data: 'id', name: 'id',orderable: false, searchable: false},

                                        {data: 'status', name: 'status'} ,
                                        {data: 'action', name: 'action', orderable: false, searchable: false} ,
                                     //   {data: 'action', name: 'action', orderable: false, searchable: false} ,
                                    ],
                                });
                            });
                        </script>

@endsection




