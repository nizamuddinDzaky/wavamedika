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
    <a href="" class="kt-subheader__breadcrumbs-link">Form Proses MRS</a>
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
   <!-- <br> -->
   <div class="kt-portlet__body custom-body-padding">
    <div class="row">
     <div class="col-md-12 col-sm-12 header-form kt-margin-t-10">
      <div class="card">
       <div class="card-body">
        <form id="formInputMrs">
         <div class="ilangkan">
          <input type="hidden" name="id_mr" class="form-control form-control-sm id_mr">
         </div>
         <div class="row">

          <div class="col-lg-4 col-md-6">
           <div class="form-group row">
            <label class="col-md-6 col-lg-4 col-form-label">No. MRS (Billing)
            </label>
            <div class="col-lg-8 col-md-6">
             <input class="form-control form-control-sm mrs" readonly type="text" name="id_mrs">
            </div>
           </div>
          </div>
          <div class="col-lg-4 col-md-6">
           <div class="form-group">
            <button type="button" class="btn btn-primary btn-sm window-pasien"><i class='fa fa-search'></i> Pasien</button>
           </div>
          </div>
         </div>
         <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-12">
           <div class="form-group row">
            <label class="col-lg-4 col-md-6 col-form-label">Nomor RM
            </label>
            <div class="col-lg-8 col-md-6">
             <input class="form-control form-control-sm no no_rm no_rm-pasien" type="text" name="no_rm">
            </div>
           </div>
           <div class="form-group row">
            <label class="col-lg-4 col-md-6 col-form-label">Tanggal Masuk
            </label>
            <div class="col-lg-8 col-md-6">
             <input class="form-control form-control-sm tgl-mrs" readonly format='DD/MM/YYYY' name="tgl_mrs" type="date-only-formatted">
            </div>
           </div>
           <div class="form-group row">
            <label class="col-lg-4 col-md-6 col-form-label">Jam Masuk
            </label>
            <div class="col-lg-8 col-md-6">
             <input class="form-control form-control-sm jam-mrs" readonly type="time-formatted" name="jam_mrs">
            </div>
           </div>
          </div>
          <div class="col-lg-8 col-md-6 col-sm-12 after-loading-pasien">
           <table class="table table-borderless">
            <tr>
             <td style="width: 30%">Nama Pasien</td>
             <td><span class="nama-pasien"></span></td>
            </tr>
            <tr>
             <td>Alamat</td>
             <td><span class="alamat-pasien"></span></td>
            </tr>
            <tr>
             <td>Keterangan</td>
             <td><span class="ket"></span></td>
            </tr>
           </table>
          </div>
         </div>
         <!-- <hr> -->
         <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-12" style="border-top: 1px solid rgba(0, 0, 0, 0.1); padding-top:10px ; padding-bottom:10px">
           <div class="form-group row">
            <label for="" class="col-lg-4 col-md-6 col-form-label">
             Kunjungan
            </label>
            <div class="col-lg-8 col-md-6">
             <select class="select2 form-control form-control-sm dropdown-kunjungan jns-kunjungan" required name="kunjungan">
              <option value=""></option>
              <option value="Baru">Baru</option>
              <option value="Lama">Lama</option>
             </select>
            </div>
           </div>
           <div class="form-group row">
            <label for="" class="col-lg-4 col-md-6 col-form-label">
             Unit
            </label>
            <div class="col-lg-8 col-md-6">
             <select class="select2 form-control dropdown-jns-kunjungan form-control-sm jns-kunjungan" required name="id_unit">
              <option value="">Pilih Unit</option>
             </select>
            </div>
           </div>
           <div class="form-group row">
            <label for="" class="col-lg-4 col-md-6 col-form-label">
             Kamar / Ruang
            </label>
            <div class="col-lg-8 col-md-6">
             <select class="select2 dropdown-ruang ruang" required style="width:100%" name="id_kamar">
              <option value="">Pilih Ruang</option>
             </select>
            </div>
           </div>
           <div class="form-group row">
            <label for="" class="col-lg-4 col-md-6 col-form-label">
             Nama Dokter
            </label>
            <div class="col-lg-8 col-md-6">
             <select class="select2 dropdown-dokter dokter" name="dokter">
              <option value="">Pilih Dokter</option>
             </select>
            </div>
           </div>
           <div class="form-group row">
            <label for="" class="col-lg-4 col-md-6 col-form-label">
             Cara Masuk
            </label>
            <div class="col-lg-8 col-md-6">
             <select class="select2 form-control form-control-sm cara-masuk" required name="cara_masuk">
              <option value="">Pilih Cara Masuk</option>
              <option value="Sendiri">Sendiri</option>
              <option value="Rujukan">Rujukan</option>
             </select>
            </div>
           </div>
           <div class="form-group row">
            <label for="" class="col-lg-4 col-md-6 col-form-label">
             Perujuk
            </label>
            <div class="col-lg-8 col-md-6 ">
             <select class="form-control select2 disabled-select form-control-sm dropdown-perujuk perujuk-f" name="perujuk">
             </select>
            </div>
           </div>
           <hr>
           <div class="form-group row">
            <label class="col-lg-4 col-md-6 col-form-label">Nomor Antri Poli
            </label>
            <div class="col-lg-8 col-md-6">
             <input class="form-control form-control-sm antri_poli" type="text" readonly data-options="">
            </div>
           </div>
           <div class="form-group row">
            <label class="col-lg-4 col-md-6 col-form-label">Status Pasien
            </label>
            <div class="col-lg-8 col-md-6">
             <input class="form-control form-control-sm status_pasien" type="text" readonly>
            </div>
           </div>
           <div class="form-group row">
            <label class="col-lg-4 col-md-6 col-form-label">Ket. Bayar Terakhir
            </label>
            <div class="col-lg-8 col-md-6">
             <input class="form-control form-control-sm ket-bayar-akhir" type="text" readonly>
            </div>
           </div>
           <div class="form-group row">
            <label class="col-lg-4 col-md-6 col-form-label">Status Penyakit
            </label>
            <div class="col-lg-8 col-md-6">
             <input class="form-control form-control-sm statpenyakit" type="text" readonly>
            </div>
           </div>
           <div class="form-group row">
            <label class="col-lg-4 col-md-6 col-form-label">Catatan Penting
            </label>
            <div class="col-lg-8 col-md-6">
             <textarea class="form-control form-control-sm catatan" readonly type="text" style="width:100%; height: 75px">
             </textarea>
             <!-- <input class="form-control form-control-sm catatan" readonly type="text" style="width:100%; height: 75px" name="catatan"> -->
            </div>
           </div>
          </div>
          <div class="col-lg-8 col-md-6 col-sm-12" style="border-top: 1px solid rgba(0, 0, 0, 0.1); padding-top:10px">
           <div class="form-group row">
            <label class="col-lg-2 col-sm-4 col-form-label">Nama Perujuk
            </label>
            <div class="col-lg-5 col-sm-5 data-perujuk">
             <input class="form-control nama_perujuk" type="text" readonly name="nama_perujuk">
            </div>
            <div class="col-lg-5 col-md-3 data-perujuk">
             <button class="btn btn-primary btn-sm float-left cari-perujuk" type="button">
              <i class="la la-search"></i> Cari Perujuk
             </button>
             <input type="hidden" style="display: none;" class="form-control form-control-sm id_perujuk" name="id_perujuk">
            </div>
           </div>
           <div class="form-group row">
            <label class="col-lg-2 col-sm-4 col-form-label">Alamat Perujuk
            </label>
            <div class="col-lg-8 col-md-6 data-perujuk">
             <textarea class="form-control alamat_perujuk" type="text" style="width:100%; height: 75px" name="alamat_perujuk">
             </textarea>
            </div>
           </div>
           <div class="row">
            <div class="form-group  col-lg-4 col-md-6">
             <div class="form-check">
              <input type="checkbox" disabled class="form-check-input" value="1" name="karyawan" id="check-karyawan">
              <label class="form-check-label" for="check-karyawan">Karyawan</label>
             </div>
            </div>
            <div class="form-group  col-lg-4 col-md-6">
             <div class="form-check">
              <input type="checkbox" disabled class="form-check-input" value="1" name="cek_penunjang" id="check-penunjang">
              <label class="form-check-label" for="check-penunjang">Penunjang Saja</label>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-lg-4 col-md-6 col-sm-12 col-form-label">
               Pembayaran
              </label>
              <div class="col-lg-8 col-md-6 col-sm-12">
               <select class="select2 dropdown-pembayaran pembayaran" required name="pembayaran">
                <option value="Sendiri">Sendiri</option>
                <option value="Kerja Sama">Kerja Sama</option>
               </select>
              </div>
             </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-lg-4 col-md-6 col-sm-12 col-form-label">
               Tarif
              </label>
              <div class="col-lg-8 col-md-6 col-sm-12">
               <select class="select2 dropdown-tarif id_tarif" name="id_tarif">
               </select>
              </div>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-lg-4 col-md-6 col-sm-12 col-form-label">
               Paket
              </label>
              <div class="col-lg-8 col-md-6 col-sm-12">
               <select class="select2 dropdown-paket paket" name="id_jnsbiaya">
               </select>
              </div>
             </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group">
              <div class="form-check" style="vertical-align: middle;padding-top:5px ; padding-bottom:5px">
               <input type="checkbox" class="form-check-input" value="1" name="cob" id="check-cob">
               <label class="form-check-label" for="check-cob">C O B</label>
              </div>
             </div>
            </div>
           </div>
           <hr>
           <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-lg-4 col-md-6 col-sm-12 col-form-label">
               Instansi
              </label>
              <div class="col-lg-8 col-md-6 col-sm-12">
                <!--                 <input type="hidden"
                           class="nama_instansi"
                           name="instansi">-->
               <input type="hidden" class="ks_instansi form-control form-control-sm" name="ks_instansi">
               <select class="dropdown-instansi select2 instansi">
               </select>
              </div>
             </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group row">
              <label class="col-lg-4 col-md-6 col-sm-12 col-form-label">Nama Instansi
              </label>
              <div class="col-lg-8 col-md-6 col-sm-12">
               <input class="form-control form-control-sm nama_instansi nama_" name="instansi" type="text" style="width:100%" data-options="">
              </div>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-lg-4 col-md-6 col-sm-12 col-form-label">
               Asuransi
              </label>
              <div class="col-lg-8 col-md-6 col-sm-12">
               <input type="hidden" class="ks_asuransi d-none form-control form-control-sm" name="ks_asuransi">
               <select class="select2 dropdown-asuransi asuransi" name="asuransi" style="width:100%">
               </select>
              </div>
             </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group row">
              <label class="col-lg-4 col-md-6 col-sm-12 col-form-label">Nama Asuransi
              </label>
              <div class="col-lg-8 col-md-6 col-sm-12">
               <input class="form-control form-control-sm nama_asuransi nama_" type="text" style="width:100%">
              </div>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-lg-4 col-md-6 col-sm-12 col-form-label">
               Admission
              </label>
              <div class="col-lg-8 col-md-6 col-sm-12">
               <select class="dropdown-admission select2 admission" name="admission" style="width:100%">
               </select>
              </div>
             </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
             <div class="form-group row">
              <label class="col-lg-4 col-md-6 col-sm-12 col-form-label">Nama Admission
              </label>
              <div class="col-lg-8 col-md-6 col-sm-12">
               <input class="form-control form-control-sm nama_admission nama_" type="text" style="width:100%">
              </div>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-4 col-form-label">
               Nomor Peserta
              </label>
              <div class="col-8">
               <input class="form-control form-control-sm no no_peserta" type="text" readonly name="no_peserta">
              </div>
             </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-4 col-form-label">
               Jatah Kelas
              </label>
              <div class="col-8">
               <select class="select2 dropdown-kelas kelas" style="width:100%" name="jatah_kelas">
               </select>
              </div>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-4 col-form-label">
               Nomor SJP
              </label>
              <div class="col-8">
               <input class="form-control form-control-sm no_sjp" type="text" readonly name="no_sjp" style="width:100%" data-options="">
              </div>
             </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">

            </div>
           </div>
           <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
             <div class="form-group row">
              <label for="" class="col-4 col-form-label">
               Penanggung Biaya
              </label>
              <div class="col-8">
               <input class="form-control form-control-sm pj_biaya" type="text" name="pj_biaya" style="width:100%" data-options="">
              </div>
             </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
             <div class="form-group row" style="margin: auto">
              <a title="Sama Dengan Atas" class="easyui-linkbutton get_pembayar">
               <i class="fa fa-copy"></i> SDA</a>
             </div>
            </div>
           </div>
           <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
             <div class="form-group row">
              <label class="col-4 col-form-label">Alamat
              </label>
              <div class="col-8">
               <textarea class="form-control form-control-sm alamat_pjbiaya" type="text" style="width:100%; height: 75px" name="alamat_pjbiaya"></textarea>
              </div>
             </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
            </div>
           </div>
          </div>
         </div>
        </form>
       </div>
       <div class="card-footer text-muted row ">
        <div class="col-lg-3 col-md-12 kt-padding-t-10-mobile">
         <button onclick="SimpanForm()" class="btn form-control form-control-sm btn-success btn-sm btnBatalSimpanMrs">Simpan MRS</button>
        </div>
        <div class="col-lg-3 col-md-12 kt-padding-t-10-mobile">
         <button href="javascript:void(0)" class="form-control form-control-sm btn btn-sm btn-secondary Reset" onclick="SetDefault()">Reset</button>
        </div>
       </div>
      </div>
     </div>
     <div class="col-md-12 col-sm-12 header-form">
      <button type="button" onclick="GetTindakan(200500016, 54)" class="btn btn-danger">danger</button>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
<!-- end content -->

<div class="easyui-window" id="PanelPasien" title="List Pasien" data-options="modal:true,closed:true,buttons:'#add-button',resizable: false" style="width: 900px">
 <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
  <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
   <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">

    <!--Panel Pencarian Start-->
    <form class="kt-form col-lg-12 row header-form kt-margin-t-25" id="FilterPasien">
     <div class="form-group row">
      <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm kt-font-sm">
       Nomor RM:</label>
      <div class="col-lg-2 col-md-4 col-sm-12">
       <input class="form-control form-control-sm" name="no_rm" type="text">
      </div>
      <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm kt-font-sm">
       Nama :</label>
      <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
       <input name="nama" class="form-control form-control-sm" type="text" placeholder="Nama Pasien...">
      </div>
      <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm kt-font-sm">
       Sex:</label>
      <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
       <select name="sex" class="form-control form-control-sm">
        <?php echo getOptionList("jeniskelamin") ?>
       </select>
      </div>
      <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm kt-font-sm">
       Jenis:</label>
      <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
       <select name="sex" class="form-control form-control-sm">
        <option value="">Semua</option>
        <?= getJnsPasien() ?>
       </select>
      </div>
     </div>
     <div class="form-group row">
      <label class="col-form-label col-lg-1 col-md-2 col-sm-4 form-control-sm kt-font-sm">
       Thn Daftar:</label>
      <div class="col-lg-1 col-md-2 col-sm-4 kt-margin-t-10-mobile">
       <input name="thn1" value="1990" class="form-control form-control-sm" type="number" maxlength="4" minlength="4">
      </div>
      <div class="col-lg-1 col-md-2 col-sm-4 kt-margin-t-10-mobile">
       <input name="thn2" value="<?php echo date('Y') ?>" class="form-control form-control-sm" type="number" maxlength="4" minlength="4">
      </div>
      <label class="col-form-label col-lg-1 col-md-2 col-sm-6 form-control-sm kt-font-sm">
       Kabupaten:</label>
      <div class="col-lg-2 col-md-4 col-sm-6 kt-margin-t-10-mobile">
       <select name="kab" id="sel_kab" class="select2 form-control form-control-sm dropdown-kab">
        <?= $dataKabupaten ?>
       </select>
      </div>
      <label class="col-form-label col-lg-1 col-md-2 col-sm-6 form-control-sm kt-font-sm">
       Kecamatan:</label>
      <div class="col-lg-2 col-md-4 col-sm-6 kt-margin-t-10-mobile">
       <select name="kec" id="sel_kec" class="select2 form-control form-control-sm dropdown-kec">
        <?= $dataKecamatan ?>
       </select>
      </div>
      <div class="col-lg-2 col-md-6 col-sm-12 kt-margin-t-10-mobile">
       <button type="submit" class="btn btn-sm btn-primary" plain="true" id="btn-filter">
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

     <table title="Data Pasien" id="tblPasien" class="easyui-datagrid" style="width: 100%; height:480px; margin-top:5px" toolbar="#toolbar" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
      <thead>
       <tr>
        <th field="no_mr" halign="center" align="rigth" width="200">No. MR</th>
        <th field="nama_lengkappx" halign="left" align="center" width="250">Nama Pasien</th>
        <th field="sex" halign="center" align="center" width="50">Sex</th>
        <th field="umur" halign="center" align="left" width="50">Umur</th>
        <th field="tgl_lahir" halign="center" align="center" width="150">Tgl. Lahir</th>
        <th field="kelurahan" halign="center" align="left" width="200">Desa</th>
        <th field="kecamatan" halign="center" align="left" width="200">Kecamatan</th>
        <th field="telepon" halign="center" align="right" width="150">Telepon</th>
        <th field="lengkap" halign="center" align="center" width="150">Lengkap</th>
       </tr>
      </thead>
     </table>

     <div id="toolbar">
      <a href="javascript:void(0)" id="btn-mrs" class="easyui-linkbutton" plain="true">
       <i class="fa fa-arrow-right"></i>
       MRS
      </a>
      <a href="javascript:void(0)" id="btn-info" class="easyui-linkbutton" plain="true">
       <i class="fa fa-info-circle"></i>
       Info Pasien
      </a>
      <a href="javascript:void(0)" onclick="jQuery('#PanelPasien').window('close')" id="btn-tutup" class="easyui-linkbutton" style="float:right" plain="true" iconCls='icon-cancel'>
       Tutup
      </a>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>

<div class="easyui-window" id="PanelPerujuk" title="List Perujuk" data-options="modal:true,closed:true,buttons:'#add-button',resizable: false" style="width: 900px">
 <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
  <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
   <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">

    <!--Panel Pencarian Start-->
    <form class="kt-form  col-lg-12 header-form kt-margin-t-25" id="FilterPerujuk">
     <div class="form-group row">
      <label class="col-form-label col-lg-2 col-md-4 col-sm-6 form-control-sm kt-font-sm">
       Nama Perujuk:</label>
      <div class="col-lg-2 col-md-8 col-sm-12 kt-margin-t-10-mobile">
       <input type="text" labelWidth="125" maxlength="8" class="form-control form-control-sm nama_perujuk" name="nama_perujuk" onchange="GetDataPerujuk()">
      </div>
      <label class="col-form-label col-lg-1 col-md-4 col-sm-6 form-control-sm kt-font-sm">
       Jenis:</label>
      <div class="col-lg-3 col-md-8 col-sm-12 kt-margin-t-10-mobile">
       <select style="z-index: 1000000 !important;" class="select2 form-control form-control-sm dropdown-perujuk perujuk" onchange="GetDataPerujuk()">
       </select>
      </div>
      <label class="col-form-label col-lg-1 col-md-4 col-sm-6 form-control-sm kt-font-sm">
       Kecamatan:</label>
      <div class="col-lg-3 col-md-8 col-sm-12 kt-margin-t-10-mobile">
       <select class="select2  form-control form-control-sm kec_perujuk" onchange="GetDataPerujuk()" name="perujuk">
       </select>
      </div>
      <hr>
     </div>
    </form>
    <!--Panel Pencarian End-->
   </div>
   <!-- <br> -->
   <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
    <div class="table-custom">

     <table title="Daftar Perujuk" id="TablePerujuk" class="easyui-datagrid" style="width: 100%; height:480px; margin-top:5px" toolbar="#toolbarPerujuk" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
      <thead>
       <tr>
        <th data-options="field: 'nama_perujuk'" width="250" align="left" halign="center">Nama Perujuk</th>
        <th data-options="field: 'jenis'" width="100" align="left" halign="center">Jenis Perujuk</th>
        <th data-options="field: 'kabupaten'" width="150" align="left" halign="center">Kabupaten/Kota</th>
        <th data-options="field: 'kecamatan'" width="150" align="left" halign="center">Kecamatan</th>
        <th data-options="field: 'kelurahan'" width="150" align="left" halign="center">Kelurahan</th>
        <th data-options="field: 'telepon'" width="100" align="left" halign="center">Telp</th>
       </tr>
      </thead>
     </table>

     <div id="toolbarPerujuk">
      <a href="javascript:void(0)" id="btn-pilih-perujuk" class="easyui-linkbutton" plain="true">
       <i class="fa fa-arrow-right"></i> Pilih
      </a>
      <a href="javascript:void(0)" onclick="jQuery('#PanelPerujuk').window('close')" id="btn-tutup" class="easyui-linkbutton" style="float:right" plain="true" iconCls="icon-cancel">
       Tutup
      </a>
      <a href="javascript:void(0)" style="float:right" id="btn-info" data-options="iconCls:'icon-reload'" class="easyui-linkbutton" plain="true" onclick="GetDataPerujuk()">
       Refresh
      </a>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>

