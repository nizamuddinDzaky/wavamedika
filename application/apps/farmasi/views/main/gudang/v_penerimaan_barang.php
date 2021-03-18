<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Penerimaan Barang Farmasi</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Gudang</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pembelian Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Penerimaan Barang</a>
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
                                        <option value="1" selected>Open</option>
                                        <option value="2">Release</option>
                                    </select>
                                </div>
                            </div>
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
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="tambah()">
                                        <i class="la la-plus"></i>
                                        Tambah Penerimaan Barang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-penerimaan_barang" height="500" width="100%" title="Daftar Penerimaan Barang" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
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
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_nobpb">
                                    No. BPB : 
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
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. BPB :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="txt-no" class="form-control form-control-sm" type="text" disabled="true"> 
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="dtb-date_input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Gudang :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <select class="select2 form-control" id="cmb-gudang">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Supplier :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <input id="src-supplier" data-options="prompt:'Cari supplier. . .'" class="easyui-searchbox form-control form-control-sm" style="width: 100%;">
                                    <input class="form-control form-control-sm"  id="id_supplier" hidden="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Alamat :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;height: 64px" id="txt-alamat" disabled="true"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. PO :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="src-nopo" data-options="prompt:'Cari no po. . .'" class="easyui-searchbox form-control form-control-sm" style="width: 100%;">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    PPN :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-ppn">
                                        <option value="1">Exclude</option>
                                        <option value="2">None</option>
                                    </select>
                                    <!-- <input id="txt-ppn" class="form-control form-control-sm" type="text" disabled="true"> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. Faktur :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-no_faktur" class="form-control form-control-sm" type="text">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Faktur :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted" id="dtb-faktur">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                   Term of Payment:
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-payment" class="form-control form-control-sm" type="text" disabled="true">
                                    <input type="hidden" name="" id="txt-term-of-payment">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                   Tgl. Jatuh Tempo :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="dtb-jatuh_tempo" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. Surat Jalan :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-surat_jalan" class="form-control form-control-sm" type="text">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Surat Jalan :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="dtb-surat_jalan">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Keterangan :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;" id="txt-ket"></textarea>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail_item" height="300" width="100%" title="Detail Item" class="easyui-datagrid" toolbar="#toolbarDetailA" pagination="false" rownumbers="true" singleSelect="true" showFooter="true">
                                <!--  -->
                            </table>
                            <div id="toolbarDetailA">
                                <a href="javascript:void(0)" id="btn-tambah_detail_item" class="easyui-linkbutton div_simpan" plain="true"><i class="la la-plus"></i>
                                    Tambah
                                </a>
                            </div>
                            <div class="row" style="margin-left: 0px; margin-right: 0px; background-color: #f2f2f2" hidden="true">
                                <div style="width: 90px; margin-left: 60%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-harga" style="text-align: right;" class="form-control form-control-sm easyui-numberbox" type="text" readonly="true">
                                    </div>
                                </div>
                                <div style="width: 90px; margin-left: 11%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-disc_harga" style="text-align: right;" class="form-control form-control-sm easyui-numberbox" type="text" readonly="true">
                                    </div>
                                </div>
                                <div style="width: 90px; margin-left: 23px; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-subtotal_grid" style="text-align: right;" class="form-control form-control-sm easyui-numberbox" type="text" readonly="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Keterangan :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none; height:97px;" id="txt-keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Sub Total :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-sub_total" class="form-control form-control-sm easyui-numberbox" type="text" readonly="true" style="text-align: right">
                                </div>
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Diskon Nota :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-diskon_nota" class="form-control form-control-sm easyui-numberbox" type="text" style="text-align: right">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    PPN :
                                </label>
                                <div class="col-lg-1 col-sm-12">
                                    <input id="txt-persen" class="easyui-numberbox" style="width: 25px; height: 29px; text-align: right; margin-left: -5px;">%
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-total_ppn" class="form-control form-control-sm easyui-numberbox" type="text" readonly="true" style="text-align: right" >
                                </div>
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Biaya Lain-lain
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-biaya_lain" class="form-control form-control-sm easyui-numberbox" type="text" style="text-align: right">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                   <b>Total:</b>
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-total" class="form-control form-control-sm easyui-numberbox" type="text" readonly="true" style="text-align: right">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 0px; margin-top: 10px; margin-bottom: 15px;">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding div_simpan">
                                    <button onclick="simpan()" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                        <i class="la la-save"></i>
                                        Simpan
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                                    <button onclick="tab(0);" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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
                                    <button id="btn-cetak" onclick="cetak();" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                        <i class="la la-print"></i>
                                        Cetak
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="win-cari_supplier" class="panel-window" style="height:76%; width: 80%" data-title="Pencarian Data Supplier">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Kriteria :</label>
                                <div class="col-lg-7 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria_cari_supplier" placeholder="Cari..." required>
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
                            <table id="dtg-data_supplier" height="330" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="partner_id" width="15%">ID Supplier</th>
                                        <th halign="center" align="left" field="partner_name" width="30%">Nama Supplier</th>
                                        <th halign="center" align="left" field="partner_address" width="30%">Alamat</th>
                                        <th halign="center" align="center" field="partner_phone" width="15%">No. Telepon</th>
                                        <th halign="center" align="center" field="contact_person" width="10%">Contact Person</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_supplier" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_supplier" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-cari_nopo" class="panel-window" data-title="Pencarian No PO" style="width: 80%; height: 99%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row kt-line-header">
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_nopo">
                                </label>
                            </div>
                            <div class="form-group row" style="margin-top: 2%;">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria_nopo" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-list_barang" height="210" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="no_po" width="20%">No. PO</th>
                                        <th halign="center" align="left" field="jns_po"  width="15%">Jenis</th>
                                        <th halign="center" align="center" field="tgl_po" width="15%" data-options="formatter:appGridDateFormatter">Tgl. PO</th>
                                        <th halign="center" align="right" field="total" width="15%" data-options="formatter:appGridNumberFormatter">Total PO</th>
                                        <th halign="center" align="left" field="ket_po" width="30%">Catatan</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="col-lg-12" style="background-color: #0F9E98">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-sm" align="center" style="color: white"><b>Detail Item</b></label>
                            </div>
                            <table id="dtg-list_barang_detail" height="150" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="kd_item" width="12%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="28%">Nama Item</th>
                                        <th halign="center" align="left" field="nama_satuan_po" width="10%">Satuan</th>
                                        <th halign="center" align="center" field="jml_po" width="10%" data-options="formatter:appGridNumberFormatter">Jml. PO</th>
                                        <th halign="center" align="right" field="jml_po_sisa" width="15%" data-options="formatter:appGridNumberFormatter">Jml. PO Sisa</th>
                                        <th halign="center" align="right" field="harga" width="15%" data-options="formatter:appGridNumberFormatter">Harga</th>
                                        <th halign="center" align="right" field="p_diskon" width="15%" data-options="formatter:appGridNumberFormatter">Disc. (%)</th>
                                        <th halign="center" align="right" field="tot_diskon" width="15%" data-options="formatter:appGridNumberFormatter">Disc. (Harga)</th>
                                        <th halign="center" align="right" field="total" width="15%" data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="row" style="margin-left: 0px; margin-right: 0px; background-color: #f2f2f2">
                                <div style="width: 90px; margin-left: 60%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-harga" style="text-align: right;" class="form-control form-control-sm" type="text" disabled="true">
                                    </div>
                                </div>
                                <div style="width: 90px; margin-left: 11%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-disc_harga" style="text-align: right;" class="form-control form-control-sm" type="text" disabled="true">
                                    </div>
                                </div>
                                <div style="width: 90px; margin-left: 23px; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-subtotal_grid" style="text-align: right;" class="form-control form-control-sm" type="text" disabled="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_nopo" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_nopo" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-detail_item" class="panel-window" style="height:88%; width: 80%" data-title="Tambah Detail Item">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail_item">
                    <div class="form-group row">
                        <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_supplier">
                        </label>
                        <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" style="margin-left: 62%;" id="txt-label_nopo2">
                        </label>
                    </div>
                    <div class="row" style="margin-top: -1%">
                        <div class="col-12 table-detail">
                            <table id="dtg-barang_po" height="380" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th field="pilih" checkbox="true">Pilih</th>
                                        <th halign="center" align="left" field="id_item" hidden="true"></th>
                                        <th halign="center" align="left" field="kd_item" width="13%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="30%">Nama Item</th>
                                        <th halign="center" align="left" field="id_satuan_po" width="10%">Satuan</th>
                                        <th halign="center" align="right" field="jml_po" width="10%" data-options="formatter:appGridNumberFormatter">Jml. PO</th>
                                        <th halign="center" align="right" field="jml_po_sisa" width="10%" data-options="formatter:appGridNumberFormatter">Jml. PO Sisa</th>
                                        <th halign="center" align="right" field="harga" width="15%" data-options="formatter:appGridNumberFormatter">Harga</th>
                                        <th halign="center" align="right" field="disc" width="10%" data-options="formatter:appGridNumberFormatter">Disc. (%)</th>
                                        <th halign="center" align="right" field="disc_harga" width="15%" data-options="formatter:appGridNumberFormatter">Disc. (Harga)</th>
                                        <th halign="center" align="right" field="subtotal" width="15%" data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                    </tr>
                                </thead>
                            </table>
                            <!-- <div class="row" style="margin-left: 0px; margin-right: 0px; background-color: #f2f2f2">
                                <div style="width: 90px; margin-left: 60%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-harga" style="text-align: right;" class="form-control form-control-sm" type="text" disabled="true">
                                    </div>
                                </div>
                                <div style="width: 90px; margin-left: 10%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-disc_harga" style="text-align: right;" class="form-control form-control-sm" type="text" disabled="true">
                                    </div>
                                </div>
                                <div style="width: 90px; margin-left: 23px; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-subtotal_grid" style="text-align: right;" class="form-control form-control-sm" type="text" disabled="true">
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_barang_po" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
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