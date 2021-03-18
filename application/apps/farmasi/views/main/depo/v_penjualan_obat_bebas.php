<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Penjualan Obat Bebas</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pelayanan Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Penjualan Obat Bebas</a>
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
                    <table id="dtg-penjualan_obat_bebas" height="500" width="100%" title="Daftar Penjualan Obat Bebas" class="easyui-datagrid" rownumbers="true" pagination="true">
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
                                    <input class="form-control form-control-sm" type="date-only-formatted" id="dtb-tgl_nota">
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
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 0px; padding-left: 1px;">
                                    Jenis :
                                </label>
                                <div class="col-lg-4 col-sm-12" style="padding-right: 0px;">
                                    <select name="cmb-jenis" id="cmb-jenis" class="form-control form-control-sm">
                                        <option value="1">Umum</option>
                                        <option value="2">Karyawan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 0px; padding-left: 1px;">
                                    Nama Karyawan :
                                </label>
                                <div class="col-lg-8 col-sm-12">
                                    <input id="txt-nama_karyawan" placeholder="Cari nama karyawan" class="form-control form-control-sm" style="width: 100%;" readonly="true">
                                    <input type="hidden" name="" id="src-karyawan">
                                </div>
                                <div class="col-lg-1 col-sm-12">
                                    <button id="btn-cari_karyawan" type="button" class="form-control-sm btn btn-primary kt-search-custom" style="">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 0px; padding-left: 1px;">
                                    NIK :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 3px;">
                                    <input id="txt-nik" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 25px;padding-right: 1px;">
                                    Dokter :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 10px;">
                                    <select name="cmb-dokter" id="cmb-dokter" class="select2 form-control form-control-sm">
                                        <!--  -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 25px;padding-right: 1px;">
                                    Nama :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 10px;">
                                    <input id="txt-nama" class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 25px;padding-right: 1px;">
                                    Alamat :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 10px;">
                                    <input id="txt-alamat" class="form-control form-control-sm" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail_item" height="300" width="100%" title="Detail Item" class="easyui-datagrid" toolbar="#toolbar" pagination="false" rownumbers="true">
                                
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
                                <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton" plain="true">
                                    <i class="flaticon2-trash"></i>
                                    Hapus
                                </a>
                                <a href="javascript:void(0)" id="btn-tampil" class="easyui-linkbutton" plain="true">
                                    <i class="la la-save"></i>
                                    Simpan
                                </a>
                                <a href="javascript:void(0)" id="btn-tampil" class="easyui-linkbutton" plain="true">
                                    <i class="la la-times"></i>
                                    Batal
                                </a>
                                <select class="form-control-sm" id="cmb-ambil_sebagian" panelHeight="auto" style="width:10%;padding-left: 8px;padding-right: 5px;">
                                    <option selected>Ambil Sebagian</option>
                                    <option value="1">1/2</option>
                                    <option value="2">1/3</option>
                                    <option value="3">1/4</option>
                                </select>
                                <!-- <a href="javascript:void(0)" id="btn-ambil_sebagian" class="easyui-dropdown" plain="true">
                                    <i class="la la-file"></i>
                                    Ambil Sebagian
                                </a> -->
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
                                    <textarea class="form-control form-control-sm kt-font-sm" style="resize: none; height: 130px;" id="txt-keterangan"></textarea>
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
                                    <input id="nmb-jrs_paket" class="col-lg-10 form-control form-control-sm easyui-numberbox change" style="text-align: right;" type="text">
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
                                    <button id="btn-cetak" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
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

    <div id="win-karyawan" class="panel-window" data-title="Pencarian Karyawan" style="width: 40%; height: 85%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Kriteria :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" id="txt-kriteria_billing" placeholder="Cari...">
                                </div>
                                <div class="col-lg-auto col-sm-12 kt-margin-t-20-mobile">
                                    <button id="btn_filter_billing" type="button" class="easyui-linkbutton btn-primary" plain="true" onclick="">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-karyawan" height="390" width="100%" class="easyui-datagrid" pagination="true" singleSelect="true" rownumbers="true">
                                <thead>
                                    <tr>
                                        <th halign="center" align="left" field="id_mrs" width="60%">Nama Karyawan</th>
                                        <th halign="center" align="left" field="no_mr" width="40%">NIK</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 15px; margin-left: 8px;">
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_karyawan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="">
                                <i class="la la-check"></i>
                                Pilih
                            </button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 kt-padding">
                            <button class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tutup()">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="win-cetak" class="panel-window" data-title="Cetak Nota Transaksi" style="width: 30%; height: 37%">
        <div class="kt-portlet-win" style="margin-top: 0px;">
            <div class="kt-portlet__body header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-lg-12 kt-line-header">
                            <div class="col-form-label col-lg-auto col-sm-12 form-control-sm kt-font-bold" id="txt-label_nota" style="text-align: center;">
                                No. Nota : 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 kt-line-header" style="margin-bottom: 10px;">
                            <div class="col-lg-auto col-sm-12 form-control-sm" style="text-align: center;">
                                Silahkan Pilih Menu Cetak.
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding" style="margin-left: 15px;">
                                    <button id="btn-cetak_nota" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="">
                                        <i class="la la-print"></i>
                                        Nota
                                    </button>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                                    <button id="btn-cetak_tiket" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="">
                                        <i class="la la-print"></i>
                                        E-Tiket
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
                <div class="col-lg-10" style="margin-top: 15px; margin-left: 14px;">
                    <div class="form-group row">
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