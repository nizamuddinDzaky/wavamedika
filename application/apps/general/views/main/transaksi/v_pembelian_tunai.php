<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Pembelian Tunai</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Transaksi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pembelian</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pembelian Tunai</a>
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
                                        <option value="0" selected>All</option>
                                        <option value="1">Open</option>
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
                                    <input class="form-control form-control-sm" type="text" id="txt-criteria" placeholder="Cari..." required>
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
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah();">
                                        <i class="la la-plus"></i>
                                        Tambah Pembelian Tunai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-pembelian_tunai" height="500" width="100%" title="Daftar Pembelian Tunai" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
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
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_no">
                                    No. Pembelian : 
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
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. Pembelian:
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-no_bpb" class="form-control form-control-sm" type="text">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" type="date-only-formatted"  id="dtb-tgl_bpb">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Gudang :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <select name="" id="cmb-gudang" class="select2 form-control form-control-sm"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Supplier :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="src-supplier" data-options="prompt:'Cari supplier. . .'" class="easyui-searchbox form-control form-control-sm" style="width: 100%;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Alamat :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;" id="txt-alamat"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
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
                                    No. Nota :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-nota" class="form-control form-control-sm" type="text">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Nota :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" type="date-only-formatted" id="dtb-tgl_nota">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. Kasbon :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="src-no_kasbon" data-options="prompt:'Cari no kasbon. . .'" class="easyui-searchbox form-control form-control-sm" style="width: 100%;">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Kasbon :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" type="date-only-formatted"  id="dtb-tgl_kasbon">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Total Kasbon :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="nmb-total_kasbon" class="form-control form-control-sm easyui-numberbox" type="text" style="width: 100%">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Pemakaian :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="nmb-pemakaian" class="form-control form-control-sm easyui-numberbox" type="text" style="width: 100%">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Sisa Kasbon :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="nmb-sisa_kasbon" class="form-control form-control-sm easyui-numberbox" type="text" style="width: 100%">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row div_hidden">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-status_caption" class="form-control form-control-sm" type="text">
                                    <input id="txt-partner_id" class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail" height="300" width="100%" title="Detail Item" class="easyui-datagrid" toolbar="#toolbarDetailA" pagination="false" rownumbers="true" fitColumns="false" singleSelect="true" showFooter="true">
                                <!--  -->
                            </table>
                            <div id="toolbarDetailA">
                                <a href="javascript:void(0)" id="btn-tambah_detail_item" class="easyui-linkbutton div_simpan" plain="true"><i class="la la-plus"></i>
                                    Tambah
                                </a>
                            </div>
                            <div class="row" style="margin-left: 0px; margin-right: 0px; background-color: #f2f2f2" hidden="true">
                                <div style="width: 100px; margin-left: 52%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="nmb-harga_grid" style="text-align: right;" class="form-control form-control-sm easyui-numberbox" type="text">
                                    </div>
                                </div>
                                <div style="width: 100px; margin-left: 8%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="nmb-disc_harga_grid" style="text-align: right;" class="form-control form-control-sm easyui-numberbox" type="text">
                                    </div>
                                </div>
                                <div style="width: 100px; margin-left: 2%; margin-top: 2px;">
                                    <div class="form-group row">
                                        <input id="nmb-subtotal_grid" style="text-align: right;" class="form-control form-control-sm easyui-numberbox" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group row" style="margin-top: 5px;">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Keterangan :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none; height: 98px;" id="txt-keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" style="margin-top: 5px;">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Sub Total :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                   <input id="nmb-subtotal" class="col-lg-10 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Diskon Nota :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="nmb-disc_nota" class="col-lg-10 form-control form-control-sm easyui-numberbox change" style="text-align: right;" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    PPN :
                                </label>
                                <div class="col-lg-4 col-sm-12" style="margin-left: 2%;">
                                    <input id="nmb-persen" class="easyui-numberbox change" style="width: 25px; height: 29px; text-align: right;"> %
                                    <input id="nmb-ppn" class="form-control form-control-sm easyui-numberbox" style="width: 134px; text-align: right;" type="text" readonly="true">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Biaya Lain :
                                </label>
                                <div class="col-lg-3 col-sm-12" style="margin-left: -2%;">
                                   <input id="nmb-biaya_lain" class="col-lg-10 form-control form-control-sm easyui-numberbox change" style="text-align: right;" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm kt-font-bold">
                                    Total :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="nmb-total" class="col-lg-10 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row" title="Autorisasi" style="margin-top: 5px;">
                        <div class="col-lg-10 table-detail">
                            <table id="dtg-auth" height="130" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="true" title="Autorisasi">
                                <thead>
                                    <th halign="center" align="left" field="sign_name" width="20%">Autorisasi</th>
                                    <th halign="center" align="left" field="user_name" width="40%" >Penanggung Jawab</th>
                                    <th halign="center" align="center" field="status_caption" width="20%" >Status</th>
                                    <th halign="center" align="center" field="tgl" width="20%" data-option="formatter:appGridDateTimeFormatter">Tanggal</th>
                                </thead>
                            </table>
                        </div>
                    </div> -->
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
                                    <button id="btn-batal" onclick="tab(0);" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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

    <div id="win-cari_supplier" class="panel-window" style="height:80%; width: 80%" data-title="Pencarian Data Supplier">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Kriteria :</label>
                                <div class="col-lg-7 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_supplier" placeholder="Cari..." required>
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
                            <table id="dtg-supplier" height="330" width="100%" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="partner_id" width="15%">ID Supplier</th>
                                        <th halign="center" align="left" field="partner_name" width="30%">Nama Supplier</th>
                                        <th halign="center" align="left" field="partner_address" width="30%">Alamat</th>
                                        <th halign="center" align="left" field="partner_phone" width="10%">No. Telepon</th>
                                        <th halign="center" align="left" field="contact_person" width="10%">Contact Person</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_supplier" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_supplier()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_supplier" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="batal()">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-cari_no_kasbon" class="panel-window" data-title="Pencarian No. Kasbon" style="width: 80%; height: 80%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_kasbon" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter_kasbon()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-kasbon" height="330" width="100%" class="easyui-datagrid" pagination="true" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="ct_no" width="15%">No. Kasbon</th>
                                        <th halign="center" align="center" field="ct_date" width="10%" data-options="formatter:appGridDateFormatter">Tanggal</th>
                                        <th halign="center" align="left" field="partner_name"  width="25%">Bayar Ke</th>
                                        <th halign="center" align="right" field="ct_amount" width="10%" data-options="formatter:datagridFormatNumber">Total Kasbon</th>
                                        <th halign="center" align="right" field="cash_adv_blc" width="10%" data-options="formatter:datagridFormatNumber">Sisa Kasbon</th>
                                        <th halign="center" align="left" field="ct_desc" width="35%">Catatan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_kasbon" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_kasbon()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_kasbon" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="batal()">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-detail_item" class="panel-window" style="height:80%; width: 55%" data-title="Tambah Detail Item">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail_item">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-5 col-sm-12">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria_barang" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
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
                            <table id="dtg-barang" height="330" width="100%" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="false">
                                <thead>
                                    <tr>
                                        <th field="pilih" checkbox="true">Pilih</th>
                                        <th halign="center" align="left" field="id_item" width="15%" hidden="true">ID</th>
                                        <th halign="center" align="left" field="id_satuan" width="15%" hidden="true">ID Satuan</th>
                                        <th halign="center" align="left" field="hpp" width="15%" hidden="true">hpp</th>
                                        <th halign="center" align="left" field="kd_item" width="15%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="70%">Nama Item</th>
                                        <th halign="center" align="left" field="nama_satuan" width="10%">Satuan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 10px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_detail_item" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_barang()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_detail_item" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="batal()">
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