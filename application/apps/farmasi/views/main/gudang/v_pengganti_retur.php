<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Pengganti Retur</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Gudang</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Retur Pembelian Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pengganti Retur</a>
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
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="">
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
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah();">
                                        <i class="la la-plus"></i>
                                        Tambah Pengganti Retur
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-pengganti_retur" height="500" width="100%" title="Daftar Pengganti Retur" class="easyui-datagrid" rownumbers="true" pagination="true">
                        <!--  -->
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
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. BPB :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="txt-no_bpb" class="form-control form-control-sm" type="text" disabled="true">
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
                                <div class="col-lg-9 col-sm-12">
                                    <select class="select2 form-control" id="cmb-gudang">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Supplier :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-partner_name" class="form-control form-control-sm" type="text">
                                </div>
                                <div class="col-lg-1 col-sm-12">
                                    <button id="btn-cari_supplier" type="button" class="form-control-sm btn btn-primary kt-search-custom" style="">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Alamat :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="height: 70px; resize: none;" id="txt-alamat" disabled="true"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. Retur :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-no_retur" class="form-control form-control-sm" type="text">
                                </div>
                                <div class="col-lg-1 col-sm-12">
                                    <button id="btn-cari_noretur" type="button" class="form-control-sm btn btn-primary kt-search-custom" style="">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Retur :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input class="form-control form-control-sm" type="date-only-formatted" id="dtb-tgl_retur" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Catatan :
                                </label>
                                <div class="col-lg-10 col-sm-12">
                                    <textarea id="txt-ket_bpb" class="form-control form-control-sm kt-font-sm" style="resize: none;  height: 145px;"></textarea>
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
                                    <input id="txt-jns_ppn" class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail_item" height="300" width="100%" title="Detail Item" class="easyui-datagrid" toolbar="#toolbar" pagination="false" rownumbers="true" showfooter="true">
                                <thead>
                                    <tr>
                                        <th colspan="2">Item</th>
                                        <th colspan="2">Retur Pembelian</th>
                                        <th colspan="3">Pengganti Retur</th>
                                    </tr>
                                    <tr>
                                        <th halign="center" align="left" field="kd_item" width="13%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="25%">Nama Item</th>

                                        <th halign="center" align="left" field="jml_rt" width="10%">Jumlah</th>
                                        <th halign="center" align="left" field="nama_satuan_rt" width="10%">Satuan</th>

                                        <th halign="center" align="left" field="jml_ganti" width="10%">Jumlah</th>
                                        <th halign="center" align="left" field="tgl_ed" width="12%">Tgl. Kedaluwarsa</th>
                                        <th halign="center" align="left" field="no_batch" width="13%">No. Batch</th>
                                    </tr>
                                </thead>
                            </table>
                            <div id="toolbar">
                                <a href="javascript:void(0)" id="btn-tambah_detail_item" class="easyui-linkbutton div_simpan" plain="true">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
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
                                    <button id="btn-cetak" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="cetak()">
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

    <div id="win-cari_supplier" class="panel-window" style="height:85%; width: 80%" data-title="Pencarian Data Supplier">
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
                            <table id="dtg-supplier" height="385" width="100%" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="partner_id" width="15%">ID Supplier</th>
                                        <th halign="center" align="left" field="partner_name" width="30%">Nama Supplier</th>
                                        <th halign="center" align="left" field="partner_address" width="30%">Alamat</th>
                                        <th halign="center" align="left" field="partner_phone" width="15%">No. Telepon</th>
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
                            <button id="btn-batal_supplier" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="cancel()">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-cari_noretur" class="panel-window" data-title="Data Retur Pembelian" style="width: 60%; height: 95%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row kt-line-header">
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_partner">
                                </label>
                            </div>
                            <div class="form-group row" style="margin-top: 2%;">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria:
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_data_retur" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter_retur_pembelian()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-list_retur_pembelian" height="200" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="no_rt_pb" width="30%">No. Retur</th>
                                        <th halign="center" align="center" field="tgl_rt_pb" width="25%" data-options="formatter:appGridDateFormatter">Tgl. Retur</th></th>
                                        <th halign="center" align="left" field="catatan" width="45%">Catatan</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="col-lg-12" style="background-color: #0F9E98">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-sm" align="center" style="color: white"><b>Detail Item</b></label>
                            </div>
                            <table id="dtg-list_retur_pembelian_detail" height="150" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="kd_item" width="20%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="40%">Nama Item</th>
                                        <th halign="center" align="left" field="nama_satuan" width="20%">Satuan</th>
                                        <th halign="center" align="center" field="jml_retur" width="20%" data-options="formatter:appGridNumberFormatter">Jml. Retur</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_nopo" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_retur_pembelian()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button onclick="cancel();" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-detail_item" class="panel-window" style="height:82%; width: 60%" data-title="Pencarian Data Item Barang Retur">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail_item">
                    <div class="form-group row kt-line-header justify-content-between">
                        <label class="kt-font-bold col-lg-auto col-sm-12 kt-line-height kt-font" id="txt-label_supplier_detail">
                            Supplier :
                        </label>
                        <label class="kt-font-bold col-lg-auto col-sm-12 kt-line-height kt-font" id="txt-label_no_retur_detail">
                            No. Retur :
                        </label>
                    </div>
                    <div class="row" style="margin-top: 1%">
                        <div class="col-12 table-detail">
                            <table id="dtg-barang_retur" height="370" width="100%" class="easyui-datagrid" pagination="false" rownumbers="true" singleSelect="false">
                                <thead>
                                    <tr>
                                        <th field="pilih" checkbox="true">Pilih</th>
                                        <th halign="center" align="center" field="kd_item" width="20%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="40%">Nama Item</th>
                                        <th halign="center" align="left" field="nama_satuan" width="15%">Satuan</th>
                                        <th halign="center" align="center" field="jml_retur" width="20%" data-options="formatter:appGridNumberFormatter">Jml. Retur</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_barang" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_barang_retur()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button onclick="cancel()" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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