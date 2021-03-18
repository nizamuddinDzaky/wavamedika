<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Kelas Terapi</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Klasifikasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Kelas Terapi</a>
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
                                <option value="1" selected>Aktif</option>
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
                            <button type="button" plain="true" class="easyui-linkbutton btn-primary" onclick="filter()">
                                <i class="la la-filter"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-kelas_terapi" style="width: 100%;height:480px; margin-top:5px" title="Daftar Kelas Terapi" class="easyui-datagrid" toolbar="#toolbar" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                        
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
    <div id="win-kelas_terapi" class="panel-window" data-title="Tambah Kelas Terapi" style="width: 35%; height: 38%;">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Kode :
                        </label>
                        <div class="col-lg-4 col-sm-12">
                            <input id="txt-kode" class="form-control form-control-sm" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                            Kelas Terapi :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-kelas_terapi" class="form-control form-control-sm" type="text">
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm" style="margin-right: 10px;">
                            Status :
                        </label>
                        <div class="form-group row">
                            <div class="col-lg-2 col-sm-12" style="margin-top: 7px">
                                <input name="chk-is_aktif" type="checkbox" id="chk-is_aktif">
                            </div>
                            <label class="form-control-sm kt-font-sm">Aktif</label>
                        </div>
                    </div>
                </form>
                <div class="col-lg-7">
                    <div class="form-group row" style="margin-top: 0px; margin-left: 2px;">
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
            </div>
        </div>
    </div>
</div>
<!-- end content