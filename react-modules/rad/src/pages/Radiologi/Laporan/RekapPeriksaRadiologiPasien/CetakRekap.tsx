import React, { useState, useEffect } from 'react';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
// import master_datapasienService from '../../../../../services/master_datapasien.service';

interface Props {
    // no_bukti?: string;
    namaLengkap?:string;
    no_mrs?:number;
    no_rm?:number;
    umur?:number;
    kelas?:string;
    ruang?:string;
    alamat?:string;
    
}
const CetakRekap: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<any>();
    const [loading, setLoading] = useState<boolean>(false);

    const getData = async () => {
        try {
            setLoading(true);
            const payload = {
                // id_mr: props?.id_mr
            }
            // const resp = await master_datapasienService.tpp_indekspasien_view_datapasien_indeks(payload);

            // if(resp.list && Array.isArray(resp.list) && resp.list.length > 0) {
            //     setData(resp.list[0]);
            // }
            setLoading(false);
        } catch(error) {
            setData({});
            setLoading(false);
            console.log('error', error)
        }
    }

    // useEffect(() => {
    //     getData();

    //      // eslint-disable-next-line react-hooks/exhaustive-deps
    // }, [props.id_mr])

    if(loading) {
        return (
            <div>Loading...</div>
        )
    }
    return (
        <div className='kt-portlet'>
            <div className='kt-portlet__head kt-padding-t-20'>
                <div className='col-lg-8'>
                    <h2>Rekap Radiologi Pasien</h2>
                    <h5>untuk dicetak</h5>
                </div>
                <div className='col-lg-2'>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-print'}/> Cetak
                    </button>
                </div>
                
            </div>
            <div className='kt-portlet__body'>
                <form className={'kt-form col-xl-12 header-form row'}>
                    <HorizontalInput
                        value={props.no_mrs}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'No.MRS'}
                        inputType={'number'}
                        colSize={3}
                        labelSize={3}
                        // fontSm={true}
                        disabled
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                     <HorizontalInput
                        value={props.no_rm}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'No.RM'}
                        inputType={'number'}
                        colSize={4}
                        labelSize={2}
                        disabled={true}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={props.namaLengkap}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Nama Lengkap'}
                        colSize={6}
                        inputType={'text'}
                        labelSize={3}
                        disabled={true}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        // value={`${data?.telepon} / ${data?.hp}`}
                        value={props.umur}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Umur'}
                        inputType={'number'}
                        colSize={2}
                        disabled={true}
                        labelSize={1}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={props.alamat}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Alamat'}
                        inputType={'text'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        disabled={true}
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={props.ruang}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Ruang/Kamar'}
                        inputType={'text'}
                        colSize={6}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        disabled={true}
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={props.kelas}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Kelas'}
                        inputType={'text'}
                        colSize={2}
                        labelSize={1}
                        // fontSm={true}
                        formControlSm
                        disabled={true}
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                </form>
               
            </div>
        </div>
    )   
}

export default CetakRekap;