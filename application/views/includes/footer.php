            </div>
             
    <!-- end main content-->
</div>
         <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Nabard.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by <a href="#!" class="text-decoration-underline"></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- END layout-wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <hr class="m-0" />

                <div class="p-4">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-vertical" value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout"
                            id="layout-horizontal" value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-light" value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-dark" value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-ltr" value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction"
                            id="layout-direction-rtl" value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <script src="<?php echo base_url()?>assets/libs/jquery/jquery.min.js"></script>
        <!-- Required datatable js -->
        
        <script src="<?php echo base_url()?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        

       <!-- Responsive examples -->
        <script src="<?php echo base_url()?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
       
        <!-- JAVASCRIPT -->
        
        <script src="<?php echo base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="<?php echo base_url()?>assets/libs/pace-js/pace.min.js"></script>

        <!-- apexcharts -->
        <script src="<?php echo base_url()?>assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- Plugins js-->
        <script src="<?php echo base_url()?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        
        
       <!-- twitter-bootstrap-wizard js -->
        <script src="<?php echo base_url()?>assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="<?php echo base_url()?>assets/libs/twitter-bootstrap-wizard/prettify.js"></script>
    
        <!-- form wizard init -->
        <script src="<?php echo base_url()?>assets/js/pages/form-wizard.init.js"></script>
    
        <!-- dashboard init -->
        <!--<script src="<?php echo base_url()?>assets/js/pages/dashboard.init.js"></script>-->

        <script src="<?php echo base_url()?>assets/js/app.js"></script>
        <!-- ckeditor -->
        <script src="<?php echo base_url()?>assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

        <!-- init js -->
        <script src="<?php echo base_url()?>assets/js/pages/form-editor.init.js"></script>
        
   
        <!-- Required datatable js -->
        <!--<script src="<?php echo base_url()?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>-->
        <!--<script src="<?php echo base_url()?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>-->
        <!-- Buttons examples -->
        <!--<script src="<?php echo base_url()?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>-->
        <!--<script src="<?php echo base_url()?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>-->
        <!--<script src="<?php echo base_url()?>assets/libs/jszip/jszip.min.js"></script>-->
        <!--<script src="<?php echo base_url()?>assets/libs/pdfmake/build/pdfmake.min.js"></script>-->
        <!--<script src="<?php echo base_url()?>assets/libs/pdfmake/build/vfs_fonts.js"></script>-->
        <!--<script src="<?php echo base_url()?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>-->
        <!--<script src="<?php echo base_url()?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>-->
        <!--<script src="<?php echo base_url()?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>-->

        <!-- Responsive examples -->
        <!--<script src="<?php echo base_url()?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>-->
        <!--<script src="<?php echo base_url()?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>-->

        <!-- Datatable init js -->
        <!--<script src="<?php echo base_url()?>assets/js/pages/datatables.init.js"></script>    -->
           <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
          <script>
               $(document).ready(function() {
                $('#datatable-buttons').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'print'
                    ],
                    responsive: false
                } );
            } );
            </script>
      
        <script>
var timeout = 3000; // in miliseconds (3*1000)
$('.alert').delay(timeout).fadeOut(300);
</script>
        
        <script>

// $('#datatable').DataTable( {
// responsive: false
// } );
        </script>






<script>
function phonenumberValidation(vals, msg, btn) {
    let reg = /^[6789]{1}[0-9]{9}$/;
    if (vals === '') {
        $("#" + msg).html("<p style='color:red'></p>");
        $("#" + btn).attr('disabled', false);
        // console.log('true');
        return false;
    }
   else if (!reg.test(vals)) {
        $("#" + msg).html("<p style='color:red'>Please enter valid mobile number.</p>");
        $("#" + btn).attr('disabled', true);
        // console.log('false');
        return false;
    } else {
        $("#" + msg).html("");
        $("#" + btn).attr('disabled', false);
        // console.log('false');
        return true;
    
    }
}
</script>



<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>



<script>
$(document).ready(function() {
    $('#OTPmodal').modal({
        backdrop: 'static',
        keyboard: false
    })
});
</script>
        <script>

        function FullnameValidation(vals, msg, btn) {
        let reg = /^[a-zA-Z\s]*$/;
        if (vals === '') {
            $("#" + msg).empty();
            // console.log('false');
            return false;
            $("#" + btn).attr('disabled', true);
            // console.log('true');
        } else if (!reg.test(vals)) {
            $("#" + msg).html("<span style='color:red'>This field accept only characters</span>");
            $("#" + btn).attr('disabled', true);
            // console.log('false');
            return false;
           
        } else {
            $("#" + msg).html("");
            $("#" + btn).attr('disabled', false);
            // console.log('true');
            return true;
            // console.log('false');
        }

        }
        </script>



<script>

function DesignationValidation(vals, msg, btn) {
let reg = /^[a-zA-Z\s]*$/;
if (vals === '') {
    $("#" + msg).empty();
    // console.log('false');
    return false;
    $("#" + btn).attr('disabled', true);
    // console.log('true');
} else if (!reg.test(vals)) {
    $("#" + msg).html("<span style='color:red'>Please enter valid Designation</span>");
    $("#" + btn).attr('disabled', true);
    // console.log('false');
    return false;
   
} else {
    $("#" + msg).html("");
    $("#" + btn).attr('disabled', false);
    // console.log('true');
    return true;
    // console.log('false');
}

}
</script>




<script>
function timer(remaining) {
            var m = Math.floor(remaining/60);
            var s = remaining % 60;
            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            if(remaining > 30)
            {
                document.getElementById('countdown').innerHTML = m + ':' + s;     
            }
                remaining -= 1;
                remaining2=remaining
            if (remaining >= 0) {
                setTimeout(function () {
                    timer(remaining);
                }, 1000);
                if(remaining < 30)
                {
                    remaining=0;
                    remaining2 = 0;
                    //   document.getElementById("submit_btn").disabled = true;
                    
                    $("#countdown").html(`<button onclick="document.getElementById('first_form_submit_btn').click()" class='btn btn-primary  btn-md '>Resend</button>`);
               
                }
            }    
        }
        
</script>



<script>
      $(document).ready(function() {
       var result_list_table = '';
    $("[data-filter]").on('change', (function() {
        let filter_attr =this.getAttribute("name");
        let getInput = [];
        $.map($(`select[data-filter]`), (v, i) => {
            getInput.push(`${$(v).attr('name')}=${$(v).find(':selected').val()}`);
        })
        getInput = getInput.join('&');
        var categoryID = $(this).val();
        if (categoryID) {
            $.ajax({
                type: "POST",
                url: "<?= base_url()?>vendor/getch_district_block?" + getInput,
                data: "state_id=" + categoryID,
                success: function(html) {
                    let res = JSON.parse(html);
                    if(filter_attr != 'block')
                    {
                        $(`#block`).empty();
                        $.map(res.subcategory_list, function(v, i) {
                            $(`#block`).append(`
                                  ${v}
                            `);
                        });
                    }
                }
            });

        } else {
            $('#block').html('<option value="">select district first</option>');
        }

    }))
});
</script>



<script>
                function verifyPass() {

                    var pw1 = document.getElementById("id_password").value;
                    var pw2 = document.getElementById("id_password1").value;
                    var mes = document.getElementById("passMes_con");
                    if (pw1 == "") {
                        mes.innerHTML = "<span style='color: red;'></span>";
                        document.getElementById("submit").disabled = false;
                    } else if (pw2 == "") {
                        mes.innerHTML = "<span style='color: red;'></span>";
                        document.getElementById("submit").disabled = false;
                    }
                    else if (pw1 != pw2) {

                        console.log('not matched',mes);
                        //  alert('not matched');
                        mes.innerHTML = "<span style='color: red;'>**Password did not match!</span>";
                        // alert( mes.innerHTML );
                        document.getElementById("submit").disabled = true;
                    }
                    else {
                        mes.innerHTML = "<span style='color: green;'>**Password matched successfully.</span>";
                        document.getElementById("submit").disabled = false;
                    }
                }
            </script>


<script>
/* function FullnameValidation(vals, msg, btn) {

    let reg = /^[a-zA-Z\s]*$/;
    if (!reg.test(vals)) {
        $("#" + msg).html("<p style='color:red'>Please Enter valid  Name</p>");
        $("#" + btn).attr('disabled', true);
    } else {
        $("#" + msg).html("");
        $("#" + btn).attr('disabled', false);
    }

} */
</script>





  	
  	
  	
  	
  	<script>             		
       	function validateImage()
       	{
       var filename = document.getElementById("slider0").value;
      if (!filename) 
      {
        event.preventDefault();
        document.getElementById("sp_image3").innerHTML="Please upload file";
        document.getElementById("sp_image3").style.color="red";
        document.getElementById("button").disabled=true;
      } 
     else 
     {     
        document.getElementById("sp_image3").innerHTML="";
        document.getElementById("sp_image3").style.color="";
        document.getElementById("button").disabled=false;
          
       }    
   }
  	</script>



    <script>

function emailValidation(vals,msg,btn)
{

    let reg =   /\S+@\S+\.\S+/;
    if(vals === '')
    {
        $("#"+msg).empty(); 
        $("#"+btn).attr('disabled',false);  
        return false;
    }
    else if(!reg.test(vals))
    {
    $("#"+msg).html("<p style='color:red'>Please enter valid email ID</p>");
    $("#"+btn).attr('disabled',true);
    return false;  
     }
     else
     {
         $("#"+msg).html("");
         $("#"+btn).attr('disabled',false);
         return true;
     }
}
    </script>





