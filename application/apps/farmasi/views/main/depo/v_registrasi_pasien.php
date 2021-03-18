<!-- begin:: Subheader -->
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Data Registrasi Pasien</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home">
                    <i class="flaticon2-shelter"></i>
                </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Depo Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Registrasi Pasien</a>
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
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Perawatan :</label>
                                <div class="col-lg-3 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <select name="cmb-perawatan" id="cmb-perawatan" class="form-control form-control-sm">
                                        <option value="1">All</option>
                                        <option value="2">Rawat Inap</option>
                                        <option value="3">Rawat Jalan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                 <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                <div class="col-lg-5 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                    <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria" placeholder="Cari..." required>
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
                                    <!-- <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="tambah()">
                                        <i class="la la-plus"></i>
                                        Tambah Penerimaan Donasi
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-registrasi_pasien" height="500" width="100%" title="Daftar Registrasi Pasien" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true">
                        <!--  -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>