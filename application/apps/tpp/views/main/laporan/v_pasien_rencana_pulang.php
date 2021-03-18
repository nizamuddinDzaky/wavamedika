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
    <!--Panel Pencarian End-->

   </div>
   <!-- <br> -->
   <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
    <div class="table-custom">
     Per <?= date_indo('l, j F Y', date('d-m-Y')) ?>
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
        <th field="no_mr" width="150">No. MR</th>
        <th field="tgl_mrs" width="150">Tgl. MRS</th>
        <th field="nama_lengkap" width="200">Nama Lengkap</th>
        <th field="umur" width="100">Umur</th>
        <th field="sex" width="100">Sex</th>
        <th field="kecamatan" width="200">Kecamatan</th>
        <th field="kamar" width="200">Kamar</th>
        <th field="status" width="150">Status</th>
        <th field="kelas" width="150">Kelas</th>
        <th field="nama_keluarga" width="200">Nama Keluarga</th>
        <th field="nama_perujuk" width="200">Nama Perujuk</th>
        <th field="asuransi" width="150">Asuransi</th>
        <th field="instansi" width="150">Instansi</th>
        <th field="admission" width="150">Admission</th>
        <th field="catatn_diagnosa" width="200">Catatan Diagnosa</th>
        <th field="icd" width="150">ICD</th>
        <th field="nama_icd" width="150">Nama ICD</th>
        <th field="unit" width="200">Unit</th>
        <th field="ri_rj" width="150">RI/RJ</th>
        <th field="karyawan" width="150">Karyawan</th>
        <th field="penyakit" width="150">Penyakit</th>
        <th field="rencana_pulang" width="150">Rencana Pulang</th>
        <th field="id_mr" width="150">ID MR</th>
        <th field="jatah_kelas" width="150">Jatah Kelas</th>
        <th field="id_mrs" width="150">ID MRS</th>

       </tr>
      </thead>
     </table>

    </div>
   </div>
  </div>
 </div>
</div>
<!-- end content -->

