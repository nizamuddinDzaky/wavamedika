<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Order Pembelian General</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Transaksi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pembelian</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Order Pembelian</a>
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
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Status :
                                </label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-status">
                                        <option value="0" selected>All</option>
                                        <option value="1">Open</option>
                                        <option value="2">Release</option>
                                        <option value="3">Approve</option>
                                        <option value="4">Reject</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm">
                                    s/d :
                                </label> 
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
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="tambah();">
                                        <i class="la la-plus"></i>
                                        Tambah Order Pembelian
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-order_pembelian" height="500" width="100%" title="Daftar Order Pembelian" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
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
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_nopo">
                                    No. PO : 
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
                                            <button id="btn-open" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('open')">
                                                <i class=""></i>
                                                Open
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-approve" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="validation('approve')">
                                                <i class=""></i>
                                                Approve
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto">
                                            <button id="btn-reject" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="validation('reject')">
                                                <i class=""></i>
                                                Reject
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-release" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('release')">
                                                <i class=""></i>
                                                Release
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-auto kt-padding-t-10-mobile">
                                    <div class="form-group row">
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-close_po" type="button" class="form-control form-control-sm btn btn-sm btn-secondary" onclick="close_po()">
                                                <i class="la la-check"></i>
                                                Close PO
                                            </button>
                                        </div>
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
                                    No. PO :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="txt-no" class="form-control form-control-sm" type="text" readonly="true">
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
                                    Supplier :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-nama_supplier" data-options="prompt:'Cari supplier. . .'" class="form-control form-control-sm" style="width: 100%;" disabled="true">
                                    <input type="hidden" name="" id="src-supplier">
                                </div>
                                <!-- <button type="button" style="margin-left: -10px;" class="easyui-linkbutton btn-primary" plain="true" id="btn-show-supplier" onclick="show_supplier()">
                                        <i class="la la-search"></i>
                                </button> -->
                                <div class="col-lg-1 col-sm-12">
                                    <button type="button" style="margin-left: -4px;" class="easyui-linkbutton btn-primary" plain="true" id="btn-show-supplier" onclick="show_supplier()">
                                        <i class="la la-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Alamat :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;" id="txt-ket_supplier"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. PP :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="src-nopp" data-options="prompt:'Cari no pp. . .'" class="form-control form-control-sm" style="width: 100%;" disabled="true">
                                </div>
                                <div class="col-lg-1 col-sm-12">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-show-nopp" onclick="show_nopp()">
                                        <i class="la la-search"></i>
                                    </button>
                                </div>

                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Jenis:
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-jenis">
                                        <option value="1">Obat</option>
                                        <option value="2">Alkes</option>
                                        <option value="3">Gas Medis</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Payment :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <select class="form-control form-control-sm select2" required="true" id="cmb-payment">
                                    </select>
                                    <input type="hidden" name="" id="txt-term-of-payment">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    PPN :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-ppn">
                                        <option value="1">Exclude</option>
                                        <option value="2">None</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Delivery :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <select class="form-control form-control-sm select2 kt-font-sm" required="true" id="cmb-delivery">
                                    </select>
                                    <input type="hidden" name="" id="txt-delivery">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Jatuh Tempo :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="dtb-date_jatuh_tempo" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Kirim :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="dtb-date_delivery">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Keterangan :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;" id="txt-ket"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail_item" height="300" width="100%" title="Detail Item" class="easyui-datagrid" toolbar="#toolbarDetailA" pagination="false" rownumbers="true" singleSelect="true">
                                <tfoot>
                                    <th>
                                        
                                    </th>
                                </tfoot>
                            </table>
                            <div id="toolbarDetailA">
                                <a href="javascript:void(0)" id="btn-tambah_detail_item" class="easyui-linkbutton div_simpan" plain="true"><i class="la la-plus"></i>
                                    Tambah
                                </a>
                            </div>
                            <!-- <div class="row" style="margin-left: 0px; margin-right: 0px; background-color: #f2f2f2">
                                <div style="width: 90px; margin-left: 55%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-harga" style="text-align: right;" class="form-control form-control-sm easyui-numberbox" type="text" readonly="true">
                                    </div>
                                </div>
                                <div style="width: 90px; margin-left: 9%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-disc_harga" style="text-align: right;" class="form-control form-control-sm" type="text" readonly="true">
                                    </div>
                                </div>
                                <div style="width: 90px; margin-left: 32px; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="txt-subtotal_grid" style="text-align: right;" class="form-control form-control-sm" type="text" readonly="true">
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                            Sub Total :
                                        </label>
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                            Diskon Harga :
                                        </label>
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                            Diskon Nota :
                                        </label>
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                            PPN :
                                        </label>
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                            Biaya Lain :
                                        </label>
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm kt-font-bold">
                                            Total :
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="form-group row">
                                        <!-- subtotal -->
                                        <div class="col-lg-2 col-sm-12">
                                            <input id="txt-subtotal" class="col-lg-9 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                        </div>
                                        <!-- diskon harga -->
                                        <div class="col-lg-2 col-sm-12">
                                            <input id="txt-disc" class="col-lg-9 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text">
                                        </div>
                                        <!-- diskon nota -->
                                        <div class="col-lg-2 col-sm-12" style="">
                                            <input id="txt-disc_nota" class="col-lg-9 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text">
                                        </div>
                                        <!-- ppn -->
                                        <div class="col-lg-2 col-sm-12" style="margin-left: 0%;">
                                            <input id="txt-persen" class="easyui-numberbox" style="width: 22px; height: 29px; text-align: right; margin-left: -5px;"> %
                                            <input id="txt-ppn" class="col-lg-8 form-control form-control-sm easyui-numberbox" style="margin-left: -3%; text-align: right;" type="text" readonly="true">
                                        </div>
                                        <!-- biaya lain -->
                                        <div class="col-lg-2 col-sm-12" style="">
                                            <input id="txt-biaya_lain" class="col-lg-9 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text">
                                        </div>
                                        <!-- total -->
                                        <div class="col-lg-2 col-sm-12" style="">
                                            <input id="txt-total" class="col-lg-9 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" title="Autorisasi" style="margin-top: 5px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-auth" height="200" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true" title="Autorisasi">
                                <thead>
                                    <th halign="center" align="left" field="sign_id" width="20%" hidden="true">sign_id</th>
                                    <th halign="center" align="left" field="user_id" width="20%" hidden="true">user_id</th>
                                    <th halign="center" align="left" field="is_default" width="20%" hidden="true">is_default</th>
                                    <th halign="center" align="left" field="seq_no" width="20%" hidden="true">seq_no</th>

                                    <th halign="center" align="left" field="sign_name" width="20%">Autorisasi</th>
                                    <th halign="center" align="left" field="user_name" width="40%" >Penanggung Jawab</th>
                                    <th halign="center" align="center" field="status_caption" width="20%" >Status</th>
                                    <th halign="center" align="center" field="tgl" width="20%" data-option="formatter:appGridDateTimeFormatter">Tanggal</th>
                                </thead>
                            </table>
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
                                    <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tab(0)">
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
                                        <th halign="center" align="center" field="partner_id" width="15%">ID Supplier</th>
                                        <th halign="center" align="left" field="partner_name" width="30%">Nama Supplier</th>
                                        <th halign="center" align="left" field="partner_address" width="30%">Alamat</th>
                                        <th halign="center" align="center" field="partner_phone" width="15%">No. Telepon</th>
                                        <th halign="center" align="center" field="contact_person" width="10%">Contact Person</th>
                                        <th halign="center" align="center" field="data_partner" width="10%" hidden="true">Contact Person</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_supplier()">
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

    <div id="win-cari_nopp" class="panel-window" data-title="Pencarian No PP" style="width: 80%; height: 99%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row kt-line-header">
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_nopp">
                                    PT. ANUGRAH ARGON MEDIKA
                                </label>
                            </div>
                            <div class="form-group row" style="margin-top: 2%;">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria-no-pp" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter-no-pp" onclick="filter_no_pp()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>

                                <div class="col-lg-auto col-sm-12" style="margin-top: 7px; margin-left: 28%">
                                    <input name="chk-is_aktif" type="checkbox" id="chk-is_aktif">
                                </div>
                                <label class="form-control-sm kt-font-sm" style="margin-left: -1%;">
                                    Tampilkan Data Barang Supplier
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-list_barang" height="240" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="no_pp" width="15%">No. Permintaan</th>
                                        <th halign="center" align="center" field="tgl_pp" width="15%" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                        <th halign="center" align="left" field="jns_pp"  width="15%">Jenis</th>
                                        <th halign="center" align="left" field="ket_pp" width="35%">Keterangan</th>
                                        <th halign="center" align="left" field="created_by" width="20%">Yang Mengajukan</th>
                                        <th halign="center" align="left" field="details" width="20%" hidden="true">Yang Mengajukan</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="col-lg-12" style="background-color: #0F9E98">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-sm" align="center" style="color: white"><b>Detail Item</b></label>
                            </div>
                            <table id="dtg-list_barang_detail" height="150" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="center" field="id_item" width="12%">Kode</th>
                                        <th halign="center" align="center" field="kd_item" width="12%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="28%">Nama Item</th>
                                        <th halign="center" align="center" field="id_satuan" width="10%">Satuan</th>
                                        <th halign="center" align="center" field="jenis" width="10%">Jenis</th>
                                        <th halign="center" align="right" field="jml_minta" width="15%" data-options="formatter:datagridFormatNumber">Jml. Permintaan</th>
                                        <th halign="center" align="right" field="harga_beli" width="15%" data-options="formatter:datagridFormatNumber">Harga Beli Terakhir</th>
                                        <th halign="center" align="margin-right" field="tgl_kebutuhan" width="15%" data-options="formatter:appGridDateFormatter">Tgl. Kebutuhan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_nopp" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_no_pp()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_nopp" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-detail_item" class="panel-window" style="height:82%; width: 80%" data-title="Tambah Detail Item">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail_item">
                    <div class="form-group row kt-line-header">
                        <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_filter_barang">
                            
                        </label>
                    </div>
                    <div class="form-group row" style="margin-top: 2%;">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                            Kriteria :
                        </label>
                        <div class="col-lg-3 col-sm-12">
                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria-item-detail" placeholder="Cari...">
                        </div>
                        <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                            <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter-item-detail" onclick="filter_barang()">
                                <i class="la la-filter"></i>
                                Filter
                            </button>
                        </div>

                        <div class="col-lg-auto col-sm-12" style="margin-top: 7px; margin-left: 28%">
                            <input name="chk-is_aktif" type="checkbox" id="chk-is_aktif-item-detail">
                        </div>
                        <label class="form-control-sm kt-font-sm" style="margin-left: -1%;">
                            Tampilkan Data Barang Supplier
                        </label>
                    </div>
                    <div class="row" style="margin-top: -1%">
                        <div class="col-12 table-detail">
                            <table id="dtg-filter_barang" height="380" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="false">
                                <thead>
                                    <tr>
                                        <th field="pilih" checkbox="true">Pilih</th>
                                        <th halign="center" align="center" field="kd_item" width="13%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="30%">Nama Item</th>
                                        <th halign="center" align="left" field="id_satuan" width="10%">Satuan</th>
                                        <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                        <th halign="center" align="center" field="jml_minta" width="10%">Jml. Permintaan</th>
                                        <th halign="center" align="center" field="harga_beli" width="13%">Harga Beli Terakhir</th>
                                        <th halign="center" align="center" field="tgl_kebutuhan" width="10%">Tgl. Kebutuhan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_supplier" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_barang()">
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