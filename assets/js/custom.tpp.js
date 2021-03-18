//var base_url = "https://www.silumansupra.com/demo/mersihospital";
//if (location.origin == "http://localhost") {
// var base_url = location.origin + "/tpp/ajax/";
//} else {
// var base_url = location.origin + "/tpp/ajax/";
//}

function getDropDown(idTag, action, url) {
	$.ajax({
		url: url,
		method: "POST",
		data: {
			act: action
		},
		beforeSend: function() {},
		success: function(data) {
			$(idTag).html(data);
		},
		error: function() {}
	});
}

function GetDropdownKota(selected = "" , url , propinsi, succsesfunc = "") {
    $.ajax({
        type: "POST",
        url: url ,
        data: {
            act:"get_kabupaten_dinamis",
            propinsi : propinsi ,
            
        },
        dataType: "JSON",
        tryCount: 0,
        retryLimit : 3,
        success: function(resp){
            // if(resp.lsdt && resp.lsdt != "undefined") {
                // var result  = "<option value=''>Pilih Kota/Kabupaten</option>";
                //     result += resp;
                // $(".dropdown-kabupaten").html(result);
                // $('.dropdown-kabupaten').combobox("loadData");
                $('.dropdown-kabupaten').combobox({
                    data:resp ,
                    valueField: 'kabupaten',
                    textField: 'kabupaten',
                });
                $(".dropdown-kabupaten").combobox("loadData");
                if(selected != "") {
                    $(".dropdown-kabupaten").val(selected).trigger("change");
                }
                if(succsesfunc != "") {
                    succsesfunc(resp);
                }
            // }
            $(".loading-dropdown-kota").addClass("hidden");
        },
        error: function(xhr, textstatus, errorthrown) {

        }
    });
}