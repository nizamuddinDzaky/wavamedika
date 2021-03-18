<!-- Script easy ui -->
<script type="text/javascript">
    var edit = 0;
    $(function () {
        $('#win-detail').window('close');
        $('#btn-tambah').click(function () {
            $('#win-detail').window('open');
            reset_form();
            edit = 0;
        });

        $('#btn-ubah').click(function () {
            var row = $('#dtg-satuan').datagrid('getSelected');
            if(row <= 0)
            {
                notif('warning','Data Belum dipilih!');
                return false;
            }
            getSatuan(row);
            edit = 1;
        });

        $('#btn-tampil').click(function () {
            var row = $('#dtg-satuan').datagrid('getSelected');
            if(row <= 0)
            {
                notif('warning','Data Belum dipilih!');
                return false;
            }
            getSatuan(row);
            $('#div-simpan').hide();
        });

        $('#btn-hapus').click(function () {
            var row = $('#dtg-satuan').datagrid('getSelected');
            if(row <= 0)
            {
                notif('warning','Data Belum dipilih!');
                return false;
            }
            hapus(row);
        });

        $('#btn-batal').click(function () {
            $('#win-detail').window('close');
        });

        $('#btn-simpan').click(function () {
            simpan();
        });

        filter();
    });

    function filter()
    {
        $('#dtg-satuan').datagrid('loadData',[]);
        var jns_satuan = $('#cmb-jenis option:selected').val();
        var status = $('#cmb-status option:selected').val();
        var criteria = $('#txt-kriteria').val();
      
        data={
          jns_satuan : jns_satuan,
          status : status,
          criteria : criteria,
          page:1,
          page_row:10
        } 

        console.log(data);

        // $.ajax({
        //   url : "<?php echo base_url("farmasi/master/satuan/filter"); ?>",
        //   type: "POST",
        //   dataType: 'json',
        //   data:{
        //     data: data,
        //     },
        //   beforeSend: function (){               
        //    },
        //   success:function(data, textStatus, jqXHR){
        //     if (data.metadata.list_count<1)
        //     {
        //        notif('warning','Daftar Kosong!');
        //     }
        //     $('#dtg-satuan').datagrid('loadData', data.list);
        //   },
        //   error: function(jqXHR, textStatus, errorThrown){
        //       alert('Error,'something goes wrong');
        //       notif('error','something goes wrong');
        //   },
        //   complete: function(){
        //   }
        // });

        var dg = $('#dtg-satuan').datagrid({
          url : "<?php echo base_url("farmasi/master/satuan/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            // if (data.metadata.list_count<1)
            // {
            //    notif('warning','Daftar Kosong!');
            // }
            return {
              total: data.metadata ? data.metadata.paging.rec_count : 0, 
              rows: data.list ? data.list : []
            }
          }
        });
    }

    function getSatuan(row)
    {
        $.ajax({
          url : "<?php echo base_url("farmasi/master/satuan/getPerSatuan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: row.id_satuan,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            $('#win-detail').window('open');
            reset_form();
            set_data(data);
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function set_data(data)
    {
        $('#txt-id_satuan').attr('readonly', true);
        $('#txt-id_satuan').val(data.id_satuan);
        // $('#cmb-jns_satuan').text(data.ket_jenis);
        $('#cmb-jns_satuan').val(data.jns_satuan).change();
        $('#txt-ket_jenis').val(data.nama_satuan);
        if(data.is_aktif==true)
        {
            $('#chk-is_aktif').checkbox({
                checked: true
            });
        }
        else
        {
            $('#chk-is_aktif').checkbox({
                checked: false
            });
        }
    }

    function reset_form()
    {
        $('#div-simpan').show();
        $('#txt-id_satuan').attr('readonly', false);
        $('#txt-id_satuan').val('');
        $('#txt-ket_jenis').val('');
        $('#chk-is_aktif').checkbox({
              checked: false
          });
    }

    function simpan()
    {
        var id_satuan = $('#txt-id_satuan').val();
        var nama_satuan = $('#cmb-jns_satuan option:selected').text();
        var jns_satuan = $('#cmb-jns_satuan option:selected').val();
        var ket_jenis = $('#txt-ket_jenis').val();
        var is_aktif = ($('input[name=chk-is_aktif]:checked').val()!=undefined);

        if (jns_satuan == ''||
        ket_jenis == '')
        {
          let msg = '<br>';
          if (jns_satuan == '') {
            msg += 'Jenis <br>';
          }

          if (ket_jenis == '') {
            msg += 'Satuan <br>';
          }

          notif('warning',msg + ' Tidak Boleh Kosong!');
          return false;
        }
      
        data={
          id_satuan  : id_satuan,
          nama_satuan: ket_jenis,
          jns_satuan : jns_satuan,
          is_aktif   : is_aktif,
          user_id    : "<?php echo $this->session->userdata['user_id'] ?>",
        } 

        console.log(data);

        $.ajax({
          url : "<?php echo base_url("farmasi/master/satuan/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            edit:edit,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            $('#win-detail').window('close');
            notif('success',data.metadata.message)
            filter();
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function hapus(row)
    {
        var id_satuan = row.id_satuan;
        var jns_satuan = row.jns_satuan;
        
        data={
          id_satuan : id_satuan,
          jns_satuan: jns_satuan,
          user_id   : "<?php echo $this->session->userdata['user_id'] ?>",
        } 

        console.log(data);

        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                  $.ajax({
                    url     : "<?php echo base_url("farmasi/master/satuan/hapus"); ?>",
                    type    : "POST",
                    dataType: 'json',
                    data    :{
                        data: data,
                      },
                      beforeSend: function (){               
                      },
                      success:function(data, textStatus, jqXHR){
                        notif('success',data.metadata.message)
                        filter();
                      },
                      error: function(jqXHR, textStatus, errorThrown){
                        // alert('Error,something goes wrong');
                        notif('error','something goes wrong');
                      },
                        complete: function(){
                      }
                  });
              }
        }); 
    }

</script>
<!-- end script -->