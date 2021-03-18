import React from 'react';
import {RouteComponentProps, withRouter} from "react-router";
import ViewTransaksiGizi from "./ViewTransaksiGizi";

type propTypes = RouteComponentProps<any> & {
}
const PageViewTransaksiGizi: React.FC<propTypes> = (props: propTypes) => {
    return(
        <>
            {props?.match?.params?.id &&
                <ViewTransaksiGizi
                    idMRS={props.match.params.id}
                    // viewAsPage
                />
            }
        </>
    )
};

export default withRouter(PageViewTransaksiGizi);
