import React from 'react';
import clsx from 'clsx';

interface Props{ 
    text?: string;
    action?: any;
    formControlSm?: boolean;
    fontSm?: boolean;
    className?: string;
    colOffsetSize?: number;
    labelSize?: number;
    disabled?: boolean;
    type?: "button"| "submit";
}
const ButtonSubmit: React.FC<Props> = (props: Props) => {
    const labelSize = props.labelSize? `col-lg-${[props.labelSize]}`: 'col-lg-1';
    const colOffsetSize = props.colOffsetSize? `col-lg-${props.colOffsetSize}`: '';
    return (
        <>
            {colOffsetSize? <div className={clsx(colOffsetSize)}></div>: null}
            <button
                disabled={props?.disabled}
                type={props?.type}
                className={clsx('btn kt-margin-0--mobile col-form-label col-sm-12',
                    {'form-control-sm': props.formControlSm},
                    props?.className,
                    labelSize,
                    {'kt-font-sm': props.fontSm})}
                    style={{marginTop: 5}}
                    onClick={props?.action}>
                        {props?.text}
            </button>
        </>
    )
}

export default ButtonSubmit;