/* eslint-disable no-script-url,jsx-a11y/anchor-is-valid */
import React from "react";
import { Link } from "react-router-dom";
import Dropdown from "react-bootstrap/Dropdown";
import { connect } from "react-redux";
// import { toAbsoluteUrl } from "../../../_metronic";
import HeaderDropdownToggle from "../Dropdown/HeaderDropdownToggle";
import {toAbsoluteUrl} from "../../utils/theme.utils";

interface IProps {
    user: any;
    showHi: boolean;
    showAvatar?: boolean;
    showBadge?: boolean;
}
class UserProfile extends React.Component<IProps> {
    render() {
        const { user, showHi, showAvatar, showBadge }: IProps = this.props;

        return (
            <Dropdown
                className="kt-header__topbar-item kt-header__topbar-item--user"
                drop="down"
                alignRight
            >
                <Dropdown.Toggle
                    as={HeaderDropdownToggle}
                    id="dropdown-toggle-user-profile"
                >
                    <div
                        className="kt-header__topbar-wrapper"
                        data-toggle="dropdown"
                        data-offset="10px,0px"
                    >
                        {showHi && (
                            <span className="kt-header__topbar-welcome kt-hidden-mobile">
                Hi,
              </span>
                        )}

                        {showHi && (
                            <span className="kt-header__topbar-username kt-hidden-mobile">
                                {user?.nama_lengkap}
              </span>
                        )}

                        {showAvatar && <img alt="Pic" src={user && user.pic? user.pic: null} />}

                        {showBadge && (
                            <span className="kt-header__topbar-icon">
                {/* TODO: Should get from currentUser */}
                                <b>{user?.nama_lengkap[0]}</b>
              </span>
                        )}
                    </div>
                </Dropdown.Toggle>
                <Dropdown.Menu className="dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                    {/** ClassName should be 'dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl' */}
                    <div
                        className="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                        style={{
                            backgroundImage: `url(${toAbsoluteUrl('/assets/image/bg-1.jpg')})`
                        }}
                    >
                        <div className="kt-user-card__avatar">
                            <img alt="Pic" className="kt-hidden" src={user && user.pic? user.pic: null} />
                            <span className="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">
                                {user?.nama_lengkap[0]}
                            </span>
                        </div>
                        <div className="kt-user-card__name">{user?.nama_lengkap}</div>
                        <div className="kt-user-card__badge">
              <span className="btn btn-success btn-sm btn-bold btn-font-md">
                23 messages
              </span>
                        </div>
                    </div>
                    <div className="kt-notification">
                        <a className="kt-notification__item">
                            <div className="kt-notification__item-icon">
                                <i className="flaticon2-calendar-3 kt-font-success" />
                            </div>
                            <div className="kt-notification__item-details">
                                <div className="kt-notification__item-title kt-font-bold">
                                    My Profile
                                </div>
                                <div className="kt-notification__item-time">
                                    Account settings and more
                                </div>
                            </div>
                        </a>
                        {/*<a className="kt-notification__item">*/}
                            {/*<div className="kt-notification__item-icon">*/}
                                {/*<i className="flaticon2-mail kt-font-warning" />*/}
                            {/*</div>*/}
                            {/*<div className="kt-notification__item-details">*/}
                                {/*<div className="kt-notification__item-title kt-font-bold">*/}
                                    {/*My Messages*/}
                                {/*</div>*/}
                                {/*<div className="kt-notification__item-time">*/}
                                    {/*Inbox and tasks*/}
                                {/*</div>*/}
                            {/*</div>*/}
                        {/*</a>*/}
                        {/*<a className="kt-notification__item">*/}
                            {/*<div className="kt-notification__item-icon">*/}
                                {/*<i className="flaticon2-rocket-1 kt-font-danger" />*/}
                            {/*</div>*/}
                            {/*<div className="kt-notification__item-details">*/}
                                {/*<div className="kt-notification__item-title kt-font-bold">*/}
                                    {/*My Activities*/}
                                {/*</div>*/}
                                {/*<div className="kt-notification__item-time">*/}
                                    {/*Logs and notifications*/}
                                {/*</div>*/}
                            {/*</div>*/}
                        {/*</a>*/}
                        {/*<a className="kt-notification__item">*/}
                            {/*<div className="kt-notification__item-icon">*/}
                                {/*<i className="flaticon2-hourglass kt-font-brand" />*/}
                            {/*</div>*/}
                            {/*<div className="kt-notification__item-details">*/}
                                {/*<div className="kt-notification__item-title kt-font-bold">*/}
                                    {/*My Tasks*/}
                                {/*</div>*/}
                                {/*<div className="kt-notification__item-time">*/}
                                    {/*latest tasks and projects*/}
                                {/*</div>*/}
                            {/*</div>*/}
                        {/*</a>*/}
                        <div className="kt-notification__custom">
                            <Link
                                to="/gizi/logout"
                                className="btn btn-label-brand btn-sm btn-bold"
                            >
                                Sign Out
                            </Link>
                        </div>
                    </div>
                </Dropdown.Menu>
            </Dropdown>
        );
    }
}

const mapStateToProps = ({ auth: { user } }: any) => ({
    user
});

export default connect(mapStateToProps)(UserProfile);
