<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Kartu Stok</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Gudang Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Kartu Stok</a>
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
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Unit :</label>
                                <div class="col-lg-7 col-md-4 col-sm-12">
                                    <select class="select2 form-control form-control-sm" id="cmb-unit">
                                        <!--  -->
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
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="form-control form-control-sm btn btn-sm btn-primary dropdown-toggle" style="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="la la-check"></span>
                                            Cetak
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" onclick="cetak()">
                                                <span class="la la-print"></span>
                                                 Kartu Stok
                                            </a>
                                            <a class="dropdown-item" onclick="cetak_detail()">
                                                <span class="la la-print"></span>
                                                Detail Transaksi Per Item
                                            </a>
                                            <a class="dropdown-item" onclick="cetak_stok()">
                                                <span class="la la-print"></span>
                                                Stok Unit Per Item
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-export" type="button" class="form-control form-control-sm btn btn-sm btn-primary">
                                        <i class="la la-arrow-down"></i>
                                        Export Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-kartu_stok" height="300" width="100%" title="Daftar Kartu Stok" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <!--  -->
                    </table>
                </div>
                <div class="row" id="tabs-detail" style="height: 400px; max-height: 400px; margin-top: 15px;">
                    <div class="col-lg-12">
                        <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab-lokasi_item" role="tab" data-toggle="tab">Detail Transaksi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab-kombosisi_obat" role="tab" data-toggle="tab">Stok Per Unit</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="tab-lokasi_item">
                                    <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                        <table id="dtg-detail" class="easyui-datagrid" style="width: 100%;height:300px;" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                            <!--  -->
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpane1" class="tab-pane fade active form-group row kt-container kt-container-form" id="tab-kombosisi_obat">
                                    <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                        <table id="dtg-detail_stok" class="easyui-datagrid" style="width: 100%;height:300px;"  pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                            <!-- <thead>
                                                <tr>
                                                    <th field="trans_name" halign="center" width="30%">Zat Sediaan</th>
                                                    <th field="trans_desc" halign="center" width="20%">Kekuatan</th>
                                                    <th field="trans_desc" halign="center" width="20%">Satuan</th>
                                                </tr>
                                            </thead> -->
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="form_file_surat_detail" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-detail" style="width: 100%">
                  <div class="modal-content" style="width: 150%">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                      <iframe id="frame_file_surat_detail" name="frame_file_surat_detail" width="100%" height ="850px"></iframe>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>