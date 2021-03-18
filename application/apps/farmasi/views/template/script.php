<script>
  var KTAppOptions = {
    "colors": {
      "state": {
        "brand": "#366cf3",
        "light": "#ffffff",
        "dark": "#282a3c",
        "primary": "#5867dd",
        "success": "#34bfa3",
        "info": "#36a3f7",
        "warning": "#ffb822",
        "danger": "#fd3995"
      },
      "base": {
        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
      }
    }
  };
</script>
<!-- end::Global Config -->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.9.1.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/tabs.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/tabs-jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/tabs-ajax.min.js');?>"></script>
<!--begin::Global Theme Bundle(used by all pages) -->
<script src="<?php echo base_url('assets/plugins/global/plugins.bundle.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/scripts.bundle.js');?>" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/easyui/datagrid-detailview.js');?>"></script>
<!-- <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script> -->

<!-- message-script -->
<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/adminlte.min.js');?>"></script> -->


<!-- <script type="text/javascript" src='<?php echo base_url('assets/plugins/swal-forms/live-demo/sweet-alert.js');?>'></script>
<script type="text/javascript" src='<?php echo base_url('assets/plugins/swal-forms/swal-forms.js');?>'></script> -->
<!--end::Global Theme Bundle -->
<!-- start script select 2 -->
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->

<!--begin::Page Vendors(used by this page) -->
<script src="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/accounting.min.js');?>" type="text/javascript"></script>
<!--<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>-->
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="<?php echo base_url('assets/js/custom.global.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/utils.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/lodash.min.js');?>" type="text/javascript"></script>
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script> -->

<script type="text/javascript">
  $(function(){
    $(".preloader").fadeOut(1300);
    // setInterval(function(){
    //   load_notif()
    // },5000);
  })

  function inputStokOpname(){
    // body...
    // $('#win-input_stok_opname').window('open');
  }

  function load_notif(){
    $.ajax({
        url : "<?php echo base_url("farmasi/mailbox/notif"); ?>",
        type: "POST",
        dataType: 'json',
        beforeSend: function (){               
        },
        success:function(data, textStatus, jqXHR){
          // console.log(data);
          $('#tot-message').text(data.new_msg.count);
          $('#tot-notif').text(data.pending_approval.count);
          $('#badge-inbox').text(data.new_msg.count);
          set_body_message(data)
          set_body_approval(data)
            // $("#cmb-payment").select2({ data: data });
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','something goes wrong');
        },
        complete: function(){
        }
    });
  }

  function set_body_message(data){
    var str = '<div style="margin-left: 20px;">You have ' + //menambahkan spasi di you have
                '<span class="kt-font-bold">'+ data.new_msg.count +' New</span> Messages' +
                '<a href="<?php echo base_url('farmasi/mailbox')?>" class="pull-right" style="margin-right: 20px;">view all</a>' +
              '</div>'
              '<div class="dropdown-divider"></div>';
    for(var i = 0 ; i < data.new_msg.data.length; i++){
      str += '<a href="#" class="kt-notification__item" onclick="triggerInbox(\''+data.new_msg.data[i].msg_id+'\')">'+
                '<div class="kt-notification__item-icon">' +
                  '<img src="'+data.new_msg.data[i].from_user_pic+'" alt="User Avatar" class="img-size-50 mr-3 img-circle kt-font-success">'+
                '</div>'+
                '<div class="kt-notification__item-details">'+
                  '<div class="row justify-content-between kt-position-tittle">'+
                    '<p class="kt-notification__item-title kt-font-bold"> '+ data.new_msg.data[i].from_user +' </p>'+
                    '<span class="kt-notification__item-time kt-font-sm pull-right">'+ appGridDateTimeFormatter(data.new_msg.data[i].msg_date) +' </span>'+
                  '</div>'+
                  '<span class="kt-message kt-font-sm"> '+data.new_msg.data[i].subject+'</span>'+
                '</div>'+
              '</a>'
    }
    $('#div-notif-message').html(str)
  }

  function set_body_approval(data){
    var str = '<div style="margin-left: 20px;">You have ' + //menambahkan spasi di you have
                '<span class="kt-font-bold">'+data.pending_approval.count+' pending</span> task' +
                '<a href="<?php echo base_url('farmasi/mailbox')?>" class="pull-right" style="margin-right: 20px;" >view all</a>' +
              '</div>' +
              '<div class="dropdown-divider"></div>' ;
    for(var i = 0 ; i < data.pending_approval.data.length; i++){
      str += '<a href="#" class="kt-notification__item" onclick="triggerApproval(\''+data.new_msg.data[i].msg_id+'\')">'+
                '<div class="kt-notification__item-icon">' +
                  '<img src="'+data.pending_approval.data[i].from_user_pic+'" alt="User Avatar" class="img-size-50 mr-3 img-circle kt-font-success">'+
                '</div>'+
                '<div class="kt-notification__item-details">'+
                  '<div class="row justify-content-between kt-position-tittle">'+
                    '<p class="kt-notification__item-title kt-font-bold"> '+ data.pending_approval.data[i].from_user +' </p>'+
                    '<span class="kt-notification__item-time kt-font-sm pull-right">'+ appGridDateTimeFormatter(data.pending_approval.data[i].msg_date) +' </span>'+
                  '</div>'+
                  '<span class="kt-message kt-font-sm"> '+data.pending_approval.data[i].subject+'</span>'+
                '</div>'+
              '</a>'
    }
    $('#div-notif-approval').html(str)
  }
</script>

<?php
if (isset($js)) {
    $this->load->view('js/'.$js);
}
?>
<!--end::Page Scripts -->