import React from "react";
import { connect } from "react-redux";
import objectPath from "object-path";
import Topbar from "./Topbar";
import Brand from "../Brand/Brand";
import HMenu from "./HMenu/HMenu";
import AnimateLoading from "../../Animation/AnimateLoading";
import KTHeader from "../../../assets/js/header";
import * as builder from "../../ducks/builder";
// import _ from 'lodash';

class Header extends React.Component {
    headerCommonRef: any = React.createRef();

    componentDidMount() {
        let options: any = {
            minimize: {
                desktop: {}
            }
        };
        if (
            this.headerCommonRef.current.getAttribute("data-ktheader-minimize") ===
            "1"
        ) {
            options.minimize.desktop.on = "kt-header--minimize";
            // options.offsite.desktop = 20;
            const newOpt = {
                offset: {
                    desktop: 20
                }
            }

            options = Object.assign(options, newOpt);
        }

        // eslint-disable-next-line no-undef
        new (KTHeader as any)(this.headerCommonRef.current, options);
    }

    render() {
        const {
            menuHeaderDisplay,
            headerAttributes,
            headerClasses,
            headerContainerClasses
        }: any = this.props;
        return (
            <div
                ref={this.headerCommonRef}
                className={`kt-header ${headerClasses}`}
                id="kt_header"
                {...headerAttributes}
            >
                <div className={`kt-container ${headerContainerClasses}`}>
                    <AnimateLoading />
                    <Brand />
                    {menuHeaderDisplay ? <HMenu />: <div/>}
                    <Topbar />
                </div>
            </div>
        );
    }
}

const mapStateToProps = (store: any) => ({
    headerAttributes: builder.selectors.getAttributes(store, { path: "header" }),
    headerClasses: builder.selectors.getClasses(store, {
        path: "header",
        toString: true
    }),
    headerContainerClasses: builder.selectors.getClasses(store, {
        path: "header_container",
        toString: false
    }),
    menuHeaderDisplay: objectPath.get(
        store.builder.layoutConfig,
        "header.menu.self.display"
    ),
    fluid:
        objectPath.get(store.builder.layoutConfig, "header.self.width") === "fluid"
});

export default connect(mapStateToProps)(Header);
