<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">User</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Hak Akses</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">User</a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Subheader -->
<!-- begin:: Content -->
<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header">
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Status :</label>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-status">
                                        <option value="0">All</option>
                                        <option value="1" selected>Aktif</option>
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
                        <!-- <div class="col-lg-auto">
                            <div class="form-group row">
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="">
                                        <i class="la la-plus"></i>
                                        Tambah User
                                    </button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </form>
                <div id="form-btn" class="col-lg-12" style="margin-top: 10px;">
                    <div class="form-group row pull-right">
                        <div class="col-lg-auto col-md-4 col-sm-12 kt-padding">
                            <button id="btn-kembali" type="button" class="form-control form-control-sm btn btn-sm btn-secondary">
                                <i class="fas fa-angle-double-left"></i>
                                Kembali
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-4 col-sm-12 kt-padding">
                            <button onclick="simpan(1)" type="button" class="form-control form-control-sm btn btn-sm btn-primary">
                                <i class="la la-save"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabel1" style="margin-top: 20px;" class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-user" title="Daftar User" class="easyui-datagrid" style="width: 100%;height:480px; margin-top:5px" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                        <thead>
                            <tr>
                                <th  halign="center" align="center" width="10%" field="user_id">ID</th>
                                <th  halign="center" align="left"   width="10%" field="user_type">Tipe</th>
                                <th  halign="center" align="left"   width="15%" field="user_name">Nama User</th>
                                <th  halign="center" align="left"   width="30%" field="user_fullname">Karyawan</th>
                                <th  halign="center" align="left"   width="30%" field="email">Email</th>
                                <th  halign="center" align="left"   width="30%" field="nama_unit">Unit Default</th>
                                <th  halign="center" align="left"   width="15%" field="is_active">Status</th>
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
            <div id="form-detail" style="margin-top: -35px;" class="kt-portlet__body header-form">
                <div class="row">
                    <div class="col-lg-5">
                        <form class="kt-form col-lg-12 header-form">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm">
                                    ID :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-id" class="form-control form-control-sm" disabled="true" type="text">
                                </div>
                                <div class="form-group row">
                                    <label class="kt-checkbox--success form-control-sm" style="margin-left: 20px;">
                                        <input id="chk-is_aktif" name="chk-is_aktif" type="checkbox"> Aktif
                                    </label>
                                    <!-- <div class="col-lg-1 col-sm-12" style="margin-left: 30px; margin-top: 5px">
                                        <input name="chk-is_aktif" type="checkbox" id="chk-is_aktif">
                                    </div> -->
                                    <!-- <label class="kt-checkbox--success col-lg-3 col-sm-12">
                                        <input name="chk-is_aktif" type="checkbox" id="chk-is_aktif">
                                        Aktif
                                    </label> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm">
                                    Type :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <select class="select form-control form-control-sm" id="cmb-type">
                                        <option value="1">User</option>
                                        <option value="2">Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm">
                                    Nama User :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-nama_user" class="form-control form-control-sm" disabled="true" type="text">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <!-- <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    NIK :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-nik" class="form-control form-control-sm" type="text">
                                </div> -->
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm">
                                    Karyawan :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-nama_lengkap" class="form-control form-control-sm" disabled="true" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form class="kt-form header-form">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Email :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-email" class="form-control form-control-sm" disabled="true" type="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Password :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-password" class="form-control form-control-sm" type="password">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Ulangi :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-ulangi_password" class="form-control form-control-sm" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm" style="padding-right: 5px">
                                    Unit Default :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <select class="select2 form-control" id="cmb-data_unit">
                                    </select>
                                    <!-- <input id="txt-unit_default" class="form-control form-control-sm" type="text"> -->
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
            <div id="tabel-role" style="margin-top: -20px;" class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="col-12 table-custom">
                    <table id="dtg-detail_role" style="width: 96%;height:280px;" title="Daftar Role" class="easyui-datagrid" toolbar="#toolbarDetailUser" pagination="false" rownumbers="false">
                        <thead>
                            <tr>
                                <th field="pilih" checkbox="true">pilih</th>
                                <th field="role_id" halign="center" align="left" width="10%" >kode</th>
                                <th field="role_name" halign="center" align="left" width="40%">Role</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="toolbarDetailUser">
                        <a href="#" id="btn-tambah_detail" class="easyui-linkbutton" plain="true">
                            <i class="la la-plus"></i>
                            Tambah
                        </a>
                        <a id="btn_hapus_detail" class="easyui-linkbutton" plain="true">
                            <i class="flaticon2-trash"></i>
                            Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-detail" class="panel-window" data-title="Pencarian Data Item" style="width: 50%; height: 85%">
        <div class="kt-portlet">
            <form class="kt-portlet__body header-form">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                Kriteria:
                            </label>
                            <div class="col-lg-7 col-sm-12">
                                <input name="searchText" class="form-control form-control-sm" type="text" id="txt-search" placeholder="Cari...">
                            </div>
                            <div class="col-lg-3 col-sm-12 kt-margin-t-20-mobile">
                                <button id="btn-filter_data_item" class="form-control form-control-sm btn btn-sm btn-primary">
                                    <i class="la la-filter"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="kt-form col-lg-12 header-form" id="form-detail">
                <div class="row">
                    <div class="col-lg-12 table-detail">
                        <table id="dg-data_item" height="350" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true">
                            <thead>
                                <tr>
                                  <th field="no" halign="center" align="right" width="10%" >Pilih</th>
                                  <th field="kode" halign="center" align="right" width="25%">Kode</th>
                                  <th field="unit" halign="center" align="right" width="65%">Unit</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="kt-form col-lg-12 header-form">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                    <i class="la la-save"></i>
                                    Tambahkan
                                </button>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-12 kt-padding-t-10-mobile">
                                <button id="btn-tutup" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                    <i class="la la-times"></i>
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="win-detail_akses_role" class="panel-window" data-title="Daftar Role" style="width: 50%; height: 85%">
                <div class="kt-portlet">
                    <form class="kt-portlet__body header-form">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                        Kriteria:
                                    </label>
                                    <div class="col-lg-7 col-sm-12">
                                        <input class="form-control form-control-sm" type="text" id="txt-criteria_role" placeholder="Cari...">
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
                    <div id="form-detail" class="kt-form col-lg-12 header-form" style="margin-top: 10px;">
                        <div class="row">
                            <div class="col-lg-12 table-detail">
                                <table id="dtg-daftar_akses_role" height="350" width="100%" class="easyui-datagrid" pagination="false" singleSelect="false">
                                    <thead>
                                        <tr>
                                          <th field="pilih" checkbox="true">Pilih</th>
                                          <th field="role_id" halign="center" align="left" width="25%" hidden>ID</th>
                                          <th field="role_name" halign="center" align="left" width="25%">Role</th>
                                          <th field="role_desc" halign="center" align="left" width="65%">Deskripsi</th>
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
        </div>
    </div>
</div>
<!-- end content