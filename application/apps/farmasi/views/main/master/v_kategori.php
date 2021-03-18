<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Kategori</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Kategori</a>
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
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Status :
                                </label>
                                <div class="col-lg-5 col-sm-12">
                                    <select class="select form-control form-control-sm" id="cmb-status">
                                        <option value="0" selected>All</option>
                                        <option value="1">Aktif</option>
                                        <option value="2">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-5 col-sm-12">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-search">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button type="button" plain="true" class="easyui-linkbutton btn-primary" onclick="filter();">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-kategori" style="width: 100%;height:480px; margin-top:5px" title="Daftar Kategori" class="easyui-datagrid" toolbar="#toolbar" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                        
                    </table>
                    <!-- <div id="right_click" class="easyui-menu">
                        <div onclick="ubah();">Ubah</div>
                        <div onclick="tampil();">Tampil</div>
                        <div onclick="hapus(row);">Hapus</div>
                    </div> -->
                    <div id="toolbar">
                        <a href="javascript:void(0)" id="btn-tambah" class="easyui-linkbutton" plain="true">
                            <i class="la la-plus"></i>
                            Tambah
                        </a>
                        <a href="javascript:void(0)" id="btn-ubah" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
                            Ubah
                        </a>
                        <a href="javascript:void(0)" id="btn-tampil" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
                            Tampil
                        </a>
                        <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton" plain="true">
                            <i class="flaticon2-trash"></i>
                            Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="win-kategori" class="panel-window" data-title="Tambah Kategori" style="width: 38%; height: 73%;">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            ID :
                        </label>
                        <div class="col-lg-4 col-sm-12">
                            <input id="txt-id" class="form-control form-control-sm" type="text" disabled="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Kode :
                        </label>
                        <div class="col-lg-4 col-sm-12">
                            <input id="txt-kode" class="form-control form-control-sm" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Kategori :
                        </label>
                        <div class="col-lg-9 col-sm-12">
                            <input id="txt-kategori" class="form-control form-control-sm" type="text">
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            COA HPP :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-coa_hpp" class="form-control form-control-sm" type="text" disabled="true">
                            <input id="txt-id-coa_hpp" class="form-control form-control-sm" type="hidden" disabled="true">
                        </div>
                        <div class="col-lg-1 col-sm-12">
                            <button id="btn-coa_hpp" type="button" class="form-control-sm btn btn-primary kt-search-custom div_simpan" style="width: 41px;" value="coa_hpp" onclick="filter_kategori(this)">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                            COA Persediaan :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-coa_persediaan" class="form-control form-control-sm" type="text" disabled="true">
                            <input id="txt-id-coa_persediaan" class="form-control form-control-sm" type="hidden" disabled="true">
                        </div>
                        <div class="col-lg-1 col-sm-12">
                            <button id="btn-coa_persediaan" type="button" class="form-control-sm btn btn-primary kt-search-custom div_simpan" style="width: 41px;" value="coa_persediaan" onclick="filter_kategori(this)">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                            COA Pendapatan :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-coa_pendapatan" class="form-control form-control-sm" type="text" disabled="true">
                            <input id="txt-id-coa_pendapatan" class="form-control form-control-sm" type="hidden" disabled="true">
                        </div>
                        <div class="col-lg-1 col-sm-12">
                            <button id="btn-coa_pendapatan" type="button" class="form-control-sm btn btn-primary kt-search-custom div_simpan" style="width: 41px;" value="coa_pendapatan" onclick="filter_kategori(this)">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Tipe Item :
                        </label>
                        <div class="col-lg-4 col-sm-12">
                            <!-- <input id="txt-jenis" class="form-control form-control-sm" type="text"> -->
                            <select class="select form-control form-control-sm" id="cmb-item">
                                <option value="1" selected>Alkes</option>
                                <option value="2">Obat</option>
                                <option value="3">Suplemen</option>
                                <option value="4">Vitamin</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Jenis PO :
                        </label>
                        <div class="col-lg-4 col-sm-12">
                            <!-- <input id="txt-jenis" class="form-control form-control-sm" type="text"> -->
                            <select class="select form-control form-control-sm" id="cmb-jenis">
                                <option value="1" selected>Obat</option>
                                <option value="2">Alkes</option>
                                <option value="3">Gas Medis</option>
                                <option value="4">General</option>
                                <option value="5">Jasa Service</option>
                                <option value="6">Aset</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="margin-right: 10px;">
                            Status :
                        </label>
                        <div class="form-group row">
                            <div class="col-lg-2 col-sm-12" style="margin-top: 7px">
                                <input name="chk-is_aktif" type="checkbox" id="chk-is_aktif">
                            </div>
                            <label class="form-control-sm kt-font-sm">Aktif</label>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7">
                    <div class="form-group row" style="margin-top: 0px; margin-left: 2px;">
                        <div class="col-lg-5 col-md-4 col-sm-12 kt-padding div_simpan">
                            <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan()">
                                <i class="la la-save"></i>
                                Simpan
                            </button>
                        </div>
                        <div class="col-lg-5 col-md-4 col-sm-12 kt-padding">
                            <button onclick="tutup();" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-coa_hpp" class="panel-window" data-title="Pencarian Coa HPP" style="width: 40%; height: 85%">

        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_coa_hpp" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button id="btn_filter_billing" type="button" class="easyui-linkbutton btn-primary" plain="true" value="coa_hpp" onclick="filter_kategori(this)">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-coa_hpp" height="390" width="100%" class="easyui-datagrid" pagination="true" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="coa_code" width="30%">Kode</th>
                                        <th halign="center" align="left" field="coa_name" width="70%">COA Name</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_coa_hpp" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_coa()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_coa_hpp" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-coa_persediaan" class="panel-window" data-title="Pencarian Coa Persediaan" style="width: 40%; height: 85%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_coa_persediaan" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button id="btn_filter_billing" type="button" class="easyui-linkbutton btn-primary" plain="true" value="coa_persediaan" onclick="filter_kategori(this)">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-coa_persediaan" height="390" width="100%" class="easyui-datagrid" pagination="true" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="coa_code" width="30%">Kode</th>
                                        <th halign="center" align="left" field="coa_name" width="70%">COA Name</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_coa_persediaan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_coa()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_coa_persediaan" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-coa_pendapatan" class="panel-window" data-title="Pencarian Coa Pendapatan" style="width: 40%; height: 85%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_coa_pendapatan" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button id="btn_filter_billing" type="button" class="easyui-linkbutton btn-primary" plain="true" value="coa_pendapatan" onclick="filter_kategori(this)">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-coa_pendapatan" height="390" width="100%" class="easyui-datagrid" pagination="true" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="coa_code" width="30%">Kode</th>
                                        <th halign="center" align="left" field="coa_name" width="70%">COA Name</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_coa_pendapatan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_coa()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_coa_pendapatan" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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
<!-- end content
