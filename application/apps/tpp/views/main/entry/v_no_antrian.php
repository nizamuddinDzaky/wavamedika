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
      <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">

        <!--Panel Pencarian Start-->
        <!--Panel Pencarian End-->

      </div>
      <!-- <br> -->
      <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
        <div class="row">
          <div class="col-md-3 col-sm-12 header-form kt-margin-t-25"></div>
          <div class="col-md-6 col-sm-12 header-form kt-margin-t-25">
            <h3 align="center">ANTRIAN PENDAFTARAN </h3>
            <select style="width: 100%" class="select2 dropdown-loket" class="form-control easyui-combobox dropdown-loket" name="unit">

            </select>
            <span class="f-left tgl_sekarang"></span>
            <h3 class="float-right count-down">10</h3>
          </div>
          <div class="col-md-3 col-sm-12 header-form kt-margin-t-25"></div>
        </div>
        <div class="row">
          <div class="col-md-3 col-sm-12 header-form kt-margin-t-25"></div>
          <div class="col-md-6 col-sm-12 header-form kt-margin-t-25">
            <div class="row">
              <div class="col-3">
                <div class="card" style="height: 100%">
                  <div class="card-body">
                    <ul class="list-group list_antrian" style="text-align: center ; color: black">

                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card text-white bg-secondary">
                  <div class="card-body" style="text-align: center;">
                    <span style="font-size: 100px ;color: black" class="card-title no_antri_sekarang">&nbsp;</span>
                    <form id="FormNoAktif">
                      <input type="hidden" name="no_antri">
                      <input type="hidden" name="id_antripendaftaran">
                      <input type="hidden" name="next">
                    </form>
                  </div>
                  <div class="card-footer" style="color : black">
                    <form class="form-inline" id="resetDetik">
                      <div class="form-group">
                        <label for="exampleInputName2">AutoRefresh &nbsp;&nbsp;</label>
                        <input type="text" class="form-control no" style="width: 50px" name="detik" value="10">
                        <label for="exampleInputName2">&nbsp;&nbsp;Detik</label>
                      </div>
                    </form>
                    <button type="button" class="btn btn-secondary btn-sm Refresh">Refresh</button>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <button type="button" onclick="UpdateCall()" style="width: 100%" class="btn btn-secondary btn-block call_antrian">Call</button>
                <button type="button" style="width: 100%" class="btn btn-secondary btn-block next_antrian">Next</button>
                <button type="button" onclick="UpdateSkip()" style="width: 100%" class="btn btn-secondary btn-block skip_antrian">Skip</button>
                <button type="button" onclick="UpdateRegister()" style="width: 100%" class="btn btn-secondary btn-block registrasi_antrian">Registrasi ></button>
                <button type="button" onclick="UpdateInaktif()" style="width: 100%" class="btn btn-secondary btn-block inaktif_antrian">Inaktif</button>
                <!-- <button type="button" style="width: 100%" class="btn btn-secondary btn-block">[X] Keluar</button> -->
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-12 header-form kt-margin-t-25"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end content