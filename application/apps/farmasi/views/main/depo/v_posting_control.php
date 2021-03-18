<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Posting Transaksi Depo</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Posting Control</a>
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
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Jenis :</label>
                                <div class="col-lg-7 col-md-4 col-sm-12">
                                    <select class="form-control form-control-sm change" id="cmb-jenis">
                                        <option value="1" selected>Nota Rawat Jalan</option>
                                        <option value="2">Bon Pemakaian Pasien</option>
                                        <option value="3">Retur Pemakaian Pasien</option>
                                        <option value="4">Nota Penjualan Bebas</option>
                                        <option value="5">Pemakaian Depo</option>
                                        <option value="6">Pemakaian Gas Medis</option>
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
                <!--start Nota Rawat Jalan-->
                <div class="table-custom" id="tbl1">
                    <table id="dtg1" height="500" width="100%" title="Nota Rawat Jalan" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="12%" field="no_nota">No. Nota</th>
                                <th halign="center" align="center" width="12%" field="tgl_nota" data-options="formatter:appGridDateFormatter">Tanggal</th>
                                <th halign="center" align="left" width="15%" field="jns_bayar">Status Pasien</th>
                                <th halign="center" align="left" width="12%" field="id_mrs">No. Billing</th>
                                <th halign="center" align="left" width="12%" field="no_mr">No. RM</th>
                                <th halign="center" align="left" width="25%" field="nama_pasien">Nama Pasien</th>
                                <th halign="center" align="left" width="25%" field="nama_dokter">Dokter</th>
                                <th halign="center" align="left" width="15%" field="nama_unit">Unit</th>
                                <th halign="center" align="right" width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="left" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Nota Rawat Jalan-->

                <!--start Bon Pemakaian Pasien-->
                <div class="table-custom" id="tbl2">
                    <table id="dtg2" height="500" width="100%" title="Bon Pemakaian Pasien" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="12%" field="no_nota">No. Nota</th>
                                <th halign="center" align="center" width="12%" field="tgl_nota" data-options="formatter:appGridDateFormatter">Tanggal</th>
                                <th halign="center" align="left" width="15%" field="jns_bayar">Status Pasien</th>
                                <th halign="center" align="left" width="12%" field="id_mrs">No. Billing</th>
                                <th halign="center" align="left" width="12%" field="no_mr">No. RM</th>
                                <th halign="center" align="left" width="25%" field="nama_pasien">Nama Pasien</th>
                                <th halign="center" align="left" width="25%" field="nama_dokter">Dokter</th>
                                <th halign="center" align="left" width="15%" field="nama_unit">Unit</th>
                                <th halign="center" align="right" width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="left" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Bon Pemakaian Pasien-->

                <!--start Retur Pemakaian Pasien-->
                <div class="table-custom" id="tbl3">
                    <table id="dtg3" height="500" width="100%" title="Retur Pemakaian Pasien" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_retur">No. Retur</th>
                                <th halign="center" align="center" width="12%" field="tgl_retur" data-options="formatter:appGridDateFormatter">Tgl. Retur</th>
                                <th halign="center" align="left" width="12%" field="id_mrs">No. Billing</th>
                                <th halign="center" align="left" width="15%" field="nama_unit">Unit</th>
                                <th halign="center" align="left" width="10%" field="no_">Kelas</th>
                                <th halign="center" align="left" width="12%" field="no_mr">No. RM</th>
                                <th halign="center" align="left" width="25%" field="nama_pasien">Nama Pasien</th>
                                <th halign="center" align="right" width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="left" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Retur Pemakaian Pasien-->

                <!--start Nota Penjualan Bebas-->
                <div class="table-custom" id="tbl4">
                    <table id="dtg4" height="500" width="100%" title="Nota Penjualan Bebas" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="12%" field="no_nota">No. Nota</th>
                                <th halign="center" align="center" width="12%" field="tgl_nota" data-options="formatter:appGridDateFormatter">Tanggal</th>
                                <th halign="center" align="left" width="15%" field="jns_bayar">Status Pasien</th>
                                <th halign="center" align="left" width="12%" field="id_mrs">No. Billing</th>
                                <th halign="center" align="left" width="12%" field="no_mr">No. RM</th>
                                <th halign="center" align="left" width="25%" field="nama_pasien">Nama Pasien</th>
                                <th halign="center" align="left" width="25%" field="nama_dokter">Dokter</th>
                                <th halign="center" align="left" width="15%" field="nama_unit">Unit</th>
                                <th halign="center" align="right" width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="left" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Nota Penjualan Bebas-->

                <!--start Pemakaian Depo-->
                <div class="table-custom" id="tbl5">
                    <table id="dtg5" height="500" width="100%" title="Pemakaian Depo" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="13%" field="no_mutasi">No. Pemakaian</th>
                                <th halign="center" align="center" width="12%" field="tgl_mutasi" data-options="formatter:appGridDateFormatter">Tanggal</th>
                                <th halign="center" align="left" width="17%" field="unit_asal">Asal</th>
                                <th halign="center" align="left" width="17%" field="unit_tujuan">Yang Memakai</th>
                                <th halign="center" align="right" width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
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
                <!--akhir Pemakaian Depo-->

                <!--start Pemakaian Gas Medis-->
                <div class="table-custom" id="tbl6">
                    <table id="dtg6" height="500" width="100%" title="Pemakaian Gas Medis" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" >
                        <thead>
                            <tr>
                                <th halign="center" align="left" width="12%" field="no_nota">No. Nota</th>
                                <th halign="center" align="center" width="12%" field="tgl_nota" data-options="formatter:appGridDateFormatter">Tanggal</th>
                                <th halign="center" align="left" width="15%" field="jns_bayar">Status Pasien</th>
                                <th halign="center" align="left" width="12%" field="id_mrs">No. Billing</th>
                                <th halign="center" align="left" width="12%" field="no_mr">No. RM</th>
                                <th halign="center" align="left" width="25%" field="nama_pasien">Nama Pasien</th>
                                <th halign="center" align="left" width="25%" field="nama_dokter">Dokter</th>
                                <th halign="center" align="left" width="15%" field="nama_unit">Unit</th>
                                <th halign="center" align="right" width="10%" field="total" data-options="formatter:appGridNumberFormatter">Total</th>
                                <th halign="center" align="center" width="9%" field="status_posting">Posted</th>
                                <th halign="center" align="center" width="9%" field="status_batal">Batal</th>
                                <th halign="center" align="left" width="10%" field="user_fullname">User</th>
                                <th halign="center" align="left" width="10%" field="msg_posting" hidden="true">User</th>
                                <th halign="center" align="left" width="10%" field="msg_batal" hidden="true">User</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!--akhir Pemakaian Gas Medis-->
                <div id="mm" class="easyui-menu">
                    <div id="div-msg_posting" onclick="proses(this)" data-value ='1'>haha</div>
                    <div id="div-msg_batal" onclick="proses(this)" data-value ='1'>wkwk</div>
                </div>
            </div>
        </div>
    </div>
</div>