<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Lokasi Rak</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Lokasi Rak</a>
            </div>
        </div>
        <!-- <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a id="export-pdf" target="_blank" class="btn kt-subheader__btn-secondary">
                    Export PDF
                </a>
                <a id="print" class="btn kt-subheader__btn-secondary">
                    Print
                </a>
            </div>
        </div> -->
    </div>
</div>
<!-- end:: Subheader -->
<!-- begin:: Content -->
<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Unit :</label>
                        <div class="col-lg-3 col-sm-12">
                            <select class="select2 form-control form-control-sm" id="cmb-unit">
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Kriteria :</label>
                        <div class="col-lg-3 col-sm-12">
                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria">
                        </div>
                        <div class="col-lg-1 col-sm-12 kt-margin-t-20-mobile">
                            <button id="btn-filter" type="button" class="form-control form-control-sm btn btn-sm btn-primary">
                                <i class="la la-filter"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dg" title="Daftar Lokasi Rak" class="easyui-datagrid" style="width: 100%;height:480px; margin-top:5px" toolbar="#toolbar" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                        <thead>
                            <tr>
                                <th field="id_lokasi" halign="center" align="center" width="10%">ID</th>
                                <th field="nama_lokasi" halign="center" align="left" width="20%">Nama Unit</th>
                                <th field="no_urut" halign="center" align="center" width="10%">No. Urut</th>
                                <th field="kd_lokasi" halign="center" align="center" width="10%">Kode</th>
                                <th field="nama_lokasi" halign="center" align="left" width="15%">Lokasi Rak</th>
                                <th field="nama" halign="center" align="left" width="20%">Petugas PIC</th>
                                <th field="user_ins" halign="center" align="center" width="12%">Dibuat Oleh</th>
                                <th field="date_ins" halign="center" align="center" width="12%" data-options="formatter:appGridDateTimeFormatter">Tgl. Dibuat</th>
                                <th field="user_upd" halign="center" align="center" width="12%">Diubah Oleh</th>
                                <th field="date_upd" halign="center" align="center" width="12%" data-options="formatter:appGridDateTimeFormatter">Tgl. Diubah</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="toolbar">
                        <a href="javascript:void(0)" id="btn-tambah" class="easyui-linkbutton" plain="true">
                            <i class="la la-plus"></i>
                            Tambah
                        </a>
                        <a href="javascript:void(0)" id="btn-ubah" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
                            Ubah
                        </a>
                        <a href="javascript:void(0)" id="btn-tampil" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
                            Tampil
                        </a>
                        <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton" plain="true">
                            <i class="flaticon2-trash"></i>
                            Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="win" class="panel-window" data-title="Tambah Lokasi Penyimpanan" style="width: 47%; height: 52%;">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                            ID :
                        </label>
                        <div class="col-lg-4 col-sm-12">
                            <input id="txt-id" class="form-control form-control-sm" type="text" name="dept" disabled="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                            Kode :
                        </label>
                        <div class="col-lg-4 col-sm-12">
                            <input id="txt-kode" class="form-control form-control-sm" type="text" name="dept">
                        </div>
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                            No. Urut :
                        </label>
                        <div class="col-lg-3 col-sm-12">
                            <input id="txt-no_urut" class="form-control form-control-sm" type="text" name="dept">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                            Nama Rak :
                        </label>
                        <div class="col-lg-9 col-sm-12">
                            <input id="txt-nama_rak" class="form-control form-control-sm" type="text" name="dept">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                            Unit :
                        </label>
                        <div class="col-lg-9 col-sm-12">
                            <!-- <input id="cmb-unit_detail" class="select2 form-control form-control-sm" name="dept"> -->
                            <select class="select2 form-control" id="cmb-unit_detail">

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                            PIC :
                        </label>
                        <div class="col-lg-9 col-sm-12">
                            <select class="select2 form-control" id="cmb-pic_detail">
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row" style="margin-top: 10%;">
                            <div class="col-lg-5 col-md-4 col-sm-12 kt-padding" id="div_simpan">
                                <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                    <i class="la la-save"></i>
                                    Simpan
                                </button>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-12 kt-padding">
                                <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
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
</div>
<!-- end content