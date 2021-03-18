import React, { useEffect } from 'react';
import DetailPageWrapper from '../../../../Shared/DetailPageWrapper';
import {RouteComponentProps, withRouter} from "react-router";
import ViewRiwayatPasien from './ViewRiwayatPasien';

type propTypes = RouteComponentProps<any> & {
}
const PageView_RiwayatPasien: React.FC<propTypes> = (props: propTypes) => {
    useEffect(() => {

    }, [])

    return (
        <DetailPageWrapper
            backLink={'/fo/master-data/data-pasien'}
        >
            {props?.match?.params?.id ?
                <ViewRiwayatPasien
                    id_mr={props?.match?.params?.id}
                />: 
                null
            }
        </DetailPageWrapper>
    )
}

export default withRouter(PageView_RiwayatPasien);