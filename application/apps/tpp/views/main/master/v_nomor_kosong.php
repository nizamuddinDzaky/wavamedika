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
    <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
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
     <table title="Data <?= $title ?>"
            id="dgs"
            class="easyui-datagrid"
            style="width: 100%; height:480px; margin-top:5px"
            toolbar="#toolbar"
            pagination="true"
            idField="id_antrian"
            rownumbers="true"
            fitColumns="false"
            singleSelect="true"
            autoRowHeight="true"
            nowrap="false">
      <thead>
       <tr>
        <th field="dokter" width="auto">Dokter</th>
        <th field="antri" align="center" width="auto">Antrian</th>
       </tr>
      </thead>
     </table>

     <div id="toolbar">
      <a href="javascript:void(0)" id="btn-tambah" class="easyui-linkbutton" plain="true">
       <i class="la la-plus"></i>
       Tambah
      </a>
      <a href="javascript:void(0)" id="btn-ubah" class="easyui-linkbutton" plain="true">
       <i class="flaticon-edit-1"></i>
       Edit
      </a>
      <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton" plain="true">
       <i class="flaticon2-trash"></i>
       Hapus
      </a>
     </div>

     <div id="tambahData" data-title="Tambah Nomor Antrian"
          class="panel-window" style="width:640px;">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form" id="formTambah">

         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
           Dokter :
          </label>
          <div class="col-lg-8 col-sm-12">
           <select name="dokter" id="sel_dokter" class="select_2 form-control form-control-sm">

           </select>
          </div>
         </div>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
           No. Antrian :
          </label>
          <div class="col-lg-8 col-sm-12">
           <input name="antri"
                  required
                  class="form-control form-control-sm" type="text" placeholder="Nomor Antri">
          </div>
         </div>

         <hr>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
          </label>
          <div class="col-lg-4 col-sm-12">
           <button type="button"
                   onclick="javascript:$('#tambahData').window('close').find(':input').val('').trigger('change')"
                   class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
            <i class="la la-times"></i> Batal
           </button>
          </div>
          <div class="col-lg-4 col-sm-12">
           <button type="button" id="btnSimpan"
                   class="form-control form-control-sm btn btn-sm btn-primary">
            <i class="la la-save"></i> Simpan
           </button>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>

     <div id="editData" data-title="Edit Nomor Antrian"
          class="panel-window" style="width:640px;">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form" id="formEdit">
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
           Dokter :
          </label>
          <div class="col-lg-8 col-sm-12">
           <select name="dokter" id="sel_dokter" class="select_2 form-control form-control-sm">
            <?php echo $dataDokter ?>
           </select>
          </div>
         </div>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
           No Antrian :
          </label>
          <div class="col-lg-8 col-sm-12">
           <input name="antri" id="edit_antrian"
                  required
                  class="form-control form-control-sm"
                  type="text" placeholder="Nomor Antri">
          </div>
         </div>
         <hr>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
          </label>
          <div class="col-lg-4 col-sm-12">
           <button type="button"
                   onclick="javascript:$('#editData').window('close').find(':input').val('').trigger('change')"
                   class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
            <i class="la la-times"></i> Batal
           </button>
          </div>
          <div class="col-lg-4 col-sm-12">
           <button type="button" id="btnUpdate"
                   class="form-control form-control-sm btn btn-sm btn-primary">
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
<!-- end content