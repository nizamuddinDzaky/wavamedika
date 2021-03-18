import React, { useEffect, useRef, useState} from 'react';
// import MRSService  from '../services/MRS.service';
// import listMRS from "../pojo/MRS";
import HorizontalInput from "../components/Forms/Input/HorizontalInput";
import VerticalInput from "../components/Forms/Input/VerticalInput";
import Table from "../components/Table/Table";
import {LinkButton} from "rc-easyui";
import CustomDialog from "../components/Dialog/CustomDialog";

const PublicPage = () => {
    const [startDate, setStartDate] = useState<string>('');
    const [endDate, setEndDate] = useState<string>('');
    const [textInput, setTextInput] = useState<string>('');
    // const [dialogOpen, setDialogOpen] = useState<boolean>(false);
    const dialogAdd: any = useRef(null);
    const mounted:any = useRef();

    // const fetchListMRS = async () => {
    //     try {
    //         const resp: listMRS = await MRSService.getListMRS();
    //         console.log('resp', resp);
    //     } catch (e) {
    //         console.log('err', e);
    //     }
    // };

    const tableColumns = [
        {
            id: 'nama',
            title: 'Nama',
            width: "50px"
        },
        {
            id: 'alamat',
            title: 'Alamat',
            width: "50px"
        },
        {
            id: 'action',
            title: 'Action',
            width: "50px"
        }
    ];

    const data = [
        {
            nama: 'Bangkit',
            alamat: 'Lumajang'
        },
        {
            nama: 'Syaiful',
            alamat: 'Bangkalan'
        }
    ];

    const toolbar = () => {
        return (
            <div style={{ padding: 4 }}>
                <LinkButton plain
                            onClick={() => dialogAdd?.current?.open()}
                >
                    <i className={'la la-plus'}/>
                    Tambah
                </LinkButton>
                <LinkButton plain>
                    <i className={'flaticon2-trash'}/>
                    Hapus
                </LinkButton>
                <LinkButton plain>
                    <i className="flaticon-edit-1"></i>
                    Edit
                </LinkButton>
                <LinkButton plain>
                    <i className="flaticon-edit-1"></i>
                    View
                </LinkButton>
            </div>
        )
    };


    useEffect(() => {
        // fetchListMRS()

        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;
        }
    }, []);

    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-lg-12 header-form kt-margin-t-25'}>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={startDate}
                            onChange={(e) => setStartDate(e.target.value)}
                            label={'Start Date'}
                            inputType={'date'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                        {/*<Dialog/>*/}
                        <HorizontalInput
                            value={endDate}
                            onChange={(e) => setEndDate(e.target.value)}
                            label={'End Date'}
                            inputType={'date'}
                            colSize={2}
                            formControlSm
                            disabled={false}
                        />
                    </div>
                    <div className={'form-group row'}>
                        <VerticalInput
                            value={startDate}
                            onChange={(e) => setStartDate(e.target.value)}
                            label={'Start Date'}
                            inputType={'date'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                        <VerticalInput
                            value={startDate}
                            onChange={(e) => setStartDate(e.target.value)}
                            label={'Start Date'}
                            inputType={'date'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                        <VerticalInput
                            value={textInput}
                            onChange={(e) => setTextInput(e.target.value)}
                            label={'Text Input'}
                            inputType={'text'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                        />
                    </div>
                </div>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20'}>
                <Table
                    columns={tableColumns}
                    data={data}
                    toolbar={toolbar}
                />
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <Table
                    columns={tableColumns}
                    data={data}
                    toolbar={toolbar}
                />
            </div>

            <CustomDialog
                title="Tambah Data"
                // style={{width:'400px',height:'200px'}}
                ref={dialogAdd}
            >
                Children
            </CustomDialog>
        </div>
    )
}

export default PublicPage;
