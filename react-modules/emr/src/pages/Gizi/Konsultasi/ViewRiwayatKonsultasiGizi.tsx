import React, {useState} from 'react';
import HeaderPasien from "../../Shared/HeaderPasien";
import ListRiwayatKonsultasi from "./ListRiwayatKonsultasi";
import {detailMRS} from "../../../pojo/giz_konsultasigizi/giz_konsultasigizi.datamrs";

interface IProps {
    idMRS: number
}
const ViewRiwayatKonsultasiGizi: React.FC<IProps> = (props: IProps) => {
    const [pasienData, setPasienData ] = useState<detailMRS>();
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
                            />
                        </div>
                        <div className={'row'}>
                            {!loadingPasien && pasienData?.id_kamar && props.idMRS&&
                            <ListRiwayatKonsultasi
                                idMRS={props.idMRS}
                                dataPasien={pasienData}
                                hidePagination={true}
                            />}
                        </div>
                    </form>
            </div>
        </div>
    );
};

export default ViewRiwayatKonsultasiGizi;
