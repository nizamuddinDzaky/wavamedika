<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Supplier </h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Master </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Supplier</a>
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
                <div class="kt-form col-lg-12 header-form kt-margin-t-25" id="frm-header">
                    <div class="form-group row">
                        <div class="col-lg-1 col-md-2 col-sm-12">
                            <label class="col-form-label form-control-sm">Status :</label>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12">
                            <select name="status" class="form-control form-control-sm" id="cmb-status">
                                <option value="0">All</option>
                                <option value="1">Aktif</option>
                                <option value="2">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-1 col-md-2 col-sm-12">
                            <label class="col-form-label form-control-sm">Kriteria :</label>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 kt-margin-t-10-mobile">
                            <input class="form-control form-control-sm" type="text" id="txt-kriteria" placeholder="Cari...">
                        </div>
                        <div class="col-lg-1 col-md-2 col-sm-12 kt-margin-t-10-mobile">
                            <button id="btn-filter" class="easyui-linkbutton btn-primary" plain="true">
                                <i class="la la-filter">Filter</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dtg-daftar_supplier" title="Daftar Supplier" class="easyui-datagrid" style="width: 100%;height:480px; margin-top:5px" toolbar="#toolbar" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
                        <thead>
                            <tr>
                                <th halign="center" field="partner_id" width="100" >Kode</th>
                                <th halign="center" field="partner_name" width="300" >Nama Supplier</th>
                                <th halign="center" field="partner_address" width="300" >Alamat</th>  
                                <th halign="center" align="center" field="partner_phone" width="145" >No. Telepon</th>
                                <th halign="center" align="center" field="is_active" width="110" >Status</th>
                                <th halign="center" align="center" field="user_ins" width="120" >Dibuat Oleh</th>
                                <th halign="center" align="center" field="date_ins" width="120" data-options="formatter:appGridDateTimeFormatter">Tgl. Dibuat</th>
                                <th halign="center" align="center" field="user_upd" width="120" >Diubah Oleh</th>
                                <th halign="center" align="center" field="date_upd" width="120" data-options="formatter:appGridDateTimeFormatter">Tgl. Diubah</th>
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

    <div id="win-data_supplier" class="panel-window" data-title="Data Supplier" style="width: 60%; height: 80%">
        <div class="kt-portlet-win">
            <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="frm-detail">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Kode :</label>
                        <div class="col-lg-4 col-sm-12">
                            <input class="form-control form-control-sm" type="text" disabled="true" id="txt-kode">
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <input name="chk-is_active" type="checkbox" id="chk-is_active">
                            aktif
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Nama Supplier :</label>
                        <div class="col-lg-4 col-sm-12">
                            <input class="form-control form-control-sm" type="text" id="txt-partner_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Alamat :</label>
                        <div class="col-lg-4 col-sm-12">
                            <textarea class="form-control form-control-sm kt-font-sm" style="resize: none;" id="txt-partner_address"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">No. Telepon :</label>
                        <div class="col-lg-4 col-sm-12">

                            <input class="form-control form-control-sm" type="text" id="txt-partner_phone">
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">No. Fax :</label>
                        <div class="col-lg-4 col-sm-12">

                            <input class="form-control form-control-sm" type="text" id="txt-partner_fax">
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Website :</label>
                        <div class="col-lg-4 col-sm-12">
                            <input class="form-control form-control-sm" type="text" id="txt-website">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-lg-4">
                            <label class="col-form-label col-lg-12 col-sm-12 form-control-sm kt-font-sm"><b>Contact Person :</b></label>
                        </div>
                    </div>
                    <div class="col-lg-6" style="border: 1px solid black;">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">Nama :</label>
                            <div class="col-lg-8 col-sm-12">
                                <input class="form-control form-control-sm" type="text" id="txt-contact_person">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">No. Telepon :</label>
                            <div class="col-lg-8 col-sm-12">
                                <input class="form-control form-control-sm" type="text" id="txt-contact_person_phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">Email :</label>
                            <div class="col-lg-8 col-sm-12">
                                <input class="form-control form-control-sm" type="text" id="txt-email">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-4">
                    <div class="form-group row" style="margin-top: 10px; margin-left: 2px;">
                        <div class="col-lg-5 col-md-4 col-sm-12 kt-padding" id="div-simpan">
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
