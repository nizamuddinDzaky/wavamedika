export default {
    header: {
        self: {},
        items: [
            {
                title: "Dashboards",
                root: true,
                alignment: "left",
                page: "dashboard",
                translate: "MENU.DASHBOARD"
            },
            {
                title: "Scoreboards-v1",
                root: true,
                page: "scoreboards-v1",
            },
            {
                title: "Menu 2",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "menu2",
                submenu: [
                    {
                        title: "Grouping",
                        bullet: "dot",
                        page: "scoreboards/grouping",
                    },
                    {
                        title: "Match History",
                        bullet: "dot",
                        page: "scoreboards/matchHistory"
                    },
                    {
                        title: "Show Empty Scoreboard",
                        bullet: "dot",
                        page: "scoreboards/emptyScoreboard"
                    }
                ]
            },
        ]
    },
    aside: {
        self: {},
        items: [
            {
                title: "Dashboard",
                root: true,
                icon: "flaticon2-architecture-and-city",
                page: "dashboard",
                translate: "MENU.DASHBOARD",
                bullet: "dot"
            },
            {
                title: "Scoreboards-v1",
                root: true,
                page: "scoreboards-v1"
            },
            {
                title: "Menu 2",
                root: true,
                alignment: "left",
                toggle: "click",
                page: "menu2",
                submenu: [
                    {
                        title: "Grouping",
                        bullet: "dot",
                        page: "scoreboards/grouping",
                    },
                    {
                        title: "Match History",
                        bullet: "dot",
                        page: "scoreboards/matchHistory"
                    },
                    {
                        title: "Show Empty Scoreboard",
                        bullet: "dot",
                        page: "scoreboards/emptyScoreboard"
                    }
                ]
            },
        ]
    }
};
