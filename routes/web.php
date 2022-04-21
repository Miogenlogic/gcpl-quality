<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix' => 'admin'], function(){
    Route::group(['namespace' => 'Admin','middleware' => 'auth'], function(){
        //-->All Form Element
        Route::get('/form-elements-form', ['uses' => 'ServiceController@formElementsForm']);



        Route::get('/test2', ['uses' => 'UserController@test2']);
        Route::get('/test3', ['uses' => 'ServiceController@test3']);
        //dashboard
        Route::get('/branch-dashboard', ['uses' => 'DashboardController@branchDashboard']);
        Route::get('/super-admin-dashboard', ['uses' => 'DashboardController@superAdminDashboard']);
        Route::get('/crc-head-dashboard', ['uses' => 'DashboardController@crcHeadDashboard']);
        Route::get('/spc-dashboard', ['uses' => 'DashboardController@spcDashboard']);
        Route::get('/section-supervisor-dashboard', ['uses' => 'DashboardController@sectionSupervisorDashboard']);
        Route::get('/section-engineer-dashboard', ['uses' => 'DashboardController@sectionEngineerDashboard']);
        // Route::get('/qaqc-dashboard', ['uses' => 'DashboardController@qaqcDashboard']);
        Route::get('/planning-supervisor-dashboard', ['uses' => 'DashboardController@planningSupervisorDashboard']);
        Route::get('/store-manager-dashboard', ['uses' => 'DashboardController@storeManagerDashboard']);
        Route::get('/despatch-manager-dashboard', ['uses' => 'DashboardController@despatchManagerDashboard']);
        Route::get('/dispatch-dashboard', ['uses' => 'DashboardController@despatchDashboard']);




        Route::get('/receiving-dashboard', ['uses' => 'DashboardController@receivingDashboard']);
        Route::get('/service-engineer-dashboard', ['uses' => 'DashboardController@serviceEngineerDashboard']);
        Route::get('/engine-dashboard', ['uses' => 'DashboardController@engineDashboard']);
        Route::get('/trans-dashboard', ['uses' => 'DashboardController@transDashboard']);
        Route::get('/hyd-dashboard', ['uses' => 'DashboardController@hydDashboard']);
        Route::get('/mor-dashboard', ['uses' => 'DashboardController@morDashboard']);
        Route::get('/undercarg-dashboard', ['uses' => 'DashboardController@undercargDashboard']);
        Route::get('/support-dashboard', ['uses' => 'DashboardController@supportDashboard']);
        Route::get('/eng-head-dashboard', ['uses' => 'DashboardController@engHeadDashboard']);
        
        Route::get('/qaqc-dashboard', ['uses' => 'DashboardController@qaqcDashboard']);
        Route::get('/departmental-dashboard', ['uses' => 'DashboardController@departmentalDashboard']);
        

        //support
        Route::get('/support-quotation-list', ['uses' => 'ServiceController@supportQuotationList']);


        Route::get('/support-quotation-get-table', ['uses' => 'ServiceController@supportQuotationgetTable']);

        Route::post('/support-quotation-get-table-download', ['uses' => 'ServiceController@supportQuotationgetTableDownload']);
        Route::get('/quotation-show-support/{id}', ['uses' => 'ServiceController@quotationShowSupport']);

        Route::get('/support-quotation-add/{id}', ['uses' => 'ServiceController@supportQuotationAdd']);
        Route::post('/support-quotation-add-save', ['uses' => 'ServiceController@supportQuotationAddSave']);


        //engine List blade
        Route::get('/engine-diss-list', ['uses' => 'CheckSheetController@engineDissList']);

        Route::post('/engine-diss-list-download', ['uses' => 'CheckSheetController@engineDissListDownload']);




        Route::get('/engine-diss-list-get-table', ['uses' => 'CheckSheetController@engineDissgetTable']);
        Route::get('/engine-ass-list', ['uses' => 'CheckSheetController@engineAssList']);
        Route::get('/engine-ass-list-get-table', ['uses' => 'CheckSheetController@engineAssgetTable']);

        Route::post('/engine-ass-list-download', ['uses' => 'CheckSheetController@engineAssgetTableDownload']);

        //trans List Blade
        Route::get('/trans-diss-list', ['uses' => 'CheckSheetController@transDissList']);
        Route::get('/trans-diss-list-get-table', ['uses' => 'CheckSheetController@transDissgetTable']);

         Route::post('/trans-diss-list-get-table-download', ['uses' => 'CheckSheetController@transDissgetTableDownload']);

        Route::get('/trans-ass-list', ['uses' => 'CheckSheetController@transAssList']);
        Route::get('/trans-ass-list-get-table', ['uses' => 'CheckSheetController@transAssgetTable']);
        Route::post('/trans-ass-list-get-table-download', ['uses' => 'CheckSheetController@transAssgetTableDownload']);


        //hyd List blade
        Route::get('/hyd-diss-list', ['uses' => 'CheckSheetController@hydDissList']);
        Route::get('/hyd-diss-list-get-table', ['uses' => 'CheckSheetController@hydDissgetTable']);
        Route::post('/hyd-diss-list-get-table-download', ['uses' => 'CheckSheetController@hydDissgetTableDownload']);
        Route::get('/hyd-ass-list', ['uses' => 'CheckSheetController@hydAssList']);
        Route::get('/hyd-ass-list-get-table', ['uses' => 'CheckSheetController@hydAssgetTable']);
        Route::post('/hyd-ass-list-get-table-download', ['uses' => 'CheckSheetController@hydAssgetTableDownload']);


        //mor List blade
        Route::get('/mor-diss-list', ['uses' => 'CheckSheetController@morDissList']);
        Route::get('/mor-diss-list-get-table', ['uses' => 'CheckSheetController@morDissgetTable']);
        Route::post('/mor-diss-list-get-table-download', ['uses' => 'CheckSheetController@morDissgetTableDownload']);

        Route::get('/mor-ass-list', ['uses' => 'CheckSheetController@morAssList']);
        Route::get('/mor-ass-list-get-table', ['uses' => 'CheckSheetController@morAssgetTable']);
        Route::post('/mor-ass-list-get-table-download', ['uses' => 'CheckSheetController@morAssgetTableDownload']);

        //undercarraige List blade
        Route::get('/undercarg-diss-list', ['uses' => 'CheckSheetController@undercargDissList']);
        Route::get('/undercarg-diss-list-get-table', ['uses' => 'CheckSheetController@undercargDissgetTable']);

       Route::post('/undercarg-diss-list-get-table-download', ['uses' => 'CheckSheetController@undercargDissgetTableDownload']);

        Route::get('/undercarg-ass-list', ['uses' => 'CheckSheetController@undercargAssList']);
        Route::get('/undercarg-ass-list-get-table', ['uses' => 'CheckSheetController@undercargAssgetTable']);
        Route::post('/undercarg-ass-list-get-table-download', ['uses' => 'CheckSheetController@undercargAssgetTableDownload']);


        //store
        Route::get('/store-list', ['uses' => 'CheckSheetController@storeList']);
        Route::get('/store-list-get-table', ['uses' => 'CheckSheetController@storegetTable']);
        Route::post('/store-list-get-table-download', ['uses' => 'CheckSheetController@storegetTableDownload']);

        Route::get('/store-assign/{id}', ['uses' =>'CheckSheetController@storeAssign']);
        Route::post('/store-status-save', ['uses' =>'CheckSheetController@storeStatusSave']);


        //checksheet assembly
        Route::get('/check-sheet-assembly-common/{id}', ['uses' => 'CheckSheetController@checkSheetAssemblyCommon']);

        //checksheet disassembly
        Route::get('/check-sheet-entry-common/{id}', ['uses' => 'CheckSheetController@checkSheetAssemblyCommon']);

        Route::get('/check-sheet-entry-usedpart/{id}', ['uses' => 'CheckSheetController@checkSheetAssemblyUsedpart']);


        Route::post('/check-gate-aggregate-save', ['uses' => 'CheckSheetController@checkGateAggregateSave']);
        Route::post('/check-gate-prehis-dis-save', ['uses' => 'CheckSheetController@checkGatePreHisDisSave']);
        Route::post('/check-gate-looseparts-dis-save', ['uses' => 'CheckSheetController@checkGateLoosepartsDisSave']);
        Route::post('/check-gate-onefollowed-up-dis-save', ['uses' => 'CheckSheetController@checkGateOnefollowedUpDisSave']);

        Route::post('/check-gate-commerciallogistic-dis-save', ['uses' => 'CheckSheetController@checkGateCommerciallogisticDisSave']);
        Route::post('/check-gate-ccexternalwash-dis-save', ['uses' => 'CheckSheetController@checkGateCcexternalwashDisSave']);
        Route::post('/check-gate-ccpartclean-dis-save', ['uses' => 'CheckSheetController@checkGateCcpartcleanDisSave']);
        Route::post('/check-gate-missingdamagepart-dis-save', ['uses' => 'CheckSheetController@checkGateMissingdamagepartDisSave']);
        Route::post('/check-gate-listofsalvage-dis-save', ['uses' => 'CheckSheetController@checkGateListofsalvageDisSave']);
        Route::post('/check-gate-listofobservation-save', ['uses' => 'CheckSheetController@checkGateListofobservationSave']);

        Route::post('/check-gate-listofinspection-save', ['uses' => 'CheckSheetController@checkGateListofinspectionSave']);

        Route::post('/check-gate-partinspection-cylinderblock-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCylinderblockDisSave']);
        Route::post('/check-gate-partinspection-cylinderblock-linear-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCylinderblockLinearSave']);
        Route::post('/check-gate-partinspection-cylinderblock-cambore-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCylinderblockCamboreSave']);
        Route::post('/check-gate-partinspection-cylinderblock-topdeck-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCylinderblockTopdeckSave']);
        Route::post('/check-gate-partinspection-cylinderblock-thread-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCylinderblockThreadSave']);
        Route::post('/check-gate-partinspection-cylinderblock-bushbore-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCylinderblockBushboreSave']);
        Route::post('/check-gate-partinspection-cylinderblock-capno-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCylinderblockCapnoSave']);


        Route::post('/check-gate-partinspection-crankshaft-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCrankshaftDisSave']);
        Route::post('/check-gate-partinspection-camshaft-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCamshaftDisSave']);
        Route::post('/check-gate-partinspection-lh-camshaft-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionLhCamshaftDisSave']);
        Route::post('/check-gate-partinspection-rh-camshaft-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionRhCamshaftDisSave']);
        Route::post('/check-gate-partinspection-camshaft-bushbore-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionRhCamshaftBushboreDisSave']);


        Route::post('/check-gate-partinspection-cylinderhead-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionCylinderheadDisSave']);
        Route::post('/check-gate-partinspection-connectingrod-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionConnectingrodDisSave']);
        Route::post('/check-gate-partinspection-othercomponent-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionOthercomponentDisSave']);
        Route::post('/check-gate-partinspection-fandrive-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionFandriveDisSave']);
        Route::post('/check-gate-partinspection-oilpump-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionOilpumpDisSave']);
        Route::post('/check-gate-partinspection-aircompressor-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionAircompressorDisSave']);
        Route::post('/check-gate-partinspection-waterpump-dis-save', ['uses' => 'CheckSheetController@checkGatePartinspectionwaterpumpDisSave']);
        Route::post('/check-gate-failed-parts-dis-save', ['uses' => 'CheckSheetController@checkGateFailedPartsDisSave']);
        Route::post('/check-gate-conrod-bush-replacement-dis-save', ['uses' => 'CheckSheetController@checkGateConrodBushReplacementDisSave']);
        Route::post('/comp-inspec-report-save', ['uses' =>'CheckSheetController@componentinspectionreport']);
        Route::post('/partinspection-cooler-insp-save', ['uses' =>'CheckSheetController@partinspectionCoolerInspSave']);
        Route::post('/partinspection-clutchpack-thickness-save', ['uses' =>'CheckSheetController@partinspectionClutchpackThicknessSave']);
        Route::post('/partinspection-clutchplate-thickness-save', ['uses' =>'CheckSheetController@partinspectionClutchplateThicknessSave']);
        Route::post('/partinspection-clutchplate-flatness-save', ['uses' =>'CheckSheetController@partinspectionClutchplateFlatnessSave']);
        Route::post('/partinspection-torque-converter-save', ['uses' =>'CheckSheetController@partinspectionTorqueConverterSave']);
        Route::post('/transmission-component-save', ['uses' =>'CheckSheetController@transmissionComponentSave']);
        Route::post('/roller-specification-save', ['uses' =>'CheckSheetController@rollerSpecificationSave']);
        Route::post('/roller-measured-save', ['uses' =>'CheckSheetController@rollerMeasuredSave']);
        Route::post('/roller-spcendcool-save', ['uses' =>'CheckSheetController@rollerSpcendcoolSave']);
        Route::post('/roller-clear-btwshft-save', ['uses' =>'CheckSheetController@rollerClearBtwsftSave']);
        Route::post('/idler-specification-save', ['uses' =>'CheckSheetController@idlerSpecificationSave']);
        Route::post('/idler-measured-before-save', ['uses' =>'CheckSheetController@idlerMeasuredBeforeSave']);
        Route::post('/idler-measured-after-save', ['uses' =>'CheckSheetController@idlerMeasuredAfterSave']);
        Route::post('/idler-spec-endcooler-save', ['uses' =>'CheckSheetController@idlerSpecEndcoolerSave']);
        Route::post('/idler-clear-btwshft-save', ['uses' =>'CheckSheetController@idlerClearBtwsftSave']);
		 Route::post('/check-gate-partstracklink-height-dis-save', ['uses' => 'CheckSheetController@checkGateTrackLinkHeightDisSave']);
    Route::post('/check-gate-partstrack-pitch-dis-save', ['uses' => 'CheckSheetController@checkGateTrackPitchDisSave']);
    Route::post('/check-gate-partstracklink-pin-dis-save', ['uses' => 'CheckSheetController@checkGateTrackLinkPinDisSave']);
    Route::post('/check-gate-partstracklink-bush-dis-save', ['uses' => 'CheckSheetController@checkGateTrackLinkBushDisSave']);
    Route::post('/check-gate-partstrack-shoe-dis-save', ['uses' => 'CheckSheetController@checkGateTrackshoeDisSave']);
    Route::post('/check-gate-partspin-inspmea-dis-save', ['uses' => 'CheckSheetController@checkGatePinInspDisSave']);
    Route::post('/check-gate-partsbush-inspmea-dis-save', ['uses' => 'CheckSheetController@checkGateBushInspDisSave']);

        //engine assembly

        Route::post('/engine-assembly-save', ['uses' =>'CheckSheetController@engineassembly']);

        //dis assy total submit
        Route::post('/check-sheet-total-form-save', ['uses' => 'CheckSheetController@checkSheetTotalFormSave']);
        
        
         //button open for diss assembly
        Route::post('/check-sheet-button-open-form-save', ['uses' => 'CheckSheetController@checkSheetButtonOpenFormSave']);

        //assy total submit
        Route::post('/check-sheet-assy-total-form-save', ['uses' => 'CheckSheetController@checkSheetAssyTotalFormSave']);
        
        //button open for assembly
        Route::post('/checksheet-assy-button-open-form-save', ['uses' => 'CheckSheetController@checkSheetAssyButtonOpenFormSave']);
        
        Route::post('/excel-download', ['uses' => 'CheckSheetController@excelDownload']);
          Route::post('/assy-excel-download', ['uses' => 'CheckSheetController@assyexcelDownload']);
		  Route::post('/bis-excel-download', ['uses' => 'MasterSuperAdminController@bisexcelDownload']);

        //receiving
        Route::get('/receiving-dashboard-list-get-table', ['uses' => 'ServiceController@receivingDashboardListGetTable']);

        Route::post('/receiving-dashboard-list-get-table-download', ['uses' => 'ServiceController@receivingDashboardListGetTableDownload']);

        Route::get('/check-gate-form-one', ['uses' => 'ServiceController@checkGateFormOne']);

//checkgate form one add
        Route::get('/check-gate-form-one-add/{id}', ['uses' => 'ServiceController@checkGateFormOneAdd']);
        Route::post('/check-gate-form-one-add-save', ['uses' => 'ServiceController@checkGateFormOneAddSave']);
        //checkgate form one listing
        Route::get('/check-gate-form-one-listing/{id}', ['uses' =>'ServiceController@checkgatefromOnelisting']);
        Route::post('/check-gate-form-one-edit-save', ['uses' => 'ServiceController@checkGateFormOneEditSave']);
//checkgate form two add
        Route::get('/check-gate-form-two-add/{id}', ['uses' => 'ServiceController@checkGateFormTwoAdd']);
        Route::post('/check-gate-form-two-add-save', ['uses' => 'ServiceController@checkGateFormTwoAddSave']);
        //checkgate form Two listing
        Route::get('/check-gate-form-two-listing/{id}', ['uses' =>'ServiceController@checkgatefromtwolisting']);
        Route::post('/check-gate-form-two-edit-save', ['uses' => 'ServiceController@checkGateFormTwoEditSave']);
//checkgate form three add
        Route::get('/check-gate-form-three-add/{id}', ['uses' => 'ServiceController@checkGateFormThreeAdd']);
        Route::post('/check-gate-form-three-add-save', ['uses' => 'ServiceController@checkGateFormThreeAddSave']);
        //checkgate form three listing
        Route::get('/check-gate-form-three-listing/{id}', ['uses' =>'ServiceController@checkgatefromThreelisting']);
        Route::post('/check-gate-form-three-edit-save', ['uses' => 'ServiceController@checkGateFormThreeEditSave']);

        //check-gate-form-four
        Route::get('/check-gate-form-four-add/{id}', ['uses' => 'ServiceController@checkGateFormFourAdd']);

        Route::post('/check-gate-form-four-add-save', ['uses' => 'ServiceController@checkGateFormFourAddSave']);
        //checkgate form four listing
        Route::get('/check-gate-form-four-listing/{id}', ['uses' =>'ServiceController@checkgatefromfourlisting']);
        Route::post('/check-gate-form-four-edit-save', ['uses' => 'ServiceController@checkGateFormFourEditSave']);

        //pdi checksheet
        Route::get('/pdi-add/{id}', ['uses' => 'ServiceController@pdiAdd']);

        Route::get('/dispatch-pdi-add/{id}', ['uses' => 'ServiceController@dispatchpdiAdd']);

        Route::get('/transmission-pdi-add/{id}', ['uses' => 'ServiceController@transmissionpdiAdd']);

        Route::post('/pdi-add-save', ['uses' => 'ServiceController@pdiAddSave']);

        Route::post('/dispatch-pdi-add-save', ['uses' => 'ServiceController@dispatchpdiAddSave']);

        Route::post('/transmission-pdi-add-save', ['uses' => 'ServiceController@transmissionpdiAddSave']);
         //pdi listing
        
        Route::get('/service-pdilist',['uses' =>'MasterSuperAdminController@servicePdiList']);

        Route::get('/servicedashboard-pdilist',['uses' =>'MasterSuperAdminController@servicedashboardPdiList']);
        Route::get('/fetchpdi-get-table',['uses' => 'MasterSuperAdminController@fetchpdiGatetable']);
        Route::get('/fetchpdi-get-table-dispatch',['uses' => 'MasterSuperAdminController@fetchpdiGatetabledispatch']);
        Route::post('/fetchpdi-get-table-download',['uses' => 'MasterSuperAdminController@fetchpdiGatetableDownload']);



        //checkgate form four listing
        Route::get('/pdi-listing/{id}', ['uses' =>'ServiceController@pdilisting']);
        Route::get('/dispatch-pdi-listing/{id}', ['uses' =>'ServiceController@dispatchpdilisting']);
        Route::get('/transmission-pdi-listing/{id}', ['uses' =>'ServiceController@transmissionpdilisting']);
        Route::post('/pdi-edit-save', ['uses' => 'ServiceController@pdiEditSave']);
        Route::post('/dispatch-pdi-edit-save', ['uses' => 'ServiceController@dispatchpdiEditSave']);
        Route::post('/transmission-pdi-edit-save', ['uses' => 'ServiceController@transmissionpdiEditSave']);

        //Route::get('/check-gate-form-one-list', ['uses' => 'ServiceController@checkGateFormOneList']);
        //Route::get('/check-gate-form-one-list-get-table', ['uses' => 'ServiceController@checkGateFormOneListGetTable']);

        Route::get('/service-request-latest-list', ['uses' => 'ServiceController@serviceRequestLatestList']);
        Route::get('/service-request-latest-list-get-table', ['uses' => 'ServiceController@serviceRequestLatestListGetTable']);

        //check-gate-form-two
        //  Route::get('/receiving-dashboard-list-get-table', ['uses' => 'ServiceController@receivingDashboardListGetTable']);
        // Route::get('/check-gate-form-two', ['uses' => 'ServiceController@checkGateFormTwo'] );

        //super admin
       /* Route::get('/projects-open-list', ['uses' => 'ServiceController@projectsOpenList']);
        Route::get('/projects-completed-list', ['uses' => 'ServiceController@projectsCompletedList']);
        Route::get('/project-details', ['uses' => 'ServiceController@projectDetails']);*/
        //super admin

        Route::get('/projects-open-list', ['uses' => 'ServiceController@projectsOpenList']);
        Route::get('/projects-open-list-table', ['uses' => 'ServiceController@getTableProjectMaster']);

        Route::post('/projects-open-list-table-download', ['uses' => 'ServiceController@getTableProjectMasterDownload']);

         Route::get('/projects-filter-list-table', ['uses' => 'ServiceController@projectMasterFilter']);
        Route::get('/projects-datefilter-list-table', ['uses' => 'ServiceController@projectMasterDateFilter']);
        Route::get('/projects-completed-list', ['uses' => 'ServiceController@projectsCompletedList']);

        Route::get('/project-details/{id}', ['uses' => 'ServiceController@projectDetails']);
        Route::post('/project-note', ['uses' => 'ServiceController@projectNote']);


        // Assign User to Project
        Route::post('/assign-user-project', ['uses' => 'ServiceController@AssignUserProject']);

        // Assign Users to Task
        Route::post('/assign-user-task', ['uses' => 'ServiceController@AssignUserTask']);
        Route::post('/assign-user-project-task', ['uses' => 'ServiceController@AssignUserProjectTask']);
        Route::post('/edit-task', ['uses' => 'ServiceController@editTask']);
        //user
        Route::get('/user-add', ['uses' => 'UserController@userAdd']);
        Route::post('/user-add-store', ['uses' => 'UserController@userAddStore']);
        Route::get('/user-list', ['uses' => 'UserController@userList']);
        Route::get('/user-get-table', ['uses' => 'UserController@getTableUser']);
        Route::get('/user-edit/{id}', ['uses' => 'UserController@userEdit']);
        Route::post('/user-edit-store', ['uses' => 'UserController@userEditStore']);

        Route::get('/receiving-dashboard-list-get-table', ['uses' => 'ServiceController@receivingDashboardListGetTable']);
        Route::get('/check-gate-form-two', ['uses' => 'ServiceController@checkGateFormTwo']);

        //Engine Model
        Route::get('/engine-model-no-list', ['uses' => 'ServiceController@engineModelNoList']);
        Route::get('/engine-model-no-list-get-tablelisting', ['uses' => 'ServiceController@engineModelNoListGetTable']);



        //branch engineer
        Route::get('/branch-dashboard-list-get-table', ['uses' => 'ServiceController@branchDashboardListGetTable']);


        Route::post('/branch-dashboard-list-get-table-download', ['uses' => 'ServiceController@branchDashboardListGetTableDownload']);

        Route::post('/branch-dashboard-list-get-table-branch-download', ['uses' => 'ServiceController@branchDashboardListGetTablebranchDownload']);

        Route::get('/quotation-list', ['uses' => 'ServiceController@quotationList']);
        Route::get('/quotation-list-get-table', ['uses' => 'ServiceController@quotationListGetTable']);
        Route::get('/service-request-list', ['uses' => 'ServiceController@serviceRequestList']);

        Route::get('/service-request-get-table', ['uses' => 'ServiceController@serviceRequestGetTable']);
		 Route::get('/service-requestfilter-get-table', ['uses' => 'ServiceController@serviceRequestFilterGetTable']);
        Route::get('/service-requestdatefilter-get-table', ['uses' => 'ServiceController@serviceRequestDateFilterGetTable']);
        Route::post('/machine-serial-list-show', ['uses' => 'ServiceController@machineSerialListShow']);
        Route::post('/component-model-list-show', ['uses' => 'ServiceController@componentModelListShow']);
        Route::post('/component-serial-list-show', ['uses' => 'ServiceController@componentSerialListShow']);
        Route::get('/quotation-download-show/{id}', ['uses' => 'ServiceController@quotationDownloadShow']);
        Route::post('/quotation-download', ['uses' => 'ServiceController@quotationDownload']);


        //service form
        Route::get('/service-request-add', ['uses' => 'ServiceController@serviceRequestAdd']);
        Route::post('/service-request-add-save', ['uses' => 'ServiceController@serviceRequestAddSave']);
        Route::get('/service-request-edit/{id}', ['uses' => 'ServiceController@serviceRequestEdit']);
        Route::post('/service-request-edit-save', ['uses' => 'ServiceController@serviceRequestEditSave']);
        Route::get('/service-request-delete/{id}', ['uses' => 'ServiceController@serviceRequestDelete']);

        Route::get('/branch-list', ['uses' => 'ServiceController@branchList']);
        Route::get('/branch-get-table', ['uses' => 'ServiceController@branchGetTable']);
        Route::get('/segment-list', ['uses' => 'ServiceController@segmentList']);
        Route::get('/segment-get-table', ['uses' => 'ServiceController@segmentGetTable']);

        //component model_no
        Route::get('/show', ['uses' => 'MasterController@show']);
        Route::post('/insertdata',['uses' => 'MasterController@insertdata']);
        Route::get('/fetch',['uses' => 'MasterController@fetch']);
        Route::get('/fetchmodel-get-table',['uses' => 'MasterController@fetchmodelGetTable']);
        Route::get('/fetchdata/{id}',['uses' => 'MasterController@fetchdata']);
        Route::post('/update', ['uses' => 'MasterController@update']);
        Route::get('/model-delete/{id}', ['uses' => 'MasterController@modelDelete']);

        // component serial_no
        Route::get('/showcomponentserial' ,['uses' => 'MasterComponentSerialController@showcomponentserial']);
        Route::post('/insert-serial', ['uses' => 'MasterComponentSerialController@insertdata']);
        Route::get('/fetchserial',['uses' => 'MasterComponentSerialController@fetchserial']);
        Route::get('/fetchserial-get-table',['uses' => 'MasterComponentSerialController@fetchserialGetTable']);
        Route::get('/serial-save/{id}',['uses' => 'MasterComponentSerialController@fetchserialno']);
        Route::post('/serial-update', ['uses' => 'MasterComponentSerialController@serialupdate']);
        Route::get('/serial-delete/{id}', ['uses' => 'MasterComponentSerialController@serialdelete']);

        //machine_model
        Route::get('/showmachinemodel', ['uses' => 'MasterMachineModelController@showmachinemodel']);
        Route::post('/insertmachinemodel', ['uses' => 'MasterMachineModelController@insertdata']);
        Route::get('/fetchmachinemodel',['uses' => 'MasterMachineModelController@fetchmachinemodel']);
        Route::get('/fetchmachinemodel-get-table',['uses' => 'MasterMachineModelController@fetchmodelGetTable']);
        Route::get('/model-save/{id}',['uses' => 'MasterMachineModelController@fetchserialno']);
        Route::post('/updatemachinemodel', ['uses' => 'MasterMachineModelController@updatemachinemodel']);
        Route::get('/machinemodel-delete/{id}', ['uses' => 'MasterMachineModelController@machinemodelDelete']);
        //machine_serial
        Route::get('/showmachineserial', ['uses' => 'MasterMachineSerialController@showmachineserial']);
        Route::post('/insert-machine-serial', ['uses' => 'MasterMachineSerialController@insertmachineserial']);
        Route::get('/fetch-machine-serial', ['uses' => 'MasterMachineSerialController@fetchmachineserial']);
        Route::get('/fetchmachineserial-get-table', ['uses' => 'MasterMachineSerialController@fetchmachineserialgettable']);
        Route::get('/machine-serial-save/{id}', ['uses' =>'MasterMachineSerialController@fetchmachineserialno']);
        Route::post('/machine-serial-update', ['uses' =>'MasterMachineSerialController@serialupdate']);
        Route::get('/machine-serial-delete/{id}', ['uses' => 'MasterMachineSerialController@machineserialdelete']);
        Route::get('/example', ['uses' => 'ExampleController@example']);
        //service engineer
        // Route::get('/check-sheet-entry', ['uses' => 'ServiceController@checkSheetEntry']);
        // Route::get('/check-sheet-entry-common/{id}', ['uses' => 'ServiceController@checkSheetEntryCommon']);
        Route::get('/service-list', ['uses' => 'ServiceController@serviceList']);
        Route::get('/service-get-table', ['uses' => 'ServiceController@serviceGetTable']);





        //Check Gate Question
        Route::get('/check-gate-question-add', ['uses' => 'CheckGateController@checkGateQuestionAdd']);
        Route::post('/check-gate-question-add-store', ['uses' => 'CheckGateController@checkGateQuestionAddStore']);
        Route::get('/check-gate-question-list', ['uses' => 'CheckGateController@checkGateQuestionList']);
        Route::get('/check-gate-question-get-table', ['uses' => 'CheckGateController@checkGateQuestionGetTable']);

        Route::get('/check-gate-question-edit/{id}', ['uses' => 'CheckGateController@checkGateQuestionEdit']);
        Route::post('/check-gate-question-edit-store', ['uses' => 'CheckGateController@checkGateQuestionEditStore']);
        Route::get('/check-gate-question-delete/{id}', ['uses' => 'CheckGateController@checkGateQuestionDelete']);

        //Component Name
        Route::get('/component-name-add', ['uses' => 'ServiceController@componentNameAdd']);
        Route::post('/component-name-add-save', ['uses' => 'ServiceController@componentNameAddSave']);

        Route::get('/component-name-list', ['uses' => 'ServiceController@componentNameList']);
        Route::post('/component-name-get-table', ['uses' => 'ServiceController@componentNameGetTable']);
        Route::get('/component-name-edit/{id}', ['uses' => 'ServiceController@componentNameEdit']);
        Route::post('/component-name-edit-store', ['uses' => 'ServiceController@componentNameEditStore']);







        //master employee

        Route::get('/employee-name-list', ['uses' => 'MasterController@employeetNameList']);
        Route::get('/employee-name-get-table', ['uses' => 'MasterController@employeeNameGetTable']);

        //employee section,designation,role
        Route::get('/employee-section-desig-role-list', ['uses' => 'MasterController@employeetSectionDesigRoleList']);
        Route::post('/section-add-save', ['uses' => 'MasterController@sectionAddSave']);
        Route::get('/section-get-table', ['uses' => 'MasterController@sectionGetTable']);
        Route::post('/designation-add-save', ['uses' => 'MasterController@designationAddSave']);
        Route::get('/designation-get-table', ['uses' => 'MasterController@designationGetTable']);
        Route::post('/jobrole-add-save', ['uses' => 'MasterController@jobroleAddSave']);
        Route::get('/jobrole-get-table', ['uses' => 'MasterController@jobroleGetTable']);
        //employee deatils

        Route::get('/employee-detsils-list', ['uses' => 'MasterController@employeeDetailsList']);
        Route::get('/employee-detsils-get-table', ['uses' => 'MasterController@employeeDetailsGetTable']);

        Route::post('/employee-detsils-get-table-download', ['uses' => 'MasterController@employeeDetailsGetTableDownload']);
        Route::get('/employee-detsils-add', ['uses' => 'MasterController@employeeDetailsAdd']);
        Route::post('/employee-detsils-add-save', ['uses' => 'MasterController@employeeDetailsAddSave']);
    Route::get('/employee-edit/{id}', ['uses' => 'MasterController@userEdit']);
        Route::post('/employee-edit-store', ['uses' => 'MasterController@userEditStore']);
        Route::get('/employeedelete/{id}', ['uses' =>'MasterController@employeedelete']);

//serviiceengineerlisting and update
        Route::get('/service-request-list', ['uses' => 'ServiceController@serviceRequestList']);
        Route::get('/listing/{id}', ['uses' =>'ServiceController@servicerequestlisting']);
        Route::post('/update-servicerequest', ['uses' =>'ServiceController@updateservicerequest']);
        //service upload excel
        Route::get('/rollmenu-add', ['uses' =>'MasterSuperAdminController@rollmenu']);
        Route::post('/saverollmenu', ['uses' =>'MasterSuperAdminController@rollmenusave']);
        Route::get('/check-rollmenu-listing', ['uses' =>'MasterSuperAdminController@rollmenufetching']);
        Route::get('/fetchrollmenu-get-table', ['uses' =>'MasterSuperAdminController@rollmenulistinggettable']);

        Route::post('/import-prehist-save', ['uses' => 'ServiceController@importPrehistSave']);

        //master-customer
        Route::get('/customer-add', ['uses' =>'MasterSuperAdminController@addcustomer']);
        Route::post('/customer-add-store', ['uses' => 'MasterSuperAdminController@mastercustomerStore']);
        Route::get('/master-customer', ['uses' =>'MasterSuperAdminController@mastercustomer']);
        Route::get('/fetchcustomer-get-table',['uses' => 'MasterSuperAdminController@fetchcustomerGetTable']);
        Route::get('/editcustomer/{id}',['uses' => 'MasterSuperAdminController@editcustomer']);
        Route::post('/updatecustomer', ['uses' => 'MasterSuperAdminController@updatecustomer']);
        Route::get('/download-customer', ['uses' =>'MasterSuperAdminController@downloadcustomer']);
        Route::get('/download-template-customer', ['uses' =>'MasterSuperAdminController@downloadtemplatecustomer']);
        Route::post('/upload-customer', ['uses' =>'MasterSuperAdminController@uploadcustomer']);
        Route::get('/upload-template-customer', ['uses' =>'MasterSuperAdminController@uploadtemplatecustomer']);

        //master-branch
        Route::get('/branch-add', ['uses' => 'MasterSuperAdminController@addbranch']);
        Route::post('/branch-add-store', ['uses' => 'MasterSuperAdminController@masterbranchStore']);
        Route::get('/master-branch', ['uses' =>'MasterSuperAdminController@masterbranch']);
        Route::get('/fetchbranch-get-table', ['uses' =>'MasterSuperAdminController@fetchbranchGetTable']);
        Route::get('edit-branch/{id}', ['uses' =>'MasterSuperAdminController@editbranch']);
        Route::post('/updatebranch', ['uses' =>'MasterSuperAdminController@updatebranch']);
        Route::get('/download-branch', ['uses' =>'MasterSuperAdminController@downloadbranch']);
        Route::get('/download-template-branch', ['uses' =>'MasterSuperAdminController@downloadtemplatebranch']);
        Route::get('/upload-branch', ['uses' =>'MasterSuperAdminController@uploadbranch']);

        //machine model and serial no-list
        Route::get('/master-machine', ['uses' =>'MasterController@mastermodelserial']);

        Route::get('/fetchmachine-get-table', ['uses' =>'MasterController@fetchmodelserial']);
        Route::get('/editmachine/{id}',['uses' => 'MasterController@editmachine']);
        Route::post('/updatemachine', ['uses' =>'MasterController@updatemachine']);
        // Implement access permission
        Route::get('/rollmenu', ['uses' =>'ServiceController@rollmenulist']);
        Route::post('/saverollmenu', ['uses' =>'ServiceController@rollmenulistsave']);
        Route::get('/check-rollmenu-listing/{id}', ['uses' =>'ServiceController@rollmenulisting']);
		
        //Master Task
        Route::get('/mastertask', ['uses' =>'MasterController@mastertask']);
        Route::post('/insertmastertask', ['uses' =>'MasterController@insertmastertask']);
        Route::get('/fetchmodelwisetask', ['uses' =>'MasterController@fetchmachinetask']);
        Route::get('/fetchmastermachinetask-get-table', ['uses' =>'MasterController@fetchmachinemodeltask']);

        Route::get('/tat-report', ['uses' =>'MasterController@tatreport']);

        Route::post('/fetchmastermachinetask-get-table-download', ['uses' =>'MasterController@fetchmachinemodeltaskDownload']);

        Route::get('/editmachinetask/{id}',['uses' => 'MasterController@editmachinetask']);
        Route::post('/updatemachinetask', ['uses' =>'MasterController@updatemachinetask']);
        Route::get('/deletemachinetask/{id}', ['uses' =>'MasterController@deletemachinetask']);
        Route::post('/predicessor-found', ['uses' =>'MasterController@predicessorfortask']);
        Route::get('/mastersubtask', ['uses' =>'MasterController@mastersubtask']);
        Route::post('/insertmastersubtask', ['uses' =>'MasterController@insertmastersubtask']);
		
		
		
		//masterdatascreen
        Route::get('/othercomp-add', ['uses' =>'MasterController@othercompAdd']);
        Route::post('/othercomp-add-save', ['uses' =>'MasterController@othercompAddSave']);
        Route::get('/othercomp-edit/{id}', ['uses' =>'MasterController@othercompEdit']);
        Route::post('/othercomp-edit-save', ['uses' =>'MasterController@othercompEditSave']);
        Route::get('/fetch-othercomponent', ['uses' =>'MasterController@fetchothercomponent']);
        Route::get('/fetch-othercomponent-get-table', ['uses' =>'MasterController@fetchothercomponentTable']);
       Route::post('/fetch-othercomponent-get-table-download', ['uses' =>'MasterController@fetchothercomponentTableDownload']);

        Route::get('/othercomponent-delete/{id}', ['uses' =>'MasterController@deleteothercomponent']);

        Route::get('/compinsp-add', ['uses' =>'MasterController@compinspAdd']);
        Route::post('/compinsp-add-save', ['uses' =>'MasterController@compinspAddSave']);
        Route::get('/compinsp-edit/{id}', ['uses' =>'MasterController@compinspEdit']);
        Route::post('/compinsp-edit-save', ['uses' =>'MasterController@compinspEditSave']);
        Route::get('/fetch-compinsp', ['uses' =>'MasterController@fetchcompinsp']);
        Route::get('/fetch-compinsp-get-table', ['uses' =>'MasterController@fetchcompinspTable']);
        Route::post('/fetch-compinsp-get-table-download', ['uses' =>'MasterController@fetchcompinspTableDownload']);
        Route::get('/compinsp-delete/{id}', ['uses' =>'MasterController@deletcompinsp']);

        Route::get('/transmission-add', ['uses' =>'MasterController@transmissionAdd']);
        Route::post('/transmission-add-save', ['uses' =>'MasterController@transmissionAddSave']);
        Route::get('/transmission-edit/{id}', ['uses' =>'MasterController@transmissionEdit']);
        Route::post('/transmission-edit-save', ['uses' =>'MasterController@transmissionEditSave']);
        Route::get('/fetch-transmission', ['uses' =>'MasterController@fetchtransmission']);
        Route::get('/fetch-transmission-get-table', ['uses' =>'MasterController@fetchtransmissionTable']);
        Route::post('/fetch-transmission-get-table-download', ['uses' =>'MasterController@fetchtransmissionTableDownload']);

        Route::get('/transmission-delete/{id}', ['uses' =>'MasterController@delettransmission']);

        Route::get('/assembly-add', ['uses' =>'MasterController@assemblyAdd']);
        Route::post('/assembly-add-save', ['uses' =>'MasterController@assemblyAddSave']);
        Route::get('/assembly-edit/{id}', ['uses' =>'MasterController@assemblyEdit']);
        Route::post('/assembly-edit-save', ['uses' =>'MasterController@assemblyEditSave']);
        Route::get('/fetch-assembly', ['uses' =>'MasterController@fetchassembly']);
        Route::get('/fetch-assembly-get-table', ['uses' =>'MasterController@fetchassemblyTable']);
        Route::post('/fetch-assembly-get-table-download', ['uses' =>'MasterController@fetchassemblyTableDownload']);
        Route::get('/assembly-delete/{id}', ['uses' =>'MasterController@deletassembly']);
		
		
//Service Department					
        Route::get('/servicedepartment' ,['uses' =>'MasterController@servicedepartment']);
        Route::post('/insertservicedepartment' ,['uses' =>'MasterController@insertservicedepartment']);
        Route::get('/fetchservicedepartment' ,['uses' =>'MasterController@fetchservicedepartment']);
        Route::get('/fetchservicedepartment-get-table' ,['uses' =>'MasterController@fetchdepartment']);
        Route::get('/edit/{id}', ['uses' =>'MasterController@editservicedepartment']);

        //spc dashboard
        Route::get('/spc-dashboard-list-get-table', ['uses' => 'ServiceController@spcDashboardListGetTable']);


         Route::post('/spc-dashboard-list-get-table-download', ['uses' => 'ServiceController@spcDashboardListGetTableDownload']);

        //engine head dashboard
        Route::get('/engine-head-dashboard-get-table', ['uses' => 'ServiceController@engHeadDashboardGetTable']);
        //head approved/reject
        Route::post('/head-approve-checksheet-save', ['uses' => 'CheckSheetController@headApproveChecksheetSave']);
        Route::post('/head-approve-assemblychecksheet-save', ['uses' => 'CheckSheetController@headApproveAssemblyChecksheetSave']);

        //head approved/reject
        Route::post('/head-approve-checkgate-save', ['uses' => 'CheckGateController@headApproveCheckgateSave']);
        Route::post('/head-approve-checkgate-one-save', ['uses' => 'CheckGateController@headApproveCheckgateOneSave']);
        Route::post('/head-approve-checkgate-two-save', ['uses' => 'CheckGateController@headApproveCheckgateTwoSave']);
        Route::post('/head-approve-checkgate-three-save', ['uses' => 'CheckGateController@headApproveCheckgateThreeSave']);
        Route::post('/head-approve-pdi-save', ['uses' => 'CheckGateController@headApprovePdiSave']);
        Route::post('/head-approve-checkgate-four-save', ['uses' => 'CheckGateController@headApproveCheckgateFourSave']);
        Route::post('/head-approve-service-request-save', ['uses' => 'CheckGateController@headApproveServiceRequestSave']);
        Route::post('/head-approve-bis-save', ['uses' => 'CheckGateController@headApproveBISSave']);

        //spc po upload
        Route::get('/upload-po-add/{id}', ['uses' => 'ServiceController@uploadPoAdd']);
        Route::post('/upload-po-add-save', ['uses' => 'ServiceController@uploadPoAddSave']);
        //po download
        Route::get('/po-download-show/{id}', ['uses' => 'ServiceController@poDownloadShow']);
        Route::post('/po-download', ['uses' => 'ServiceController@poDownload']);
//SAP_Integration_Data.xls
        Route::get('/customerexcel', ['uses' =>'MasterSuperAdminController@customerexcel']);
        //Roll
        Route::get('/servicedashboard-checkgateone',['uses' =>'MasterSuperAdminController@servicedashboardcheckgateone']);
        Route::get('/fetchservicheckgateone-get-table',['uses' => 'MasterSuperAdminController@fetchservicedashboardcheckgateone']);

        Route::get('/fetchservicheckgateone-get-table-datefilter',['uses' => 'MasterSuperAdminController@fetchservicedashboardcheckgateonedatefilter']);


        Route::get('/servicedashboard-checkgatetwo',['uses' =>'MasterSuperAdminController@servicedashboardcheckgatetwo']);
        Route::get('/fetchservicheckgatetwo-get-table',['uses' => 'MasterSuperAdminController@fetchservicedashboardcheckgatetwo']);

        Route::post('/fetchservicheckgatetwo-get-table-download',['uses' => 'MasterSuperAdminController@fetchservicedashboardcheckgatetwoDownload']);


        Route::get('/servicedashboard-checkgatethree',['uses' =>'MasterSuperAdminController@servicedashboardcheckgatethree']);
        Route::get('/fetchservicheckgatethree-get-table',['uses' => 'MasterSuperAdminController@fetchservicedashboardcheckgatethree']);

        Route::post('/fetchservicheckgatethree-get-table-download-departmental',['uses' => 'MasterSuperAdminController@fetchservicedashboardcheckgatethreeDownloadDepartmental']);

       Route::post('/fetchservicheckgatethree-get-table-download',['uses' => 'MasterSuperAdminController@fetchservicedashboardcheckgatethreeDownload']);

        Route::get('/servicedashboard-checkgatefour',['uses' =>'MasterSuperAdminController@servicedashboardcheckgatefour']);
        Route::get('/fetchservicheckgatefour-get-table',['uses' => 'MasterSuperAdminController@fetchservicedashboardcheckgatefour']);

        Route::post('/fetchservicheckgatefour-get-table-download',['uses' => 'MasterSuperAdminController@fetchservicedashboardcheckgatefourDownload']);

        Route::get('/service-pending',['uses' =>'MasterSuperAdminController@servicedashboardpending']);
        Route::get('/fetchservicepending-get-table',['uses' =>'MasterSuperAdminController@fetchservicedashboardpending']);
        Route::get('/service-inprogress',['uses' =>'MasterSuperAdminController@servicedashboardinprogress']);
        Route::get('/fetchserviceinprogress-get-table',['uses' =>'MasterSuperAdminController@fetchservicedashboardinprogress']);
        Route::get('/service-submitted',['uses' =>'MasterSuperAdminController@servicedashboardsubmit']);
        Route::get('/fetchservicesubmit-get-table',['uses' =>'MasterSuperAdminController@fetchservicedashboardsubmit']);

        Route::get('/service-reject',['uses' =>'MasterSuperAdminController@servicedashboardreject']);
        Route::get('/fetchservicereject-get-table',['uses' =>'MasterSuperAdminController@fetchservicedashboardreject']);


        Route::get('/servirequest',['uses' =>'MasterSuperAdminController@servicerequest']);
        Route::get('/servirequest-listing',['uses' =>'MasterSuperAdminController@fetchservicerequest']);
        Route::get('/showchecksheet',['uses' =>'MasterSuperAdminController@showchecksheet']);
        Route::get('/fetchservichecksheet-get-table',['uses' =>'MasterSuperAdminController@showchecksheetdetails']);

        //master section
      Route::get('/checksheetsection-add', ['uses' => 'MasterController@checksheetsectionAdd']);
        Route::post('/checksheetsection-add-save', ['uses' => 'MasterController@checksheetsectionAddSave']);
        Route::get('/checksheetsection-edit/{id}', ['uses' => 'MasterController@checksheetsectionEdit']);
        Route::post('/checksheetsection-edit-save', ['uses' => 'MasterController@checksheetsectionEditSave']);
        Route::get('/checksheetsection-listing', ['uses' =>'MasterController@checksheetsectionlisting']);
        Route::get('/checksheetsection-get-table', ['uses' =>'MasterController@fetchchecksheetsection']);
        Route::post('/checksheetsection-get-table-download', ['uses' =>'MasterController@fetchchecksheetsectionDownload']);

        Route::get('/checksheetsection-delete/{id}', ['uses' => 'MasterController@checksheetsectionDelete']);

        Route::get('/checksheetcolumn-add', ['uses' => 'MasterController@checksheetcolumnAdd']);
        Route::post('/checksheetcolumn-add-save', ['uses' => 'MasterController@checksheetcolumnAddSave']);
        Route::get('/checksheetcolumn-edit/{id}', ['uses' => 'MasterController@checksheetcolumnEdit']);
        Route::post('/checksheetcolumn-edit-save', ['uses' => 'MasterController@checksheetcolumnEditSave']);
        Route::get('/checksheetcolumn-listing', ['uses' =>'MasterController@checksheetcolumnlisting']);
        Route::get('/checksheetcolumn-get-table', ['uses' =>'MasterController@fetchchecksheetcolumn']);
       Route::post('/checksheetcolumn-get-table-download', ['uses' =>'MasterController@fetchchecksheetcolumnDownload']);

        Route::get('/checksheetcolumn-delete/{id}', ['uses' => 'MasterController@checksheetcolumnDelete']);
		
		//master stddata
        Route::get('/stddata-add', ['uses' => 'MasterController@stddataAdd']);
        Route::post('/stddata-add-save', ['uses' => 'MasterController@stddataAddSave']);
        Route::get('/stddata-edit/{id}', ['uses' => 'MasterController@stddataEdit']);
        Route::post('/stddata-edit-save', ['uses' => 'MasterController@stddataEditSave']);
        Route::get('/stddata-listing', ['uses' =>'MasterController@stddatalisting']);
        Route::get('/stddata-get-table', ['uses' =>'MasterController@fetchstddata']);
        Route::post('/stddata-get-table-download', ['uses' =>'MasterController@fetchstddataDownload']);

        Route::get('/stddata-delete/{id}', ['uses' => 'MasterController@stddataDelete']);

        //BIS Checksheet Add
                
         Route::get('/bis-add/{id}', ['uses' =>'MasterSuperAdminController@bisAdd']);
        Route::post('/bis-add-save', ['uses' => 'MasterSuperAdminController@bisAddSave']);
        Route::get('/bis-listing', ['uses' =>'MasterSuperAdminController@bislisting']);
        Route::get('/test_report', ['uses' =>'MasterSuperAdminController@testreport']);
        Route::post('/bis-test-report-save', ['uses' =>'MasterSuperAdminController@bistestreportsave']);
        Route::post('/bis-test-report-save_trans', ['uses' =>'MasterSuperAdminController@bistestreportsavetrans']);
        Route::get('/bischecksheet-get-table', ['uses' =>'MasterSuperAdminController@fetchbischecksheet']);
        Route::post('/bischecksheet-get-table-download', ['uses' =>'MasterSuperAdminController@fetchbischecksheetDownload']);

        Route::post('/bis-test-report-save-trans-download/{id}', ['uses' =>'MasterSuperAdminController@testreporttransdownlaod']);
        Route::post('/bis-test-report-save-download/{id}', ['uses' =>'MasterSuperAdminController@testreportdownlaod']);

        Route::get('/testreport-get-table', ['uses' =>'MasterSuperAdminController@fetchtestreport']);
        Route::get('/editbischecksheet/{id}', ['uses' => 'MasterSuperAdminController@editbischecksheet']);

        Route::get('/test-report-add/{id}', ['uses' => 'MasterSuperAdminController@addtestreport']);
        Route::get('/test-report-add-trans/{id}', ['uses' => 'MasterSuperAdminController@addtestreporttrans']);


        Route::post('/save-bis', ['uses' =>'MasterSuperAdminController@editbissave']);
        
        //AIS Checksheet
        Route::get('/ais-add/{id}', ['uses' =>'MasterSuperAdminController@aisAdd']);
        Route::post('/ais-add-save', ['uses' => 'MasterSuperAdminController@aisAddSave']);
        Route::get('/ais-listing', ['uses' =>'MasterSuperAdminController@aislisting']);
        Route::get('/aischecksheet-get-table', ['uses' =>'MasterSuperAdminController@fetchaischecksheet']);
        Route::post('/download-checkgetfacility', ['uses' =>'MasterSuperAdminController@downloadcheckgate']);
        Route::get('/editaischecksheet/{id}', ['uses' => 'MasterSuperAdminController@editaischecksheet']);
        Route::post('/save-ais', ['uses' => 'MasterSuperAdminController@editaisave']);
        Route::post('/check-gate-statusrevision-save', ['uses' => 'CheckSheetController@statusrevision']);
        Route::post('/check-gate-disassembly-save', ['uses' =>'CheckSheetController@checkgatedisassembly']);
        Route::post('/check-gate-engineassemblychecksheet-save', ['uses' =>'CheckSheetController@engineassemblychecksheet']);
        Route::post('/check-gate-ccinspec-dis-save',['uses' =>'CheckSheetController@inspectionbeforestartassembly']);

        Route::post('/comp-inspec-report-save', ['uses' =>'CheckSheetController@componentinspectionreport']);
//Master Status
        Route::get('/status',['uses' =>'MasterSuperAdminController@masterstatus']);
        Route::post('/insertstatus', ['uses' =>'MasterSuperAdminController@insertstatus']);

        //checksheet secion values
        Route::post('/child-section-show', ['uses' => 'MasterController@childSectionShow']);
        Route::post('/sub-child-section-show', ['uses' => 'MasterController@subChildSectionShow']);
        Route::post('/column-section-show', ['uses' => 'MasterController@columnSectionShow']);
        
        
        
        //report
        
        //component status
        Route::get('/componentstatusfacility-listing', ['uses' =>'UserController@componentstatusfacilitylisting']);
        Route::get('/componentstatusfacility-get-table', ['uses' =>'UserController@componentstatusfacilityGetTable']);

        Route::get('/componentstatusfacility-get-table-datefilter', ['uses' =>'UserController@componentstatusfacilityGetTabledatefilter']);

        Route::get('/download-componentstatusfacility', ['uses' =>'UserController@downloadcomponentstatus']);
        Route::get('/componentstatusfacility-filter', ['uses' =>'UserController@componentstatusfacilityFilter']);


        //job details
        Route::get('/jobdetails-listing', ['uses' =>'UserController@jobdetailslisting']);
        Route::get('/jobdetails-get-table', ['uses' =>'UserController@jobdetailsGetTable']);

        Route::get('/jobdetails-get-table-datefilter', ['uses' =>'UserController@jobdetailsGetTabledatefilter']);

        Route::post('/download-jobdetails', ['uses' =>'UserController@downloadjobdetails']);
        Route::get('/jobdetails-filter', ['uses' =>'UserController@jobdetailsFilter']);



        //Men Power
        Route::get('/menPower-listing', ['uses' =>'UserController@menPowerlisting']);
        Route::get('/menPower-get-table', ['uses' =>'UserController@menPowerGetTable']);
        Route::post('/menPower-get-table-download', ['uses' =>'UserController@downloadmenPower']);
        //Route::get('/download-menPower', ['uses' =>'UserController@downloadmenPower']);
        Route::get('/menPower-filter', ['uses' =>'UserController@menPowerFilter']);

        //workorder details or tat report
        Route::get('/workorder-listing', ['uses' =>'UserController@workorderlisting']);
        Route::get('/workorder-get-table', ['uses' =>'UserController@workorderGetTable']);
       // Route::get('/download-workorder', ['uses' =>'UserController@downloadworkorder']);
        Route::get('/workorder-filter', ['uses' =>'UserController@workorderFilter']);
		Route::get('/workorder-datefilter', ['uses' =>'UserController@workorderDateFilter']);
		Route::get('/workorder-graph', ['uses' =>'UserController@workorderGraph']);

        //ytd comp rece & dispt
        Route::get('/comprecdisp-listing', ['uses' =>'UserController@comprecdisplisting']);
        Route::get('/comprecdisp-get-table', ['uses' =>'UserController@comprecdispGetTable']);
        //Route::get('/download-comprecdisp', ['uses' =>'UserController@downloadcomprecdisp']);
        Route::get('/comprecdisp-filter', ['uses' =>'UserController@comprecdispFilter']);

        //parts list
       Route::get('/part-listing', ['uses' =>'UserController@partlisting']);
      // Route::get('/part-get-table', ['uses' =>'UserController@partGetTable']);
      //  Route::get('/download-part', ['uses' =>'UserController@downloadpart']);


        //time sheet
        Route::post('/customer-list-show', ['uses' => 'UserController@customerListShow']);
        Route::get('/time-sheet-entry', ['uses' =>'UserController@timeSheetEntry']);
        Route::post('/time-sheet-entry-save', ['uses' => 'UserController@timeSheetEntrySave']);
        Route::get('/time-sheet-edit/{id}', ['uses' =>'UserController@timeSheetEdit']);
        Route::post('/time-sheet-edit-save', ['uses' => 'UserController@timeSheetEditSave']);
        Route::get('/time-sheet-listing', ['uses' =>'UserController@timeSheetlisting']);
        Route::get('/time-sheet-get-table', ['uses' =>'UserController@timeSheetGetTable']);
        Route::get('/time-sheet-get-table-datefilter', ['uses' =>'UserController@timeSheetGetTabledatefilter']);
        Route::post('/download-timesheet', ['uses' =>'UserController@downloadtimesheet']);

        Route::get('/time-sheet-filter', ['uses' =>'UserController@timeSheetFilter']);

        //Daily Shift Log
       // Route::get('/dailyShiftLog-listing', ['uses' =>'UserController@dailyShiftLoglisting']);
       // Route::get('/dailyShiftLog-get-table', ['uses' =>'UserController@dailyShiftLogGetTable']);
       // Route::get('/download-dailyShiftLog', ['uses' =>'UserController@downloaddailyShiftLog']);

        //Labour Job Activity
        Route::get('/labourJobActivity-listing', ['uses' =>'UserController@labourJobActivitylisting']);
        Route::get('/labourJobActivity-get-table', ['uses' =>'UserController@labourJobActivityGetTable']);
        Route::get('/download-labourJobActivity', ['uses' =>'UserController@downloadlabourJobActivity']);
        Route::get('/labourJobActivity-filter', ['uses' =>'UserController@labourJobActivityFilter']);
        Route::get('/labourJobActivity-datefilter', ['uses' =>'UserController@labourJobActivityDateFilter']);
        Route::post('/labourJobActivity-download', ['uses' =>'UserController@labourJobActivitydownload']);
		Route::get('/labour-graph', ['uses' =>'UserController@labourGraph']);
		 Route::get('/labour-technician-graph', ['uses' =>'UserController@labourTechGraph']);
         Route::get('/labour-time-utdate', ['uses' =>'UserController@labourTimeUpdate']);
		 //capacity utilization
		//coded by amanur start
		Route::get('/capacityUtilization-listing', ['uses' =>'UserController@capacityUtilizationlisting']);
		Route::post('/capacityUtilization-listing', ['uses' =>'UserController@capacityUtilizationlisting']);
		Route::get('/capacityUtilization-get-table', ['uses' =>'UserController@capacityUtilizationGetTable']);
		//end coded by amanur
        
		 //bis report
        Route::get('/bisreport-listing', ['uses' =>'UserController@bisReportlisting']);
        Route::get('/bisreport-listing-get-table', ['uses' =>'UserController@bisReportGetTable']);
        Route::get('/bisreport-listing-filter', ['uses' =>'UserController@bisReportFilter']);
        Route::get('/bisreport-listing-datefilter', ['uses' =>'UserController@bisReportDateFilter']);
        
        //ajax
        Route::post('/get-activity-by-dept', ['uses' => 'MasterController@getActivityByDept']);
        
         //sync with workorder
        Route::post('/sync-with-workorder', ['uses' => 'ServiceController@syncWithWorkorder']);

        //sync with service request no
        Route::post('/sync-with-servicerequest', ['uses' => 'ServiceController@syncWithServiceRequest']);

      //sap integration
        //Route::post('/sap-intre-service-req', ['uses' => 'ServiceController@sapIntreSerreq']);
        Route::get('/sap-intre-service', ['uses' => 'ServiceController@sapIntreSerreq']);
        
        //CERTIFICATES
        Route::get('/certificate-list', ['uses' => 'CertificateController@listCertificate']);
        Route::get('/certificate-get-table', ['uses' => 'CertificateController@getTableCertificate']);
        Route::get('/engine-certificate/{id}', ['uses' => 'CertificateController@engineCertificate']);
        Route::get('/certificate-download', ['uses' => 'CertificateController@downloadCertificate']);
		
		Route::get('/change-password', ['uses' => 'UserController@changePassword']);

        Route::post('/change-password-save', [ 'uses' => 'UserController@changePasswordSave']);
		
		//code optimize customer
        Route::post('/customerdropdown-filter', ['uses' =>'ServiceController@customerDropdownFilter']);
        //code optimize machine model
        Route::post('/machinemodeldropdown-filter', ['uses' =>'ServiceController@machinemodelDropdownFilter']);

        //code optimize machine serial
        Route::post('/machineserialdropdown-filter', ['uses' =>'ServiceController@machineserialDropdownFilter']);

        //code optimize component model
        Route::post('/compmodeldropdown-filter', ['uses' =>'ServiceController@compmodelDropdownFilter']);

        //code optimize component serial
        Route::post('/compserialdropdown-filter', ['uses' =>'ServiceController@compserialDropdownFilter']);

        Route::post('/column-section-show-new', ['uses' => 'MasterController@columnSectionShowNew']);


//sap
 Route::get('/sapresponse', ['uses' => 'ServiceController@sapresponse']);

        //mor
        Route::get('/mor-assign/{id}', ['uses' =>'CheckSheetController@morAssign']);
        Route::post('/mor-assign-save', ['uses' =>'CheckSheetController@morAssignSave']);

    // Added By 

    Route::get('/section-selection', ['uses' =>'MasterSuperAdminController@sectionselection']);
    Route::get('/fetchsectionselection-get-table',['uses' => 'MasterSuperAdminController@fetchsectionselectionGetTable']);
    Route::get('/section-add', ['uses' =>'MasterSuperAdminController@addsection']);
    Route::post('/section-add-store', ['uses' => 'MasterSuperAdminController@mastersectionStore']);

    Route::get('/checksheetsection-delete/{id}', ['uses' => 'MasterController@checksheetsectionDelete']);

    Route::get('/checksheetcolumn-add-new', ['uses' => 'MasterController@checksheetcolumnAddnew']);
    Route::post('/checksheetcolumn-add-save-new', ['uses' => 'MasterController@checksheetcolumnAddSavenew']);
    Route::get('/checksheetcolumn-edit-new/{id}', ['uses' => 'MasterController@checksheetcolumnEditnew']);
    Route::post('/checksheetcolumn-edit-save-new', ['uses' => 'MasterController@checksheetcolumnEditSavenew']);
    Route::get('/checksheetcolumn-listing-new', ['uses' =>'MasterController@checksheetcolumnlistingnew']);
    Route::get('/checksheetcolumn-get-table-new', ['uses' =>'MasterController@fetchchecksheetcolumnnew']);
   Route::post('/checksheetcolumn-get-table-download-new', ['uses' =>'MasterController@fetchchecksheetcolumnDownloadnew']);

    Route::get('/checksheetcolumn-delete=new/{id}', ['uses' => 'MasterController@checksheetcolumnDeletenew']);

    Route::post('/get-section-for-column-new', ['uses' => 'MasterController@GetSectionForColumnNew']);    


    });
});

//File Manager
/*
Route::group(['middleware' => 'auth'], function () {
    Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    // list all lfm routes here...
});

*/

//auth

Route::get('/', ['uses' => 'Auth\LoginController@index']);

Route::post('/loginchk', [ 'uses' => 'Auth\LoginController@checklogin']);

Route::get('/logout', ['uses' => 'Auth\LoginController@logout']);

Route::get('/registration', ['uses' => 'Auth\LoginController@registration']);

Route::post('/register-save', [ 'uses' => 'Auth\LoginController@registerStore']);

Route::get('/forgot-password', ['uses' => 'Auth\LoginController@forgotPassword']);

Route::post('/forgot-password-save', [ 'uses' => 'Auth\LoginController@forgotPasswordSave']);


Route::get('/test', ['uses' => 'Admin\UserController@test']);


