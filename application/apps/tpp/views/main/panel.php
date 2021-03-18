<!-- begin:: Subheader -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Jurnal Memorial </h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Akutansi </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Transaksi </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="" class="kt-subheader__breadcrumbs-link">
                    Jurnal Memorial </a>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="#" class="btn kt-subheader__btn-secondary">
                    Export Excel
                </a>
                <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="" data-placement="top" data-original-title="Quick actions">
                    <a href="#" class="btn btn-danger kt-subheader__btn-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Print
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="la la-plus"></i> New Product</a>
                        <a class="dropdown-item" href="#"><i class="la la-user"></i> New Order</a>
                        <a class="dropdown-item" href="#"><i class="la la-cloud-download"></i> New Download</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Subheader -->



<!-- begin:: Content -->
<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
    <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
<!-- PARENT DATAGRID-->
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <form class="kt-form col-lg-12 header-form kt-margin-t-25">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Start Date:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" type="date" id="start-date-input">
                        </div>

                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">End Date:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" type="date" id="end-date-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Kriteria:</label>
                        <div class="col-lg-2 col-sm-12">
                            <select class="form-control form-control-sm" id="select2_1">
                                <option value="">Semua Kriteria</option>
                                <option value="no_jurnal">No Jurnal</option>
                                <option value="keterangan">Keterangan</option>
                                <option value="other">Kriteria Lain</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Pencarian:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" type="text" id="kriteria_lain" placeholder="Cari...">
                        </div>
                        <div class="col-lg-1 col-sm-12 kt-margin-t-20-mobile">
                            <button class="form-control form-control-sm btn btn-sm btn-primary">
                                <i class="la la-filter"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Input Money:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm money" type="text" value="10000" placeholder="Money...">
                        </div>

                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Input Money 2:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm money" type="text" placeholder="asal ada class money...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Input Date:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" type="date-only-formatted">
                        </div>

                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Input Datetime:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" type="datetime-local">
                        </div>

                        <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Input Time:</label>
                        <div class="col-lg-2 col-sm-12">
                            <input class="form-control form-control-sm" type="time">
                        </div>
                    </div>
                </form>
            </div>

            <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">
                <div class="table-custom">
                    <table id="dg"
                           title="Daftar Jurnal Memorial"
                           class="easyui-datagrid"
                           url="getUser"
                           toolbar="#toolbar"
                           pagination="true"
                           rownumbers="true"
                           singleSelect="true"
                    >
                        <thead>
                        <tr>
                            <th field="firstname" >First Name</th>
                            <th field="lastname" >Last Name</th>
                            <th field="phone" >Phone</th>
                            <th field="email" >Email</th>
                            <th field="firstname" >First Name</th>
                            <th field="lastname" >Last Name</th>
                            <th field="phone" >Phone</th>
                            <th field="email" >Email</th>
                            <th field="firstname" >First Name</th>
                            <th field="lastname" >Last Name</th>
                            <th field="phone" >Phone</th>
                            <th field="email" >Email</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>

                        </tr>
                        </tfoot>
                    </table>
                    <div id="toolbar">
                        <a href="javascript:void(0)" id="tambah" class="easyui-linkbutton" plain="true">
                            <i class="la la-plus"></i>
                            Tambah
                        </a>
                        <a href="javascript:void(0)" id="hapus" class="easyui-linkbutton" plain="true">
                            <i class="flaticon2-trash"></i>
                            Hapus
                        </a>
                        <a href="javascript:void(0)" id="edit" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
                            Edit
                        </a>
                        <a href="javascript:void(0)" id="view" class="easyui-linkbutton" plain="true">
                            <i class="flaticon-edit-1"></i>
                            View
                        </a>
                    </div>
                </div>
            </div>
        </div>

<!--  END OF PARENT DATAGRID-->
    </div>


<!--    PANEL WINDOW-->
    <div id="win" class="panel-window" data-title="test">
        <div class="kt-portlet">
            <div class="kt-portlet__body header-form">
                <div class="row">
                    <form class="kt-form col-lg-7 header-form" id="form-detail">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Tanggal Daftar:</label>
                            <div class="col-lg-4 col-sm-12">
                                <input class="form-control form-control-sm" type="date" id="end-date-input">
                            </div>
                        </div>
                        <!-- FORM INPUT LABEL ATAS, INPUT BAWAH-->
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2 col-sm-12 form-control-sm kt-font-sm">Jenis Pasien:</label>
                            <div class="col-lg-4 col-sm-12">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Semua Kriteria</option>
                                    <option value="no_jurnal">Member</option>
                                    <option value="keterangan">Rawat Jalan</option>
                                    <option value="other">Member Lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2">
                                <label class="col-form-label kt-font-sm">Title</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Tn.</option>
                                    <option value="no_jurnal">Ny.</option>
                                    <option value="no_jurnal">An.</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="col-form-label kt-font-sm">Nama Lengkap</label>
                                <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                            </div>
                            <div class="form-group col-lg-2">
                                <label class="col-form-label kt-font-sm">Gelar</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Tn.</option>
                                    <option value="no_jurnal">Ny.</option>
                                    <option value="no_jurnal">An.</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="col-form-label kt-font-sm">Jenis Kelamin</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Laki-laki.</option>
                                    <option value="no_jurnal">Perempuan</option>
                                </select>
                            </div>
                            <div class="form group col-lg-2">
                                <label class="col-form-label kt-font-sm">Darah</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">A</option>
                                    <option value="no_jurnal">B</option>
                                    <option value="keterangan">O</option>
                                    <option value="other">AB</option>
                                </select>
                            </div>
                        </div>
                        <!-- BATAS BARIS-->
                        <div class="row">
                            <div class="form-group col-lg-2">
                                <label class="col-form-label kt-font-sm">Identitas</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Tn.</option>
                                    <option value="no_jurnal">Ny.</option>
                                    <option value="no_jurnal">An.</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-form-label kt-font-sm">No Identitas</label>
                                <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-lg-4">
                                <label class="col-form-label kt-font-sm">No BPJS</label>
                                <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-lg-2">
                                <label class="col-form-label kt-font-sm">Kelas</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">VVIP.</option>
                                    <option value="no_jurnal">VIP.</option>
                                    <option value="no_jurnal">Ekonomi</option>
                                </select>
                            </div>
                        </div>

                        <!--  CONTOH MULTIPLE ROW vertical and horizontal label input -->
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="col-form-label kt-font-sm">Umur</label>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <input class="form-control form-control-sm" type="text"/>
                                    </div>
                                    <label class="col-form-label col-lg-1 col-xs-2 form-control-sm kt-font-sm kt-padding-l-0-desktop ">Tahun</label>

                                    <div class="col-lg-3 col-xs-2">
                                        <input class="form-control form-control-sm" type="text"/>
                                    </div>
                                    <label class="col-form-label col-lg-1 col-xs-2 form-control-sm kt-font-sm kt-padding-l-0-desktop">Bulan</label>

                                    <div class="col-lg-3 col-xs-2">
                                        <input class="form-control form-control-sm" type="text"/>
                                    </div>
                                    <label class="col-form-label col-lg-1 col-xs-2 form-control-sm kt-font-sm kt-padding-l-0-desktop">Hari</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label class="col-form-label kt-font-sm">Tempat Lahir</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Rumah</option>
                                    <option value="no_jurnal">Jalan</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label class="col-form-label kt-font-sm">Tanggal Lahir</label>
                                <input class="form-control form-control-sm" type="date" id="start-date-input">
                            </div>
                        </div>
                        <!--  END CONTOH MULTIPLE ROW vertical and horizontal label input -->

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="col-form-label kt-font-sm">Alamat</label>
                                <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="col-form-label kt-font-sm">RT</label>
                                <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                            </div>
                            <div class="form-group col-lg-3">
                                <label class="col-form-label kt-font-sm">RW</label>
                                <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="col-form-label kt-font-sm kt-font-bold">Alamat Pasien Sesuai KTP:</label>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-form-label kt-font-sm">Kabupaten/kota</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Malang</option>
                                    <option value="no_jurnal">Surabaya</option>
                                    <option value="no_jurnal">Jakarta</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-form-label kt-font-sm">Kecamatan</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Malang</option>
                                    <option value="no_jurnal">Surabaya</option>
                                    <option value="no_jurnal">Jakarta</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-form-label kt-font-sm">Desa</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Malang</option>
                                    <option value="no_jurnal">Surabaya</option>
                                    <option value="no_jurnal">Jakarta</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label class="col-form-label kt-font-sm kt-font-bold">Alamat Domisili:</label>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-form-label kt-font-sm">Kabupaten/kota</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Malang</option>
                                    <option value="no_jurnal">Surabaya</option>
                                    <option value="no_jurnal">Jakarta</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-form-label kt-font-sm">Kecamatan</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Malang</option>
                                    <option value="no_jurnal">Surabaya</option>
                                    <option value="no_jurnal">Jakarta</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="col-form-label kt-font-sm">Desa</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Malang</option>
                                    <option value="no_jurnal">Surabaya</option>
                                    <option value="no_jurnal">Jakarta</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="col-form-label kt-font-sm">Nomor Telepon Rumah</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Malang</option>
                                    <option value="no_jurnal">Surabaya</option>
                                    <option value="no_jurnal">Jakarta</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="col-form-label kt-font-sm">Nomor Handphone</label>
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Malang</option>
                                    <option value="no_jurnal">Surabaya</option>
                                    <option value="no_jurnal">Jakarta</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <form class="kt-form col-lg-5 header-form" id="form-detail-right">
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Agama</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Islam</option>
                                    <option value="no_jurnal">Kristen</option>
                                    <option value="no_jurnal">Katolik</option>
                                    <option value="no_jurnal">Hindu</option>
                                    <option value="no_jurnal">Budha</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Suku Bangsa</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Jawa</option>
                                    <option value="no_jurnal">Kalimantan</option>
                                    <option value="no_jurnal">Sumatra</option>
                                    <option value="no_jurnal">PApua</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Pendidikan</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Jawa</option>
                                    <option value="no_jurnal">SD</option>
                                    <option value="no_jurnal">SMP</option>
                                    <option value="no_jurnal">SMA</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Pekerjaan</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">PNS</option>
                                    <option value="no_jurnal">Swasta</option>
                                    <option value="no_jurnal">Lain-lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Status Perkawinan</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Lajang</option>
                                    <option value="no_jurnal">Kawin</option>
                                    <option value="no_jurnal">Lain-lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Kewarganegaraan</label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">WNI</option>
                                    <option value="no_jurnal">WNA</option>
                                    <option value="no_jurnal">Lain-lain</option>
                                </select>
                            </div>
                            <label class="col-form-label col-sm-1 form-control-sm kt-font-sm" style="padding-left: 0; padding-right: 0">Bahasa</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Bahasa</option>
                                    <option value="no_jurnal">English</option>
                                    <option value="no_jurnal">Lain-lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">No RM Ibu Kandung</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Nama Ibu Kandung</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Nama Ortu/Suami/Istri</label>
                            <div class="col-sm-4">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Ortu</option>
                                    <option value="no_jurnal">Suami</option>
                                    <option value="no_jurnal">Istri</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Hubungan Pasien</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Ayah</option>
                                    <option value="no_jurnal">Ibu</option>
                                    <option value="no_jurnal">Anak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Penanggung Jawab</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Alamat</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Telepon</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4 form-control-sm kt-font-sm">Pekerjaan</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm" id="select2_1">
                                    <option value="">Negri</option>
                                    <option value="no_jurnal">Swasta</option>
                                    <option value="no_jurnal">Lain-lain</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 table-detail">
                                <table id="dg2"
                                       height="350"
                                       title="id= #dg2"
                                       class="easyui-datagrid"
                                       url="getUser"
                                       toolbar="#toolbarDetailJurnalMemorial"
                                       pagination="true"
                                       rownumbers="true"
                                       singleSelect="true"
                                >
                                    <thead>
                                    <tr>
                                        <th field="firstname" >First Name</th>
                                        <th field="lastname" >Last Name</th>
                                        <th field="phone" >Phone</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>

                                    </tr>
                                    </tfoot>
                                </table>
                                <div id="toolbarDetailJurnalMemorial">
                                    <a href="javascript:void(0)" id="tambah" class="easyui-linkbutton" plain="true">
                                        <i class="la la-plus"></i>
                                        Tambah
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">
                                Data Identitas Pasien Sudah Lengkap
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm"
                                id="alert_test"
                        >
                            <i class="la la-save"></i>
                            Simpan
                        </button>
                    </div>
                    <div class="col-lg-2 kt-padding-t-10-mobile">
                        <button class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm">
                            <i class="la la-times"></i>
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--    END OF PANEL WINDOW-->

</div>
<!-- end content -->