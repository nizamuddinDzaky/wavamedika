export default {
    header: {
        self: {},
        items: [
            // {
            //     title: "Dashboards",
            //     root: true,
            //     alignment: "left",
            //     page: "gizi/dashboard",
            //     translate: "MENU.DASHBOARD"
            // },
            {
                title: "Transaksi Gizi",
                root: true,
                alignment: "left",
                page: "gizi/transaksi",
                translate: "MENU.DASHBOARD"
            },
            {
                title: "Laporan Register Gizi",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/registerGizi",
            },
            {
                title: "Daftar Diit Pasien",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/daftarDiitPasien",
            },
            {
                title: "Human Error",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/humanError",
            },
            {
                title: "Pasien Rencana Pulang",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/pasienRencanaPulang",
            },
            {
                title: "Master Data",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/master-data",
                submenu: [
                    {
                        title: "Tindakan Gizi",
                        bullet: "dot",
                        page: "gizi/master-data/tindakanGizi",
                    },
                    {
                        title: "Data Diit",
                        bullet: "dot",
                        page: "gizi/master-data/dataDiit",
                    }
                ]
            },
            {
                title: "Master Data - Laboratorium",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "laboratorium/master-data",
                submenu: [
                    {
                        title: "Alkes Lab",
                        bullet: "dot",
                        page: "gizi/master-data/dataAlkes",
                    },
                ]
            },
            // {
            //     title: "Menu Test",
            //     root: true,
            //     alignment: "left",
            //     page: "gizi/test",
            //     translate: "MENU.DASHBOARD"
            // },
        ]
    },
    aside: {
        self: {},
        items: [
            // {
            //     title: "Dashboards",
            //     root: true,
            //     alignment: "left",
            //     page: "gizi/dashboard",
            //     translate: "MENU.DASHBOARD"
            // },
            {
                title: "Transaksi Gizi",
                root: true,
                alignment: "left",
                page: "gizi/transaksi",
                translate: "MENU.DASHBOARD"
            },
            {
                title: "Laporan Register Gizi",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/registerGizi",
            },
            {
                title: "Daftar Diit Pasien",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/daftarDiitPasien",
            },
            {
                title: "Human Error",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/humanError",
            },
            {
                title: "Pasien Rencana Pulang",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/pasienRencanaPulang",
            },
            {
                title: "Master Data",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "gizi/master-data",
                submenu: [
                    {
                        title: "Tindakan Gizi",
                        bullet: "dot",
                        page: "gizi/master-data/tindakanGizi",
                    },
                    {
                        title: "Data Diit",
                        bullet: "dot",
                        page: "gizi/master-data/dataDiit",
                    }
                ]
            },
            // {
            //     title: "Menu Test",
            //     root: true,
            //     alignment: "left",
            //     page: "gizi/test",
            //     translate: "MENU.DASHBOARD"
            // },
        ]
    }
};
