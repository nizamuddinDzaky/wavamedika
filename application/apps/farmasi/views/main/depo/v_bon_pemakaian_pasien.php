<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container" style="padding-right: 1px;">
        <div class="row col-lg-12 justify-content-between">
            <div class="col-lg-auto">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Bon Pemakaian Pasien</h3>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home">
                            <i class="flaticon2-shelter"></i>
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Pelayanan Farmasi</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Bon Pemakaian Pasien</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="kt-subheader__main" style="margin-left: 21%;">
                    <h3 class="kt-subheader__title" id="label-unit" onclick="buka_unit(1)" align="right">
                        <!-- Farmasi Rawat Jalan -->
                    </h3>
                </div>
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
                                        <option value="1">Proses</option>
                                        <option value="2">Selesai</option>
                                        <option value="3">Diserahkan</option>
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
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria" placeholder="Cari..." required>
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
                                        Tambah Nota Penjualan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-nota_rawat_jalan" height="500" width="100%" title="Daftar Nota Farmasi Rawat Jalan" class="easyui-datagrid" rownumbers="true" pagination="true">
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
                                    No. Nota : 
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
                                    No. Nota :
                                </label>
                                <div class="col-lg-6 col-sm-12" style="padding-left: 0px;">
                                    <input id="txt-no_nota" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-6 col-sm-12" style="padding-left: 0px;">
                                    <input class="form-control form-control-sm" type="date-time-formatted" id="dtb-tgl_nota">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    No. Billing :
                                </label>
                                <div class="col-lg-5 col-sm-12" style="padding-left: 0px;">
                                    <input id="txt-no_billing" class="form-control form-control-sm" type="number">
                                    <!-- <input id="src-no_billing" data-options="prompt:'Cari No Billing...'" class="easyui-searchbox form-control form-control-sm" style="width: 100%;"> -->
                                </div>
                                <div class="col-lg-1 col-sm-12" style="padding-left: 0px;">
                                    <button id="btn-no_billing" type="button" class="form-control-sm btn btn-primary kt-search-custom" style="width: 37px;">
                                        <i class="fas fa-search"  style="padding-right: 0px; margin-left: -2px;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    No. Resep :
                                </label>
                                <div class="col-lg-6 col-sm-12" style="padding-left: 0px;">
                                    <input id="txt-no_resep" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
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
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Jenis Pasien :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 3px;">
                                    <input id="txt-jenis_pasien" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 30px;padding-right: 1px;">
                                    Klinik/Ruang :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 10px;">
                                    <select name="cmb-klinik_ruang" id="cmb-klinik_ruang" class="select2 form-control form-control-sm">
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
                                    <select name="cmb-dokter" id="cmb-dokter" class="select2 form-control form-control-sm">
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
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 30px;padding-right: 1px;">
                                    Status Kelas :
                                </label>
                                <label id="label-status_kelas" class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm kt-font-bold" style="color: red;">
                                    Naik Kelas
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row div_hidden">
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

                                    <input id="nmb-subtotal_paket" class="form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                    <input id="nmb-subtotal_npaket" class="form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                    <input id="nmb-ppn_paket" class="form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                    <input id="nmb-ppn_npaket" class="form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                    <input id="nmb-jrs_paket" class="form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                    <input id="nmb-jrs_npaket" class="form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                    <input id="nmb-total_paket" class="form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                    <input id="nmb-total_npaket" class="form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail_item" height="300" width="100%" title="Detail Item" class="easyui-datagrid" toolbar="#toolbar" pagination="false" rownumbers="true" showfooter="true">
                                
                            </table>
                            <div id="toolbar">
                                <a href="javascript:void(0)" id="btn-tambah_detail_item" class="easyui-linkbutton" plain="true" onclick="tambah_detail()">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                                <a href="javascript:void(0)" id="btn-e_resep" class="easyui-linkbutton" plain="true">
                                    <i class="la la-file"></i>
                                    E-Resep
                                </a>
                                <a href="javascript:void(0)" id="btn-paket_obat_alkes" class="easyui-linkbutton" plain="true">
                                    <i class="la la-file"></i>
                                    Paket Obat Alkes
                                </a>
                                <!-- <select class="form-control-sm" id="cmb-ambil_sebagian" panelHeight="auto" style="width:10%;padding-left: 8px;padding-right: 5px;">
                                    <option value="0" selected>Ambil Sebagian</option>
                                    <option value="12">1/2</option>
                                    <option value="13">1/3</option>
                                    <option value="14">1/4</option>
                                </select> -->
                                <div class="dropdown" id="div_ambil_sebagian">
                                    <span style="margin-top: 10px">Ambil Sebagian</span>
                                    <div class="dropdown-content">
                                        <!-- <a href="#" onclick="ambil_sebagian(1)"> Reset</a> -->
                                        <a href="#" onclick="ambil_sebagian(12)"> > 1/2</a>
                                        <a href="#" onclick="ambil_sebagian(13)"> > 1/3</a>
                                        <a href="#" onclick="ambil_sebagian(14)"> > 1/4</a>
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
                        <div class="col-lg-5" style="margin-top: 5px;">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Sub Total :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                   <input id="nmb-subtotal" class="col-lg-10 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                                    PPN :
                                </label>
                                <div class="col-lg-5 col-sm-12" style="margin-left: 2%; padding-left: 2px; padding-right: 0px;">
                                    <input id="nmb-persen" class="easyui-numberbox change" style="width: 25px; height: 29px; text-align: right;"> %
                                    <input id="nmb-ppn" class="form-control form-control-sm easyui-numberbox" style="width: 150px; text-align: right;" type="text" readonly="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                                    J. Resep :
                                </label>
                                <div class="col-lg-4 col-sm-12" style="padding-left: 10px; padding-right: 0px;">
                                    <input id="nmb-jrs" class="col-lg-10 form-control form-control-sm easyui-numberbox change" style="text-align: right;" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm kt-font-bold">
                                    Total :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="nmb-total" class="col-lg-10 form-control form-control-sm easyui-numberbox" style="text-align: right;" type="text" readonly="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 0px; margin-top: 10px; margin-bottom: 15px;">
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-12 kt-padding div_simpan">
                                    <button onclick="simpan()" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                        <i class="la la-save"></i>
                                        Simpan
                                    </button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                                    <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tab(0)">
                                        <i class="la la-times"></i>
                                        Batal
                                    </button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 kt-padding" style="padding-right: 15px">
                                    <button id="btn-hapus" type="button" class="form-control form-control-sm btn-sm btn btn-danger kt-font-sm" onclick="hapus()">
                                        <i class="la la-trash"></i>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 2px; margin-top: 1px">
                                    <div class="dropdown">
                                        <button class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="la la-print"></i>
                                            Cetak
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">BPJS</a>
                                            <a class="dropdown-item" href="#">Asuransi</a>
                                            <a class="dropdown-item" href="#">Regular</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12" style="padding: 2px; margin-top: 1px">
                                    <button id="btn-cetak_etiket" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                        <i class="la la-print"></i>
                                        Cetak E-Resep
                                    </button>
                                </div>
                                <div class="col-lg-5 col-md-4 col-sm-12" style="padding: 2px; margin-top: 1px">
                                    <div class="dropdown">
                                        <button class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="la la-print"></i>
                                            Cetak E-Tiket UDD
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">PAGI</a>
                                            <a class="dropdown-item" href="#">SIANG</a>
                                            <a class="dropdown-item" href="#">SORE</a>
                                            <a class="dropdown-item" href="#">MALAM</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="win-cari_no_billing" class="panel-window" data-title="Pencarian No. Billing" style="width: 95%; height: 80%">
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
                                        <th halign="center" align="left" field="nama_lengkap" width="30%">Nama Pasien</th>
                                        <th halign="center" align="center" field="sex" width="2%">Jenis Kelamin</th>
                                        <th halign="center" align="center" field="tgl_mrs" width="10%" data-options="formatter:appGridDateFormatter">Tgl. MRS</th>
                                        <th halign="center" align="left" field="ri_rj" width="10%">Jns. Rawat</th>
                                        <th halign="center" align="left" field="nama_unit" width="15%">Unit</th>
                                        <th halign="center" align="left" field="nama_kamar" width="10%">Kamar</th>
                                        <th halign="center" align="left" field="kelas" width="10%">Kelas</th>
                                        <th halign="center" align="left" field="asuransi" width="10%">Asuransi</th>
                                        <th halign="center" align="left" field="instansi" width="10%">Instansi</th>
                                        <th halign="center" align="left" field="admission" width="10%">Admision</th>
                                        <th halign="center" align="left" field="nama_dokter" width="30%">Dokter</th>

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

    <div id="win-e_resep" class="panel-window" data-title="E-Resep" style="width: 55%; height: 85%">
        <div class="kt-portlet-win" style="margin-top: 0px;">
            <div class="kt-portlet__body header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-e_resep" height="180" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="false" fitColumns="false">
                                <thead>
                                    <tr>
                                        <th halign="center" align="center" field="id_eresep" width="10%">ID Resep</th>
                                        <th halign="center" align="center" field="tgl_input" width="10%" data-options="formatter:appGridDateFormatter">Tanggal</th>
                                        <th halign="center" align="left" field="nama_unit" width="20%">Klinik/Ruang</th>
                                        <th halign="center" align="left" field="nama_kamar" width="20%">Kamar</th>
                                        <th halign="center" align="left" field="nama_dokter" width="40%">Dokter</th>

                                        <th field="id_kamar" hidden="true"></th>
                                        <th field="id_unit" hidden="true"></th>
                                        <th field="kamar_display" hidden="true"></th>
                                        <th field="id_dokter" hidden="true"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-e_resep_detail" height="230" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true" fitColumns="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="center" field="nr" width="3%">NR</th>
                                        <th halign="center" align="center" field="nama_obat" width="30%">Obat/Alkes</th>
                                        <th halign="center" align="left" field="aturan" width="22%">Aturan Pakai</th>
                                        <th halign="center" align="left" field="aturan_buat" width="22%">Aturan Buat</th>
                                        <th halign="center" align="left" field="qty" width="13%">Jumlah</th>

                                        <th field="id_eresep_det" hidden="true"></th>
                                        <th field="id_item" hidden="true"></th>
                                        <th field="kd_item" hidden="true"></th>
                                        <th field="qty_sisa" hidden="true"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_eresep" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_eresep()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_eresep" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tutup()">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-paket_obat_alkes" class="panel-window" data-title="Paket Obat/Alkes" style="width: 80%; height: 80%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_paket" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button id="btn-filter_paket" type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter_paket('master','')">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-lg-4 table-detail" style="padding-right: 0px;">
                            <table id="dtg-paket_master" height="340" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true" fitColumns="true">
                                <thead>
                                    <tr>
                                        <th field="id_paket_item" hidden="true"></th>
                                        <th halign="center" align="left" field="nama_paket_item" width="100%">Nama Paket</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-lg-8 table-detail" style="padding-left: 0px;">
                            <table id="dtg-paket_detail" height="340" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true" fitColumns="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="center" field="nama_item" width="30%">Obat/Alkes</th>
                                        <th halign="center" align="left" field="qty" width="13%">Jml</th>
                                        <th halign="center" align="left" field="stok" width="22%">Stok</th>
                                        <th halign="center" align="left" field="signa1" width="17%">Signa 1</th>
                                        <th halign="center" align="left" field="signa2" width="17%">Signa 2</th>

                                        <th field="id_item" hidden="true"></th>
                                        <th field="kd_item" hidden="true"></th>
                                        <th field="id_kel_item" hidden="true"></th>
                                        <th field="id_satuan" hidden="true"></th>
                                        <th field="is_for_rs" hidden="true"></th>
                                        <th field="is_for_nas" hidden="true"></th>
                                        <th field="harga_jual" hidden="true"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 10px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_paket" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_paket()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-batal_paket" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tutup()">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-unit" class="panel-window" data-title="Pilih Unit" style="width: 40%; height: 55%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row" style="margin-top: 0;">
                        <div class="col-lg-12 table-detail" style="padding-right: 0px;">
                            <table id="dtg-unit" height="230" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true" fitColumns="true">
                                <thead>
                                    <tr>
                                        <th field="id_unit" hidden="true"></th>
                                        <th halign="center" align="left" field="nama_unit" width="100%">Nama Unit</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-auto col-md-auto col-sm-12 kt-padding">
                            <button id="btn-pilih_unit" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_unit()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-12 kt-padding">
                            <button id="btn-batal_unit" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="buka_unit(0)">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-cari_item" class="panel-window" data-title="Cari Item Obat/Alkes" style="width: 40%; height: 55%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <!-- <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_item" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button id="btn-filter_item" type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="filter_item_kriteria()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="row" style="margin-top: 0;">
                        <div class="col-lg-12 table-detail" style="padding-right: 0px;">
                            <table id="dtg-item" height="230" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true" fitColumns="true">
                                <thead>
                                    <tr>
                                        <th field="id_item" hidden="true"></th>
                                        <th halign="center" align="left" field="nama_item" width="20%">Nama Item</th>
                                        <th halign="center" align="left" field="kd_item" width="80%">kode Item</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-auto col-md-auto col-sm-12 kt-padding">
                            <button id="btn-pilih_unit" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_item()">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-12 kt-padding">
                            <button id="btn-batal_unit" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tutup_item()">
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