<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container" style="padding-right: 1px;">
        <div class="row col-lg-12 justify-content-between">
            <div class="col-lg-auto">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Pemakaian Gas Medik</h3>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home">
                            <i class="flaticon2-shelter"></i>
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Pemakaian Gas Medik</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-auto justify-content-end">
                <div class="kt-subheader__main" style="margin-top: 2%;">
                    <h3  id="nama_depo"class="kt-subheader__title" > Depo </h3>
                    <input type="hidden" name="" id="txt-id-depo">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="form_file_surat_detail" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <iframe id="frame_file_surat_detail" name="frame_file_surat_detail" width="100%" height ="850px"></iframe>
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
                        <div class="col-lg-9">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Ruang :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-ruang">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Kriteria :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-margin-t-10-mobile">
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
                            <!-- <div class="form-group row">
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah();">
                                        <i class="la la-plus"></i>
                                        Tambah Nota Penjualan
                                    </button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-pemakaian_gas_medik" height="500" width="100%" title="Daftar Pemakaian Gas Medik" class="easyui-datagrid" rownumbers="true" pagination="true">
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
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_pasien">
                                    
                                </label>
                                <div style="border-left: 1px black solid; height: 12px; width: 5px; margin-top: 10px">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_norm"> 
                                </label>
                                <div style="border-left: 1px black solid; height: 12px; width: 5px; margin-top: 10px">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_billing">
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
                                        <!-- <div style="padding: 2px" class="col-lg-auto div_simpan">
                                            <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="simpan()">
                                                <i class="la la-save"></i>
                                                Simpan
                                            </button>
                                        </div>  --> 
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    No. Billing :
                                </label>
                                <div class="col-lg-3 col-sm-12" style="padding-right: 0px;">
                                    <input id="txt-no_billing" class="form-control form-control-sm" type="text" disabled="true">
                                </div>

                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px; padding-left: 20px;">
                                    Tgl. MRS :
                                </label>
                                <div class="col-lg-4 col-sm-12" style="padding-right: 3px;">
                                    <input id="txt-tgl_mrs" class="form-control form-control-sm" type="date-only-formatted" disabled="true">
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
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    Jenis Pasien :
                                </label>
                                <div class="col-lg-8 col-sm-12" style="padding-right: 3px;">
                                    <input id="txt-Jenis_pasien" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    Status Pasien :
                                </label>
                                <div class="col-lg-8 col-sm-12" style="padding-right: 3px;">
                                    <input id="txt-status_pasien" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 3px;">
                                    Dokter :
                                </label>
                                <div class="col-lg-8 col-sm-12" style="padding-right: 3px;">
                                    <input id="txt-dokter" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 30px;padding-right: 1px;">
                                    Klinik/Ruang :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-right: 10px;">
                                    <input id="txt-klinik_ruang" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                                <!-- <div class="col-lg-1 col-sm-12">
                                    <button id="btn-klinik_ruang" type="button" class="form-control-sm btn btn-primary kt-search-custom" style="">
                                        <i class="fas fa-search" style="padding-right: 0rem;"></i>
                                    </button>
                                </div> -->
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
                    <div class="row" style="margin-top: 10px; margin-bottom: 20px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail_item" height="400" width="100%" title="Detail Item" class="easyui-datagrid" toolbar="#toolbar" pagination="false" rownumbers="true">
                                <!--  -->
                            </table>
                            <div id="toolbar">
                                <a href="javascript:void(0)" id="btn-tambah_oksigen" class="easyui-linkbutton" plain="true">
                                    <i class="la la-plus"></i>
                                    Oksigen
                                </a>
                                <a href="javascript:void(0)" id="btn-tambah_nitrogen" class="easyui-linkbutton" plain="true">
                                    <i class="la la-plus"></i>
                                    Nitrogen
                                </a>
                                <a href="javascript:void(0)" id="btn-ubah_detail" class="easyui-linkbutton" plain="true">
                                    <i class="flaticon-edit-1"></i>
                                    Ubah
                                </a>
                                <a href="javascript:void(0)" id="btn-hapus_detail" class="easyui-linkbutton" plain="true">
                                    <i class="flaticon2-trash"></i>
                                    Hapus
                                </a>
                                <a href="javascript:void(0)" id="btn-cetak_detail" class="easyui-linkbutton" plain="true">
                                    <i class="la la-print"></i>
                                    Cetak
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="win-oksigen" class="panel-window" data-title="Tambah Pemakaian Oksigen" style="width: 63%; height: 95%">
        <div class="kt-portlet">
            <div class="kt-portlet__body header-form" style="padding-top: 1px; padding-bottom: 1px; padding-left: 10px; padding-right: 10px;">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-12 kt-line-header" style="font-size: 21px; font-weight: bold; text-align: center;">
                            TAMBAH PEMAKAIAN OKSIGEN
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 8px;">
                        <div class="col-lg-12">
                            <div class="form-group row kt-line-header" id="win-div_status">
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_pasien_oksigen">
                                </label>
                                <div class="kt-break">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_norm_oksigen">
                                </label>
                                <div class="kt-break">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_billing_oksigen">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    No. Nota :
                                </label>
                                <div class="col-lg-8 col-sm-12" style="padding-right: 30px;">
                                    <input id="txt-no_nota_oksigen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Nota :
                                </label>
                                <div class="col-lg-8 col-sm-12" style="padding-right: 30px;">
                                    <input id="txt-tgl_nota_oksigen" class="form-control form-control-sm" type="date-only-formatted">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                                    Klinik/Ruang :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <select id="cmb-klinik_ruang_oksigen" class="select2 form-control form-control-sm" name="cmb-klinik_ruang_oksigen">
                                        <!--  -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Dokter :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <select id="cmb-dokter_oksigen" class="select2 form-control form-control-sm" name="cmb-dokter_oksigen">
                                        <!--  -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="background-color: #0F9E98">
                            <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-bold" align="left" style="margin-top: 5px; padding-left: 0px; color: white;">
                                Detail Pemakaian Oksigen
                            </label>
                        </div>
                    </div>
                    <div class="row kt-border">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-bold" align="left" style="text-decoration-line: underline;">
                                    Data Item Oksigen
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row kt-border">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Kode Item :
                                </label>
                                <div class="col-lg-5 col-sm-12 padding-left" style="padding-right: 30px;">
                                    <input id="txt-kode_item_oksigen" class="form-control form-control-sm" type="text" disabled="true">
                                    <input id="txt-id_item_oksigen" class="form-control form-control-sm" type="text" hidden>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                                    Nama Item :
                                </label>
                                <div class="col-lg-9 col-sm-12 padding-left">
                                    <input id="txt-nama_item_oksigen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                                    
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 27px; padding-right: 1px;">
                                    Satuan :
                                </label>
                                <div class="col-lg-6 col-sm-12 padding-right">
                                    <input id="txt-id_satuan_oksigen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kt-border">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-bold" align="left" style="text-decoration-line: underline;">
                                    Waktu dan Lama Pemakaian
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Awal :
                                </label>
                                <div class="col-lg-4 col-sm-12 padding-left">
                                    <input id="dtb-tgl_awal_oksigen" class="form-control form-control-sm easyui-datetimebox" showSeconds="false" style="width: 131px;">
                                </div>

                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 0px; padding-right: 0px;">
                                    Akhir :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="dtb-tgl_akhir_oksigen" class="form-control form-control-sm easyui-datetimebox" showSeconds='false' style="width: 137px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Lama (Jam) :
                                </label>
                                <div class="col-lg-4 col-sm-12 padding-left">
                                    <input id="txt-lama_jam_oksigen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>

                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 0px; padding-right: 0px;">
                                    Menit :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="txt-menit_oksigen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Skala :
                                </label>
                                <div class="col-lg-4 col-sm-12 padding-left">
                                    <input id="skala_oksigen" class="form-control form-control-sm" type="number" min="1" max="15">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-bold" align="left" style="text-decoration-line: underline; padding-left: 27px;">
                                    Jumlah Pemakaian
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 27px; padding-right: 1px;">
                                    Pemakaian :
                                </label>
                                <div class="col-lg-6 col-sm-12 padding-right">
                                    <input id="txt-pemakaian_oksigen" class="form-control form-control-sm" type="text" disabled="true" style="text-align: right;">
                                </div>
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 0px;">
                                    Liter
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 27px; padding-right: 1px;">
                                    Harga :
                                </label>
                                <div class="col-lg-6 col-sm-12 padding-right">
                                    <input id="txt-harga_oksigen" class="form-control form-control-sm easyui-numberbox" type="text" disabled="true" style="text-align: right; width: 148px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm kt-font-bold" style="padding-left: 27px; padding-right: 1px;">
                                    Total :
                                </label>
                                <div class="col-lg-6 col-sm-12 padding-right">
                                    <input id="txt-total_oksigen" class="form-control form-control-sm easyui-numberbox" type="text" disabled="true" style="text-align: right; width: 148px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kt-border" style="border-bottom: 2px solid #0F9E98;">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Keterangan :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-left: 0px; padding-right: 0px; margin-bottom: 10px;">
                                    <textarea id="txt-keterangan_oksigen" class="form-control form-control-sm " style="resize: none; height: 52px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 9px; margin-left: -2px;">
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-pilih_oksigen" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan(1)">
                                <i class="la la-save"></i>
                                Simpan
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

    <div id="win-nitrogen" class="panel-window" data-title="Tambah Pemakaian Nitrogen" style="width: 63%; height: 95%">
        <div class="kt-portlet">
            <div class="kt-portlet__body header-form" style="padding-top: 1px; padding-bottom: 1px; padding-left: 10px; padding-right: 10px;">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-lg-12 kt-line-header" style="font-size: 21px; font-weight: bold; text-align: center;">
                            TAMBAH PEMAKAIAN NITROGEN
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 8px;">
                        <div class="col-lg-12">
                            <div class="form-group row kt-line-header" id="win-div_status">
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_pasien_nitrogen">
                                </label>
                                <div class="kt-break">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_norm_nitrogen">
                                </label>
                                <div class="kt-break">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm kt-font" id="txt-label_billing_nitrogen">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    No. Nota :
                                </label>
                                <div class="col-lg-8 col-sm-12" style="padding-right: 30px;">
                                    <input id="txt-no_nota_nitrogen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Nota :
                                </label>
                                <div class="col-lg-8 col-sm-12" style="padding-right: 30px;">
                                    <input id="txt-tgl_nota_nitrogen" class="form-control form-control-sm" type="date-only-formatted">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                                    Klinik/Ruang :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <select id="cmb-klinik_ruang_nitrogen" class="select2 form-control form-control-sm" name="cmb-klinik_ruang_nitrogen">
                                        <!--  -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Dokter :
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    <select id="cmb-dokter_nitrogen" class="select2 form-control form-control-sm" name="cmb-dokter_nitrogen">
                                        <!--  -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" style="background-color: #0F9E98">
                            <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-bold" align="left" style="margin-top: 5px; padding-left: 0px; color: white;">
                                Detail Pemakaian Nitrogen
                            </label>
                        </div>
                    </div>
                    <div class="row kt-border">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-bold" align="left" style="text-decoration-line: underline;">
                                    Data Item Nitrogen
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row kt-border">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Kode Item :
                                </label>
                                <div class="col-lg-5 col-sm-12 padding-left" style="padding-right: 30px;">
                                    <input id="txt-kode_item_nitrogen" class="form-control form-control-sm" type="text" disabled="true">
                                    <input id="txt-id_item_nitrogen" class="form-control form-control-sm" type="text" hidden>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                                    Nama Item :
                                </label>
                                <div class="col-lg-9 col-sm-12 padding-left">
                                    <input id="txt-nama_item_nitrogen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 1px;">
                                    
                                </label>
                                <div class="col-lg-9 col-sm-12">
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 27px; padding-right: 1px;">
                                    Satuan :
                                </label>
                                <div class="col-lg-6 col-sm-12 padding-right">
                                    <input id="txt-id_satuan_nitrogen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kt-border">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-bold" align="left" style="text-decoration-line: underline;">
                                    Waktu dan Lama Pemakaian
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Awal :
                                </label>
                                <div class="col-lg-4 col-sm-12 padding-left">
                                    <input id="dtb-tgl_awal_nitrogen" class="form-control form-control-sm easyui-datetimebox" showSeconds='false' style="width: 131px;">
                                </div>

                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 0px; padding-right: 0px;">
                                    Akhir :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="dtb-tgl_akhir_nitrogen" class="form-control form-control-sm easyui-datetimebox" showSeconds='false' style="width: 137px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Lama (Jam) :
                                </label>
                                <div class="col-lg-4 col-sm-12 padding-left">
                                    <input id="txt-lama_jam_nitrogen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>

                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 0px; padding-right: 0px;">
                                    Menit :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <input id="txt-menit_nitrogen" class="form-control form-control-sm" type="text" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Skala :
                                </label>
                                <div class="col-lg-4 col-sm-12 padding-left">
                                    <input id="skala_nitrogen" class="form-control form-control-sm" type="number" min="1" max="15">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-bold" align="left" style="text-decoration-line: underline; padding-left: 27px;">
                                    Jumlah Pemakaian
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 27px; padding-right: 1px;">
                                    Pemakaian :
                                </label>
                                <div class="col-lg-6 col-sm-12 padding-right">
                                    <input id="txt-pemakaian_nitrogen" class="form-control form-control-sm" type="text" disabled="true" style="text-align: right;">
                                </div>
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 0px;">
                                    Liter
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-left: 27px; padding-right: 1px;">
                                    Harga :
                                </label>
                                <div class="col-lg-6 col-sm-12 padding-right">
                                    <input id="txt-harga_nitrogen" class="form-control form-control-sm easyui-numberbox" type="text" disabled="true" style="text-align: right; width: 148px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm kt-font-bold" style="padding-left: 27px; padding-right: 1px;">
                                    Total :
                                </label>
                                <div class="col-lg-6 col-sm-12 padding-right">
                                    <input id="txt-total_nitrogen" class="form-control form-control-sm easyui-numberbox" type="text" disabled="true" style="text-align: right; width: 148px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kt-border" style="border-bottom: 2px solid #0F9E98;">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Keterangan :
                                </label>
                                <div class="col-lg-9 col-sm-12" style="padding-left: 0px; padding-right: 0px; margin-bottom: 10px;">
                                    <textarea id="txt-keterangan_nitrogen" class="form-control form-control-sm " style="resize: none; height: 52px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7" style="margin-top: 9px; margin-left: -2px;">
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
                            <button id="btn-simpan_nitrogen" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan(0)">
                                <i class="la la-save"></i>
                                simpan
                            </button>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-padding">
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