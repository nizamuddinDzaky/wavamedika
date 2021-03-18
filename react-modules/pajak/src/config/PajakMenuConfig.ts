export default {
    header: {
        self: {},
        items: [
            {
                title: "Master",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "pajak/master",
                submenu: [
                    {
                        title: "PTKP",
                        bullet: "dot",
                        page: "pajak/master/ptkp",
                    },
                ]
            },
            {
                title: "Entry",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "pajak/entry",
                submenu: [
                    {
                        title: "Data NPWP Karyawan",
                        bullet: "dot",
                        page: "pajak/entry/data-npwp-karyawan",
                    },
                    {
                        title: "eFaktur PPN Masukan",
                        bullet: "dot",
                        page: "pajak/entry/efaktur-ppn-masukan",
                    },
                ]
            },
            {
                title: "Laporan",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "pajak/laporan",
                submenu: [
                    {
                        title: "Pajak Karyawan",
                        bullet: "dot",
                        page: "pajak/laporan/pajak-karyawan",
                    },
                    {
                        title: "PPN Keluaran",
                        bullet: "dot",
                        page: "pajak/laporan/ppn-keluaran",
                    },
                ]
            },
        ]
    },
    aside: {
        self: {},
        items: [
            {
                title: "Master",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "pajak/master",
                submenu: [
                    {
                        title: "PTKP",
                        bullet: "dot",
                        page: "pajak/master/ptkp",
                    },
                ]
            },
            {
                title: "Entry",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "pajak/entry",
                submenu: [
                    {
                        title: "Data NPWP Karyawan",
                        bullet: "dot",
                        page: "pajak/entry/data-npwp-karyawan",
                    },
                    {
                        title: "eFaktur PPN Masukan",
                        bullet: "dot",
                        page: "pajak/entry/efaktur-ppn-masukan",
                    },
                ]
            },
            {
                title: "Laporan",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "pajak/laporan",
                submenu: [
                    {
                        title: "Pajak Karyawan",
                        bullet: "dot",
                        page: "pajak/laporan/pajak-karyawan",
                    },
                    {
                        title: "PPN Keluaran",
                        bullet: "dot",
                        page: "pajak/laporan/ppn-keluaran",
                    },
                ]
            },
        ]
    }
};
