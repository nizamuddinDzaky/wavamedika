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
     </div>
     <div class="form-group row">
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Tgl Akhir:</label>
      <div class="col-lg-2 col-sm-12">
       <input class="form-control form-control-sm"
              name="tgl2" data-format="yyyy-mm-dd" type="date-formatted" id="end-date-input">
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
         <th data-options="field:'rekapitulasi'" width="75%">Rekapitulasi</th>
         <th data-options="field:'jml'" align="center" halign="center" width="25%">Jml</th>
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
         <th width="100" align="left" halign="center" data-options="field: 'mr_lama'">No. RM Lama</th>
         <th width="100" align="left" halign="center" data-options="field: 'no_mr'">No. RM Baru</th>
         <th width="200" align="left" halign="center" data-options="field: 'nama_lengkap'">Nama Pasien</th>
         <th width="225" align="left" halign="center" data-options="field: 'alasan'">Alasan</th>
         <th width="120" align="left" halign="center" data-options="field: 'keterangan'">Uraian</th>
         <th width="150" align="left" halign="center" data-options="field: 'operator'">Petugas</th>
         <th width="125" align="left" halign="center" data-options="field: 'tgl_input'">Tgl Input</th>
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

