<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Produsen</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Produsen</a>
            </div>
        </div>
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
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Status :</label>
                        <div class="col-lg-2 col-sm-12">
                            <select class="select form-control form-control-sm" id="cmb-status">
                                <option value="0">All</option>
                                <option value="1">Aktif</option>
                                <option value="2">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Kriteria :</label>
                        <div class="col-lg-2 col-sm-12">
                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-search">
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
                    <table id="dg" title="Daftar Produsen" class="easyui-datagrid" style="width: 100%;height:480px;" toolbar="#toolbar" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                        <thead>
                        <tr>
                            <th field="id_produsen" halign="center" align="left" width="15%">Kode</th>
                            <th field="nama_produsen" halign="center" align="left" width="30%">Produsen</th>
                            <th field="is_aktif" halign="center" align="center" width="10%">Status</th>
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
    <div id="win" class="panel-window" data-title="Tambah Produsen" style="width: 30%; height: 36%;">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12" id="form-detail">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Kode :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-kode" class="form-control form-control-sm" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Produsen :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-name_pro" class="form-control form-control-sm" type="text">
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Status :
                        </label>
                        <div class="form-group row">
                            <div class="col-lg-2 col-sm-12" style="margin-top: 4px; margin-left: 10px;">
                                <input name="chk-is_aktif" type="checkbox" id="chk-is_aktif">
                            </div>
                            <label class="form-control-sm kt-font-sm">Aktif</label>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group row" style="margin-top: 15px;">
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