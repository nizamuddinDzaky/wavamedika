import React from 'react';
import clsx from 'clsx';
// import { classNames } from 'react-select/src/utils';

interface IProps {
    value?: string | number | any;
    label?: string;
    labelClass?: any;
    inputName?: string;
    inputClass?: any;
    inputWrapperClass?: any;
    onChange?: (e: any) => void;
    placeholder?: string;
    fontSm?: boolean;
    formControlSm?: boolean;
    disabled?: boolean;
    colSize?: number;
    labelSize?: number;
    error?: any;
    submitted?: boolean;
    styles?: any;
    inputRef?: any; 
    errorClass?: any;
}

export default function HorizontalTextArea(props: IProps) {
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
                props?.labelClass,
                {'kt-font-sm': props.fontSm})}
                style={{marginTop: 5}}
            >
                {props.label}: &nbsp;
            </label>
            <div className={clsx('col-sm-12', props?.inputWrapperClass, colSize)} style={{paddingTop: 5}}>
                <textarea className={clsx('form-control',{'is-invalid': props?.error}, props?.inputClass, {'form-control-sm': props.formControlSm})}
                       name={props.inputName}
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
            </div>
        </>
    )
}
