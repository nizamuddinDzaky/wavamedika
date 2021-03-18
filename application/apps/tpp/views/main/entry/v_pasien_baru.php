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
  </div>
</div>

<!-- end:: Subheader -->
<!-- begin:: Content -->

<div class="kt-container kt-container-form kt-grid__item kt-grid__item--fluid">
  <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile" id="browse">
    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
      <!-- <div class="kt-portlet__body kt-portlet__body--fit kt-margin-b-20">

      </div> -->
      <div class="kt-portlet__body custom-body-padding">
        <div class="row">

          <div class="col-lg-12 kt-padding-t-10-mobile" style="border-bottom: 2px solid #D3D3D3;margin-bottom: 10px;">
            <div class="form-group row">
              <div class='col-lg-8 col-md-12'>&nbsp;</div>
              <div class="col-lg-2 col-md-12 kt-padding-t-10-mobile">
                <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary" onclick="ResetForm()">
                  <i class="la la-times"></i>
                  Batal
                </button>
              </div>
              <div class="col-lg-2 col-md-12 div_simpan">
                <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="SimpanInsertPasien()">
                  <i class="fas fa-save"></i>
                  Simpan
                </button>
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 header-form kt-margin-t-10">

            <form class="row" id="insert-pasien">
              <div class="col-lg-7 col-md-12">
                <div class="form-group row">
                  <label class="col-form-label col-lg-2 col-sm-12 form-control-sm">Tgl Daftar:</label>
                  <div class="col-lg-4 col-sm-12">
                    <input class="form-control form-control-sm tgl_daftar datepicker-tgl" format='DD/MM/YYYY' name="tgl_daftar" type="text">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <label class='col-form-label'>Jenis Pasien</label>
                      <select class="select2 form-control form-control-sm dropdown-id_jnspasien id_jnspasien" required name="id_jnspasien">
                        <option value="" selected>Pilih Jenis</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <label class='col-form-label'>Jenis Kegiatan Khusus</label>
                      <select disabled class="select2 form-control form-control-sm dropdown-id_jnskegiatankhusus id_jnskegiatankhusus" name="id_jnskegiatankhusus">
                        <option value="" selected>Pilih Jenis</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="form-group">
                      <label class='col-form-label'>Title</label>
                      <select class="select2 form-control form-control-sm dropdown-titel titel" name="titel">
                        <?= getOptionList("title") ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-6">
                    <div class="form-group">
                      <label class='col-form-label'>Nama Lengkap</label>
                      <input style="text-transform: uppercase;" required class="form-control form-control-sm  nama_lengkap disable-no" type="text" name="nama_lengkap">
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="form-group">
                      <label class='col-form-label'>Gelar</label>
                      <select class="select2 form-control form-control-sm dropdown-gelar gelar" name="gelar">
                        <?= getOptionList("gelar") ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="form-group">
                      <label class='col-form-label'>Jenis Kelamin</label>
                      <select class="select2 form-control form-control-sm dropdown-sex sex" name="sex">
                        <?= getOptionList("jeniskelamin") ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="form-group">
                      <label class='col-form-label'>Darah</label>
                      <select class="select2 form-control form-control-sm dropdown-darah darah" name="darah">
                        <?= getOptionList("darah") ?>
                      </select>
                    </div>
                  </div>
                  <!-- row ke 4 -->
                  <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="form-group">
                      <label class='col-form-label'>Jenis Kartu</label>
                      <select class="select2 form-control form-control-sm dropdown-jenis_kartu jenis_kartu" name="jenis_kartu">
                        <?= getOptionList("identitas") ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-6">
                    <div class="form-group">
                      <label class='col-form-label'>No identitas</label>
                      <input class="form-control form-control-sm  no_jeniskartu " type="text" name="no_jeniskartu">
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-8 col-sm-6">
                    <div class="form-group">
                      <label class='col-form-label'>No BPJS</label>
                      <input class="form-control form-control-sm  no no_bpjs" type="text" name="no_bpjs">
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-4">
                    <div class="form-group">
                      <label class='col-form-label'>Kelas BPJS</label>
                      <select class="select2 form-control form-control-sm dropdown-kelas_bpjs kelas_bpjs" name="kelas_bpjs">
                        <?= getOptionList("kelas") ?>
                      </select>
                    </div>
                  </div>
                  <!-- data kelahiran -->
                  <div class="col-12" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-header">Data Kelahiran</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-7 col-md-12">
                            <span class="label label-default">Umur</span>
                            <div class="row" style="margin-top: 15px">
                              <div class="col-md-4">
                                <div class="form-group row">
                                  <div class='col-6'>
                                    <input class="form-control form-control-sm  tahun no" value="0" onchange="ChangeDate()">
                                  </div>
                                  <label class='col-form-label col-6'>Tahun</label>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group row">
                                  <div class='col-6'>
                                    <input class="form-control form-control-sm  bulan no" value="0" maxvalue='12' onchange="ChangeDate()">
                                  </div>
                                  <label class='col-form-label col-6'>Bulan</label>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group row">
                                  <div class='col-6'>
                                    <input class="form-control form-control-sm  hari no" value="0" onchange="ChangeDate()">
                                  </div>
                                  <label class='col-form-label col-6'>Hari</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-5 col-md-12">
                            <div class="row">
                              <div class="col-md-7">
                                <label class='col-form-label'>Tempat Lahir</label>
                                <input style="text-transform: uppercase;" class="form-control form-control-sm  tmp_lahir" type="text" value="" name="tmp_lahir">
                                <!-- <select style="width: 100%" labelPosition="top" label="Tempat Lahir" class="easyui-combobox tmp_lahir" name="tmp_lahir" data-options="
                                                                            valueField: 'tmp_lahir',
                                                                            textField: 'tmp_lahir',
                                                                            url: '<?= base_url("tpp/ajax/ajax_umum") ?>',
                                                                            method: 'post' , 
                                                                            queryParams:{
                                                                                act:'TempatLahirPx'
                                                                            },
                                                                            onChange:function(x,y){
                                                                                  
                                                                            } 
                                                                        ">
                                      </select> -->
                              </div>
                              <div class="col-md-5">
                                <label class="col-form-label form-control-sm">Tanggal Lahir:</label>
                                <input class="form-control form-control-sm tgl_lahir datepicker-tgl" name="tgl_lahir" type="text">


                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- data ktp -->
                  <div class="col-12" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-header">Alamat Pasien Sesuai KTP</div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Alamat:</label>
                              <input style="text-transform: uppercase;" class="form-control form-control-sm alamat" name="alamat" type="text">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">RT:</label>
                              <input class="form-control form-control-sm rt no" name="rt" type="text">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">RW:</label>
                              <input class="form-control form-control-sm rw no" name="rw" type="text">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Kode Pos:</label>
                              <input class="form-control form-control-sm kodepos no" name="kode_pos" type="text">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Propinsi:</label>
                              <select name="propinsi" class="dropdown-propinsi propinsi select2">
                                <?= getProvinsi() ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Kabupaten:</label>
                              <select name="kabupaten" class="dropdown-kabupaten kabupaten select2">
                                <option value="">Pilih Kabupaten</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Kecamatan:</label>
                              <select name="kecamatan" class="dropdown-kecamatan kecamatan select2">
                                <option value="">Pilih Kecamatan</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Kelurahan:</label>
                              <select name="kelurahan" class="dropdown-kelurahan kelurahan select2">
                                <option value="">Pilih Kelurahan</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-header" valign="middle">
                        Alamat Domisili
                        <div class="float-right">
                          <button type="button" class="btn btn-secondary btn-sda"> SDA</button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Alamat:</label>
                              <input style="text-transform: uppercase;" class="form-control form-control-sm alamat_d" name="alamat_d" type="text">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">RT:</label>
                              <input class="form-control form-control-sm rt_d no" name="rt_d" type="text">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">RW:</label>
                              <input class="form-control form-control-sm rw_d no" name="rw_d" type="text">
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Kode Pos:</label>
                              <input class="form-control form-control-sm kodepos_d no" name="kodepos_d" type="text">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Propinsi:</label>
                              <select name="propinsi_d" class="dropdown-propinsi_d propinsi_d select2">
                                <?= getProvinsi() ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Kabupaten:</label>
                              <select name="kabupaten_d" class="dropdown-kabupaten_d kabupaten_d select2">
                                <option value="">Pilih Kabupaten</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Kecamatan:</label>
                              <select name="kecamatan_d" class="dropdown-kecamatan_d kecamatan_d select2">
                                <option value="">Pilih Kecamatan</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class=" col-form-label form-control-sm">Kelurahan:</label>
                              <select name="kelurahan_d" class="dropdown-kelurahan_d kelurahan_d select2">
                                <option value="">Pilih Kelurahan</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                      <label class='col-form-label'>Nomor Telepon Rumah</label>
                      <input class="form-control form-control-sm  telepon no" name="telepon">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                      <label class='col-form-label'>Nomor HandPhone</label>
                      <input class="form-control form-control-sm  hp no" name="hp">
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <label class='col-form-label'>Email</label>
                      <input class="form-control form-control-sm  email " type="text" name="email">
                    </div>
                    <div class="form-group">
                      <input type="text" labelWidth="250" labelPosition="after" labelAlign="right" class="easyui-checkbox " name="lengkap" value="1" label="Data Identitas Pasien Sudah Lengkap">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-12">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">Status Pasien</div>
                      <div class="card-body">
                        <div class="row form-group">
                          <label class="col-form-label col-3 form-control-sm">Agama:</label>
                          <div class="col-9">
                            <select style="width: 100%" class="dropdown-agama select2 agama" name="agama">
                              <?= getOptionList("agama") ?>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-3 form-control-sm">Suku Bangsa:</label>
                          <div class="col-5">
                            <select class="select2 dropdown-suku_bangsa suku_bangsa" name="suku_bangsa">
                              <?= getOptionList("suku") ?>
                            </select>
                          </div>
                          <div class="col-4">
                            <input style="text-transform: uppercase;" disabled class="form-control form-control-sm suku_lain" name="suku_lain" placeholder="Suku Lain">
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-3 form-control-sm">Pendidikan:</label>
                          <div class="col-9">
                            <select class="select2 dropdown-pendidikan pendidikan" name="pendidikan">
                              <?= getOptionList("pendidikan") ?>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-3 form-control-sm">Pekerjaan:</label>
                          <div class="col-9">
                            <select class="select2 dropdown-pekerjaan pekerjaan" name="pekerjaan">
                              <?= getOptionList("pekerjaan") ?>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-3 form-control-sm">Status Perkawinan:</label>
                          <div class="col-9">
                            <select class="select2 dropdown-stat_kawin stat_kawin" name="stat_kawin">
                              <?= getOptionList("stat_kawin") ?>
                            </select>
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-3 form-control-sm">Kewarganegaraan:</label>
                          <div class="col-3">
                            <select class="select2 kewarganegaraan" name="kewarganegaraan">
                              <?= getOptionList("kewarganegaraan") ?>
                            </select>
                          </div>

                          <label class="col-form-label col-2 form-control-sm">Bahasa:</label>
                          <div class="col-4">
                            <select class="select2 dropdown-bahasa bahasa" name="bahasa">
                              <?= getOptionList("bahasa") ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-header">Identitas Keluarga</div>
                      <div class="card-body">
                        <div class="row form-group">
                          <label class="col-form-label col-4 form-control-sm">NO RM Ibu Kandung:</label>
                          <div class="col-8">
                            <input class="form-control form-control-sm id_mribu" type="hidden" name="id_mribu">
                            <input class="form-control form-control-sm no_mribu no" maxlength="8" name="no_mribu">
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-4 form-control-sm">Nama Ibu Kandung:</label>
                          <div class="col-8">
                            <input style="text-transform: uppercase;" class="form-control form-control-sm ibu_kandung disable-no" type="text" name="ibu_kandung">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-4 form-control-sm">Nama Ortu/Suami/Istri:</label>
                          <div class="col-4">
                            <select class="select2 dropdown-title_keluarga titel_keluarga" name="titel_keluarga">
                              <?= getOptionList("title") ?>
                            </select>
                          </div>
                          <div class="col-4">
                            <input style="text-transform: uppercase;" type="text" class="form-control form-control-sm disable-no nama_keluarga" name="nama_keluarga">
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-4 form-control-sm">Hubungan Pasien:</label>
                          <div class="col-8">
                            <select class="select2 hub_pasien" name="hub_pasien">
                              <?= getOptionList("hub_pasien") ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12" style="margin-top: 10px;">
                    <div class="card">
                      <div class="card-header">Penanggung Jawab</div>
                      <div class="card-body">
                        <div class="row form-group">
                          <label class="col-form-label col-4 form-control-sm">Penanggung Jawab:</label>
                          <div class="col-8">
                            <input style="text-transform: uppercase;" class="form-control form-control-sm nama_pj disable-no" name="nama_pj">
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-4 form-control-sm">Alamat:</label>
                          <div class="col-8">
                            <input style="text-transform: uppercase;" class="form-control form-control-sm alamat_pj" name="alamat_pj">
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-4 form-control-sm">Telepon:</label>
                          <div class="col-8">
                            <input class="form-control no telp_pj" label='Telepon' name="telp_pj">
                          </div>
                        </div>
                        <div class="row form-group">
                          <label class="col-form-label col-4 form-control-sm">Pekerjaan:</label>
                          <div class="col-8">
                            <select class="select2 pekerjaan_keluarga" name="pekerjaan_keluarga">
                              <?= getOptionList("pekerjaan") ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12" style="margin-top: 10px;">
                    <table id="dg" height="100" class="easyui-datagrid" data-options="
                                            rownumbers:true">
                      <thead>
                        <tr>
                          <th width="100%" align="left" halign="center" data-options="field: 'golongan_px'">Golongan Pasien</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr></tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-12 kt-padding-t-10-mobile" style="border-top: 2px solid #D3D3D3;padding-top: 10px;">
            <div class="form-group row ">
              <div class="col-lg-2 col-md-12 div_simpan">
                <button id="btn-simpan" type="button" class="form-control form-control-sm btn btn-sm btn-primary" onclick="SimpanInsertPasien()">
                  <i class="fas fa-save"></i>
                  Simpan
                </button>
              </div>
              <div class="col-lg-2 col-md-12 kt-padding-t-10-mobile">
                <button id="btn-batal" type="button" class="form-control form-control-sm btn btn-sm btn-secondary" onclick="ResetForm()">
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
</div>