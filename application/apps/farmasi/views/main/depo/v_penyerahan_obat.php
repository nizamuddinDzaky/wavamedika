<!-- begin:: Subheader -->
<!-- <div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Penyerahan Obat <a href="javasript:void(0)" id="btn-pilih-unit" onclick="show_popup_depo()"> (Pilih Depo)</a></h3>
            <input type="hidden" name="" id="txt-id-depo">
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Pelayanan Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Penyerahan Obat</a>
            </div>
        </div>
    </div>
</div> -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container" style="padding-right: 1px;">
        <div class="row col-lg-12 justify-content-between">
            <div class="col-lg-auto">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Penyerahan Obat</h3>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home">
                            <i class="flaticon2-shelter"></i>
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Pelayanan Farmasi</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">Penyerahan Obat</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-auto justify-content-end">
                <div class="kt-subheader__main" style="margin-top: 2%;">
                    <h3 class="kt-subheader__title" id="btn-pilih-unit" onclick="show_popup_depo()">(Pilih Depo)</h3>
                    <!-- <a href="javasript:void(0)" id="btn-pilih-unit" onclick="show_popup_depo()"> (Pilih Depo)</a> -->
                    <input type="hidden" name="" id="txt-id-depo">
                </div>
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
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm" style="height: 550px;">
                <form class="kt-form col-lg-12 header-form" id="form-header">
                    <div class="row" id="tabs-detail" style="height: 400px; max-height: 400px; margin-top: 15px;">
                        <div class="col-lg-12">
                            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab_1" role="tab" data-toggle="tab">Obat Belum Diserahkan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab_2" role="tab" data-toggle="tab">Obat Sudah Diserahkan</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active form-group row kt-container kt-container-form" id="tab_1">
                                        <!-- <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid"> -->
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm">
                                                            No. Resep :
                                                        </label>
                                                        <div class="col-lg-5 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-no_resep" placeholder="Cari..." required>
                                                        </div>
                                                        <div class="col-lg-4 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                                            <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="btn_ambil_obat()">
                                                                <i class="la la-check"></i>
                                                                Ambil Obat
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm" style="padding-right: 1px;">
                                                            Kriteria :
                                                        </label>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                                            <input name="searchText" class="form-control form-control-sm" type="text" placeholder="Cari..." required id="txt-criteria-belum-diserahkan">
                                                        </div>
                                                        <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                                            <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter_belum_diserahkan()">
                                                                <i class="la la-filter"></i>
                                                                Filter
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table id="dtg-belum_diserahkan" class="easyui-datagrid" style="width: 100%;height:390px;" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false" toolbar="#toolbar1">
                                                <!--  -->
                                            </table>
                                        <!-- </div> -->
                                    </div>
                                    <div role="tabpane1" class="tab-pane fade active form-group row kt-container kt-container-form" id="tab_2">
                                        <!-- <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid"> -->
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Tanggal :</label>
                                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                                            <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-start_date">
                                                        </div>

                                                        <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm" style="padding-right: 1px;">s/d :</label> 
                                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                                            <input class="form-control form-control-sm dtb" type="date-only-formatted"  id="dtb-end_date">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                                        <div class="col-lg-7 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                                            <input class="form-control form-control-sm" type="text" id="txt-criteria" placeholder="Cari..." required>
                                                        </div>
                                                        <div class="col-lg-auto col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                                            <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter_sudah_diserahkan()">
                                                                <i class="la la-filter"></i>
                                                                Filter
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table id="dtg-sudah_diserahkan" class="easyui-datagrid" style="width: 100%;height:370px;"  pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false" toolbar="#toolbar2">
                                                <!--  -->
                                            </table>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="win-depo" class="panel-window" data-title="Pilih Unit" style="width: 30%; height: 58%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body header-form">
                <form class="kt-form col-lg-12 header-form" id="form-cari_nopp">
                    <div class="row">
                        <div class="col-12 table-detail">
                            <table id="dtg-pilih-depo" height="260" width="100%" class="easyui-datagrid" pagination="false" singleSelect="true" rownumbers="true" fitColumns="true">
                                <thead>
                                    <tr>
                                        <th field="id_unit" hidden="true">ID</th>
                                        <th halign="center" align="left" field="nama_unit" width="250">Nama Unit</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-7" style="margin-top: 10px; margin-left: -2px;">
                        <div class="form-group row">
                            <div class="col-lg-auto col-md-auto col-sm-12 kt-padding">
                                <button id="btn-pilih_unit" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_depo()">
                                    <i class="la la-check"></i>
                                    Pilih
                                </button>
                            </div>
                            <div class="col-lg-auto col-md-auto col-sm-12 kt-padding">
                                <button id="btn-batal_unit" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tutup_win_depo()">
                                    <i class="la la-times"></i>
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="win-pilih_nota" class="panel-window" style="height:90%; width: 75%;" data-title="Pilih Unit">
        <div class="kt-portlet">
            <div class="kt-portlet__body_win header-form">
                <div class="row">
                    <div class="col-12 table-detail">
                        <table id="dtg-pilih-nota"height="350" width="100%" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                            <thead>
                                <tr>
                                    <th field="no_nota" halign="center" align="left">No. Nota</th>
                                    <th field="no_resep" halign="center" align="left">No. Resep</th>
                                    <th field="tgl_nota" halign="center" align="left" data-options="formatter:appGridDateFormatter">Tanggal</th>
                                    <th field="trans_name" halign="center" align="left">Jenis Nota</th>
                                    <th field="no_mr" halign="center" align="left">No. MR</th>
                                    <th field="nama_pasien" halign="center" align="left">Nama Pasien</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="form-group row" style="margin-top: 10px;margin-left: 0px;margin-right: 0px;">
                    <div class="col-lg-auto col-md-auto col-sm-auto" style="padding:2px">
                        <button id="btn-pilih_barang" type="button"
                                class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="pilih_nota()">
                            <i class="la la-check"></i>
                            Pilih
                        </button>
                    </div>
                    <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                        <button id="btn-tutup_cari_dataitem" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tutup_win_nota()">
                            <i class="la la-times"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>