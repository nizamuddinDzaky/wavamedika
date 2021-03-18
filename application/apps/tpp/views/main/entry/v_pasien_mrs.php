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
    <a href="" class="kt-subheader__breadcrumbs-link">Entry</a>
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
       <div class="card-footer text-muted row">
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


<div id="PanelBiaya" class="easyui-window" title="Tarif Paket (Data Tarif Paket Tindakan Pasien)" data-options="modal:true,closed:true ,resizable: false" style="width: 900px">
 <div class="kt-portlet">
  <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
   <div class="kt-form col-lg-12 header-form kt-margin-t-25">
    <form id="FormBiaya" class="rowx">
     <!-- <div class="col-md-6 col-sm-12">  -->
     <div class="card">
      <div class="card-body">
       <h3 class="detail_pasien"></h3>
      </div>
     </div>
     <div class="form-group row" style="margin-top: 10px;">
      <div class="col-lg-4 col-md-4 col-sm-12">
       <div class="form-group row">
        <label for="" class="col-lg-4 col-md-6 col-sm-12 col-form-label">
         Paket
        </label>
        <div class="col-lg-8 col-md-6 col-sm-12">
         <select class="select2 dropdown-paket paket-biaya" name="id_jnsbiaya">
         </select>
         <input class="form-control form-control-sm mrs" readonly type="hidden" name="id_mrs">
        </div>
       </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-5 ">
       <div class="form-group">
        <div class="form-check">
         <input type="checkbox" disabled class="form-check-input diskon_check" value="1" name='diskon' id="check-diskon">
         <label class="form-check-label" for="check-diskon">Diskon</label>
        </div>
       </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
       <div class="row form-group">
        <div class="col-8">
         <input class="form-control form-control-sm diskon no" id='valueDiskon' value="0" name="diskon" readonly type="text">
         <input class="form-control form-control-sm diskon_total no" value="0" name="total_diskon" readonly type="hidden">
        </div>
        <label class="col-1 col-form-label">
         %
        </label>

       </div>
       <!-- <div class="col-2">
         <input class="easyui-checkbox" value="1" class="diskon_check" data-options="
                                 onChange:function(checked){
                                     if(checked){
                                         $('.diskon').numberbox('readonly',false);
                                     }else{
                                         $('.diskon').numberbox('setValue',0);
                                         $('.diskon').numberbox('readonly',true);
                                     }
                                 }
                             ">
       </div>
       <div class="col-10">
         <input class="easyui-numberbox diskon" name="diskon" readonly labelPosition='after' lebelAlign='right' value="0" labelWidth="15" max="100" style="width:90%" label="%">
       </div> -->
      </div>
     </div>
     <div class="card ">
      <div class="card-body">
       <div class="row" style="padding-top: 10px">
        <div class="col-md-12 col-xs-12">
         <span class="label label-default"></span>
        </div>
       </div>
       <div class="row" style="padding-top: 10px">
        <div class="col-12">
         <table id="TabelTindakan" style="width: 100%" title="List Tindakan" height="200" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true" fitColumns="false" toolbar="#toolbarTindakan">
          <thead>
           <tr>
            <th data-options="field: 'nama_tindakan'" width="50%" align="left" halign="center">Nama Tindakan</th>
            <th data-options="field: 'tarif'" width="100" align="left" halign="center">Tarif (RP)</th>
            <th field="dilakukan_oleh" width="150" align="left" halign="center">
             Dilakukan oleh</th>
            </th>
           </tr>
          </thead>
          <tfoot>
           <tr></tr>
          </tfoot>
         </table>
         <div id="toolbarTindakan">
          <a href="javascript:void(0)" table="#TabelTindakan" class="easyui-linkbutton btn-edit" id='btn-edit-tindakan' plain="true">
           <i class="flaticon-edit-1"></i>
           Ubah Petugas
          </a>
         </div>
        </div>
       </div>
      </div>
     </div>

     <div class="card" style="margin-top: 10px">
      <div class="card-body">
       <div class="row" style="padding-top: 10px">
        <div class="col-md-6 col-xs-4">
         <span class="label label-default">Labolatorium</span>
        </div>
        <div class="col-md-6 col-xs-8 row">
         <div class="col-4">
          <span class="label label-default">Dokter :</span>
         </div>
         <div class="col-8">
          <select class="select2 dropdown-dokter-tindakan dokter" required name="dokter">
          </select>
         </div>
        </div>
       </div>
       <div class="row" style="padding-top: 10px">
        <div class="col-12">
         <table id="TabelLab" style="width: 100%" height="200" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true" fitColumns="false" toolbar="#toolbarLab">
          <thead>
           <tr>
            <th data-options="field: 'nama_tindakan'" width="50%" align="left" halign="center">Nama Pemeriksaan</th>
            <th data-options="field: 'tarif'" width="100" align="left" halign="center">Tarif (RP)</th>
            <th field='dilakukan_oleh' width="150" align="left" halign="center">
             Dilakukan oleh</th>
           </tr>
          </thead>
          <tfoot>
           <tr></tr>
          </tfoot>
         </table>
         <div id="toolbarLab">
          <a href="javascript:void(0)" table='#TabelLab' class="easyui-linkbutton btn-edit" id='btn-edit-lab' plain="true">
           <i class="flaticon-edit-1"></i>
           Ubah Petugas
          </a>
         </div>
        </div>
       </div>
      </div>
     </div>

     <div class="card" style="margin-top: 10px">
      <div class="card-body">
       <div class="row" style="padding-top: 10px">
        <div class="col-md-6 col-xs-4">
         <span class="label label-default">Radiologi</span>
        </div>
        <div class="col-md-6 col-xs-8 row">
         <div class="col-4">
          <span class="label label-default">Dr. Pembaca :</span>
         </div>
         <div class="col-8">
          <select class="dropdown-dokter-tindakan select2 dokter" required name="pembaca">
          </select>
         </div>
        </div>
       </div>
       <div class="row" style="padding-top: 10px">
        <div class="col-12">
         <table id="TabelRadio" style="width: 100%" height="200" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true" fitColumns="false" toolbar='#toolbarRadio'>
          <thead>
           <tr>
            <th data-options="field: 'nama_tindakan'" width="50%" align="left" halign="center">Nama Pemeriksaan</th>
            <th data-options="field: 'tarif'" width="100" align="left" halign="center">Tarif (RP)</th>
            <th field='dilakukan_oleh' width="150" align="left" halign="center">
             Dilakukan oleh</th>
           </tr>
          </thead>
          <tfoot>
           <tr></tr>
          </tfoot>
         </table>
         <div id="toolbarRadio">
          <a table='#TabelRadio' class="easyui-linkbutton btn-edit" id='btn-edit-radio' plain="true">
           <i class="flaticon-edit-1"></i>
           Ubah Petugas
          </a>
         </div>
        </div>
       </div>
      </div>
     </div>
     <!-- </div> -->
     <!--  <div class="col-md-6 col-sm-12" > -->
     <div class="card" style="margin-top: 10px">
      <div class="card-body">
       <table class="table table-inverse table-hover text-right">
        <tbody>
         <tr>
          <td style="width:60%">Total Detail : Rp.</td>
          <td class="tdetail">123</td>
         </tr>
         <tr>
          <td>Sisa Jasa Medis : Rp.</td>
          <td class="tjasa">123</td>
         </tr>
         <tr>
          <td>Total Paket : Rp.</td>
          <td class="tpaket">123</td>
         </tr>
         <tr>
          <td>Diskon : Rp.</td>
          <td class="tdiskon">123</td>
         </tr>
         <tr>
          <td>Total Bayar : Rp.</td>
          <td class="tbayar"></td>
         </tr>
        </tbody>
       </table>
      </div>
     </div>

     <div class="" style="margin-top: 10px">
      <div class="float-right">
       <button type="submit" class="btn btn-primary">Simpan</button>
       <button type="button" class="btn btn-secondary btn-refresh-pembayaran">Refresh</button>
       <button type="button" disabled class="btn btn-secondary ">Keluar</button>
      </div>
     </div>
     <!-- </div> -->
    </form>
   </div>
  </div>
 </div>
</div>

<div id="editTindakan" class="easyui-dialog" title="Edit Petugas" style="width:400px" data-options="closed:true,modal:true,border:' thin',buttons:'#dlg-buttons'">
 <form id="FormTindakan" method="post" novalidate style="margin:0;padding:20px 50px ;width:500 ; height:auto">
  <div class="form-group row">
   <label for="" class="col-sm-4 col-form-label">Tindakan</label>
   <div class="col-sm-8">
    <input type="text" class="form-control tindakan" disabled>
    <input type="text" class="form-control id_pakettindakan_tmp" name="id_pakettindakan_tmp" readonly>
   </div>
  </div>
  <div class="form-group row">
   <label for="" class="col-sm-4 col-form-label">Dilakukan Oleh</label>
   <div class="col-sm-8">
    <select type="text" class="form-control select2 dropdown-oleh" required name="oleh">
     <option value=""></option>
    </select>
   </div>
  </div>
 </form>
</div>

<div id="dlg-buttons">
 <div class="form-group row" style="margin-top: 15px">
  <div class="col-lg-6 col-md-12 col-sm-12">
   <button id="btn-simpan" type="submit" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
    <i class="la la-save"></i>
    Simpan
   </button>
  </div>
  <div class="col-lg-6 col-md-12 col-sm-12 kt-padding-t-10-mobile">
   <button id="btn-batal" onclick='$("#editTindakan").dialog("close")' class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
    <i class="la la-times"></i>
    Batal
   </button>
  </div>
 </div>
</div>

<div id="PanelInfo" class="easyui-dialog" style="width:500px" data-options="closed:true,modal:true,border:'thin',buttons:'#info-buttons'">
 <center class='before-loading'>
  <span class="la la-refresh la-spin" style="font-size: 40px"></span>
 </center>
 <div class="card card-default after-loading">
  <div class="kt-portlet">
   <div class="kt-portlet__body header-form">
    <div class="row">
     <div class="col-sm-12 col-md-12" style="overflow-x: auto">
      <center class='before-loading'>
       <span class="la la-refresh la-spin" style="font-size: 40px"></span>
      </center>
      <div class="panel panel-default after-loading" id="info-print">
       <div class="panel-heading">
        <table class="table table-bordered" border="1" width="100%">
         <tbody>
          <tr>
           <td style="padding: 5px;">
            <h1 class="nama_lengkap"></h1>
           </td>
          </tr>
         </tbody>
        </table>
       </div>
       <table width="100%">
        <tbody>
         <tr>
          <td>
          </td>
         </tr>
        </tbody>
       </table>
       <!-- Table -->
       <table class="table table-bordered table-hover">
        <tbody>
         <tr>
          <td style="text-align: right;">Jenis Pasien</td>
          <td width="1%">:</td>
          <td colspan="3" class="jenis_pasien"></td>
         </tr>
         <tr>
          <td style="text-align: right;">Sex / Umur</td>
          <td width="1%">:</td>
          <td colspan="3" class="umur"></td>
         </tr>
         <tr>
          <td style="text-align: right;">Alamat</td>
          <td width="1%">:</td>
          <td colspan="3" class="alamat"></td>
         </tr>

         <tr>
          <td style="text-align: right;">Nomor Telepon</td>
          <td width="1%">:</td>
          <td class="telepon"></td>
          <td>/</td>
          <td class="hp"></td>
         </tr>
         <tr>
          <td style="text-align: right;">Nama Keluarga</td>
          <td width="1%">:</td>
          <td colspan="7" class="nama_keluarga"></td>
         </tr>

         <tr>
          <td style="text-align: right;">Ibu Kandung</td>
          <td width="1%">:</td>
          <td colspan="7" class="nama_ibu"></td>
         </tr>

        </tbody>
       </table>
       <div class="panel-footer">

       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <div id="info-buttons">
  <a href="javascript:void(0)" onclick="printJS({
       printable: 'info-print',
       type: 'html',
       targetStyles: ['*'],
       style: 'body,html,table{  font-family: Calibri; font-size: 11px;} body{width:50%} table {border-collapse: collapse ; page-break-inside: avoid } tr    { page-break-inside:avoid; page-break-after:auto }thead { display:table-header-group }tfoot { display:table-footer-group } table th, table td {padding:0.25rem !important;vertical-align: top;}'})" class="btn btn-sm btn-primary c6 after-loading" style="width:90px"><i class="la la-print"></i> Print</a>

  <a href="javascript:void(0)" class="btn btn-sm btn-secondary" onclick="$('.easyui-dialog').dialog('close')" style="width:90px"> <i class="la la-times"></i>Cancel</a>
 </div>
</div>