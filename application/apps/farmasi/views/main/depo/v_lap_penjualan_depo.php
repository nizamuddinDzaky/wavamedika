<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Laporan Penjualan Depo</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Laporan</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Laporan Penjualan Depo</a>
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
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <!-- <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Jenis Laporan :</label> -->
                                <div class="col-lg-12 col-md-4 col-sm-12 kt-margin-t-10-mobile" style="margin-left: 2px;">
                                    <select class="form-control form-control-sm change" multiple="true" id="cmb-jenis_laporan" style="height: 200px;">
                                        <option value="per_brg" selected>Penjualan Per Barang</option>
                                        <option value="per_status_px">Penjualan Per Status Pasien</option>
                                        <option value="bpjs_irja">Penjualan BPJS Rawat Jalan</option>
                                        <option value="per_depo">Penjualan Per Depo</option>
                                        <option value="resep_per_status">Jumlah Resep Per Status Pasien</option>
                                        <option value="jasa_resep">Jasa Resep</option>
                                        <option value="per_dokter">Penjualan Per Dokter</option>
                                        <option value="obat_per_dokter">Penjualan Per Obat Per Dokter</option>
                                        <option value="per_produsen">Penjualan Per Produsen</option>
                                        <option value="rekap_jual">Rekapitulasi Penjualan Farmasi</option>
                                        <option value="per_nota">Penjualan Per Nota</option>
                                        <option value="rekap_depo">Rekapitulasi Penjualan Per Depo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row custom-radio">
                                <input type="radio" class="custom-control-input change col-form-label" id="tanggal" name="radios" checked="true" style="margin-left: 20px;" value="1">
                                <label for="tanggal" class="col-form-label col-lg-2 col-sm-12 form-control-sm custom-control-label" style="margin-left: 20px;">Tanggal :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm change dtb" type="date-only-formatted"  id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm">s/d :</label> 
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm change dtb" type="date-only-formatted"  id="dtb-end_date">
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
                                <div class="col-lg-3 col-md-4 col-sm-12">
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
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm">
                                    Depo :
                                </label> 
                                <div class="col-lg-7 col-md-4 col-sm-12" style="margin-left: 3%;">
                                    <select class="select2 form-control form-control-sm change" id="cmb-depo">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm">
                                    Kategori :
                                </label> 
                                <div class="col-lg-7 col-md-4 col-sm-12" style="margin-left: 3%;">
                                    <select class="form-control form-control-sm change" id="cmb-kategori">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-md-2 col-sm-12 form-control-sm">
                                    Karyawan :
                                </label> 
                                <div class="col-lg-7 col-md-4 col-sm-12" style="margin-left: 3%;">
                                    <select class="select2 form-control form-control-sm change" id="cmb-karyawan">
                                        <option value="ALL">All</option>
                                        <option value="UMUM">UMUM</option>
                                        <option value="KARYAWAN">KARYAWAN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group row">
                                <div class="kt-margin-t-10-mobile" style="margin-left: 3.5%; margin-top: 0px; margin-bottom: 5px;">
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

                        <input type="text" id="id_depo" name="id_depo">
                        <input type="text" id="nama_depo" name="nama_depo">
                        <input type="text" id="id_kel_item" name="id_kel_item">
                        <input type="text" id="status_karyawan" name="status_karyawan">
                    </div> 
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <!-- Start Penjualan Per Barang-->
                <div class="table-custom" id="tbl1">
                    <table id="dtg1" height="440" width="100%" title="Penjualan Per Barang" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="center" field="kd_item" width="12%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                <th halign="center" align="left" field="nama_produsen" width="25%">Produsen</th>
                                <th halign="center" align="center" field="nama_satuan" width="8%">Satuan</th>
                                <th halign="center" align="right" field="jml" width="12%" data-options="formatter: appGridNumberFormatter">Jumlah</th>
                                <th halign="center" align="right" field="total_hpp" width="12%" data-options="formatter: appGridNumberFormatter">Total HPP</th>
                                <th halign="center" align="right" field="total_jual" width="12%" data-options="formatter: appGridNumberFormatter">Total Jual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Start Penjualan Per Barang-->

                <!--Start Penjualan Per Status Pasien-->
                <div class="table-custom" id="tbl2">
                    <table id="dtg2" height="440" width="100%" title="Penjualan Per Status Pasien" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" field="status_pasien" width="12%">Status</th>
                                <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="center" field="kd_item" width="12%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                <th halign="center" align="left" field="nama_produsen" width="25%">Produsen</th>
                                <th halign="center" align="center" field="nama_satuan" width="8%">Satuan</th>
                                <th halign="center" align="right" field="jml" width="12%" data-options="formatter: appGridNumberFormatter">Jumlah</th>
                                <th halign="center" align="right" field="total_hpp" width="12%" data-options="formatter: appGridNumberFormatter">Total HPP</th>
                                <th halign="center" align="right" field="total_jual" width="12%" data-options="formatter: appGridNumberFormatter">Total Jual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Penjualan Per Status Pasien-->

                <!--Start Penjualan BPJS Rawat Jalan-->
                <div class="table-custom" id="tbl3">
                    <table id="dtg3" height="440" width="100%" title="Penjualan BPJS Rawat Jalan" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left" field="status_pasien" width="12%">Status</th>
                                <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="center" field="kd_item" width="12%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                <th halign="center" align="left" field="nama_produsen" width="25%">Produsen</th>
                                <th halign="center" align="center" field="nama_satuan" width="8%">Satuan</th>
                                <th halign="center" align="right" field="jml" width="12%" data-options="formatter: appGridNumberFormatter">Jumlah</th>
                                <th halign="center" align="right" field="total_hpp" width="12%" data-options="formatter: appGridNumberFormatter">Total HPP</th>
                                <th halign="center" align="right" field="total_jual" width="12%" data-options="formatter: appGridNumberFormatter">Total Jual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Penjualan BPJS Rawat Jalan-->

                <!--Start Penjualan Per Depo-->
                <div class="table-custom" id="tbl4">
                    <table id="dtg4" height="440" width="100%" title="Penjualan Per Depo" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="center" field="kd_item" width="12%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                <th halign="center" align="left" field="nama_produsen" width="25%">Produsen</th>
                                <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="center" field="nama_satuan" width="8%">Satuan</th>
                                <th halign="center" align="center" field="status_pasien" width="20%">Status</th>
                                <th halign="center" align="right" field="jml" width="12%" data-options="formatter: appGridNumberFormatter">Jumlah</th>
                                <th halign="center" align="right" field="rajal" width="12%" data-options="formatter: appGridNumberFormatter">F. Rawat Jalan</th>
                                <th halign="center" align="right" field="ranap" width="12%" data-options="formatter: appGridNumberFormatter">F. Rawat Inap</th>
                                <th halign="center" align="right" field="alkes" width="10%" data-options="formatter: appGridNumberFormatter">Alkes</th>
                                <th halign="center" align="right" field="uko" width="12%" data-options="formatter: appGridNumberFormatter">F. UKO</th>
                                <th halign="center" align="right" field="igd" width="12%" data-options="formatter: appGridNumberFormatter">F. IGD</th>
                                <th halign="center" align="right" field="total_hpp" width="12%" data-options="formatter: appGridNumberFormatter">Total HPP</th>
                                <th halign="center" align="right" field="total_jual" width="12%" data-options="formatter: appGridNumberFormatter">Total Jual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Penjualan Per Depo-->

                <!--Start Jumlah Resep Per Status Pasien-->
                <div class="table-custom" id="tbl5">
                    <table id="dtg5" height="440" width="100%" title="Jumlah Resep Per Status Pasien" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="center"width="10%" field="no_nota">No. Nota</th>
                                <th halign="center" align="center" width="12%" field="tgl_nota" data-options="formatter: appGridDateTimeFormatter">Tgl. Transaksi</th>
                                <th halign="center" align="center" width="10%" field="id_billing">No. Billing</th>
                                <th halign="center" align="center" width="10%" field="no_resep">No. Resep</th>
                                <th halign="center" align="left" width="10%" field="status_pasien">Status</th>
                                <th halign="center" align="center" width="12%" field="jns_resep">Jenis Resep</th>
                                <th halign="center" align="center" width="12%" field="tgl_nota" data-options="formatter: appGridDateTimeFormatter">Waktu Transaksi</th>
                                <th halign="center" align="center" width="15%" field="tgl_ambil" data-options="formatter: appGridDateTimeFormatter">Waktu Diserahkan</th>
                                <th halign="center" align="right" width="10%" field="selisih">Selisih</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Jumlah Resep Per Status Pasien-->

                <!--Start Jasa Resep-->
                <div class="table-custom" id="tbl6">
                    <table id="dtg6" height="440" width="100%" title="Jasa Resep" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="center" width="13%" field="tgl_nota" data-options="formatter: appGridDateFormatter">Tgl. Transaksi</th>
                                <th halign="center" align="center" width="12%" field="id_billing">No. Billing</th>
                                <th halign="center" align="left" width="18%" field="status_pasien">Status</th>
                                <th halign="center" align="left" width="13%" field="jns_resep">Jenis Resep</th>
                                <th halign="center" align="right"width="12%" field="jml_item">Jml. Item</th>
                                <th halign="center" align="right"width="12%" field="jrs" data-options="formatter: appGridNumberFormatter">Jasa Resep</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Jasa Resep-->

                <!--Start Penjualan Per Dokter-->
                <div class="table-custom" id="tbl7">
                    <table id="dtg7" height="440" width="100%" title="Penjualan Per Dokter" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left"width="25%" field="nama_dokter">Nama Dokter</th>
                                <th halign="center" align="center" width="12%" field="status_pasien">Status</th>
                                <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="center" field="kd_item" width="12%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                <th halign="center" align="left" field="nama_produsen" width="25%">Produsen</th>
                                <th halign="center" align="center" field="nama_satuan" width="8%">Satuan</th>
                                <th halign="center" align="left" field="for_rs" width="15%">Formularium</th>
                                <th halign="center" align="right" field="jml" width="12%" data-options="formatter: appGridNumberFormatter">Jumlah</th>
                                <th halign="center" align="right" field="total_hpp" width="12%" data-options="formatter: appGridNumberFormatter">Total HPP</th>
                                <th halign="center" align="right" field="total_jual" width="12%" data-options="formatter: appGridNumberFormatter">Total Jual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Penjualan Per Dokter-->

                <!--Start Penjualan Per Obat Per Dokter-->
                <div class="table-custom" id="tbl8">
                    <table id="dtg8" height="440" width="100%" title="Penjualan Per Obat Per Dokter" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="center" width="12%" field="status_pasien">Status</th>
                                <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="center" field="kd_item" width="12%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                <th halign="center" align="left" field="nama_produsen" width="25%">Produsen</th>
                                <th halign="center" align="center" field="nama_satuan" width="8%">Satuan</th>
                                <th halign="center" align="left" field="for_rs" width="15%">Formularium</th>
                                <th halign="center" align="left"width="25%" field="nama_dokter">Nama Dokter</th>
                                <th halign="center" align="right" field="jml" width="12%" data-options="formatter: appGridNumberFormatter">Jumlah</th>
                                <th halign="center" align="right" field="total_hpp" width="12%" data-options="formatter: appGridNumberFormatter">Total HPP</th>
                                <th halign="center" align="right" field="total_jual" width="12%" data-options="formatter: appGridNumberFormatter">Total Jual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Penjualan Per Obat Per Dokter-->

                <!--Start Penjualan Per Produsen-->
                <div class="table-custom" id="tbl9">
                    <table id="dtg9" height="440" width="100%" title="Penjualan Per Produsen" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left" field="nama_produsen" width="25%">Produsen</th>
                                <th halign="center" align="center" width="12%" field="status_pasien">Status</th>
                                <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="center" field="kd_item" width="12%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                <th halign="center" align="center" field="nama_satuan" width="8%">Satuan</th>
                                <th halign="center" align="left" field="for_rs" width="15%">Formularium</th>
                                <th halign="center" align="right" field="jml" width="12%" data-options="formatter: appGridNumberFormatter">Jumlah</th>
                                <th halign="center" align="right" field="total_hpp" width="12%" data-options="formatter: appGridNumberFormatter">Total HPP</th>
                                <th halign="center" align="right" field="total_jual" width="12%" data-options="formatter: appGridNumberFormatter">Total Jual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Penjualan Per Produsen-->

                <!--Start Rekapitulasi Penjualan Farmasi-->
                <div class="table-custom" id="tbl10">
                    <table id="dtg10" height="440" width="100%" title="Rekapitulasi Penjualan Farmasi" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="45%" field="nama_rpt">Rekapitulasi</th>
                                <th halign="center" align="right" width="15%" field="total" data-options="formatter: appGridNumberFormatter">Total</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Rekapitulasi Penjualan Farmasi-->

                <!--Start Penjualan Per Nota-->
                <div class="table-custom" id="tbl11">
                    <table id="dtg11" height="440" width="100%" title="Penjualan Per Nota" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left"width="13%" field="id_mrs">Jenis Transaksi</th>
                                <th halign="center" align="center" width="12%" field="tgl_nota" data-options="formatter: appGridDateFormatter">No. Transaksi</th>
                                <th halign="center" align="center" width="12%" field="status_pasien">Status</th>
                                <th halign="center" align="center" width="12%" field="no_nota">No. Billing</th>
                                <th halign="center" align="center" width="12%" field="no_mr">No. RM</th>
                                <th halign="center" align="left" width="25%" field="nama_pasien">Nama Pasien</th>
                                <th halign="center" align="left"width="25%" field="nama_dokter">Nama Dokter</th>
                                <th halign="center" align="center" width="10%" field="nama_kel_item">Jenis</th>
                                <th halign="center" align="center" width="12%" field="kd_item">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                <th halign="center" align="left" field="nama_produsen" width="25%">Produsen</th>
                                <th halign="center" align="center" field="nama_satuan" width="8%">Satuan</th>
                                <th halign="center" align="right" field="total_hpp" width="12%" data-options="formatter: appGridNumberFormatter">Total HPP</th>
                                <th halign="center" align="right" field="total_jual" width="12%" data-options="formatter: appGridNumberFormatter">Total Jual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Penjualan Per Nota-->

                <!--Start Rekapitulasi Penjualan Per Depo-->
                <div class="table-custom" id="tbl12">
                    <table id="dtg12" height="440" width="100%" title="Rekapitulasi Penjualan Per Depo" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="center" field="nama_kel_item" width="10%">Jenis</th>
                                <th halign="center" align="center" field="kd_item" width="12%">Kode</th>
                                <th halign="center" align="left" field="nama_item" width="25%">Nama Obat/Alkes</th>
                                <th halign="center" align="center" field="nama_satuan" width="8%">Satuan</th>
                                <th halign="center" align="right" field="jml" width="12%" data-options="formatter: appGridNumberFormatter">Jumlah</th>
                                <th halign="center" align="right" field="rajal" width="12%" data-options="formatter: appGridNumberFormatter">F. Rawat Jalan</th>
                                <th halign="center" align="right" field="ranap" width="12%" data-options="formatter: appGridNumberFormatter">F. Rawat Inap</th>
                                <th halign="center" align="right" field="alkes" width="10%" data-options="formatter: appGridNumberFormatter">Alkes</th>
                                <th halign="center" align="right" field="uko" width="12%" data-options="formatter: appGridNumberFormatter">F. UKO</th>
                                <th halign="center" align="right" field="igd" width="12%" data-options="formatter: appGridNumberFormatter">F. IGD</th>
                                <th halign="center" align="right" field="total_hpp" width="12%" data-options="formatter: appGridNumberFormatter">Total HPP</th>
                                <th halign="center" align="right" field="total_jual" width="12%" data-options="formatter: appGridNumberFormatter">Total Jual</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--End Rekapitulasi Penjualan Per Depo-->
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
</div>