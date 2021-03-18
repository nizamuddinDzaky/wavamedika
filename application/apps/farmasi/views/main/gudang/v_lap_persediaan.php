<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Laporan Nilai Persediaan</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Gudang Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Laporan</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Stok</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Nilai Persediaan</a>
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
                                        <!-- <button id="btnGroupDrop1" type="button" class="form-control form-control-sm btn btn-sm btn-primary dropdown-toggle" style="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="la la-check"></span>
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="#">
                                                <span class="la la-print"></span>
                                                 Kartu Stok
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <span class="la la-print"></span>
                                                Detail Transaksi Per Item
                                            </a>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-cetak" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="cetak();">
                                        <i class="la la-print"></i>
                                        Cetak
                                    </button>
                                </div>
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-export" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="export_excel();">
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
                    <table id="dtg-lap_persediaan" height="500" width="100%" title="Daftar Laporan Persediaan" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th colspan="5">Item</th>
                                <th colspan="2">Stok Awal</th>
                                <th colspan="4">Stok Periode Ini</th>
                                <th colspan="2">Stok Akhir</th>
                            </tr>
                            <tr>
                                <th halign="center" align="left" field="id_item" width="10%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Item</th>
                                <th halign="center" align="left" field="id_satuan" width="10%">Satuan</th>
                                <th halign="center" align="left" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="left" field="nama_unit" width="10%">Unit</th>

                                <th halign="center" align="right" field="stok_awal" width="10%" data-options="formatter:appGridNumberFormatter, align:'right'">Jumlah</th>
                                <th halign="center" align="right" field="persediaan_awal" width="10%" data-options="formatter:appGridNumberFormatter, align:'right'">Nilai Persediaan</th>

                                <th halign="center" align="right" field="masuk" width="10%" data-options="formatter:appGridNumberFormatter, align:'right'">Jumlah Masuk</th>
                                <th halign="center" align="right" field="persediaan_masuk" width="15%" data-options="formatter:appGridNumberFormatter, align:'right'">Nilai Persediaan Masuk</th>
                                <th halign="center" align="right" field="keluar" width="10%" data-options="formatter:appGridNumberFormatter, align:'right'">Jumlah Keluar</th>
                                <th halign="center" align="right" field="persediaan_keluar" width="15%" data-options="formatter:appGridNumberFormatter, align:'right'">Nilai Persediaan Keluar</th>

                                <th halign="center" align="right" field="stok_akhir" width="10%" data-options="formatter:appGridNumberFormatter, align:'right'">Jumlah</th>
                                <th halign="center" align="right" field="persediaan_akhir" width="10%" data-options="formatter:appGridNumberFormatter, align:'right'">Nilai Persediaan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>