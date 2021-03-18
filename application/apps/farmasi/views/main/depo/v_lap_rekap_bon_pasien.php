<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Laporan Rekap Bon Per Pasien</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Laporan</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Laporan Rekap Bon Per Pasien</a>
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
    <!-- start browse -->
    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile" id="browse">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header">
                    <div class="row justify-content-between">
                        <div class="col-lg-7">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Filter :</label>
                                <div class="col-lg-4 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-criteria" placeholder="Cari..." required>
                                </div>
                                <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                </div>
                                <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="cetak(1)">
                                        <i class="la la-print"></i>
                                        Cetak Reguler
                                    </button>
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="cetak(2)">
                                        <i class="la la-print"></i>
                                        Cetak Asuransi
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <div class="form-group row">
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah()">
                                        Detail
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-rekap_bon_pasien" height="440" width="100%" title="Daftar Rekap Bon Per Pasien" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <!--  -->
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end browse -->
    <!-- start detail -->
    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile" id="detail">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header" style="">
                    <div class="row" style="border-bottom: 2px solid #D3D3D3; margin-bottom:10px">
                        <div class="col-lg-5">
                            <div class="form-group row" id="div_status">
                                <!-- <label class="kt-font-bold col-lg-5 col-sm-12 form-control-sm kt-font" id="txt-label_nopp">
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
                                    
                                </label> -->
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group row justify-content-lg-between">
                                <div class="col-lg-auto kt-padding-t-10-mobile">
                                    <div class="form-group row" id="btn-aksi">
                                        <!-- <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
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
                                        </div> -->
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
                                        <!-- <div style="padding: 4px" class="col-lg-auto div_simpan">
                                            <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="simpan()">
                                                <i class="la la-save"></i>
                                                Simpan
                                            </button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    No. Billing :
                                </label>
                                <div class="col-lg-7 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" disabled="true" id="txt-no_billing">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    Tgl. Mrs :
                                </label>
                                <div class="col-lg-7 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" disabled="true" id="txt-tgl_mrs">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Nama Pasien :
                                </label>
                                <div class="col-lg-7 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" disabled="true" id="txt-nama_pasien">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                    Nama Dokter :
                                </label>
                                <div class="col-lg-7 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" disabled="true" id="txt-nama_dokter">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    No. RM :
                                </label>
                                <div class="col-lg-7 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" disabled="true" id="txt-no_rm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                    Kelas/Kamar :
                                </label>
                                <div class="col-lg-7 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" disabled="true" id="txt-kelas_kamar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="tabs-detail" style="height: 400px; max-height: 400px; margin-top: 15px;">
                        <div class="col-lg-12">
                            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab_1" role="tab" data-toggle="tab">Nota/Bon Pasien</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab_2" role="tab" data-toggle="tab">Retur</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active form-group row kt-container kt-container-form" id="tab_1">
                                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                            <table id="dtg-nota_bon_pasien" class="easyui-datagrid" style="width: 100%;height:300px;" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                <!--  -->
                                            </table>
                                        </div>
                                    </div>
                                    <div role="tabpane1" class="tab-pane fade active form-group row kt-container kt-container-form" id="tab_2">
                                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                            <table id="dtg-retur" class="easyui-datagrid" style="width: 100%;height:300px;"  pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                                <!--  -->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-5 col-sm-12 form-control-sm kt-font-sm kt-font-bold">
                                    Total Bon Pasien :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="number" disabled="true" id="txt-total_bon_pasien">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-5 col-sm-12 form-control-sm kt-font-sm kt-font-bold">
                                    Total Retur :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="number" disabled="true" id="txt-total_retur">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm kt-font-bold">
                                    Total PPN :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="number" disabled="true" id="txt-total_ppn">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm kt-font-bold">
                                    Total JRS :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="number" disabled="true" id="txt-total_jrs">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm kt-font-bold">
                                    Total :
                                </label>
                                <div class="col-lg-6 col-sm-12">
                                    <input class="form-control form-control-sm" type="number" disabled="true" id="txt-total">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end detail -->
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