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
        <div class="table-custom row kt-margin-t-10">
          <div class="col-sm-12 col-md-8" style="margin-bottom: 10px">
            <table id="dg" height="425" title="<?= $title ?>" class="easyui-datagrid" pagination="true" rownumbers="true" singleSelect="true" pageSize="10">
              <thead>
                <tr>
                  <th data-options="field:'no_voucher'" width="15%" align="left" halign="center">Voucher</th>
                  <th data-options="field:'identitas'" width="30%" align="left" halign="center">Identitas</th>
                  <th data-options="field:'isi'" width="15%" align="right" halign="center">Isi</th>
                  <th data-options="field:'operator'" width="20%" align="left" halign="center">Operator</th>
                  <th data-options="field:'tgl_input'" width="20%" align="left" halign="center">Input</th>
                </tr>
              </thead>
              <tfoot>
                <tr></tr>
              </tfoot>
            </table>
          </div>
          <div class="col-sm-12 col-md-4" style="margin-bottom: 10px">
            <table id="ListVoucherData" height="425" title="Detail Transaksi Parkir" class="easyui-datagrid" rownumbers="true" singleSelect="true" pagination="true">
              <thead>
                <tr>
                  <th data-options="field:'tgl_input'" width="60%" align="left" halign="center">Tanggal Input</th>
                  <th data-options="field:'operator'" width="40%" align="left" halign="center">Operator</th>
                </tr>
              </thead>
              <tfoot>
                <tr></tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="row table-custom">
          <div class="col-12">
            <div class="float-left">
              <button type="button" class="btn btn-primary btn-sm" onclick="OpenAdd()">Aktifasi</button>
              <button type="button" class="btn btn-secondary btn-sm" onclick="OpenReset()">Reset</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end content -->

<div id="AddVoucher" class="easyui-window" title="Aktifasi Voucher Parkir" data-options="modal:true,closed:true,buttons:'#add-button',resizable: false" style="width:500px">
  <div class="card">
    <div class="card-body">
      <form id="InsertData">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No Voucher</label>
          <div class="col-sm-4 input-group input-group-sm mb-3">
            <!-- <input type="text" minlength="7" maxlength="7" name="no_voucher" class="form-control form-control-sm no_voucher masked" data-valid-example="P123456"> -->
            <div class="input-group-prepend">
              <span class="input-group-text"><b>P</b></span>
            </div>
            <input type="text" class="form-control form-control-sm no_voucher no" required minlength="6" maxlength="6">
            <input type="hidden" name="no_voucher" class="form-control form-control-sm no_voucher-p">
          </div>
          <div class="col-sm-5">
            <span class="keterangan"></span>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-sm-3">No MRS</label>
          <div class="col-sm-auto">
            <input type="text" name="no_mrs" maxlength="9" minlength="9" class="form-control form-control-sm no_mrs no">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Identitas</label>
          <div class="col-sm-9">
            <textarea class="form-control form-control-sm identitas" required name="identitas">
            </textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-label-form col-sm-3">Harga(Rp)</label>
          <div class="col-sm-3">
            <input style="text-align: right;" class="form-control form-control-sm no  " name="harga">
          </div>
          <div class="col-sm-6">
            <input class="form-control form-control-sm" readonly name="isi" labelWidth="100" style="width:100%" value="10" datax data-options="label:'Isi Voucher:'">

            <input type="hidden" name="keterangan" value="Voucher Parkir">
          </div>
        </div>
      </form>
    </div>
    <div class="card-footer">
      <span class="input-group-btn">
        <button class="btn btn-info submit-poli" label=" " labelPosition="top" onclick="SimpanInsert()">Simpan</button>
      </span>
      <span class="input-group-btn pull-right">
        <button type="button" class="btn btn-danger" onclick="$('#AddVoucher').window('close')"><i class="la la-close"></i> Close</button>
      </span>
    </div>
  </div>
</div>

<div id="ResetVoucher" class="easyui-window" title="Reset Voucher Parkir" data-options="modal:true,closed:true,buttons:'#add-button',resizable: false" style="width:500px">
  <div class="card">
    <div class="card-body">
      <form id="ResetData">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No Voucher</label>
          <div class="col-sm-4 input-group input-group-sm mb-3">
            <!-- <input type="text" minlength="7" maxlength="7" name="no_voucher" class="form-control form-control-sm no_voucher masked" data-valid-example="P123456"> -->
            <div class="input-group-prepend">
              <span class="input-group-text"><b>P</b></span>
            </div>
            <input type="text" class="form-control form-control-sm no_voucher no" required minlength="6" maxlength="6">
            <input type="hidden" name="no_voucher" class="form-control form-control-sm no_voucher-p">
          </div>
          <div class="col-sm-5">
            <span class="keterangan"></span>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-label-form col-sm-3">Harga(Rp)</label>
          <div class="col-sm-3">
            <input style="text-align: right;" class="form-control form-control-sm no  " name="harga">
          </div>
          <label class="col-label-form col-sm-3">Isi Voucher</label>
          <div class="col-sm-3">
            <input class="form-control form-control-sm" readonly name="isi" labelWidth="100" style="width:100%" value="10" datax data-options="label:'Isi Voucher:'">

            <input type="hidden" name="keterangan" value="Voucher Parkir">
          </div>
          <div class="col-sm-5">
            <span class="keterangan"></span>
          </div>
        </div>
        <!--  <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" readonly class="easyui-textbox no" style="width: 100%" label="No.MRS" labelWidth="100">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input class="easyui-textbox" required readonly labelWidth="100" style="width:100%;height:60px" data-options="label:'Identitas:',multiline:true">
                    </div>
                </div> -->
      </form>
    </div>
    <div class="card-footer">
      <span class="input-group-btn">
        <!-- <div class="col-md-1 col-sm-1"> -->
        <button class="btn btn-info submit-poli" label=" " labelPosition="top" onclick="SimpanReset()">Simpan</button>
        <!-- </div> -->
      </span>
      <span class="input-group-btn pull-right">
        <button type="button" class="btn btn-danger" onclick="$('#ResetVoucher').window('close')"><i class="la la-close"></i> Close</button>
      </span>
    </div>
  </div>
</div>