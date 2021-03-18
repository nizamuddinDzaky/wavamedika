import React from 'react';
import MasterDataFasilitasKerjasamaList from './MasterDataFasilitasKerjasamaList';

const MasterDataFasilitasKerjasama = () => {
    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <MasterDataFasilitasKerjasamaList
                />
            </div>
        </div>
    )
}

export default MasterDataFasilitasKerjasama;