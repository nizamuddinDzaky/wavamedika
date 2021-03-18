<!--begin:: Subheader -->
<div class="custom-subheader kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Messages and Approvals</h3>
            <!-- <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">Inbox</a>
            </div> -->
        </div>
    </div>
</div>
    <!-- end:: Subheader -->

    <!-- Main content -->
    <section class="content kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
      <div class="kt-row col-custom order-lg-1 order-xl-1 container-mobile">
        <!-- merubah height -->
        <div class="col-md-3-custom" style="height: 588px;">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title-custom">Directory</h5>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active" onclick="refreshInbox(0, 1)">
                  <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> Kotak Masuk
                    <span class="badge bg-primary float-right text-white" id="badge-inbox"></span>
                  </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" style="margin-left: 15px;">
                  <a href="#" class="nav-link" onclick="refreshInbox(1, 1)">
                    <i class="far fa-envelope"></i> Belum Terbaca
                  </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" style="margin-left: 15px;">
                  <a href="#" class="nav-link" onclick="refreshInbox(2, 1)">
                    <i class="far far fa-envelope-open"></i> Terbaca
                  </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                  <a href="#" class="nav-link" onclick="refreshApproval(0,1)">
                    <i class="fas fa-file-signature"></i> Approval
                  </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" style="margin-left: 15px;">
                  <a href="#" class="nav-link" onclick="refreshApproval(1,1)">
                    <i class="far fa-clock"></i> Pending
                  </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item" style="margin-left: 15px;">
                  <a href="#" class="nav-link" onclick="refreshApproval(2,1)">
                    <i class="fas fa-check"></i> Complete
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9-custom">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <div class="row" style="margin-bottom: -3px; margin-top: 2px;">
                <h5 class="card-title-custom" style="margin-left: 15px;">Inbox</h5>
                <!-- <div class="col-lg-7"></div> -->
                <div class="input-group-append" style="margin-left: 71%;">
                  <input type="text" class="col-lg-12 form-control" placeholder="Search Mail" id="input-search">
                  <button type="button" class="btn btn-primary" style="width: 39px; height: 34px;" onclick="search_mail(0, 1)">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <!-- menambahkan id pada icon button check all, read, unread, delete, message dan margin top -->
              <div class="mailbox-controls" style="margin-top: 3px;">
                <!-- Check all button -->
                <button id="btn-check_all" type="button" data-container="body" data-placement="bottom" data-toggle="tooltip" title="Check All" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="far fa-square"></i>
                </button>
                <div id="div_button" class="btn-group">
                  <button type="button" data-container="body" data-placement="bottom" data-toggle="tooltip" title="Tandai Terbaca" class="btn btn-default btn-sm" onclick="changeStatus(2)">
                    <i class="far fa-envelope-open"></i>
                  </button>
                  <button type="button" data-container="body" data-placement="bottom" data-toggle="tooltip" title="Belum Terbaca" style="margin-left: 4px;" class="btn btn-default btn-sm"  onclick="changeStatus(1)">
                    <i class="far fa-envelope"></i>
                  </button>
                  <button data-container="body" data-placement="bottom" data-toggle="tooltip" title="Hapus" type="button" style="margin-left: 4px;" class="btn btn-default btn-sm" onclick="changeStatus(3)">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </div>
                <!-- /.btn-group -->
                <button id="btn-refresh" type="button" data-container="body" data-placement="bottom" data-toggle="tooltip" title="Refresh" class="btn btn-default btn-sm" onclick="refreshCurrentPage()"><i class="fas fa-sync-alt"></i></button>
                <div class="float-right">
                  <label id="label-page-inbox"></label>
                  
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm" id="prev-inbox"><i class="fas fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm" id="next-inbox"><i class="fas fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
              <div id="header-tabel" class="form-group row col-lg-12 kt-line-top" style="text-align: center;">
                <!--  -->
              </div>
              <div class="table-responsive mailbox-messages table-wrapper-scroll-y" style="height: 270px;" id="sadsad">
                <table class="table table-striped- table-hover table-checkable" id="tb-mail">
                  <!-- menghapus isi tabel termasuk thead dan tbody -->
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
          </div>
          <!-- detail -->
          <div class="card card-primary card-outline" style="margin-top: 5px;" id="card-detail">
            <div class="card-header">
              <div class="row col-lg-12" style="margin-top: 5px; margin-left: 1px;">
                <div class="col-lg-1">
                  <div class="form-group row">
                    <label class=""style="height: 12px;">Pengirim </label>
                    <!-- <label>Bragas Rexita E.</label> -->
                  </div>
                  <div class="form-group row">
                    <label class="" style="height: 12px;">Judul</label>
                    <!-- <label style="margin-left: 3px;">Approval</label> -->
                  </div>
                </div>
                <div class="col-lg-9">
                  <div class="form-group row">
                    <label id="pengirim" class="" style="height: 12px;">: Bragas Rexita E. </label>
                    <!-- <label>Bragas Rexita E.</label> -->
                  </div>
                  <div class="form-group row">
                    <label id="judul" class="" style="height: 12px;">: Approval</label>
                    <!-- <label style="margin-left: 3px;">Approval</label> -->
                  </div>
                </div>
                
                <div class="col-lg-2">
                  <label class="col-form-label" style="line-height: 5px;" id="tanggal">10/07/2020 08:34</label>
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <!-- merubah height -->
              <div class="table-responsive mailbox-messages table-wrapper-scroll-y kt-table-scroll" style="height: 141px;">
                <div id="header" class="kt-header-subject" style="margin-top: 15px; width: 90%;">Yth. Bpk Bragas Rexita E., Amd.Farm</div>
                <!-- <div id="header" class="kt-subject" style="margin-top: 10px; width: 58%;">
                  Mohon untuk segera diproses
                  Permohonan Mutasi Ruangan dengan no.POF-2007-00025 atas nama Pahrul Bahari Lamongan.,Amd,Kep.
                  <br>Terimakasih.
                </div> -->
                <div class="col-lg-auto" style="margin-top: 50px;">
                  <div class="form-group row">
                      <div class="col-lg-auto col-md-auto col-sm-auto">
                          <button id="btn-tampilkan-doc" type="button" class="form-control form-control-sm btn btn-sm btn-primary">
                              <i class="far fa-file-alt"></i>
                              Tampilkan Dokumen
                          </button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  <!-- /.content-body