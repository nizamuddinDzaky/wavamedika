<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Paket Barang Farmasi</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Paket Barang Farmasi</a>
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
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm" style="padding-left: 21px;">
                            Status :
                        </label>
                        <div class="col-lg-2 col-sm-12">
                            <select class="select form-control form-control-sm" id="cmb-status">
                                <option value="0">All</option>
                                <option value="1">Aktif</option>
                                <option value="2">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm" style="padding-left: 21px;">
                            Kriteria :
                        </label>
                        <div class="col-lg-2 col-sm-12">
                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-search">
                        </div>
                        <div class="col-lg-1 col-sm-12 kt-margin-t-20-mobile">
                            <button id="btn-filter" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="filter()">
                                <i class="la la-filter"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="row table-custom">
                    <div class="col-lg-5">
                        <table id="dtg-daftar_paket" title="Daftar Paket" class="easyui-datagrid" style="width: 100%;height:480px;" toolbar="#toolbar1" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                            <thead>
                            <tr>
                                <th field="nama_paket_item" halign="center" align="left" width="70%">Nama Paket</th>
                                <th field="status_aktif" halign="center" align="center" width="30%">Status</th>
                                <th field="id_paket_item" halign="center" align="center" width="30%" hidden="true">Status</th>
                                <th field="details" halign="center" align="center" width="30%" hidden="true">Status</th>
                            </tr>
                            </thead>
                        </table>
                        <div id="toolbar1">
                            <a href="javascript:void(0)" id="btn-tambah_paket" class="easyui-linkbutton" plain="true">
                                <i class="la la-plus"></i>
                                Tambah
                            </a>
                            <a href="javascript:void(0)" id="btn-ubah" class="easyui-linkbutton" plain="true">
                                <i class="flaticon-edit-1"></i>
                                Ubah
                            </a>
                            <!-- <a href="javascript:void(0)" id="btn-tampil" class="easyui-linkbutton" plain="true">
                                <i class="flaticon-edit-1"></i>
                                Tampil
                            </a> -->
                            <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton" plain="true" onclick="hapus_paket()">
                                <i class="flaticon2-trash"></i>
                                Hapus
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <table id="dtg-detail_paket" title="Detail Barang" class="easyui-datagrid" style="width: 100%;height:480px;" toolbar="#toolbar2" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                            <thead>
                            <tr>
                                <th field="nama_item" halign="center" align="left" width="40%">Nama Item</th>
                                <th field="jumlah" halign="center" align="left" width="20%" data-options="formatter:appGridNumberFormatter">Jumlah</th>
                                <th field="signa1" halign="center" align="center" width="20%">Signa 1</th>
                                <th field="signa2" halign="center" align="center" width="20%">Signa 2</th>
                                <th field="id_item" halign="center" align="center" width="20%" hidden="true">Signa 1</th>

                            </tr>
                            </thead>
                        </table>
                        <div id="toolbar2">
                            <a href="javascript:void(0)" id="btn-tambah_detail_barang" class="easyui-linkbutton" plain="true">
                                <i class="la la-plus"></i>
                                Tambah
                            </a>
                            <a href="javascript:void(0)" id="btn-ubah" class="easyui-linkbutton" plain="true" onclick="set_form_detail()">
                                <i class="flaticon-edit-1"></i>
                                Ubah
                            </a>
                            <!-- <a href="javascript:void(0)" id="btn-tampil" class="easyui-linkbutton" plain="true">
                                <i class="flaticon-edit-1"></i>
                                Tampil
                            </a> -->
                            <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton" plain="true" onclick="hapus_detail()">
                                <i class="flaticon2-trash"></i>
                                Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="win-daftar_paket" class="panel-window" data-title="Tambah Daftar Paket" style="width: 30%; height: 36%;">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12" id="form-detail">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            ID :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-id" class="form-control form-control-sm" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                            Nama Paket :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-nama_paket" class="form-control form-control-sm" type="text">
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Status :
                        </label>
                        <div class="form-group row">
                            <div class="col-lg-2 col-sm-12" style="margin-top: 4px; margin-left: 10px;">
                                <input name="chk-is_aktif" type="checkbox" id="chk-is_aktif">
                            </div>
                            <label class="form-control-sm kt-font-sm">Aktif</label>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group row" style="margin-top: 15px;">
                            <div class="col-lg-5 col-md-4 col-sm-12 kt-padding" id="div_simpan">
                                <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan_paket()">
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
                </form>
            </div>
        </div>
    </div>

    <div id="win-detail_barang" class="panel-window" data-title="Tambah Detail Barang" style="width: 35%; height: 40%;">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12" id="form-detail">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Nama Barang :
                        </label>
                        <div class="col-lg-7 col-sm-12">
                            <input id="txt-nama_barang" class="form-control form-control-sm" type="text">
                        </div>
                        <div class="col-lg-1 col-sm-12">
                            <button id="btn-cari_barang" type="button" class="form-control-sm btn btn-primary kt-search-custom" style="width: 37px;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group row" hidden="true">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            ID Item :
                        </label>
                        <div class="col-lg-4 col-sm-12">
                            <input id="txt-id_item" class="form-control form-control-sm" type="text">
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Jumlah :
                        </label>
                        <div class="col-lg-8">
                            <input id="txt-jumlah" class="form-control form-control-sm easyui-numberbox" style="width: 285px;">
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Signa 1 :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-signa1" class="form-control form-control-sm" type="text">
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Signa 2 :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-signa2" class="form-control form-control-sm" type="text">
                        </div> 
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group row" style="margin-top: 15px;">
                            <div class="col-lg-5 col-md-4 col-sm-12 kt-padding" id="div_simpan">
                                <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan_detail()">
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
                </form>
            </div>
        </div>
    </div>

    <div id="win-cari_barang" class="panel-window" style="height:85%; width: 50%" data-title="Pencarian Data Barang">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                                    Kriteria :
                                </label>
                                <div class="col-lg-7 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria_barang" placeholder="Cari..." required>
                                </div>
                                <div class="col-lg-3 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter_barang()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-barang" height="390" width="100%" class="easyui-datagrid" rownumbers="true" singleSelect="true" pagination="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="center" field="kd_item" width="25%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="55%">Nama Item</th>
                                        <th halign="center" align="left" field="nama_satuan" width="20%">Satuan</th>
                                        <th halign="center" align="left" field="id_item" width="20%" hidden="true">ID Item</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_barang" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_item()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button onclick="" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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