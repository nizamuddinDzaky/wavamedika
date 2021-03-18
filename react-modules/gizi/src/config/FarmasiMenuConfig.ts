export default {
    header: {
        self: {},
        items: [
            {
                title: "Dashboards Farmasi",
                root: true,
                alignment: "left",
                page: "farmasi/dashboard",
                translate: "MENU.DASHBOARD"
            },
            {
                title: "Master Data",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "farmasi/master-data",
                submenu: [
                    {
                        title: "Master Data 1",
                        bullet: "dot",
                        page: "farmasi/master-data/masterData1",
                    }
                ]
            },
        ]
    },
    aside: {
        self: {},
        items: [
            {
                title: "Dashboards Farmasi",
                root: true,
                alinment: "left",
                page: "farmasi/dashboard",
                translate: "MENU.DASHBOARD"
            },
            {
                title: "Master Data",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "farmasi/master-data",
                submenu: [
                    {
                        title: "Master Data 1",
                        bullet: "dot",
                        page: "farmasi/master-data/masterData1",
                    }
                ]
            },
        ]
    }
};
