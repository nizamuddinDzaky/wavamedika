import React from 'react';
import clsx from 'clsx';

interface IProps {
    value?: string | number;
    label?: string;
    inputName?: string;
    inputType?: string;
    onChange?: (e: any) => void;
    placeholder?: string;
    fontSm?: boolean;
    formControlSm?: boolean;
    disabled?: boolean;
    styles?: any;
    colSize?: number;
    labelSize?: number;
    error?: any;
    submitted?: boolean;
}

export default function HorizontalInput(props: IProps) {
    const onChange = (e: any) => {
        if(props.onChange) {
            props.onChange(e);
        }
    };

    const colSize = props.colSize? `col-lg-${props.colSize}`: '';
    const labelSize = props.labelSize? `col-lg-${[props.labelSize]}`: 'col-lg-1';

    return(
        <>
            <label className={clsx('col-form-label col-sm-12',
                {'form-control-sm': props.formControlSm},
                labelSize,
                {'kt-font-sm': props.fontSm})}
            >
                {props.label}: &nbsp;
            </label>
            <div className={clsx('col-sm-12', colSize)}>
                <input className={clsx('form-control', {'form-control-sm': props.formControlSm})}
                       name={props.inputName}
                       type={props.inputType? props.inputType: 'text'}
                       onChange={(e) => onChange(e)}
                       value={props.value}
                       disabled={props.disabled}
                       placeholder={props?.placeholder}
                />
                {!!props.error && props.submitted && (
                    <div style={{ color: "red", marginTop: ".5rem" }}>
                        {props?.error}
                    </div>
                )}
            </div>
        </>
    )
}
