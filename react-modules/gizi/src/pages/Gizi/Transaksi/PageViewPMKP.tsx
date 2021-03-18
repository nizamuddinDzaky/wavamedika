import React from 'react';
import {RouteComponentProps, withRouter} from "react-router";
import PMKP from "../PMKP/PMKP";

type propTypes = RouteComponentProps<any> & {
}
const PageViewPMKP: React.FC<propTypes> = (props: propTypes) => {
    return(
        <>
            {props?.match?.params?.id && props?.match?.params?.idUnit &&
            <PMKP
                idMRS={props.match.params.id}
                idUnit={props?.match.params.idUnit}
                // viewAsPage
            />
            }
        </>
    )
};

export default withRouter(PageViewPMKP);
