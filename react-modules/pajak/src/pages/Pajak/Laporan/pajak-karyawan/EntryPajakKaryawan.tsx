import React, { useState, useEffect } from 'react';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
// import master_datapasienService from '../../../../../services/master_datapasien.service';
import HorizontalTextArea from '../../../../components/Forms/TextArea/HorizontalTextArea';

interface Props {
    // no_bukti?: string;
    
}
const EntryPajakKaryawan: React.FC<Props> = (props: Props) => {
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
                    <h2>Pajak</h2>
                    <h5>Dasar Perhitungan Pajak Gaji</h5>
                </div>
                <div className='col-lg-2'>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-save'}/> Simpan
                    </button>
                </div>
                
            </div>
            <div className='kt-portlet__body'>
                <form className={'kt-form col-xl-12 header-form row'}>
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'NPWP'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                     <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Sex / Anak / Status'}
                        inputType={'text'}
                        colSize={9}
                        labelSize={3}
                        disabled={true}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Kode PTKP'}
                        colSize={9}
                        inputType={'text'}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        // value={`${data?.telepon} / ${data?.hp}`}
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'THP'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Bonus'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Grand'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Gaji Setahun'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Jumlah PTKP'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Biaya Jabatan'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'BPJS Tenaga Kerja'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Iuran Pensiun'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'BPJS Kesehatan'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Total Faktor Pengurang'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'PKP'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Progras 1 : 5 %'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Progras 1 : 15 %'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Progras 1 : 25 %'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Progras 1 : 30 %'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Pajak Denda 20%'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Pajak Per Tahun'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Pajak Per Bulan'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                </form>
                <div className='row kt-padding-t-20'>
                <div className='col-lg-2'>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-edit'}/> Kalkulasi
                    </button>
                </div>
                <div className='col-lg-2'>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-save'}/> Simpan
                    </button>
                </div>
                </div>
            </div>
        </div>
    )   
}

export default EntryPajakKaryawan;