import React, {useState} from 'react';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import moment from 'moment';
import DataKesalahan from "./DataKesalahan";
import DataKomplain from "./DataKomplain";

const HumanError = () => {
    const [dateMonth, setDateMonth] = useState<string>(moment().format('YYYY-MM'));

    console.log(moment(dateMonth).format('MM'));
    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-lg-12 header-form kt-margin-t-25'}>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={dateMonth}
                            onChange={(e) => setDateMonth(e.target.value)}
                            label={'Bulan - Tahun'}
                            inputType={'month'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                    </div>
                </div>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <DataKesalahan
                    month={Number(moment(dateMonth).format('MM'))}
                    year={Number(moment(dateMonth).format('YYYY'))}
                    hidePagination
                />
                <DataKomplain
                    month={Number(moment(dateMonth).format('MM'))}
                    year={Number(moment(dateMonth).format('YYYY'))}
                    hidePagination
                />
            </div>
        </div>
    )
};

export default HumanError;
