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
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Dokter:</label>
      <div class="col-lg-2 col-sm-12">
       <select name="dokter" id="select_dokter"
               class="select_2 form-control form-control-sm">
                <?php
                $RequestA = GetResponseApi("/tpp_lapregantripoli/dokter", [], "get");
                foreach ($RequestA->list as $key => $value) {
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
              name="tgl2" data-format="yyyy-mm-dd" type="date-formatted" id="end-date-input">
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Ruang:</label>
      <div class="col-lg-2 col-sm-12">
       <select name="ruang" id="select_ruang"
               class="select_2 form-control form-control-sm">
                <?php
                $RequestB = GetResponseApi("/tpp_lapregantripoli/ruang", [], "get");
                foreach ($RequestB->list as $key => $value) {
                 echo"<option value ='" . $value->km . "'>" . $value->nama_kamar . "</option>";
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
            pagination="true"
            idField="id"
            rownumbers="true"
            fitColumns="false"
            singleSelect="true"
            autoRowHeight="true"
            nowrap="false">
      <thead>
       <tr style="text-align: center;">
        <th align="center" field="no_antri" width="100">Nomor Antri</th>
        <th field="no_mr" width="100">Nomor MR</th>
        <th field="nama_lengkap" width="300">Nama Pasien</th>
        <th field="umur" width="100">Umur</th>
        <th field="alamat" width="300">Alamat</th>
        <th field="kecamatan" width="200">Kecamatan</th>
        <th field="telepon" width="200">No. Telp</th>
        <th field="poli" width="200">Poliklinik</th>
        <th field="dokter" width="300">Dokter</th>
        <th field="tgl_rencana" width="200">Tgl. Kontrol</th>
        <th field="hari" width="200">Hari</th>
        <th field="pembayaran" width="150">Pembayaran</th>
        <th field="asal_unit" width="150">Asal Unit</th>
        <th field="operator" width="200">Operator</th>
       </tr>
      </thead>
     </table>

     <div id="toolbar">
      <a href="javascript:void(0)" id="btn-prosesmrs" class="easyui-linkbutton" plain="true">
       <i class="la la-edit"></i>
       Proses MRS
      </a>
     </div>

     <div id="winProsesMrs"
          data-options="
          region:'center',
          headerCls:'judul-window'"
          data-title="Proses MRS"
          class="panel-window"
          style="width:80%">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form" id="formCariPasien">
         <div class="row">
          <div class="col-8">
           <div class="form-group row">
            <!--          <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
                       Cari Pasien:</label>-->
            <div class="col-lg-4 col-sm-12">
             <input class="form-control form-control-sm"
                    placeholder="Nomor MRS (Billing)"
                    name="id_mrs"
                    type="text" readonly
                    id="txt_id-mrs">
            </div>
            <button type="button"
                    class="btn btn-primary btn-sm col-lg-2 col-sm-12 winCariPasien">
             <i class="la la-search"></i> Cari Pasien
            </button>
           </div>
          </div>
          <div class="col-4">
           <h5 class="tgl_sekarang text-center"></h5>
          </div>
         </div>
        </form>
        <hr>
        <form class="kt-form col-lg-12 header-form" id="formProsesMrs">
         <div class="row">
          <div class="col-lg-4 col-sm-12 order-lg-1 order-xs-2">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Nomor RM:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    placeholder="Nomor RM"
                    name="no_rm"
                    type="text"
                    id="txt_no-rm">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->

            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Tanggal Masuk:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    value="<?= date('d/m/Y') ?>"
                    name="tgl_mrs"
                    type="text"
                    id="txt_tgl-mrs">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->

            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Jam Masuk:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    value="<?= date('H:i') ?>"
                    name="jam_mrs"
                    type="text"
                    id="txt_jam-mrs">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->

           </div>
           <div class="col-lg-8 col-sm-12 order-lg-2 order-xs-1">

           </div>
          </div>
         </div>
         <hr>
         <div class="row">
          <div class="col-lg-4 col-sm-12 order-lg-1 order-xs-2">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Kunjungan:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    placeholder="Nomor RM"
                    name="no_rm"
                    type="text"
                    id="txt_no-rm">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->

            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Unit:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    value="<?= date('d/m/Y') ?>"
                    name="tgl_mrs"
                    type="text"
                    id="txt_tgl-mrs">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->

            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Kamar/Ruang:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    value="<?= date('H:i') ?>"
                    name="jam_mrs"
                    type="text"
                    id="txt_jam-mrs">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Nama Dokter:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    value="<?= date('H:i') ?>"
                    name="jam_mrs"
                    type="text"
                    id="txt_jam-mrs">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Cara Masuk:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    value="<?= date('H:i') ?>"
                    name="jam_mrs"
                    type="text"
                    id="txt_jam-mrs">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Perujuk:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    value="<?= date('H:i') ?>"
                    name="jam_mrs"
                    type="text"
                    id="txt_jam-mrs">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->

           </div>
           <div class="col-lg-8 col-sm-12 order-lg-2 order-xs-1">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Nama Perujuk:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm"
                    value="<?= date('H:i') ?>"
                    name="jam_mrs"
                    type="text"
                    id="txt_jam-mrs">
             <input type="hidden" name="id_mr" class="id_mr">
            </div>
            <!--Input End-->
           </div>
          </div>
         </div>
         <hr>
         <div class="form-group row">
          <div class="col-lg-4 col-sm-12">
           <button type="button" id="btnSimpan"
                   class="form-control form-control-sm btn btn-sm btn-primary">
            <i class="la la-save"></i> Simpan MRS
           </button>
          </div>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="javascript:$('#winProsesMrs').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
            <i class="la la-times"></i> Tutup
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

