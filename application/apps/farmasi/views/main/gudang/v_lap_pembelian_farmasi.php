<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Laporan Pembelian</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Gudang</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Laporan</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pembelian Farmasi</a>
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
                                    <select class="form-control form-control-sm change" multiple="true" id="cmb-jenis_laporan" style="height: 175px;">
                                        <option value="1" selected>Permintaan Pembelian Per Nota</option>
                                        <option value="2">Permintaan Pembelian Per Item</option>
                                        <option value="3">Penerimaan Pembelian Per Nota</option>
                                        <option value="4">Penerimaan Pembelian Per Item</option>
                                        <option value="5">Pembelian Tunai Per Nota</option>
                                        <option value="6">Pembelian Tunai Per Item</option>
                                        <option value="7">Penerimaan Barang Donasi Per Nota</option>
                                        <option value="8">Penerimaan Barang Donasi Per Item</option>
                                        <option value="9">PPN Masukan</option>
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
                        <input type="text" id="file_cetak" name="file_cetak">
                    </div> 
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <!--Permintaan Pembelian Per Nota -->
                <div class="table-custom" id="tbl1">
                    <table id="dtg1" height="500" width="100%" title="Permintaan Pembelian Per Nota" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="13%" field="no_pp" >No. PP</th>
                                <th halign="center" align="center" width="12%" field="tgl_pp"  data-options="formatter:appGridDateFormatter">Tgl. PP</th>
                                <th halign="center" align="left"   width="20%" field="nama_depo" >Depo</th>
                                <th halign="center" align="left"   width="25%" field="ket_pp" >Keterangan</th>
                                <th halign="center" align="left"   width="10%" field="status_caption" >Status</th>
                                <th halign="center" align="left"   width="10%" field="status_caption" >User</th>
                                <th halign="center" align="center" width="10%" field="date_upd"  data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Permintaan Pembelian Per Nota -->

                <!--Permintaan Pembelian Per Item -->
                <div class="table-custom" id="tbl2">
                    <table id="dtg2" height="500" width="100%" title="Permintaan Pembelian Per Item" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="13%" field="no_pp" >No. PP</th>
                                <th halign="center" align="center" width="12%" field="tgl_pp"  data-options="formatter:appGridDateFormatter">Tgl. PP</th>
                                <th halign="center" align="left"   width="20%" field="nama_depo" >Nama Depo</th>
                                <th halign="center" align="left"   width="10%" field="nama_satuan" >Status</th>
                                <th halign="center" align="left"   width="10%" field="kd_item" >Kode</th>
                                <th halign="center" align="left"   width="25%" field="nama_item" >Nama Item</th>
                                <th halign="center" align="left"   width="10%" field="nama_satuan" >Satuan</th>
                                <th halign="center" align="right"  width="10%" field="jml_stok"  data-options="formatter:appGridNumberFormatter">Jml. Stok</th>
                                <th halign="center" align="right"  width="10%" field="jml_mutasi"  data-options="formatter:appGridNumberFormatter">Jml. Pemakaian</th>
                                <th halign="center" align="right"  width="10%" field="jml_minta"  data-options="formatter:appGridNumberFormatter">Jml. Permintaan</th>
                                <th halign="center" align="center" width="10%" field="tgl_kebutuhan"  data-options="formatter:appGridDateFormatter">Tgl. Kebutuhan</th>
                                <th halign="center" align="left"   width="10%" field="user_fullname" >User</th>
                                <th halign="center" align="center" width="10%" field="date_upd"  data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Permintaan Pembelian Per Item -->

                <!--Penerimaan Pembelian Per Nota -->
                <div class="table-custom" id="tbl3">
                    <table id="dtg3" height="500" width="100%" title="Penerimaan Pembelian Per Nota" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="13%" field="no_bpb" >No. BPB</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb"  data-options="formatter:appGridDateFormatter">Tgl. BPB</th>
                                <th halign="center" align="left"   width="12%" field="no_po" >No. PO</th>
                                <th halign="center" align="left"   width="12%" field="no_faktur_sup" >No. Faktur</th>
                                <th halign="center" align="left"   width="25%" field="partner_name" >Supplier</th>
                                <th halign="center" align="right"  width="10%" field="subtotal"  data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                <th halign="center" align="right"  width="10%" field="diskon_nota"  data-options="formatter:appGridNumberFormatter">Diskon Nota (Rp)</th>
                                <th halign="center" align="right"  width="10%" field="tot_ppn"  data-options="formatter:appGridNumberFormatter">PPN (Rp)</th>
                                <th halign="center" align="right"  width="10%" field="biaya_lain"  data-options="formatter:appGridNumberFormatter">Biaya Lain</th>
                                <th halign="center" align="right"  width="10%" field="total"  data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="left"   width="20%" field="ket_bpb" >Keterangan</th>
                                <th halign="center" align="left"   width="10%" field="user_fullname" >User</th>
                                <th halign="center" align="center" width="13%" field="date_upd"  data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Penerimaan Pembelian Per Nota -->

                <!--Penerimaan Pembelian Per Item -->
                <div class="table-custom" id="tbl4">
                    <table id="dtg4" height="500" width="100%" title="Penerimaan Pembelian Per Item" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="13%" field="no_bpb">No. BPB</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb" data-options="formatter:appGridDateFormatter">Tgl. BPB</th>
                                <th halign="center" align="left"   width="12%" field="no_po">No. PO</th>
                                <th halign="center" align="left"   width="12%" field="no_faktur_sup">No. Faktur</th>
                                <th halign="center" align="left"   width="25%" field="partner_name">Supplier</th>
                                <th halign="center" align="left"   width="10%" field="kd_item">Kode</th>
                                <th halign="center" align="left"   width="25%" field="nama_item">Nama Item</th>
                                <th halign="center" align="left"   width="10%" field="nama_satuan">Satuan</th>
                                <th halign="center" align="right"  width="10%" field="jml_bpb" data-options="formatter:appGridNumberFormatter">Jml. Terima</th>
                                <th halign="center" align="right"  width="10%" field="harga" data-options="formatter:appGridNumberFormatter">Harga</th>
                                <th halign="center" align="right"  width="10%" field="p_diskon" data-options="formatter:appGridNumberFormatter">Diskon (%)</th>
                                <th halign="center" align="right"  width="10%" field="tot_diskon" data-options="formatter:appGridNumberFormatter">Diskon (Rp)</th>
                                <th halign="center" align="right"  width="10%" field="subtotal" data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                <th halign="center" align="right"  width="10%" field="ppn" data-options="formatter:appGridNumberFormatter">PPN</th>
                                <th halign="center" align="right"  width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="center" width="10%" field="tgl_ed" data-options="formatter:appGridDateFormatter">Tgl. Kedaluwarsa</th>
                                <th halign="center" align="left"   width="10%" field="no_batch">No. Batch</th>
                                <th halign="center" align="center" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="13%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Penerimaan Pembelian Per Item -->

                <!--Pembelian Tunai Per Nota-->
                <div class="table-custom" id="tbl5">
                    <table id="dtg5" height="500" width="100%" title="Pembelian Tunai Per Nota" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="13%" field="no_bpb" >No. Pembelian</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb"  data-options="formatter:appGridDateFormatter">Tgl. Pembelian</th>
                                <th halign="center" align="left"   width="25%" field="partner_name" >Supplier</th>
                                <th halign="center" align="left"   width="12%" field="ct_no" >No. Kasbon</th>
                                <th halign="center" align="right"  width="10%" field="ct_amount"  data-options="formatter:appGridNumberFormatter">Nilai Kasbon</th>
                                <th halign="center" align="right"  width="10%" field="subtotal"  data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                <th halign="center" align="right"  width="15%" field="diskon_nota"  data-options="formatter:appGridNumberFormatter">Diskon Nota (Rp)</th>
                                <th halign="center" align="right"  width="10%" field="tot_ppn"  data-options="formatter:appGridNumberFormatter">PPN (Rp)</th>
                                <th halign="center" align="right"  width="10%" field="biaya_lain"  data-options="formatter:appGridNumberFormatter">Biaya Lain</th>
                                <th halign="center" align="right"  width="10%" field="total"  data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="left"   width="25%" field="ket_bpb" >Keterangan</th>
                                <th halign="center" align="left"   width="10%" field="user_fullname" >User</th>
                                <th halign="center" align="center" width="13%" field="date_upd"  data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Pembelian Tunai Per Nota-->

                <!--Pembelian Tunai Per Item-->
                <div class="table-custom" id="tbl6">
                    <table id="dtg6" height="500" width="100%" title="Pembelian Tunai Per Item" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="13%" field="no_bpb">No. BPB</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb" data-options="formatter:appGridDateFormatter">Tgl. BPB</th>
                                <th halign="center" align="left"   width="11%" field="no_po">No. PO</th>
                                <th halign="center" align="left"   width="12%" field="ct_no">No. Faktur</th>
                                <th halign="center" align="left"   width="15%" field="partner_name">Supplier</th>
                                <th halign="center" align="left"   width="10%" field="kd_item">Kode</th>
                                <th halign="center" align="left"   width="25%" field="nama_item">Nama Item</th>
                                <th halign="center" align="left"   width="10%" field="nama_satuan">Satuan</th>
                                <th halign="center" align="right"  width="10%" field="jml_bpb" data-options="formatter:appGridNumberFormatter">Jml. Terima</th>
                                <th halign="center" align="right"  width="10%" field="harga" data-options="formatter:appGridNumberFormatter">Harga</th>
                                <th halign="center" align="right"  width="10%" field="harga" data-options="formatter:appGridNumberFormatter">Diskon (%)</th>
                                <th halign="center" align="right"  width="10%" field="tot_diskon" data-options="formatter:appGridNumberFormatter">Diskon (Rp)</th>
                                <th halign="center" align="right"  width="10%" field="subtotal" data-options="formatter:appGridNumberFormatter">Subtotal</th>
                                <th halign="center" align="right"  width="10%" field="ppn" data-options="formatter:appGridNumberFormatter">PPN</th>
                                <th halign="center" align="right"  width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="center" width="15%" field="tgl_ed">Tgl. Kedaluwarsa</th>
                                <th halign="center" align="left"   width="10%" field="no_batch">No. Batch</th>
                                <th halign="center" align="left"   width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="13%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Pembelian Tunai Per Item-->

                <!--Penerimaan Barang Donasi Per Nota-->
                <div class="table-custom" id="tbl7">
                    <table id="dtg7" height="500" width="100%" title="Penerimaan Barang Donasi Per Nota" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" field="no_bpb" width="13%">No. BPB Donasi</th>
                                <th halign="center" align="center" field="tgl_bpb" width="12%" data-options="formatter:appGridDateFormatter">Tgl. BPB</th>
                                <th halign="center" align="left"   field="partner_name" width="25%">Donatur</th>
                                <th halign="center" align="left"   field="ket_bpb" width="25%">Keterangan</th>
                                <th halign="center" align="center" field="user_fullname" width="10%">User</th>
                                <th halign="center" align="center" field="date_upd" width="13%" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Penerimaan Barang Donasi Per Nota-->

                <!--Penerimaan Barang Donasi Per Item-->
                <div class="table-custom" id="tbl8">
                    <table id="dtg8" height="500" width="100%" title="Penerimaan Barang Donasi Per Item" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_bpb">No. BPB Donasi</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb" data-options="formatter:appGridDateFormatter">Tgl. BPB</th>
                                <th halign="center" align="left"   width="25%" field="partner_name">Donatur</th>
                                <th halign="center" align="left"   width="13%" field="kd_item">Kode</th>
                                <th halign="center" align="left"   width="20%" field="nama_item">Nama Item</th>
                                <th halign="center" align="left"   width="10%" field="nama_satuan">Satuan</th>
                                <th halign="center" align="right"  width="10%" field="jml_bpb" data-options="formatter:appGridNumberFormatter">Jml. Terima</th>
                                <th halign="center" align="center" width="10%" field="tgl_ed" data-options="formatter:appGridDateFormatter">Tgl. Kedaluwarsa</th>
                                <th halign="center" align="left"   width="10%" field="no_batch">No. Batch</th>
                                <th halign="center" align="left"   width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="13%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Penerimaan Barang Donasi Per Item-->

                <!--PPN Masukan-->
                <div class="table-custom" id="tbl9">
                    <table id="dtg9" height="500" width="100%" title="PPN Masukan" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left"   width="13%" field="no_bpb" >No. BPB</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb"  data-options="formatter:appGridDateFormatter">Tgl. BPB</th>
                                <th halign="center" align="left"   width="12%" field="no_po" >No. PO</th>
                                <th halign="center" align="left"   width="12%" field="no_faktur_sup" >No. Faktur</th>
                                <th halign="center" align="left"   width="25%" field="partner_name" >Supplier</th>
                                <th halign="center" align="left"   width="20%" field="ket_bpb" >Keterangan</th>
                                <th halign="center" align="right"  width="13%" field="subtotal"  data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                <th halign="center" align="right"  width="13%" field="diskon_nota"  data-options="formatter:appGridNumberFormatter">Diskon Nota (Rp)</th>
                                <th halign="center" align="right"  width="10%" field="dpp"  data-options="formatter:appGridNumberFormatter">DPP</th>
                                <th halign="center" align="right"  width="10%" field="tot_ppn" >PPN (Rp)</th>
                                <th halign="center" align="left"   width="10%" field="user_fullname" >User</th>
                                <th halign="center" align="center" width="13%" field="date_upd"  data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir PPN Masukan-->
            </div>
        </div>
    </div>
</div>