<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Laporan Mutasi Barang</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Gudang</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Laporan</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Mutasi Barnag</a>
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
                    <!-- <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Jenis Laporan :</label>
                    </div> -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <!-- <label class="col-form-label col-lg-3 col-sm-12 form-control-sm">Jenis Laporan :</label> -->
                                <div class="col-lg-12 col-md-4 col-sm-12 kt-margin-t-10-mobile" style="margin-left: 2px;">
                                    <select class="form-control form-control-sm change" multiple="true" id="cmb-jenis_laporan" style="height: 156px;">
                                        <option value="minta_mutasi_nota" selected="true">Permintaan Mutasi Per No. Permintaan</option>
                                        <option value="minta_mutasi_item">Permintaan Mutasi Per Item</option>
                                        <option value="mutasi_ruang_nota">Mutasi Ruangan Per No. Mutasi</option>
                                        <option value="mutasi_ruang_item">Mutasi Ruangan Per Item</option>
                                        <option value="retur_mutasi_nota">Retur Mutasi Ruangan Per No. Retur</option>
                                        <option value="retur_mutasi_item">Retur Mutasi Ruangan Per Item</option>
                                        <option value="retur_ed_nota">Depo Retur (Barang ED) Per No. Retur</option>
                                        <option value="retur_ed_item">Depo Retur (Barang ED) Per Item</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input col-form-label change" id="tanggal" name="radios" checked="true" style="margin-left: 20px;" value="1">
                                <label for="tanggal" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label" style="margin-left: 20px;">Tanggal :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm dtb change" type="date-only-formatted"  id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm">s/d :</label> 
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm dtb change" type="date-only-formatted"  id="dtb-end_date">
                                </div>
                            </div>
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change" id="bulan" name="radios" value="2">
                                <label for="bulan" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label" style="margin-left: 20px;">Bulan :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
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
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm change" id="cmb-tahun1">
                                        <option value="1">2019</option>
                                        <option value="2" selected="true">2020</option>
                                        <option value="3">2021</option>
                                        <option value="4">2022</option>
                                        <option value="5">2023</option>
                                        <option value="6">2024</option>
                                        <option value="7">2025</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input form-control-sm change" id="tahun" name="radios" value="3">
                                <label for="tahun" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label" style="margin-left: 20px;">Tahun :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm change" id="cmb-tahun2">
                                        <option value="1">2019</option>
                                        <option value="2" selected="true">2020</option>
                                        <option value="3">2021</option>
                                        <option value="4">2022</option>
                                        <option value="5">2023</option>
                                        <option value="6">2024</option>
                                        <option value="7">2025</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile" style="margin-left: -5px; margin-top: 20px;">
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
                        <input type="text" id="url" name="url">
                        <input type="text" id="jns_laporan" name="jns_laporan">
                        <input type="text" id="rpt_type" name="rpt_type">
                        <input type="text" id="rpt_period" name="rpt_period">
                        <input type="text" id="start_date" name="start_date">
                        <input type="text" id="end_date" name="end_date">
                        <input type="text" id="month_period" name="month_period">
                        <input type="text" id="year_period" name="year_period">
                        <input type="text" id="year_period_text" name="year_period_text">
                    </div> 
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20" style="margin-top: 10px">
                <!--Permintaan Mutasi Per No. Permintaan -->
                <div class="table-custom" id="tbl1">
                    <table id="dtg1" height="440" width="100%" title="Permintaan Mutasi Per No. Permintaan" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="15%" field="no_pm" >No. Permintaan</th>
                                <th halign="center" align="center" width="12%" field="tgl_pm" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                <th halign="center" align="left" width="25%" field="unit_asal">Permintaan Dari</th>
                                <th halign="center" align="left" width="25%" field="unit_tujuan">Tujuan Permintaan</th>
                                <th halign="center" align="left" width="20%" field="ket_pm">Keterangan</th>
                                <th halign="center" align="left" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="left" width="15%" field="user_fullname" >User</th>
                                <th halign="center" align="center" width="13%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--end Permintaan Mutasi Per No. Permintaan -->

                <!--Permintaan Mutasi Per Item -->
                <div class="table-custom" id="tbl2">
                    <table id="dtg2" height="440" width="100%" title="Permintaan Mutasi Per Item" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_pm" >No. Permintaan</th>
                                <th halign="center" align="center" width="12%" field="tgl_pm" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                <th halign="center" align="left" width="10%" field="kd_item" >Kode</th>
                                <th halign="center" align="left" width="25%" field="nama_item" >Nama Item</th>
                                <th halign="center" align="left" width="10%" field="nama_satuan" >Satuan</th>
                                <th halign="center" align="right" width="10%" field="jml_stok"  data-options="formatter:appGridNumberFormatter">Jml. Stok</th>
                                <th halign="center" align="right" width="10%" field="jml_minta"  data-options="formatter:appGridNumberFormatter">Jml. Permintaan</th>
                                <th halign="center" align="left" width="25%" field="unit_asal">Permintaan Dari</th>
                                <th halign="center" align="left" width="25%" field="unit_tujuan">Tujuan Permintaan</th>
                                <th halign="center" align="left" width="10%" field="status_caption" >Status</th>
                                <th halign="center" align="center" width="10%" field="tgl_kebutuhan" data-options="formatter:appGridDateFormatter">Tgl. Kebutuhan</th>
                                <th halign="center" align="left"   width="10%" field="user_fullname" >User</th>
                                <th halign="center" align="center" width="10%" field="date_upd"  data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--end Permintaan Mutasi Per Item -->

                <!--start Mutasi Ruangan Per No. Mutasi -->
                <div class="table-custom" id="tbl3">
                    <table id="dtg3" height="440" width="100%" title="Mutasi Ruangan Per No. Mutasi" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_mutasi" >No. Mutasi</th>
                                <th halign="center" align="center" width="12%" field="tgl_mutasi" data-options="formatter:appGridDateFormatter">Tgl. Mutasi</th>
                                <th halign="center" align="left" width="20%" field="unit_asal">Unit Asal</th>
                                <th halign="center" align="left" width="20%" field="unit_tujuan">Unit Tujuan</th>
                                <th halign="center" align="left" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="left" width="20%" field="ket_mutasi">Keterangan</th>
                                <th halign="center" align="left"  width="10%" field="user_fullname" >User</th>
                                <th halign="center" align="center" width="13%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--end Mutasi Ruangan Per No. Mutasi -->

                <!--start Mutasi Ruangan Per Item -->
                <div class="table-custom" id="tbl4">
                    <table id="dtg4" height="440" width="100%" title="Mutasi Ruangan Per Item" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_mutasi" >No. Mutasi</th>
                                <th halign="center" align="center" width="12%" field="tgl_mutasi"  data-options="formatter:appGridDateFormatter">Tgl. Mutasi</th>
                                <th halign="center" align="left" width="20%" field="unit_asal">Unit Asal</th>
                                <th halign="center" align="left" width="20%" field="unit_tujuan">Unit Tujuan</th>
                                <th halign="center" align="left" width="12%" field="no_pm">No. PM</th>
                                <th halign="center" align="left" width="10%" field="kd_item">Kode</th>
                                <th halign="center" align="left" width="25%" field="nama_item">Nama Item</th>
                                <th halign="center" align="left" width="10%" field="nama_satuan">Satuan</th>
                                <th halign="center" align="right" width="10%" field="jml_minta" data-options="formatter:appGridNumberFormatter">Jml. Minta</th>
                                <th halign="center" align="right" width="10%" field="jml_mutasi" data-options="formatter:appGridNumberFormatter">Jml. Mutasi</th>
                                <th halign="center" align="left" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="13%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--end Mutasi Ruangan Per Item -->

                <!--start Retur Mutasi Ruangan Per No. Retur-->
                <div class="table-custom" id="tbl5">
                    <table id="dtg5" height="440" width="100%" title="Retur Mutasi Ruangan Per No. Retur" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_rt_mutasi" >No. Retur</th>
                                <th halign="center" align="center" width="12%" field="tgl_rt_mutasi"  data-options="formatter:appGridDateFormatter">Tgl. Retur</th>
                                <th halign="center" align="left" width="20%" field="unit_asal">Unit Asal</th>
                                <th halign="center" align="left" width="20%" field="unit_tujuan">Unit Tujuan</th>
                                <th halign="center" align="left" width="25%" field="ket_rt_mutasi">Keterangan</th>
                                <th halign="center" align="left" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="13%" field="date_upd"  data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--end Retur Mutasi Ruangan Per No. Retur-->

                <!--start Retur Mutasi Ruangan Per Item-->
                <div class="table-custom" id="tbl6">
                    <table id="dtg6" height="440" width="100%" title="Retur Mutasi Ruangan Per Item" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_rt_mutasi">No. Retur</th>
                                <th halign="center" align="center" width="12%" field="tgl_rt_mutasi" data-options="formatter:appGridDateFormatter">Tgl. Retur</th>
                                <th halign="center" align="left" width="11%" field="no_mutasi">No. Mutasi</th>
                                <th halign="center" align="left" width="20%" field="unit_asal">Unit Asal</th>
                                <th halign="center" align="left" width="20%" field="unit_tujuan">Unit Tujuan</th>
                                <th halign="center" align="left" width="10%" field="kd_item">Kode</th>
                                <th halign="center" align="left" width="25%" field="nama_item">Nama Item</th>
                                <th halign="center" align="left" width="10%" field="nama_satuan">Satuan</th>
                                <th halign="center" align="right" width="10%" field="jml_retur" data-options="formatter:appGridNumberFormatter">Jml. Retur</th>
                                <th halign="center" align="left" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="13%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--end Retur Mutasi Ruangan Per Item-->

                <!--start Depo Retur (Barang ED) Per No. Retur-->
                <div class="table-custom" id="tbl7">
                    <table id="dtg7" height="440" width="100%" title="Depo Retur (Barang ED) Per No. Retur" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_rt_mutasi" >No. Retur</th>
                                <th halign="center" align="center" width="12%" field="tgl_rt_mutasi" data-options="formatter:appGridDateFormatter">Tgl. Retur</th>
                                <th halign="center" align="left" width="20%" field="unit_asal">Unit Asal</th>
                                <th halign="center" align="left" width="20%" field="unit_tujuan">Unit Tujuan</th>
                                <th halign="center" align="left" width="25%" field="ket_rt_mutasi" >Keterangan</th>
                                <th halign="center" align="left" width="10%" field="user_fullname" >User</th>
                                <th halign="center" align="center" width="13%" field="date_upd"  data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--end Depo Retur (Barang ED) Per No. Retur-->

                <!--start Depo Retur (Barang ED) Per Item-->
                <div class="table-custom" id="tbl8">
                    <table id="dtg8" height="440" width="100%" title="Depo Retur (Barang ED) Per Item" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_rt_mutasi" >No. Retur</th>
                                <th halign="center" align="center" width="12%" field="tgl_rt_mutasi">Tgl. Retur</th>
                                <th halign="center" align="left" width="20%" field="unit_asal">Unit Asal</th>
                                <th halign="center" align="left" width="20%" field="unit_tujuan">Unit Tujuan</th>
                                <th halign="center" align="left" width="10%" field="kd_item">Kode</th>
                                <th halign="center" align="left" width="25%" field="nama_item">Nama Item</th>
                                <th halign="center" align="left" width="10%" field="nama_satuan">Satuan</th>
                                <th halign="center" align="right" width="10%" field="jml_retur">Jml. Retur</th>
                                <th halign="center" align="center" width="15%" field="tgl_ed" data-options="formatter:appGridDateFormatter">Tgl. Kedaluwarsa</th>
                                <th halign="center" align="left" width="10%" field="no_batch">No. Batch</th>
                                <th halign="center" align="left" width="13%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="13%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--end Depo Retur (Barang ED) Per Item-->
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

        </div>
    </div>
</div>