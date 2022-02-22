@extends('admin.include.layout')
<!-- Project List -->

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('head')
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">All Employee</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/super-admin-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Employee</li>
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
                            <h3 class="mb-0">All Employee</h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="name">Employee Name</th>
                                    <th scope="col" class="sort" data-sort="name">Code</th>
                                    <!-- <th scope="col" class="sort" data-sort="name">Action</th>
                                   <th scope="col" class="sort" data-sort="name">Status</th>
                                    <th scope="col" class="sort" data-sort="name">Created At</th>-->
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
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
                    url: '{{ url("admin/employee-name-get-table") }}',
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'emp_code', name: 'emp_code'},
                    //{data: 'roles', name: 'roles'},
                    //{data: 'status', name: 'status'},
                    //{data: 'component_name', name: 'component_name'},
                    //{data: 'created_at', name: 'created_at'},
                    //{data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>


@endsection