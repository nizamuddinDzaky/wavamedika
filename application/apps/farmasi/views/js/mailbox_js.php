<script type="text/javascript">
var currentPage = 1;
var currentStatus = 0;
var currentType = '';
var maxPage = 0;
var minPage = 0
var selectedMessage = '';
  $(function () {
    loadInbox(0, 1)
    load_notif(); // This will run on page load
    $('#card-detail').hide();
    // $('table#tb-mail').on('click', 'tr', function() {
    //   $('table#tb-mail tr').css("background-color","");
    //   $(this).css("background-color","#0000ff24");
    //   $('#card-detail').show();
    //   set_detail_card($(this).data('json'))
    // });

    $('#btn-tampilkan-doc').click(function(){
      url = "<?php echo base_url(); ?>" + $(this).val()
      window.open(url, 'name');
    })
    $('body').on('click', '.row-message td:not(:first-child)', function(){
      $('#card-detail').show();
      var row = $(this).closest('tr');
      msg_id = []
      msg_id.push(row.data('json').msg_id);
      selectedMessage = row.data('json').msg_id
      var data = {
        msg_id:msg_id,
        msg_status:2
      }
      changeStatusInbox(data)
      set_detail_card(row.data('json'))
    })

    $('body').on('dblclick', '.row-approval td:not(:first-child)', function(){
      var row = $(this).closest('tr');
      url = "<?php echo base_url(); ?>" + row.data('json').page
      window.open(url, 'name'); 
    })

    $('#next-inbox').click(function(){
      var temp = currentPage + 1;
      if(temp <= maxPage){
        currentPage = temp
        if(currentType == 'inbox'){
          loadInbox(currentStatus, currentPage)
        }else{
          loadApproval(currentStatus, currentPage)
        }
      }
    })

    $('#prev-inbox').click(function(){
      var temp  = currentPage - 1
      if(temp > minPage){
        currentPage = temp
        if(currentType == 'inbox'){
          loadInbox(currentStatus, currentPage)
        }else{
          loadApproval(currentStatus, currentPage)
        }
      }
    })

    $('.inbox').click(function(){
      loadInbox(0, 1)
    })
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for glyphicon and font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var glyph = $this.hasClass('glyphicon')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (glyph) {
        $this.toggleClass('glyphicon-star')
        $this.toggleClass('glyphicon-star-empty')
      }

      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
  })

function triggerInbox(data){
  $( "table#tb-mail tr#"+data+' td' ).trigger( "click" );
}

function triggerApproval(data){
  $( "table#tb-mail tr#"+data+' td' ).trigger( "dblclick" );
}

function load_notif(){
  $.ajax({
      url : "<?php echo base_url("farmasi/mailbox/notif"); ?>",
      type: "POST",
      dataType: 'json',
      beforeSend: function (){               
      },
      success:function(data, textStatus, jqXHR){
        // console.log(data);
        $('#tot-message').text(data.new_msg.count);
        $('#tot-notif').text(data.pending_approval.count);
        $('#badge-inbox').text(data.new_msg.count);
        set_body_message(data)
        set_body_approval(data)
          // $("#cmb-payment").select2({ data: data });
      },
      error: function(jqXHR, textStatus, errorThrown){
          notif('error','something goes wrong');
      },
      complete: function(){
      }
  });
}

function set_body_message(data){
  var str = '<div style="margin-left: 20px;">You have ' + //menambahkan spasi di you have
              '<span class="kt-font-bold">'+ data.new_msg.count +' New</span> Messages' +
              '<a href="#" class="pull-right" style="margin-right: 20px;" onClick="refreshInbox(0,1)">view all</a>' +
            '</div>'
            '<div class="dropdown-divider"></div>';
  for(var i = 0 ; i < data.new_msg.data.length; i++){
    str += '<a href="#" class="kt-notification__item" onclick="triggerInbox(\''+data.new_msg.data[i].msg_id+'\')">'+
              '<div class="kt-notification__item-icon">' +
                '<img src="'+data.new_msg.data[i].from_user_pic+'" alt="User Avatar" class="img-size-50 mr-3 img-circle kt-font-success">'+
              '</div>'+
              '<div class="kt-notification__item-details">'+
                '<div class="row justify-content-between kt-position-tittle">'+
                  '<p class="kt-notification__item-title kt-font-bold"> '+ data.new_msg.data[i].from_user +' </p>'+
                  '<span class="kt-notification__item-time kt-font-sm pull-right">'+ appGridDateTimeFormatter(data.new_msg.data[i].msg_date) +' </span>'+
                '</div>'+
                '<span class="kt-message kt-font-sm"> '+data.new_msg.data[i].subject+'</span>'+
              '</div>'+
            '</a>'
  }
  $('#div-notif-message').html(str)
}

function set_body_approval(data){
  var str = '<div style="margin-left: 20px;">You have ' + //menambahkan spasi di you have
              '<span class="kt-font-bold">'+data.pending_approval.count+' pending</span> task' +
              '<a href="#" class="pull-right" style="margin-right: 20px;" onClick="refreshApproval(0,1)">view all</a>' +
            '</div>' +
            '<div class="dropdown-divider"></div>' ;
  for(var i = 0 ; i < data.pending_approval.data.length; i++){
    str += '<a href="#" class="kt-notification__item" onclick="triggerApproval(\''+data.new_msg.data[i].msg_id+'\')">'+
              '<div class="kt-notification__item-icon">' +
                '<img src="'+data.pending_approval.data[i].from_user_pic+'" alt="User Avatar" class="img-size-50 mr-3 img-circle kt-font-success">'+
              '</div>'+
              '<div class="kt-notification__item-details">'+
                '<div class="row justify-content-between kt-position-tittle">'+
                  '<p class="kt-notification__item-title kt-font-bold"> '+ data.pending_approval.data[i].from_user +' </p>'+
                  '<span class="kt-notification__item-time kt-font-sm pull-right">'+ appGridDateTimeFormatter(data.pending_approval.data[i].msg_date) +' </span>'+
                '</div>'+
                '<span class="kt-message kt-font-sm"> '+data.pending_approval.data[i].subject+'</span>'+
              '</div>'+
            '</a>'
  }
  $('#div-notif-approval').html(str)
}

function loadInbox(status, page){
  currentStatus = status
  currentType = 'inbox';
  $('#tb-mail').html('');
  data = {
    data_status:status,
    criteria:$("#input-search").val(),
    page_row:10,
    page:page
  }

  $.ajax({
      url : "<?php echo base_url("farmasi/mailbox/inbox"); ?>",
      type: "POST",
      dataType: 'json',
      data:{
        data: data
        },
      beforeSend: function (){               
      },
      success:function(data, textStatus, jqXHR){
        set_mail_inbox(data)
          // $("#cmb-payment").select2({ data: data });
      },
      error: function(jqXHR, textStatus, errorThrown){
          notif('error','something goes wrong');
      },
      complete: function(){
      }
  });
}

function loadApproval(status, page){
  currentStatus = status
  currentType = 'approval';
  $('#card-detail').hide();
  $('#tb-mail').html('');
  data = {
    data_status:status,
    criteria:$("#input-search").val(),
    page_row:10,
    page:page
  }

  $.ajax({
      url : "<?php echo base_url("farmasi/mailbox/approval"); ?>",
      type: "POST",
      dataType: 'json',
      data:{
        data: data
        },
      beforeSend: function (){               
      },
      success:function(data, textStatus, jqXHR){
        set_mail_approval(data)
          // $("#cmb-payment").select2({ data: data });
      },
      error: function(jqXHR, textStatus, errorThrown){
          notif('error','something goes wrong');
      },
      complete: function(){
      }
  });
}

function set_mail_approval(data){
  var str = '';
  //menambahkan label ke html
  var label = '';

  label +=  '<div style="width: 22%;">'+
              '<div class="col-label-custom kt-font-bold">Pengirim</div>'+
            '</div>'+
            '<div style="width: 39%;">'+
              '<label class="col-label-custom kt-font-bold">Nama Transaksi</label>'+
            '</div>'+
            '<div style="width: 21%;">'+
              '<label class="col-label-custom kt-font-bold">No. Transaksi</label>'+
            '</div>'+
            '<div style="width: 16%;">'+
              '<label class="col-label-custom kt-font-bold">Waktu</label>'+
            '</div>';
  //end label ke html
  
  for(var i = 0 ; i < data.rows.length ; i++){
    var bg = '';
    if(data.rows[i].approval_status == 1){
      bg = 'background-color : #00ff4333';
    }
    str += '<tr class="row-approval" style="cursor: pointer; '+bg+'" id="'+data.rows[i].msg_id+'" data-json = \''+JSON.stringify(data.rows[i])+'\'>'+
              '<td>'+
              '</td>' +
              '<td class="mailbox-name"><a href="#">'+data.rows[i].from_user+'</a></td>'+
              '<td class="mailbox-name">'+data.rows[i].trans_desc+'</td>'+
              '<td class="mailbox-subject"><b>'+data.rows[i].trans_no+'</b>'+
              '</td>'+
              '<td class="mailbox-attachment"></td>'+
              '<td class="mailbox-date kt-width-date">'+appGridDateTimeFormatter(data.rows[i].msg_date)+'</td>'+
            '</tr>';
  }
  var start = ((currentPage-1) * 10) + 1;
  var end = currentPage * 10;
  maxPage = data.paging.page_count;
  var strPage = start + '-' + end + '/' + data.paging.rec_count;
  $('#label-page-inbox').text(strPage);
  //menambahkan komponen html
  $('#header-tabel').html(label);
  $('#tb-mail').html(str);
}

function mark(status, page){
  // currentStatus = status
  // currentType = 'inbox';
  $('#tb-mail').html('');
  data = {
    data_status:status,
    criteria:$("#input-search").val(),
    page_row:10,
    page:page
  }

  $.ajax({
      url : "<?php echo base_url("farmasi/mailbox/inbox"); ?>",
      type: "POST",
      dataType: 'json',
      data:{
        data: data
        },
      beforeSend: function (){               
      },
      success:function(data, textStatus, jqXHR){
        
          // $("#cmb-payment").select2({ data: data });
      },
      error: function(jqXHR, textStatus, errorThrown){
          notif('error','something goes wrong');
      },
      complete: function(){
      }
  });
}

function refreshInbox(status, page){
  currentPage = 1
  currentStatus = status
  loadInbox(status, page)
  //menambahkan button show
  $('#btn-check_all').show();
  $('#div_button').show();
  $('#btn-refresh').show();
  //end button show
}

function refreshApproval(status, page){
  currentPage = 1
  currentStatus = status
  loadApproval(status, page)
  //menambahkan button hide
  $('#btn-check_all').hide();
  $('#div_button').hide();
  $('#btn-refresh').hide();
  //end button hide
}

function set_mail_inbox(data){
  var str = '';
  //menambahkan label ke html
  var label = '';

  label +=  
            '<div style="width: 18%;">'+
              '<div class="col-label-custom kt-font-bold">Pengirim</div>'+
            '</div>'+
            '<div style="width: 65%;">'+
              '<label class="col-label-custom kt-font-bold">Perihal</label>'+
            '</div>'+
            '<div style="width: 14%;">'+
              '<label class="col-label-custom kt-font-bold">Waktu</label>'+
            '</div>';
  //end label html
  
  for(var i = 0 ; i < data.rows.length ; i++){
    var bg = '';
    if(data.rows[i].msg_status == 1){
      bg = 'background-color : #00ff4333';
    }else if(data.rows[i].msg_id == selectedMessage){
      bg = 'background-color : #0000ff24';
    }
    str += '<tbody>'+
              '<tr class="row-message" style="cursor: pointer; '+bg+'" id="'+data.rows[i].msg_id+'" data-json = \''+JSON.stringify(data.rows[i])+'\'>'+
                '<td class="kt-width-check">'+
                  '<div class="icheck-primary">'+
                    '<input type="checkbox" id="check1" value=\''+data.rows[i].msg_id+'\'>'+
                    '<label for="check1"></label>'+
                  '</div>'+
                '</td>' +
                '<td class="mailbox-name kt-width-name"><a href="#">'+data.rows[i].from_user+'</a></td>'+
                '<td class="mailbox-subject kt-minim-subject"><b>'+data.rows[i].subject+'</b> - '+data.rows[i].body_text+
                '</td>'+
                
                '<td class="mailbox-date kt-width-date">'+appGridDateTimeFormatter(data.rows[i].msg_date)+'</td>'+
              '</tr>'+
            '</tbody>';
  }
  var start = ((currentPage-1) * 10) + 1;
  var end = currentPage * 10;
  maxPage = data.paging.page_count;
  var strPage = start + '-' + end + '/' + data.paging.rec_count;
  $('#label-page-inbox').text(strPage);
  $('#header-tabel').html(label);
  $('#tb-mail').html(str);
}

function set_detail_card(data){
  $('#pengirim').text(': '+data.from_user) //menghilangkan id message
  $('#tanggal').text(appGridDateTimeFormatter(data.msg_date));
  $('#btn-tampilkan-doc').val(data.page);
  if(currentType == 'inbox'){
    $('#judul').text(': '+data.subject)
    $('#header').text(data.body_text)
    if(data.is_approval){
      $('#btn-tampilkan-doc').show()
    }else{
      $('#btn-tampilkan-doc').hide()
    }
  }else{
    $('#judul').text(': '+data.trans_no)
    $('#header').text(data.trans_desc)
  }

}

function refreshCurrentPage(){
  if(currentType=='inbox'){
    loadInbox(currentStatus, currentPage)
  }else{
    loadApproval(currentStatus, currentPage)
  }
}

function search_mail(status, page){
  if(currentType=='inbox'){
    refreshInbox(status, page)
  }else{
    refreshApproval(status, page)
  }
}

function changeStatus(status){
  if(currentType == 'inbox'){
    var msg_id = []
    $('.mailbox-messages input[type=\'checkbox\']:checked').each(function() {
      id = this.value
      msg_id.push(id)
    });
    var data = {
      msg_id:msg_id,
      msg_status:status
    }
    changeStatusInbox(data)
  }else{

  }
}

function changeStatusInbox(data){
  

  $.ajax({
    url : "<?php echo base_url("farmasi/mailbox/markInbox"); ?>",
    type: "POST",
    dataType: 'json',
    data: {
      data: data
    },
    beforeSend: function (){               
    },
    success:function(data, textStatus, jqXHR){
      // console.log(data);
      loadInbox(0, 1)
        // $("#cmb-payment").select2({ data: data });
    },
    error: function(jqXHR, textStatus, errorThrown){
        notif('error','something goes wrong');
    },
    complete: function(){
    }
  });
}

function changeStatusApproval(status){
  var msg_id = []
  $('.mailbox-messages input[type=\'checkbox\']:checked').each(function() {
    id = this.value
    msg_id.push(id)
  });
  var data = {
    msg_id:msg_id,
    msg_status:status
  }

  $.ajax({
    url : "<?php echo base_url("farmasi/mailbox/markApproval"); ?>",
    type: "POST",
    dataType: 'json',
    data: {
      data: data
    },
    beforeSend: function (){               
    },
    success:function(data, textStatus, jqXHR){
      // console.log(data);
      loadInbox(0, 1)
        // $("#cmb-payment").select2({ data: data });
    },
    error: function(jqXHR, textStatus, errorThrown){
        notif('error','something goes wrong');
    },
    complete: function(){
    }
  });
}

setInterval(function(){
    load_notif() // this will run after every 5 seconds
}, 20000);
</script>