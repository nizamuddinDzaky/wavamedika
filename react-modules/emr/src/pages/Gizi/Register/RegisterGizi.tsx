import React, {useState} from 'react';
import HorizontalInput from "../../../components/Forms/Input/HorizontalInput";
import Rekapitulasi from "./Rekapitulasi";
import moment from 'moment';
import UnitSelector from "../../Shared/UnitSelector";
import {ISelector} from "../../../components/Forms/Input/SelectInput";
import ListRegisterGizi from "./ListRegisterGizi";

interface IProps {

}

const RegisterGizi: React.FC<IProps> = (props: IProps) => {
    const [startDate, setStartDate] = useState<string>(moment().format('YYYY-MM-DD'));
    const [endDate, setEndDate] = useState<string>(moment().format('YYYY-MM-DD'));
    const [selectedUnit, setSelectedUnit]= useState<string>('_');

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const onChangeUnit = (ev: ISelector) => {
        if(ev.value)
            setSelectedUnit(ev?.value);
    };

    const onTableAction = (e: any) => {
        if(e.pageSize) {
            setPageSize(e?.pageSize);
        }

        if(e.pageNumber) {
            setPageNumber(e?.pageNumber);
        }
    };

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-lg-12 header-form kt-margin-t-25'}>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={startDate}
                            onChange={(e) => setStartDate(e.target.value)}
                            label={'Tanggal Mulai'}
                            inputType={'date'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                        <HorizontalInput
                            value={endDate}
                            onChange={(e) => setEndDate(e.target.value)}
                            label={'Tanggal Akhir'}
                            inputType={'date'}
                            colSize={2}
                            formControlSm
                            disabled={false}
                        />
                        <UnitSelector
                            onChangeSelector={onChangeUnit}
                        />
                    </div>
                </div>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <div className={'row'}>
                    <div className={'col-xl-3 col-md-4 col-sm-12'}>
                        <Rekapitulasi
                            tgl1={startDate}
                            tgl2={endDate}
                            unit={selectedUnit}
                            batas={pageSize}
                            halaman={pageNumber}
                        />
                    </div>
                    <div className={'col-xl-9 col-md-8 col-sm-12'}>
                        <ListRegisterGizi
                            tgl1={startDate}
                            tgl2={endDate}
                            unit={selectedUnit}
                            onTableAction={onTableAction}
                        />
                    </div>
                </div>

            </div>
        </div>
    )
};

export default RegisterGizi;
