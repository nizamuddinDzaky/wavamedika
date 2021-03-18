import React, { useState, useRef } from 'react';
import DetailPageWrapper from '../../../../Shared/DetailPageWrapper';
import PesanPoli from './PesanPoli';
import { withRouter, RouteComponentProps } from 'react-router';
import CustomDialog from '../../../../../components/Dialog/CustomDialog';
import ViewKarcisAntri from './ViewKarcisAntri';

type propTypes = RouteComponentProps<any> & {
}

const PageViewDetail_PesanPoli: React.FC<propTypes> = (props: propTypes) => {
    const [selection, setSelection] = useState<any>();
    const onSelection = (e: any) => {
        setSelection(e);
    }
    const viewKarcisAntri: any = useRef(null);

    return (
        <DetailPageWrapper
            backLink={'/fo/master-data/data-pasien'}
            headerRightToolbar={
                <>
                    &nbsp;
                    <button 
                        type={'button'}
                        disabled={!selection?.id_rencanakontrol}
                        className='col-lg-2 col-sm-12 form-control form-control-sm btn btn-sm btn-primary'>
                            <i className={'fas fa-print'}/> Print
                    </button>
                    &nbsp;
                    <button 
                        onClick={() => {
                            console.log('v',viewKarcisAntri)
                            if(viewKarcisAntri?.current) {
                                viewKarcisAntri?.current?.open();
                            }
                        }}
                        type={'button'}
                        // disabled={!selection?.id_rencanakontrol}
                        className='col-lg-3 col-sm-12 form-control form-control-sm btn btn-sm btn-info'>
                            <i className={'fas fa-eye'}/> View Karcis Antri
                    </button>
                </>
            }
        >
            <>
                <CustomDialog
                    title={"View Karcis Antri"}
                    ref={viewKarcisAntri}
                >
                    {/* {
                        selection?.id_rencanakontrol && */}
                        <div>
                            <ViewKarcisAntri
                                id_rencanakontrol={10}
                            />
                        </div>
                    {/* } */}
                    
                </CustomDialog>
                <PesanPoli
                    id_mr={props?.match?.params?.id}
                    onSelection={onSelection}
                />
            </>
        </DetailPageWrapper>
    )
}

export default withRouter(PageViewDetail_PesanPoli);