@extends('admin.include.layout')
<!-- Project List -->




@section('body')

   <div class="row">
    <div class="col-xl-12">
        <h3>qa_qc</h3>
        <div class="row">

            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Latest created service requests</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="number">#</th>
                                <th scope="col" class="sort" data-sort="name">Customer</th>
                                <th scope="col" class="sort" data-sort="job">Job no.</th>
                                <th scope="col" class="sort" data-sort="model">Model</th>
                                <th scope="col">Components name</th>
                                <th scope="col" class="sort" data-sort="date">Date</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <tr>
                                <td class="number">#S231450</td>
                                <td class="name font-weight-500">TATA STEEL LTD</td>
                                <td class="job">5500004773</td>
                                <td class="model">16H</td>
                                <td>TRANSMISSION</td>
                                <td>11/28/2019</td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="number">#S56470</td>
                                <td class="name font-weight-500">DHANSAR ENGINEERING</td>
                                <td class="job">5500004773</td>
                                <td class="model">3406</td>
                                <td>ENGINE</td>
                                <td>1/13/2019</td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="number">#S56470</td>
                                <td class="name font-weight-500">TEMAT LOKHO</td>
                                <td class="job">5500004748</td>
                                <td class="model">C9</td>
                                <td>ENGINE</td>
                                <td>5/13/2019</td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="number">#S56470</td>
                                <td class="name font-weight-500">HILTOP</td>
                                <td class="job">5500004582</td>
                                <td class="model">973C</td>
                                <td>TRACK ROLLER</td>
                                <td>1/13/2019</td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="number">#S231450</td>
                                <td class="name font-weight-500">INTERNATIONAL COMMERCE</td>
                                <td class="job">5500005152</td>
                                <td class="model">3306</td>
                                <td>MACHINE</td>
                                <td>1/13/2019</td>

                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection