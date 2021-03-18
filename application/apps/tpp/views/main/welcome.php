<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Jurnal Memorial </h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Akutansi </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Transaksi </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Jurnal Memorial </a>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a id="export-pdf" target="_blank" class="btn kt-subheader__btn-secondary">
                    Export PDF
                </a>
                <a id="print" class="btn kt-subheader__btn-secondary">
                    Print
                </a>
<!--                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="" data-placement="top" data-original-title="Quick actions">-->
<!--                    <a href="#" class="btn btn-danger kt-subheader__btn-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                        Print-->
<!--                    </a>-->
<!--                    <div class="dropdown-menu dropdown-menu-right">-->
<!--                        <a class="dropdown-item" href="#"><i class="la la-plus"></i> New Product</a>-->
<!--                        <a class="dropdown-item" href="#"><i class="la la-user"></i> New Order</a>-->
<!--                        <a class="dropdown-item" href="#"><i class="la la-cloud-download"></i> New Download</a>-->
<!--                        <div class="dropdown-divider"></div>-->
<!--                        <a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>-->
<!--                    </div>-->
<!--                </div>-->
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
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Start Date:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" name="dateStart" type="date-only-formatted"  id="start-date-input">
                        </div>

                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">End Date:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" name="dateEnd" type="date-only-formatted"  id="end-date-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Kriteria:</label>
                        <div class="col-lg-2 col-sm-12">
                            <select name="kriteria" class="select2 form-control form-control-sm" id="select2_1">
                                <option value="">Semua Kriteria</option>
                                <option value="no_jurnal">No Jurnal</option>
                                <option value="keterangan">Keterangan</option>
                                <option value="other">Kriteria Lain</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Pencarian:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input name="searchText" class="form-control form-control-sm" type="text" id="kriteria_lain" placeholder="Cari...">
                        </div>
                        <div class="col-lg-1 col-sm-12 kt-margin-t-20-mobile">
                            <button
                                    type="submit"
                                    class="form-control form-control-sm btn btn-sm btn-primary">
                                <i class="la la-filter"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dg"
                           height="500"
                           title="Daftar Jurnal Memorial"
                           class="easyui-datagrid"
                           url="Welcome/getUser"
                           toolbar="#toolbar"
                           pagination="true"
                           rownumbers="true"
                           singleSelect="true"
                    >
                        <thead>
                        <tr>
                            <th field="firstname" >First Name</th>
                            <th field="lastname" >Last Name</th>
                            <th field="phone" >Phone</th>
                            <th field="email" >Email</th>
                            <th field="firstname" >First Name</th>
                            <th field="lastname" >Last Name</th>
                            <th field="phone" >Phone</th>
                            <th field="email" >Email</th>
                            <th field="firstname" >First Name</th>
                            <th field="lastname" >Last Name</th>
                            <th field="phone" >Phone</th>
                            <th field="email" >Email</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>

                        </tr>
                        </tfoot>
                    </table>
                    <div id="toolbar">
                        <a href="javascript:void(0)" id="tambah" class="easyui-linkbutton" plain="true">
                            <i class="la la-plus"></i>
                            Tambah
                        </a>
                        <a href="javascript:void(0)" id="hapus" class="easyui-linkbutton" plain="true">
                            <i class="flaticon2-trash"></i>
                            Hapus
                        </a>
                        <a href="javascript:void(0)" id="edit" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
                            Edit
                        </a>
                        <a href="javascript:void(0)" id="view" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
                            View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="win" class="panel-window" data-title="Daftar Jurnal Memorial">
        <div class="kt-portlet">
            <div class="kt-portlet__body header-form">
                <form class="kt-form col-lg-12 header-form" id="form-detail">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">No. Jurnal:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" type="text" value="JM19100012" disabled="true">
                        </div>

                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Tanggal:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" type="date"  id="end-date-input">
                        </div>

                        <div class="col-lg-2 col-sm-12 kt-margin-t-20-mobile">
                            <button class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-plus"></i>
                                Template
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Keterangan:</label>
                        <div class="col-lg-2 col-sm-12">
                            <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;">Keterangan Text Area</textarea>
                        </div>

                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Upload:</label>
                        <div class="col-lg-2 col-sm-12 ">
                            <div class="form-control form-control-sm kt-font-sm custom-file">
                                <input class="custom-file-input kt-font-sm" type="file" name="fileDocument">
                                <label class="custom-file-label kt-font-sm"> Choose File</label>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-12 kt-margin-t-20-mobile">
                            <button class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-check"></i>
                                Import
                            </button>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">Status:</label>
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm kt-font-bold">Open</label>
                        <div class="col-lg-2 col-sm-12 kt-margin-t-20-mobile">
                            <button class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-check"></i>
                                Verifikasi
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">User Input:</label>
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm kt-font-bold">Administrator</label>
<!--                        <label class="col-form-label col-lg-1"></label>-->
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm kt-align-right-desktop">User Verifikasi:</label>
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm kt-font-bold">Administrator</label>
                    </div>

                    <div class="row">
                        <div class="col-12 table-detail">
                            <table id="dgDetailJurnalMemorial"
                                   height="350"
                                   title="Detail Jurnal Memorial"
                                   class="easyui-datagrid"
                                   url="Welcome/getUser"
                                   toolbar="#toolbarDetailJurnalMemorial"
                                   pagination="true"
                                   rownumbers="true"
                                   singleSelect="true"
                            >
                                <thead>
                                <tr>
                                    <th field="firstname" >First Name</th>
                                    <th field="lastname" >Last Name</th>
                                    <th field="phone" >Phone</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>

                                </tr>
                                </tfoot>
                            </table>
                            <div id="toolbarDetailJurnalMemorial">
                                <a href="javascript:void(0)" id="tambah" class="easyui-linkbutton" plain="true">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet__foot">
                <div class="row">
                    <div class="col-lg-2">
                        <button id="simpan"
                                type="submit"
                                class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                            <i class="la la-save"></i>
                            Simpan
                        </button>
                    </div>
                    <div class="col-lg-2 kt-padding-t-10-mobile">
                        <button class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                            <i class="la la-times"></i>
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content -->