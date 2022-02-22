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
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">All Branch Name</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/branch-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Branches</li>
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
                            <h3 class="mb-0">All Branch Details</h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabe1">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="number">#</th>
                                    <th scope="col" class="sort" data-sort="name">Sl No</th>
                                    <th scope="col" class="sort" data-sort="name">Job No.</th>
                                    <th scope="col" class="sort" data-sort="name">Customer</th>
                                    <th scope="col" class="sort" data-sort="name">Branch</th>
                                    <th scope="col" class="sort" data-sort="name">Component</th>
                                    <th scope="col" class="sort" data-sort="name">Smu Hours</th>
                                    <th scope="col" class="sort" data-sort="name">Model</th>
                                    <th scope="col" class="sort" data-sort="name">Serial No</th>
                                    <th scope="col" class="sort" data-sort="name">Dispatch date</th>
                                    <th scope="col" class="sort" data-sort="name">Job Done By</th>
                                    <th scope="col" class="sort" data-sort="name">Business Segment</th>
                                    <th scope="col" class="sort" data-sort="name">Complain Receive date</th>
                                    <th scope="col" class="sort" data-sort="name">Year</th>
                                    <th scope="col" class="sort" data-sort="name">Customer Complain</th>
                                    <th scope="col" class="sort" data-sort="name">Response date</th>
                                    <th scope="col" class="sort" data-sort="name">Attainded By</th>
                                    <th scope="col" class="sort" data-sort="name">Completion Date</th>
                                    <th scope="col" class="sort" data-sort="name">Root Cause</th>
                                    <th scope="col" class="sort" data-sort="name">Why</th>
                                    <th scope="col" class="sort" data-sort="name">Why</th>
                                    <th scope="col" class="sort" data-sort="name">Resolution</th>
                                    <th scope="col" class="sort" data-sort="name">Types of Problems</th>
                                    <th scope="col" class="sort" data-sort="name">Condition Details</th>
                                    <th scope="col" class="sort" data-sort="name">Status</th>
                                    <th scope="col" class="sort" data-sort="name">Actual Resolution Date</th>
                                    <th scope="col" class="sort" data-sort="name">Area of Problem</th>

                                    <th scope="col" class="sort" data-sort="name">System</th>



                                    <th scope="col" class="sort" data-sort="name">Action</th>
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
                    url: '{{ url("admin/aischecksheet-get-table") }}',
                },
                columns: [
                    {data: 'id', name: 'id',orderable: false, searchable: false},
                    {data: 'sl_no', name: 'sl_no'},
                    {data: 'job_no', name: 'job_no'},
                    {data: 'customer', name: 'customer'},
                    {data: 'branch', name: 'branch'},
                    {data: 'component', name: 'component'},
                    {data: 'smu_hours', name: 'smu_hours'},

                    {data: 'model', name: 'model'},
                    {data: 'serial_no', name: 'serial_no'},
                    {data: 'dispatch_date', name: 'dispatch_date'},
                    {data: 'job_done_by', name: 'job_done_by'},
                    {data: 'business_segment', name: 'business_segment'},
                    {data: 'complain_receive_date', name: 'complain_receive_date'},
                    {data: 'month', name: 'month'},
                    {data: 'customer_complain', name: 'customer_complain'},
                    {data: 'response_date', name: 'response_date'},
                    {data: 'attainded_by', name: 'attainded_by'},
                    {data: 'completion_date', name: 'completion_date'},
                    {data: 'root_cause', name: 'root_cause'},
                    {data: 'why_y1', name: 'why_y1'},
                    {data: 'why_y2', name: 'why_y2'},
                    {data: 'resolution', name: 'resolution'},
                    {data: 'type_of_problem', name: 'type_of_problem'},
                    {data: 'condition_details', name: 'condition_details'},
                    {data: 'status', name: 'status'},
                    {data: 'actual_resolution_date', name: 'actual_resolution_date'},
                    {data: 'area_of_problem', name: 'area_of_problem'},
                    {data: 'system', name: 'system'},


                    {data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>


@endsection
