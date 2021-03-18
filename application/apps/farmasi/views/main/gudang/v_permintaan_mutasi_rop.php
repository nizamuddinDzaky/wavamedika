<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Permintaan Mutasi ROP</h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Gudang Farmasi</a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Permintaan Mutasi ROP</a>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Status :</label>
                                        <div class="col-lg-3 col-sm-12">
                                            <select class="select form-control form-control-sm" id="cmb-status">
                                                <option value="0">All</option>
                                                <option value="1">Open</option>
                                                <option value="2">Release</option>
                                                <option value="3">Approve</option>
                                                <option value="4">Reject</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Tanggal :</label>
                                        <div class="col-lg-3 col-sm-12">
                                            <input class="form-control form-control-sm" type="date-only-formatted"  id="dtb-start_date">
                                        </div>

                                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm"> s/d :</label>
                                        <div class="col-lg-3 col-sm-12">
                                            <input class="form-control form-control-sm" type="date-only-formatted"  id="dtb-end_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Kriteria :</label>
                                        <div class="col-lg-7 col-sm-12">
                                            <input name="searchText" class="form-control form-control-sm" type="text" id="txt-kriteria" placeholder="Cari...">
                                        </div>
                                        <div class="col-lg-2 col-sm-12 kt-margin-t-20-mobile">
                                            <button type="button" class="easyui-linkbutton btn-primary" plain="true" id="btn-filter" onclick="filter()">
                                                <i class="la la-filter"></i>
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-auto">
                            <div class="form-group row">
                                <div class="col-lg-auto col-md-auto col-sm-auto">
                                    <button id="btn-tambah" type="button" class="form-control form-control-sm btn btn-sm btn-primary">
                                        <i class="la la-plus"></i>
                                        Tambah Permintaan Mutasi ROP
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="kt-portlet_body kt-portlet_body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-permintaan_mutasi_rop" height="450" width="100%" title="Daftar Permintaan Mutasi ROP" class="easyui-datagrid" toolbar="#toolbar" pagination="true" rownumbers="true" singleSelect="true">
                        <thead>
                        <tr>
                            <th halign="center" align="left" field="no_pm" width="13%" >No. Permintaan</th>
                            <th halign="center" align="center" field="tgl_pm" width="11%" data-options="formatter:appGridDateFormatter">Tgl. Permintaan</th>
                            <th halign="center" align="left" field="unit_asal" width="17%" >Unit Asal</th>
                            <th halign="center" align="left" field="unit_tujuan" width="17%" >Unit Tujuan</th>
                            <th halign="center" align="left" field="ket_pm" width="35%" >Catatan</th>
                            <th halign="center" align="left" field="status_caption" width="8%" >Status</th>
                            <th halign="center" align="left" field="created_by" width="10%" >Dibuat Oleh</th>
                            <th halign="center" align="center" field="date_ins" width="13%" data-options="formatter:appGridDateTimeFormatter">Tgl. Dibuat</th>
                            <th halign="center" align="left" field="updated_by" width="10%" >Diubah Oleh</th>
                            <th halign="center" align="center" field="date_upd" width="13%" data-options="formatter:appGridDateTimeFormatter">Tgl. Diubah</th>
                        </tr>
                        </thead>
                    </table>
                    <div id="toolbar">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile" id="detail">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header" style="">
                    <div class="row" style="border-bottom: 2px solid #D3D3D3; margin-bottom:10px">
                        <div class="col-lg-5">
                            <div class="form-group row" id="div_status" style="padding-top: 5px">
                                <label class="kt-font-bold col-lg-6 col-sm-12 form-control-sm kt-font" id="txt-label_no">
                                    No. Permintaan : 
                                </label>
                                <div style="border-left: 1px black solid; height: 12px; width: 5px; margin-top: 10px">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm" id="txt-label_status">
                                    Status : 
                                </label>
                                <div style="border-left: 1px black solid; height: 12px; width: 5px; margin-top: 10px">
                                </div>
                                <label class="kt-font-bold col-lg-auto col-sm-12 form-control-sm" id="txt-label_posted">
                                    
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group row justify-content-lg-between">
                                <div class="col-lg-auto kt-padding-t-10-mobile">
                                    <div class="form-group row" id="btn-aksi">
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-open" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('open',0)">
                                                <i class=""></i>
                                                Open
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-approve" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('approve',0)">
                                                <i class=""></i>
                                                Approve
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-release" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="status('release',0)">
                                                <i class=""></i>
                                                Release
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-auto kt-padding-t-10-mobile">
                                    <div class="form-group row">
                                        <div style="padding: 2px" class="col-lg-auto kt-padding-t-10-mobile">
                                            <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary" onclick="tab(0)">
                                                <i class="fas fa-angle-double-left"></i>
                                                Kembali
                                            </button>
                                        </div>
                                        <div style="padding: 2px" class="col-lg-auto div_simpan">
                                            <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="simpan()">
                                                <i class="la la-save"></i>
                                                Simpan
                                            </button>
                                        </div>  
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>  
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 0px">
                                    No. Permintaan :
                                </label>
                                <div class="col-lg-4">
                                    <div class="form-group row">
                                        <div class="col-lg-5 col-sm-12">
                                            <input id="txt-no_pm" class="form-control form-control-sm" type="text">
                                        </div>
                                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                            Tanggal 
                                        </label>
                                        <div class="col-lg-5 col-sm-12">
                                            <input id="dtb-tgl_pm" class="form-control form-control-sm" type="date-only-formatted">
                                        </div>  
                                    </div>
                                </div>
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm status_caption">Status:</label>
                                <div class="col-lg-2 col-sm-12 status_caption">
                                    <input class="form-control form-control-sm" type="text" id="txt-status_caption">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Unit Asal :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <select id="cmb-unit_asal" class="select2 form-control form-control-sm">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Unit Tujuan :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <select id="cmb-unit_tujuan" class="select2 form-control form-control-sm">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                    Catatan :
                                </label>
                                <div class="col-lg-4 col-sm-12">
                                    <textarea id="txt-desc" data-options="multiline:true" class="col-lg-12 form-control form-control-sm kt-font-sm" style="resize: none;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" title="Detail Item" style="margin-top: 10px;">
                        <div class="col-lg-12 table-detail">
                            <table id="dtg-detail" title="Detail Item" height="250" width="100%" class="easyui-datagrid" toolbar="#toolbarDetailItem" pagination="false" rownumbers="true" singleSelect="true">
                                
                            </table>
                            <div id="toolbarDetailItem">
                                <a href="javascript:void(0)" id="btn-tambah_detail_item" class="easyui-linkbutton div_simpan" plain="true">
                                    <i class="la la-plus"></i>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row" style="margin-top: 10px;margin-left: 0px;margin-right: 0px;">
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile kt-padding" id="div_simpan">
                            <button id="btn-simpan" type="button"
                                    class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan()">
                                <i class="la la-save"></i>
                                Simpan
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile kt-padding">
                            <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tab(0)">
                                <i class="la la-times"></i>
                                Batal
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile kt-padding" style="padding:2px">
                            <button id="btn-hapus" type="button"
                                    class="form-control form-control-sm btn btn-sm btn-danger kt-font-sm">
                                <i class="la la-trash"></i>
                                Hapus
                            </button>
                        </div>
                        <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                            <button id="btn-cetak" onclick="cetak();" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                <i class="la la-print"></i>
                                Cetak
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modal_preview" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="width: 100%">
            <div class="modal-content" style="width: 150%">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <iframe id="modal_preview_detail" name="modal_preview_detail" width="100%" height ="850px"></iframe>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- end content
No newline at end of file