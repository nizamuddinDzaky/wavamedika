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
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Tgl Awal:</label>
      <div class="col-lg-2 col-sm-12">
       <input class="form-control form-control-sm"
              name="tgl1" data-format="yyyy-mm-dd" type="date-formatted" id="start-date-input">
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Ruang:</label>
      <div class="col-lg-2 col-sm-12">
       <select name="ruang" id="select_ruang"
               class="select_2 form-control form-control-sm">
                <?php
                $Request = GetResponseApi("/tpp_lapregantripoli/ruang", [], "get");
                $data    = "";
                foreach ($Request->list as $key => $value) {
                 echo"<option value ='" . $value->km . "'>" . $value->nama_kamar . "</option>";
                }
                ?>
       </select>
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Dokter:</label>
      <div class="col-lg-2 col-sm-12">
       <select name="dokter" id="select_dokter"
               class="select_2 form-control form-control-sm">
                <?php
                $Request = GetResponseApi("/tpp_lapregantripoli/dokter", [], "get");
                $data    = "";
                foreach ($Request->list as $key => $value) {
                 echo"<option value ='" . $value->nl . "'>" . $value->nama_lengkap . "</option>";
                }
                ?>
       </select>
      </div>
     </div>
     <div class="form-group row">
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Tgl Akhir:</label>
      <div class="col-lg-2 col-sm-12">
       <input class="form-control form-control-sm"
              name="tgl2" data-format="yyyy-mm-dd" type="date-formatted" id="start-date-input">
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Status:</label>
      <div class="col-lg-2 col-sm-12">
       <select name="status"
               class="form-control form-control-sm" id="select_shift">
        <option value="_">Semua</option>
        <option value="V">Lengkap</option>
        <option value="X">Tidak Lengkap</option>
       </select>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 kt-margin-t-10-mobile">
       <button type="button" class="btn btn-sm btn-primary" plain="true" id="btnFilter">
        <i class="la la-filter"></i>
        Rekap
       </button>
      </div>
     </div>
     <hr>
    </form>
    <!--Panel Pencarian End-->

   </div>
   <!-- <br> -->
   <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
    <div class="table-custom row">
     <div class="col-sm-12 col-md-4" style="margin-bottom: 10px">
      <table id="tabel_rekap" height="500" title="Rekapitulasi" class="easyui-datagrid" rownumbers="true" singleSelect="true">
       <thead>
        <tr>
         <th data-options="field:'rekapitulasi'" width="70%">Rekapitulasi</th>
         <th data-options="field:'jml'" width="10%">Jml</th>
         <th data-options="field:'b'" width="10%">B</th>
         <th data-options="field:'l'" width="10%">L</th>
        </tr>
       </thead>
       <tfoot>
        <tr></tr>
       </tfoot>
      </table>
     </div>
     <div class="col-sm-12 col-md-8">
      <table id="tabel_detail" height="500" title="<?= $title ?>" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" pageSize="10">
       <thead>
        <tr>
         <th width="50" align="center" halign="center"  data-options="field: 'status'">Status</th>
         <th width="125" align="left" halign="center"  data-options="field: 'tgl_masuk'">Tanggal</th>
         <th width="100" align="left" halign="center"  data-options="field: 'id_mrs'">No. MRS</th>
         <th width="100" align="left" halign="center"  data-options="field: 'no_mr'">No. RM</th>
         <th width="200" align="left" halign="center"  data-options="field: 'nama_lengkap'">Nama Pasien</th>
         <th width="75" align="center" halign="center"data-options="field: 'sex'">Sex</th>
         <th width="150" align="left" halign="center" data-options="field: 'umur'">Umur</th>
         <th width="150" align="left" halign="center" data-options="field: 'alamat'">Alamat</th>
         <th width="100" align="left" halign="center" data-options="field: 'cara_masuk'">Cara Masuk</th>
         <th width="100" align="left" halign="center" data-options="field: 'kunjungan'">Kunj. MRS</th>
         <th width="120" align="left" halign="center" data-options="field: 'ruang'">Ruang</th>
         <th width="200" align="left" halign="center" data-options="field: 'dokter'">Dokter</th>
        </tr>
       </thead>
       <tfoot>
        <tr></tr>
       </tfoot>
      </table>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
<!-- end content -->

