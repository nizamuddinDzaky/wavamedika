import React, { useState, useEffect } from 'react';
import master_datapasienService from '../../../../../services/master_datapasien.service';

interface Props {
    id_mr: number;
}
const IndeksPasien: React.FC<Props> = (props: Props) => {
    const [idMR, setIdMR] = useState<number>(props?.id_mr);
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
        setIdMR(idMR)

         // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.id_mr])

    useEffect(() => {
        if(idMR)
            getData();

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [idMR])

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
                <form className={''} style={{backgroundColor: '#42e386'}}>
                    <table 
                        // style={{border: 'solid 1px black'}}
                    >
                        <tbody>
                            <tr>
                                <td width={'120px'}>Nomor RM</td>
                                <td width={'120px'}>213</td>
                                <td width={'120px'}>Jenis Pasien</td>
                                <td width={'300px'} colSpan={5}>Member Card</td>
                            </tr>
                            <tr>
                                <td width={'100px'}>Nama Pasien</td>
                                <td width={'560px'} colSpan={7}>Nama Pasien</td>
                            </tr>
                            <tr>
                                <td width={'100px'}>Sex / Umur</td>
                                <td width={'100px'}>L/ 1 th.</td>
                                <td width={'80px'}>Gol.Darah</td>
                                <td width={'40px'}>-</td>
                                <td width={'80px'}>Gelar</td>
                                <td width={'40px'}>-</td>
                                <td width={'80px'}>Tgl. Daftar</td>
                                <td width={'80px'}>asfas</td>
                            </tr>
                            <tr>
                                <td width={'100px'}>Alamat</td>
                                <td width={'560px'} colSpan={7}>Alamat</td>
                            </tr>
                            <tr>
                                <td width={'120px'}>Nomor Telepon</td>
                                <td width={'120px'}>213</td>
                                <td width={'100px'}>Handphone</td>
                                <td width={'120px'} colSpan={5}>012345</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    )   
}

export default IndeksPasien;