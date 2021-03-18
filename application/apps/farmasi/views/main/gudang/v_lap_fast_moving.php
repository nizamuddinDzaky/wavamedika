<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Laporan Fast Moving</h3>
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
                <a href="" class="kt-subheader__breadcrumbs-link">Barang Fast Moving</a>
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
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change col-form-label" id="semua" name="radios" checked="true" style="margin-left: 20px;" value="0">
                                <label for="semua" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label" style="margin-left: 20px;">Semua</label>
                            </div>
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change col-form-label" id="tanggal" name="radios" style="margin-left: 20px;" value="1">
                                <label for="tanggal" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label" style="margin-left: 20px;">Tanggal :</label>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm change dtb" type="date-only-formatted"  id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-auto col-md-2 col-sm-12 form-control-sm">s/d :</label> 
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm change dtb" type="date-only-formatted"  id="dtb-end_date">
                                </div>
                            </div>
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change" id="bulan" name="radios" value="2">
                                <label for="bulan" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label" style="margin-left: 20px;">Bulan :</label>
                                <div class="col-lg-4 col-md-4 col-sm-12">
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
                                <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm">Tahun:</label> 
                                <div class="col-lg-4 col-md-4 col-sm-12" style="margin-left: 9px;">
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
                                <input type="radio" class="custom-control-input change form-control-sm" id="tahun" name="radios" value="3">
                                <label for="tahun" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label" style="margin-left: 20px;">Tahun :</label>
                                <div class="col-lg-4 col-md-4 col-sm-12">
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
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm" style="margin-left: 20px">
                                    Jenis :
                                </label> 
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm change" id="cmb-jenis">
                                        <option value="1" selected>Per Jumlah</option>
                                        <option value="2">Per Total Penjualan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile" style="margin-left: -5px; margin-top: 10px; margin-bottom: 10px;">
                                <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter()">
                                    <i class="la la-filter"></i>
                                    Filter
                                </button>
                                <!-- <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-cetak" onclick="cetak()">
                                    <i class="la la-print"></i>
                                    Cetak
                                </button> -->
                                <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-export" onclick="export_excel()">
                                    <i class="la la-arrow-down"></i>
                                    Export
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="" method="post" id="form_excel" hidden="true">
                    <div>
                        <input type="text" id="type_file" name="type_file">
                        <input type="text" id="buffer" name="buffer">
                        <input type="text" id="rpt_type" name="rpt_type">
                        <input type="text" id="rpt_period" name="rpt_period">
                        <input type="text" id="start_date" name="start_date">
                        <input type="text" id="end_date" name="end_date">
                        <input type="text" id="month_period" name="month_period">
                        <input type="text" id="year_period" name="year_period">
                        <input type="text" id="year_period_text" name="year_period_text">
                        <input type="text" id="rpt_group" name="rpt_group">
                    </div> 
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <!--Start Koreksi Stok Per No. Stok Opname-->
                <div class="table-custom" id="tbl1">
                    <table id="dtg-fast_moving" height="500" width="100%" title="Daftar Laporan Fast Moving" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" fitColumns="false">
                        <thead>
                            <tr>
                                <th halign="center" align="center" field="kd_item" width="10%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="20%">Nama Item</th>
                                <th halign="center" align="center" field="nama_satuan" width="10%">Satuan</th>
                                <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="right" field="total" width="10%" data-options="formatter: appGridNumberFormatter">Total</th>
                                <th halign="center" align="right" field="jml" width="10%" data-options="formatter: appGridNumberFormatter">Jumlah</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Koreksi Stok Per No. Stok Opname-->
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
        </div>
    </div>
</div>