<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container" style="padding-right: 1px;">
        <div class="row col-lg-12 justify-content-between">
            <div class="col-lg-auto">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Retur Bon Pemakaian Pasien</h3>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home">
                            <i class="flaticon2-shelter"></i>
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Pelayanan Farmasi</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Retur Bon Pemakaian Pasien</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-auto justify-content-end">
                <!-- <div class="kt-subheader__main" style="margin-top: 2%;">
                    <h3 class="kt-subheader__title" id="label-unit" onclick="buka_unit(1)" align="right">
                        Nota Farmasi Rawat Jalan
                    </h3>
                </div> -->
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
                            <!-- <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Status :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-status">
                                        <option value="0">All</option>
                                        <option value="1">Proses</option>
                                        <option value="2">Selesai</option>
                                        <option value="3">Diserahkan</option>
                                    </select>
                                </div>
                            </div> -->
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
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria" placeholder="Cari..." required>
                                </div>
                                <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter()">
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
                                        Tambah Retur
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-retur_pemakaian_pasien" height="500" width="100%" title="Daftar Retur Bon Pemakaian Pasien" class="easyui-datagrid" rownumbers="true" pagination="true">
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
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_retur">
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
                                        <!-- <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
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
                                        </div> -->
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
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    No. Retur :
                                </label>
                                <div class="col-lg-6 col-sm-12" style="padding-left: 0px;">
                                    <input id="txt-no_retur" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-6 col-sm-12" style="padding-left: 0px;">
                                    <input class="form-control form-control-sm" type="date-only-formatted" id="dtb-tgl_retur">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    No. Billing :
                                </label>
                                <div class="col-lg-5 col-sm-12" style="padding-left: 0px;">
                                    <input id="txt-no_billing" class="form-control form-control-sm" type="number" onkeydown="cari_billing(this)">
                                    <!-- <input id="src-no_billing" data-options="prompt:'Cari No Billing...'" class="easyui-searchbox form-control form-control-sm" style="width: 100%;"> -->
                                </div>
                                <div class="col-lg-1 col-sm-12" style="padding-left: 0px;">
                                    <button id="btn-no_billing" type="button" class="form-control-sm btn btn-primary kt-search-custom" style="width: 37px;">
                                        <i class="fas fa-search" style="padding-right: 0px; margin-left: -2px;"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    No. Resep :
                                </label>
                                <div class="col-lg-6 col-sm-12" style="padding-left: 0px;">
                                    <input id="txt-no_resep" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div> -->
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    No. RM :
                                </label>
                                <div class="col-lg-3 col-sm-12" style="padding-right: 0px;">
                                    <input id="txt-no_rm" class="form-control form-control-sm" type="text" disabled="true">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px; padding-left: 20px;">
                                    Umur/J. Kel :
                                </label>
                                <div class="col-lg-3 col-sm-12" style="padding-right: 0px;">
                                    <input id="txt-umur" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                                <div class="col-lg-1 col-sm-12" style="padding-left: 5px; padding-right: 3px;">
                                    <input id="txt-kelamin" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Nama Pasien :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 3px;">
                                    <input id="txt-nama_pasien" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Status Pasien :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 3px;">
                                    <input id="txt-status_pasien" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Jenis Pasien :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 3px;">
                                    <input id="txt-jenis_pasien" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div> -->
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 30px;padding-right: 1px;">
                                    Klinik/Ruang :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 10px;">
                                    <select name="cmb-klinik_ruang" id="cmb-klinik_ruang" class="select2 form-control form-control-sm" disabled="true">
                                        <!--  -->
                                    </select>
                                </div>
                                <!-- <div class="col-lg-1 col-sm-12">
                                    <button id="btn-klinik_ruang" type="button" class="form-control-sm btn btn-primary kt-search-custom" style="">
                                        <i class="fas fa-search" style="padding-right: 0rem;"></i>
                                    </button>
                                </div> -->
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 30px;padding-right: 1px;">
                                    Dokter :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 10px;">
                                    <select name="cmb-dokter" id="cmb-dokter" class="select2 form-control form-control-sm" disabled="true">
                                        <!--  -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 30px; padding-right: 1px;">
                                    Kelas :
                                </label>
                                <div class="col-lg-3 col-sm-12" style="padding-right: 0px;">
                                    <input id="txt-kelas" class="form-control form-control-sm" type="text" disabled="true">
                                </div>

                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;padding-left: 30px;">
                                    Jatah Kelas :
                                </label>
                                <div class="col-lg-3 col-sm-12" style="padding-left: 0px; padding-right: 10px;">
                                    <input id="txt-jatah_kelas" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 30px;padding-right: 1px;">
                                    Status Kelas :
                                </label>
                                <label id="label-status_kelas" class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm kt-font-bold" style="color: red;">
                                    Naik Kelas
                                </label>
                            </div> -->
                        </div>
                    </div>
                    <div class="row div_hidden" hidden="true">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-lg-3 col-sm-12">
                                    <input id="txt-id_mrs" class="form-control form-control-sm" type="text">
                                    <input id="txt-id_mr" class="form-control form-control-sm" type="text">
                                    <input id="txt-no_mr" class="form-control form-control-sm" type="text">
                                    <input id="dtb-tgl_mrs" class="form-control form-control-sm" type="date-only-formatted">
                                    <input id="dtb-tgl_lahir" class="form-control form-control-sm" type="date-only-formatted">
                                    <input id="txt-ri_rj" class="form-control form-control-sm" type="text">
                                    <input id="txt-nama_unit" class="form-control form-control-sm" type="text">
                                    <input id="txt-nama_kamar" class="form-control form-control-sm" type="text">
                                    <input id="txt-id_unit_depo" class="form-control form-control-sm" type="text">
                                    <input id="txt-id_reg_unit" class="form-control form-control-sm" type="text">
                                    <input id="txt-asuransi" class="form-control form-control-sm" type="text">
                                    <input id="txt-instansi" class="form-control form-control-sm" type="text">
                                    <input id="txt-admission" class="form-control form-control-sm" type="text">
                                    <input id="txt-jns_bayar" class="form-control form-control-sm" type="text">
                                    <input id="txt-status_pulang" class="form-control form-control-sm" type="text">
                                    <input id="txt-id_eresep" class="form-control form-control-sm" type="text">
                                    <input id="txt-alamat" class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail_item" height="350" width="100%" title="Detail Item" class="easyui-datagrid" toolbar="#toolbar" pagination="false" rownumbers="true" showfooter="true">
                                
                            </table>
                            <div id="toolbar">
                                <a href="javascript:void(0)" id="btn-tambah_detail" class="easyui-linkbutton" plain="true">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                                <a href="javascript:void(0)" id="btn-ubah_detail" class="easyui-linkbutton" plain="true">
                                    <i class="flaticon-edit-1"></i>
                                    Ubah
                                </a>
                                <a href="javascript:void(0)" id="btn-hapus_detail" class="easyui-linkbutton" plain="true" onclick="btn_hapus_det()">
                                    <i class="flaticon2-trash"></i>
                                    Hapus
                                </a>
                                <a href="javascript:void(0)" id="btn-simpan_detail" class="easyui-linkbutton" plain="true">
                                    <i class="la la-save"></i>
                                    Simpan
                                </a>
                                <a href="javascript:void(0)" id="btn-batal_detail" class="easyui-linkbutton" plain="true">
                                    <i class="flaticon2-cross"></i>
                                    Batal
                                </a>
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
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm kt-font-bold" style="padding-right: 0px;">
                                    <b>Total :</b>
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input id="nmb-total" class="col-lg-10 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                    <input id="nmb-total_hpp" class="col-lg-10 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="hidden" readonly="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 0px; margin-top: 10px; margin-bottom: 15px;">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-3 col-sm-12 kt-padding div_simpan">
                                    <button onclick="simpan()" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                        <i class="la la-save"></i>
                                        Simpan
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 kt-padding">
                                    <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tab(0)">
                                        <i class="la la-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 kt-padding">
                                    <button id="btn-cetak" type="button" class="form-control form-control-sm btn-sm btn btn-secondary kt-font-sm" onclick="cetak(0)">
                                        <i class="la la-print"></i>
                                        Cetak
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 kt-padding" style="padding-right: 15px">
                                    <button id="btn-hapus" type="button" class="form-control form-control-sm btn-sm btn btn-danger kt-font-sm" onclick="hapus()">
                                        <i class="la la-trash"></i>
                                        Hapus
                                    </button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12" id="div_cetak" style="padding: 2px">
                                    <!-- <button id="btn-cetak" onclick="cetak();" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
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

    <div id="win-cari_no_billing" class="panel-window" data-title="Pencarian No. Billing" style="width: 95%; height: 85%">
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
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_billing" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button id="btn_filter_billing" type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter_billing()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-billing" height="400" width="100%" class="easyui-datagrid" pagination="true" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="id_mrs" width="10%">No. Billing</th>
                                        <th halign="center" align="left" field="no_mr" width="10%">No. RM</th>
                                        <th halign="center" align="left" field="nama_lengkap" width="25%">Nama Pasien</th>
                                        <th halign="center" align="center" field="sex" width="8%">Jenis Kelamin</th>
                                        <th halign="center" align="center" field="tgl_mrs" width="8%" data-options="formatter:appGridDateFormatter">Tgl. MRS</th>
                                        <th halign="center" align="left" field="ri_rj" width="10%">Jns. Rawat</th>
                                        <th halign="center" align="left" field="nama_unit" width="15%">Unit</th>
                                        <th halign="center" align="left" field="nama_kamar" width="10%">Kamar</th>
                                        <th halign="center" align="left" field="kelas" width="8%">Kelas</th>
                                        <th halign="center" align="center" field="asuransi" width="8%">Asuransi</th>
                                        <th halign="center" align="left" field="instansi" width="13%">Instansi</th>
                                        <th halign="center" align="left" field="admission" width="10%">Admision</th>
                                        <th halign="center" align="left" field="nama_dokter" width="25%">Dokter</th>

                                        <th field="id_mr" hidden="true"></th>
                                        <th field="tgl_lahir" hidden="true" data-options="formatter:appGridDateFormatter"></th>
                                        <th field="id_reg_unit" hidden="true"></th>
                                        <th field="kelas_hak" hidden="true"></th>
                                        <th field="kelas_status" hidden="true"></th>
                                        <th field="status_karyawan" hidden="true"></th>
                                        <th field="jns_bayar" hidden="true"></th>
                                        <th field="id_dokter" hidden="true"></th>
                                        <th field="status_pulang" hidden="true"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 10px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_billing" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_billing()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_billing" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tutup()">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-tambah_detail" class="panel-window" data-title="Pencarian Item Retur" style="width: 70%; height: 85%">
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
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_detail" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button id="btn_filter_item" type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter_item()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-item_retur" height="400" width="100%" class="easyui-datagrid" pagination="true" singleSelect="true" rownumbers="true">
<!--                                 <thead>
                                    <tr>
                                        <th halign="center" align="left" field="no_nota" width="12%">No. Nota</th>
                                        <th halign="center" align="center" field="tgl_nota" width="10%" data-options="formatter:appGridDateFormatter">Tgl. Nota</th>
                                        <th halign="center" align="left" field="kd_item" width="12%">Kode</th>
                                        <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                        <th halign="center" align="center" field="sex" width="12%">Satuan</th>
                                        <th halign="center" align="right" field="jml" width="13%" data-options="formatter:appGridNumberFormatter">Jumlah</th>
                                        <th halign="center" align="right" field="ri_r" width="13%" data-options="formatter:appGridNumberFormatter">Jml. Retur</th>
                                        <th halign="center" align="right" field="ri_" width="13%">Aksi</th>
                                    </tr>
                                </thead> -->
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 10px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_item" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_item()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_billing" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tutup()">
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