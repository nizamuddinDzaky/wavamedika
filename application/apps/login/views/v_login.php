<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8" />
  <title><?php echo isset($title) ? $title : ''; ?> | TPP</title>
  <meta name="description" content="Latest updates and statistic charts">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--begin::Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

  <!--end::Fonts -->

  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
  <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">

  <!--begin::Page Vendors Styles(used by this page) -->
  <link href="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css'); ?>" rel="stylesheet" type="text/css" />

  <!--end::Page Vendors Styles -->

  <!--begin::Global Theme Styles(used by all pages) -->
  <link href="<?php echo base_url('assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/plugins/printJs/print.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet" type="text/css" />

  <!--end::Global Theme Styles -->

  <!--begin::Layout Skins(used by all pages) -->

  <!--end::Layout Skins -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/media/logos/favicon.ico'); ?>" />
  <style>

   html,
   body {
    height: 100%;
   }

   body {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
   }

   .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
   }
   .form-signin .checkbox {
    font-weight: 400;
   }


   .btn-info {
    color: #fff;
    background-color: #19a099;
    border-color: #29b0a9; /*set the color you want here*/
   }
   .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open>.dropdown-toggle.btn-info {
    color: #fff;
    background-color: #00b3db;
    border-color: #29b0a9; /*set the color you want here*/
   }
  </style>
 </head>

 <body>
  <div class="form-signin text-center">
   <img src="<?php echo base_url('assets/img/logo.png'); ?>" width="180">
   <div style="font-size:32px; color:#19a099;">Mersi<span style="color:#FFA500;">Hospital</span></div>
   <div style="font-size:10px; margin-top:-8px; margin-bottom:8px;">Version 1.1</div>
   <p class="text-center text-white">Gunakan NIK dan password<br />yang sudah terdaftar. ini ada pergantian</p>
   <label for="username" class="sr-only">NIK</label>
   <input type="text" id="username" class="form-control mb-1" placeholder="NIK" name="username" maxlength="8" required autofocus>
   <label for="password" class="sr-only">Password</label>
   <input type="password" id="password" class="form-control" placeholder="Password" name="password" maxlength="4" required>
   <br />
   <button class="btn btn-info btn-block" id="btn-login">Login</button>
   <p class="mt-5 mb-3 text-white">Developed by <br />SIMRS Dept. Wava Husada Hospital<br />&copy; 2019 All Rights Reserved</p>
  </div>

  <div class="modal fade" id="mo1">
   <div class="modal-dialog">
    <div class="modal-content panel-success">
     <div class="modal-header bg-danger text-white">
      <div class="modal-title" id="mo1-title">Setting Cetak</div>
      <button type="button" class="btn btn-sm" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
      </button>
     </div>
     <div class="modal-body" id="mo1-body">
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" >OK</button>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>
<?php $this->load->view('template/footerscript'); ?>

<script>
 $(document).ready(function () {

  $('#username, #password').on("keyup", function (e) {
   if (e.keyCode == 13)
   {
    $("#btn-login").trigger("click");
   }
  });

  $("#btn-login").on("click", async function () {
   var us = $("#username").val();
   var ps = $("#password").val();
   if (us == "") {
    swal.fire('Kesalahan!', 'Masukkan NIK Anda terlebih dahulu', 'error');
   } else if (ps == "") {
    swal.fire('Kesalahan!', 'Masukkan Password Anda terlebih dahulu', 'error');

   } else {
       var body = {
           username: us,
           password: ps
       };

       $.ajax({
          url : "<?php echo base_url("login/Login/ceklogin"); ?>",
          type: "POST",
          dataType: 'json',
          data:body,
          success:function(data, textStatus, jqXHR){
            console.log(data);
            if (data.status_code==200)
            {
              sessionStorage.setItem('token', data.token);
              window.location.href = "<?php echo base_url('dashboard'); ?>";
            }
            else
            {
              swal.fire('Kesalahan!', data.message, 'error');
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('error','Error, Something goes wrong');
          },
          complete: function(){
          }
      });

       // await fetch(new Request('http://36.92.178.100:9000/auth/login', {
       //     headers: header,
       //     body: JSON.stringify(body),
       //     method:'POST'
       // })).then( async function(resp) {
       //     if (resp.status === 200 || resp.status === 201) {
       //         var json = await resp.json();
       //         if(json && json.metadata && json.metadata.err_code === 1) {
       //             swal.fire('Kesalahan!', json.metadata.message, 'error');
       //         } else {
       //             if(json && json.list &&Array.isArray(json.list) && json.list.length > 0) {
       //                 var userObject = {
       //                     user: JSON.stringify(json.list[0])
       //                 }
       //                 localStorage.setItem('user_login', JSON.stringify(userObject));
       //                 window.location.href = "<?php echo base_url('dashboard'); ?>";
       //             }

       //         }
       //     }
       // }).catch(function(e) {
       //     swal.fire('Kesalahan!', e, 'error');
       // })
   }

  });
 });

</script>