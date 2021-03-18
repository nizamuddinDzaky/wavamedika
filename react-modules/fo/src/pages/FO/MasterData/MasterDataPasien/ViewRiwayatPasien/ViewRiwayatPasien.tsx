import React, { useState } from 'react';
import HeaderPasien from '../../../../Shared/HeaderPasien';
import Rekapitulasi from './Rekapitulasi';
import RiwayatPasien from './RiwayatPasien';
import TindakanPasien from './TindakanPasien';
interface Props {
    id_mr: number
    // id_mrs?: number
    unit?: string
    sex?: string
}

const ViewRiwayatPasien: React.FC<Props> = (props: Props) => {
    let [pasienData, setPasienData] = useState<any>();
    let [loadingPasien, setLoadingPasien] = useState<boolean>(true);

    
    if(!loadingPasien && (!pasienData || pasienData === null)) {
        return(
            <div className={'kt-portlet kt-portlet--no-shadow'}>
                <div className={'kt-portlet__body header-form'}>
                    Data pasien tidak ditemukan.
                </div>
            </div>
        )
    }


    return (
        <div className={'kt-portlet kt-portlet--no-shadow'}>
            <div className={'kt-portlet__body header-form kt-padding-t-0'}>
                <HeaderPasien
                    classNames={'kt-padding-t-0 kt-padding-b-0'}
                    style={{paddingBottom: 0}} 
                    idMR={props?.id_mr}
                    sex={props?.sex}
                    onLoadPasienData={v=> setPasienData(v)}
                    onLoading={v => {setLoadingPasien(v)}}
                />
                {pasienData && !loadingPasien && <div className='row'>
                    <div className={'col-xl-4 col-md-4 col-sm-12'}>
                        <Rekapitulasi
                            id_mr={props?.id_mr}
                        />
                    </div>
                    <div className={'col-xl-8 col-md-8 col-sm-12'}>
                        <RiwayatPasien
                            id_mr={props?.id_mr}
                        />
                        <br/>
                        <TindakanPasien
                            id_mrs={props?.id_mr!}
                            unit={props?.unit!}
                        />
                    </div>
                </div>}
            </div>
        </div>
    )
}

export default ViewRiwayatPasien;