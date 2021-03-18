import {DataGrid, Panel, GridColumn, GridColumnGroup, GridHeaderRow} from "rc-easyui";
import React, {useEffect, useRef} from "react";
import clsx from "clsx";
import customTableEasyUI from "../../assets/js/customTableEasyUI";

interface IProps {
    toolbar?: any,
    columns: Array<any>,
    data?: Array<any>,
    title?: string;
    // componentLoading: boolean;
    isPaginate?: boolean;
    total?: number;
    pageNumber?: number;
    pageSize?: number;
    loading?: boolean;
    selectionMode?: string;
    selection?: any;
    styles?: any;
    tableType?: string;
    editable?: boolean;
    minHeight?: number;
    height?: number;
    rowCss?: (row: any) => void;
    isLazy?: boolean;
    disableNumber?: boolean;
    onTableAction?: (params: any) => void;
    onSelectionChange?: (params: any) => void;
    onDoubleClickCell?: () => void
    onEditBegin?: () => void
    onLoadTableRef?: (ref: any) => void
    onEditCancel?: (event: any) => void
    onEditEnd?: (event: any) => void
    onEditValidate?: (event: any) => void
}
const Table: React.FC<IProps> = (props: IProps) => {
    const datagrid:any = useRef(null);

    const pagePosition: string =  "bottom";
    const pageOptions: any =  {
        layout: ['list', 'sep', 'first', 'prev', 'next', 'last', 'sep', 'refresh', 'sep', 'manual', 'info']
    };

    let newColumns: Array<any> = [];

    // render for number
    if(!props.disableNumber &&
        props.columns.length > 0 &&
        !Array.isArray(props.columns[0]) &&
        props.columns[0].id !== 'rn'
    ) {
        props.columns.unshift({
            id: 'rn',
            title: '',
            width: '10px',
            cellCss: "datagrid-td-rownumber",
            align: "center",
            render: ({rowIndex}: any) => (
                !props.disableNumber && <span>{rowIndex+1}</span>
            )
        });
    }

    // render for number in multiple row header
    if(!props.disableNumber &&
        props.columns.length > 0 &&
        Array.isArray(props.columns[0])
    ) {
        if( props.columns[0].length> 0 &&
            props.columns[0][0].id !== 'rn'
        ) {
            props.columns[0].unshift({
                id: 'rn',
                title: '',
                width: '10px',
                rowspan: props.columns.length,
                cellCss: "datagrid-td-rownumber",
                align: "center",
                render: ({rowIndex}: any) => (
                    !props.disableNumber && <span>{rowIndex+1}</span>
                )
            });
        }
    }

    if(props.columns.length > 0 && !Array.isArray(props.columns[0])) {
        const data = Array.from(props.columns);

        newColumns.push(data);
    } else {
        newColumns = Array.from(props.columns);
    }

    const onChangePage = (e: any) => {
        if(props.onTableAction)
            props.onTableAction(e);
    };

    // const onCancelEdit = useCallback((e: any) => {
    //     if(props.onCancelEdit) {
    //         props.onCancelEdit(e);
    //     }
    // }, [props])

    // const onEditBegin = useCallback( () => {
    //     console.log('edit begin');
    //     // if(props.onEditBegin)
    //     //     props.onEditBegin();
    // }, [props]);

    useEffect(() => {
        // eslint-disable-next-line no-undef
        new (customTableEasyUI as any)(datagrid?.current);

        if(props.onLoadTableRef) {
            props.onLoadTableRef(datagrid.current);
        }
    });
    return(
        <div className={clsx(props.tableType, {'table-custom': !props.tableType})} style={{...props?.styles}}>
            <Panel title={props.title}>
                <DataGrid
                    lazy={props?.isLazy}
                    ref={datagrid}
                    style={{ height: props?.height? props?.height: '100%', minHeight: props.minHeight?props.minHeight: 400 }}
                    data={props?.data}
                    toolbar={props?.toolbar}
                    pagination={props.isPaginate}
                    pagePosition={pagePosition}
                    pageOptions={pageOptions}
                    loading={props.loading}
                    total={props.total}
                    pageNumber={props.pageNumber}
                    pageSize={props.pageSize}
                    selectionMode={props?.selectionMode}
                    selection={props?.selection}
                    onPageChange={onChangePage}
                    onSelectionChange={props?.onSelectionChange}
                    onRowDblClick={props?.onDoubleClickCell}
                    columnResizing
                    editMode={props?.editable && 'row'}
                    rowCss={props?.rowCss}
                    onEditCancel={props?.onEditCancel}
                    onEditEnd={props?.onEditEnd}
                    onEditValidate={props?.onEditValidate}
                    // clickToEdit={props?.editable}
                    // onEditBegin={onEditBegin}
                >
                    <GridColumnGroup>
                    {
                        newColumns.map((item: any, index: number) => {
                            return(
                                <GridHeaderRow key={index}>
                                    {
                                        Array.isArray(item) && item.map((item2: any, index2: number) => {
                                            return(
                                                <GridColumn
                                                    key={index2}
                                                    field={item2?.id}
                                                    title={item2?.title}
                                                    cellCss={item2?.cellCss}
                                                    colspan={item2?.colspan}
                                                    rowspan={item2?.rowspan}
                                                    align={item2?.align}
                                                    // style={{minWidth:200}}
                                                    width={item2?.width}
                                                    editable={item2.editable}
                                                    editor={item2?.editor}
                                                    editRules={item2?.editRules}
                                                    render={item2?.render}
                                                />
                                            )
                                        })
                                    }
                                </GridHeaderRow>
                            )

                        })
                    }
                    </GridColumnGroup>
                </DataGrid>
            </Panel>
        </div>
    );
};

export default Table;
