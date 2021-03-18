import React from 'react';

interface Props {
    formIdLabel?: string
    formStatus?: string
    formPosted?: string
    mode?: 'view' | 'add' | 'edit'
    showStatus?: boolean
}
const DetailPageHeaderFormInfo: React.FC<Props> = (props: Props) => {
    if(!props?.showStatus || props.mode === 'add') {
        return null;
    }
    return(
        <div className={'form-group row'}>
            <label className={'kt-font-bold col-lg-5 col-sm-12 form-control-sm kt-font'}>
                {props?.formIdLabel}
            </label>
            <div className={'hide--mobile'} style={{borderLeft: '1px black solid', height: '12px', width: '5px', marginTop: '10px'}}/>
            <label className={'kt-font-bold col-lg-auto col-sm-12 form-control-sm'}>
                Status : {props?.formStatus}
            </label>
            <div className={'hide--mobile'} style={{borderLeft: '1px black solid', height: '12px', width: '5px', marginTop: '10px'}}/>
            <label className={'kt-font-bold col-lg-auto col-sm-12 form-control-sm unposted'}>{props?.formPosted}</label>
        </div>
    )
}

export default DetailPageHeaderFormInfo;