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
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Unit:</label>
      <div class="col-lg-2 col-sm-12">
       <select name="unit" id="select_unit"
               class="select_2 form-control form-control-sm">
                <?php
                $reqUnit = GetResponseApi("/tpp_indeksmrs/unit", [], "get");
                foreach ($reqUnit->list as $key => $value) {
                 echo"<option value ='" . $value->nama_unit . "'>" . $value->u . "</option>";
                }
                ?>
       </select>
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Kunjungan:</label>
      <div class="col-lg-2 col-sm-12">
       <select name="kunjungan" id="select_kunjungan"
               class="select_2 form-control form-control-sm">
        <option value="_">Semua</option>
        <option value="Baru">Baru</option>
        <option value="Lama">Lama</option>
       </select>
      </div>
     </div>
     <div class="form-group row">
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Tgl Akhir:</label>
      <div class="col-lg-2 col-sm-12">
       <input class="form-control form-control-sm"
              name="tgl2" data-format="yyyy-mm-dd" type="date-formatted" id="end-date-input">
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Unit:</label>
      <div class="col-lg-2 col-sm-12">
       <select name="cara_masuk" id="select_cara_masuk"
               class="select_2 form-control form-control-sm">
                <?php
                $reqCm = GetResponseApi("/tpp_indeksmrs/caramasuk", [], "get");
                foreach ($reqCm->list as $key => $value) {
                 echo"<option value ='" . $value->cara_masuk . "'>" . $value->cm . "</option>";
                }
                ?>
       </select>
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Shift:</label>
      <div class="col-lg-2 col-sm-12">
       <select name="kunjungan" id="select_shift"
               class="select_2 form-control form-control-sm">
        <option value="_">Semua</option>
        <option value="Pagi">Pagi</option>
        <option value="Siang">Siang</option>
        <option value="Sore">Sore</option>
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
         <th data-options="field:'rekapitulasi'" align="left" halign="center" width="80%">Rekapitulasi</th>
         <th data-options="field:'jml'" align="right" halign="center" width="20%">Jml</th>
        </tr>
       </thead>
       <tfoot>
        <tr></tr>
       </tfoot>
      </table>
     </div>
     <div class="col-sm-12 col-md-8">
      <table title="<?php echo $title ?>"
             id="tabel_detail"
             class="easyui-datagrid"
             style="width: 100%; height:480px; margin-top:5px"
             toolbar="#toolbar"
             pagination="true"
             rownumbers="true"
             fitColumns="false"
             singleSelect="true"
             autoRowHeight="true"
             nowrap="false">
       <thead>
        <tr>
         <th width="100" align="left" halign="center" data-options="field: 'id_mrs'">No. MRS</th>
         <th width="200" align="left" halign="center" data-options="field: 'nama_lengkap'">Nama Lengkap</th>
         <th width="100" align="left" halign="center" data-options="field: 'no_mr'">No. MR</th>
         <th width="125" align="left" halign="center" data-options="field: 'tgl_mrs'">Tgl MRS</th>
         <th width="75" align="left" halign="center" data-options="field: 'jam_mrs'">Jam</th>
         <th width="75" align="center" halign="center" data-options="field: 'sex'">Sex</th>
         <th width="125" align="left" halign="center" data-options="field: 'umur'">Umur</th>
         <th width="100" align="left" halign="center" data-options="field: 'kecamatan'">Kecamatan</th>
         <th width="125" align="left" halign="center" data-options="field: 'unit'">Unit</th>
         <th width="125" align="left" halign="center" data-options="field: 'jatah_kelas'">Jatah Kelas</th>
         <th width="90" align="left" halign="center" data-options="field: 'cara_masuk'">Cara Masuk</th>
         <th width="125" align="left" halign="center" data-options="field: 'kunjungan'">Kunjungan</th>
         <th width="100" align="left" halign="center" data-options="field: 'pembayaran'">Pembayaran</th>
         <th width="150" align="left" halign="center" data-options="field: 'nama_perujuk'">Nama Perujuk</th>
         <th width="125" align="left" halign="center" data-options="field: 'alamat_perujuk'">Alamat Perujuk</th>
         <th width="150" align="left" halign="center" data-options="field: 'operator'">Operator</th>
         <th width="100" align="left" halign="center" data-options="field: 'shift'">Shift</th>
         <th width="125" align="left" halign="center" data-options="field: 'asuransi'">Asuransi</th>
         <th width="125" align="left" halign="center" data-options="field: 'instansi'">Instansi</th>
         <th width="125" align="left" halign="center" data-options="field: 'admission'">Admission</th>
         <th width="125" align="left" halign="center" data-options="field: 'tgl_krs'">Tgl KRS</th>
         <th width="75" align="left" halign="center" data-options="field: 'jam_krs'">Jam</th>
         <th width="150" align="left" halign="center" data-options="field: 'nama_kamar'">Kamar/Ruang</th>
         <th width="200" align="left" halign="center" data-options="field: 'dokter'">Dokter</th>
        </tr>
       </thead>
       <tfoot>
        <tr></tr>
       </tfoot>
      </table>

      <div id="toolbar">
       <a href="javascript:void(0)" id="btn-ubah" class="easyui-linkbutton" plain="true">
        <i class="la la-edit"></i>
        Edit
       </a>
       <a href="javascript:void(0)" id="btn-infopasien" class="easyui-linkbutton" plain="true">
        <i class="la la-info-circle"></i>
        Info Pasien
       </a>
       <a href="javascript:void(0)" id="btn-printkarcis" class="easyui-linkbutton" plain="true">
        <i class="la la-print"></i>
        Print Karcis
       </a>
       <a href="javascript:void(0)" id="btn-printsticker" class="easyui-linkbutton" plain="true">
        <i class="la la-print"></i>
        Print Sticker
       </a>
       <a href="javascript:void(0)" id="btn-printrekap" class="easyui-linkbutton" plain="true">
        <i class="la la-print"></i>
        Print Rekap
       </a>
       <a href="javascript:void(0)" id="btn-membercard" class="easyui-linkbutton" plain="true">
        <i class="la la-user"></i>
        Member Card
       </a>
      </div>

      <div id="winEditData"
           data-options="
           region:'center',
           headerCls:'judul-window'"
           data-title="Edit Data"
           class="panel-window"
           style="width:640px">
       <div class="kt-portlet">
        <div class="kt-portlet__body_win header-form">
         <form class="kt-form col-lg-12 header-form" id="formEdit">
          <div class="form-group row">
           <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
            Golongan :
           </label>
           <div class="col-lg-8 col-sm-12">
            <input name="golongan_px"
                   required
                   class="form-control form-control-sm" type="text" placeholder="Golongan">
           </div>
          </div>
          <hr>
          <div class="form-group row">
           <div class="col-lg-4 col-sm-12">
            <button type="button" id="btnSimpan"
                    class="form-control form-control-sm btn btn-sm btn-primary">
             <i class="la la-save"></i> Simpan
            </button>
           </div>
           <div class="col-lg-4 col-sm-12">
            <button type="button" onclick="javascript:$('#winEditData').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
             <i class="la la-times"></i> Batal
            </button>
           </div>
          </div>
         </form>
        </div>
       </div>
      </div>

      <div id="winInfoPasien"
           data-options="
           region:'center',
           headerCls:'judul-window'"
           data-title="Info Pasien"
           class="panel-window"
           style="width:640px">
       <div class="kt-portlet">
        <div class="kt-portlet__body_win header-form">
         <form class="kt-form col-lg-12 header-form" id="formInfoPasien">
          <div class="form-group row">
           <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
            Golongan :
           </label>
           <div class="col-lg-8 col-sm-12">
            <input name="golongan_px"
                   required
                   class="form-control form-control-sm" type="text" placeholder="Golongan">
           </div>
          </div>
          <hr>
          <div class="form-group row">
           <div class="col-lg-4 col-sm-12">
            <button type="button" id="btnPrintInfo"
                    class="form-control form-control-sm btn btn-sm btn-primary">
             <i class="la la-print"></i> Cetak
            </button>
           </div>
           <div class="col-lg-4 col-sm-12">
            <button type="button" onclick="javascript:$('#winInfoPasien').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
             <i class="la la-times"></i> Tutup
            </button>
           </div>
          </div>
         </form>
        </div>
       </div>
      </div>

      <div id="winPrintKarcis"
           data-options="
           region:'center',
           headerCls:'judul-window'"
           data-title="Cetak Karcis"
           class="panel-window"
           style="width:640px">
       <div class="kt-portlet">
        <div class="kt-portlet__body_win header-form">
         <form class="kt-form col-lg-12 header-form" id="formPrintKarcis">
          <div class="form-group row">
           <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
            Golongan :
           </label>
           <div class="col-lg-8 col-sm-12">
            <input name="golongan_px"
                   required
                   class="form-control form-control-sm" type="text" placeholder="Golongan">
           </div>
          </div>
          <hr>
          <div class="form-group row">
           <div class="col-lg-4 col-sm-12">
            <button type="button" id="btnPrintKarcis"
                    class="form-control form-control-sm btn btn-sm btn-primary">
             <i class="la la-print"></i> Cetak
            </button>
           </div>
           <div class="col-lg-4 col-sm-12">
            <button type="button" onclick="javascript:$('#winPrintKarcis').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
             <i class="la la-times"></i> Tutup
            </button>
           </div>
          </div>
         </form>
        </div>
       </div>
      </div>

      <div id="winPrintSticker"
           data-options="
           region:'center',
           headerCls:'judul-window'"
           data-title="Cetak Sticker"
           class="panel-window"
           style="width:640px">
       <div class="kt-portlet">
        <div class="kt-portlet__body_win header-form">
         <form class="kt-form col-lg-12 header-form" id="formPrintSticker">
          <div class="form-group row">
           <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
            Golongan :
           </label>
           <div class="col-lg-8 col-sm-12">
            <input name="golongan_px"
                   required
                   class="form-control form-control-sm" type="text" placeholder="Golongan">
           </div>
          </div>
          <hr>
          <div class="form-group row">
           <div class="col-lg-4 col-sm-12">
            <button type="button" id="btnPrintSticker"
                    class="form-control form-control-sm btn btn-sm btn-primary">
             <i class="la la-print"></i> Cetak
            </button>
           </div>
           <div class="col-lg-4 col-sm-12">
            <button type="button" onclick="javascript:$('#winPrintSticker').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
             <i class="la la-times"></i> Tutup
            </button>
           </div>
          </div>
         </form>
        </div>
       </div>
      </div>

      <div id="winMemberCard"
           data-options="
           region:'center',
           headerCls:'judul-window'"
           data-title="Member Card"
           class="panel-window"
           style="width:640px">
       <div class="kt-portlet">
        <div class="kt-portlet__body_win header-form">
         <form class="kt-form col-lg-12 header-form" id="formMemberCard">
          <div class="form-group row">
           <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
            Golongan :
           </label>
           <div class="col-lg-8 col-sm-12">
            <input name="golongan_px"
                   required
                   class="form-control form-control-sm" type="text" placeholder="Golongan">
           </div>
          </div>
          <hr>
          <div class="form-group row">
           <div class="col-lg-4 col-sm-12">
            <button type="button" id="btnPrintMemberCard"
                    class="form-control form-control-sm btn btn-sm btn-primary">
             <i class="la la-print"></i> Cetak
            </button>
           </div>
           <div class="col-lg-4 col-sm-12">
            <button type="button" onclick="javascript:$('#winMemberCard').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
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
</div>
<!-- end content -->

