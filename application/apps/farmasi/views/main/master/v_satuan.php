<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Satuan </h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Master </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Satuan</a>
            </div>
        </div>
    </div>
</div>

<!-- end:: Subheader -->

<!-- begin:: Content -->
<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
    <section class="content" id="width-sensor-tab">
        <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
            <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
                <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header">
                        <div class="form-group row">
                            <div class="col-lg-1 col-md-2 col-sm-12">
                                <label class="col-form-label form-control-sm">Jenis:</label>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <select class="form-control form-control-sm" id="cmb-jenis">
                                    <option value="0">All</option>
                                    <option value="1">Satuan</option>
                                    <option value="2">Sediaan</option>
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-2 col-sm-12">
                                <label class="col-form-label form-control-sm">Status:</label>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <select class="form-control form-control-sm" id="cmb-status">
                                    <option value="0">All</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Non Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-1 col-md-2 col-sm-12">
                                <label class="col-form-label form-control-sm">Kriteria:</label>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                                <input class="form-control form-control-sm" type="text" id="txt-kriteria" placeholder="Cari...">
                            </div>
                            <div class="col-lg-1 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                                <!-- <button class="easyui-linkbutton btn-primary" plain="true" id="btn-filter">
                                    <i class="la la-filter"></i>
                                    Filter
                                </button> -->
                                <a href="#" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter()">
                                    <i class="la la-filter"></i> Filter
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="table-custom">
                        <table id="dtg-satuan" height="400" width="100%" title="Daftar Satuan" class="easyui-datagrid" toolbar="#toolbar" pagination="true" rownumbers="true" singleSelect="true">
                            <thead>
                            <tr>
                                <th halign="center" field="id_satuan" width="20%" >Kode</th>
                                <th halign="center" field="nama_satuan" width="20%" >Satuan</th>
                                <th halign="center" field="ket_jenis" width="20%" >Jenis</th>
                                <th halign="center" field="is_aktif" width="20%" >Status</th>
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
    </section>

    <div id="win-detail" class="panel-window" data-title="Data Satuan" style="width: 40%; height: 54%" closed="true">
        <div class="kt-portlet">
            <div class="kt-portlet__body header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Kode :</label>
                        <div class="col-lg-4 col-sm-12">
                            <input class="form-control form-control-sm" type="text" id="txt-id_satuan">
                        </div> 
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Jenis :</label>
                        <div class="col-lg-4 col-sm-12">
                            <select class="form-control form-control-sm" id="cmb-jns_satuan">
                                <option value="1">Satuan</option>
                                <option value="2">Sediaan</option>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Satuan :</label>
                        <div class="col-lg-4 col-sm-12">
                            <input class="form-control form-control-sm" type="text" id="txt-ket_jenis">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Status:</label>
                        <div class="col-lg-4 col-sm-12">
                            <input class="" type="checkbox" id="chk-is_aktif" name="chk-is_aktif">
                        </div> 
                    </div>
                </form>
                
                <div class="form-group row" style="margin-top: 15px">
                    <div class="col-lg-3 col-sm-12" id="div-simpan">
                        <button id="btn-simpan" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                            <i class="la la-save"></i>
                            Simpan
                        </button>
                    </div>
                    <div class="col-lg-3 col-sm-12 kt-padding-t-10-mobile">
                        <button id="btn-batal" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                            <i class="la la-times"></i>
                            Batal
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end content