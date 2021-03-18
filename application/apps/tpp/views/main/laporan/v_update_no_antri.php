<style>

</style>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
 <div class="kt-container ">
  <div class="kt-subheader__main">
   <h3 class="kt-subheader__title"><?php echo isset($title) ? $title : "" ?></h3>
   <div class="kt-subheader__breadcrumbs">
    <a href="#" class="kt-subheader__breadcrumbs-home">
     <i class="flaticon2-shelter"></i>
    </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link">Laporan</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="" class="kt-subheader__breadcrumbs-link"><?php echo isset($title) ? $title : "" ?></a>
   </div>
  </div>
  <!-- <div class="kt-subheader__toolbar">
      <div class="kt-subheader__wrapper">
          <a id="export-pdf" target="_blank" class="btn kt-subheader__btn-secondary">
              Export PDF
          </a>
          <a id="print" class="btn kt-subheader__btn-secondary">
              Print
          </a>
      </div>
  </div> -->
 </div>
</div>
<!-- end:: Subheader -->
<!-- begin:: Content -->
<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
 <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
  <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
   <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">

    <!--Panel Pencarian Start-->
    <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header-filter">
     <div class="form-group row">
      <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
       <select name="dokter" id="select_dokter-antri"
               class="select_2 form-control form-control-sm">
                <?php
                $Request = GetResponseApi("/tpp_antridokter/dokter", [], "get");
                $data    = "";
                echo "<option value=''> -- Pilih Dokter</option>";
                foreach ($Request->list as $key => $value) {
                 echo"<option value ='" . $value->nl . "'>" . $value->nama . "</option>";
                }
                ?>
       </select>
      </div>

      <div class="col-lg-2 col-md-2 col-sm-12 kt-margin-t-10-mobile">
       <button type="button" class="btn btn-sm btn-primary" plain="true" id="btnFilter">
        <i class="la la-filter"></i>
        Filter Data
       </button>
      </div>
     </div>
     <hr>
    </form>
    <!--Panel Pencarian End-->

   </div>
   <!-- <br> -->
   <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
    <div class="table-custom">

     <table title="Data <?php echo $title ?>"
            id="dgs"
            class="easyui-datagrid"
            style="width: 100%; height:480px; margin-top:5px"
            toolbar="#toolbar"
            pagination="false"
            idField="id"
            rownumbers="true"
            fitColumns="false"
            singleSelect="true"
            autoRowHeight="true"
            nowrap="false">
      <thead>
       <tr style="text-align: center;">
        <th field="tgl_mrs" width="200">Nomor Antri</th>
        <th field="golongan" width="200">Nomor MR</th>
        <th field="id_mrs" width="300">Nama Pasien</th>
        <th field="nama_lengkap" width="200">Tanggal MRS</th>
       </tr>
      </thead>
     </table>

     <div id="toolbar">
      <a href="javascript:void(0)" id="btn-ubahnoantri" class="easyui-linkbutton" plain="true">
       <i class="la la-edit"></i>
       Ubah No. Antri
      </a>

     </div>

     <div id="winUbahANoAntri" data-title="Ubah Nomor Antri"
          class="panel-window" style="width:640px;">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form" id="FormUpdateNoAntri">
         <input type="hidden" id="dokter" name="dokter">
         <input type="hidden" id="id_mrs" name="id_mrs">
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
           Dokter :
          </label>
          <div class="col-lg-8 col-sm-12">
           <input id="nama_dokter" readonly
                  class="nama_dokter form-control form-control-sm" type="text">
          </div>
         </div>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
           Nomor Antri :
          </label>
          <div class="col-lg-8 col-sm-12">
           <input id="no_antri" readonly
                  class="no_antri form-control form-control-sm" type="text">
          </div>
         </div>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
           Nomor Antri Baru :
          </label>
          <div class="col-lg-8 col-sm-12">
           <input id="no_antri_baru" name="baru"
                  class="form-control form-control-sm" type="text">
          </div>
         </div>
         <hr>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
          </label>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="javascript:$('#editData').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
            <i class="la la-times"></i> Batal
           </button>
          </div>
          <div class="col-lg-4 col-sm-12">
           <button type="button" id="btnUpdate" class="form-control form-control-sm btn btn-sm btn-primary">
            <i class="la la-save"></i> Simpan
           </button>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>

    </div>
   </div>
  </div>
 </div>
</div>
<!-- end content -->

