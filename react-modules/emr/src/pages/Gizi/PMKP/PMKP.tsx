import React, {useState} from 'react';
import HeaderPasien from "../../Shared/HeaderPasien";
import ListPMKP from "./ListPMKP";
import {detailDataMRSPMKP} from "../../../pojo/giz_pmkppasien/datamrs";

interface Props {
    idMRS: number;
    idUnit: number;
}

const PMKP: React.FC<Props> = (props: Props) => {
    const [pasienData, setPasienData ] = useState<detailDataMRSPMKP>();
    const [loadingPasien, setLoadingPasien] = useState<boolean>(false);

    const onLoadingPasien = (v: boolean) => {
        setLoadingPasien(v);
    };

    const onLoadPasienData = (v: any) => {
        setPasienData(v);
    };
    return(
        <div className={'kt-portlet'}>
            <div className={'kt-portlet__body kt-portlet__body header-form'}>
                <form className={'kt-form col-xl-12 header-form'}>
                    <div className={'row'}>
                        <HeaderPasien
                            idMRS={props.idMRS}
                            onLoadPasienData={onLoadPasienData}
                            onLoading={onLoadingPasien}
                            isPMKP={true}
                        />
                    </div>
                    <div className={'row'}>
                        {!loadingPasien && pasienData && pasienData.id_mrs && props?.idUnit && props?.idMRS&&
                        <ListPMKP
                            // dataPasien={pasienData}
                            idMRS={props.idMRS}
                            idUnit={props.idUnit}
                            hidePagination
                        />}
                    </div>
                    {
                        !props?.idUnit &&
                        <div className={'col-lg-12'}>Unit tidak terdaftar.</div>
                    }
                    {/*<div className="row">*/}
                        {/*<ListPMKP*/}
                            {/*// dataPasien={pasienData}*/}
                            {/*idMRS={200200008}*/}
                            {/*idUnit={44}*/}
                        {/*/>*/}
                    {/*</div>*/}
                </form>
            </div>
        </div>
    )
};

export default PMKP;
