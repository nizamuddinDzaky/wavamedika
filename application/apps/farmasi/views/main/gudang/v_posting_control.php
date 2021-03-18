<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Posting Transaksi Gudang</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Gudang Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Posting Transaksi Gudang</a>
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
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Jenis :</label>
                                <div class="col-lg-7 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm change" id="cmb-jenis">
                                        <option value="1" selected>Permintaan Pembelian (PP)</option>
                                        <option value="2">Order Pembelian (PO)</option>
                                        <option value="3">Order Pembelian (PO Tunai)</option>
                                        <option value="4">Penerimaan Barang</option>
                                        <option value="5">Penerimaan Barang (Donasi)</option>
                                        <option value="6">Retur Pembelian</option>
                                        <option value="7">Pengganti Retur</option>
                                        <option value="8">Permintaan Mutasi</option>
                                        <option value="9">Mutasi Ruangan</option>
                                        <option value="10">Retur Mutasi Ruangan</option>
                                        <option value="11">Depo Retur (ED)</option>
                                        <option value="12">Permintaan ROP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">
                                    Tanggal :
                                </label>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-start_date">
                                </div>

                                <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm" style="padding-right: 1px;">
                                    s/d :
                                </label> 
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
                                    <!-- <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="btn_tambah();">
                                        <i class="la la-plus"></i>
                                        Tambah Pengganti Retur
                                    </button> -->
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
                        <input type="text" id="file_cetak" name="file_cetak">
                    </div> 
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <!--start Permintaan Pembelian (PP) -->
                <div class="table-custom" id="tbl1">
                    <table id="dtg1" height="500" width="100%" title="Permintaan Pembelian (PP)" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_pp">No. Permintaan</th>
                                <th halign="center" align="center" width="12%" field="tgl_pp" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                <th halign="center" align="left" width="15%" field="tgl_p">Permintaan Dari</th>
                                <th halign="center" align="left" width="25%" field="ket_pp">Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="left" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Permintaan Pembelian (PP) -->

                <!--start Order Pembelian (PO) -->
                <div class="table-custom" id="tbl2">
                    <table id="dtg2" height="500" width="100%" title="Order Pembelian (PO)" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_po">No. PO</th>
                                <th halign="center" align="center" width="12%" field="tgl_po" data-options="formatter:appGridDateFormatter">Tgl. PO</th>
                                <th halign="center" align="left" width="20%" field="partner_name">Supplier</th>
                                <th halign="center" align="left" width="13%" field="no_pp">No. Bukti</th>
                                <th halign="center" align="left" width="10%" field="sta_ppn">PPN</th>
                                <th halign="center" align="right" width="13%" field="subtotal" data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                <th halign="center" align="right" width="10%" field="no">PPN (Rp)</th>
                                <th halign="center" align="right" width="13%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="left" width="25%" field="ket_po">Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="center" width="10%" field="updated_by">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Order Pembelian (PO) -->

                <!--start Order Pembelian (PO Tunai) -->
                <div class="table-custom" id="tbl3">
                    <table id="dtg3" height="500" width="100%" title="Order Pembelian (PO Tunai)" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_bpb">No. PO</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb" data-options="formatter:appGridDateFormatter">Tgl. PO</th>
                                <th halign="center" align="left" width="20%" field="partner_name">Supplier</th>
                                <th halign="center" align="left" width="13%" field="ct_no">No. Voucher</th>
                                <th halign="center" align="right" width="10%" field="tot_ppn" data-options="formatter:appGridNumberFormatter">PPN</th>
                                <th halign="center" align="right" width="13%" field="subtotal" data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                <th halign="center" align="right" width="10%" field="tot_ppn" data-options="formatter:appGridNumberFormatter">PPN (Rp)</th>
                                <th halign="center" align="right" width="13%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="left" width="25%" field="ket_bpb">Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="center" width="10%" field="updated_by">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Order Pembelian (PO Tunai) -->

                <!--start Penerimaan Barang -->
                <div class="table-custom" id="tbl4">
                    <table id="dtg4" height="500" width="100%" title="Penerimaan Barang" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_bpb">No. BPB</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb" data-options="formatter:appGridDateFormatter">Tgl. BPB</th>
                                <th halign="center" align="left" width="12%" field="no_po">No. PO</th>
                                <th halign="center" align="left" width="12%" field="no_faktur_sup">No. Faktur</th>
                                <th halign="center" align="left" width="25%" field="partner_name">Supplier</th>
                                <th halign="center" align="right" width="13%" field="subtotal" data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                <th halign="center" align="right" width="10%" field="diskon_nota" data-options="formatter:appGridNumberFormatter">Diskon Nota (Rp)</th>
                                <th halign="center" align="right" width="10%" field="tot_ppn" data-options="formatter:appGridNumberFormatter">PPN (Rp)</th>
                                <th halign="center" align="right" width="10%" field="biaya_lain" data-options="formatter:appGridNumberFormatter">Biaya Lain-Lain</th>
                                <th halign="center" align="right" width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="left" width="25%" field="ket_bpb">Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="center" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Penerimaan Barang -->

                <!--start Penerimaan Barang (Donasi) -->
                <div class="table-custom" id="tbl5">
                    <table id="dtg5" height="500" width="100%" title="Penerimaan Barang (Donasi)" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_bpb">No. BPB Donasi</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb" data-options="formatter:appGridDateFormatter">Tgl. BPB</th>
                                <th halign="center" align="left" width="25%" field="partner_name">Donatur</th>
                                <th halign="center" align="left" width="25%" field="ket_bpb">Keterangan</th>
                                <th halign="center" align="left"   width="10%" field="user_fullname" >User</th>
                                <th halign="center" align="center" width="13%" field="date_upd"  data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Penerimaan Barang (Donasi) -->

                <!--start Retur Pembelian -->
                <div class="table-custom" id="tbl6">
                    <table id="dtg6" height="500" width="100%" title="Retur Pembelian" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_rt_pb">No. Retur</th>
                                <th halign="center" align="center" width="12%" field="tgl_rt_pb" data-options="formatter:appGridDateFormatter">Tgl. Retur</th>
                                <th halign="center" align="left" width="15%" field="partner_name">Supplier</th>
                                <th halign="center" align="left" width="15%" field="status_barang">Status Barang</th>
                                <th halign="center" align="left" width="12%" field="jns_retur">Jenis Retur</th>
                                <th halign="center" align="right" width="10%" field="subtotal" data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                <th halign="center" align="right"  width="10%" field="tot_diskon" data-options="formatter:appGridNumberFormatter">Diskon (Rp)</th>
                                <th halign="center" align="right" width="10%" field="tot_ppn">PPN (Rp)</th>
                                <th halign="center" align="right" width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="left" width="20%" field="catatan">Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="center" width="10%" field="status_caption">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Retur Pembelian -->

                <!--start Pengganti Retur-->
                <div class="table-custom" id="tbl7">
                    <table id="dtg7" height="500" width="100%" title="Pengganti Retur" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_bpb">No. BPB</th>
                                <th halign="center" align="center" width="12%" field="tgl_bpb" data-options="formatter:appGridDateFormatter">Tgl. BPB</th>
                                <th halign="center" align="left" width="12%" field="no_rt_pb">No. Retur</th>
                                <th halign="center" align="left" width="25%" field="partner_name">Supplier</th>
                                <th halign="center" align="right" width="13%" field="subtotal" data-options="formatter:appGridNumberFormatter">Sub Total</th>
                                <th halign="center" align="right" width="10%" field="diskon_nota" data-options="formatter:appGridNumberFormatter">Diskon Nota (Rp)</th>
                                <th halign="center" align="right" width="10%" field="tot_ppn" data-options="formatter:appGridNumberFormatter">PPN (Rp)</th>
                                <th halign="center" align="right" width="10%" field="biaya_lain" data-options="formatter:appGridNumberFormatter">Biaya Lain-Lain</th>
                                <th halign="center" align="right" width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="left" width="25%" field="ket_bpb">Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="center" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="12%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Pengganti Retur -->

                <!--start Permintaan Mutasi -->
                <div class="table-custom" id="tbl8">
                    <table id="dtg8" height="500" width="100%" title="Permintaan Mutasi" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_pm">No. Permintaan</th>
                                <th halign="center" align="center" width="12%" field="tgl_pm" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                <th halign="center" align="left" width="15%" field="unit_asal">Permintaan Dari</th>
                                <th halign="center" align="left" width="15%" field="unit_tujuan">Tujuan Permintaan</th>
                                <th halign="center" align="left" width="25%" field="ket_pm">Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="center" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Permintaan Mutasi -->

                <!--start Mutasi Ruangan-->
                <div class="table-custom" id="tbl9">
                    <table id="dtg9" height="500" width="100%" title="Mutasi Ruangan" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_mutasi">No. Mutasi</th>
                                <th halign="center" align="center" width="12%" field="tgl_mutasi" data-options="formatter:appGridDateFormatter">Tgl. Mutasi</th>
                                <th halign="center" align="left" width="20%" field="unit_asal">Unit Asal</th>
                                <th halign="center" align="left" width="20%" field="unit_tujuan">Unit Tujuan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="left" width="20%" field="ket_mutasi" >Keterangan</th>
                                <th halign="center" align="center" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Mutasi Ruangan-->

                <!--start Retur Mutasi Ruangan-->
                <div class="table-custom" id="tbl10">
                    <table id="dtg10" height="500" width="100%" title="Retur Mutasi Ruangan" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_rt_mutasi">No. Retur</th>
                                <th halign="center" align="center" width="12%" field="tgl_rt_mutasi" data-options="formatter:appGridDateFormatter">Tgl. Retur</th>
                                <th halign="center" align="left" width="20%" field="unit_asal">Unit Asal</th>
                                <th halign="center" align="left" width="20%" field="unit_tujuan">Unit Tujuan</th>
                                <th halign="center" align="left" width="20%" field="ket_rt_mutasi" >Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="center" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Retur Mutasi Ruangan-->

                <!--start Depo Retur (ED)-->
                <div class="table-custom" id="tbl11">
                    <table id="dtg11" height="500" width="100%" title="Depo Retur (ED)" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_rt_mutasi">No. Retur</th>
                                <th halign="center" align="center" width="12%" field="tgl_rt_mutasi" data-options="formatter:appGridDateFormatter">Tgl. Retur</th>
                                <th halign="center" align="left" width="20%" field="unit_asal">Unit Asal</th>
                                <th halign="center" align="left" width="20%" field="unit_tujuan">Unit Tujuan</th>
                                <th halign="center" align="left" width="20%" field="ket_rt_mutasi" >Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="center" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Depo Retur (ED)-->

                <!--start Permintaan ROP -->
                <div class="table-custom" id="tbl12">
                    <table id="dtg12" height="500" width="100%" title="Permintaan ROP" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_pp">No. Permintaan</th>
                                <th halign="center" align="center" width="12%" field="tgl_pp" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                                <th halign="center" align="left" width="15%" field="nama_depo">Permintaan Dari</th>
                                <th halign="center" align="left" width="25%" field="ket_pp">Keterangan</th>
                                <th halign="center" align="center" width="10%" field="status_caption">Status</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="center" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="center" width="12%" field="date_upd" data-options="formatter:appGridDateTimeFormatter">Tgl. Update</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Permintaan ROP -->
                <div id="mm" class="easyui-menu">
                    <div id="div-msg_posting" onclick="proses(this)" data-value ='1'>haha</div>
                    <div id="div-msg_batal" onclick="proses(this)" data-value ='1'>wkwk</div>
                </div>
            </div>
        </div>
    </div>
</div>