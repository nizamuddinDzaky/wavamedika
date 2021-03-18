<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Konfigurasi Farmasi </h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Utilitas </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Konfigurasi Farmasi</a>
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
                            <div class="row" id="tabs-detail" style="height: 400px; max-height: 400px; margin-top: -10px;">
                            <div class="col-lg-12">
                                <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#tab_1" role="tab" data-toggle="tab">Transaksi Penjualan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#tab_2" role="tab" data-toggle="tab">Mutasi Barang</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#tab_3" role="tab" data-toggle="tab">Pesanan Pembelian</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade show active form-group row kt-container kt-container-form" id="tab_1">
                                            <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="kt-font-bold col-lg-auto col-sm-12 form-control form-control-sm" id="txt-label_no" style="text-align: center;">
                                                                Tarif Jasa Resep
                                                            </label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Obat :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <input id="nmb-obat" class="form-control form-control-sm easyui-numberbox" style="width: 100%; text-align: right;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Alkes :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <input id="nmb-alkes" class="form-control form-control-sm easyui-numberbox" style="width: 100%; text-align: right;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Racikan :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <input id="nmb-racikan" class="form-control form-control-sm easyui-numberbox" style="width: 100%; text-align: right;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Nilai Maksimal :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <input id="nmb-maksimal" class="form-control form-control-sm easyui-numberbox" style="width: 100%; text-align: right;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="kt-font-bold col-lg-auto col-sm-12 form-control form-control-sm" id="txt-label_no" style="text-align: center;">
                                                                Penjualan
                                                            </label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Dasar Harga Jual :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <!-- <input id="txt-harga_jual" class="form-control form-control-sm" type="text"> -->
                                                                <select id="cmb-harga_jual" class="form-control form-control-sm">
                                                                    <option value="1">HNA</option>
                                                                    <option value="2">HNA Rata-Rata</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Hitung PPN :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <select id="cmb-hitung_ppn" class="form-control form-control-sm">
                                                                    <option value="True">Ya</option>
                                                                    <option value="False">Tidak</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Persentase PPN :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <input id="nmb-persentase" class="form-control form-control-sm easyui-numberbox persen" style="width: 100%; text-align: right;">
                                                            </div>
                                                            <div class="col-lg-auto col-sm-12 form-control-sm kt-font-bold" style="padding-left: 0px;">
                                                                %
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                No. Resep Auto :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <select id="cmb-no_resep" class="form-control form-control-sm">
                                                                    <option value="True">Ya</option>
                                                                    <option value="False">Tidak</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top: 15px;">
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="kt-font-bold col-lg-auto col-sm-12 form-control form-control-sm" id="txt-label_no" style="text-align: center;">
                                                                Gas Medik
                                                            </label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Item Oksigen :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <select id="cmb-item_oksigen" class="form-control form-control-sm">
                                                                    <!-- <option value="True">Ya</option>
                                                                    <option value="False">Tidak</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Item Nitrogen :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <select id="cmb-item_nitrogen" class="form-control form-control-sm">
                                                                    <!-- <option value="True">Ya</option>
                                                                    <option value="False">Tidak</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Depo Gas Medik :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <select id="cmb-depo_gas_medik" class="form-control form-control-sm">
                                                                    <!-- <option value="True">Ya</option>
                                                                    <option value="False">Tidak</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="kt-font-bold col-lg-auto col-sm-12 form-control form-control-sm" id="txt-label_no" style="text-align: center;">
                                                                Stok
                                                            </label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 0px;">
                                                                Cek Stok Penjualan :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <!-- <input id="txt-harga_jual" class="form-control form-control-sm" type="text"> -->
                                                                <select id="cmb-stok_penjualan" class="form-control form-control-sm">
                                                                    <option value="True">Ya</option>
                                                                    <option value="False">Tidak</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpane1" class="tab-pane fade active form-group row kt-container kt-container-form" id="tab_2">
                                            <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="kt-font-bold col-lg-auto col-sm-12 form-control form-control-sm" id="txt-label_no" style="text-align: center;">
                                                                Stok
                                                            </label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 0px;">
                                                                Cek Stok Mutasi :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <!-- <input id="txt-harga_jual" class="form-control form-control-sm" type="text"> -->
                                                                <select id="cmb-stok_mutasi" class="form-control form-control-sm">
                                                                    <option value="True">Ya</option>
                                                                    <option value="False">Tidak</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm" style="padding-right: 0px;">
                                                                Safety Stok Gudang :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <input id="nmb-safety_stok_gudang" class="form-control form-control-sm easyui-numberbox persen" style="width: 100%; text-align: right;">
                                                            </div>
                                                            <div class="col-lg-auto col-sm-12 form-control-sm kt-font-bold" style="padding-left: 0px;">
                                                                %
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Safety Stok Depo :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <input id="nmb-safety_stok_depo" class="form-control form-control-sm easyui-numberbox persen" style="width: 100%; text-align: right;">
                                                            </div>
                                                            <div class="col-lg-auto col-sm-12 form-control-sm kt-font-bold" style="padding-left: 0px;">
                                                                %
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="kt-font-bold col-lg-auto col-sm-12 form-control form-control-sm" id="txt-label_no" style="text-align: center;">
                                                                Depo Mutasi
                                                            </label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Depo Retur :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <!-- <input id="txt-harga_jual" class="form-control form-control-sm" type="text"> -->
                                                                <select id="cmb-depo_retur" class="form-control form-control-sm">
                                                                    <!-- <option value="1">HNA</option>
                                                                    <option value="2">HNA Rata-Rata</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                                                                Depo Instransit :
                                                            </label>
                                                            <div class="col-lg-5 col-sm-12">
                                                                <select id="cmb-depo_instansi" class="form-control form-control-sm">
                                                                    <!-- <option value="True">Ya</option>
                                                                    <option value="False">Tidak</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpane1" class="tab-pane fade active form-group row kt-container kt-container-form" id="tab_3">
                                            <div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid table-detail">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group row">
                                                            <label class="kt-font-bold col-lg-auto col-sm-12 form-control form-control-sm" id="txt-label_no" style="text-align: center;">
                                                                Pengiriman
                                                            </label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                                                                Alamat Pengiriman :
                                                            </label>
                                                            <div class="col-lg-9 col-sm-12">
                                                                <textarea class="form-control form-control-sm kt-font-sm" style="resize: none; height: 98px;" id="txt-alamat"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top: 30px;margin-left: 0px;margin-right: 0px;">
                            <div class="col-lg-auto col-md-auto col-sm-auto div_simpan" style="padding:2px">
                                <button id="btn-simpan" type="button"
                                        class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm" onclick="simpan()">
                                    <i class="la la-save"></i>
                                    Simpan
                                </button>
                            </div>
                            <div class="col-lg-auto col-md-auto col-sm-auto kt-padding-t-10-mobile" style="padding:2px">
                                <!-- <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" onclick="tab(0)">
                                    <i class="la la-times"></i>
                                    Batal
                                </button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- end content