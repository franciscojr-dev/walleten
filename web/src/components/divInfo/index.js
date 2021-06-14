import React from 'react'

import './index.css'
import Utils from '../../helpers/utils'

function getValue(props) {
    if (props.format === 'index') {
        let tempV = props.value.match(/(?<v1>.*)\((?<v2>.*)\)/i);

        return (
            <span>
                {Utils.formatValue(tempV.groups.v1, 'decimal')} <span {...Utils.getClassColorValue(tempV.groups.v2)}>({Utils.formatValue(tempV.groups.v2, 'percent')})</span>
            </span>
        )
    }

    const className = Utils.getClassColorValue(props.value, props.noColor);
    
    return <span {...className}>{Utils.formatValue(props.value, props.format)}</span>
}

function divInfo(props) {
    return (
        <div>
            <span>{props.label}</span>
            {getValue(props)}
        </div>
    )
}

export default divInfo