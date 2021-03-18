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
        <form class="kt-form col-lg-12 row header-form kt-margin-t-25" id="FilterPasien">
          <div class="form-group row">
            <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm kt-font-sm">
              Nomor RM</label>
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
                <option value="">Jenis Kelamin</option>
                <?php echo getOptionList("jeniskelamin") ?>
              </select>
            </div>
            <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm kt-font-sm">
              Jenis:</label>
            <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
              <select class="select2 form-control form-control-sm dropdown-id_jnspasien id_jnspasien" required name="id_jnspasien">
                <option value="" selected>Pilih Jenis</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-form-label col-lg-1 col-md-2 col-sm-4 form-control-sm kt-font-sm">
              Tahun Daftar</label>
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
              <button type="button" class="btn btn-sm btn-primary" plain="true" id="btn-filter">
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

          <table title="Data Pasien" id="tblPasien" class="easyui-datagrid" style="width: 100%; height:480px; margin-top:5px" toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="false" singleSelect="true">
            <thead>
              <tr>
                <th field="sex" halign="center" align="center" width="50">Sex</th>
                <th field="no_mr" halign="center" align="right" width="200">No. MR</th>
                <th field="nama_lengkappx" halign="left" align="left" width="250">Nama Pasien</th>
                <th field="umur" halign="center" align="left" width="100">Umur</th>
                <th field="tmp_lahir" halign="center" align="left" width="200">Tempat Lahir</th>
                <th field="tgl_lahir" halign="center" align="center" width="150">Tgl. Lahir</th>
                <th field="kelurahan" halign="center" align="left" width="200">Desa</th>
                <th field="kecamatan" halign="center" align="left" width="200">Kecamatan</th>
                <th field="telepon" halign="center" align="right" width="150">Telepon</th>
                <th field="operator" halign="center" align="left" width="150">Operator</th>
                <th field="lengkap" halign="center" align="center" width="150">Lengkap</th>
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
            <a href="javascript:void(0)" id="btn-info" class="easyui-linkbutton" plain="true">
              <i class="la la-list-ul"></i>
              Info Px
            </a>
            <a href="javascript:void(0)" id="btn-riwayat" class="easyui-linkbutton" plain="true">
              <i class="la la-list-ul"></i>
              Riwayat Px
            </a>
            <a href="javascript:void(0)" id="btn-index" class="easyui-linkbutton" plain="true">
              <i class="la la-list-ul"></i>
              Indeks Px
            </a>
            <a href="javascript:void(0)" id="btn-gantirm" class="easyui-linkbutton" plain="true">
              <i class="flaticon-edit-1"></i>
              Ganti No.RM
            </a>
            <a href="javascript:void(0)" id="btn-stiker" class="easyui-linkbutton" plain="true">
              <i class="la la-tags"></i>
              Sticker
            </a>
            <a href="javascript:void(0)" id="btn-print" class="easyui-linkbutton" plain="true">
              <i class="la la-print"></i>
              Print
            </a>
            <a href="javascript:void(0)" id="btn-pesanpoli" class="easyui-linkbutton" plain="true">
              <i class="la la-bed"></i>
              Pesan Poli
            </a>
            <a href="javascript:void(0)" id="btn-pesankamar" class="easyui-linkbutton" plain="true">
              <i class="la la-bed"></i>
              Pesan Kamar
            </a>
            <a href="javascript:void(0)" id="btn-membercard" class="easyui-linkbutton" plain="true">
              <i class="la la-tags"></i>
              Member Card
            </a>
            <a href="javascript:void(0)" id="btn-prioritas" class="easyui-linkbutton" plain="true">
              <i class="la la-tags"></i>
              Wava Prioritas
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end content -->
<div id="PanelIndexPasien" class="easyui-dialog easyui-window " data-options="modal:true,closed:true,buttons:'#index-button',title:'Index Pasien'">
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
                        printable:'index-print',
                        type : 'html',
                        targetStyles:['*'],
                        style: 'body,html,table{  font-family: Calibri; font-size: 11px;} table {border-collapse: collapse ; page-break-inside: avoid } tr    { page-break-inside:avoid; page-break-after:auto }thead { display:table-header-group }tfoot { display:table-footer-group } table th, table td {padding:0.25rem !important;vertical-align: top;}'})" class="btn btn-sm btn-primary c6 after-loading" style="width:90px"><i class="la la-print"></i> Print</a>
      <a href="javascript:void(0)" class="btn btn-sm btn-secondary" onclick="$('#PanelIndexPasien').window('close')" style="width:90px"> <i class="la la-times"></i>Cancel</a>
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
                        printable:'info-print',
                        type : 'html',
                        targetStyles:['*'],
                        style: 'body,html,table{  font-family: Calibri; font-size: 11px;} body{width:50%} table {border-collapse: collapse ; page-break-inside: avoid } tr    { page-break-inside:avoid; page-break-after:auto }thead { display:table-header-group }tfoot { display:table-footer-group } table th, table td {padding:0.25rem !important;vertical-align: top;}'})" class="btn btn-sm btn-primary c6 after-loading" style="width:90px"><i class="la la-print"></i> Print</a>

    <a href="javascript:void(0)" class="btn btn-sm btn-secondary" onclick="$('.easyui-dialog').dialog('close')" style="width:90px"> <i class="la la-times"></i>Cancel</a>
  </div>
</div>


<div id="PanelRiwayatPasien" class="easyui-window easyui-dialog" title="Riwayat Pasien" data-options="modal:true,closed:true,title:'Riwayat Pasien',buttons:'#riwayat-buttons'">
  <div class="kt-portlet">
    <div class="kt-portlet__body header-form">
      <div class="row">
        <div class="col-sm-12 col-md-4" style="overflow-x: auto">
          <table id="RekapPasien" width="100%" height="500" title="Rekap Pasien" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" pageSize="10">
            <thead>
              <tr>
                <th width="60%" data-options="field:'rekapitulasi'">Rekapitulasi</th>
                <th width="40%" data-options="field:'jumlah'">jml</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>

        </div>
        <div class="col-sm-12 col-md-8">
          <table id="Notifikasi" height="200" title="<?= "Notifikasi" ?>" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true" style="padding-bottom: 10px">
            <thead>
              <tr>
                <th width="100%" data-options="field:'keterangan'">Keterangan</th>
              </tr>
            </thead>
          </table>
          <br>
          <table id="RiwayatPassienTb" height="200" title="<?= "Riwayat Pasien" ?>" class="easyui-datagrid" rownumbers="true" singleSelect="true" style="margin-bottom: 10px">
            <thead>
              <tr>
                <th width="15%" data-options="field:'id_mrs'">NO MRS</th>
                <th width="15%" data-options="field:'unit'">Unit</th>
                <th width="15%" data-options="field:'tgl_masuk'">MRS</th>
                <th width="15%" data-options="field:'tgl_krs'">KRS</th>
                <th width="15%" data-options="field:'cara_masuk'">Cara Masuk</th>
                <th width="15%" data-options="field:'dokter'">Dokter</th>
                <th width="15%" data-options="field:'kunjungan'">Kunj.Pasien</th>
                <th width="15%" data-options="field:'kunjungan_unit'">Kunj.Unit</th>
                <th width="15%" data-options="field:'kunjungan_kasus'">Kunj.Kasus</th>
                <th width="15%" data-options="field:'asuransi'">Asuransi</th>
                <th width="15%" data-options="field:'instansi'">Instalasi</th>
                <th width="15%" data-options="field:'admission'">Admission</th>
              </tr>
            </thead>
          </table>
          <br>
          <table id="TindakanPasien" height="300" title="<?= "List Tindakan Pasien" ?>" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true" style="padding-bottom: 10px">
            <thead>
              <tr>
                <th width="15%" data-options="field:'id_transaksi'">No Trans</th>
                <th width="15%" data-options="field:'tanggal'">Tanggal</th>
                <th width="15%" data-options="field:'jam'">Jam</th>
                <th width="15%" data-options="field:'uraian'">Uraian</th>
                <th width="15%" data-options="field:'oleh'">Oleh</th>
                <th width="15%" data-options="field:'qty'">Qty</th>
                <th width="15%" data-options="field:'operator'">Operator</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div id="riwayat-buttons">
    <a href="javascript:void(0)" class="btn btn-sm btn-secondary" onclick="$('.PanelRiwayatPasien').window('close')" style="width:90px"> <i class="la la-times"></i>Close</a>
  </div>
</div>

<div id="PanelStiker" class="easyui-dialog" style="width:500" data-options="closed:true,modal:true,border:'thin',buttons:'#stiker-buttons'">
  <div class="kt-portlet">
    <div class="kt-portlet__body header-form">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Seting Cetak</h4>
              <form id="form-stiker">
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
              </form>
            </div>
          </div>
        </div>
      </div>
      <div id="stiker-buttons">
        <a href="javascript:void(0)" onclick="PrintStriker()" class="easyui-linkbutton c6" iconCls="icon-print" style="width:90px">Print</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#PanelStiker').dialog('close')" style="width:90px">Cancel</a>
      </div>
    </div>
  </div>
</div>


<div id="PanelPesanKamar" class="easyui-dialog" style="width:500px" data-options="modal:true,closed:true,title:'Pesan Kamar',buttons:'#pesankamar-button'">
  <div class="kt-portlet">
    <div class="kt-portlet__body header-form">
      <div class="row after-loading">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <form id="FormPesanKamar">
              <div class="card-body">
                <div class="form-group row">
                  <input type="hidden" name="id_mr" class="id_mr">
                  <label class="col-md-3 col-sm-12 col-label-form">Jenis Kamar</label>
                  <div class="col-md-4 col-sm-12">
                    <select class="form-control form-control-sm select2 dropdown-jnsKamar" name="jenis" required>
                      <option value="">Pilih Jenis</option>
                    </select>
                  </div>
                  <label class="col-md-2 col-sm-12 col-label-form">Kelas</label>
                  <div class="col-md-3 col-sm-12">
                    <select class="select2 form-control form-control-sm dropdown-kelas" required name="kelas">
                    </select>
                  </div>
                </div>
                <div class="form-group form-group-sm row">
                  <label class="col-md-3 col-sm-12 col-label-form">Nomor telepon yg bisa dihubungi :</label>
                  <div class="col-md-9 row">
                    <div class="col-md-12 col-sm-12">
                      <input class="form-control form-control-sm telepon" readonly type="text">
                    </div>
                    <div class="col-md-7 col-sm-6">
                      <input class="form-control form-control-sm no" type="text" name="telepon">
                    </div>
                    <div class="col-label-form col-md-5 col-sm-6">
                      *) Tambahan
                    </div>
                  </div>
                </div>
                <div class="form-group form-group-sm row">
                  <label class="col-label-form col-md-3 col-sm-12">No Antri</label>
                  <div class="col-md-4 col-sm-12">
                    <input class="form-control form-control-sm no_antri" readonly name="no_antri">
                  </div>
                </div>
                <div class="form-group form-group-sm row">
                  <label class="col-label-form col-md-3 col-sm-12">Keterangan</label>
                  <div class="col-md-9 col-sm-12">
                    <textarea class="form-control form-control-sm keterangan" name="keterangan" style="width:100%;height:60px"></textarea>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="pesankamar-button">
    <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="PesanKamar()"> <i class="la la-save"></i>Simpan</a>
    <a href="javascript:void(0)" class="btn btn-sm btn-secondary" onclick="$('.easyui-dialog').dialog('close')" style="width:90px"> <i class="la la-times"></i>Cancel</a>
  </div>
</div>

<div id="panelPesanPoli" class="easyui-window easyui-dialog" style="width:50%" title="Panel Pesan Poli (Rencana Kontrol)" data-options="closed:true,modal:true,border:'thin',buttons:'#pesanpoli-buttons',title:'Panel Pesan Poli (Rencana Kontrol)'">

  <div class="kt-portlet">
    <div class="kt-portlet__body header-form">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h2 class="nama_lengkap">Nama Orang</h2>
              <h5 class="keterangan label label-default">Keterangannya</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                  <form id="PesanPoli" class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <span class="label" align="center">Tanggal</span>
                      <div class="easyui-calendar tanggal" current="new Date()" style="width: 100% ; height: 200px" label="Tanggal" labelPosition="top"></div>
                      <input type="hidden" class="form-control form-control-sm calendar-value " value="<?= date("d/m/Y") ?>" required name="tgl_rencana">
                      <input type="hidden" class="id_mrs" name="id_mrs">
                      <input type="hidden" class="id_mr" name="id_mr">
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <label>Jam</label>
                      <input type="text" class="form-control form-control-sm jam" name="jam">
                    </div>
                    <div class="col-md-3 col-sm-3">
                      <label>Hari</label>
                      <input type="text" class="form-control form-control-sm hari" readonly name="hari">
                    </div>
                    <div class="col-md-5 col-sm-5">
                      <label>Klinik</label>
                      <select class="select2 dropdown-klinik form-control form-control-sm klinik-poli" required name="poli">
                        <option value="">Pilih Klinik</option>
                      </select>
                    </div>
                    <div class="col-md-12">
                      <label>Dokter</label>
                      <select style="width:100%" class="form-control form-control-sm select2 dropdown-dokter" required name="dokter">
                      </select>
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <label>No Antri</label>
                      <input type="text" class="form-control form-control-sm poli-antri" required readonly name="antri">
                    </div>
                    <div class="col-md-7 col-sm-7">
                      <label>Keterangan</label>
                      <textarea type="text" class="form-control form-control-sm" name="keterangan"></textarea>
                    </div>
                  </form>

                </div>
                <div class="col-sm-12 col-md-6 col-lg-8">
                  <table id="RencanaKontrol" width="100%" height="300" class="easyui-datagrid" rownumbers="true" resizable="false" fitColumns="false">
                    <thead>
                      <tr>
                        <th halign="center" align="left" width="125" resizable="false" data-options="field:'tgl_rencana'">Tanggal</th>
                        <th halign="center" align="left" width="80" resizable="false" data-options="field:'jam'">Jam</th>
                        <th halign="center" align="left" width="125" resizable="false" data-options="field:'hari'">Hari</th>
                        <th halign="center" align="left" width="200" resizable="false" data-options="field:'dokter'">Dokter</th>
                        <th halign="center" align="left" width="80" resizable="false" data-options="field:'no_antri'">No Antri</th>
                        <th halign="center" align="left" width="125" resizable="false" data-options="field:'keterangan'">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="pesanpoli-buttons">

    <a onclick="" href="javascript:void(0)" class="easyui-linkbutton btnViewesanPoli float-left" iconCls="icon-search" style="width:150px">View</a>
    <a onclick="" href="javascript:void(0)" class="easyui-linkbutton btnCetakPesanPoli float-left" iconCls="icon-print" style="width:150px">Cetak</a>
    <a onclick="PesanPoli()" href="javascript:void(0)" class="easyui-linkbutton btnSimpanPesanPoli" iconCls="icon-save" style="width:250px">Simpan Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('.easyui-dialog').dialog('close')" style="width:100px">Tutup</a>
  </div>
</div>

<div id="GantiRm" class="easyui-dialog" style="width: 80%;" title="Ganti No RM" data-options="modal:true,closed:true,title:'Ganti No RM',buttons:'#gantirm-buttons'">
  <div class="kt-portlet">
    <div class="kt-portlet__body header-form">
      <center class='before-loading'>
        <span class="la la-refresh la-spin" style="font-size: 40px"></span>
      </center>
      <div class="row after-loading">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card">
              <div class="card-header">
                <h2 class="nama_lengkap">Nama Orang</h2>
                <h5 class="keterangan label label-default">Keterangannya</h4>
              </div>
              <form id="GantiNoRm">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-label-form col-md-3 col-sm-6">No.RM Lama</label>
                    <div class="col-md-3 col-sm-6">
                      <input type="hidden" name="id_mr" class="id_mr">
                      <input class="form-control form-control-sm no_mr" name="mr_lama" required>
                    </div>
                    <label class="col-label-form col-md-2 col-sm-6">Set Tahun</label>
                    <div class="col-md-2 col-sm-3">
                      <input class="form-control form-control-sm tahun no" maxlength="4" minlength="4" name="tahun" value="<?= date("Y") ?>" required>
                    </div>
                    <a class="form-control form-control-sm btn btn-sm btn-secondary col-md-2 col-sm-3" onclick="GetNoBaru()"><i class="la la-refresh"></i>Refresh</a>
                  </div>
                  <div class="form-group form-group-sm row">
                    <label class="col-label-form col-md-3 col-sm-6">No.RM Baru</label>
                    <div class="col-md-3 col-sm-6">
                      <input class="form-control form-control-sm no_mr_baru" readonly name="no_mr" required>
                    </div>
                    <label class="col-label-form col-md-2 col-sm-6">Jenis Pasien</label>
                    <div class="col-md-4 col-sm-6">
                      <select class="select2 form-control form-control-sm dropdown-id_jnspasien id_jnspasien" required name="id_jnspasien">
                        <option value="" selected>Pilih Jenis</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label class="col-label-form col-md-3 col-sm-6">Tgl Ganti</label>
                    <div class="col-md-3 col-sm-6">
                      <input class="form-control form-control-sm tgl_ganti" type="date-only-formatted" required readonly name="tgl_ganti">
                    </div>
                    <label class="col-label-form col-md-2 col-sm-6">Alasan</label>
                    <div class="col-md-4 col-sm-6">
                      <select class="dropdown-alasan select2 form-control form-control-sm">
                        <option value="Petugas Salah entry data , diganti pasien lain">Petugas Salah entry data , diganti pasien lain</option>
                        <option value="Pasien tidak jadi priksa , diganti pasien lain">Pasien tidak jadi priksa , diganti pasien lain</option>
                        <option value="Pasien Sudah punya No.RM lain">Pasien Sudah punya No.RM lain</option>
                        <option value="Ganti Kode Jenis Pasien">Ganti Kode Jenis Pasien</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-label-form col-md-3 col-sm-6">Uraian</label>
                    <div class="col-md-9 col-sm-6">
                      <textarea class="form-control form-control-sm uraian" name="keterangan" style="width:100%;height:60px">
                    </textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="gantirm-buttons">

    <button onclick="GantiRm()" class=" btn btn-sm btn-primary">
      <i class="la la-save"></i>Simpan
    </button>
    <a href="javascript:void(0)" onclick="$('#GantiRm').window('close')" class="btn btn-sm btn-danger  ">
      <i class=" la la-close"></i>Keluar
    </a>
  </div>
</div>