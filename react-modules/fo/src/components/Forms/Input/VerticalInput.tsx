import React from 'react';
import clsx from 'clsx';

interface IProps {
    value?: string;
    label: string;
    inputName?: string;
    inputType?: string;
    onChange?: (e: any) => void;
    fontSm?: boolean;
    formControlSm?: boolean;
    disabled?: boolean;
    colSize?: number;
    labelSize?: number;
    placeholder?: string;
    inputRef?: any;
    labelClass?: any;
    inputClass?: any;
    error?: any;
    errorClass?: any;
}
export default function VerticalInput(props: IProps ) {
    const onChange = (e:any) => {
        if(props.onChange) {
            props.onChange(e)
        }
    };
    
    const labelSize = props.labelSize? `col-lg-${[props.labelSize]}`: 'col-lg-1';

    return(
        <>
            <label
                className={clsx('col-form-label form-control-sm',
                    labelSize,
                    props?.labelClass,
                    {'kt-font-sm': props.fontSm})}
            >
                {props.label} &nbsp;: &nbsp;
            </label>
            <input className={clsx('form-control', {'is-invalid': props?.error}, props?.inputClass, {'form-control-sm': props.formControlSm, 'kt-font-sm': props.fontSm})}
                   name={props.inputName}
                   type={props.inputType? props.inputType: 'text'}
                   onChange={(e) => onChange(e)}
                   value={props.value}
                   disabled={props.disabled}
                   placeholder={props?.placeholder}
                   ref={props?.inputRef}
            />
            {!!props.error && (
                <div className={clsx('col-12', props?.errorClass, {'form-control-sm': props.formControlSm})} style={{ color: "red" }}>
                    {props?.error}
                </div>
            )}
        </>
    )
}
