<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Pemakaian Depo</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Transaksi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pemakaian Depo</a>
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
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted" id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm">s/d :</label> 
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-end_date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Kriteria :
                                </label>
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
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah()">
                                        <i class="la la-plus"></i>
                                        Tambah Pemakaian Depo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-pemakaian_depo" height="500" width="100%" title="Daftar Pemakaian Depo" class="easyui-datagrid" toolbar="#toolbar" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left" field="no_mutasi" width="15%" >No. Pemakaian</th>
                                <th halign="center" field="tgl_mutasi" width="13%" data-options="formatter:appGridDateFormatter" align="center">Tgl. Permintaan</th>
                                <th halign="center" align="left" field="unit_stok" width="13%" >Unit Asal</th>
                                <th halign="center" align="left" field="unit_tujuan" width="15%" >Unit Tujuan</th>
                                <th halign="center" align="left" field="ket_mutasi" width="15%" >Catatan</th>
                                <th halign="center" align="left" field="status_caption" width="8%" >Status</th>
                                <th halign="center" align="left" field="created_by" width="10%" >User Entry</th>
                                <th halign="center" field="date_ins" width="12%" data-options="formatter:appGridDateFormatter" align="center">Tgl. Entry</th>
                                <th halign="center" align="left" field="updated_by" width="10%" >User Update</th>
                                <th halign="center" align="center" field="date_upd" width="12%" data-options="formatter:appGridDateFormatter" align="center">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="toolbar">
                        <!-- <a href="javascript:void(0)" id="btn-tambah" class="easyui-linkbutton" plain="true">
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
                        <a href="javascript:void(0)" id="btn-tampil" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
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
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header" style="">
                    <div class="row" style="border-bottom: 2px solid #D3D3D3; margin-bottom:10px">
                        <div class="col-lg-5">
                            <div class="form-group row" id="div_status">
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
                                            <button id="btn-release" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(2,0)">
                                                <i class=""></i>
                                                Release
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto">
                                            <button id="btn-receive" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(3,0)">
                                                <i class=""></i>
                                                Receive
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-reject" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(4,0)">
                                                <i class=""></i>
                                                Reject
                                            </button>
                                        </div>
                                        <!-- <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-approve" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(3,0)">
                                                <i class=""></i>
                                                Approve
                                            </button>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-lg-auto kt-padding-t-10-mobile">
                                    <div class="form-group row">
                                        <div style="padding: 4px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary" onclick="tab(0)">
                                                <i class="fas fa-angle-double-left"></i>
                                                Kembali
                                            </button>
                                        </div>
                                        <div style="padding: 4px" class="col-lg-auto div_simpan">
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
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">No. PP :</label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" disabled="true" id="txt-no_pp">
                                </div>
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Tanggal:</label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted" id="dtb-tgl_pp">
                                </div>
                               <div class="col-lg-auto col-sm-12 status_caption">
                                    <input class="form-control form-control-sm" type="text" id="txt-status_caption" hidden>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Unit Asal:</label>
                                <div class="col-lg-7 col-sm-12">
                                    <select class="select2 form-control" id="cmb-data_unit_asal">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Unit Tujuan:</label>
                                <div class="col-lg-7 col-sm-12">
                                    <select class="select2 form-control" id="cmb-data_unit_tujuan">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. Permintaan :
                                </label>
                                <div class="col-lg-7 col-sm-12">
                                    <input id="src-no_permintaan" data-options="prompt:'Cari '" class="easyui-searchbox form-control form-control-sm" style="width: 100%; min-width: 150px;">
                                </div>  
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Catatan :</label>
                                <div class="col-lg-7 col-sm-12">
                                    <textarea class="form-control form-control-sm " style="resize: none;" id="txt-ket_mutasi"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" title="Detail Pemakaian Depo" style="margin-top: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-detail_item" height="200" width="100%" class="easyui-datagrid" toolbar="#toolbarDetailA" pagination="false" rownumbers="true" singleSelect="true" fitColumns="false">
                                <thead>
                                    <tr>
                                        <th halign="center" align="right" field="kode" width="100">Kode</th>
                                        <th halign="center" align="right" field="deskripsi" width="400">Nama Item</th>
                                        <th halign="center" align="right" field="nama_satuan" width="100">Satuan</th>
                                        <th halign="center" align="right" field="jml_minta" width="100" >Permintaan</th>
                                        <th halign="center" align="right" field="jml_mutasi" width="100" >Disetujui</th>
                                        <th halign="center" align="right" field="jml_sisa" width="100" >Sisa</th>
                                        <th halign="center" align="right" field="hpp" width="100" >HPP</th>
                                        <th halign="center" align="right" field="total" width="100" >Total</th>
                                        <th halign="center" align="right" field="tglkeb" width="100" >Action</th>
                                    </tr>
                                </thead>
                            </table>
                            <div id="toolbarDetailA">
                                <a href="javascript:void(0)" id="btn-tambah_detail" class="easyui-linkbutton div_simpan" plain="true">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row" title="Autorisasi" style="margin-top: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-autorisasi" height="150" width="100%" title="Autorisasi" class="easyui-datagrid" toolbar="#toolbarDetailB" pagination="false" rownumbers="true" singleSelect="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="sign_name" width="150">Autorisasi</th>
                                        <th halign="center" align="left" field="user_name" width="600">Penanggung Jawab</th>
                                        <th halign="center" align="center" field="sign_date" width="100" data-options="formatter:appGridDateTimeFormatter">Tanggal</th>
                                        <th halign="center" align="center" field="status_caption" width="100" >Status</th> 
                                        <th halign="center" align="left" field="trans_sign_id" width="100"></th>
                                        <th halign="center" align="left" field="seq_no" width="100"></th>
                                        <th halign="center" align="left" field="sign_id" width="100"></th>
                                        <th halign="center" align="left" field="is_default" width="100"></th>
                                        <th halign="center" align="left" field="user_id" width="100"></th>
                                    </tr>
                                </thead>
                            </table>
                            <div id="toolbarDetailB">
                                
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group row" style="margin-top: 20px;margin-left: 0px;margin-right: 0px;">
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
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding" id="div_hapus">
                            <button id="btn-hapus" type="button" class="form-control form-control-sm btn btn-sm btn-danger kt-font-sm" onclick="btn_hapus()">
                                <i class="flaticon2-trash"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="win-cari_data_item" class="panel-window" style="height:75%; width: 75%;" data-title="Data Detail">
        <div class="kt-portlet">
            <div class="kt-portlet__body_win header-form">
                <!-- konten form -->
                <form class="kt-form col-lg-12 header-form">
                    <div class="form-group row">
                        <div class="col-lg-5 col-md-12 col-sm-12 kt-margin-t-10-mobile">
                            <b><input name="searchText" class="form-control form-control-sm" type="text" id="txt-criteria_data_unit" placeholder="Cari..." required></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-detail">
                            <table id="dtg-cari_barang" height="300" width="100%" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="false">
                                <thead>
                                    <tr>
                                        <th field="pilih" checkbox="true">Pilih</th>
                                        <th halign="center" align="left" field="id_item" hidden></th>
                                        <th halign="center" align="left" field="nama_item" width="400">Nama Item</th>
                                        <th halign="center" align="left" field="kd_item" width="100">Kode</th>
                                        <th halign="center" align="left" field="nama_satuan" width="100">Satuan</th>
                                        <th halign="center" align="right" field="jml_minta" width="100" data-options="formatter:appGridNumberFormatter">Jml. Diminta</th>
                                        <th halign="center" align="right" field="jml_mutasi" width="140" data-options="formatter:appGridNumberFormatter">Jml. Pemakaian Ruang</th>
                                        <th halign="center" align="right" field="jml_ss" width="80" data-options="formatter:appGridNumberFormatter">Safety Stok</th>
                                        <th halign="center" align="right" field="jml_rekam_order" width="80" data-options="formatter:appGridNumberFormatter">ROP</th>
                                        <th halign="center" align="center" field="tgl_kebutuhan" width="100" >Tgl. Kebutuhan</th>
                                        <th halign="center" align="right" field="niai_hpp" width="50" >HPP</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-5">
                    <div class="form-group row" style="margin-top: 10px;margin-left: 5px;">
                        <div class="col-lg-3 col-md-auto col-sm-auto kt-padding">
                            <button id="btn-pilih_barang" type="button"
                                    class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-auto col-sm-auto kt-padding">
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

    <div id="win-cari_no_permintaan" class="panel-window" data-title="Pencarian No. Permintaan" style="width: 80%; height: 90%">
        <div class="kt-portlet">
            <div class="kt-portlet__body_win header-form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 kt-margin-t-10-mobile">
                               <b> <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria_barang_all"></b>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" style="margin-left: 10px;">
                                Tanggal
                            </label>
                            <div class="col-lg-2 col-sm-12">
                                <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-start_tgl_barang">
                            </div>
                            <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">s/d.</label>
                            <div class="col-lg-2 col-sm-12">
                                <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-end_tgl_barang">
                            </div>
                            <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter_barang_all()">
                                    <i class="la la-filter"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="kt-form col-lg-12 header-form" id="form-detail">
                    <div class="row">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-list_barang" height="150" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true">
                                <thead>
                                    <tr>
                                      <th halign="center" align="left" field="no_pm"      width="120">No. Permintaan</th>
                                      <th halign="center" align="center" field="tgl_pm"     width="150" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                      <th halign="center" align="left" field="created_by" width="110">Dibuat Oleh</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="col-lg-12" style="background-color: #0F9E98">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-sm" align="center" style="color: white"><b>Detail Permintaan</b></label>
                            </div>
                            <table id="dtg-list_barang_detail" height="150" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true">
                                <thead>
                                    <tr>
                                      <th halign="center" align="left" field="nama_item" width="400">Nama Item</th>
                                      <th halign="center" align="left" field="kd_item" width="15%">Kode</th>
                                      <th halign="center" align="left" field="nama_satuan" width="10%">Satuan</th>
                                      <th halign="center" align="right" field="jml_mutasi" width="15%" data-options="formatter:appGridNumberFormatter">Jml. Stok</th>
                                      <th halign="center" align="right" field="jml_minta" width="15%" data-options="formatter:appGridNumberFormatter">Jml. Diminta</th>
                                      <th halign="center" align="right" field="niai_hpp" width="15%">HPP</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 20px; margin-left: 20px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                                    <button id="btn-pilih" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                        <i class="la la-check"></i>
                                        Pilih
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                                    <button id="btn-tutup_cari_no_permintaan" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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
    </div>
</div>
<!-- end content
No newline at end of file
