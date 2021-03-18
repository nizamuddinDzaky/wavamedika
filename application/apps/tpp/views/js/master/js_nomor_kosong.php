<script type="text/javascript">
   $(document).ready(function () {
    console.log("ready!");
    getDataTabel();
   });

   $('#btn-tambah').click(function (event) {
    $('#tambahData').window('open');
   });

   $('#btn-ubah').click(function () {
    var row = $('#dgs').datagrid('getSelected');
    if (row <= 0) {
     swal.fire(
         'Peringatan!',
         'Data Belum Dipilih!',
         'warning'
         );

    } else {
     $('#editData').window('open').window('center');
     $('#id_antrian').val(row.id_antrian);
     $('#edit_antrian').val(row.antri);
    }
   });

   $('#btn-hapus').click(function () {
    var row = $('#dgs').datagrid('getSelected');
    if (row <= 0) {
     swal.fire(
         'Peringatan!',
         'Data Belum Dipilih!',
         'warning'
         );
    } else {
     swal.fire({
      title: 'Hapus data?',
      text: "Anda tidak dapat membatalkan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus!'
     }).then((result) => {
      if (result.value) {
       var row = $('#dgs').datagrid('getSelected');
       $.ajax({
        type: "post",
        url: "<?= $urlData ?>deletegolongan",
        data: {
         "id_golonganpx": row.id_golonganpx
        },
        dataType: "JSON",
        success: function (resp) {
         swal.fire({
          icon: 'success',
          title: 'Berhasil',
          html: 'Data berhasil dihapus!',
          timer: 1000,
          timerProgressBar: true,
         });
         getDataTabel();
        },
        error: function () {
         swal.fire(
             'Peringatan!',
             'Terjadi Kesalahan Sistem!',
             'error'
             );
        }
       });
      }
     });
    }
   });

   function getDataTabel() {
    $('#dgs').datagrid({
     url: '<?= $urlData . "listnokosong" ?>',
     method: 'post',
     queryParams: {
     }
    });
   }

   function setArray(DataArray) {
    var data_x = [];
    $.each(DataArray, function (index, item) {
     data_x[item.name] = item.value;
    });
    return data_x;
   }

   function myformatter(date) {
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    // return y+'/'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
    return (d < 10 ? ('0' + d) : d) + '/' + (m < 10 ? ('0' + m) : m) + '/' + y;
   }

   function myparser(s) {
    if (!s)
     return new Date();
    var ss = (s.split('/'));
    var y = parseInt(ss[2], 10);
    var m = parseInt(ss[1], 10);
    var d = parseInt(ss[0], 10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
     return new Date(y, m - 1, d);
    } else {
     return new Date();
    }
   }

   function empty(string) {
    return (string == undefined || string == "" || string == null);
   }
</script>