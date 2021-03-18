$(document).ready(function () {

    // FOR ENTER to use as TAB focusing on next input (use form to apply)
    $('body').on('keydown', 'input, select', function (e) {
        if (e.key === "Enter") {
            var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this) + 1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }
    });


    accounting.settings = {
        currency: {
            symbol: "Rp", // default currency symbol is '$'
            format: "%s%v", // controls output: %s = symbol, %v = value/number (can be object: see below)
            decimal: ".", // decimal point separator
            thousand: ",", // thousands separator
            precision: 2   // decimal places
        },
        number: {
            precision: 0, // default precision on numbers is 0
            thousand: ",",
            decimal: "."
        }
    }


    // Accounting
    // Set formatted on component load
    $('.money').each(function () {
        $(this).val(accounting.formatMoney($(this).val()));
    });

    // Set unformatted on focus
    $('.money').focus(function () {
        $(this).val(accounting.unformat($(this).val()));
    });

    // Set formatted on change value
    $('.money').change(function () {
        $(this).val(accounting.formatMoney($(this).val()));
    });

    // Set formatted on blur input
    $('.money').blur(function () {
        $(this).val(accounting.formatMoney($(this).val()));
    });



    //PANEL WINDOW
    // Required: class="panel-window"
    // Optional value: data-title="bla bla bla"

    // Window Panel initialize
    $('.panel-window').each(function () {
        $(this).window({
            modal: true,
            title: $(this).data('title') ? $(this).data('title') : 'New window',
            resizable  : false,
            maximizable: false,
            collapsible: false,
            resizable  : false,
            minimizable: false
        });

        // Close Window Panel on Start
        $(this).window('close')
    });

    // FOR Change RESIZE SCREEN EVENT
    // $(window).resize(function () {
    //     var windowWidth = $(window).width();
    //     var windowHeight = $(window).height();

    //     if (windowWidth > 600) {
    //         $('.panel-window').panel('resize', {
    //             width: windowWidth * 80 / 100,
    //             height: windowHeight * 85 / 100
    //         });
    //     }
    //     else {
    //         $('.panel-window').panel('resize', {
    //             width: windowWidth * 98 / 100,
    //             height: windowHeight * 60 / 100
    //         });
    //     }

    //     $('.panel-window').window('center');
    // }).resize();


    // FOR SCROLL
    $(window).scroll(function () {
        // var height = $(window).scrollTop();
        $('.panel-window').window('center');
    });


    // DATAGRID
    // initialize datagrid
    $('.easyui-datagrid').each(function () {
        $(this).datagrid({
            nowrap: true,
            emptyMsg: 'Data Kosong',
            onLoadError:function(){
                // $.messager.alert("Mohon Cek Koneksi Anda Kembali");
            }
        });
    });

    $(window).resize(function () {
        // Resize datagrid table
        $('.easyui-datagrid').datagrid('resize');
    }).resize();

    $('.panel-window').panel({
        onOpen: function () {
            $('.easyui-datagrid').datagrid('resize');
        }
    })


    // END OF DATAGRID

    $('input[type=date-only-formatted]').each(function () {
        if ($(this).val() === null || $(this).val() === undefined || $(this).val() === '') {
            $(this).val(moment().format("DD/MM/YYYY"));
        }

        $(this).datetimepicker({
            format: "dd/mm/yyyy",
            todayHighlight: true,
            autoclose: true,
            startView: 2,
            minView: 2,
            forceParse: 0,
            pickerPosition: 'bottom-left'
        });
    })

    $('input[type=date-time-formatted]').each(function () {
        if ($(this).val() === null || $(this).val() === undefined || $(this).val() === '') {
            $(this).val(moment().format("DD-MM-YYYY HH:mm"));
        }

        $(this).datetimepicker({
            format: "dd/mm/yyyy hh:ii",
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
        });
    })

    $('input[type=time-formatted]').each(function () {
        // if($(this).val() === null || $(this).val() === undefined || $(this).val() === '') {
        //     $(this).val(moment().format("HH:mm"));
        // }

        $(this).datetimepicker({
            format: "hh:ii",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0,
            pickerPosition: 'bottom-left'
        });
    })
})