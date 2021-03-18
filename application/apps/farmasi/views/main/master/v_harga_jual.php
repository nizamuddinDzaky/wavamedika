<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Harga Jual Farmasi</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Harga Jual</a>
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
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kelompok :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm" id="cmb-kelompok">
                                        <!-- <option value="0">All</option>
                                        <option value="1">Obat</option>
                                        <option value="2">Alkes</option>
                                        <option value="3">Gas Medik</option> -->
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Tanggal :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm">s/d :</label> 
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-end_date">
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                <div class="col-lg-5 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-criteria" placeholder="Cari..." required>
                                </div>
                                <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter()">
                                        <i class="la la-filter"></i>
                                        Filter
                                    </button>
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-cetak" onclick="cetak()">
                                        <i class="la la-print"></i>
                                        Cetak
                                    </button>
                                    <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-export" onclick="export_excel()">
                                        <i class="la la-arrow-down"></i>
                                        Export
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <div class="form-group row">
                                <!-- <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="form-control form-control-sm btn btn-sm btn-primary dropdown-toggle" style="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="tambah();">
                                        <i class="la la-arrow-down"></i>
                                        Export Excel
                                    </button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-harga_jual" height="350" width="100%" title="Daftar Harga Jual" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>    
                                <th colspan="6">Item</th>
                                <th colspan="3">Karyawan</th>
                                <th colspan="3">Umum</th>
                            </tr>
                            <tr>
                                <th halign="center" align="center" field="id_item" width="10%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%" align="center">Nama Item</th>
                                <th halign="center" align="center" field="id_satuan" width="10%">Satuan</th>
                                <th halign="center" align="right" field="hna" width="15%" data-options="formatter:appGridMoneyFormatter">Harga Dasar Jual</th>
                                <th halign="center" align="right" field="hna_rata2" width="15%" data-options="formatter:appGridMoneyFormatter">HNA Rata-Rata</th>
                                <th halign="center" align="right" field="nama_kel_item" width="15%" data-options="formatter:appGridMoneyFormatter">Kelompok</th>

                                <th halign="center" align="center" field="karyawan_p_margin" width="10%" data-options="formatter:appGridNumberFormatter">Margin (%)</th>
                                <th halign="center" align="right" field="karyawan_harga_rj" width="10%" data-options="formatter:appGridNumberFormatter">Rawat Jalan</th>
                                <th halign="center" align="right" field="karyawan_harga_ri" width="10%" data-options="formatter:appGridNumberFormatter">Rawat Inap</th>

                                <th halign="center" align="center" field="umum_p_margin" width="10%" data-options="formatter:appGridNumberFormatter">Margin (%)</th>
                                <th halign="center" align="right" field="umum_harga_rj" width="10%" data-options="formatter:appGridNumberFormatter">Rawat Jalan</th>
                                <th halign="center" align="right" field="umum_harga_ri" width="10%" data-options="formatter:appGridNumberFormatter">Rawat Inap</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="row" id="tabs-detail" style="height: 400px; max-height: 400px; margin-top: 15px;">
                    <div class="col-lg-12">
                        <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab_1" role="tab" data-toggle="tab">Daftar Harga Beli/HNA</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_2" role="tab" data-toggle="tab">Daftar Harga Pokok (HPP)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_3" role="tab" data-toggle="tab">Daftar Perubahan HNA/Harga Jual</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active form-group row kt-container kt-container-form" id="tab_1">
                                    <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                        <table id="dtg-harga_beli" class="easyui-datagrid" style="width: 100%;height:300px;" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false" toolbar="#toolbar1">
                                            <!--  -->
                                        </table>
                                        <div id="toolbar1">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <div class="form-group row" style="margin-top: 3px;">
                                                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Supplier :</label>
                                                        <div class="col-lg-4 col-sm-12">
                                                            <select class="select2 form-control" id="cmb-supplier">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpane1" class="tab-pane fade active form-group row kt-container kt-container-form" id="tab_2">
                                    <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                        <table id="dtg-harga_pokok" class="easyui-datagrid" style="width: 100%;height:300px;"  pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false" toolbar="#toolbar2">
                                            <!-- <thead>
                                                <tr>
                                                    <th field="trans_name" halign="center" width="30%">Zat Sediaan</th>
                                                    <th field="trans_desc" halign="center" width="20%">Kekuatan</th>
                                                    <th field="trans_desc" halign="center" width="20%">Satuan</th>
                                                </tr>
                                            </thead> -->
                                        </table>
                                        <div id="toolbar2">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <div class="form-group row" style="margin-top: 3px;">
                                                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Depo :</label>
                                                        <div class="col-lg-4 col-sm-12">
                                                            <select class="select2 form-control" id="cmb-depo">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpane1" class="tab-pane fade active form-group row kt-container kt-container-form" id="tab_3">
                                    <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                        <table id="dtg-harga_jual_hna" class="easyui-datagrid" style="width: 100%;height:300px;"  pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
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
        </div>
    </div>
</div>