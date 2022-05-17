<!-- Footer -->

<footer class="footer pt-0" style="background: #f2b914;">
    <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
            <div class="copyright text-center text-lg-left text-muted">
                &copy; 2020 <a  class="font-weight-bold ml-1"
                               target="_blank">GCPL</a>. All rights reserved
            </div>
        </div>
        <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                    <a  class="nav-link" >About Us</a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link" >Terms</a>
                </li>
            </ul>
        </div>
    </div>
</footer>

<script src="{{URL::asset('public/assets/vendor/jquery/dist/jquery.min.js')}}"></script>

<script type="text/javascript">
    /*remarks validation in onclick no button*/
    
    
    
    //checkgate1 add
     function checkone(id){
        console.log(id);

        var no = $('.nochkgte1:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nochkgte1:checked').map(function() {
            // return $(this).attr('id');
             console.log($(this).attr('id'))
             
            suffix = $(this).attr('id');
            arr.push("#chkoneemarks"+suffix.replace(/[^0-9]/g,''));
         });
        console.log(ids)

        // ids=  ids.toArray();
         console.log(arr)

        $(".testchkgt1").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });


    }
    
  


   
    
     //checkgate2 add
     
       function checktwo(id){
        console.log(id);

        var no = $('.nochkgte2:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nochkgte2:checked').map(function() {
            // return $(this).attr('id');
             console.log($(this).attr('id'))
             
            suffix = $(this).attr('id');
            arr.push("#chktwormarks"+suffix.replace(/[^0-9]/g,''));
         });
        console.log(ids)

        // ids=  ids.toArray();
         console.log(arr)

        $(".testchkgt2").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });


    }
    
    
   
    
    //checkgate3 add
    
     function checkthree(id){
        console.log(id);

        var no = $('.nochkgte3:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nochkgte3:checked').map(function() {
            // return $(this).attr('id');
             console.log($(this).attr('id'))
             
            suffix = $(this).attr('id');
            arr.push("#chkthreeemarks"+suffix.replace(/[^0-9]/g,''));
         });
        console.log(ids)

        // ids=  ids.toArray();
         console.log(arr)

        $(".testchkgt3").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });


    }
   
    
     //checkgate4 add
     
      function checkfour(id){
        console.log(id);

        var no = $('.nochkgte4:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nochkgte4:checked').map(function() {
            // return $(this).attr('id');
             console.log($(this).attr('id'))
             
            suffix = $(this).attr('id');
            arr.push("#chkfouremarks"+suffix.replace(/[^0-9]/g,''));
         });
        console.log(ids)

        // ids=  ids.toArray();
         console.log(arr)

        $(".testchkgt4").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });


    }
    
    
    //checksheet
    
    
     function checkgatefol(id){
        console.log(id);

        var no = $('.nochkgate:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nochkgate:checked').map(function() {
            // return $(this).attr('id');
             console.log($(this).attr('id'))
             
            suffix = $(this).attr('id');
            arr.push("#chkgatereq"+suffix.replace(/[^0-9]/g,''));
         });
        console.log(ids)

        // ids=  ids.toArray();
         console.log(arr)

        $(".testchkgte").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });


    }
    
    
    
   //commercial 
  function comreq(id){
        console.log(id);

        var no = $('.nochk:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nochk:checked').map(function() {
            // return $(this).attr('id');
             console.log($(this).attr('id'))
            suffix = $(this).attr('id');
            arr.push("#commerreq"+suffix.replace(/[^0-9]/g,''));
         });
        console.log(ids)

        // ids=  ids.toArray();
         console.log(arr)

        $(".testremark").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });


    }
    
 //external wash
    
    
    function extno(id){
        console.log(id);

        var no = $('.noexternal:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.noexternal:checked').map(function() {
            // return $(this).attr('id');
            console.log($(this).attr('id'))
            suffix = $(this).attr('id');
            arr.push("#externalrem"+suffix.replace(/[^0-9]/g,''));
        });
        console.log(ids)

        // ids=  ids.toArray();
        console.log(arr)

        $(".testexter").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });



    }
    

    
    
    //part clean
     function partclean(id){
        console.log(id);

        var no = $('.nopartcln:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nopartcln:checked').map(function() {
            // return $(this).attr('id');
            console.log($(this).attr('id'))
            suffix = $(this).attr('id');
            arr.push("#partcleanreq"+suffix.replace(/[^0-9]/g,''));
        });
        console.log(ids)

        // ids=  ids.toArray();
        console.log(arr)

        $(".partsremrk").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });



    }
    
   
    
    //before start assembly
    
    function beforestassmreq(id){
        console.log(id);

        var no = $('.nobeforeassem:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nobeforeassem:checked').map(function() {
            // return $(this).attr('id');
            console.log($(this).attr('id'))
            suffix = $(this).attr('id');
            arr.push("#beforestrrem"+suffix.replace(/[^0-9]/g,''));
        });
        console.log(ids)

        // ids=  ids.toArray();
        console.log(arr)

        $(".testbeforeassem").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });



    }
    
    // function beforestassmreq(id){
    //     console.log(id);
    //     $("#beforestrrem"+id).prop('required',true);

    // }
    
    
    //fan
    
    
    function fanreq(id){
        console.log(id);

        var no = $('.nofan:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nofan:checked').map(function() {
            // return $(this).attr('id');
            console.log($(this).attr('id'))
            suffix = $(this).attr('id');
            arr.push("#fanremark"+suffix.replace(/[^0-9]/g,''));
        });
        console.log(ids)

        // ids=  ids.toArray();
        console.log(arr)

        $(".testfan").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });



    }
   
    
    //oil
    
    function oilreq(id){
        console.log(id);

        var no = $('.nooil:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nooil:checked').map(function() {
            // return $(this).attr('id');
            console.log($(this).attr('id'))
            suffix = $(this).attr('id');
            arr.push("#oilremark"+suffix.replace(/[^0-9]/g,''));
        });
        console.log(ids)

        // ids=  ids.toArray();
        console.log(arr)

        $(".testoil").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });



    }
   
    
    //air
    
     function airreq(id){
        console.log(id);

        var no = $('.noair:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.noair:checked').map(function() {
            // return $(this).attr('id');
            console.log($(this).attr('id'))
            suffix = $(this).attr('id');
            arr.push("#airremark"+suffix.replace(/[^0-9]/g,''));
        });
        console.log(ids)

        // ids=  ids.toArray();
        console.log(arr)

        $(".testair").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });



    }
   
    
    
    //water
    function waterreq(id){
        console.log(id);

        var no = $('.nowater:checked').length;

        var arr = [];
        // console.log(no);
        // var i = 0;
        var suffix;
        var ids = $('.nowater:checked').map(function() {
            // return $(this).attr('id');
            console.log($(this).attr('id'))
            suffix = $(this).attr('id');
            arr.push("#waterremark"+suffix.replace(/[^0-9]/g,''));
        });
        console.log(ids)

        // ids=  ids.toArray();
        console.log(arr)

        $(".testwater").removeClass("testno");
        $.each(arr, function( index, value ) {
            $(value).addClass("testno");

            $(value).prop('required',true);
            //console.log(arr[value])
            //console.log(value)
        });



    }
    
  
    
</script>

