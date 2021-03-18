<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Role</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Hak Akses</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Role</a>
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
                <form id="form-header" class="kt-form col-lg-12 header-form kt-margin-t-25">
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Status :</label>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-status">
                                        <option value="0">All</option>
                                        <option value="1" selected="true">Aktif</option>
                                        <option value="2">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                <div class="col-lg-4 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-criteria" placeholder="Cari..." required>
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
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="">
                                        <i class="la la-plus"></i>
                                        Tambah Role
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="tabel-1" style="margin-top: 20px;" class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-daftar_role" title="Daftar Role" class="easyui-datagrid" style="width: 100%;height:420px; margin-top:5px" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                        <thead>
                        <tr>
                            <th field="role_id" halign="center" align="left" width="5%">ID</th>
                            <th field="role_name" halign="center" align="left" width="25%">Nama Role</th>
                            <th field="role_desc" halign="center" align="left" width="45%">Deskripsi</th>
                            <th field="tags" halign="center" align="left" width="15%">Tag</th>
                            <th field="is_active" halign="center" align="center" width="10%">Status</th>
                        </tr>
                        </thead>
                    </table>
                    <div id="toolbar">
                        <!-- <a href="javascript:void(0)" id="btn-tambah" class="easyui-linkbutton" plain="true">
                            <i class="la la-plus"></i>
                            Tambah
                        </a>
                        <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton" plain="true">
                            <i class="flaticon2-trash"></i>
                            Hapus
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile" id="detail">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25">
                    <div id="form-btn" class="col-lg-12" style="margin-top: 10px;">
                        <div class="form-group row pull-right">
                            <div class="col-lg-auto col-md-4 col-sm-12 kt-padding">
                                <button id="btn-kembali" type="button" class="form-control form-control-sm btn btn-sm btn-secondary">
                                    <i class="fas fa-angle-double-left"></i>
                                    Kembali
                                </button>
                            </div>
                            <div class="col-lg-auto col-md-4 col-sm-12 kt-padding">
                                <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary">
                                    <i class="la la-save"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm font-kt-sm">
                                    ID :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-role_id" class="form-control form-control-sm font-kt-sm" type="text">
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-1 col-sm-12" style="margin-left: 30px; margin-top: 8px;">
                                        <input name="chk-is_aktif" type="checkbox" id="chk-is_aktif">
                                    </div>
                                    <label for="chk-is_aktif" class="col-form-label col-lg-1 col-sm-12 form-control-sm font-kt-sm">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm font-kt-sm">
                                    Nama Role :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-role_name" class="form-control form-control-sm font-kt-sm" type="text">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm font-kt-sm">
                                    Deskripsi :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-role_desc" class="form-control form-control-sm font-kt-sm" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm font-kt-sm">
                                    Tag :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-tags" class="form-control form-control-sm font-kt-sm" type="text">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tabs-detail" class="easyui-tabs kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                        <div class="row" title="Akses Modul">
                            <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
                                <table id="dtg-akses_modul" class="easyui-datagrid" style="width: 100%;height:300px;" toolbar="#toolbar1" pagination="false" idField="id" rownumbers="false" fitColumns="true" singleSelect="false" autoRowHeight="true" nowrap="false">
                                    <thead>
                                        <tr>
                                            <th field="pilih" checkbox="true">Pilih</th>
                                            <th field="module_id" halign="center" width="15%">Modul ID</th>
                                            <th field="module_code" halign="center" width="35%">Modul</th>
                                            <th field="module_desc" halign="center" width="50%">Deskripsi</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div id="toolbar1">
                                    <a href="#" id="btn-tambah_akses_modul" class="easyui-linkbutton" plain="true">
                                        <i class="la la-plus"></i>
                                        Tambah
                                    </a>
                                    <a href="#" id="btn-hapus_akses_modul" class="easyui-linkbutton" plain="true">
                                        <i class="flaticon2-trash"></i>
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row" title="Akses Menu">
                            <div class="col-lg-2">
                                <table id="dtg-akses_menu_a" class="easyui-datagrid" style="height: 300px; width: 100%" pagination="false" idField="id" rownumbers="false" singleSelect="true" fitColumns="false">
                                    <thead>
                                        <tr>
                                            <th field="module_id" halign="center" width="5%" hidden="true">ID</th>
                                            <th field="module_code" halign="center" width="90%">Modul</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-lg-5">
                                <table id="dtg-akses_menu_b" class="easyui-treegrid" style="height: 300px; width: 100%" rownumbers="true" idField="menu_id" treeField="menu_title" singleSelect="true">
                                    <thead>
                                        <tr>
                                            <th field="menu_id" halign="center" width="5%" hidden="true">ID</th>
                                            <th field="menu_title" halign="center" width="80%">Menu</th>
                                            <th field="icon" halign="center" align="center" width="12%">Pilih</th>
                                            <th field="is_granted" halign="center" width="5%" hidden="true">IS</th>
                                            <!-- <th field="pilih" checkbox="true">Pilih</th> -->
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="col-lg-5">
                                <table id="dtg-akses_menu_c" class="easyui-datagrid" style="height: 300px; width: 100%" pagination="false" idField="id" rownumbers="false" singleSelect="true">
                                    <thead>
                                        <tr>
                                            <!-- <th field="pilih" checkbox="true">Pilih</th> -->
                                            <!-- <th field="Kelompok" halign="center" width="20%">Kelompok</th> -->
                                            <th field="func_id" halign="center" width="5%" hidden="true">Fungsi ID</th>
                                            <th field="func_name" halign="center" width="50%">Fungsi</th>
                                            <!-- <th field="object" halign="center" width="30%">Object</th> -->
                                            <th field="action" halign="center" width="30%">Aksi</th>
                                            <th field="icon" halign="center" align="center" width="12%">Pilih</th>
                                            <th field="is_granted" halign="center" width="5%" hidden="true">IS</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="row" title="Akses Transaksi">
                            <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
                                <table id="dtg-akses_transaksi" class="easyui-datagrid" style="width: 100%;height:300px;" toolbar="#toolbar3" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="false" autoRowHeight="true" nowrap="false">
                                    <thead>
                                        <tr>
                                            <th field="pilih" checkbox="true">Pilih</th>
                                            <th field="trans_code" halign="center" width="10%">Kode</th>
                                            <th field="trans_name" halign="center" width="30%">Nama Transaksi</th>
                                            <th field="trans_desc" halign="center" width="40%%">Deskripsi</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div id="toolbar3">
                                    <a href="#" id="btn-tambah_akses_transaksi" class="easyui-linkbutton" plain="true">
                                        <i class="la la-plus"></i>
                                        Tambah
                                    </a>
                                    <a href="#" id="btn-hapus_akses_transaksi" class="easyui-linkbutton" plain="true">
                                        <i class="flaticon2-trash"></i>
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row" title="Akses Unit">
                            <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
                                <table id="dtg-akses_unit" class="easyui-datagrid" style="width: 100%;height:300px;" toolbar="#toolbar4" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="false" autoRowHeight="true" nowrap="false">
                                    <thead>
                                        <tr>
                                            <th field="pilih" checkbox="true">Pilih</th>
                                            <th field="id_unit" halign="center" width="3%" hidden="true">ID</th>
                                            <th field="no_unit" halign="center" width="10%">Cost Center</th>
                                            <th field="nama_unit" halign="center" width="40%">Unit</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div id="toolbar4">
                                    <a href="#" id="btn-tambah_akses_unit" class="easyui-linkbutton" plain="true">
                                        <i class="la la-plus"></i>
                                        Tambah
                                    </a>
                                    <a href="#" id="btn-hapus_akses_unit" class="easyui-linkbutton" plain="true">
                                        <i class="flaticon2-trash"></i>
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;margin-left: 0px;margin-right: 0px;" id="footer_detail">
                        <div class="col-lg-auto col-md-auto col-sm-auto div_simpan kt-padding">
                            <button id="btn-simpan" type="button"
                                    class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan()">
                                <i class="la la-save"></i>
                                Simpan
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding">
                            <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tab(0)">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding">
                            <button id="btn-hapus" type="button" class="form-control form-control-sm btn btn-sm btn-danger kt-font-sm" onclick="hapus()">
                                <i class="flaticon2-trash"></i>
                                Hapus
                            </button>
                        </div>
                    </div>

                    <!-- <div class="row" id="tabs-detail" style="height: 400px; max-height: 400px">
                        <div class="col-lg-12">
                            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-modul" role="tab" data-toggle="tab">Akses Modul</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-menu" role="tab" data-toggle="tab">Akses Menu</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-transaksi" role="tab" data-toggle="tab">Akses Transaksi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-unit" role="tab" data-toggle="tab">Akses Unit</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active table-custom-details" id="tab-modul">
                                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
                                            <table id="dtg-akses_modul" class="easyui-datagrid" style="width: 100%;height:300px;" toolbar="#toolbar1" pagination="false" idField="id" rownumbers="false" fitColumns="true" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                <thead>
                                                    <tr>
                                                        <th field="pilih" checkbox="true">Pilih</th>
                                                        <th field="module_code" halign="center" width="35%">Modul</th>
                                                        <th field="module_desc" halign="center" width="50%">Deskripsi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div id="toolbar1">
                                                <a href="#" id="btn-tambah_akses_modul" class="easyui-linkbutton" plain="true">
                                                    <i class="la la-plus"></i>
                                                    Tambah
                                                </a>
                                                <a href="#" id="btn_hapus_akses_modul" class="easyui-linkbutton" plain="true">
                                                    <i class="flaticon2-trash"></i>
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpane1" class="tab-pane fade active form-group row kt-container kt-container-form" id="tab-menu">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <table id="dtg-akses_menu_a" class="easyui-datagrid" style="height: 300px;" pagination="false" idField="id" rownumbers="false" fitColumns="true" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                    <thead>
                                                        <tr>
                                                            <th field="modul" halign="center" width="100%">Modul</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="col-lg-5">
                                                <table id="dtg-akses_menu_b" class="easyui-treegrid" style="height: 300px;" rownumbers="true" idField="id" treeField="menu">
                                                    <thead>
                                                        <tr>
                                                            <th field="menu" halign="center" width="90%">Menu</th>
                                                            <th field="pilih" checkbox="true">Pilih</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="col-lg-5">
                                                <table id="dg-akses_menu_c" class="easyui-datagrid" style="height: 300px;" pagination="false" idField="id" rownumbers="false" fitColumns="true" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                    <thead>
                                                        <tr>
                                                            <th field="pilih" checkbox="true">Pilih</th>
                                                            <th field="Kelompok" halign="center" width="20%">Kelompok</th>
                                                            <th field="fungsi" halign="center" width="30%">Fungsi</th>
                                                            <th field="object" halign="center" width="30%">Object</th>
                                                            <th field="aksi" halign="center" width="10%">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpane1" class="tab-pane fade active" id="tab-transaksi">
                                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
                                            <table id="dtg-akses_transaksi" class="easyui-datagrid" style="width: 100%;height:300px;" toolbar="#toolbar3" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                <thead>
                                                    <tr>
                                                        <th field="pilih" checkbox="true">Pilih</th>
                                                        <th field="trans_code" halign="center" width="10%">Kode</th>
                                                        <th field="trans_name" halign="center" width="30%">Nama Transaksi</th>
                                                        <th field="trans_desc" halign="center" width="40%%">Deskripsi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div id="toolbar3">
                                                <a href="#" id="btn-tambah_akses_transaksi" class="easyui-linkbutton" plain="true">
                                                    <i class="la la-plus"></i>
                                                    Tambah
                                                </a>
                                                <a href="#" id="btn_hapus_akses_transaksi" class="easyui-linkbutton" plain="true">
                                                    <i class="flaticon2-trash"></i>
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpane1" class="tab-pane fade active" id="tab-unit">
                                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
                                            <table id="dtg-akses_unit" class="easyui-datagrid" style="width: 100%;height:300px;" toolbar="#toolbar4" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                <thead>
                                                    <tr>
                                                        <th field="pilih" checkbox="true">Pilih</th>
                                                        <th field="no_unit" halign="center" width="5%">Kode</th>
                                                        <th field="nama_unit" halign="center" width="40%">Unit</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div id="toolbar4">
                                                <a href="#" id="btn-tambah_akses_unit" class="easyui-linkbutton" plain="true">
                                                    <i class="la la-plus"></i>
                                                    Tambah
                                                </a>
                                                <a href="#" id="btn_hapus_akses_unit" class="easyui-linkbutton" plain="true">
                                                    <i class="flaticon2-trash"></i>
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </form>
            </div>
        </div>
    </div>
    
    <!-- start panel-window akses modul -->
    <div id="win-detail_akses_modul" class="panel-window" data-title="Daftar Modul" style="width: 60%; height: 85%">
        <div class="kt-portlet">
            <form class="kt-portlet__body header-form">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                Kriteria:
                            </label>
                            <div class="col-lg-7 col-sm-12">
                                <input class="form-control form-control-sm" type="text" id="txt-criteria_modul" placeholder="Cari...">
                            </div>
                            <div class="col-lg-3 col-sm-12 kt-margin-t-20-mobile">
                                <button type="button" id="btn-filter_modul" class="form-control form-control-sm btn btn-sm btn-primary" onclick="filterModul()">
                                    <i class="la la-filter"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div id="form-detail" class="kt-form col-lg-12 header-form" style="margin-top: -18px">
                <div class="row">
                    <div class="col-lg-12 table-detail">
                        <table id="dtg-daftar_akses_modul" height="360" width="100%" class="easyui-datagrid" pagination="false" singleSelect="false">
                            <thead>
                                <tr>
                                  <th field="pilih" checkbox="true">Pilih</th>
                                  <th field="module_id" halign="center" align="left" width="15%">ID</th>
                                  <th field="module_code" halign="center" align="left" width="15%">Modul</th>
                                  <th field="module_desc" halign="center" align="left" width="65%">Deskripsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="kt-form col-lg-12 header-form">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <button id="btn-tambahkan_modul" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                    <i class="la la-save"></i>
                                    Tambahkan
                                </button>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12 kt-padding-t-10-mobile">
                                <button id="btn-batal_detail_akses_modul" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                    <i class="la la-times"></i>
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end panel-window akses modul -->

    <!-- start panel-window akses transaksi -->
    <div id="win-detail_akses_transaksi" class="panel-window" data-title="Daftar Kode Transaksi" style="width: 60%; height: 85%">
        <div class="kt-portlet">
            <form class="kt-portlet__body header-form">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                Kriteria:
                            </label>
                            <div class="col-lg-7 col-sm-12">
                                <input class="form-control form-control-sm" type="text" id="txt-criteria_transaksi" placeholder="Cari...">
                            </div>
                            <div class="col-lg-3 col-sm-12 kt-margin-t-20-mobile">
                                <button type="button" id="btn-filter_transaksi" class="form-control form-control-sm btn btn-sm btn-primary" onclick="filterTransaksi()">
                                    <i class="la la-filter"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="kt-form col-lg-12 header-form" id="form-detail" style="margin-top: -18px">
                <div class="row">
                    <div class="col-lg-12 table-detail">
                        <table id="dtg-daftar_akses_transaksi" height="360" width="100%" class="easyui-datagrid" fitColumns="true" pagination="false" singleSelect="false">
                            <thead>
                                <tr>
                                  <th field="pilih" checkbox="true">Pilih</th>
                                  <th field="trans_code" halign="center" align="left" width="20%">Kode</th>
                                  <th field="trans_name" halign="center" align="left" width="30%">Nama Transaksi</th>
                                  <th field="trans_desc" halign="center" align="left" width="40%">Deskripsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="kt-form col-lg-12 header-form">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-12">
                                <button id="btn-tambahkan_transaksi" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                    <i class="la la-save"></i>
                                    Tambahkan
                                </button>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12 kt-padding-t-10-mobile">
                                <button id="btn-tutup_detail_transaksi" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                    <i class="la la-times"></i>
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end panel-window akses transaksi -->

    <!-- start panel-window akses unit -->
    <div id="win-detail_akses_unit" class="panel-window" data-title="Daftar Unit" style="width: 50%; height: 85%">
        <div class="kt-portlet">
            <form class="kt-portlet__body header-form">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                Kriteria:
                            </label>
                            <div class="col-lg-7 col-sm-12">
                                <input class="form-control form-control-sm" type="text" id="txt-criteria_unit" placeholder="Cari...">
                            </div>
                            <div class="col-lg-3 col-sm-12 kt-margin-t-20-mobile">
                                <button type="button" id="btn-filter_unit" class="form-control form-control-sm btn btn-sm btn-primary" onclick="filterUnit()">
                                    <i class="la la-filter"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="kt-form col-lg-12 header-form" id="form-detail" style="margin-top: -18px">
                <div class="row">
                    <div class="col-lg-12 table-detail">
                        <table id="dtg-daftar_akses_unit" height="360" width="100%" class="easyui-datagrid" fitColumns="true" pagination="false" singleSelect="false">
                            <thead>
                                <tr>
                                  <th field="pilih" checkbox="true">Pilih</th>
                                  <th field="id_unit" halign="center" align="left" width="30%">Kode</th>
                                  <th field="nama_unit" halign="center" align="left" width="50%">Unit</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="kt-form col-lg-12 header-form">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <button id="btn-tambahkan_unit" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                    <i class="la la-save"></i>
                                    Tambahkan
                                </button>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12 kt-padding-t-10-mobile">
                                <button id="btn-tutup_detail_unit" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                    <i class="la la-times"></i>
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end panel-window akses unit -->
</div>
<!-- end content