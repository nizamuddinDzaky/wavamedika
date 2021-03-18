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
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Tgl Awal :</label>
      <div class="col-lg-2 col-sm-12">
       <input class="form-control form-control-sm"
              name="tgl1" data-format="yyyy-mm-dd" type="date-formatted" id="start-date-input">
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Jenis :</label>
      <div class="col-lg-2 col-sm-12">
       <select name="jenis" id="select_jenis"
               class="select_2 form-control form-control-sm">
                <?php
                $RequestA = GetResponseApi("/tpp_lapregpesankamar/jenis", [], "get");
                foreach ($RequestA->list as $key => $value) {
                 echo"<option value ='" . $value->km . "'>" . $value->j . "</option>";
                }
                ?>
       </select>
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Status :</label>
      <div class="col-lg-2 col-sm-12">
       <select name="aktif" id="input" class="form-control">
        <option value="1">Aktif</option>
        <option value="0">Tidak Aktif</option>
       </select>
      </div>
     </div>
     <div class="form-group row">
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Tgl Akhir :</label>
      <div class="col-lg-2 col-sm-12">
       <input class="form-control form-control-sm"
              name="tgl2" data-format="yyyy-mm-dd" type="date-formatted" id="end-date-input">
      </div>
      <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Kelas :</label>
      <div class="col-lg-2 col-sm-12">
       <select name="kelas" id="select_kelas"
               class="select_2 form-control form-control-sm">
                <?php
                $RequestB = GetResponseApi("/tpp_lapregpesankamar/kelas", [], "get");
                $data     = "";
                foreach ($RequestB->list as $key => $value) {
                 echo"<option value ='" . $value->nl . "'>" . $value->n . "</option>";
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
            idField="id_mr"
            rownumbers="true"
            fitColumns="false"
            singleSelect="true"
            autoRowHeight="true"
            nowrap="false">
      <thead>
       <tr style="text-align: center;">
        <th field="jenis" width="100">Jenis</th>
        <th field="kelas" width="150">Kelas</th>
        <th field="no_antriaktif" width="100">No. Antri</th>
        <th field="tgl_pesan" width="100">Tgl. Pesan</th>
        <th field="jam" width="80">Jam</th>
        <th field="no_mr" width="100">No. RM</th>
        <th field="nama_lengkap" width="200">Nama Pasien</th>
        <th field="id_mrs" width="100">No. MRS</th>
        <th field="keterangan" width="200">Keterangan</th>
        <th field="kamar_skr" width="100">Kamar Sekarang</th>
        <th field="nama_kamar" width="100">Masuk ke Kamar</th>
        <th field="telepon1" width="100">No. Telp #1</th>
        <th field="telepon2" width="100">No. Telp #2</th>
       </tr>
      </thead>
     </table>

     <div id="toolbar">
      <a href="javascript:void(0)" id="btn-catatan" class="easyui-linkbutton" plain="true">
       <i class="la la-paperclip"></i>
       Catatan
      </a>
      <a href="javascript:void(0)" id="btn-indexpx" class="easyui-linkbutton" plain="true">
       <i class="la la-info-circle"></i>
       Index Pasien
      </a>
      <a href="javascript:void(0)" id="btn-masukkamar" class="easyui-linkbutton" plain="true">
       <i class="la la-arrow-right"></i>
       Masuk Kamar
      </a>
     </div>

     <div id="winCatatan"
          data-options="
          region:'center',
          headerCls:'judul-window'"
          data-title="Catatan"
          class="panel-window"
          style="width:800px">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="formCatatan">
         <div class="row">
          <div class="col-lg-6 col-sm-12 order-lg-1 order-xs-2">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Dari Kamar:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm nama_kamar"
                    readonly
                    type="text">
            </div>
            <!--Input End-->
            <br>
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Pasien Jenis Kamar:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm jenis"
                    readonly
                    type="text">
            </div>
            <!--Input End-->

           </div>
          </div>
          <div class="col-lg-6 col-sm-12 order-lg-1 order-xs-2">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Dari Kelas:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm dari_kelas"
                    readonly
                    type="text">
            </div>
            <!--Input End-->
            <br>
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Kelas Jenis:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm kelas_jenis"
                    readonly
                    type="text">
            </div>
            <!--Input End-->
           </div>
          </div>
         </div>
         <hr>
         <div class="row">
          <div class="col-sm-6">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             No. Telp Yg Bisa Dihubungi:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm telepon"
                    name="telepon" readonly
                    type="text">
            </div>
           </div>
          </div>
          <div class="col-sm-6">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             *Tambahan:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm telepon2"
                    name="telepon2" readonly
                    type="text">
            </div>
           </div>
          </div>

         </div>
         <div class="row">
          <div class="col-sm-6">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             No. Antrian:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm no_antriaktif"
                    readonly
                    type="text">
            </div>
           </div>
          </div>
         </div>
         <div class="row">
          <div class="col-sm-12">
           <div class="form-group row">
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Keterangan:</label>
           </div>
          </div>
         </div>
         <div class="row">
          <div class="col-sm-12">
           <div class="form-group row">
            <div class="col-lg-12 col-sm-12">
             <textarea name="keterangan" rows="6"
                       class="form-control form-control-sm"></textarea>
            </div>
           </div>
          </div>
         </div>
         <hr>
         <div class="form-group row">
          <div class="col-lg-4 col-sm-12">
           <button type="button" id="btnSimpanCatatan" onclick="updateCatatan()"
                   class="form-control form-control-sm btn btn-sm btn-primary">
            <i class="la la-save"></i> Simpan
           </button>
          </div>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="javascript:$('#winCatatan').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
            <i class="la la-times"></i> Tutup
           </button>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>

     <div id="winIndexPx"
          data-options="
          region:'center',
          headerCls:'judul-window'"
          data-title="Index Pasien"
          class="panel-window"
          style="width:80%; height: 80%">
      <div class="kt-portlet">
       <div class="kt-portlet__body header-form">
        <div class="row">
         <div class="col-sm-12 col-md-12" style="overflow-x: auto">
          <center class='before-loading'>
           <span class="la la-refresh la-spin" style="font-size: 40px"></span>
          </center>
          <div class="panel panel-default after-loading" id="index-print">
           <div class="panel-heading">
            <table class="table table-bordered" border="1" width="100%">
             <tbody>
              <tr>
               <td width="20%">NOMOR RM</td>
               <td class="no_mr"></td>
              </tr>
             </tbody>
            </table>
           </div>
           <table border="0">
            <tr>
             <td>&nbsp;</td>
            </tr>
           </table>
           <!-- Table -->
           <table class="table table-bordered table-hover" cellspacing="5px" border="1" width="100%">
            <tbody>
             <tr>
              <td width="20%">Jenis Pasien</td>
              <td colspan="7" class="jenis_pasien"></td>
             </tr>
             <tr>
              <td width="20%">Nama Pasien</td>
              <td colspan="7" class="nama_lengkap"></td>
             </tr>
             <tr>
              <td width="20%">No KTP/SIM</td>
              <td colspan="7" class="no_ktp"></td>
             </tr>

             <tr>
              <td>Sex / Umur</td>
              <td class="umur"></td>
              <td>Gol.Darah :</td>
              <td class="darah"></td>
              <td>Gelar : </td>
              <td class="gelar"></td>
              <td>Tgl Daftar : </td>
              <td class="tgl_daftar"></td>
             </tr>
             <tr>
              <td width="20%">Jenis Pasien</td>
              <td colspan="7" class="jenis_pasien"></td>
             </tr>
             <tr>
              <td width="20%">Alamat</td>
              <td colspan="7" class="alamat"></td>
             </tr>

             <tr>
              <td width="20%">Nomor Telepon</td>
              <td colspan="2" class="telepon"></td>
              <td colspan="2">Handphone</td>
              <td colspan="3" class="hp"></td>
             </tr>
             <tr>
              <td width="20%">Agama</td>
              <td colspan="7" class="agama"></td>
             </tr>
             <tr>
              <td width="20%">Suku Bangsa</td>
              <td colspan="7" class="suku_bangsa"></td>
             </tr>

             <tr>
              <td width="20%">Pendidikan</td>
              <td colspan="7" class="pendidikan"></td>
             </tr>

             <tr>
              <td width="20%">Pekerjaan</td>
              <td colspan="7" class="pekerjaan"></td>
             </tr>

             <tr>
              <td width="20%">Stat.Perkawinan</td>
              <td colspan="7" class="stat_kawin"></td>
             </tr>

             <tr>
              <td width="20%">Warga Negara</td>
              <td colspan="7" class="kewarganegaraan"></td>
             </tr>
             <tr>
              <td width="20%">Alamat Perujuk</td>
              <td colspan="7" class="alamat_pj"></td>
             </tr>

             <tr>
              <td width="20%">Nama Keluarga</td>
              <td colspan="7" class="nama_keluarga"></td>
             </tr>

             <tr>
              <td width="20%">Hub.Keluarga</td>
              <td colspan="7" class="hub_pasien"></td>
             </tr>

             <tr>
              <td width="20%">Ibu Kandung</td>
              <td colspan="7" class="nama_ibu"></td>
             </tr>

             <tr>
              <td width="20%">Nama PJ</td>
              <td colspan="7" class="nama_pj"></td>
             </tr>

             <tr>
              <td width="20%">Alamat PJ</td>
              <td colspan="7" class="alamat_pj"></td>
             </tr>
             <tr>
              <td width="20%">Telepon PJ</td>
              <td colspan="7" class="telp_pj"></td>
             </tr>
             <tr>
              <td width="20%">Pekerjaan PJ</td>
              <td colspan="7" class="pekerjaan_keluarga"></td>
             </tr>
            </tbody>
           </table>
           <div class="panel-footer">

           </div>
          </div>
         </div>
        </div>
       </div>
       <div class="after-loading" id="index-button">
        <!-- <a href="javascript:void(0)" onclick="printJS('index-print', 'html')"  class="easyui-linkbutton c6 after-loading" iconCls="icon-print" style="width:90px">Print</a> -->
        <a href="javascript:void(0)" onclick="printJS({
             printable: 'index-print',
             type: 'html',
             targetStyles: ['*'],
             style: 'body,html,table{  font-family: Calibri; font-size: 11px;} table {border-collapse: collapse ; page-break-inside: avoid } tr    { page-break-inside:avoid; page-break-after:auto }thead { display:table-header-group }tfoot { display:table-footer-group } table th, table td {padding:0.25rem !important;vertical-align: top;}'})" class="btn btn-sm btn-primary c6 after-loading" style="width:90px"><i class="la la-print"></i> Print</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-secondary" onclick="$('#winIndexPx').window('close')" style="width:90px"> <i class="la la-times"></i>Cancel</a>
       </div>
      </div>
     </div>

     <div id="winPesanKamar"
          data-options="
          region:'center',
          headerCls:'judul-window'"
          data-title="Catatan"
          class="panel-window"
          style="width:800px">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="formPesanKamar">
         <input type="hidden" name="id_mr" class="mk_id_mr">
         <input type="hidden" name="id_mrs" class="mk_id_mrs">
         <input type="hidden" name="dari_kamar" class="mk_dari_kamar">
         <input type="hidden" name="id_pesankamar" class="mk_id_pesankamar">
         <div class="row">
          <div class="col-lg-6 col-sm-12 order-lg-1 order-xs-2">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Dari Kamar:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm mk_nama_kamar"
                    readonly
                    type="text">
            </div>
            <!--Input End-->
            <br>
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Pasien Jenis Kamar:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm mk_jenis"
                    readonly
                    type="text">
            </div>
            <!--Input End-->

           </div>
          </div>
          <div class="col-lg-6 col-sm-12 order-lg-1 order-xs-2">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Dari Kelas:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm mk_dari_kelas"
                    readonly
                    type="text">
            </div>
            <!--Input End-->
            <br>
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Kelas Jenis:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm mk_kelas_jenis"
                    readonly
                    type="text">
            </div>
            <!--Input End-->
           </div>
          </div>
         </div>
         <hr>
         <div class="row">
          <div class="col-sm-6">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             No. Telp Yg Bisa Dihubungi:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm mk_telepon"
                    name="telepon"
                    type="text">
            </div>
           </div>
          </div>
          <div class="col-sm-6">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             *Tambahan:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm mk_telepon2"
                    name="telepon2"
                    type="text">
            </div>
           </div>
          </div>

         </div>
         <hr>
         <div class="row">
          <div class="col-sm-6">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             No. Antrian:</label>
            <div class="col-lg-7 col-sm-12">
             <input class="form-control form-control-sm mk_no_antriaktif"
                    name="mr_lama"
                    type="text">
            </div>
           </div>
          </div>
          <div class="col-sm-6">
           <div class="form-group row">
            <!--Input Start-->
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Kamar/Ruang:</label>
            <div class="col-lg-7 col-sm-12">
             <select name="id_kamar" id="select_kamar_mk"
                     class="select_2 form-control form-control-sm">
                      <?php
                      $RequestK = GetResponseApi("/tpp_pesankamar/kamar", [], "get");
                      foreach ($RequestK->list as $key => $value) {
                       echo"<option value ='" . $value->nl . "'>" . $value->n . "</option>";
                      }
                      ?>
             </select>
            </div>
           </div>
          </div>
         </div>
         <hr>
         <div class="row">
          <div class="col-sm-12">
           <div class="form-group row">
            <label class="col-form-label col-lg-5 col-sm-12 form-control-sm">
             Keterangan:</label>
           </div>
          </div>
         </div>
         <div class="row">
          <div class="col-sm-12">
           <div class="form-group row">
            <div class="col-lg-12 col-sm-12">
             <textarea name="keterangan" rows="6"
                       class="form-control form-control-sm mk_keterangan"></textarea>
            </div>
           </div>
          </div>
         </div>
         <hr>
         <div class="form-group row">
          <div class="col-lg-4 col-sm-12">
           <button type="button" id="btnPesanKamar" onclick="updateMasukKamar()"
                   class="form-control form-control-sm btn btn-sm btn-primary">
            <i class="la la-save"></i> Simpan
           </button>
          </div>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="javascript:$('#winPesanKamar').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
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

<!--0: {no_mr: "72000001", nama_lengkap: "Zulkifly, Sdr.", umur: "L | 36 th. 3 bl. 12 hr.",…}
alamat: "$alamat RT.1 RW.1 Kec. $kecamatan - $kabupaten"
dari_kamar: 93
dari_kelas: "II"
id_mrs: 200500001
nama_kamar: "Poli Fisioterapi"
nama_lengkap: "Zulkifly, Sdr."
no_mr: "72000001"
telepon: "$telepon | $hp"
tgl_lahir: "04/04/1984"
umur: "L | 36 th. 3 bl. 12 hr."
total: 1-->