import React from "react";
import { toAbsoluteUrl } from "../utils/theme.utils";
import "../styles/pages/error/error-3.scss";
import {withRouter} from "react-router-dom";


const ErrorPage: React.FC = ({history}: any) => {
    return (
        <>
            <div className="kt-grid kt-grid--ver kt-grid--root">
                <div
                    className="kt-grid__item kt-grid__item--fluid kt-grid kt-error-v3"
                    style={{
                        backgroundImage: `url(${toAbsoluteUrl(
                            "/assets/image/error/bg3.jpg"
                        )})`
                    }}
                >
                    <div className="kt-error_container">
                        <div className="kt-error_number">
                            <h1>404</h1>
                        </div>
                        <p className="kt-error_title kt-font-light">Halaman tidak ditemukan</p>
                        <p className="kt-error_subtitle">
                            <button
                                className={'btn btn-primary'}
                                onClick={() => history?.goBack()}>
                                Kembali
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </>
    );
}


export default withRouter(ErrorPage);
