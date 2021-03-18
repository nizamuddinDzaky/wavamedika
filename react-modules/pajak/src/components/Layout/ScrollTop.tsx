import React from "react";
import KTScrolltop from "../../assets/js/scrolltop";

export default class ScrollTop extends React.Component {
    scrollTopCommonRef: any = React.createRef();

    componentDidMount() {
        const scrollTopOptions = {
            offset: 300,
            speed: 600
        };

        new (KTScrolltop as any)(this.scrollTopCommonRef.current, scrollTopOptions);

    }

    render() {
        // console.log('ref', this.scrollTopCommonRef);
        return (
            <div
                id="kt_scrolltop"
                className="kt-scrolltop"
                ref={this.scrollTopCommonRef}
            >
                <i className="la la-arrow-up" />
            </div>
        );
    }
}
