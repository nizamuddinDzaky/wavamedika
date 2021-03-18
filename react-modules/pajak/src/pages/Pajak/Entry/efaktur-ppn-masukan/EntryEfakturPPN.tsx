import React, { useState, useEffect } from 'react';
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
// import master_datapasienService from '../../../../../services/master_datapasien.service';
import HorizontalTextArea from '../../../../components/Forms/TextArea/HorizontalTextArea';

interface Props {
    no_bukti?: string;
    supplier?: string;
    npwp?:string;
    efaktur?:string;
}
const EntryEfaktur: React.FC<Props> = (props: Props) => {
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
                    <h2>{props?.supplier}</h2>
                    <h5>{props?.no_bukti}</h5>
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
                        value={props?.npwp}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'NPWP'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        disabled={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={props?.efaktur}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'No. Efaktur'}
                        inputType={'text'}
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
                        label={'Bulan Tahun Pajak'}
                        colSize={9}
                        inputType={'date'}
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
                        label={'Jumlah'}
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
                        label={'Pajak'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                </form>
            </div>
        </div>
    )   
}

export default EntryEfaktur;