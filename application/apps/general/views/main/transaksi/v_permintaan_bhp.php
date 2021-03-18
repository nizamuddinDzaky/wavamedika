<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Permintaan BHP</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Transaksi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Mutasi Barang</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Permintaan BHP</a>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <!-- <div class="kt-subheader__wrapper">
                <a id="export-pdf" target="_blank" class="btn kt-subheader__btn-secondary">
                    Export PDF
                </a>
                <a id="print" class="btn kt-subheader__btn-secondary">
                    Export Excel
                </a>
            </div> -->
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
                                        <option value="1">Open</option>
                                        <option value="2">Release</option>
                                        <option value="3">Approve</option>
                                        <option value="4">Reject</option>
                                        <!-- <option value="5">Cancel</option>
                                        <option value="6">Close</option> -->
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="row"> -->
                                <!-- <div class="col-lg-10"> -->
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Tanggal :</label>
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-start_date">
                                        </div>

                                        <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm">s/d :</label> 
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-end_date">
                                        </div>
                                    </div>
                                <!-- </div> -->
                            <!-- </div> -->
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                <div class="col-lg-7 col-md-4 col-sm-12 kt-margin-t-10-mobile">
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
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary">
                                        <i class="la la-plus"></i>
                                        Tambah Permintaan BHP
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom" style="margin-top: 15px;">
                    <table id="dtg-permintaan_bhp" height="500" width="100%" title="Daftar Permintaan BHP" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                        </thead>
                    </table>
                    <div id="toolbar">
                        <!-- <a href="javascript:void(0)" id="btn-tambah" class="easyui-linkbutton" plain="true">
                            <i class="la la-plus"></i>
                            Tambah
                        </a>
                        <a href="javascript:void(0)" id="btn-tampil" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
                            Tampil
                        </a>
                        <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton" plain="true">
                            <i class="flaticon2-trash"></i>
                            Hapus
                        </a>
                        <a href="javascript:void(0)" id="btn-tampil" class="easyui-linkbutton" plain="true">
                            <i class="flaticon2-print"></i>
                            Cetak
                        </a> -->
                    </div>
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
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_nopm">
                                    No. PP : 
                                </label>
                                <div style="border-left: 1px black solid; height: 12px; width: 5px; margin-top: 10px">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm" id="txt-label_status">
                                    Status : 
                                </label>
                                <div style="border-left: 1px black solid; height: 12px; width: 5px; margin-top: 10px">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm" id="txt-label_posted">
                                    
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group row justify-content-lg-between">
                                <div class="col-lg-auto kt-padding-t-10-mobile">
                                    <div class="form-group row" id="btn-aksi">
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-open" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(1,0)">
                                                <i class=""></i>
                                                Open
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <!-- <button id="btn-approve" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(3,0)">
                                                <i class=""></i>
                                                Approve
                                            </button> -->
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto">
                                            <button id="btn-reject" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(4,0)">
                                                <i class=""></i>
                                                Reject
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-release" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(2,0)">
                                                <i class=""></i>
                                                Release
                                            </button>
                                        </div>
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
                        <!-- <div class="col-lg-3"></div>
                        <div class="col-lg-4">
                            <div class="form-group row pull-right" style="margin-right: 15px">
                                <div class=" div_simpan" id="div_simpan" style="">
                                    <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan()">
                                        <i class="la la-save"></i>
                                        Simpan
                                    </button>
                                </div>
                                 <div class=" kt-padding-t-10-mobile" style="margin-left: 10px;">
                                    <button type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" id="btn-kembali" style="border: 1px solid #0f9e98;">
                                        <i class="la la-angle-double-left"></i>
                                        Kembali
                                    </button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. Permintaan :
                                </label>
                                <div class="col-lg-2 col-sm-12">
                                    <input id="txt-no" class="form-control form-control-sm" type="text">
                                </div>

                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-2 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="dtb-date_input">
                                </div>
                                
                                <!-- <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" id="label-status">
                                    Status :
                                </label>
                                <div class="col-lg-2 col-sm-12" id="div-input-status">
                                    <input id="txt-status" class="form-control form-control-sm" type="text">
                                </div> -->
                                <!-- <div class="col-lg-2 col-sm-12">
                                    <div class="dropdown" id="btn-aksi">
                                        <button class="col-lg-6 col-sm-12 form-control form-control-sm btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" plain="true">Aksi
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a id="btn-open" href="#" onclick="status('open')"   >Open</a></li>
                                            <li><a id="btn-release" href="#" onclick="status('release')"  >Release</a></li>
                                            <li><a id="btn-approve" href="#" onclick="status('approve')"  >Approve</a></li>
                                            <li><a id="btn-reject" href="#">Reject</a></li>
                                            <li><a id="btn-close" href="#">Close</a></li>
                                            <li><a id="btn-cancel" href="#">Cancel</a></li>
                                        </ul>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Unit Asal :</label>
                                <div class="col-lg-5 col-sm-12">
                                    <select class="select2 form-control" id="cmb-unit_asal">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Unit Tujuan :</label>
                                <div class="col-lg-5 col-sm-12">
                                    <select class="select2 form-control" id="cmb-unit_tujuan">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Catatan :</label>
                                <div class="col-lg-5 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;" id="txt-desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-detail_item" height="300" width="100%" title="Detail Permintaan BHP" class="easyui-datagrid" toolbar="#toolbarDetailA" pagination="false" rownumbers="true" singleSelect="true">
                                <!-- <thead>
                                    <tr>
                                        <th field="id_item" halign="center" align="center" width="10%">No</th>
                                        <th field="kd_item" halign="center" width="15%">Kode</th>
                                        <th field="nama_item" halign="center" width="20%">Nama Item</th>
                                        <th field="nama_satuan" halign="center" width="15%">Satuan</th>
                                        <th field="jml_stok" halign="center" width="15%">Stok Gudang</th>
                                        <th field="jml_minta" halign="center" width="15%">Permintaan</th>
                                        <th field="7" halign="center" width="15%">Action</th>
                                    </tr>
                                </thead> -->
                            </table>
                            <div id="toolbarDetailA">
                                <a href="javascript:void(0)" id="btn-tambah_detail" class="easyui-linkbutton div_simpan" plain="true"><i class="la la-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row" style="margin-top: 10px; margin-bottom: 25px;" id="tbl-autorisasi">
                        <div class="col-12 table-detail">
                            <table id="dtg-autorisasi" height="250" width="100%" title="Autorisasi" class="easyui-datagrid" toolbar="#toolbarDetailB" pagination="false" rownumbers="true" singleSelect="true">
                                <thead>
                                    <th halign="center" align="left" field="sign_name" width="150">Autorisasi</th>
                                    <th halign="center" align="left" field="user_name" width="600" >Penanggung Jawab</th>
                                    <th halign="center" align="center" field="sign_date" width="150" data-options="formatter:appGridDateTimeFormatter">Tanggal</th>
                                    <th halign="center" align="center" field="status_caption" width="100" >Status</th>

                                    <th halign="center" align="center" field="trans_sign_id" width="100" hidden></th>
                                    <th halign="center" align="center" field="seq_no" width="100" hidden></th>
                                    <th halign="center" align="center" field="sign_id" width="100" hidden></th>
                                    <th halign="center" align="center" field="is_default" width="100" hidden></th>
                                    <th halign="center" align="center" field="user_id" width="100" hidden></th>
                                    <th halign="center" align="center" field="user_id_approve" width="100" hidden></th>
                                </thead>
                            </table>
                            <div id="toolbarDetailB">
                                
                            </div>
                        </div>
                    </div> -->
                    <div class="row" style="margin-left: 1px; margin-bottom: 15px;">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding div_simpan">
                                    <button onclick="simpan()" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                        <i class="la la-save"></i>
                                        Simpan
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                                    <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                        <i class="la la-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                                    <button id="btn-hapus" type="button" class="form-control form-control-sm btn-sm btn btn-danger kt-font-sm">
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
    
    <div id="win-cari_data_item" class="panel-window" style="height:67%; width: 70%;" data-title="Data Item">
        <div class="kt-portlet">
            <div class="kt-portlet__body_win header-form">
                <!-- konten form -->
                <form class="kt-form col-lg-12 header-form">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-12 col-form-label form-control-sm kt-font-sm">Kriteria :</label>
                            <div class="col-lg-6 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                <input name="searchText" class="form-control form-control-sm" type="text" id="txt-criteria_data_unit" placeholder="Cari..." required>
                            </div>
                            <div class="col-lg-3 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter_nobilling" onclick="filter_barang()">
                                    <i class="la la-filter"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-detail">
                            <table id="dtg-cari_barang" height="260" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="false">
                                <thead>
                                <tr>
                                    <th field="pilih" checkbox="true">Pilih</th>
                                    <th field="id_item" halign="center" align="left" width="35%" hidden="true">Nama Item</th>
                                    <th field="nama_item" halign="center" align="left" width="35%" >Nama Item</th>
                                    <th field="kd_item" halign="center" align="center" width="20%">Kode</th>
                                    <th field="nama_satuan" halign="center" align="center" width="15%">Satuan</th>
                                    <th field="jml_stok" halign="center" align="right" width="25%" data-options="formatter:appGridNumberFormatter">Stok</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-8" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12" style="padding: 2px">
                            <button id="btn-pilih_barang" type="button"
                                    class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-save"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding-t-10-mobile" style="padding: 2px">
                            <button id="btn-tutup_cari_dataitem" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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
<!-- end content
No newline at end of file