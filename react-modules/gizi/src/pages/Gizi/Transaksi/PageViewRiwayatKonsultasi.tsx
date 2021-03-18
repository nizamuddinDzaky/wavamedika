import React from 'react';
import {RouteComponentProps, withRouter} from "react-router";
import ViewRiwayatKonsultasiGizi from "../Konsultasi/ViewRiwayatKonsultasiGizi";

type propTypes = RouteComponentProps<any> & {
}
const PageViewRiwayatKonsultasiGizi: React.FC<propTypes> = (props: propTypes) => {
    return(
        <>
            {props?.match?.params?.id &&
            <ViewRiwayatKonsultasiGizi
                idMRS={props.match.params.id}
                // viewAsPage
            />
            }
        </>
    )
};

export default withRouter(PageViewRiwayatKonsultasiGizi);
