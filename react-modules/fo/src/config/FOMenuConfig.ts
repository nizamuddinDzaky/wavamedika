export default {
    header: {
        self: {},
        items: [
            {
                title: "Master",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "fo/master-data",
                submenu: [
                    {
                        title: "Data Pasien",
                        bullet: "dot",
                        page: "fo/master-data/data-pasien",
                    },
                    {
                        title: "Angket Pelanggan",
                        bullet: "dot",
                        page: "fo/master-data/angket-pelanggan"
                    },
                    {
                        title: "Fasilitas Kerjasama",
                        bullet: "dot",
                        page: "fo/master-data/fasilitas-kerjasama"
                    },
                    {
                        title: "Asuransi",
                        bullet: "dot",
                        page: "fo/master-data/asuransi",
                        submenu: [
                            {
                                title: "Data Asuransi",
                                bullet: "dot",
                                page: "fo/master-data/asuransi/data-asuransi"
                            },
                            {
                                title: "Data Tarif Tindakan",
                                bullet: "dot",
                                page: "fo/master-data/asuransi/data-tarif-tindakan"
                            },
                        ]
                    },
                    {
                        title: "Admission",
                        bullet: "dot",
                        page: "fo/master-data/admission/data-admission"
                    },
                    {
                        title: "Data Instansi",
                        bullet: "dot",
                        page: "fo/master-data/instansi/data-instansi"
                    },

                ]
            },
            {
                title: "Antrian",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "fo/antrian",
                submenu: [
                    {
                        title: "Pesanan Antri Klinik",
                        bullet: "dot",
                        page: "fo/antrian/pesanan-antri-klinik",
                    },
                    {
                        
                        title: "List Pasien Antri Aktif",
                        bullet: "dot",
                        page: "fo/antrian/list-pasien-antri-aktif",
                    },
                    {
                        title: "Register Kontrol",
                        bullet: "dot",
                        page: "fo/antrian/register-kontrol"
                    },
                    {
                        title: "Daftar Nomor Kosong",
                        bullet: "dot",
                        page: "fo/antrian/daftar-nomor-kosong"
                    },
                    {
                        title: "Register Pesanan Kontrol",
                        bullet: "dot",
                        page: "fo/antrian/register-pesanan-kontrol"
                    },
                ]
            },
            {
                title: "Angket",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "fo/angket",
                submenu: [
                    {
                        title: "Angket Pelanggan",
                        bullet: "dot",
                        page: "fo/angket/angket-pelanggan"
                    },
                ]
            },
            {
                title: "Rujukan",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "fo/rujukan",
                submenu: [
                    {
                        title: "Data Perujuk",
                        bullet: "dot",
                        page: "fo/rujukan/data-perujuk",
                    },
                ]
            }
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
                page: "fo/master-data",
                submenu: [
                    {
                        title: "Data Pasien",
                        bullet: "dot",
                        page: "fo/master-data/data-pasien",
                    },
                    {
                        title: "Angket Pelanggan",
                        bullet: "dot",
                        page: "fo/master-data/angket-pelanggan"
                    },
                    {
                        title: "Fasilitas Kerjasama",
                        bullet: "dot",
                        page: "fo/master-data/fasilitas-kerjasama"
                    },
                    {
                        title: "Asuransi",
                        bullet: "dot",
                        page: "fo/master-data/asuransi",
                        submenu: [
                            {
                              title: "Data Asuransi",
                              bullet: "dot",
                              page: "fo/master-data/asuransi/data-asuransi"
                            },
                            {
                                title: "Data Tarif Tindakan",
                                bullet: "dot",
                                page: "fo/master-data/asuransi/data-tarif-tindakan"
                            },
                        ]
                    },
                    {
                        title: "Admission",
                        bullet: "dot",
                        page: "fo/master-data/admission/data-admission"
                    },
                ]
            },
            {
                title: "Antrian",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "fo/antrian",
                submenu: [
                    {
                        title: "Pesanan Antri Klinik",
                        bullet: "dot",
                        page: "fo/antrian/pesanan-antri-klinik",
                    },
                    {
                        title: "List Pasien Antri Aktif",
                        bullet: "dot",
                        page: "fo/antrian/list-pasien-antri-aktif",
                    },
                    {
                        title: "Register Kontrol",
                        bullet: "dot",
                        page: "fo/antrian/register-kontrol"
                    },
                    {
                        title: "Daftar Nomor Kosong",
                        bullet: "dot",
                        page: "fo/antrian/daftar-nomor-kosong"
                    },
                    {
                        title: "Register Pesanan Kontrol",
                        bullet: "dot",
                        page: "fo/antrian/register-pesanan-kontrol"
                    },
                ]
            },
            {
                title: "Rujukan",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "fo/rujukan",
                submenu: [
                    {
                        title: "Data Perujuk",
                        bullet: "dot",
                        page: "fo/rujukan/data-perujuk",
                    },
                ]
            }
        ]
    }
};
