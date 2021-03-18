import React, { useState, useEffect } from 'react';
import HorizontalInput from '../../../../../components/Forms/Input/HorizontalInput';
import master_datapasienService from '../../../../../services/master_datapasien.service';
import HorizontalTextArea from '../../../../../components/Forms/TextArea/HorizontalTextArea';

interface Props {
    id_mr: number;
}
const InfoPasien: React.FC<Props> = (props: Props) => {
    const [data, setData] = useState<any>();
    const [loading, setLoading] = useState<boolean>(false);

    const getData = async () => {
        try {
            setLoading(true);
            const payload = {
                id_mr: props?.id_mr
            }
            const resp = await master_datapasienService.tpp_indekspasien_view_datapasien_indeks(payload);

            if(resp.list && Array.isArray(resp.list) && resp.list.length > 0) {
                setData(resp.list[0]);
            }
            setLoading(false);
        } catch(error) {
            setData({});
            setLoading(false);
            console.log('error', error)
        }
    }

    useEffect(() => {
        getData();

         // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.id_mr])

    if(loading) {
        return (
            <div>Loading...</div>
        )
    }
    return (
        <div className='kt-portlet'>
            <div className='kt-portlet__head kt-padding-t-20'>
                <div className='col-lg-8'>
                    <h2>{data?.nama_lengkap}</h2>
                </div>
                <div className='col-lg-2'>
                    <button 
                            // type={'submit'}
                            // onClick={onClickBack}
                            className='col-lg-12 form-control form-control-sm btn btn-sm btn-primary'>
                                <i className={'fas fa-print'}/> Print
                    </button>
                </div>
                
            </div>
            <div className='kt-portlet__body'>
                <form className={'kt-form col-xl-12 header-form row'}>
                    <HorizontalInput
                        value={data?.no_mr}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Nomor RM'}
                        inputType={'number'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        disabled={true}
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={data?.umur}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Umur'}
                        inputType={'text'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        disabled={true}
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalTextArea
                        value={data?.alamat}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Alamat'}
                        colSize={9}
                        labelSize={3}
                        // fontSm={true}
                        formControlSm
                        disabled={true}
                        // inputName={'no_mr'}
                        // ref={register} 
                    />
                    <HorizontalInput
                        value={`${data?.telepon} / ${data?.hp}`}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Telp/Hp'}
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
                        value={data?.nama_keluarga}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Keluarga'}
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
                        value={''}
                        // onChange={(e) => setnoMR(e.target.value)}
                        label={'Ibu Kandung'}
                        inputType={'text'}
                        colSize={9}
                        labelSize={3}
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

export default InfoPasien;