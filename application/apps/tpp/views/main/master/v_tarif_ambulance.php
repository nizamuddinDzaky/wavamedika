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
          <!-- <div class="form-group row">
            <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
              <select name="propinsi" id="sel_propinsi" class="select_2 form-control form-control-sm">
                <?php echo $dataPropinsi ?>
              </select>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
              <select name="kabupaten" id="sel_kabupaten" class="select_2 form-control form-control-sm">
                <?php echo $dataKabupaten ?>
              </select>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-12 kt-margin-t-10-mobile">
              <select name="kecamatan" id="sel_kecamatan" class="select_2 form-control form-control-sm">
                <?php echo $dataKecamatan ?>
              </select>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-12 kt-margin-t-10-mobile">
              <button type="submit" class="btn btn-sm btn-primary" plain="true" id="btn-filter">
                <i class="la la-filter"></i>
                Filter Data
              </button>
            </div>
          </div> -->
          <div class="row">
            <div class="col-md-2 col-sm-12">
              <div class="form-group">
                <label class=" ">Propinsi:</label>
                <select name="propinsi" class="dropdown-propinsi propinsi select2">
                  <?= getProvinsi() ?>
                </select>
              </div>
            </div>
            <div class="col-md-2 col-sm-12">
              <div class="form-group">
                <label class=" ">Kabupaten:</label>
                <select name="kabupaten" class="dropdown-kabupaten kabupaten select2">
                  <option value="">Pilih Kabupaten</option>
                </select>
              </div>
            </div>
            <div class="col-md-2 col-sm-12">
              <div class="form-group">
                <label class=" ">Kecamatan:</label>
                <select name="kecamatan" class="dropdown-kecamatan kecamatan select2">
                  <option value="">Pilih Kecamatan</option>
                </select>
              </div>
            </div>
            <div class="col-md-2 col-sm-12">
              <div class="form-group">
                <label class="">Kelurahan:</label>
                <select name="kelurahan" class="dropdown-kelurahan kelurahan select2">
                  <option value="">Pilih Kelurahan</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-form-label col-sm-6 col-md-3">Tarif (Rp)</label>
            <label class="col-form-label col-sm-6 col-md-3 tarif-ambulance"></label>
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
                <th field="uraian" width="250">Jenis Tarif Ambulance</th>
                <th field="vvip" width="100">VVIP</th>
                <th field="vip" width="100">VIP</th>
                <th field="vipb" width="100">VIP-B</th>
                <th field="i" width="100">I</th>
                <th field="ii" width="100">II</th>
                <th field="iii" width="100">III</th>
                <th field="iiia" width="100">III-A</th>
                <th field="iiib" width="100">III-B</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end content -->