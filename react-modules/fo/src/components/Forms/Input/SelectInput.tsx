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
    options?: Array<ISelector>;
    defaultValue?: ISelector;
    value?: ISelector
    loading?: boolean;
    error?: any;
    submitted?: boolean;
    inputRef?: any;
    errorMessage?: string;
    labelClass?: string;
    inputWrapperClass?: string;
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
                props.labelClass,
                {'kt-font-sm': props.fontSm})}
                style={{marginTop: 5}}
            >

                {props.label} &nbsp;: &nbsp;
            </label>
            <div className={clsx('col-sm-12', {'is-invalid': props?.errorMessage}, colSize, props.inputWrapperClass)}
                style={{marginTop: 5}}
            >
                {!props.loading ? <Select
                    options={props?.options}
                    onChange={props?.onChange}
                    onBlur={props?.onBlur}
                    defaultValue={props?.defaultValue}
                    value={props?.value}
                    ref={props?.inputRef}
                    className={
                        'kt-font-sm'
                    }
                    // style={{
                    //     maxHeight: 30,
                    //     height: 30
                    // }}
                    styles={
                        {
                            // singleValue: (provided, state) => ({
                            //     ...provided,
                            //     height: 26
                            // }),
                            control: (_) => ({
                                ..._,
                                minHeight: 30,
                                height: 30,
                                borderColor: props?.errorMessage? '#fd397a': '#e2e5ec'
                            }),
                            indicatorsContainer: (_) => ({
                                ..._,
                                minHeight: 30,
                                height: 30
                            })
                            // control: (_) => ({
                            //     ..._,
                                
                            // }),
                        }
                    }
                    name={props?.inputName}
                    // className={clsx('form-control', {'form-control-sm': props.formControlSm})}
                /> : <div>Loading...</div>
                }

                {!!props.error&& props.error.value && props.submitted && (
                    <div style={{ color: "red", marginTop: ".5rem" }}>
                        {props?.error?.value}
                    </div>
                )}

                {!!props.errorMessage && (
                    <div className={clsx('col-12 kt-padding-l-0', {'form-control-sm': props.formControlSm})} style={{ color: "red" }}>
                        {props?.errorMessage}
                    </div>
                )}
            </div>
        </>
    )
};

export default SelectInput;
