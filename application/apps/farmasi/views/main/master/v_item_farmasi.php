<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Barang Farmasi</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Barang Farmasi</a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->
<!-- begin:: Content -->
<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile" id="browse">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header">
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Status :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-status">
                                        <option value="0">All</option>
                                        <option value="1" selected>Aktif</option>
                                        <option value="2">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                <div class="col-lg-5 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input class="form-control form-control-sm" type="text" id="txt-criteria" placeholder="Cari..." required>
                                </div>
                                <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <div class="form-group row">
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah();">
                                        <i class="la la-plus"></i>
                                        Tambah Barang Farmasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-item_farmasi" height="430" width="100%" title="Daftar Barang Farmasi" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <!--  -->
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile" id="detail">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header" style="margin-top: 10px">
                    <div class="row kt-line-header">
                        <div class="col-lg-5">
                            <div class="form-group row" id="div_status">
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm" id="txt-label" style="text-transform: uppercase">
                                    <!-- Acentram C TAB -->
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group row justify-content-lg-between">
                                <div class="col-lg-auto kt-padding-t-10-mobile">
                                    <div class="form-group row" id="btn-aksi">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-auto kt-padding-t-10-mobile">
                                    <div class="form-group row">
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-kembali" type="button" class="form-control form-control-sm btn btn-sm btn-secondary" onclick="tab(0)">
                                                <i class="fas fa-angle-double-left"></i>
                                                Kembali
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto div_simpan">
                                            <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="simpan()">
                                                <i class="la la-save"></i>
                                                Simpan
                                            </button>
                                        </div>  
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kode Item :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="txt-kd_item" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                                <label class="kt-checkbox--success" style="margin-left: 20px; margin-top: 7px;">
                                    <input id="chk-is_aktif" name="chk-is_aktif" type="checkbox" checked="true"> Aktif
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Nama Item :
                                </label>
                                <div class="col-lg-10 col-sm-12">
                                    <input id="txt-nama_item" class="form-control form-control-sm" type="text" style="text-transform: uppercase">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kelompok :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-kelompok">
                                    </select>
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Golongan :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-golongan">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kategori :
                                </label>
                                <div class="col-lg-10 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-kategori">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Bentuk :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-bentuk">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Satuan Besar :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-satuan_besar">
                                        
                                    </select>
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Rasio :
                                </label>
                                <div class="col-lg-2 col-sm-12">
                                    <input id="nmb-rasio" class="form-control form-control-sm easyui-numberbox" style="width: 100%; text-align: right; padding-right: 10px">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Formularium :
                                </label>
                                <label class="kt-checkbox--success form-control-sm kt-font-sm" style="margin-left: 0px;">
                                    <input id="chk-rumah_sakit" name="chk-rumah_sakit" type="checkbox"> Rumah Sakit
                                </label>
                                <label class="kt-checkbox--success form-control-sm kt-font-sm" style="margin-left: 20px;">
                                    <input id="chk-nasional" name="chk-nasional" type="checkbox"> Nasional
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Keterangan :
                                </label>
                                <div class="col-lg-10 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;" id="txt-keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    <!--  -->
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <!--  -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Produsen :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-produsen">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Jenis :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-jenis">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kelas Terapi :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-kelas_terapi">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    <!--  -->
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <!--  -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Satuan Kecil :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-satuan_kecil">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row div_hidden">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-id_item" class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="tabs-detail" style="height: 400px; max-height: 400px; margin-top: 15px;">
                        <div class="col-lg-12">
                            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-lokasi_item" role="tab" data-toggle="tab">Lokasi Item</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-kombosisi_obat" role="tab" data-toggle="tab">Komposisi Obat</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-supplier" role="tab" data-toggle="tab">Supplier</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active" id="tab-lokasi_item">
                                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                            <table id="dtg-lokasi_item" class="easyui-datagrid" style="width: 100%;height:300px;" toolbar="#toolbar1" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                <thead>
                                                    <tr>
                                                        <!-- <th field="pilih" checkbox="true">Pilih</th> -->
                                                        <th field="id_lokasi" halign="center" align="left" width="30%" hidden="true">ID</th>
                                                        <th field="nama_unit" halign="center" align="left" width="30%">Depo</th>
                                                        <th field="nama_lokasi" halign="center" align="left" width="20%">Rak</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div id="toolbar1">
                                                <a href="#" id="btn-tambah_lokasi_item" class="easyui-linkbutton" plain="true">
                                                    <i class="la la-plus"></i>
                                                    Tambah
                                                </a>
                                                <a href="#" id="btn-hapus_lokasi_item" class="easyui-linkbutton" plain="true">
                                                    <i class="flaticon2-trash"></i>
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpane1" class="tab-pane fade active form-group row kt-container kt-container-form" id="tab-kombosisi_obat">
                                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                            <table id="dtg-komposisi_obat" class="easyui-datagrid" style="width: 100%;height:300px;" toolbar="#toolbar2" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                <!-- <thead>
                                                    <tr>
                                                        <th field="trans_name" halign="center" width="30%">Zat Sediaan</th>
                                                        <th field="trans_desc" halign="center" width="20%">Kekuatan</th>
                                                        <th field="trans_desc" halign="center" width="20%">Satuan</th>
                                                    </tr>
                                                </thead> -->
                                            </table>
                                            <div id="toolbar2" class="form-group row">
                                                <a style="margin-left: 10px;" href="#" id="btn-tambah_komposisi" class="easyui-linkbutton" plain="true" onclick="tambah_komposisi()">
                                                    <i class="la la-plus"></i>
                                                    Tambah
                                                </a>
                                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" style="margin-left: 10px;">
                                                    Sifat Sediaan:
                                                </label>
                                                <div class="col-lg-2 col-sm-12">
                                                    <input id="txt-sifat_sediaan" class="form-control form-control-sm" type="text" disabled="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpane1" class="tab-pane fade active" id="tab-supplier">
                                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                            <table id="dtg-akses_transaksi" class="easyui-datagrid" style="width: 100%;height:300px;" toolbar="#toolbar3" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                <thead>
                                                    <tr>
                                                        <th field="partner_id" halign="center" align="left" width="35%" hidden="true">ID</th>
                                                        <th field="partner_name" halign="center" align="left" width="35%">Nama Supplier</th>
                                                        <th field="is_default" halign="center" align="left" hidden="true">Is Default</th>
                                                        <th field="icon" halign="center" align="center" width="5%">Default</th>
                                                        <!-- <th field="pilih" checkbox="true"></th> -->
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div id="toolbar3">
                                                <a href="#" id="btn-tambah_supplier" class="easyui-linkbutton" plain="true">
                                                    <i class="la la-plus"></i>
                                                    Tambah
                                                </a>
                                                <a href="#" id="btn-hapus_supplier" class="easyui-linkbutton" plain="true">
                                                    <i class="flaticon2-trash"></i>
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 0px; margin-bottom: 15px;">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding div_simpan">
                                    <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan()">
                                        <i class="la la-save"></i>
                                        Simpan
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                                    <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tab(0)">
                                        <i class="la la-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                                    <button id="btn-hapus" type="button" class="form-control form-control-sm btn-sm btn btn-danger kt-font-sm" onclick="hapus()">
                                        <i class="la la-trash"></i>
                                        Hapus
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 2px">
                                    <!-- <button id="btn-cetak" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                        <i class="la la-print"></i>
                                        Cetak
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="win-tambah_lokasi_item" class="panel-window" style="height:83%; width: 50%" data-title="Daftar Lokasi Barang">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Depo :</label>
                                <div class="col-lg-8 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <select class="form-control form-control-sm select2" id="cmb-lokasi">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-daftar_lokasi" height="360" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="false">
                                <thead>
                                    <tr>
                                        <th field="pilih" checkbox="true"></th>
                                        <th halign="center" align="left" field="id_lokasi" width="35%" hidden="true">ID</th>
                                        <th halign="center" align="left" field="kd_lokasi" width="35%">Kode Rak</th>
                                        <th halign="center" align="left" field="nama_lokasi" width="60%">Nama Rak</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button type="button" id="btn-tambahkan_lokasi" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="tambahkan_lokasi()">
                                <i class="la la-check"></i>
                                Tambahkan
                            </button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-tutup_lokasi" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="batal()">
                                <i class="la la-times"></i>
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-cari_supplier" class="panel-window" style="height:83%; width: 70%" data-title="Pencarian Data Supplier">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Kriteria :</label>
                                <div class="col-lg-7 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input class="form-control form-control-sm" type="text" id="txt-criteria_supplier" placeholder="Cari..." required>
                                </div>
                                <div class="col-lg-3 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter_supplier()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-data_supplier" height="355" width="100%" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="false">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="partner_id" width="13%">ID Supplier</th>
                                        <th halign="center" align="left" field="partner_name" width="30%">Nama Supplier</th>
                                        <th halign="center" align="left" field="partner_address" width="30%">Alamat</th>
                                        <th halign="center" align="left" field="partner_phone" width="13%">No. Telepon</th>
                                        <th halign="center" align="left" field="contact_person" width="10%">Contact Person</th>
                                        <th halign="center" align="left" field="data_partner" width="10%" hidden="true">Contact Person</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button type="button" id="btn-pilih_supplier" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_supplier()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_supplier" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="batal()">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>