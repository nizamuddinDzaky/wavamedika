<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Index Pasien MRS</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Index Pasien MRS</a>
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
                        <div class="col-lg-8">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm" style="padding-right: 1px;">
                                    Kriteria :
                                </label>
                                <div class="col-lg-4 col-md-4 col-sm-12 kt-margin-t-10-mobile">
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
                                    <!-- <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah()">
                                        Detail
                                        <i class="fas fa-arrow-right"></i>
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-pasien_mrs" height="440" width="100%" title="Daftar Pasien MRS" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
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
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    No. RM :
                                </label>
                                <div class="col-lg-3 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" disabled="true" id="txt-no_rm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                    Nama Pasien :
                                </label>
                                <div class="col-lg-7 col-sm-12">
                                    <input class="form-control form-control-sm" type="text" disabled="true" id="txt-nama_pasien">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
                        <div class="col-12 table-detail">
                            <table id="dtg-detail_item" height="400" width="100%" title="Data Penjualan" class="easyui-datagrid" toolbar="#toolbar" pagination="false" rownumbers="true" singleSelect="true">
                                <thead>
                                    <tr>
                                        <th field="tgl_nota" halign="center" align="center" width="10%" data-options="formatter: appGridDateFormatter">Tgl. Nota</th>
                                        <th field="no_nota" halign="center" width="12%">No. Nota</th>
                                        <th field="jns" halign="center" width="10%">Jenis</th>
                                        <th field="kd_item" halign="center" align="center" width="10%">Kode</th>
                                        <th field="nama_item" halign="center" width="20%">Nama Item</th>
                                        <th field="nama_satuan" halign="center" align="center" width="10%">Satuan</th>
                                        <th field="jml_7" halign="center" align="center" width="8%" data-options="formatter: appGridNumberFormatter">7</th>
                                        <th field="jml_23" halign="center" align="center" width="8%" data-options="formatter: appGridNumberFormatter">23</th>
                                        <th field="signa" halign="center" width="10%">Signa 1</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row" style="margin-left: 1px; margin-bottom: 15px;">
                        <div class="col-lg-4">
                            <div class="form-group row">
                                <div class="col-lg-3 col-md-4 col-sm-12" style="padding: 2px">
                                    <button id="btn-cetak" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="cetak()">
                                        <i class="la la-print"></i>
                                        Cetak
                                    </button>
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
                </form>
            </div>
        </div>
    </div>
    <!-- end detail -->
</div>