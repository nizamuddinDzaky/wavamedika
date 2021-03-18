import React, {useEffect} from 'react';
import Select from "react-select";
import clsx from "clsx";

interface IProps {
    label?: string;
    inputName?: string;
    inputType?: string;
    onChange?: (e: any) => void;
    onBlur?: any;
    placeholder?: string;
    fontSm?: boolean;
    formControlSm?: boolean;
    disabled?: boolean;
    colSize?: number;
    labelSize?: number;
    options?: Array<any>;
    defaultValue?: ISelector;
    value?: ISelector
    loading?: boolean;
    error?: any;
    submitted?: boolean;
}

export interface ISelector {
    value?: string;
    label?: string;
}

const SelectInput: React.FC<IProps> = (props: IProps) => {
    const colSize = props.colSize? `col-lg-${props.colSize}`: '';
    const labelSize = props.labelSize? `col-lg-${[props.labelSize]}`: 'col-lg-1';

    useEffect(() => {
        if(props.onChange && props.defaultValue) {
            props.onChange(props.defaultValue);
        }

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [props.options])

    return(
        <>
            <label className={clsx('col-form-label col-sm-12',
                {'form-control-sm': props.formControlSm},
                labelSize,
                {'kt-font-sm': props.fontSm})}
            >
                {props.label} &nbsp;: &nbsp;
            </label>
            <div className={clsx('col-sm-12', colSize)}>
                {!props.loading ? <Select
                    options={props?.options}
                    onChange={props?.onChange}
                    onBlur={props?.onBlur}
                    defaultValue={props?.defaultValue}
                    value={props?.value}
                    // className={clsx('form-control', {'form-control-sm': props.formControlSm})}
                /> : <div>Loading...</div>
                }

                {!!props.error&& props.error.value && props.submitted && (
                    <div style={{ color: "red", marginTop: ".5rem" }}>
                        {props?.error?.value}
                    </div>
                )}
            </div>
        </>
    )
};

export default SelectInput;
