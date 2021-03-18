<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Permintaan Mutasi</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Transaksi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Mutasi Barang</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Permintaan Mutasi</a>
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
                                            <select class="select form-control form-control-sm" id="cmb-status">
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
                                            <input class="form-control form-control-sm" name="dateStart" type="date-only-formatted"  id="start-date-input">
                                        </div>

                                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm"> s/d :</label>
                                        <div class="col-lg-3 col-sm-12">
                                            <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="end-date-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                        <div class="col-lg-7 col-sm-12">
                                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-search" placeholder="Cari...">
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
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary">
                                        <i class="la la-plus"></i>
                                        Tambah Permintaan Mutasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet_body kt-portlet_body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-permintaan_mutasi" height="450" width="100%" title="Daftar Permintaan Mutasi" class="easyui-datagrid" toolbar="#toolbar" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                        <tr>
                            <th halign="center" align="left" field="no_pm" width="13%" >No. Permintaan</th>
                            <th halign="center" align="center" field="tgl_pm" width="10%" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                            <th halign="center" align="left" field="unit_asal" width="17%" >Unit Asal</th>
                            <th halign="center" align="left" field="unit_tujuan" width="17%" >Unit Tujuan</th>
                            <th halign="center" align="left" field="ket_pm" width="35%" >Catatan</th>
                            <th halign="center" align="center" field="status_caption" width="8%" >Status</th>
                            <th halign="center" align="center" field="created_by" width="10%" >Dibuat Oleh</th>
                            <th halign="center" align="center" field="date_ins" width="11%" data-options="formatter:appGridDateTimeFormatter">Tgl. Dibuat</th>
                            <th halign="center" align="center" field="updated_by" width="10%" >Diubah Oleh</th>
                            <th halign="center" align="center" field="date_upd" width="11%" data-options="formatter:appGridDateTimeFormatter">Tgl. Diubah</th>
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
                                <label class="kt-font-bold col-lg-6 col-sm-12 form-control-sm kt-font" id="txt-label_nopp">
                                    No. Permintaan : 
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
                                            <button id="btn-open" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('open',0)">
                                                <i class=""></i>
                                                Open
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-approve" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('approve',0)">
                                                <i class=""></i>
                                                Approve
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto">
                                            <button id="btn-reject" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('reject',0)">
                                                <i class=""></i>
                                                Reject
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-release" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('release',0)">
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
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 0px">
                                    No. Permintaan :
                                </label>
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <div class="col-lg-5 col-sm-12">
                                            <input id="txt-no_permintaan" class="form-control form-control-sm" type="text" name="textarea2">
                                        </div>
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                            Tanggal :
                                        </label>
                                        <div class="col-lg-5 col-sm-12">
                                            <input class="form-control form-control-sm" name="dateStart" type="date-only-formatted"  id="mutasi-date-input">
                                        </div>  
                                    </div>
                                </div>
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm status_caption">Status:</label>
                                <div class="col-lg-2 col-sm-12 status_caption">
                                    <input class="form-control form-control-sm" type="text" id="txt-status_caption">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Unit Asal :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <select id="cmb-unit_asal" class="select2 form-control form-control-sm">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Unit Tujuan :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <select id="cmb-unit_tujuan" class="select2 form-control form-control-sm">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Catatan :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <textarea id="txt-desc" data-options="multiline:true" class="col-lg-12 form-control form-control-sm kt-font-sm" style="resize: none;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" title="Detail Item" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail" height="250" width="100%" class="easyui-datagrid" toolbar="#toolbarDetailItem" pagination="false" rownumbers="true" singleSelect="true">
                                <!-- <thead>
                                <tr>
                                  <th halign="center" align="right" field="no" width="100">No</th>
                                  <th halign="center" align="right" field="kode" width="100">Kode</th>
                                  <th halign="center" align="right" field="deskripsi" width="100">Nama Item</th>
                                  <th halign="center" align="right" field="satuan" width="100">Satuan</th>
                                  <th halign="center" align="right" field="jenis" width="100" >Jenis</th>
                                  <th halign="center" align="right" field="stok" width="100" >Stok</th>
                                  <th halign="center" align="right" field="permintaan" width="100" >Permintaan</th>
                                  <th halign="center" align="right" field="tglkeb" width="100" >Action</th>
                                </tr>
                                </thead> -->
                            </table>
                            <div id="toolbarDetailItem">
                                <a href="javascript:void(0)" id="btn-tambah_detail_item" class="easyui-linkbutton div_simpan" plain="true">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row" title="Autorisasi" style="margin-top: 5px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-aut" height="140" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true" title="Autorisasi">
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
                                    class="form-control form-control-sm btn btn-sm btn-danger kt-font-sm">
                                <i class="flaticon2-trash"></i>
                                Hapus
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                            <!-- <button id="btn-cetak" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="flaticon2-print"></i>
                                Cetak
                            </button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="win-pencarian_item" class="panel-window" data-title="Pencarian Data Item" style="width: 60%; height: 85%;">
        <div class="kt-portlet" style="margin-bottom:0px">
            <div class="kt-portlet__body_win header-form">
                <div class="col-lg-12">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                            Kriteria 
                        </label>
                        <div class="col-lg-5 col-sm-12">
                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-search-item" placeholder="Cari...">
                        </div>
                        <div class="col-lg-3 col-sm-12 kt-margin-t-20-mobile">
                            <button id="btn-filter_data_item" type="button" class="easyui-linkbutton btn-primary" plain="true">
                                <i class="la la-filter">Filter</i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 table-detail" style="margin-top: 10px">
                    <table id="dg-data_item" height="370" width="100%" class="easyui-datagrid" pagination="true" singleSelect="false">
                        <!-- <thead>
                            <tr>
                              <th halign="center" align="right" field="no" width="100">Nama Item</th>
                              <th halign="center" align="right" field="kode" width="150">Kode</th>
                              <th halign="center" align="right" field="deskripsi" width="100">Satuan</th>
                              <th halign="center" align="right" field="satuan" width="100">Jenis</th>
                              <th halign="center" align="right" field="id" width="100" >Jenis</th>
                            </tr>
                        </thead> -->
                    </table>
                </div>
                <div class="form-group row" style="margin-top: 10px;margin-left: 5px;margin-right: 5px;">
                    <div class="col-lg-auto col-md-auto col-sm-auto" style="padding:2px">
                        <button id="btn-pilih" type="button"
                                class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                            <i class="la la-check"></i>
                            Pilih
                        </button>
                    </div>
                    <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                        <button id="btn-batal_data_item" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                            <i class="la la-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end content
No newline at end of file
