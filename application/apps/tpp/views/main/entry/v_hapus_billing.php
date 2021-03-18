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
        <a href="" class="kt-subheader__breadcrumbs-link">Entry</a>
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
      <!-- <br> -->
      <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">

        <div class="row">
          <div class="col-md-2 col-sm-12 header-form"></div>
          <div class="col-md-8 col-sm-12 header-form kt-margin-t-10">
            <div class="card">
              <div class="card-body">
                <form class="row" id="FormHapus">
                  <div class="col-md-6">
                    <fieldset class="border p-2">
                      <legend class="w-auto">Identitas Pasien</legend>
                      <div class="form-group form-group-sm row">
                        <label class="col-label-form col-sm-4  ">No Billing</label>
                        <div class="col-sm-8 mb-1">
                          <input class="form-control form-control-sm no no_biling" maxlength="9" minlength="9" required="" name="id_mrs">
                        </div>
                      </div>
                      <div class="form-group form-group-sm row">
                        <label class="col-label-form col-sm-4">Tgl MRS</label>
                        <div class="col-sm-8 mb-1">
                          <input class="form-control form-control-sm tgl_mrs" readonly>
                        </div>
                      </div>
                      <div class="form-group row form-group-sm">
                        <label class="col-label-form col-sm-4">Nomor RM</label>
                        <div class="col-sm-8 mb-1">
                          <input class="form-control form-control-sm no_mr" readonly>
                        </div>
                      </div>
                      <div class="form-group row form-group-sm">
                        <label class="col-label-form col-sm-4">Nama Lengkap</label>
                        <div class="col-sm-8 mb-1">
                          <input required class="form-control form-control-sm nama_lengkap" readonly label="Nama Lengkap" labelWidth="100">
                        </div>
                      </div>
                      <div class="form-group row form-group-sm">
                        <label class="col-label-form col-sm-4">Jenis Kelamin</label>
                        <div class="col-sm-8 mb-1">
                          <input class="form-control form-control-sm sex" readonly>
                        </div>
                      </div>
                      <div class="form-group row form-group-sm">
                        <label class="col-label-form col-sm-4">Alamat</label>
                        <div class="col-sm-8 mb-1">
                          <input class="form-control form-control-sm alamat" readonly>
                        </div>
                      </div>
                      <div class="form-group row form-group-sm">
                        <label class="col-label-form col-sm-4">Ruang</label>
                        <div class="col-sm-8  mb-1">
                          <input class="form-control form-control-sm ruang" readonly>
                        </div>
                      </div>
                    </fieldset>
                  </div>

                  <div class="col-md-6">
                    <fieldset class="border p-2">
                      <legend class="w-auto">Keterangan / Alasan</legend>
                      <div class="form-group form-group-sm row">
                        <div class="col-12">
                          <select class="form-control select2 form-control-sm" name="keterangan" required>
                            <option value=''>Pilih Alasan</option>
                            <option value='Tidak Jadi MRS.'>Tidak Jadi MRS.</option>
                            <option value='Salah Input.'>Salah Input.</option>
                            <option value='Hapus Nomor RM.'>Hapus Nomor RM.</option>
                            <option value='Permintaan Khusus.'>Permintaan Khusus.</option>
                          </select>
                        </div>
                      </div>
                    </fieldset>
                    <fieldset class="border p-2 ">
                      <legend class="w-auto">Atas Permintaan</legend>
                      <div class="form-group row">
                        <label class="col-label-form col-sm-4">Unit</label>
                        <div class="col-sm-8 mb-1">
                          <select class="form-control form-control-sm  select2 unit" name="id_unit" required>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-label-form col-sm-4">Dokter</label>
                        <div class="col-sm-8 mb-1">
                          <select name="permintaan" class="select2 form-control dropdown-dokter form-control-sm karyawan" required>
                          </select>
                        </div>
                      </div>
                    </fieldset>
                  </div>
                </form>
              </div>
              <div class="card-footer text-muted">
                <div class="float-right">
                  <button type="button" class="btn btn-seccondary btn-sm Refresh">Refresh</button>
                  <button type="button" class="btn btn-danger btn-sm" onclick="HapusMrs()">Hapus</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-12 header-form"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end content