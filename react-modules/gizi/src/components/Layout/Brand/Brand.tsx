/* eslint-disable no-script-url,jsx-a11y/anchor-is-valid */
import React from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import * as builder from "../../ducks/builder";
import {toAbsoluteUrl} from "../../../utils/theme.utils";

interface IProps {
    brandClasses?: string;
}
class Brand extends React.Component<IProps> {
    componentDidMount() {
        // eslint-disable-next-line no-undef
    }

    render() {
        return (
            <div
                className={`kt-header__brand ${this.props.brandClasses} kt-grid__item`}
                id="kt_header_brand"
            >
                <Link to="/gizi/dashboard" className="kt-header__brand-logo">
                    <img
                        alt="logo"
                        src={toAbsoluteUrl('/logo-4.png')}
                        className="kt-header__brand-logo-default"
                    />
                    <img
                        alt="logo"
                        src={toAbsoluteUrl('/logo-4.png')}
                        className="kt-header__brand-logo-sticky"
                    />
                </Link>
            </div>
        );
    }
}

const mapStateToProps = (store: any) => {
    return {
        brandClasses: builder.selectors.getClasses(store, {
            path: "brand",
            toString: true
        })
    };
};

export default connect(mapStateToProps)(Brand);
