@extends('admin.include.layout')
<!-- Project List -->


@section('head')

    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 font-weight-400 text-white d-inline-block mb-0">Check sheet entry</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{url('admin/service-engineer-dashboard')}}"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Check sheet</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('body')

    <div class="accordion" id="checkSheet">

        <!-- Aggregate information -->
        <div class="card">
            <div class="card-header" id="aggregate-inforamtion">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseAggregate"
                            aria-expanded="true" aria-controls="collapseAggregate">
                        Aggregate information
                    </button>
                </h2>
            </div>

            <div id="collapseAggregate" class="collapse show" aria-labelledby="aggregate-inforamtion"
                 data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Aggregate type</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select aggregate type--</option>
                                        <option>Type 1</option>
                                        <option>Type 2</option>
                                        <option>Type 3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Model No.</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select Model no.--</option>
                                        <option>16H</option>
                                        <option>3406</option>
                                        <option>C9</option>
                                        <option>973C</option>
                                        <option>3306</option>
                                        <option>424</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Serial No.</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select Serial no.--</option>
                                        <option>4563215-256</option>
                                        <option>201548-562</option>
                                        <option>Any other serial</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Aggangement No.</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select arrangement no.--</option>
                                        <option>4563215-256</option>
                                        <option>201548-562</option>
                                        <option>Any other serial</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Customer</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select customer--</option>
                                        <option>TATA STEEL LTD.</option>
                                        <option>LPD LTD</option>
                                        <option>Any other customer</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer-contact">Customer contact</label>
                                    <input type="text" class="form-control" id="customer-contact" value="contact@customer.com" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="servicing-branch">Servicing branch</label>
                                    <input type="text" class="form-control" id="servicing-branch" value="Asansole" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="branch-contact">Branch contact</label>
                                    <input type="text" class="form-control" id="branch-contact" value="branch@contact.com" disabled>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="crc-supervisor">CRC supervisor</label>
                                    <input type="text" class="form-control" id="crc-supervisor" value="Mr. supervisor" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="crc-job-number">CRC job number</label>
                                    <input type="text" class="form-control" id="crc-job-number" placeholder="CRC job number">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="Branch-job-number">Branch job number <span class="text-muted">(if any)</span></label>
                                    <input type="text" class="form-control" id="Branch-job-number" placeholder="Branch job number">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="date-of-arrival">Date of arrival</label>
                                    <input type="text" class="datepicker form-control" id="date-of-arrival" placeholder="Date of arrival">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="date-of-dispatch">Date of dispatch</label>
                                    <input type="text" class="datepicker form-control" id="date-of-dispatch" placeholder="Date of dispatch">
                                </div>
                            </div>

                        </div><!-- /row -->

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>

                </div>
            </div>
        </div>

        <!-- Pre-history -->
        <div class="card">
            <div class="card-header" id="pre-history">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsePreHistory"
                            aria-expanded="false" aria-controls="collapsePreHistory">
                        Pre History
                    </button>
                </h2>
            </div>
            <div id="collapsePreHistory" class="collapse" aria-labelledby="pre-history" data-parent="#checkSheet">
                <div class="card-body">

                    <!-- Pre-history form -->
                    <form action="">

                        <!-- repair mode -->
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-control-label">Repair mode</label>
                            </div>
                            <div class="col-md-3">
                                <div class="very-own-radio">
                                    <input type="radio" id="control_01" name="select_file_color" value="1">
                                    <label class="" for="control_01">
                                        <h2>Planned</h2>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="very-own-radio">
                                    <input type="radio" id="control_02" name="select_file_color" value="2">
                                    <label class="" for="control_02">
                                        <h2>Accident/damage</h2>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="very-own-radio">
                                    <input type="radio" id="control_03" name="select_file_color" value="3">
                                    <label class="" for="control_03">
                                        <h2>Failure</h2>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="very-own-radio">
                                    <input type="radio" id="control_04" name="select_file_color" value="4">
                                    <label class="" for="control_04">
                                        <h2>Warrenty/re-do</h2>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="engine-serial-number">Engine serial no.</label>
                                    <input type="text" class="form-control" id="engine-serial-number" placeholder="Engine serial no.">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="engine-arrange-number">Engine arrange no.</label>
                                    <input type="text" class="form-control" id="engine-arrange-number" placeholder="Engine arrange no.">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="machine-type">Machine type</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Select machine type--</option>
                                        <option>ENGINE</option>
                                        <option>TRANSMISSION</option>
                                        <option>HYD</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="machine-serial-no">Machine serial no.</label>
                                    <input type="text" class="form-control" id="machine-serial-no" placeholder="Machine serial no.">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="component-life">Total component life(SMU)</label>
                                    <input type="text" class="form-control" id="component-life" placeholder="Total component life(SMU)">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">No of Overhauls Done</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--No of Overhauls Done--</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="customer">Last Overhaul SMU</label>
                                    <select class="form-control" data-toggle="select">
                                        <option>--Last Overhaul SMU--</option>
                                        <option>5</option>
                                        <option>1</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="faliure-details">Failure Details & nature of failure</label>
                                    <textarea type="text" class="form-control" id="faliure-details" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h4 class="border-bottom">Major Component Details (If the components were changed in the Field & SMU)</h4>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="cyllinder-head">Cylinder head</label>
                                    <textarea type="text" class="form-control" id="cyllinder-head" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="injector">Injector</label>
                                    <textarea type="text" class="form-control" id="injector" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="oil-pump">Oil pump</label>
                                    <textarea type="text" class="form-control" id="oil-pump" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="fuel-injection">Fuel injection pump</label>
                                    <textarea type="text" class="form-control" id="fuel-injection" rows="1"></textarea>
                                </div>
                            </div>

                        </div><!-- /row -->

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>
                    <!-- pre-history form end -->
                </div>
            </div>
        </div>


        <!-- Commercial & Logistics Report  -->
        <div class="card">
            <div class="card-header" id="commercial-logistic-report">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseLogisticReport" aria-expanded="false" aria-controls="collapseLogisticReport">
                        Commercial & Logistics Report
                    </button>
                </h2>
            </div>
            <div id="collapseLogisticReport" class="collapse" aria-labelledby="commercial-logistic-report" data-parent="#checkSheet">
                <div class="card-body">
                    <!-- List group -->
                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-10"><h4 class="mb-0">Delivery Challan</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice1" class="custom-control-input" id="yes" type="radio">
                                        <label class="custom-control-label" for="yes">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice1" class="custom-control-input" id="no" type="radio">
                                        <label class="custom-control-label" for="no">No</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-10"><h4 class="mb-0">Way Bill</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice2" class="custom-control-input" id="yes2" type="radio">
                                        <label class="custom-control-label" for="yes2">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice2" class="custom-control-input" id="no2" type="radio">
                                        <label class="custom-control-label" for="no2">No</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-10"><h4 class="mb-0">Pre-history</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice3" class="custom-control-input" id="yes3" type="radio">
                                        <label class="custom-control-label" for="yes3">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice3" class="custom-control-input" id="no3" type="radio">
                                        <label class="custom-control-label" for="no3">No</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-10"><h4 class="mb-0">Consignment copy</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice4" class="custom-control-input" id="yes4" type="radio">
                                        <label class="custom-control-label" for="yes4">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice4" class="custom-control-input" id="no4" type="radio">
                                        <label class="custom-control-label" for="no4">No</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-10"><h4 class="mb-0">Loose part list (if any)</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice5" class="custom-control-input" id="yes5" type="radio">
                                        <label class="custom-control-label" for="yes5">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice5" class="custom-control-input" id="no5" type="radio">
                                        <label class="custom-control-label" for="no5">No</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Others (please specify)</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice6" class="custom-control-input" id="yes6" type="radio">
                                        <label class="custom-control-label" for="yes6">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="hardchoice6" class="custom-control-input" id="no6" type="radio">
                                        <label class="custom-control-label" for="no6">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <textarea type="text" placeholder="any specification" class="form-control" rows="1"></textarea>
                                </div>
                            </div>
                        </li>

                    </ul>

                    <button class="btn btn-primary" type="submit">Save info</button>
                    <button class="btn btn-warning" type="reset">Reset form</button>
                </div>
            </div>
        </div>

        <!-- Loose part Report  -->
        <div class="card">
            <div class="card-header" id="loosePartreport">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseloosePart" aria-expanded="false" aria-controls="collapseloosePart">
                        Loose part report
                    </button>
                </h2>
            </div>
            <div id="collapseloosePart" class="collapse" aria-labelledby="loosePartreport" data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <!-- dynamic repeater wrapper -->
                        <div class="loose-part-repeat">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Part description" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="QTY">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Part condition" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input name="field_name[]" type="file" class="custom-file-input" id="customFileLang" lang="en">
                                            <label class="custom-file-label" for="customFileLang">Photograph taken</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>

        <!-- CC Inspection Check sheet after external washing  -->
        <div class="card">
            <div class="card-header" id="ccInspectionAfterWashing">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseAfterWashing" aria-expanded="false" aria-controls="collapseAfterWashing">
                        CC Inspection Check sheet after external washing
                    </button>
                </h2>
            </div>
            <div id="collapseAfterWashing" class="collapse" aria-labelledby="ccInspectionAfterWashing" data-parent="#checkSheet">
                <div class="card-body">

                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">All Port closed with dedicated caps & plugs</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck1" class="custom-control-input" id="ayes1" type="radio">
                                        <label class="custom-control-label" for="ayes1">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck1" class="custom-control-input" id="ano1" type="radio">
                                        <label class="custom-control-label" for="ano1">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Dart & debris cleaned</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck2" class="custom-control-input" id="ayes2" type="radio">
                                        <label class="custom-control-label" for="ayes2">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck2" class="custom-control-input" id="ano2" type="radio">
                                        <label class="custom-control-label" for="ano2">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Removals of loose jutes & cotton rags</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck3" class="custom-control-input" id="ayes3" type="radio">
                                        <label class="custom-control-label" for="ayes3">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck3" class="custom-control-input" id="ano3" type="radio">
                                        <label class="custom-control-label" for="ano3">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Removal of oil & grease stain marks</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck4" class="custom-control-input" id="ayes4" type="radio">
                                        <label class="custom-control-label" for="ayes4">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck4" class="custom-control-input" id="ano4" type="radio">
                                        <label class="custom-control-label" for="ano4">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Hot soapy water used for pressure jet cleaning </h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck5" class="custom-control-input" id="ayes5" type="radio">
                                        <label class="custom-control-label" for="ayes5">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck5" class="custom-control-input" id="ano5" type="radio">
                                        <label class="custom-control-label" for="ano5">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Dedicated lifting tackle used for aggregate movement to ly ly area</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck6" class="custom-control-input" id="ayes6" type="radio">
                                        <label class="custom-control-label" for="ayes6">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Accheck6" class="custom-control-input" id="ano6" type="radio">
                                        <label class="custom-control-label" for="ano6">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                    </ul>

                    <button class="btn btn-primary" type="submit">Save info</button>
                    <button class="btn btn-warning" type="reset">Reset form</button>

                </div>
            </div>
        </div>

        <!-- CC Inspection Check sheet after Parts Cleaning  -->
        <div class="card">
            <div class="card-header" id="ccInspectionAfterPartCleaning">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapseAfterPartCleaning" aria-expanded="false" aria-controls="collapseAfterPartCleaning">
                        CC Inspection Check sheet after Parts Cleaning
                    </button>
                </h2>
            </div>
            <div id="collapseAfterPartCleaning" class="collapse" aria-labelledby="ccInspectionAfterPartCleaning" data-parent="#checkSheet">
                <div class="card-body">

                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">


                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">All components are free from darts & debris, oil & grease stain marks</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck1" class="custom-control-input" id="byes" type="radio">
                                        <label class="custom-control-label" for="byes">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck1" class="custom-control-input" id="bno" type="radio">
                                        <label class="custom-control-label" for="bno">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Gaskets are properly removed from the seating surfaces as per Gasket Removal procedure</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck2" class="custom-control-input" id="byes2" type="radio">
                                        <label class="custom-control-label" for="byes2">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck2" class="custom-control-input" id="bno2" type="radio">
                                        <label class="custom-control-label" for="bno2">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Projectiles are used for Tube Cleaning</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck3" class="custom-control-input" id="byes3" type="radio">
                                        <label class="custom-control-label" for="byes3">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck3" class="custom-control-input" id="bno3" type="radio">
                                        <label class="custom-control-label" for="bno3">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">All Tubes & open ports are plugged with dedicated caps</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck4" class="custom-control-input" id="byes4" type="radio">
                                        <label class="custom-control-label" for="byes4">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck4" class="custom-control-input" id="bno4" type="radio">
                                        <label class="custom-control-label" for="bno4">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">Anti-rust oil is used on all ferrous components after final cleaning </h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck5" class="custom-control-input" id="byes5" type="radio">
                                        <label class="custom-control-label" for="byes5">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck5" class="custom-control-input" id="bno5" type="radio">
                                        <label class="custom-control-label" for="bno5">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-7"><h4 class="mb-0">All components are properly wrapped after final cleaning</h4></div>
                                <div class="col-2">
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck6" class="custom-control-input" id="byes6" type="radio">
                                        <label class="custom-control-label" for="byes6">Yes</label>
                                    </div>
                                    <div class="custom-control custom-control-inline custom-radio">
                                        <input name="Bccheck6" class="custom-control-input" id="bno6" type="radio">
                                        <label class="custom-control-label" for="bno6">No</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="" placeholder="Remarks">
                                </div>
                            </div>
                        </li>

                    </ul>
                    <button class="btn btn-primary" type="submit">Save info</button>
                    <button class="btn btn-warning" type="reset">Reset form</button>

                </div>
            </div>
        </div>

        <!-- Missing/Damaged Parts Report -->
        <div class="card">
            <div class="card-header" id="missingDamagedParts">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#collapsemissingDamagedPart" aria-expanded="false" aria-controls="collapsemissingDamagedPart">
                        Missing/Damaged Parts Report
                    </button>
                </h2>
            </div>
            <div id="collapsemissingDamagedPart" class="collapse" aria-labelledby="missingDamagedParts" data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <!-- dynamic repeater wrapper -->
                        <div class="missing-damaged-part-repeat">
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Part description</label>
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Part Description" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">QTY</label>
                                        <input type="text" name="field_name[]" class="form-control" placeholder="QTY">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Missing/damaged</label>
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Missing/ Damaged" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Photo taken?</label>
                                        <div class="custom-control custom-control custom-radio">
                                            <input name="mainy1" class="custom-control-input" id="y1" type="radio">
                                            <label class="custom-control-label" for="y1">Yes</label>
                                        </div>
                                        <div class="custom-control custom-control custom-radio">
                                            <input name="mainy1" class="custom-control-input" id="n1" type="radio">
                                            <label class="custom-control-label" for="n1">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Damage details</label>
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Damage Details" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Action taken</label>
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Action taken" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <a href="javascript:void(0);" class="btn btn-default mt-4 add_button">+</a>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>

        <!-- Parts Inspection Report (S440 Engine)  -->
        <div class="card">
            <div class="card-header" id="partsinceptionreport">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#partsinception" aria-expanded="false" aria-controls="partsinception">
                        Parts Inspection Report (S440 Engine)
                    </button>
                </h2>
            </div>
            <div id="partsinception" class="collapse" aria-labelledby="partsinceptionreport" data-parent="#checkSheet">
                <div class="card-body">

                    <!-- 1.	Cylinder Block Inspection  -->
                    <div id="cylinder-collape">
                        <div class="card">
                            <div class="card-header" id="cylinderinspectionreport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#cylinderInspection" aria-expanded="false" aria-controls="cylinderInspection">
                                        Cylinder Block Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="cylinderInspection" class="collapse" aria-labelledby="cylinderinspectionreport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <h4 class="border-bottom">Front Position</h4>
                                    <div class="table-resaponsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                <div class="col-2">
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="clyes" type="radio">
                                                        <label class="custom-control-label" for="clyes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="clno" type="radio">
                                                        <label class="custom-control-label" for="clno">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                <div class="col-2">
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="ryes" type="radio">
                                                        <label class="custom-control-label" for="clyes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="rno" type="radio">
                                                        <label class="custom-control-label" for="clno">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group mb-0">

                                                        <textarea placeholder="Remarks" class="form-control" rows="1" id="Remarks"></textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </li>
                                    </ul>

                                    <!-- scnd table start -->
                                    <h4 class="border-bottom">Rear Position</h4>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="table-dark">
                                            <tr>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>


                                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                                        <li class="list-group-item px-0">

                                            <div class="row align-items-center">
                                                <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                <div class="col-2">
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="cl2yes" type="radio">
                                                        <label class="custom-control-label" for="cl2yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="cl2no" type="radio">
                                                        <label class="custom-control-label" for="cl2no">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                <div class="col-2">
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="ryes" type="radio">
                                                        <label class="custom-control-label" for="clyes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="rno" type="radio">
                                                        <label class="custom-control-label" for="clno">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group mb-0">

                                                        <textarea placeholder="Remarks" class="form-control" rows="1" id="Remarks"></textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!-- 2.	Crankshaft Inspection  -->
                        <div class="card">
                            <div class="card-header" id="crankShaftReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#crankShaftInspection" aria-expanded="false" aria-controls="crankShaftInspection">
                                        Crankshaft Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="crankShaftInspection" class="collapse" aria-labelledby="crankShaftReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <h4 class="border-bottom">Main Journal</h4>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>Position</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Front</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Center</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rare</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fillet</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bend</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <h4 class="border-bottom">Con Journal</h4>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>Position</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Front</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Center</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rare</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fillet</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bend</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-8"><h4 class="mb-0">Crack test report</h4></div>

                                                <div class="col-4">
                                                    <div class="form-group mb-0">
                                                        <textarea placeholder="Remarks" class="form-control" rows="1" id="Test report"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>


                        <!-- 3.	Camshaft Inspection  -->
                        <div class="card">
                            <div class="card-header" id="camShaftReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#caShaftInspection" aria-expanded="false" aria-controls="caShaftInspection">
                                        Camshaft Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="caShaftInspection" class="collapse" aria-labelledby="camShaftReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <h4 class="border-bottom">CAMSHAFT MEASUREMENT TABLE</h4>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>Parameter</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Camshaft Journal</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Intake Lobe Lift</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Exhaust Lobe Lift</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Any Visual Damage</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!-- 4.	Connecting Rod Inspection  -->
                        <div class="card">
                            <div class="card-header" id="connectionRodReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#connectionRodInspection" aria-expanded="false" aria-controls="connectionRodInspection">
                                        Connecting Rod Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="connectionRodInspection" class="collapse" aria-labelledby="connectionRodReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Parameter</th>
                                                <th>Specification</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Centre to Centre Distance</td>
                                                <td>219.05-219.10 mm (8.624-8.626 inch)</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Big End Bore Condition</td>
                                                <td>Visual Inspection</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Small end Bush Condition</td>
                                                <td>Visual Inspection</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Any Visual Damage</td>
                                                <td>Visual Inspection</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!-- 5.	Cylinder Head & Oil Cooler Inspection  -->
                        <div class="card">
                            <div class="card-header" id="cylinderHeadReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#cylinderHead" aria-expanded="false" aria-controls="cylinderHead">
                                        Cylinder Head & Oil Cooler Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="cylinderHead" class="collapse" aria-labelledby="cylinderHeadReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Parameter</th>
                                                <th>Result</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>D.P Test Result</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pressure Test Result</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Surface Condition</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Oil Passage</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Coolant Passage</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Oil Cooler Core</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!-- 6.	Other Component Inspection  -->
                        <div class="card">
                            <div class="card-header" id="OtherInspectionReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#OtherInspection" aria-expanded="false" aria-controls="OtherInspection">
                                        Other Component Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="OtherInspection" class="collapse" aria-labelledby="OtherInspectionReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>Description</th>
                                                <th>Part no.</th>
                                                <th>QTY</th>
                                                <th>Condition</th>
                                                <th>Reused</th>
                                                <th>Rejected</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr><td class="tbl-title" colspan="6">Basic engine</td></tr>

                                            <tr>
                                                <td>Camshaft gear</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Camshaft lock</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status2" class="custom-control-input" id="reusedy2" type="radio">
                                                        <label class="custom-control-label" for="reusedy2">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status2" class="custom-control-input" id="rejected2" type="radio">
                                                        <label class="custom-control-label" for="rejected2">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Cylinder Block Plug</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status3" class="custom-control-input" id="reusedy3" type="radio">
                                                        <label class="custom-control-label" for="reusedy3">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status3" class="custom-control-input" id="rejected3" type="radio">
                                                        <label class="custom-control-label" for="rejected3">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Tappet Cover</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status4" class="custom-control-input" id="reusedy4" type="radio">
                                                        <label class="custom-control-label" for="reusedy4">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status4" class="custom-control-input" id="rejected4" type="radio">
                                                        <label class="custom-control-label" for="rejected4">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Crankshaft Gear</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Main Bearing Cap</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Main Bearing Cap Bolt</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Guide</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Insert-Intake</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Insert-Exhaust</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Intake Valve</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Exhaust Valve</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Rotocoil</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Spring</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Lock</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Head Mounting Bolt</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Crankshaft Pulley</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Seal Carrier</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Flywheel</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Flywheel Housing</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Lifting Bracket (LH)</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Lifting Bracket (RH)</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Front Idle Gear </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Idler Shaft </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>FIP Drive Gear</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Front Housing</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Front Cover</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Pan</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Plug Pipe</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Drain Valve</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Connecting Rod</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Piston Body</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Piston Pin</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Connecting Rod Bolt</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Rocker Arm-Inlet </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Rocker Arm-Exhaust</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Rocker Shaft</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Bridge</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Push Rod</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Lifter</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Exhaust Manifold</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Air Intake Manifold</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Air Intake Manifold</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr><td class="tbl-title" colspan="6">Lubrication system</td></tr>

                                            <tr>
                                                <td>Oil Pump</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Filling Cap</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Filling Tube</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Filling Tube Bracket</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Filter Base</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Guide as Oil Level</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Gauge oil Level</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Strainer</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr><td class="tbl-title" colspan="6">Cooling system</td></tr>

                                            <tr>
                                                <td>Water pump</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Water Lines Elbow</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Cooler Bracket</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Thermostat Housing</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Cooler line</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Cooler line</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr><td class="tbl-title" colspan="6">Fuel system</td></tr>

                                            <tr>
                                                <td>Fuel Injection Pump</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Injector</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Injector Clamp</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Fuel Filter Base</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Fuel Priming Pump</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Fuel Lines</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr><td class="tbl-title" colspan="6">Any additional note</td></tr>

                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!--new parts-->
        <div class="card">
            <div class="card-header" id="partsinceptionreport">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#partsinception" aria-expanded="false" aria-controls="partsinception">
                        Parts Inspection Report (S440 Engine)
                    </button>
                </h2>
            </div>
            <div id="partsinception" class="collapse" aria-labelledby="partsinceptionreport" data-parent="#checkSheet">
                <div class="card-body">

                    <!-- 1.	Cylinder Block Inspection  -->
                    <div id="cylinder-collape">
                        <div class="card">
                            <div class="card-header" id="cylinderinspectionreport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#cylinderInspection" aria-expanded="false" aria-controls="cylinderInspection">
                                        Cylinder Block Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="cylinderInspection" class="collapse" aria-labelledby="cylinderinspectionreport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <h4 class="border-bottom">Front Position</h4>
                                    <div class="table-resaponsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">

                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                <div class="col-2">
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="clyes" type="radio">
                                                        <label class="custom-control-label" for="clyes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="clno" type="radio">
                                                        <label class="custom-control-label" for="clno">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                <div class="col-2">
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="ryes" type="radio">
                                                        <label class="custom-control-label" for="clyes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="rno" type="radio">
                                                        <label class="custom-control-label" for="clno">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group mb-0">

                                                        <textarea placeholder="Remarks" class="form-control" rows="1" id="Remarks"></textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </li>
                                    </ul>

                                    <!-- scnd table start -->
                                    <h4 class="border-bottom">Rear Position</h4>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="table-dark">
                                            <tr>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="BB" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <input type="text" placeholder="CC" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">

                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>


                                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                                        <li class="list-group-item px-0">

                                            <div class="row align-items-center">
                                                <div class="col-3"><h4 class="mb-0">Center line of the bore checked</h4></div>
                                                <div class="col-2">
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="cl2yes" type="radio">
                                                        <label class="custom-control-label" for="cl2yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="cl2no" type="radio">
                                                        <label class="custom-control-label" for="cl2no">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-1"><h4 class="mb-0">Results</h4></div>
                                                <div class="col-2">
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="ryes" type="radio">
                                                        <label class="custom-control-label" for="clyes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="hardchoice1" class="custom-control-input" id="rno" type="radio">
                                                        <label class="custom-control-label" for="clno">No</label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group mb-0">

                                                        <textarea placeholder="Remarks" class="form-control" rows="1" id="Remarks"></textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!-- 2.	Crankshaft Inspection  -->
                        <div class="card">
                            <div class="card-header" id="crankShaftReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#crankShaftInspection" aria-expanded="false" aria-controls="crankShaftInspection">
                                        Crankshaft Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="crankShaftInspection" class="collapse" aria-labelledby="crankShaftReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <h4 class="border-bottom">Main Journal</h4>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>Position</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Front</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Center</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rare</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fillet</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bend</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <h4 class="border-bottom">Con Journal</h4>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>Position</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Front</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Center</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rare</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fillet</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bend</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="AA" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <ul class="list-group list-group-flush list mb-3 hard-to-choose">
                                        <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-8"><h4 class="mb-0">Crack test report</h4></div>

                                                <div class="col-4">
                                                    <div class="form-group mb-0">
                                                        <textarea placeholder="Remarks" class="form-control" rows="1" id="Test report"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>


                        <!-- 3.	Camshaft Inspection  -->
                        <div class="card">
                            <div class="card-header" id="camShaftReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#caShaftInspection" aria-expanded="false" aria-controls="caShaftInspection">
                                        Camshaft Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="caShaftInspection" class="collapse" aria-labelledby="camShaftReport" data-parent="#cylinder-collape">
                                <div class="card-body">
                                    <h4 class="border-bottom">CAMSHAFT MEASUREMENT TABLE</h4>
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>Parameter</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Camshaft Journal</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Intake Lobe Lift</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Exhaust Lobe Lift</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Any Visual Damage</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!-- 4.	Connecting Rod Inspection  -->
                        <div class="card">
                            <div class="card-header" id="connectionRodReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#connectionRodInspection" aria-expanded="false" aria-controls="connectionRodInspection">
                                        Connecting Rod Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="connectionRodInspection" class="collapse" aria-labelledby="connectionRodReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Parameter</th>
                                                <th>Specification</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Centre to Centre Distance</td>
                                                <td>219.05-219.10 mm (8.624-8.626 inch)</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Big End Bore Condition</td>
                                                <td>Visual Inspection</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Small end Bush Condition</td>
                                                <td>Visual Inspection</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Any Visual Damage</td>
                                                <td>Visual Inspection</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!-- 5.	Cylinder Head  -->
                        <div class="card">
                            <div class="card-header" id="cylinderHeadReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#cylinderHead" aria-expanded="false" aria-controls="cylinderHead">
                                        Cylinder Head
                                    </button>
                                </h2>
                            </div>
                            <div id="cylinderHead" class="collapse" aria-labelledby="cylinderHeadReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Parameter</th>
                                                <th>Result</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>D.P Test Result</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pressure Test Result</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Surface Condition</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Fire Ring</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Oil Passage</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Coolant Passage</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Oil Cooler Core</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Head Mounting Bolt</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Head Mounting Bolt</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cylinder head height before decking </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cylinder head height after decking </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Surface flatness before decking </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Surface flatness after decking</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Thread of all fasteners in head</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cylinder head plugs condition</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cylinder Head Stud</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve Guide Intake</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve Guide Exhaust</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve Guide Exhaust</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve insert Intake</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve insert Exhaust</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve Intake</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve Exhaust</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Retainer / Rotocoil</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Base Plate </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve Spring Intake </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve Spring Exhaust </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve lock  </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Injector sleeve  </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Valve lock  </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>All Plugs & Dowels </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                            </tr>




                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>


                        <!--6.Cooler inspection -->
                        <div class="card">
                            <div class="card-header" id="CoolerHeadReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#coolerHead" aria-expanded="false" aria-controls="coolerHead">
                                        Cooler Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="coolerHead" class="collapse" aria-labelledby="CoolerHeadReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Component</th>
                                                <th>Pressure Test Result</th>
                                                <th>Any External Damage</th>
                                                <th>Seal Area</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>After Cooler</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Oil Cooler</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Hydraulic Cooler</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Transmission Cooler</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!--7.Water Pump -->

                        <div class="card">
                            <div class="card-header" id="WaterReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#waterHead" aria-expanded="false" aria-controls="waterHead">
                                        Water Pump Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="waterHead" class="collapse" aria-labelledby="WaterReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Component</th>
                                                <th>Condition</th>
                                                <th>Reused</th>
                                                <th>Reject</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Housing</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Impeller</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Shaft Assembly</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Pump Cover</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Water Pump Gear</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Bearing</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!--8.Oil Pump -->
                        <div class="card">
                            <div class="card-header" id="OilReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#oilHead" aria-expanded="false" aria-controls="oilHead">
                                        Oil Pump Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="oilHead" class="collapse" aria-labelledby="WaterReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Component</th>
                                                <th>Condition</th>
                                                <th>Reused</th>
                                                <th>Reject</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Housing</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Outer Rotor</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Inner Rotor</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Idler Shaft </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Cover</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Pump Drive Gear</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Idler Gear</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Relief Valve</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Pump Outlet Elbow</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Plunger</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Spring</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!--9.Fan Drive -->
                        <div class="card">
                            <div class="card-header" id="FanReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#FanHead" aria-expanded="false" aria-controls="FanHead">
                                        Fan Drive & Belt Tensioner Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="FanHead" class="collapse" aria-labelledby="FanReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Component</th>
                                                <th>Condition</th>
                                                <th>Reused</th>
                                                <th>Reject</th>
                                                <th>Remarks</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Fan Drive Bracket</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Fan Drive Shaft</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Fan Drive Pulley</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Fan Adapter</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Fan Hub</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="Remarks" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Adapter Bracket</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Adjustment Bracket</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Belt Tightener Cover</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Bracket Pulley</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Cover Tightener</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Pulley Tightener</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Tube</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Pin Cotter</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Fitter Grease</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Plate Retainer</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <textarea class="form-control" placeholder="" rows="1" id="comment"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>

                        <!-- 6.	Other Component Inspection  -->
                        <div class="card">
                            <div class="card-header" id="OtherInspectionReport">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#OtherInspection" aria-expanded="false" aria-controls="OtherInspection">
                                        Other Component Inspection
                                    </button>
                                </h2>
                            </div>
                            <div id="OtherInspection" class="collapse" aria-labelledby="OtherInspectionReport" data-parent="#cylinder-collape">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush">

                                            <thead class="thead-light">
                                            <tr>
                                                <th>Description</th>
                                                <th>Part no.</th>
                                                <th>QTY</th>
                                                <th>Condition</th>
                                                <th>Reused</th>
                                                <th>Rejected</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr><td class="tbl-title" colspan="6">Basic engine</td></tr>

                                            <tr>
                                                <td>Camshaft gear</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="reusedy1" type="radio">
                                                        <label class="custom-control-label" for="reusedy1">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status1" class="custom-control-input" id="rejected1" type="radio">
                                                        <label class="custom-control-label" for="rejected1">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Camshaft lock</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status2" class="custom-control-input" id="reusedy2" type="radio">
                                                        <label class="custom-control-label" for="reusedy2">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status2" class="custom-control-input" id="rejected2" type="radio">
                                                        <label class="custom-control-label" for="rejected2">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Cylinder Block Plug</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status3" class="custom-control-input" id="reusedy3" type="radio">
                                                        <label class="custom-control-label" for="reusedy3">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status3" class="custom-control-input" id="rejected3" type="radio">
                                                        <label class="custom-control-label" for="rejected3">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Tappet Cover</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status4" class="custom-control-input" id="reusedy4" type="radio">
                                                        <label class="custom-control-label" for="reusedy4">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status4" class="custom-control-input" id="rejected4" type="radio">
                                                        <label class="custom-control-label" for="rejected4">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Crankshaft Gear</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Main Bearing Cap</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Main Bearing Cap Bolt</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Guide</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Insert-Intake</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Insert-Exhaust</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Intake Valve</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Exhaust Valve</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Rotocoil</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Spring</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Lock</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Head Mounting Bolt</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Crankshaft Pulley</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Seal Carrier</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Flywheel</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Flywheel Housing</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Lifting Bracket (LH)</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Lifting Bracket (RH)</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Front Idle Gear </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Idler Shaft </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>FIP Drive Gear</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Front Housing</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Front Cover</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Pan</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Plug Pipe</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Drain Valve</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Connecting Rod</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Piston Body</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Piston Pin</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Connecting Rod Bolt</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Rocker Arm-Inlet </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Rocker Arm-Exhaust</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Rocker Shaft</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Valve Bridge</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Push Rod</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Lifter</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Exhaust Manifold</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Air Intake Manifold</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Air Intake Manifold</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr><td class="tbl-title" colspan="6">Lubrication system</td></tr>

                                            <tr>
                                                <td>Oil Pump</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Filling Cap</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Filling Tube</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Filling Tube Bracket</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Filter Base</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Guide as Oil Level</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Gauge oil Level</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Strainer</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr><td class="tbl-title" colspan="6">Cooling system</td></tr>

                                            <tr>
                                                <td>Water pump</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Water Lines Elbow</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Cooler Bracket</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Thermostat Housing</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Cooler line</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Oil Cooler line</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr><td class="tbl-title" colspan="6">Fuel system</td></tr>

                                            <tr>
                                                <td>Fuel Injection Pump</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Injector</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Injector Clamp</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Fuel Filter Base</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Fuel Priming Pump</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Fuel Lines</td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr><td class="tbl-title" colspan="6">Any additional note</td></tr>

                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group mb-0">
                                                        <input type="text" placeholder="" class="form-control" id="usr">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="reusedy5" type="radio">
                                                        <label class="custom-control-label" for="reusedy5">Reused</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-control custom-radio">
                                                        <input name="status5" class="custom-control-input" id="rejected5" type="radio">
                                                        <label class="custom-control-label" for="rejected5">Rejected</label>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>


                                    <button class="btn btn-primary" type="submit">Save info</button>
                                    <button class="btn btn-warning" type="reset">Reset form</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- LIST OF SALVAGE COMPONENT -->
        <div class="card">
            <div class="card-header" id="salvageCompList">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#salvageComponents" aria-expanded="false" aria-controls="salvageComponents">
                        List of Salvage components
                    </button>
                </h2>
            </div>
            <div id="salvageComponents" class="collapse" aria-labelledby="salvageCompList" data-parent="#checkSheet">
                <div class="card-body">

                    <form action="">
                        <!-- dynamic repeater wrapper -->
                        <div class="salvage-part-repeat">
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="Component name">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <textarea type="text" name="field_name[]" class="form-control" placeholder="Description of rework" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="QTY">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="datepicker form-control" placeholder="Out date">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="datepicker form-control" placeholder="In date">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="Vendor name">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" name="field_name[]" class="form-control" placeholder="Inspected by">
                                    </div>
                                </div>


                                <div class="col-auto">
                                    <a href="javascript:void(0);" class="btn btn-default add_button">+</a>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Save info</button>
                        <button class="btn btn-warning" type="reset">Reset form</button>
                    </form>
                    <!-- pre-history form end -->

                </div>
            </div>
        </div>

        <!-- S440 Engine Assembly Check sheet  -->
        <div class="card">
            <div class="card-header" id="engineassemblychecksheet">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                            data-target="#engineassembly" aria-expanded="false" aria-controls="engineassembly">
                        S440 Engine Assembly Check sheet
                    </button>
                </h2>
            </div>
            <div id="engineassembly" class="collapse" aria-labelledby="engineassemblychecksheet"
                 data-parent="#checkSheet">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table ">
                            <!-- <h4 class="border-bottom">Front Possition</h4> -->
                            <thead>
                            <tr>
                                <th>Operation Description</th>
                                <th>Specification</th>
                                <th>Actual value</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Torque for main bearing cap bolt
                                </td>
                                <td>
                                    185 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Clearance Main bearing & Main bearing journal
                                </td>
                                <td>
                                    0.057 to 0.117 mm (0.0022 to 0.0046 inch)
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Clearance Main bearing & Main bearing journal
                                </td>
                                <td>
                                    0.057 to 0.117 mm (0.0022 to 0.0046 inch)
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Crankshaft end play
                                </td>
                                <td>
                                    0.05 to 0.38 mm (0.020 to 0.0115 inch)
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    TIR / Run Out
                                </td>
                                <td>
                                    Maximum 0.005 inch
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Clearance between ends of piston ring when
                                    installed in a cylinder liner:
                                    <ul style="padding-left:16px;">
                                        <li>a. Top compression ring</li>
                                        <li>b. Intermediate ring</li>
                                        <li>c. Oil control ring</li>
                                    </ul>
                                </td>
                                <td>
                                    <ul style="margin-top: 16px;">
                                        <li> 0.40-0.85 mm ( 0.016-0.033 inch) </li>
                                        <li> 0.30-0.76 mm (0.012-0.030 inch)</li>
                                        <li> 0.38-0.84 mm (0.015- 0.033 inch)</li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for Connecting Rod Nut

                                </td>
                                <td>
                                    92 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for the mounting bolt of front housing

                                </td>
                                <td>
                                    M8:-16 lb ft; M10:-33 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for hub of idle gear retaining plate bolt

                                </td>
                                <td>
                                    33 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for the mounting bolt of camshaft gear

                                </td>
                                <td>
                                    58 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for Crankshaft Rear Seal mounting bolt

                                </td>
                                <td>
                                    16 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for front Cover Nut

                                </td>
                                <td>
                                    16 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for Flywheel Housing Bolt

                                </td>
                                <td>
                                    M12-55 lb ft; M10-46 lb ft; M12-85 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for bolts of Flywheel

                                </td>
                                <td>
                                    77 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for bolts of crankshaft pulley

                                </td>
                                <td>
                                    85 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Height to the top of the valve guides after installation

                                </td>
                                <td>
                                    15.10 mm (0.594 inch)
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <ul>
                                        <li>Torque for Cylinder Head Bolt</li>
                                        <li>Degree for short setscrews of cylinder head</li>
                                        <li>Degree for medium setscrews of cylinder head</li>
                                        <li>Degree for long setscrews of cylinder head</li>
                                    </ul>

                                </td>
                                <td>
                                    <ul>
                                        <li>80 lb ft</li>
                                        <li>150 degree</li>
                                        <li>180 degree</li>
                                        <li>210 degree</li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for Rocker Shaft mounting Bolt

                                </td>
                                <td>
                                    55 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for fuel injection nozzle mounting clamp

                                </td>
                                <td>
                                    9 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <ul style="    padding: 14px">
                                        <li>Valve Lash for Inlet valves</li>
                                        <li>Valve Lash for Exhaust valves</li>
                                    </ul>

                                    Valve Lash Setting Sequence:-<br>


                                    i)Set the no 1 piston to the top center position <br> on
                                    the compression stroke & adjust the valve lash for
                                    inlet & exhaust<br> valve of No 1 cylinder<br>


                                    ii)Turn the crankshaft for 180 degree in the direction
                                    of the normal<br> engine rotation & adjust the valve
                                    lash for inlet & exhaust <br>Valve of No 3 Cylinder<br>


                                    iii) Turn the crankshaft for 180 degree in the
                                    direction <br> of the normal engine rotation & adjust the<br>
                                    valve lash for inlet & exhaust Valve of<br> No 4 Cylinder<br>


                                    iv) Turn the crankshaft for 180 degree in the<br> direction of the normal engine rotation &
                                    adjust the valve lash<br> for inlet & exhaust Valve of No 2 Cylinder<br>


                                </td>
                                <td>
                                    <ul>
                                        <li>0.20 mm</li>
                                        <li>0.45 mm</li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for mounting nuts of Valve mechanism
                                    Cover

                                </td>
                                <td>
                                    22 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for the Exhaust Manifold Nuts

                                </td>
                                <td>
                                    33 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for water pump mounting setscrews

                                </td>
                                <td>
                                    16 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for oil filter base mounting bolt

                                </td>
                                <td>
                                    16 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for oil pump mounting bolt

                                </td>
                                <td>
                                    16 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for oil Strainer Assy mounting bolt

                                </td>
                                <td>
                                    16 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for fuel filter base mounting bolt

                                </td>
                                <td>
                                    16 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for oil sump mounting bolt

                                </td>
                                <td>
                                    16 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Torque for drain plugs of Oil Sump

                                </td>
                                <td>
                                    25 ± 4 lb ft
                                </td>
                                <td>
                                    <div class="form-group mb-0">

                                        <input type="text" placeholder="" class="form-control" id="usr">
                                    </div>
                                </td>

                            </tr>



                            </tbody>
                        </table>
                    </div>


                    <button class="btn btn-primary" type="submit">Save info</button>
                    <button class="btn btn-warning" type="reset">Reset form</button>
                </div>
            </div>
        </div>

    </div>



@endsection

@section('after_script')

    <!-- Loose parts report add remove form dynamic -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 6; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.loose-part-repeat'); //Input field wrapper
            var fieldHTML = '<div class="row"><div class="col"><div class="form-group"><textarea type="text" name="field_name[]" class="form-control" placeholder="Part description" rows="1"></textarea></div></div><div class="col-md-1"><div class="form-group"> <input type="text" name="field_name[]" class="form-control" placeholder="QTY"></div></div><div class="col"><div class="form-group"><textarea type="text" name="field_name[]" class="form-control" placeholder="Part condition" rows="1"></textarea></div></div><div class="col"><div class="form-group"><div class="custom-file"> <input name="field_name[]" type="file" class="custom-file-input" id="customFileLang" lang="en"> <label class="custom-file-label" for="customFileLang">Photograph taken</label></div></div></div><div class="col-auto"> <a href="javascript:void(0);" class="btn btn-danger remove_button">-</a></div></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent().parent().remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

@endsection

