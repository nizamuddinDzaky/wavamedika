import React from "react";
import { connect } from "react-redux";
import { Link, withRouter } from "react-router-dom";
import objectPath from "object-path";
import HMenuItem from "./HMenuItem";
import * as builder from "../../../ducks/builder";
import { toAbsoluteUrl } from "../../../../utils/theme.utils";
import KTMenu from "../../../../assets/js/menu";
import KTOffcanvas from "../../../../assets/js/offcanvas";
import {RouteComponentProps} from "react-router";

const offcanvasOptions = {
    overlay: true,
    baseClass: "kt-header-menu-wrapper",
    closeBy: "kt_header_menu_mobile_close_btn",
    toggleBy: {
        target: "kt_header_mobile_toggler",
        state: "kt-header-mobile__toolbar-toggler--active"
    }
};

type PathParamsType = {
    param1: string,
}

// Your component own properties
type PropsType = RouteComponentProps<PathParamsType> & {
    // someString: string,
    headerSelfSkin?: any;
    disabledAsideSelfDisplay?: any;
    ktMenuClasses?: any;
    ulClasses?: any;
    rootArrowEnabled?: any;
    menuConfig?: any;

}

class HMenu extends React.Component<PropsType> {
    offCanvasCommonRef:any = React.createRef();
    ktMenuCommonRef:any = React.createRef();

    getHeaderLogo() {
        let result = "logo-light.png";
        // console.log("this.props.headerSelfSkin", this.props.headerSelfSkin);
        if (this.props.headerSelfSkin && this.props.headerSelfSkin !== "dark") {
            result = "logo-dark.png";
        }
        return toAbsoluteUrl(`/media/logos/${result}`);
    }

    get currentUrl() {
        return this.props.location.pathname.split(/[?#]/)[0];
    }

    componentDidMount() {
        // Canvas
        this.initOffCanvas();
        // Menu
        this.initKTMenu();
    }

    initOffCanvas = () => {
        // eslint-disable-next-line no-undef
        if(this.offCanvasCommonRef.current) {
            new (KTOffcanvas as any)(this.offCanvasCommonRef.current, offcanvasOptions);
        }
    };

    initKTMenu = () => {
        let menuOptions: any = {
            submenu: {
                desktop: "dropdown",
                tablet: "accordion",
                mobile: "accordion"
            },
            accordion: {
                slideSpeed: 200, // accordion toggle slide speed in milliseconds
                expandAll: false // allow having multiple expanded accordions in the menu
            },
            dropdown: {
                timeout: 50
            }
        };

        let menuDesktopMode = "accordion";
        if (
            this.ktMenuCommonRef.current.getAttribute("data-ktmenu-dropdown") === "1"
        ) {
            menuDesktopMode = "dropdown";
        }

        if (typeof objectPath.get(menuOptions, "submenu.desktop") === "object") {
            menuOptions.submenu.desktop = {
                default: menuDesktopMode
            };
        }

        // eslint-disable-next-line no-undef
        new (KTMenu as any)(this.ktMenuCommonRef.current, menuOptions);
    };

    render() {
        const {
            disabledAsideSelfDisplay,
            ktMenuClasses,
            ulClasses,
            rootArrowEnabled
        }: PropsType = this.props;
        const items = this.props.menuConfig.header.items;
        return (
            <>
                <button
                    className="kt-header-menu-wrapper-close"
                    id="kt_header_menu_mobile_close_btn"
                >
                    <i className="la la-close" />
                </button>
                <div
                    className="kt-header-menu-wrapper"
                    id="kt_header_menu_wrapper"
                    ref={this.offCanvasCommonRef}
                >
                    {disabledAsideSelfDisplay && (
                        <div className="kt-header-logo">
                            <Link to="/">
                                <img alt="logo" src={this.getHeaderLogo()} />
                            </Link>
                        </div>
                    )}

                    <div
                        id="kt_header_menu"
                        className={`kt-header-menu kt-header-menu-mobile ${ktMenuClasses}`}
                        ref={this.ktMenuCommonRef}
                    >
                        <ul className={`kt-menu__nav ${ulClasses}`}>
                            {items.map((item: any, index: number) => {
                                return (
                                    <React.Fragment key={`hmenuList${index}`}>
                                        {item.title && (
                                            <HMenuItem
                                                item={item}
                                                currentUrl={this.currentUrl}
                                                rootArrowEnabled={rootArrowEnabled}
                                            />
                                        )}
                                    </React.Fragment>
                                );
                            })}
                        </ul>
                    </div>
                </div>
            </>
        );
    }
}

const mapStateToProps = (store: any) => ({
    config: store.builder.layoutConfig,
    menuConfig: store.builder.menuConfig,
    ktMenuClasses: builder.selectors.getClasses(store, {
        path: "header_menu",
        toString: true
    }),
    rootArrowEnabled: builder.selectors.getConfig(
        store,
        "header.menu.self.root-arrow"
    ),
    headerSelfSkin: builder.selectors.getConfig(store, "header.self.skin"),
    ulClasses: builder.selectors.getClasses(store, {
        path: "header_menu_nav",
        toString: true
    }),
    disabledAsideSelfDisplay:
        objectPath.get(store.builder.layoutConfig, "aside.self.display") === false
});

export default withRouter(connect(mapStateToProps)(HMenu));
