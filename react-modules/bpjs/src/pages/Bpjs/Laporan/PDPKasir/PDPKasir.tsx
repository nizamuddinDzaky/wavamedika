import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import _ from 'lodash';
import moment from 'moment';
import { Tabs, Tab } from 'react-bootstrap';
import { detailDataPDPKasir } from '../../../../pojo/laporan/pdp_kasir/data_pdp_kasir';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import ListBillingInvoice from './ListBillingInvoice';
import LaporanPDPKasirRekap from './LaporanPDPKasirRekap';
import SelectInput, { ISelector } from '../../../../components/Forms/Input/SelectInput';



interface IPropsLaporanPDPKasir {
    hidePagination?: boolean;
}

const PDPKasir = (props: IPropsLaporanPDPKasir) => {
    let {
        hidePagination
    } = props;

    const dataCombobox = [
        
        {
            value: '_',
            label: 'Semua',
        },
        {
            value: 'combo1',
            label: 'ComboBox 1',
        },
        {
            value: 'combo2',
            label: 'ComboBox 2',
        },
    ];
    

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataPDPKasir>>();
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataPDPKasir>({});

    const [listCombobox, setListCombobox] = useState<Array<ISelector>>(dataCombobox);
    const [combobox, setCombobox] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });

    const [startDate, setStartDate] = useState<string>(moment().format('YYYY-MM-DD'));
    const [endDate, setEndDate] = useState<string>(moment().format('YYYY-MM-DD'));

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    let tableRef: any = useRef(null);

    // const getDataTarif = async () => {
    //     try {
    //         setLoading(true);
    //         const resp = await dataTarifService.datatarif();
    //         setData(resp.list);
    //         setMeta(resp.metadata);
    //         setLoading(false);

    //     } catch (e) {
    //         console.log(e);
    //         setLoading(false);
    //     }
    // };

    // const onTableAction = (e: any) => {
    //     console.log('e', e);

    //     setPageSize(e?.pageSize);
    //     setPageNumber(e?.pageNumber);


    //     /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
    //     /// Next jika ada update akan diganti
    //     if(e.refresh) {
    //         // getDataTarif();
    //     }
    // };

    function isEmpty(obj: object) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
    }

    const mounted:any = useRef();
    useEffect(() => {
        // fetchListMRS()

        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;

            // getDataTarif();
        }
    }, []);


    function handleChangeStartDate(e: any){
        console.log(e.target.value);
        // setStartDate(moment(e.target.value, "DD-MM-YYYY", true));
    }

    function handleChangeEndDate(e: any){
        console.log(e.target.value);
        // setEndDate(e.target.value);
    }

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
            {/* <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}> */}
            <div className={'kt-form col-lg-12 header-form kt-margin-t-25'}>
                    <div className={'form-group row '}>
                        <HorizontalInput
                            value={startDate}
                            onChange={(e) => handleChangeStartDate(e)}
                            label={'Tanggal'}
                            inputType={'date'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            inputName={"tes"}
                        />
                        <HorizontalInput
                            value={endDate}
                            onChange={(e) => handleChangeEndDate(e)}
                            label={'Sampai'}
                            inputType={'date'}
                            colSize={2}
                            formControlSm
                            disabled={false}
                        />
                        <SelectInput
                            value={combobox}
                            onChange={(e) => setCombobox(e)}
                            label={'Shift'}
                            inputType={'text'}
                            colSize={2}
                            labelSize={1}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            options={listCombobox}

                         />
        
                        <SelectInput
                            value={combobox}
                            onChange={(e) => setCombobox(e)}
                            label={'Status Pembayaran'}
                            inputType={'text'}
                            colSize={2}
                            labelSize={1}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            options={listCombobox}

                        />
                    </div>
                </div>
                </div>
                <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                    <Tabs transition={false} id="noanim-tab-example">
                                <Tab eventKey="billing" title="Billing Invoice">
                                   
                                    <>
                                        <ListBillingInvoice/> 
                                    </>
                                </Tab>
                                <Tab eventKey="rekap" title="Rekapitulasi">
                                    
                                    <LaporanPDPKasirRekap
                                    />
                                </Tab>
                                
                            </Tabs>
                            <div className={'form-group row kt-margin-t-20 mx-2 '}>
            <SelectInput
                            value={combobox}
                            onChange={(e) => setCombobox(e)}
                            label={'Jenis'}
                            inputType={'text'}
                            colSize={2}
                            labelSize={1}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            options={listCombobox}

                        />
                        <div className='form-control-sm'>
                                <button 
                                    // type={'submit'}
                                    // onClick={onClickBack}
                                    className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                        <i className={'fas fa-save'}/> Cetak
                                </button>
                </div>
                        </div>
            </div>
            
        </div>
    )
};

export default PDPKasir;
