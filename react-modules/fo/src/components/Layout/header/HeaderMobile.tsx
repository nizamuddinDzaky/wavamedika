import React from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import objectPath from "object-path";
import * as builder from "../../ducks/builder";
import KTToggle from "../../../assets/js/toggle";
import { toAbsoluteUrl } from "../../../utils/theme.utils";

class HeaderMobile extends React.Component<any> {
    toggleButtonRef: any = React.createRef();
    headerMobileCssClasses: string = "";
    layoutConfig: any = this.props.layoutConfig;
    componentDidMount() {
        new (KTToggle as any)(this.toggleButtonRef.current, this.props.toggleOptions);
    }

    render() {
        const {
            asideDisplay,
            headerMobileCssClasses,
            headerMobileAttributes
        } = this.props;
        return (
            <div
                id="kt_header_mobile"
                className={`kt-header-mobile ${headerMobileCssClasses}`}
                {...headerMobileAttributes}
            >
                <div className="kt-header-mobile__logo">
                    <Link to="/">
                        <img alt="logo" src={toAbsoluteUrl('/logo-4.png')} />
                    </Link>
                </div>

                <div className="kt-header-mobile__toolbar">
                    {asideDisplay && (
                        <button
                            className="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left"
                            id="kt_aside_mobile_toggler"
                        >
                            <span />
                        </button>
                    )}

                    <button
                        className="kt-header-mobile__toolbar-toggler"
                        id="kt_header_mobile_toggler"
                    >
                        <span />
                    </button>

                    <button
                        ref={this.toggleButtonRef}
                        className="kt-header-mobile__toolbar-topbar-toggler"
                        id="kt_header_mobile_topbar_toggler"
                    >
                        <i className="flaticon-more-1" />
                    </button>
                </div>
            </div>
        );
    }
}

const mapStateToProps = (store: any) => ({
    headerMobileCssClasses: builder.selectors.getClasses(store, {
        path: "header_mobile",
        toString: true
    }),
    headerMobileAttributes: builder.selectors.getAttributes(store, {
        path: "header_mobile"
    }),
    asideDisplay: objectPath.get(
        store.builder.layoutConfig,
        "aside.self.display"
    ),
    toggleOptions: {
        target: "body",
        targetState: "kt-header__topbar--mobile-on",
        togglerState: "kt-header-mobile__toolbar-topbar-toggler--active"
    }
});

export default connect(mapStateToProps)(HeaderMobile);
