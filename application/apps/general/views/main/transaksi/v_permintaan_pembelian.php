<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Permintaan Pembelian</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Transaksi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pembelian</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Permintaan Pembelian</a>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Status :</label>
                                        <div class="col-lg-3 col-sm-12">
                                            <select class="form-control form-control-sm" id="cmb-status">
                                                <option value="0">All</option>
                                                <option value="1">Open</option>
                                                <option value="2">Release</option>
                                                <option value="3">Approve</option>
                                                <option value="4">Reject</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Tanggal :</label>
                                        <div class="col-lg-3 col-sm-12">
                                            <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-start_date">
                                        </div>

                                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm"> s/d :</label>
                                        <div class="col-lg-3 col-sm-12">
                                            <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-end_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                        <div class="col-lg-7 col-sm-12">
                                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-criteria" placeholder="Cari...">
                                        </div>
                                        <div class="col-lg-2 col-sm-12 kt-margin-t-20-mobile">
                                            <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter()">
                                                <i class="la la-filter"></i>
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <div class="form-group row">
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah()">
                                        <i class="la la-plus"></i>
                                        Tambah Permintaan Pembelian
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet_body kt-portlet_body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-permintaan_pembelian"
                           height="450"
                           width="100%" 
                           title="Daftar Permintaan Pembelian"
                           class="easyui-datagrid"
                           toolbar="#toolbar"
                           pagination="true"
                           rownumbers="true"
                           singleSelect="true"
                    >
                        <thead>
                        <tr>
                            <th halign="center" align="left" field="no_pp" width="12%" >No. PP</th>
                            <th halign="center" align="center" field="tgl_pp" width="10%" data-options="formatter:appGridDateFormatter">Tgl. PP</th>
                            <th halign="center" align="left" field="nama_unit" width="17%" >Depo</th>
                            <th halign="center" align="left" field="ket_pp" width="35%" >Catatan</th>
                            <th halign="center" align="left" field="status_caption" width="8%" >Status</th>
                            <th halign="center" align="left" field="created_by" width="10%" >Dibuat Oleh</th>
                            <th halign="center" align="center" field="date_ins" width="13%" data-options="formatter:appGridDateTimeFormatter">Tgl. Dibuat</th>
                            <th halign="center" align="left" field="updated_by" width="10%" >Diubah Oleh</th>
                            <th halign="center" align="center" field="date_upd" width="13%" data-options="formatter:appGridDateTimeFormatter">Tgl. Diubah</th>
                        </tr>
                        </thead>
                    </table>
                    <div id="toolbar">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile" id="detail">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header" style="">
                    <div class="row" style="border-bottom: 2px solid #D3D3D3; margin-bottom:10px">
                        <div class="col-lg-5">
                            <div class="form-group row" id="div_status" style="padding-top: 5px">
                                <label class="kt-font-bold col-lg-5 col-sm-12 form-control-sm kt-font" id="txt-label_nopp">
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
                                            <button id="btn-approve" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(3,0)">
                                                <i class=""></i>
                                                Approve
                                            </button>
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
                                            <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary" onclick="tab(0)">
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
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">No. PP:</label>
                                <div class="col-lg-2 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" id="txt-no_pp">
                                </div>
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Tanggal:</label>
                                <div class="col-lg-2 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted" id="dtb-tgl_pp">
                                </div>
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm status_caption">Status:</label>
                                <div class="col-lg-2 col-sm-12 status_caption">
                                    <input class="form-control form-control-sm" type="text" id="txt-status_caption">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Unit Asal:</label>
                                <div class="col-lg-5 col-sm-12">
                                    <!-- <input class="form-control form-control-sm easyui-combobox" type="text" id="cmb-data_unit"> -->
                                    <select class="select2 form-control" id="cmb-data_unit">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Catatan:</label>
                                <div class="col-lg-5 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;" id="txt-ket_pp">Keterangan Text Area</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" title="Detail Item" style="margin-top: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-detail_item"
                                   height="250"
                                   width="100%" 
                                   title="Detail Permintaan Pembelian"
                                   class="easyui-datagrid"
                                   toolbar="#toolbarDetailA"
                                   pagination="false"
                                   rownumbers="true"
                                   singleSelect="true"
                            >
                                <thead>
                                
                                </thead>
                            </table>
                            <div id="toolbarDetailA">
                                <a href="javascript:void(0)" id="btn-tambah_detail" class="easyui-linkbutton div_simpan" plain="true">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                                <a href="javascript:void(0)" id="btn-tambah_pu" class="easyui-linkbutton div_simpan" plain="true">
                                    <i class="la la-plus"></i>
                                    Tambah Barang PU
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row" title="Autorisasi" style="margin-top: 5px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-autorisasi"
                                   height="140"
                                   width="100%" 
                                   title="Autorisasi"
                                   class="easyui-datagrid"
                                   toolbar="#toolbarDetailB"
                                   pagination="false"
                                   rownumbers="true"
                                   singleSelect="true"
                            >
                                <thead>
                                    <th halign="center" align="left" field="sign_name" width="150">Autorisasi</th>
                                    <th halign="center" align="left" field="user_name" width="600" >Penanggung Jawab</th>
                                    <th halign="center" align="center" field="sign_date" width="150" data-options="formatter:appGridDateTimeFormatter">Tanggal</th>
                                    <th halign="center" align="center" field="status_caption" width="100" >Status</th>

                                    <th halign="center" align="center" field="trans_sign_id" width="100"></th>
                                    <th halign="center" align="center" field="seq_no" width="100"></th>
                                    <th halign="center" align="center" field="sign_id" width="100"></th>
                                    <th halign="center" align="center" field="is_default" width="100"></th>
                                    <th halign="center" align="center" field="user_id" width="100"></th>
                                    <th halign="center" align="center" field="user_id_approve" width="100"></th>
                                </thead>
                            </table>
                            <div id="toolbarDetailB">
                                
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 10px;margin-left: 0px;margin-right: 0px;">
                        <div class="col-lg-auto col-md-auto col-sm-auto div_simpan" style="padding:2px">
                            <button id="btn-simpan" type="button"
                                    class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan()">
                                <i class="la la-save"></i>
                                Simpan
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                            <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tab(0)">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                            <button id="btn-hapus" type="button"
                                    class="form-control form-control-sm btn btn-sm btn-danger kt-font-sm" onclick="btn_hapus()">
                                <i class="flaticon2-trash"></i>
                                Hapus
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                            <button id="btn-cetak" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="cetak()">
                                <i class="flaticon2-print"></i>
                                Cetak
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="win-cari_data_item" class="panel-window" style="height:90%; width: 75%;" data-title="Daftar Item General">
        <div class="kt-portlet">
            <div class="kt-portlet__body_win header-form">
                
                <!-- konten form -->
                <form class="kt-form col-lg-12 header-form">
                    <div class="form-group row">
                        <div class="col-lg-1 col-md-2 col-sm-12">
                            <label class="col-form-label form-control-sm kt-font-sm">Kriteria:</label>
                        </div>
                        <div class="col-lg-5 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-criteria_data_unit" placeholder="Cari..." required>
                        </div>
                        <div class="col-lg-3 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                            <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter_nobilling" onclick="filter_barang()">
                                <i class="la la-filter"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <div class="col-lg-1 col-md-2 col-sm-12">
                            <label class="col-form-label form-control-sm kt-font-sm">Tanggal:</label>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="form-group row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-periode_start_date">
                                </div>
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">S.D:</label> 
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-periode_end_date">
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-12 table-detail">
                            <table id="dtg-cari_barang"
                                   height="360"
                                   width="100%" 
                                   class="easyui-datagrid"
                                   pagination="true"
                                   rownumbers="true"
                                   singleSelect="false"
                            >
                                <thead>
                                <tr>
                                    <th field="pilih" checkbox="true">Pilih</th>
                                    <th halign="center" align="left" field="id_item" width="70">ID Item</th>
                                    <th halign="center" align="left" field="nama_item" width="250">Nama Item</th>
                                    <th halign="center" align="left" field="kd_item" width="100">Kode</th>
                                    <th halign="center" align="left" field="id_satuan" width="100">Satuan</th>
                                    <th halign="center" align="left" field="nama_kel_item" width="100">Jenis</th>
                                    <th halign="center" align="right" field="jml_stok_depo" width="80" data-options="formatter:appGridNumberFormatter" hidden="true">Stok Depo</th>
                                    <th halign="center" align="right" field="jml_stok" width="80" data-options="formatter:appGridNumberFormatter" hidden="true">Stok</th>
                                    <th halign="center" align="right" field="jml_mutasi" width="80" data-options="formatter:appGridNumberFormatter" hidden="true">Pemakaian</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;margin-left: 0px;margin-right: 0px;">
                        <div class="col-lg-auto col-md-auto col-sm-auto" style="padding:2px">
                            <button id="btn-pilih_barang" type="button"
                                    class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                            <button id="btn-tutup_cari_dataitem" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Tutup
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="win-cari_barang_pu" class="panel-window" style="height:90%; width: 75%;" data-title="Data Barang PU">
        <div class="kt-portlet">
            <div class="kt-portlet__body_win header-form">
                <!-- konten form -->
                <form class="kt-form col-lg-12 header-form">
                    <div class="form-group row">
                        <div class="col-lg-1 col-md-2 col-sm-12" style="padding-left: 1px; padding-right: 1px;">
                            <label class="col-form-label form-control-sm kt-font-sm">Kriteria :</label>
                        </div>
                        <div class="col-lg-5 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                            <input class="form-control form-control-sm" type="text" id="txt-kriteria_barang_pu" placeholder="Cari..." required>
                        </div>
                        <div class="col-lg-3 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                            <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter_barang_pu" onclick="filter_pu()">
                                <i class="la la-filter"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1 col-md-2 col-sm-12" style="padding-left: 1px; padding-right: 1px;">
                            <label class="col-form-label form-control-sm kt-font-sm">
                                Tanggal :
                            </label>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="form-group row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-start_date_pu">
                                </div>
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">s/d :</label> 
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-end_date_pu">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-detail">
                            <table id="dtg-cari_pu"
                                   height="360"
                                   width="100%" 
                                   class="easyui-datagrid"
                                   pagination="true"
                                   rownumbers="true"
                                   singleSelect="false"
                            >
                                <thead>
                                    <tr>
                                        <th field="pilih" checkbox="true">Pilih</th>
                                        <th halign="center" align="left" field="no_pm" width="10%">No. Permintaan</th>
                                        <th halign="center" align="center" field="tgl_pm" width="10%" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                        <th halign="center" align="left" field="nama_unit" width="15%">Unit</th>
                                        <th halign="center" align="left" field="id_item" width="7%" hidden="true">ID item</th>
                                        <th halign="center" align="left" field="kd_item" width="7%">kode</th>
                                        <th halign="center" align="left" field="nama_item" width="30%">Nama Item</th>
                                        <th halign="center" align="left" field="nama_kel_item" width="14%">Jenis</th>
                                        <th halign="center" align="left" field="nama_satuan" width="7%">Satuan</th>
                                        <th halign="center" align="left" field="jml" width="7%" data-options="formatter:appGridNumberFormatter">Jml. Minta</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-top: 10px;margin-left: 0px;margin-right: 0px;">
                        <div class="col-lg-auto col-md-auto col-sm-auto" style="padding:2px">
                            <button id="btn-pilih_pu" type="button"
                                    class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                            <button id="btn-tutup_pu" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Tutup
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modal_preview" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="width: 100%">
            <div class="modal-content" style="width: 150%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <iframe id="modal_preview_detail" name="modal_preview_detail" width="100%" height ="850px"></iframe>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- end content
No newline at end of file
