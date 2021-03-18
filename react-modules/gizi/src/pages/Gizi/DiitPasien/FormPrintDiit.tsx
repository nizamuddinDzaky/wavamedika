import React, {useState} from 'react';
import {FormControl, FormControlLabel, Radio, RadioGroup} from '@material-ui/core';
import FormLabel from "@material-ui/core/FormLabel/FormLabel";
import gizDietService from '../../../services/gizDatadietpasien.service';
import PrintDocumentDiit from "./PrintDocument/PrintDocumentDiit";

import {pdf} from '@react-pdf/renderer';
import PrintDocumentDaftarDiit from "./PrintDocument/PrintDocumentDaftarDiit";
import {connect} from "react-redux";
import AdblockDetect from "../../../components/Adblock/AdblockDetect";

interface Props {
    // idMRS: number;
    dialogRefs: any;
    tanggal: string;
    unit: string;
    idRiwayatDiet?: number;
    user: any;
}
const FormPrintDiit: React.FC<Props> = (props: Props) => {
    const [cetakType, setCetakType] = useState<string>('pagi');

    const handleChange = (e: any) => {
        setCetakType(e.target.value);
    };

    const handleCancelClick = () => {
        if(props.dialogRefs) {
            props.dialogRefs.close()
        }
    };

    const handlePrint = async () => {
        try {
            if(cetakType === 'pagi') {
                const payload = {
                    tanggal: props?.tanggal,
                    unit: props?.unit
                };
                const resp = await gizDietService.datadietpagi(payload)
                console.log('res', resp);
                // setPrintData(resp);

                if(resp.list.length > 0) {
                    const blob = await pdf(<PrintDocumentDiit data={resp.list}/>).toBlob();
                    const fileURL = URL.createObjectURL(blob);

                    const printWindow = window.open(fileURL,'','width=800,height=500');
                    if(printWindow)
                        printWindow.print();

                }
            }

            if(cetakType === 'siang') {
                const payload = {
                    tanggal: props?.tanggal,
                    unit: props?.unit
                };
                const resp = await gizDietService.datadietsiang(payload)
                console.log('res', resp);

                if(resp.list.length > 0) {
                    const blob = await pdf(<PrintDocumentDiit data={resp.list}/>).toBlob();
                    const fileURL = URL.createObjectURL(blob);

                    const printWindow = window.open(fileURL,'','width=800,height=500');
                    if(printWindow)
                        printWindow.print();

                }
            }

            if(cetakType === 'sore') {
                const payload = {
                    tanggal: props?.tanggal,
                    unit: props?.unit
                };
                const resp = await gizDietService.datadietsore(payload)
                console.log('res', resp);

                if(resp.list.length > 0) {
                    const blob = await pdf(<PrintDocumentDiit data={resp.list}/>).toBlob();
                    const fileURL = URL.createObjectURL(blob);

                    const printWindow = window.open(fileURL,'','width=800,height=500');
                    if(printWindow)
                        printWindow.print();

                }
            }

            if(cetakType === 'diit1pasien') {
                const payload = {
                    id_riwayatdiet: props?.idRiwayatDiet
                }

                const resp = await gizDietService.datadietbaru(payload);

                if(resp.list.length > 0) {
                    const blob = await pdf(<PrintDocumentDiit data={resp.list}/>).toBlob();
                    const fileURL = URL.createObjectURL(blob);

                    const printWindow = window.open(fileURL,'', 'width=800,height=500');
                    if(printWindow)
                        printWindow.print();

                }
            }

            if(cetakType === 'daftardiit') {
                const payload = {
                    tanggal: props?.tanggal,
                    unit: props?.unit
                }
                const resp = await gizDietService.datadietpasien(payload);
                if(resp) {
                    console.log('resp', resp);
                    const blob = await pdf(<PrintDocumentDaftarDiit data={resp.list} tanggal={props?.tanggal} operator={props?.user?.nama_lengkap}/>).toBlob();

                    const fileURL = URL.createObjectURL(blob);

                    const printWindow = window.open(fileURL,'','width=800,height=500');
                    if(printWindow)
                        printWindow.print();

                }

            }

        } catch (e) {
            console.log('er', e);
        }
    };

    return (
        <div className={'kt-portlet'}>
            <div className={'kt-portlet__body kt-portlet__body header-form'}>
                <form className={'kt-form col-xl-12 header-form'} onSubmit={(e: any) => {e.preventDefault()}}>
                    <AdblockDetect/>
                    <FormControl className={'col-xl-8 col-md-8'} component="fieldset" onChange={handleChange}>
                        <FormLabel component="legend">Setting Cetak</FormLabel>
                        <RadioGroup aria-label="cetakType" name="cetakType" value={cetakType}>
                            <FormControlLabel value="pagi" control={<Radio />} label="Diit Pagi" />
                            <FormControlLabel value="siang" control={<Radio />} label="Diit Siang" />
                            <FormControlLabel value="sore" control={<Radio />} label="Diit Sore" />
                            <FormControlLabel disabled={!props?.idRiwayatDiet} value="diit1pasien" control={<Radio />} label="Diit 1 Pasien" />
                            <FormControlLabel value="daftardiit" control={<Radio />} label="Daftar Diit" />
                        </RadioGroup>
                    </FormControl>
                    <FormControl className={'col-xl-4 col-md-4'} component="fieldset">
                        {/*<PDFDownloadLink className="btn btn-primary mt-2" document={<PrintDocumentDiit data={printData} />} fileName="somename.pdf">*/}
                            {/*{({ blob, url, loading, error }) => (loading ? 'Loading document...' : 'Download')}*/}
                        {/*</PDFDownloadLink>*/}
                        <button className='col-12 btn btn-primary' onClick={handlePrint}>Print</button>
                        <button className='col-12 btn btn-secondary mt-2' onClick={handleCancelClick}>Cancel</button>
                    </FormControl>

                    {/*<BlobProvider document={<PrintDocumentDiit data={printData} />}>*/}
                        {/*{({ blob, url, loading, error }) => {*/}
                            {/*console.log('url', url)*/}
                            {/*if(!loading && url) {*/}
                                {/*window.open(url);*/}

                            {/*}*/}
                            {/*return null;*/}
                        {/*}}*/}
                    {/*</BlobProvider>*/}
                </form>
            </div>
            {/*{printData && <PrintDocumentDiit data={printData}/>}*/}
        </div>
    )
};


const mapStateToProps = ({ auth: { user } }: any) => ({
    user
});

export default connect(mapStateToProps)(FormPrintDiit);
