<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Jenis Persalinan</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Jenis Persalinan</a>
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
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Kriteria :</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" type="text" id="txt-kriteria">
                        </div>
                        <div class="col-lg-1 col-sm-12 kt-margin-t-20-mobile">
                            <button id="btn-filter" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="filter()">
                                <i class="la la-filter"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-jenis" role="tab" data-toggle="tab" onclick="tab(1);">Persalinan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-komplikasi" role="tab" data-toggle="tab" onclick="tab(2);">Komplikasi Persalinan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-jenis_sc" role="tab" data-toggle="tab" onclick="tab(3);">Sectio Caesarea</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade show active" id="tab-jenis">
                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                            <table id="dtg-jenis" class="easyui-datagrid" style="width: 100%;height:490px;" toolbar="#toolbar1" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                
                            </table>
                                <div id="toolbar1">
                                <a href="javascript:void(0)" id="btn-tambah" class="easyui-linkbutton btn-tambah" plain="true" onclick="btn_tambah()">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                                <a href="javascript:void(0)" id="btn-ubah" class="easyui-linkbutton btn-ubah" plain="true" onclick="btn_ubah()">
                                    <i class="flaticon-edit-1"></i>
                                    Ubah
                                </a>
                                <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton btn-hapus" plain="true" onclick="btn_hapus()">
                                    <i class="flaticon2-trash"></i>
                                    Hapus
                                </a>
                                <a href="javascript:void(0)" id="btn-simpan" class="easyui-linkbutton btn-simpan" plain="true" onclick="btn_simpan()">
                                    <i class="la la-save"></i>
                                    Simpan
                                </a>
                                <a href="javascript:void(0)" id="btn-batal" class="easyui-linkbutton btn-batal" plain="true" onclick="btn_batal()">
                                    <i class="la la-close"></i>
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade show active" id="tab-komplikasi">
                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                            <table id="dtg-komplikasi" class="easyui-datagrid" style="width: 100%;height:470px;" toolbar="#toolbar2" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                
                            </table>
                                <div id="toolbar2">
                                <a href="javascript:void(0)" id="btn-tambah" class="easyui-linkbutton btn-tambah" plain="true" onclick="btn_tambah()">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                                <a href="javascript:void(0)" id="btn-ubah" class="easyui-linkbutton btn-ubah" plain="true" onclick="btn_ubah()">
                                    <i class="flaticon-edit-1"></i>
                                    Ubah
                                </a>
                                <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton btn-hapus" plain="true" onclick="btn_hapus()">
                                    <i class="flaticon2-trash"></i>
                                    Hapus
                                </a>
                                <a href="javascript:void(0)" id="btn-simpan" class="easyui-linkbutton btn-simpan" plain="true" onclick="btn_simpan()">
                                    <i class="la la-save"></i>
                                    Simpan
                                </a>
                                <a href="javascript:void(0)" id="btn-batal" class="easyui-linkbutton btn-batal" plain="true" onclick="btn_batal()">
                                    <i class="la la-close"></i>
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade show active" id="tab-jenis_sc">
                        <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                            <table id="dtg-jenis_sc" class="easyui-datagrid" style="width: 100%;height:470px;" toolbar="#toolbar3" pagination="false" idField="id" rownumbers="false" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                                
                            </table>
                                <div id="toolbar3">
                                <a href="javascript:void(0)" id="btn-tambah" class="easyui-linkbutton btn-tambah" plain="true" onclick="btn_tambah()">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                                <a href="javascript:void(0)" id="btn-ubah" class="easyui-linkbutton btn-ubah" plain="true" onclick="btn_ubah()">
                                    <i class="flaticon-edit-1"></i>
                                    Ubah
                                </a>
                                <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton btn-hapus" plain="true" onclick="btn_hapus()">
                                    <i class="flaticon2-trash"></i>
                                    Hapus
                                </a>
                                <a href="javascript:void(0)" id="btn-simpan" class="easyui-linkbutton btn-simpan" plain="true" onclick="btn_simpan()">
                                    <i class="la la-save"></i>
                                    Simpan
                                </a>
                                <a href="javascript:void(0)" id="btn-batal" class="easyui-linkbutton btn-batal" plain="true" onclick="btn_batal()">
                                    <i class="la la-close"></i>
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- end content