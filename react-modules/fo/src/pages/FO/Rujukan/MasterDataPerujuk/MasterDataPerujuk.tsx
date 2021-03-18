import React from 'react';
import MasterDataPerujukList from './MasterDataPerujukList';

interface Input {
    nama: string
}
const MasterDataPerujuk = () => {


    // const [nama_perujuk, setNama] = useState<string>('');
    // const [jenis, setJenis] = useState<ISelector>({
    //     value: '_',
    //     label: 'Semua'
    // });
    // const [kecamatan, setKecamatan] = useState<ISelector>({
    //     value: '_',
    //     label: 'Semua'
    // });
    // const [kelurahan, setKelurahan] = useState<ISelector>({
    //     value: '_',
    //     label: 'Semua'
    // });
    // const [target, setTarget] = useState<ISelector>({
    //     value: '_',
    //     label: 'Target'
    // });

    // const [optionalProps, setOptionalProps] = useState<any>({});

    // const onClickRefresh = (e: any) => {
    //     e.preventDefault();

    //     setOptionalProps({
    //         nama_perujuk: nama_perujuk,
    //         kecamatan: kecamatan.value,
    //         kelurahan: kelurahan.value,
    //         jenis: jenis.value,
    //         target: target.value
    //     });
    // }

    return (
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            {/* <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <form className={'kt-form col-xl-12 header-form kt-margin-t-25 row'} 
                >
                    <div className={'col-xl-4 col-lg-6'}>
                        <h4>Pencarian Data Pasien:</h4>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                value={noMR}
                                onChange={(e) => setnoMR(e.target.value)}
                                label={'Nomor RM'}
                                inputType={'number'}
                                colSize={9}
                                labelSize={3}
                                formControlSm
                                disabled={false}
                            />
                            <HorizontalInput
                                value={nama}
                                onChange={(e) => setNama(e.target.value)}
                                label={'Nama'}
                                inputType={'text'}
                                colSize={9}
                                labelSize={3}
                                formControlSm
                                disabled={false}
                                styles={{paddingTop: 20}}
                            />
                            <SelectKecamatan
                                onChange={(e) => setKecamatan(e)}
                            />
                            <SelectKabupaten
                                onChange={(e) => setKabupaten(e)}
                            />
                        </div>
                    </div>
                    <div className={'col-xl-4 col-lg-6'}>
                        <h4>Filtering Pasien:</h4>
                        <div className={'row col-xl-12'}>
                            <HorizontalInput
                                value={thn1}
                                onChange={(e) => setThn1(e)}
                                label={'Tahun'}
                                inputType={'MUIPicker'}
                                MUIViews={['year']}
                                colSize={4}
                                labelSize={3}
                                formControlSm
                                disabled={false}
                            />
                            <HorizontalInput
                                value={thn2}
                                onChange={(e) => setThn2(e)}
                                label={'s/d'}
                                inputType={'MUIPicker'}
                                MUIViews={['year']}
                                colSize={4}
                                labelSize={1}
                                formControlSm
                                disabled={false}
                            />

                            <HorizontalInput
                                value={umur1}
                                onChange={(e) => setUmur1(e.target.value)}
                                label={'Umur'}
                                inputType={'number'}
                                colSize={4}
                                labelSize={3}
                                formControlSm
                                disabled={false}
                            />
                            <HorizontalInput
                                value={umur2}
                                onChange={(e) => setUmur2(e.target.value)}
                                label={'s/d'}
                                inputType={'number'}
                                colSize={4}
                                labelSize={1}
                                formControlSm
                                disabled={false}
                            />  
                            
                            <SelectJenisPasien
                                onChange={(e) => setJnsPasien(e)}
                            />

                            <SelectSex
                                onChange={(e) => setSex(e)}
                            />
                        </div>
                    </div>
                    <div className={'col-xl-4 col-lg-2'}>
                        <button 
                            onClick={onClickRefresh}
                            className='col-xl-3 col-md-12 btn btn-sm btn-primary kt-margin-t-20 align-bottom col-item-pull-bottom'>
                                <i className={'la la-filter'}/> Refresh
                        </button>
                    </div>
                </form>
            </div> */}
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <MasterDataPerujukList
                    // optionalProps={optionalProps}
                />
            </div>
        </div>
    )
}

export default MasterDataPerujuk;