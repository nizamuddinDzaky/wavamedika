import React, { useState } from 'react';
import HeaderPasien from '../../../../Shared/HeaderPasien';
import PoliList from './PoliList';

interface Props {
    id_mr: number;
    onSelection?: (e: any) => void;
}
const PesanPoli: React.FC<Props> = (props: Props) => {
    let [pasienData, setPasienData] = useState<any>();
    let [loadingPasien, setLoadingPasien] = useState<boolean>(true);
    
    const onSelection = (e: any) => {
        if(props.onSelection)
            props.onSelection(e)
    }

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
                    onLoadPasienData={v=> setPasienData(v)}
                    onLoading={v => {setLoadingPasien(v)}}
                />
                {pasienData && !loadingPasien && <div className='row'>
                    <div className={'col-xl-12 col-md-12 col-sm-12'}>
                        <PoliList
                            id_mr={props?.id_mr}
                            onSelection={onSelection}
                        />
                    </div>
                </div>}
            </div>
        </div>
    )
}

export default PesanPoli;