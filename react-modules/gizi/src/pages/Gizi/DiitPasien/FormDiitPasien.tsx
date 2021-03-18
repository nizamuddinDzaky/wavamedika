import React, {useState} from 'react';
import HeaderPasien from "../../Shared/HeaderPasien";
import HorizontalInput from "../../../components/Forms/Input/HorizontalInput";

interface Props {
    idMRS: number;
}
const FormDiitPasien: React.FC<Props> = (props: Props) => {
    const [date, setDate] = useState<string>('');
    return (
        <div className={'kt-portlet'}>
            <div className={'kt-portlet__body kt-portlet__body header-form'}>
                <form className={'kt-form col-xl-12 header-form'}>
                    <div className={'row'}>
                        <HeaderPasien
                            idMRS={props.idMRS}
                            // onLoadPasienData={onLoadPasienData}
                            // onLoading={onLoadingPasien}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={date}
                            onChange={(e) => setDate(e.target.value)}
                            label={'Tanggal'}
                            inputType={'date'}
                            colSize={3}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                        <div className={'col-lg-5'}/>
                        <div className="col-lg-3 kt-align-right">
                            Rabu, 11 Maret 2020
                        </div>
                    </div>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={date}
                            onChange={(e) => setDate(e.target.value)}
                            label={'Diagnosa'}
                            inputType={'text'}
                            colSize={11}
                            // labelSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={date}
                            onChange={(e) => setDate(e.target.value)}
                            label={'Alergi'}
                            inputType={'text'}
                            colSize={11}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                    </div>
                </form>
            </div>
        </div>
    )
};

export default FormDiitPasien;
