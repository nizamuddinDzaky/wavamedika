import React from 'react';
import HTMLClassService from './HTMLClassService';
import LayoutConfig from "./LayoutConfig";
import KtContent from "./KTContent";
import Header from "./header/Header";
import Footer from "./footer/Footer";
import HeaderMobile from "./header/HeaderMobile";
import SubHeader from "./sub-header/SubHeader";
import objectPath from "object-path";
import {RouteComponentProps, withRouter} from "react-router";
import { connect } from "react-redux";
import LayoutInitializer from './LayoutInitializer';
import ScrollTop from "./ScrollTop";

const htmlClassService = new HTMLClassService();

type PathParamsType = {
    param1: string,
}

type PropsType = RouteComponentProps<PathParamsType> & {
    menuConfig: any;
    basename?: string;
    children?: any;
    builder?: any;
    asideDisplay?: boolean;
    subheaderDisplay?: boolean;
    selfLayout?: string;
    layoutConfig?: any;

}
// interface IProps {
//     children: any;
//     builder: any;
//     menuConfig: any;
//     asideDisplay?: boolean;
//     subheaderDisplay?: boolean;
//     selfLayout?: string;
//     layoutConfig?: any;
// }
const Layout: React.FC<PropsType> = (props: PropsType) => {
    let {
        children,
        asideDisplay,
        subheaderDisplay,
        selfLayout,
        menuConfig,
        // layoutConfig
    } = props;

    htmlClassService.setConfig(LayoutConfig);
    // scroll to top after location changes
    window.scrollTo(0, 0);

    const contentCssClasses = htmlClassService.classes.content.join(" ");
    const contentContainerCssClasses = htmlClassService.classes.content_container.join(
        " "
    );
    return selfLayout !== "blank" ? (
        <LayoutInitializer
            styles={[]}
            menuConfig={menuConfig}
            layoutConfig={LayoutConfig}
            htmlClassService={htmlClassService}
        >
            <HeaderMobile />
            <div className="kt-grid kt-grid--hor kt-grid--root">
                <div className="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
                    <div
                        className="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper"
                        id="kt_wrapper"
                    >
                        <Header />
                        <div
                            className="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch"
                            id="kt_body"
                        >
                            {asideDisplay && (
                                <>
                                    <div
                                        className={`kt-container ${contentContainerCssClasses} kt-container--fit kt-grid kt-grid--ver`}
                                    >
                                        {/*<AsideLeft />*/}
                                        <div
                                            className="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                                            id="kt_content"
                                        >
                                            <KtContent>{children}</KtContent>
                                        </div>
                                    </div>
                                </>
                            )}
                            {!asideDisplay && (
                                <>
                                    {/* <!-- begin:: Content --> */}
                                    <div
                                        id="kt_content"
                                        className={`kt-content ${contentCssClasses} kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor`}
                                    >
                                        {/* <!-- begin:: Content Head --> */}
                                        {subheaderDisplay && <SubHeader />}
                                        {/* <!-- end:: Content Head --> */}

                                        {/* <!-- begin:: Content Body --> */}
                                        <KtContent>{children}</KtContent>
                                        {/*<!-- end:: Content Body -->*/}
                                    </div>
                                    {/* <!-- end:: Content --> */}
                                </>
                            )}

                        </div>

                        <Footer />
                    </div>
                </div>
            </div>
            <ScrollTop/>
        </LayoutInitializer>
    ): (
        // BLANK LAYOUT
        <div className="kt-grid kt-grid--ver kt-grid--root kt-page">
            <KtContent>{children}</KtContent>
        </div>
    )
};

const mapStateToProps = ({ builder: { layoutConfig } }: any) => ({
    layoutConfig,
    selfLayout: objectPath.get(layoutConfig, "self.layout"),
    asideDisplay: objectPath.get(layoutConfig, "aside.self.display"),
    subheaderDisplay: objectPath.get(layoutConfig, "subheader.display")
});

export default withRouter(connect(mapStateToProps)(Layout));
