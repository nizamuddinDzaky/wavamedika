import React from 'react';
import {RouteComponentProps, withRouter} from "react-router";
import clsx from 'clsx';

type Props = RouteComponentProps<any> & {
    headerFormInfo?: any;
    header?: any;
    children?: any;
    headerRightToolbar?: any;
    backLink?: string;
    backTitle?: string;
    backButtonClass?: string;
}
const DetailPageWrapper: React.FC<Props> = (props: Props) => {
    const onClickBack = (e: any) => {
        e.preventDefault();

        // if(userLastLocation)
        if(props.backLink){
            props.history.push(props.backLink);
        } else {
            props.history.goBack();
        }
           
    }
    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile kt-portlet--no-shadow'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm kt-padding-r-5'}>
                <form 
                    className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} 
                    style={{borderBottom: '2px solid #D3D3D3', paddingBottom: '20px'}}
                    //  onSubmit={handleSubmit(onSubmit)}
                >
                    <div className={'col-lg-5'}>{props?.headerFormInfo}</div>
                    <div className={'col-lg-7 kt-align-right kt-align-left--mobile'}>
                        <button 
                            // type={'submit'}
                            onClick={onClickBack}
                            className={clsx('form-control form-control-sm btn btn-sm btn-secondary', {'col-lg-2 col-sm-12 col-xs-12': !props?.backButtonClass}, props?.backButtonClass)}>
                                <i className={'fas fa-angle-double-left'}/> {props?.backTitle? props.backTitle: 'Kembali'}
                        </button>
                        {
                            props?.headerRightToolbar
                        }
                    </div>
                </form>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
            {props.children}
            </div>
        </div>
    )
}

export default withRouter(DetailPageWrapper);