<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Retur Mutasi</h3>
            <div class="kt-subheader__breadcrumbs">
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Gudang Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Retur Mutasi</a>
            </div>
        </div>
    </div>
</div>

<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
        <!-- start browse -->
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile" id="browse">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header">
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Status :
                                </label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-status">
                                        <option value="0">All</option>
                                        <option value="1">Open</option>
                                        <option value="2">Release</option>
                                        <option value="3">Receive</option>
                                        <option value="4">Reject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateStart" type="date-only-formatted"  id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm">s/d :</label> 
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="dtb-end_date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                <div class="col-lg-7 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria" placeholder="Cari..." required>
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
                                        Tambah Retur Mutasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-retur_mutasi" height="450" width="100%"  title="Daftar Retur Mutasi" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" fitColumns="true">
                        <thead>
                        <tr>
                            <th halign="center" align="left" field="no_rt_mutasi" width="12%" >No. Retur</th>
                            <th halign="center" align="center" field="tgl_rt_mutasi" width="9%" data-options="formatter:appGridDateFormatter">Tgl. Retur</th>
                            <th halign="center" align="left" field="unit_stok" width="17%" >Unit Asal</th>
                            <th halign="center" align="left" field="unit_tujuan" width="17%" >Unit Tujuan</th>
                            <th halign="center" align="left" field="ket_rt_mutasi" width="35%" >Catatan</th>
                            <th halign="center" align="left" field="status_caption" width="8%" >Status</th>
                            <th halign="center" align="left" field="created_by" width="10%" >Dibuat Oleh</th>
                            <th halign="center" align="center" field="date_ins" width="13%" data-options="formatter:appGridDateTimeFormatter">Tgl. Dibuat</th>
                            <th halign="center" align="left" field="updated_by" width="10%" >Diubah Oleh</th>
                            <th halign="center" align="center" field="date_upd" width="13%" data-options="formatter:appGridDateTimeFormatter">Tgl. Diubah</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- end browse -->
        <!-- start detail -->
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile" id="detail">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form header-form col-lg-12 kt-margin-t-25" id="form-header">
                    <div class="row" style="border-bottom: 2px solid #D3D3D3; margin-bottom:10px">
                        <div class="col-lg-5">
                            <div class="form-group row" id="div_status" style="padding-top: 5px">
                                <label class="kt-font-bold col-lg-5 col-sm-12 form-control-sm kt-font" id="txt-label_nopp">
                                    No. Retur : 
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
                                            <button id="btn-receive" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('receive',0)">
                                                <i class=""></i>
                                                Receive
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
                                            <input id="txt-no_retur" class="form-control form-control-sm" type="text" name="textarea2">
                                        </div>
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                            Tanggal 
                                        </label>
                                        <div class="col-lg-5 col-sm-12">
                                            <input class="form-control form-control-sm" name="dateStart" type="date-only-formatted"  id="dtb-date-input">
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
                                <a href="javascript:void(0)" id="btn-tambah_detail" class="easyui-linkbutton div_simpan" plain="true">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row" title="Autorisasi" style="margin-top: 5px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-auth" height="130" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true" title="Autorisasi">
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
                                    class="form-control form-control-sm btn btn-sm btn-danger kt-font-sm" onclick="hapus()">
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
        <!-- end detail -->
    </div>
    <div id="win-cari_data_item" class="panel-window" style="height:80%; width: 80%" data-title="Pencarian Data Item">
        <div class="kt-portlet">
            <div class="kt-portlet__body_win header-form">
                <!-- konten form -->
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Tgl. Mutasi :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateStart" type="date-only-formatted"  id="dtb-start_date-filter_item">
                                </div>
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">s/d :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="dtb-end_date-filter_item">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Kriteria :</label>
                                <div class="col-lg-7 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria_cari_nomutasi" placeholder="Cari..." required>
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
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Jenis Mutasi :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-jns_mutasi">
                                        <option value="0">All</option>
                                        <option value="1">ROP</option>
                                        <option value="2">Non ROP</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-data_item" height="280" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="id_item" width="15%" hidden="true">Id Item</th>
                                        <th halign="center" align="left" field="no_mutasi" width="15%">No. Mutasi</th>
                                        <th halign="center" align="center" field="tgl_mutasi" width="15%">Tgl. Mutasi</th>
                                        <th halign="center" align="left" field="kd_item" width="15%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="30%">Nama Item</th>
                                        <th halign="center" align="left" field="nama_satuan" width="15%">Satuan</th>
                                        <th halign="center" align="right" field="jml_mutasi" width="20%" formatter="datagridFormatNumber">Jml. Sisa Mutasi</th>
                                        <th halign="center" align="right" field="jml_stok" width="20%" formatter="datagridFormatNumber">Jml. Stok</th>
                                        <th halign="center" align="right" field="hpp" width="20%" formatter="datagridFormatNumber">Harga</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_detail_item" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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
No newline at end of file
