<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Kerjasama Obat</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pembelian</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Kerjasama Obat</a>
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
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                <div class="col-lg-5 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input class="form-control form-control-sm" type="text" id="txt-criteria" placeholder="Cari..." required>
                                </div>
                                <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="kt-checkbox--success form-control-sm col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <input id="chk-is_aktif" name="chk-is_aktif" type="checkbox"> Tampilkan Semua Data
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <div class="form-group row">
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah();">
                                        <i class="la la-plus"></i>
                                        Tambah Kerjasama Item
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-kerjasama_obat" height="500" width="100%" title="Daftar Kerjasama Obat" class="easyui-datagrid" rownumbers="true" pagination="true">
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
                                    No. IKS : 
                                </label>
                                <!-- <div style="border-left: 1px black solid; height: 12px; width: 5px; margin-top: 10px">
                                </div> -->
                                <!-- <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm" id="txt-label_status">
                                    Status : 
                                </label>
                                <div style="border-left: 1px black solid; height: 12px; width: 5px; margin-top: 10px">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm" id="txt-label_posted">
                                    
                                </label> -->
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group row justify-content-lg-between">
                                <div class="col-lg-auto kt-padding-t-10-mobile">
                                    <!-- <div class="form-group row" id="btn-aksi">
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-open" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('open')">
                                                <i class=""></i>
                                                Open
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-approve" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(3,0)" hidden="true">
                                                <i class=""></i>
                                                Approve
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto">
                                            <button id="btn-reject" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status(4,0)" hidden="true">
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
                                    </div> -->
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
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Nomor :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="txt-no_kerjasama_item" class="form-control form-control-sm" type="text" disabled="true">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" type="date-only-formatted"  id="dtb-tgl_pengajuan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    No. IKS :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <input id="txt-no_iks" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Nama Produsen :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-nama_produsen" class="form-control form-control-sm" style="width: 100%;" readonly="true">
                                </div>
                                <div class="col-lg-1 col-sm-12">
                                    <button id="btn-cari_produsen" type="button" class="form-control-sm btn btn-primary kt-search-custom" style="">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Contact Person :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <input id="txt-contact_person" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Keterangan :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <textarea class="form-control form-control-sm kt-font-sm" style="height: 70px; resize: none;" id="txt-keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Total :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="nmb-total" class="form-control form-control-sm easyui-numberbox" style="width: 100%; text-align: right;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Awal :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" type="date-only-formatted"  id="dtb-tgl_awal">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Akhir :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" type="date-only-formatted"  id="dtb-tgl_akhir">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row div_hidden">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-id_produsen" class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail_item" height="300" width="100%" title="Detail Item" class="easyui-datagrid" toolbar="#toolbar" pagination="false" rownumbers="true" showfooter="true">
                                <!--  -->
                            </table>
                            <div id="toolbar">
                                <a href="javascript:void(0)" id="btn-tambah_detail" class="easyui-linkbutton" plain="true">
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
                                    <button id="btn-tampil_cetak" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
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

    <div id="win-cari_produsen" class="panel-window" style="height:85%; width: 47%" data-title="Pencarian Data Produsen">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Kriteria :</label>
                                <div class="col-lg-6 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_produsen" placeholder="Cari..." required>
                                </div>
                                <div class="col-lg-3 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter_produsen()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-produsen" height="390" width="100%" class="easyui-datagrid" rownumbers="true" singleSelect="true" pagination="false">
                                <thead>
                                    <tr>
                                        <th halign="center" align="center" field="id_produsen" width="35%">Kode</th>
                                        <th halign="center" align="left" field="nama_produsen" width="65%">Nama Produsen</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-10" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_produsen" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_produsen()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button onclick="tutup()" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-detail" class="panel-window" style="height:82%; width: 47%" data-title="Data Barang">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail_item">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Kriteria :</label>
                                <div class="col-lg-6 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_barang" placeholder="Cari..." required>
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
                    <div class="row" style="margin-top: 1%">
                        <div class="col-12 table-detail">
                            <table id="dtg-barang" height="370" width="100%" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="false">
                                <thead>
                                    <tr>
                                        <th halign="center" align="center" field="id_item" width="10%" hidden="true"></th>
                                        <th halign="center" align="center" field="nama_satuan" width="10%" hidden="true"></th>
                                        <th halign="center" align="center" field="nama_kel_item" width="10%" hidden="true"></th>

                                        <th halign="center" align="center" field="kd_item" width="30%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="50%">Nama Item</th>
                                        <th halign="center" align="left" field="id_satuan" width="20%">Satuan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-10" style="margin-top: 10px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_barang" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_barang()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button onclick="tutup()" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-cetak" class="panel-window" style="height:55%; width: 36%" data-title="Cetak Kerjasama Item">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail_item">
                    <div class="form-group row kt-line-header">
                        <label class="kt-font-bold col-lg-auto col-sm-12 kt-line-height kt-font" id="txt-label_produsen">
                            
                        </label>
                    </div>
                    <!-- <div class="row"> -->
                        <!-- <div class="col-lg-12"> -->
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change col-form-label" id="semua" name="radios" checked="true" style="margin-left: 20px;" value="1">
                                <label for="semua" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label kt-font-sm" style="margin-left: 20px;">Semua</label>
                            </div>
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change col-form-label" id="tanggal" name="radios" style="margin-left: 20px;" value="2">
                                <label for="tanggal" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label kt-font-sm" style="margin-left: 20px;">Tanggal :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm change dtb" type="date-only-formatted"  id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">s/d :</label> 
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm change dtb" type="date-only-formatted"  id="dtb-end_date">
                                </div>
                            </div>
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change col-lg-auto" id="bulan" name="radios" value="3">
                                <label for="bulan" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label kt-font-sm" style="margin-left: 20px;">Bulan :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm change" id="cmb-bulan">
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>

                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm kt-font-sm">Tahun :</label> 
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm change" id="cmb-tahun1">
                                        <option value="1">2019</option>
                                        <option value="2" selected>2020</option>
                                        <option value="3">2021</option>
                                        <option value="4">2022</option>
                                        <option value="5">2023</option>
                                        <option value="6">2024</option>
                                        <option value="7">2025</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change form-control-sm" id="tahun" name="radios" value="4">
                                <label for="tahun" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label kt-font-sm" style="margin-left: 20px;">Tahun :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm change" id="cmb-tahun2">
                                        <option value="1">2019</option>
                                        <option value="2" selected>2020</option>
                                        <option value="3">2021</option>
                                        <option value="4">2022</option>
                                        <option value="5">2023</option>
                                        <option value="6">2024</option>
                                        <option value="7">2025</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile" style="margin-left: -5px; margin-top: 20px;">
                                <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-cetak" onclick="cetak()">
                                    <i class="la la-print"></i>
                                    Cetak
                                </button>
                                <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-export" onclick="export_excel()">
                                    <i class="la la-arrow-down"></i>
                                    Export
                                </button>
                            </div>
                        <!-- </div> -->
                    <!-- </div> -->
                </form>
                <form action="" method="post" id="form_excel" hidden="true">
                    <div>
                        <input type="text" id="no_kerjasama_item" name="no_kerjasama_item">
                        <input type="text" id="type_file" name="type_file">
                        <input type="text" id="buffer" name="buffer">
                        <input type="text" id="rpt_period" name="rpt_period">
                        <input type="text" id="start_date" name="start_date">
                        <input type="text" id="end_date" name="end_date">
                        <input type="text" id="month_period" name="month_period">
                        <input type="text" id="year_period" name="year_period">
                        <input type="text" id="year_period_text" name="year_period_text">
                    </div> 
                </form>
                <div class="col-lg-11" style="margin-top: 5px; margin-left: 20px;">
                    <div class="form-group row justify-content-between">
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <!-- <button id="btn-pilih_barang" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_barang()">
                                <i class="la la-check"></i>
                                Pilih
                            </button> -->
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button onclick="tutup();" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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