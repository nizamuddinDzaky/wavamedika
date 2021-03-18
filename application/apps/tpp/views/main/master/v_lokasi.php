<style>

</style>
<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
  <div class="kt-container ">
    <div class="kt-subheader__main">
      <h3 class="kt-subheader__title"><?php echo isset($title) ? $title : "" ?></h3>
      <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home">
          <i class="flaticon2-shelter"></i>
        </a>
        <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="" class="kt-subheader__breadcrumbs-link">Master</a>
        <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="" class="kt-subheader__breadcrumbs-link"><?php echo isset($title) ? $title : "" ?></a>
      </div>
    </div>
    <!-- <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <a id="export-pdf" target="_blank" class="btn kt-subheader__btn-secondary">
                Export PDF
            </a>
            <a id="print" class="btn kt-subheader__btn-secondary">
                Print
            </a>
        </div>
    </div> -->
  </div>
</div>
<!-- end:: Subheader -->
<!-- begin:: Content -->
<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
  <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
      <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">

        <!--Panel Pencarian Start-->
        <form class="kt-form col-lg-12 header-form kt-margin-t-25" id="form-header">
          <div class="form-group row">
            <!--            <label class="col-form-label col-lg-1 col-md-2 col-sm-12 form-control-sm kt-font-sm">
                          Propinsi:</label>-->
            <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
              <select name="propinsi" id="sel_propinsi" class="select2 dropdown-propinsi form-control form-control-sm">
                <?php echo $dataPropinsi ?>
              </select>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
              <select name="kabupaten" id="sel_kabupaten" class="select2 dropdown-kabupaten form-control form-control-sm">
                <?php echo $dataKabupaten ?>
              </select>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
              <select name="kecamatan" id="sel_kecamatan" class="select2 dropdown-kecamatan form-control form-control-sm">
                <?php echo $dataKecamatan ?>
              </select>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-12 kt-margin-t-10-mobile">
              <button type="submit" class="btn btn-sm btn-primary" plain="true" id="btn-filter">
                <i class="la la-filter"></i>
                Filter Data
              </button>
            </div>
          </div>
          <hr>
        </form>
        <!--Panel Pencarian End-->

      </div>
      <!-- <br> -->
      <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
        <div class="table-custom">

          <table title="Data <?php echo $title ?>" id="dg" class="easyui-datagrid" style="width: 100%; height:480px; margin-top:5px" toolbar="#toolbar" pagination="true" idField="id" rownumbers="true" fitColumns="false" singleSelect="true" autoRowHeight="true" nowrap="false">
            <thead>
              <tr>
                <th field="propinsi" width="200">Propinsi</th>
                <th field="kabupaten" width="200">Kabupaten</th>
                <th field="kecamatan" width="200">Kecamatan</th>
                <th field="kelurahan" width="200">Kelurahan</th>
                <th field="kode_pos" width="200">Kode Pos</th>
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
              Edit
            </a>
            <a href="javascript:void(0)" id="btn-hapus" class="easyui-linkbutton" plain="true" onclick="Hapus()">
              <i class="flaticon2-trash"></i>
              Hapus
            </a>
          </div>

          <div id="tambahData" title="Tambah Lokasi" class="easyui-dialog" data-options="modal:true,closed:true,buttons:'#index-button'">
            <div class="kt-portlet">
              <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="formTambah">
                  <?php foreach ($fieldData as $field => $label) {
                    if ($field == 'id_lokasi') {
                      continue;
                    }
                  ?>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                        <?php echo $label ?>
                      </label>
                      <div class="col-lg-8 col-sm-12">
                        <input class="form-control form-control-sm <?= ($field == 'kode_pos' ? 'no' : '') ?> " type="text" id="txt-<?= $field ?>" name="<?= $field ?>">
                      </div>
                    </div>
                  <?php } ?>
                  <hr>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                    </label>
                    <div class="col-lg-4 col-sm-12">
                      <button type="submit" onclick="javascript:$('#tambahData').window('close').find(':input').val('').trigger('change')" class="btnBatal btn btn-sm btn-secondary">
                        <i class="la la-times"></i>Batal
                      </button>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                      <button type="submit" id="btnSimpan" class="btn btn-sm btn-primary">
                        <i class="la la-save"></i>Simpan
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div id="editData" title="Edit Lokasi" class="easyui-dialog" data-options="modal:true,closed:true">
            <div class="kt-portlet">
              <div class="kt-portlet__body_win header-form">
                <form class="kt-form col-lg-12 header-form" id="formEdit">
                  <?php foreach ($fieldData as $field => $label) { ?>
                    <div class="form-group row <?= ($field == 'id_lokasi' ? 'd-none' : '') ?>">
                      <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                        <?php echo $label ?>
                      </label>
                      <div class="col-lg-8 col-sm-12">
                        <input class="form-control form-control-sm" type="text" id="txt-<?= $field ?>" name="<?= $field ?>">
                      </div>
                    </div>
                  <?php } ?>
                  <hr>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3 col-sm-12 form-control-sm kt-font-sm">
                    </label>
                    <div class="col-lg-4 col-sm-12">
                      <button type="button" class="btnBatal form-control form-control-sm btn btn-sm btn-secondary">
                        <i class="la la-times"></i> Batal
                      </button>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                      <button type="submit" id="btnUpdate" class="form-control form-control-sm btn btn-sm btn-primary">
                        <i class="la la-save"></i> Simpan
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- end content -->