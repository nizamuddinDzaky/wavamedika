<script type="text/javascript">
	
	var edit = 0;
	var dataAkses = [];

	$(function(){
		tab(0);
		$('#btn-tambah').click(function(event) {
			edit = 0;
			reset_form();
			tab(1);
		});

		$('#btn-simpan').click(function(event) {
			simpan();
		});

		$('#btn-kembali').click(function(event) {
			tab(0);
		});

		// start fungsi button tabs akses modul
		$('#btn-tambah_akses_modul').click(function(event) {
			$('#win-detail_akses_modul').window('open');
			$('#txt-criteria_modul').val('');
			filterModul();
		});

		$('#btn-batal_detail_akses_modul').click(function(event) {
			$('#win-detail_akses_modul').window('close');
		});
		// end fungsi button tabs akses modul

		// start fungsi button tabs akses transaksi
		$('#btn-tambah_akses_transaksi').click(function(event) {
			$('#win-detail_akses_transaksi').window('open');
			$('#txt-criteria_transaksi').val('');
			filterTransaksi();
		});

		$('#btn-tutup_detail_transaksi').click(function(event) {
			$('#win-detail_akses_transaksi').window('close');
		});
		// end fungsi button tabs akses transaksi

		// start fungsi button tabs akses unit
		$('#btn-tambah_akses_unit').click(function(event) {
			$('#win-detail_akses_unit').window('open');
			$('#txt-criteria_unit').val('');
			filterUnit();
		});

		$('#btn-tutup_detail_unit').click(function(event) {
			$('#win-detail_akses_unit').window('close');
		});
		// end fungsi button tabs akses unit

		$('#dtg-daftar_role').datagrid({
			onDblClickRow:function(){
				btn_ubah();
			}
		});

		$('#dtg-akses_menu_b').treegrid({
			onSelect:function(row){
				$('#dtg-akses_menu_c').datagrid('loadData',[]);

				let role_id = $('#txt-role_id').val();

				if (row.is_granted==false || row.icon=="")
				{
					// notif('warning','Status Tidak Aktif');
					return false;
				}

				let daftar = getDataAksesMenu("GET","funcs",role_id,row.menu_id,"");
				
				// kebutuhan untuk percobaan
	        	// let daftar = getDataAksesMenu("GET","funcs",3,"FAR0101","");

				$('#dtg-akses_menu_c').datagrid('loadData',daftar);
			},
			onClickCell: function(field,row){
			    if (field == 'icon' && row.icon!="")
			    {
			    	let detailitem = [];
			    	detailitem.push(row.menu_id);

			  		let children = $('#dtg-akses_menu_b').treegrid('getChildren',row.menu_id); 
			  		
			    	let role_id = $('#txt-role_id').val();
			    	
			    	// kebutuhan untuk percobaan
			    	// role_id=3;

			    	if (row.is_granted==false)
			    	{
			    		if (children.length>0)
				  		{
				  			for (let i = 0; i < children.length; i++)
				  			{
				  				if (children[i].is_granted==false)
				  				{
				  					detailitem.push(children[i].menu_id);
				  				}
				  			}
				  		}

				  		let parent = $('#dtg-akses_menu_b').treegrid('getParent',row.menu_id);
						if (parent!=null)
						{
							if (parent.is_granted==false)
							{
								detailitem.push(parent.menu_id);
							}

							while(parent!=null)
							{
								parent = $('#dtg-akses_menu_b').treegrid('getParent',parent.menu_id);
								if (parent!=null&&parent.is_granted==false)
								{
									detailitem.push(parent.menu_id);	
								}
							}
						}
			   			//swal.fire(cocustom("Apakah Anda Yakin ?")).then(function(result) {
						//   if (result.value) {
						// 	simpanAkses(role_id,"menus",detailitem); 	
						//   }
						// });
						simpanAkses(role_id,"menus",detailitem);
			    	}
			    	else
			    	{
			    		if (children.length>0)
				  		{
				  			for (let i = 0; i < children.length; i++)
				  			{
				  				if (children[i].is_granted==true)
				  				{
				  					detailitem.push(children[i].menu_id);
				  				}
				  			}
				  		}

			   	  		let parent = $('#dtg-akses_menu_b').treegrid('getParent',row.menu_id);
						if (parent!=null)
						{
							let cek = cekChildren(parent.menu_id,true);
							if (cek==1)
							{
								detailitem.push(parent.menu_id);
							}

							while(parent!=null)
							{
								parent = $('#dtg-akses_menu_b').treegrid('getParent',parent.menu_id);
								if (parent!=null)
								{
									cek = cekChildren(parent.menu_id,true);
									if (cek==1)
									{
										detailitem.push(parent.menu_id);
									}	
								}
							}
						}
						// console.table(detailitem);
						// return false;
			   			//swal.fire(cocustom("Apakah Anda Yakin ?")).then(function(result) {
						//   if (result.value) {
						// 	hapusAkses(role_id,"menus",detailitem); 	
						//   }
						// });
						hapusAkses(role_id,"menus",detailitem);
			    	}
			    }
			}
		});

		$('#dtg-akses_menu_c').datagrid({
			onClickCell: function(index,field,value){
			    if (field == 'icon')
			    {
			    	let role_id = $('#txt-role_id').val();
			    	let rowb = $('#dtg-akses_menu_b').treegrid('getSelected');
			    	let rowc = $('#dtg-akses_menu_c').datagrid('getRows');
			    	let func_id = rowc[index]['func_id'];
			    	let is_granted = rowc[index]['is_granted'];

			    	// kebutuhan untuk percobaan
			    	// role_id=3;

			    	let detailitemparam = [];
			    	
			    	if (is_granted==false)
			    	{
			    		detailitemparam={is_granted : true, func_id : func_id};	
			    	}
			    	else
			    	{
			    		detailitemparam={is_granted : false, func_id : func_id};	
			    	}

			  //   	swal.fire(cocustom("Apakah Anda Yakin ?")).then(function(result) {
					//   if (result.value) {
					// 	let daftar = getDataAksesMenu("PATCH","funcs",role_id,rowb.menu_id,detailitemparam);
					// 	// kebutuhan untuk percobaan
			  //       	// getDataAksesMenu("PATCH","funcs",1,"FAR0101",detailitemparam);
					//   }
					// });
					let daftar = getDataAksesMenu("PATCH","funcs",role_id,rowb.menu_id,detailitemparam);
			    }
			}
		});

		$("#dtg-akses_menu_a").datagrid({
	     	onSelect: function(index, row) {
	        	setDataTree(row.module_id);
			}
	    });
	});

	function cekChildren(menu_id,is_granted)
	{
		// body...
		let children = $('#dtg-akses_menu_b').treegrid('getChildren',menu_id);
		let cek = 0;
		if (children.length>0)
  		{
  			for (let i = 0; i < children.length; i++)
  			{
  				if (children[i].is_granted==is_granted&&children[i].parent_id==menu_id)
  				{
  					cek++;
  				}
  			}
  		}

  		return cek;
	}

	function setDataTree(module_id)
	{
		// alert(row.module_id);
    	let role_id = $('#txt-role_id').val();
    	let daftar = getDataAksesMenu("GET","menus",role_id,module_id,"");
    	// kebutuhan untuk percobaan
    	// let daftar = getDataAksesMenu("GET","menus",3,"FAR","");
    	let datatree = [];

    	unselecttree('#dtg-akses_menu_b');
    	$('#dtg-akses_menu_b').treegrid('loadData',[]);
    	
    	if (daftar.length>0)
    	{
    		for (var i = 0; i < daftar.length; i++)
        	{
        		if (i==0||daftar[i]['parent_id']=="-")
        		{
        			let urutan = datatree.length;
        			datatree[urutan]=daftar[i];
        			// datatree[urutan]['icon']="";
        			datatree[urutan]['children']=[];
        		}
        		else
        		{
        			for (let j = 0; j < datatree.length; j++)
        			{
        				let hasil = loop(datatree[j],daftar[i]);
        				if (hasil['same']==1)
        				{
        					// datatree[j]['icon']="";
        					datatree[j]['children'].push(hasil['data']);
        					let index = datatree[j]['children'].length;
        					datatree[j]['children'][index-1]['children']=[];
        					break;
        				}

        				if (datatree[j]['children'].length>0)
        				{
        					for (let k = 0; k < datatree[j]['children'].length; k++) 
        					{
        						let hasil = loop(datatree[j]['children'][k],daftar[i]);
		        				if (hasil['same']==1)
		        				{
		        					// datatree[j]['children'][k]['icon']="";
		        					datatree[j]['children'][k]['children'].push(hasil['data']);
		        					let index = datatree[j]['children'][k]['children'].length;
		        					datatree[j]['children'][k]['children'][index-1]['children']=[];
		        					break;
		        				}

        						if (datatree[j]['children'][k]['children'].length>0)
        						{
        							for (let l = 0; l < datatree[j]['children'][k]['children'].length; l++) 
		        					{
		        						let hasil = loop(datatree[j]['children'][k]['children'][l],daftar[i]);
				        				if (hasil['same']==1)
				        				{
				        					// datatree[j]['children'][k]['children'][l]['icon']=""
				        					datatree[j]['children'][k]['children'][l]['children'].push(hasil['data']);
				        					let index = datatree[j]['children'][k]['children'][l]['children'].length;
				        					datatree[j]['children'][k]['children'][l]['children'][index-1]['children']=[];
				        					break;
				        				}

		        						if (datatree[j]['children'][k]['children'][l]['children'].length>0)
		        						{
		        							for (let m = 0; m < datatree[j]['children'][k]['children'][l]['children'].length; m++) 
				        					{
				        						let hasil = loop(datatree[j]['children'][k]['children'][l]['children'][m],daftar[i]);
						        				if (hasil['same']==1)
						        				{
						        					// datatree[j]['children'][k]['children'][l]['children'][m]['icon']="";
						        					datatree[j]['children'][k]['children'][l]['children'][m]['children'].push(hasil['data']);
						        					let index = datatree[j]['children'][k]['children'][l]['children'][m]['children'].length;
						        					datatree[j]['children'][k]['children'][l]['children'][m]['children'][index-1]['children']=[];
						        					break;
						        				}

				        						if (datatree[j]['children'][k]['children'][l]['children'][m]['children'].length>0)
				        						{
				        							for (let n = 0; n < datatree[j]['children'][k]['children'][l]['children'][m]['children'].length; n++) 
						        					{
						        						let hasil = loop(datatree[j]['children'][k]['children'][l]['children'][m]['children'][n],daftar[i]);
								        				if (hasil['same']==1)
								        				{
								        					// datatree[j]['children'][k]['children'][l]['children'][m]['children'][n]['icon']="";
								        					datatree[j]['children'][k]['children'][l]['children'][m]['children'][n]['children'].push(hasil['data']);
								        					let index = datatree[j]['children'][k]['children'][l]['children'][m]['children'][n]['children'].length;
								        					datatree[j]['children'][k]['children'][l]['children'][m]['children'][n]['children'][index-1]['children']=[];
								        					break;
								        				}

						        						if (datatree[j]['children'][k]['children'][l]['children'][m]['children'][n]['children'].length>0)
						        						{
						        							notif('error','Children Sudah Mencapai Batas Maximum');
						        						}
						        					}
				        						}
				        					}
		        						}
		        					}
        						}
        					}
        				}
        			}
        		}
        	}
    	}

    	$('#dtg-akses_menu_b').treegrid('loadData',datatree);
	}

	function loop(datatree,daftar)
	{
		// body...
		let data = [];
		data['same']=0;
		if (datatree.length>0)
		{
			for (let k = 0; k < datatree.length; k++)
			{
				if (datatree[k]['menu_id']==daftar['parent_id'])
				{
					data['same']=1;
					data['data']=daftar;
					break
				}
			}
		}
		else
		{
			if (datatree['menu_id']==daftar['parent_id'])
			{
				data['same']=1;
				data['data']=daftar;
			}
		}

		return data;
	}

	function tab(tab)
	{
		if(tab==0)
		{
			$('#browse').show();
			$('#detail').hide();
			filter();
		}
		else
		{
			if (edit==0) 
			{
				$('#tabs-detail').hide();
				$("#footer_detail").hide();
			}
			else
			{
				$('#tabs-detail').show();
				$("#footer_detail").show();
			}

			$('#browse').hide();
			$('#detail').show();
		}
	}

	function btn_ubah()
    {
        edit = 1;

        var row = $('#dtg-daftar_role').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di pilih');
            return false;
        }

        reset_form();
        getData(row.role_id);
    }

    function unselect(datagrid)
    {
    	// body...
    	let rows = $(datagrid).datagrid('getRows');
    	// alert(rows.length);
		for (i=0;i<rows.length;i++)
		{
			$(datagrid).datagrid('unselectRow', i);
		}
    }

    function unselecttree(treegrid)
    {
    	// body...
    	let rows = $(treegrid).treegrid('getRows');
    	// alert(rows.length);
		for (i=0;i<rows.length;i++)
		{
			$(treegrid).treegrid('unselectRow', i);
		}
    }

	function filter()
    {
    	unselect('#dtg-daftar_role');

        $('#dtg-daftar_role').datagrid('loadData',[]);

        var status = $('#cmb-status').val();
        var criteria = $('#txt-criteria').val();
      
        data={
          data_status : status,
          criteria : criteria,
          page:1,
          page_row:10
        } 

        var dg = $('#dtg-daftar_role').datagrid({
          url : "<?php echo base_url("admin/Role/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.rows ? data.rows : []
            }
          }
        });
    }

	function simpan()
    {
        let role_id = $('#txt-role_id').val();
        let role_name = $('#txt-role_name').val();
        let role_desc = $('#txt-role_desc').val();
        let tags = $('#txt-tags').val();
        let is_aktif = ($('input[name=chk-is_aktif]:checked').val()!=undefined);

        if (role_name == ''||
        role_desc == '' || tags == '')
        {
          let msg = '<br>';
          if (role_name == '') {
            msg += 'Nama Role <br>';
          }

          if (role_desc == '') {
            msg += 'Deskripsi <br>';
          }

          if (tags == '') {
            msg += 'Tags <br>';
          }

          notif('warning',msg + ' Tidak Boleh Kosong!');
          return false;
        }
      
        data={
          role_name : role_name,
          role_desc : role_desc,
          tags : tags
        }

        let metode;

        if(role_id!='')
        {
        	data['role_id']=role_id;
        	data['is_active']=is_aktif;
        	metode = 'PUT';
        }
        else
        {
        	metode = 'POST';
        }

        $.ajax({
          url : "<?php echo base_url("admin/Role/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            method:metode
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            notif('success',data.message);
            if (edit==0)
            {
            	$('#txt-role_id').val(data.role_id);
	            $('#tabs-detail').show();
	            $("#btn-hapus").show();
	            edit=1;
            }
            else
            {
            	tab(0);
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
			notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    $('#btn-tambahkan_modul').click(function(){
    	let rows = $('#dtg-daftar_akses_modul').datagrid('getSelections');
    	let detailitem = [];

    	if (rows.length<1)
    	{
    		notif('warning','Belum ada data yang dipilih');
    		return false;
    	}

    	// alert(rows.length);
		for (i=0;i<rows.length;i++)
		{
			detailitem.push(rows[i].module_id);
		}

		let role_id = $('#txt-role_id').val();
		
		simpanAkses(role_id,"modules",detailitem);

		$('#txt-criteria_modul').val('');
		filterModul();

		reloadDelay("modules",2000);
		reloadDelay("modules",4000);
    });

    $('#btn-hapus_akses_modul').click(function(){
    	let rows = $('#dtg-akses_modul').datagrid('getSelections');
    	let rowsbefore = $('#dtg-akses_modul').datagrid('getRows');
    	let detailitem = [];

    	if (rows.length<1)
    	{
    		notif('warning','Data Belum dipilih');
    		return false;
    	}

    	// alert(rows.length);
		for (i=0;i<rows.length;i++)
		{
			detailitem.push(rows[i].module_id);
		}

		let role_id = $('#txt-role_id').val();

		swal.fire(cohapus()).then(function(result) {
			if (result.value)
			{
				hapusAkses(role_id,"modules",detailitem);

				reloadDelay("modules",2000);
				reloadDelay("modules",4000);
			}
		});
    });

    $('#btn-tambahkan_transaksi').click(function(){
    	let rows = $('#dtg-daftar_akses_transaksi').datagrid('getSelections');
    	let detailitem = [];

    	if (rows.length<1)
    	{
    		notif('warning','Belum ada data yang dipilih');
    		return false;
    	}

		for (i=0;i<rows.length;i++)
		{
			detailitem.push(rows[i].trans_code);
		}

		let role_id = $('#txt-role_id').val();
		
		simpanAkses(role_id,"trans",detailitem);

		$('#txt-criteria_transaksi').val('');
		filterTransaksi();

		reloadDelay("trans",2000);
		reloadDelay("trans",4000);
    });

    $('#btn-hapus_akses_transaksi').click(function(){
    	let rows = $('#dtg-akses_transaksi').datagrid('getSelections');
    	let detailitem = [];

    	if (rows.length<1)
    	{
    		notif('warning','Data Belum dipilih');
    		return false;
    	}

		for (i=0;i<rows.length;i++)
		{
			detailitem.push(rows[i].trans_code);
		}

		let role_id = $('#txt-role_id').val();
		
		swal.fire(cohapus()).then(function(result) {
			if (result.value)
			{
				hapusAkses(role_id,"trans",detailitem);

				reloadDelay("trans",2000);
				reloadDelay("trans",4000);
			}
		});
    });

    $('#btn-tambahkan_unit').click(function(){
    	let rows = $('#dtg-daftar_akses_unit').datagrid('getSelections');
    	let detailitem = [];

    	if (rows.length<1)
    	{
    		notif('warning','Belum ada data yang dipilih');
    		return false;
    	}

		for (i=0;i<rows.length;i++)
		{
			detailitem.push(rows[i].id_unit);
		}

		let role_id = $('#txt-role_id').val();
		
		simpanAkses(role_id,"units",detailitem);

		$('#txt-criteria_unit').val('');
		filterUnit();

		reloadDelay("units",2000);
		reloadDelay("units",4000);
    });

    $('#btn-hapus_akses_unit').click(function(){
    	let rows = $('#dtg-akses_unit').datagrid('getSelections');
    	let detailitem = [];

    	if (rows.length<1)
    	{
    		notif('warning','Data Belum dipilih');
    		return false;
    	}

		for (i=0;i<rows.length;i++)
		{
			detailitem.push(rows[i].id_unit);
		}

		let role_id = $('#txt-role_id').val();
		
		swal.fire(cohapus()).then(function(result) {
			if (result.value)
			{
				hapusAkses(role_id,"units",detailitem);

				reloadDelay("units",2000);
				reloadDelay("units",4000);
			}
		});
    });

    function simpanAkses(role_id,akses,detailitem)
    {
    	// body...
    	
    	$.ajax({
		    url : "<?php echo base_url("admin/Role/simpanAkses"); ?>",
		    type: "POST",
		    dataType: 'json',
		    async : false,
		    data:{
		      role_id : role_id,
		      akses : akses,
		      detailitem : detailitem
		      },
		    beforeSend: function (){               
		     },
		    success:function(data, textStatus, jqXHR){
		    	reloadAkses(akses);
		    },
		    error: function(jqXHR, textStatus, errorThrown){
		        notif('error','Error,something goes wrong');
		    },
		    complete: function(){
		    }
		});
    }

    function hapusAkses(role_id,akses,detailitem)
    {
    	// body...
    	$.ajax({
		    url : "<?php echo base_url("admin/Role/deleteAkses"); ?>",
		    type: "POST",
		    dataType: 'json',
		    async : false,
		    data:{
		      role_id : role_id,
		      akses : akses,
		      detailitem : detailitem
		      },
		    beforeSend: function (){               
		     },
		    success:function(data, textStatus, jqXHR){
		    	reloadAkses(akses);
		    },
		    error: function(jqXHR, textStatus, errorThrown){
		        notif('error','Error,something goes wrong');
		    },
		    complete: function(){
		    }
		});
    }

    function reloadDelay(akses,delay)
    {
    	setTimeout(function() {
		  reloadAkses(akses);
		}, delay);
    }

    function reloadAkses(akses)
    {
    	// body...
    	if (akses=="all")
    	{
    		daftarAkses("modules",0);
    		daftarAkses("trans",0);
    		daftarAkses("units",0);
    		daftarAkses("menus",0);
    	}
    	else
    	{
    		if (akses=="modules")
	    	{
	    		// $('#win-detail_akses_modul').window('close');
	    		daftarAkses("modules",0);
	    		daftarAkses("menus",0);
	    		// $('#win-detail_akses_modul').window('close');
	    	}
	    	else if (akses=="trans")
	    	{
	    		// $('#win-detail_akses_transaksi').window('close');
	    		daftarAkses("trans",0);
	    		// $('#win-detail_akses_transaksi').window('close');	
	    	}
	    	else if (akses=="units")
	    	{
	    		// $('#win-detail_akses_unit').window('close');
	    		daftarAkses("units",0);
	    		// $('#win-detail_akses_unit').window('close');
	    	}
	    	else if (akses=="menus")
	    	{
	    		daftarAkses("menus",1);
	    	}
    	}
    }

    function daftarAkses(akses,nomor)
    {
    	// body...
    	let role_id = $('#txt-role_id').val();
    	let daftar;

    	if (akses=="menus" && nomor==0)
    	{
    		daftar = getDataAkses(role_id,"","modules");

    		unselect('#dtg-akses_menu_a');
    		$('#dtg-akses_menu_a').datagrid('loadData',[]);
    		
    		unselecttree('#dtg-akses_menu_b');
    		$('#dtg-akses_menu_b').treegrid('loadData',[]);
    		
    		unselect('#dtg-akses_menu_c');
    		$('#dtg-akses_menu_c').datagrid('loadData',[]);

    		$('#dtg-akses_menu_a').datagrid('loadData',daftar);

    	}
    	else if (akses=="menus" && nomor==1)
    	{
    		unselecttree('#dtg-akses_menu_b');
    		$('#dtg-akses_menu_b').treegrid('loadData',[]);
    		
    		unselect('#dtg-akses_menu_c');
    		$('#dtg-akses_menu_c').datagrid('loadData',[]);

    		let row = $('#dtg-akses_menu_a').datagrid('getSelected');
    		setDataTree(row.module_id);
    	}
    	else
    	{
    		daftar = getDataAkses(role_id,"",akses);
    	}
    	
    	if (akses=="modules")
    	{
    		unselect('#dtg-akses_modul');
    		$('#dtg-akses_modul').datagrid('loadData',[]);
    		$('#dtg-akses_modul').datagrid('loadData',daftar);
    	}
    	else if (akses=="trans")
    	{
    		unselect('#dtg-akses_transaksi');
    		$('#dtg-akses_transaksi').datagrid('loadData',[]);
    		$('#dtg-akses_transaksi').datagrid('loadData',daftar);
    	}
    	else if (akses=="units")
    	{
    		unselect('#dtg-akses_unit');
    		$('#dtg-akses_unit').datagrid('loadData',[]);
    		$('#dtg-akses_unit').datagrid('loadData',daftar);
    	}
    }

    function getData(role_id)
    {
		$.ajax({
		    url : "<?php echo base_url("admin/Role/get"); ?>",
		    type: "POST",
		    dataType: 'json',
		    data:{
		      role_id : role_id,
		      },
		    beforeSend: function (){               
		     },
		    success:function(data, textStatus, jqXHR){
		      set_data(data);
		      tab(1);
		    },
		    error: function(jqXHR, textStatus, errorThrown){
		        notif('error','Error,something goes wrong');
		    },
		    complete: function(){
		    }
		});
    }

    function set_data(data)
    {
		$('#txt-role_id').val(data.master.role_id);
		$("#txt-role_name").val(data.master.role_name);
		$("#txt-role_desc").val(data.master.role_desc);
		$("#txt-tags").val(data.master.tags);

		if(data.master.is_active==true)
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

		reloadAkses("all");
    }

    function reset_form()
    {	
    	$('#txt-role_id').attr('readonly', 'true');

    	$('#txt-role_id').val('');
		$("#txt-role_name").val('');
		$("#txt-role_desc").val('');
		$("#txt-tags").val('');
		
		$('#chk-is_aktif').checkbox({
		    checked: true
		});

		$('#dtg-akses_modul').datagrid('loadData',[]);

		$('#dtg-akses_menu_a').datagrid('loadData',[]);
		$('#dtg-akses_menu_b').treegrid('loadData',[]);
		$('#dtg-akses_menu_c').datagrid('loadData',[]);

		$('#dtg-akses_transaksi').datagrid('loadData',[]);
		
		$('#dtg-akses_unit').datagrid('loadData',[]);
    }

    function getDataAkses(role_id,criteria,akses)
    {
    	// body...
    	dataAkses = [];

    	$.ajax({
		    url : "<?php echo base_url("admin/Role/getAkses"); ?>",
		    type: "POST",
		    dataType: 'json',
		    async : false,
		    data:{
		      role_id : role_id,
		      criteria : criteria,
		      akses : akses
		      },
		    beforeSend: function (){               
		     },
		    success:function(data, textStatus, jqXHR){
		      dataAkses = data.rows;
		    },
		    error: function(jqXHR, textStatus, errorThrown){
		        notif('error','Error,something goes wrong');
		    },
		    complete: function(){
		    }
		});

		return dataAkses;
    }

    function getDataAksesMenu(metode,akses,role_id,id_item,detailmenu)
    {
    	// body...
    	dataAkses = [];

    	let param = [];
    	param = {
	      role_id : role_id,
	      id_item : id_item,
	      akses : akses,
	      metode : metode
		};

    	$.ajax({
		    url : "<?php echo base_url("admin/Role/getAksesMenu"); ?>",
		    type: "POST",
		    dataType: 'json',
		    async : false,
		    data:{data:param,detail:detailmenu},
		    beforeSend: function (){               
		     },
		    success:function(data, textStatus, jqXHR){
		      if (metode!="PATCH")
		      {
		      	dataAkses = data.rows;
		      }
		      else
		      {
		      	unselect('#dtg-akses_menu_c');
		      	$('#dtg-akses_menu_c').datagrid('loadData',[]);
		      	let daftar = getDataAksesMenu("GET","funcs",role_id,id_item,"");
				
				// kebutuhan untuk percobaan
	        	// let daftar = getDataAksesMenu("GET","funcs",3,"FAR0101","");

				$('#dtg-akses_menu_c').datagrid('loadData',daftar);
		      }
		    },
		    error: function(jqXHR, textStatus, errorThrown){
		        notif('error','Error,something goes wrong');
		    },
		    complete: function(){
		    }
		});
		
		return dataAkses;
    }

    function filterModul()
    {
    	// body...
    	unselect('#dtg-daftar_akses_modul');
    	$('#dtg-daftar_akses_modul').datagrid('loadData',[]);

    	let role_id = $('#txt-role_id').val();
    	let criteria = $('#txt-criteria_modul').val();

    	let daftar = getDataAkses(role_id,criteria,"modulesadd");

    	$('#dtg-daftar_akses_modul').datagrid('loadData',daftar);

    	// if (daftar.length<1)
    	// {
    	// 	notif("warning","Data Kosong");
    	// }
    	// else
    	// {
    	// 	$('#dtg-daftar_akses_modul').datagrid('loadData',daftar);
    	// }
    }

    function filterTransaksi()
    {
    	// body...
    	unselect('#dtg-daftar_akses_transaksi');
    	$('#dtg-daftar_akses_transaksi').datagrid('loadData',[]);

    	let role_id = $('#txt-role_id').val();
    	let criteria = $('#txt-criteria_transaksi').val();

    	let daftar = getDataAkses(role_id,criteria,"transadd");

    	$('#dtg-daftar_akses_transaksi').datagrid('loadData',daftar);

    	// if (daftar.length<1)
    	// {
    	// 	notif("warning","Data Kosong");
    	// }
    	// else
    	// {
    	// 	$('#dtg-daftar_akses_transaksi').datagrid('loadData',daftar);
    	// }
    }

    function filterUnit()
    {
    	// body...
    	unselect('#dtg-daftar_akses_unit');
    	$('#dtg-daftar_akses_unit').datagrid('loadData',[]);

    	let role_id = $('#txt-role_id').val();
    	let criteria = $('#txt-criteria_unit').val();

    	let daftar = getDataAkses(role_id,criteria,"unitsadd");

    	$('#dtg-daftar_akses_unit').datagrid('loadData',daftar);

    	// if (daftar.length<1)
    	// {
    	// 	notif("warning","Data Kosong");
    	// }
    	// else
    	// {
    	// 	$('#dtg-daftar_akses_unit').datagrid('loadData',daftar);
    	// }
    }

    function hapus()
    {
		let role_id = $('#txt-role_id').val();

		data={
			role_id : role_id
		} 

		swal.fire(cohapus()).then(function(result) {
		  if (result.value) {
		    	$.ajax({
			       	url : "<?php echo base_url("admin/Role/delete"); ?>",
			        type: "POST",
			        dataType: 'json',
			        data:{
			          data: data,
			          },
			        beforeSend: function (){               
			         },
			        success:function(data, textStatus, jqXHR){
						notif('success',data.message);
						tab(0);
			        },
			        error: function(jqXHR, textStatus, errorThrown){
						notif('error','Error,something goes wrong');
			        },
			        complete: function(){
			        }
		    	});
		  }
		});
    }

</script>