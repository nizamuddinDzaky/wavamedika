import React from 'react';
import ListDataDiitByBentukMakanan from "./ListDataDiitByBentukMakanan";
import ListDataDiitByPenyakit from "./ListDataDiitByPenyakit";


const MasterDataDiit = () => {
    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            {/*<div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>*/}
            {/*</div>*/}
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <div className={'row'}>
                    <div className={'col-xl-4 col-md-4 col-sm-12'}>
                        <ListDataDiitByBentukMakanan/>
                    </div>
                    <div className={'col-xl-8 col-md-8 col-sm-12'}>
                        <ListDataDiitByPenyakit/>
                    </div>
                </div>
            </div>
        </div>
    )
};

export default MasterDataDiit;
