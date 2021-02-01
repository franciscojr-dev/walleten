import React from 'react'

import Utils from '../../helpers/utils'
import DivInfo from '../divInfo'

function stats(props) {
    return (
        <>
            <div className="ticker-stats">
                <DivInfo label="Quantidade" value={props.amount} noColor></DivInfo>
                <DivInfo label="Preço Médio" value={props.avg} format="money" noColor></DivInfo>
                <DivInfo label="Montante Final" value={props.amount * props.current} format="money" noColor></DivInfo>
                <DivInfo label="Rentabilidade" value={(Utils.getPercentage(props.current, props.avg))} format="percent"></DivInfo>
            </div>
        </>
    )
}

export default stats