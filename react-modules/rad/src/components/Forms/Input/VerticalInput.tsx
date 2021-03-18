import React from 'react';
import clsx from 'clsx';

interface IProps {
    value: string;
    label: string;
    inputName?: string;
    inputType?: string;
    onChange?: (e: any) => void;
    fontSm?: boolean;
    formControlSm?: boolean;
    disabled?: boolean;
    colSize?: number;
    labelSize?: number
}
export default function VerticalInput(props: IProps ) {
    const onChange = (e:any) => {
        if(props.onChange) {
            props.onChange(e)
        }
    };

    const colSize = props.colSize? `col-lg-${props.colSize}`: '';
    // const labelSize = props.labelSize? `col-lg-${[props.labelSize]}`: 'col-lg-1';

    return(
        <div className={clsx('form-group', colSize)}>
            <label className={clsx('col-form-label', {'kt-font-sm': props.fontSm})}>
                {props.label} &nbsp;: &nbsp;
            </label>
            <input className={clsx('form-control', {'form-control-sm': props.formControlSm, 'kt-font-sm': props.fontSm})}
                   name={props.inputName}
                   type={props.inputType}
                   onChange={(e) => onChange(e)}
                   value={props.value}
                   disabled={props.disabled}
            />
        </div>
    )
}
