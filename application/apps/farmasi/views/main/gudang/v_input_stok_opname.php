<!-- begin:: Subheader -->
<!-- end:: Subheader -->
<!-- begin:: Content -->
<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
    <div id="win-so" class="panel-window" data-title="Stok Opname" style="width: 80%; height: 80%;">
        <div id="browse">
            <div class="form-group row" style="background-color: #0F9E98; width: 102%;">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 kt-padding" id="div_simpan">
                    <button onclick="tutup();" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-btn-custom kt-font-sm" style="margin-left: 10px;">
                        <i class="la la-times"></i>
                        Tutup
                    </button>
                </div>
                <label class="col-form-label col-lg-6 col-md-3 col-sm-6 col-xs-8 form-control-sm kt-font-sm" align="center" style="color: white; margin-top: 5px;"><b>Pilih Lokasi</b></label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 kt-padding">
                    <button onclick="tab(1)" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-btn-custom kt-font-sm">
                        <i class="la la-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__body header-form">
                    <form class="kt-form col-lg-12" id="form-detail">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-1 col-sm-12 col-xs-8 form-control-sm kt-font-sm">
                                Depo :
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <select name="" id="cmb-depo" class="select2 form-control form-control-sm"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                No. SO :
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input id="txt-no_so" class="form-control form-control-sm" type="text" disabled="true">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-1 col-sm-12 col-xs-8 form-control-sm kt-font-sm">
                                Rak :
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <select name="" id="cmb-rak" class="select2 form-control form-control-sm"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                PJ Rak :
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input id="txt-pj_rak" class="form-control form-control-sm" type="text" disabled="true">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="detail1">
            <div class="form-group row" style="background-color: #0F9E98; width: 102%;">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 kt-padding" id="div_simpan">
                    <button onclick="tab(0)" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-btn-custom kt-font-sm" style="margin-left: 10px;">
                        <i class="la la-arrow-left"></i>
                    </button>
                </div>
                <label class="col-form-label col-lg-6 col-md-3 col-sm-6 col-xs-8 form-control-sm" align="center" style="color: white; margin-top: 5px;"><b>Daftar Barang</b></label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 kt-padding">
                    <button onclick="tutup();" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-btn-custom kt-font-sm">
                        <i class="la la-times"></i>
                        Tutup
                    </button>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__body_custom header-form">
                    <form class="kt-form col-lg-12" id="form-detail">
                        <div class="form-group row">
                            <label id="label-daftar_barang" class="col-form-label col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control-sm kt-font-bold" align="center" style="color: black; background-color: #54c3ff;"></label>
                        </div>
                        <div class="form-group">
                            <label class="kt-checkbox--success form-control-sm kt-font-sm col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input id="chk-is_aktif" name="chk-is_aktif" type="checkbox"> Tampilkan Semua
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input id="txt-search" class="form-control form-control-sm" type="text" placeholder="Search">
                            </div>
                        </div>
                        <div class="form-group table-detail col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="dtg-nama_item" class="easyui-datagrid" style="width: 100%;height:500px;" idField="id" fitColumns="true" singleSelect="true" autoRowHeight="true" nowrap="false">
                                <thead>
                                    <tr>
                                        <th field="nama_item" halign="center" align="left" width="100%">Nama Item</th>
                                        <th field="id_item" halign="center" align="left" width="100%" hidden></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="form-group row">
                            <label id="label-selesai" class="col-form-label col-lg-6 col-md-6 col-sm-6 col-xs-6 form-control-sm kt-font-sm kt-font-bold" align="left"><b>Item Selesai : 10</b></label>
                            <label id="label-sisa" class="col-form-label col-lg-6 col-md-6 col-sm-6 col-xs-6 form-control-sm kt-font-sm kt-font-bold" align="right"><b>Item Sisa : 5</b></label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="detail2">
            <div class="form-group row" style="background-color: #0F9E98; width: 102%;">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 kt-padding">
                    <button onclick="tab(1)" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-btn-custom kt-font-sm" style="margin-left: 10px;">
                        <i class="la la-arrow-left"></i>
                    </button>
                </div>
                <label class="col-form-label col-lg-6 col-md-3 col-sm-6 col-xs-8 form-control-sm kt-font-sm" align="center" style="color: white; margin-top: 5px;"><b>Input Stok Opname</b></label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 kt-padding" id="div_simpan">
                    <button id="btn-centang" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-btn-custom kt-font-sm" onclick="simpan()">
                        <i class="la la-check"></i>
                    </button>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__body_custom header-form">
                    <form class="kt-form col-lg-12" id="form-detail">
                        <div class="form-group row" style="background-color: #54c3ff;">
                            <!-- <div id="label-obat" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control-sm kt-font-sm kt-font-bold" align="center"></div>
                            <div id="label-kode" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control-sm kt-font-sm kt-font-bold" align="center">Kode : 01002</div>
                            <div id="label-kelompok" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control-sm kt-font-sm kt-font-bold" align="center">Kelompok : Alkes</div> -->
                            <label id="label-obat" class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control-sm kt-font-sm kt-font-bold" align="center" style="height: 13px"><b></b></label>
                            <label id="label-kode" class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control-sm kt-font-sm kt-font-bold" align="center" style="height: 13px"><b>Kode : 01002</b></label>
                            <label id="label-kelompok" class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control-sm kt-font-sm kt-font-bold" align="center" style="height: 13px"><b>Kelompok : Alkes</b></label>
                            <label id="label-satuan" class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 form-control-sm kt-font-sm kt-font-bold" align="center" style="height: 13px; margin-bottom: 15px;"><b>Satuan : </b></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                Stok Sistem :
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input id="txt-stok_sistem" class="form-control form-control-sm easyui-numberbox" type="number" disabled="true">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                Stok Fisik :
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input id="txt-stok_fisik" class="form-control form-control-sm easyui-numberbox" type="number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-1 col-sm-12 form-control-sm kt-font-sm">
                                Selisih :
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <input id="txt-selisih" class="form-control form-control-sm easyui-numberbox" type="text" disabled="true">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 col-xs-8 form-control-sm kt-font-sm">
                                Keterangan Selisih :
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <select name="" id="cmb-alasan" class="select2 form-control form-control-sm"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">
                                Catatan :
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <textarea class="form-control form-control-sm kt-font-sm" style="resize: none; height: 100px;" id="txt-ket"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content-->