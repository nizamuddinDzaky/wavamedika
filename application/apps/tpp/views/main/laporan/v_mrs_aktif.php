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
       <select name="unit" id="select_unit"
               class="select_2 form-control form-control-sm">
                <?php
                $Request = GetResponseApi("/tpp_mrsaktif/unit", [], "get");
                $data    = "";
                echo "<option value='_'> Semua Unit</option>";
                foreach ($Request->list as $key => $value) {
                 echo"<option value ='" . $value->nama_unit . "'>" . $value->nama_unit . "</option>";
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
        <th field="tgl_mrs" width="150">Tgl. MRS</th>
        <th field="golongan" width="100">Golongan</th>
        <th field="id_mrs" width="100">No. Billing</th>
        <th field="nama_lengkap" width="300">Nama Lengkap</th>
        <th field="no_mr" width="100">No. RM</th>
        <th field="kamar" width="100">Kamar</th>
        <th field="kelas" width="100">Kelas</th>
        <th field="jatah_kelas" width="100">Jth. Kelas</th>
        <th field="stat_kelas" width="100">Status Kamar</th>
        <th field="nama_keluarga" width="150">Nama Keluarga</th>
        <th field="kecamatan" width="100">Kecamatan</th>
        <th field="sex" width="100">Sex</th>
        <th field="umur" width="100">Umur</th>
        <th field="admission" width="100">Admission</th>
        <th field="asuransi" width="100">Asuransi</th>
        <th field="instansi" width="100">Instansi</th>
        <th field="status" width="100">Status</th>
        <th field="dpjp" width="100">DPJP</th>
       </tr>
      </thead>
     </table>
     <div id="toolbar">
      <a href="javascript:void(0)" id="btn-status_kamar" class="easyui-linkbutton" plain="true">
       <i class="la la-info-circle"></i>
       Status Kamar
      </a>
      <a href="javascript:void(0)" id="btn-privasi_pasien" class="easyui-linkbutton" plain="true">
       <i class="la la-user-secret"></i>
       Privasi Pasien
      </a>
      <a href="javascript:void(0)" id="btn-pesan_kamar" class="easyui-linkbutton" plain="true">
       <i class="la la-edit"></i>
       Pesan Kamar
      </a>
      <a href="javascript:void(0)" id="btn-info_pasien" class="easyui-linkbutton" plain="true">
       <i class="la la-user"></i>
       Info Pasien
      </a>
      <a href="javascript:void(0)" id="btn-print_sticker" class="easyui-linkbutton" plain="true">
       <i class="la la-print"></i>
       Print Sticker
      </a>

     </div>

     <!--Status Kamar-->
     <div id="winStatusKamar" data-title="Status Kamar"
          class="panel-window" style="width:640px;">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form" id="formStatusKamar">
         <input type="hidden" name="id_mrs">
         <input type="hidden" name="id_mr">
         <div class="row">
          <div class="col-12">
           <div class="card">
            <div class="card-header">
             <h2 class="no_mrs"></h2>
             <h5 class="nama_pasien label label-default"></h5>
            </div>
           </div>
          </div>
         </div>
         <hr>
         <div class="col-12">
          <div style="margin-bottom:20px" >
           <select labelWidth="125" label="Status Kamar" style="width: 100%" required class="stat_kamar easyui-combobox" name="stat_kelas">
            <option value="Sesuai">Sesuai</option>
            <option value="Naik Kelas">Naik Kelas</option>
           </select>
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
           <button type="button" onclick="SimpanStatKamar()"
                   id="btnSimpanStatusKamar"
                   class="form-control form-control-sm btn btn-sm btn-primary">
            <i class="la la-save"></i> Simpan
           </button>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>

     <!--Privasi Pasien-->
     <div id="winPrivasiPasien" data-title="Privasi Pasien"
          class="panel-window" style="width:480px;">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form" id="formPrivasiPasien">
         <input type="hidden" name="id_mrs">
         <input type="hidden" name="id_privasi">

         <div class="row">
          <div class="col-12">
           <div class="card">
            <div class="card-header">
             <h2 class="no_mrs"></h2>
             <h5 class="nama_pasien label label-default"></h5>
            </div>
           </div>
          </div>
         </div>
         <hr>
         <div class="row">
          <div class="col-12">

           <div class="row">
            <div class="col-12">
             <div class="form-group row">
              <div class="col-12 radioButton">
               <div style="margin-bottom:20px" >
                <input labelAlign="left" labelWidth="150" labelPosition="after"
                       class="easyui-radiobutton tidak_dirahasiakan"
                       name="tidak_dirahasiakan" value="1" label="Tidak Dirahasiakan" data-options="
                       onChange:function(nx){
                       $('.dibatasi').radiobutton({'checked':false}) ;
                       $('.dirahasiakan').radiobutton({'checked':false}) ;
                       $('.easyui-checkbox').checkbox({
                       'checked' : false ,
                       'disabled' : true
                       }) ;
                       }
                       ">
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-12">
             <div class="form-group row">
              <div class="col-6 radioButton">
               <div style="margin-bottom:20px" >
                <input labelAlign="left" labelPosition="after"
                       class="easyui-radiobutton dibatasi"
                       name="dibatasi" value="1" label="Dibatasi"
                       data-options="
                       onChange:function(nx){
                       $('.tidak_dirahasiakan').radiobutton({'checked':false});
                       $('.dirahasiakan').radiobutton({'checked':false}) ;
                       $('.easyui-checkbox').checkbox({
                       'disabled' : false
                       });
                       }
                       ">
               </div>
              </div>
              <div class="col-6 checkBox">
               <div>
                <input labelAlign="left" labelPosition="after"  labelWidth="125" class="easyui-checkbox semua" name="semua" value="1" label="Semua">
               </div>
               <div>
                <input labelAlign="left" labelPosition="after"  labelWidth="125" class="easyui-checkbox keluarga" name="keluarga" value="1" label="Keluarga">
               </div>
               <div>
                <input labelAlign="left" labelPosition="after"  labelWidth="125" class="easyui-checkbox handai_taulan" name="handai_taulan" value="1" label="Handai Taulan">
               </div>
               <div>
                <input labelAlign="left" labelPosition="after"  labelWidth="125" class="easyui-checkbox orang_lain" name="orang_lain" value="1" label="Orang Lain">
               </div>
               <div>
                <input labelAlign="left" labelPosition="after"  labelWidth="125" class="easyui-checkbox media_massa" name="media_massa" value="1" label="Media Massa" >
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-12">
             <div class="form-group row">
              <div class="col-12 radioButton">
               <div style="margin-bottom:20px" >
                <input labelAlign="left" labelPosition="after"
                       class="easyui-radiobutton dirahasiakan"
                       name="dirahasiakan" value="1" label="Dirahasiakan"
                       data-options="
                       onChange:function(nx){
                       $('.dibatasi').radiobutton({'checked':false}) ;
                       $('.tidak_dirahasiakan').radiobutton({'checked':false}) ;
                       $('.easyui-checkbox').checkbox({
                       'checked' : false ,
                       'disabled' : true
                       }) ;
                       }
                       ">
               </div>
              </div>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-12">
             <div class="form-group row">
              <div class="col-12 radioButton">
               <div style="margin-bottom:20px" >
                <input class="easyui-textbox keterangan" name="keterangan" labelAlign="left" labelPosition="top" style="width:100%;height:80px" data-options="label:'Uraian:',multiline:true">
               </div>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div>

         <hr>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
          </label>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="javascript:$('#winPrivasiPasien').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
            <i class="la la-times"></i> Batal
           </button>
          </div>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="simpanPrivasi()"
                   id="btnSimpanPrivasi"
                   class="form-control form-control-sm btn btn-sm btn-primary">
            <i class="la la-save"></i> Simpan
           </button>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>

     <!--Panel Info Pasien-->
     <div id="winInfoPasien" data-title="Informasi Pasien"
          class="panel-window" style="width:480px;">
      <div id="infopasien-print">
       <div class="kt-portlet">
        <div class="kt-portlet__body_win header-form">
         <form class="kt-form col-lg-12 header-form" id="formInfoPasien">
          <div class="row">
           <div class="col-12">
            <div class="card">
             <div class="card-header">
              <h2 class="nama_lengkap">$nama_lengkap</h2>
              <h5 class="keterangan label label-default">$keterangan</h5>
             </div>
            </div>
           </div>
          </div>
          <hr>
          <div class="row">
           <div class="col-12">
            <table class="table table-bordered table-hover" border="1" width="100%">
             <tbody>
              <tr>
               <td width="25%">Jenis Pasien</td>
               <td colspan="3" class="jenis_pasien"></td>
              </tr>
              <tr>
               <td width="25%">Sex / Umur</td>
               <td colspan="3" class="umur"></td>
              </tr>
              <tr>
               <td width="25%">Alamat</td>
               <td colspan="3" class="alamat"></td>
              </tr>

              <tr>
               <td width="25%">Nomor Telepon</td>
               <td class="telepon"></td>
               <td>/</td>
               <td class="hp"></td>
              </tr>
              <tr>
               <td width="25%">Nama Keluarga</td>
               <td colspan="7" class="nama_keluarga"></td>
              </tr>

              <tr>
               <td width="25%">Ibu Kandung</td>
               <td colspan="7" class="nama_ibu"></td>
              </tr>

             </tbody>
            </table>
           </div>
          </div>
          <hr>
          <div class="form-group row">
           <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
           </label>
           <div class="col-lg-4 col-sm-12">
            <button type="button" onclick="javascript:$('#winInfoPasien').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
             <i class="la la-times"></i> Batal
            </button>
           </div>
           <div class="col-lg-4 col-sm-12">
            <button type="button" onclick="printJS('infopasien-print', 'html')"
                    id="btnPrintInfoPasien"
                    class="form-control form-control-sm btn btn-sm btn-primary">
             <i class="la la-print"></i> Cetak
            </button>
           </div>
          </div>
         </form>
        </div>
       </div>
      </div>
     </div>

     <!--Panel Pesan Kamar-->
     <div id="winPesanKamar" data-title="Pesan Kamar"
          class="panel-window" style="width:640px;">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form" id="formPesanKamar">
         <div class="row">
          <div class="col-12">
           <div class="card">
            <div class="card-header">
             <h2 class="nama_lengkap">$nama_lengkap</h2>
             <h5 class="keterangan label label-default">$keterangan</h5>
            </div>
           </div>
          </div>
         </div>
         <hr>
         <div class="row">
          <div class="col-6">
           <input type="hidden" name="id_mr" class="id_mr">
           <input type="hidden" name="id_mrs" class="id_mrs">
           <div class="form-group row">
            <label for="dr_kamar"
                   class="col-4 col-form-label">Dari Kamar/Ruang
            </label>
            <div class="col-8">
             <input readonly="true"
                    class="easyui-textbox nama_kamar"
                    style="width:100%"
                    data-options="">
            </div>
           </div>
          </div>
          <div class="col-6">
           <div class="form-group row">
            <label for="dr_kelas"
                   class="col-4 col-form-label">Kelas
            </label>
            <div class="col-8">
             <input readonly="true"
                    class="easyui-textbox dari_kelas"
                    style="width:100%"
                    data-options="">
            </div>
           </div>
          </div>
         </div>
         <div class="row">
          <div class="col-6">
           <div class="form-group row">
            <label for="dr_kamar"
                   class="col-4 col-form-label">Pasien Jenis Kamar
            </label>
            <div class="col-8">
             <?php
             $Request        = GetResponseApi("/tpp_pesankamar/jeniskamar", [], "get");
             $dataJenisKamar = "";
             foreach ($Request->list as $key => $value) {
              $dataJenisKamar .= "<option value ='" . $value->jenis . "'>" . $value->jenis . "</option>";
             }
             ?>
             <select class="easyui-combobox jenis-kamar-index"
                     required style="width:100%"
                     data-options=""
                     name="jenis">
                      <?= $dataJenisKamar ?>
             </select>
            </div>
           </div>
          </div>
          <div class="col-6">
           <div class="form-group row">
            <label for="kelas"
                   class="col-4 col-form-label">Kelas
            </label>
            <div class="col-8">
             <select class="easyui-combobox jenis-kelas-index" style="width:100%"
                     data-options="required:true"
                     name="kelas">
             </select>
            </div>
           </div>
          </div>
         </div>
         <div class="row">
          <div class="col-6">
           <div class="form-group row">
            <label for="no_telp1"
                   class="col-4 col-form-label">No. Telp Yang Bisa Dihubungi
            </label>
            <div class="col-8">
             <input class="easyui-textbox label-nomor"
                    name="telepon"
                    style="width:100%"
                    data-options="">
            </div>
           </div>
          </div>
          <div class="col-6">
           <div class="form-group row">
            <label for="no_telp2"
                   class="col-4 col-form-label">*Tambahan
            </label>
            <div class="col-8">
             <input class="easyui-textbox label-nomor"
                    name="telepon2"
                    style="width:100%"
                    data-options="">
            </div>
           </div>
          </div>
         </div>
         <div class="row">
          <div class="col-6">
           <div class="form-group row">
            <label for="no_telp1"
                   class="col-4 col-form-label">Nomor Antrian
            </label>
            <div class="col-8">
             <input readonly="true"
                    class="easyui-textbox nomor_antrian"
                    style="width:100%"
                    data-options="">
            </div>
           </div>
          </div>
          <div class="col-6">
           <div class="form-group row">
            <label for="no_telp2"
                   class="col-4 col-form-label">Uraian
            </label>
            <div class="col-8">
             <input class="easyui-textbox label-nomor"
                    name="keterangan"
                    style="width:100%; height: 100px"
                    data-options="multiline: true">
            </div>
           </div>
          </div>
         </div>
         <hr>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
          </label>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="javascript:$('#winPesanKamar').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
            <i class="la la-times"></i> Batal
           </button>
          </div>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="pesanKamar()"
                   id="btnSimpanPesanKamar"
                   class="form-control form-control-sm btn btn-sm btn-primary">
            <i class="la la-save"></i> Simpan
           </button>
          </div>
         </div>
        </form>
       </div>
      </div>
     </div>

     <!--Panel Cetak Sticker-->
     <div id="winPrintSticker" data-title="Print Sticker"
          class="panel-window" style="width:640px;">
      <div class="kt-portlet">
       <div class="kt-portlet__body_win header-form">
        <form class="kt-form col-lg-12 header-form" id="formPrintSticker">
         <div class="row">
          <div class="col-12">
           <div class="card">
            <div class="card-header">
             <h2 class="nama_lengkap">$nama_lengkap</h2>
             <h5 class="keterangan label label-default">$keterangan</h5>
            </div>
           </div>
          </div>
         </div>
         <hr>
         <div class="row">
          <div class="col-12">
           <div class="radio">
            <label>
             <input type="radio" required name="stiker" id="exampleRadios1" value="form" checked>
             Kertas Form
            </label>
           </div>
           <div class="radio">
            <label>
             <input type="radio" required name="stiker" id="exampleRadios1" value="gelang">
             Kertas Gelang
            </label>
           </div>
           <div class="radio disabled">
            <label>
             <input type="radio" required name="stiker" id="exampleRadios1" value="cover">
             Kertas Cover
            </label>
           </div>
          </div>
         </div>
         <hr>
         <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
          </label>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="javascript:$('#winPrintSticker').window('close').find(':input').val('').trigger('change')" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
            <i class="la la-times"></i> Batal
           </button>
          </div>
          <div class="col-lg-4 col-sm-12">
           <button type="button" onclick="printSticker()"
                   id="btnPrintSticker"
                   class="form-control form-control-sm btn btn-sm btn-primary">
            <i class="la la-print"></i> Cetak
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

