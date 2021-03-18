<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Laporan Permintaan Barang General</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Laporan</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Permintaan Barang General</a>
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
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change col-form-label" id="tanggal" name="radios" style="margin-left: 20px;" value="1" checked="true">
                                <label for="tanggal" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label" style="margin-left: 20px;">Tanggal :</label>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm change dtb" type="date-only-formatted" id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-auto col-md-2 col-sm-12 form-control-sm">s/d :</label> 
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm change dtb" type="date-only-formatted" id="dtb-end_date">
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
                                <div class="col-lg-9 col-md-4 col-sm-12" style="padding-right: 1px;">
                                    <select class="form-control form-control-sm change" id="cmb-jenis">
                                        <option value="1" selected>Permintaan Barang Per Nota</option>
                                        <option value="2">Permintaan Barang Per Item</option>
                                        <option value="3">Outstanding Permintaan Barang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile" style="margin-left: -5px; margin-top: 10px; margin-bottom: 10px;">
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
                </form>
                <form action="" method="post" id="form_excel" hidden="true">
                    <div>
                        <input type="text" id="type_file" name="type_file">
                        <input type="text" id="buffer" name="buffer">
                        <input type="text" id="id_jns" name="id_jns">
                        <input type="text" id="jns_laporan" name="jns_laporan">
                        <input type="text" id="rpt_type" name="rpt_type">
                        <input type="text" id="rpt_period" name="rpt_period">
                        <input type="text" id="start_date" name="start_date">
                        <input type="text" id="end_date" name="end_date">
                        <input type="text" id="month_period" name="month_period">
                        <input type="text" id="year_period" name="year_period">
                        <input type="text" id="year_period_text" name="year_period_text">
                        <input type="text" id="file_cetak" name="file_cetak">
                    </div> 
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <!--start Permintaan Barang Per Nota-->
                <div class="table-custom" id="tbl1">
                    <table id="dtg1" height="500" width="100%" title="Permintaan Barang Per Nota" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="13%" field="no_pm">No. Permintaan</th>
                                <th halign="center" align="center" width="12%" field="tgl_pm" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                <th halign="center" align="left"   width="15%" field="unit_asal">Permintaan Dari</th>
                                <th halign="center" align="left"   width="15%" field="unit_tujuan">Tujuan Permintaan</th>
                                <th halign="center" align="left"   width="25%" field="ket_pm">Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="left"   width="10%" field="status_caption">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Permintaan Barang Per Nota-->

                <!--start Permintaan Barang Per Item-->
                <div class="table-custom" id="tbl2">
                    <table id="dtg2" height="500" width="100%" title="Permintaan Barang Per Item" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="13%" field="no_pm">No. Permintaan</th>
                                <th halign="center" align="center" width="12%" field="tgl_pm" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                <th halign="center" align="left"   width="13%" field="kd_item">Kode</th>
                                <th halign="center" align="left"   width="25%" field="nama_item">Nama Item</th>
                                <th halign="center" align="center" width="10%" field="nama_satuan">Satuan</th>
                                <th halign="center" align="right"  width="10%" field="jml_stok" formatter="appGridNumberFormatter">Jml. Stok</th>
                                <th halign="center" align="right"  width="10%" field="jml_minta" formatter="appGridNumberFormatter">Jml. Permintaan</th>
                                <th halign="center" align="left"   width="15%" field="unit_asal">Permintaan Dari</th>
                                <th halign="center" align="left"   width="15%" field="unit_tujuan">Tujuan Permintaan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="12%" field="tgl_kebutuhan" data-options="formatter:appGridDateTimeFormatter">Tgl. Kebutuhan</th>
                                <th halign="center" align="center" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Permintaan Barang Per Item-->

                <!--start Outstanding Permintaan Barang-->
                <div class="table-custom" id="tbl3">
                    <table id="dtg3" height="500" width="100%" title="Outstanding Permintaan Barang" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="15%" field="nama_unit">Unit Minta</th>
                                <th halign="center" align="left"   width="13%" field="no_pm">No. Permintaan</th>
                                <th halign="center" align="center" width="12%" field="tgl_pm" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                <th halign="center" align="left"   width="13%" field="kd_item">Kode</th>
                                <th halign="center" align="left"   width="25%" field="nama_item">Nama Item</th>
                                <th halign="center" align="center" width="10%" field="nama_satuan">Satuan</th>
                                <th halign="center" align="right"  width="10%" field="jml_minta" formatter="appGridNumberFormatter">Jml. Minta</th>
                                <th halign="center" align="right"  width="10%" field="jml_terima" formatter="appGridNumberFormatter">Jml. Mutasi</th>
                                <th halign="center" align="right"  width="10%" field="total" formatter="appGridNumberFormatter">Sisa</th>
                                <th halign="center" align="right"  width="10%" field="tot_persen" formatter="appGridNumberFormatter">Sisa (Rp)</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Outstanding Permintaan Barang-->
            </div>
        </div>
    </div>
</div>