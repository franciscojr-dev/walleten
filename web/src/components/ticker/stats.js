import React from 'react'

import Utils from '../../helpers/utils'
import DivInfo from '../divInfo'

function stats(props) {
    return (
        <>
            <div className="ticker-stats">
                <DivInfo label="Quantidade" value={props.position.amount} noColor></DivInfo>
                <DivInfo label="Preço Médio" value={props.position.avg} format="money" noColor></DivInfo>
                <DivInfo label="Montante Final" value={props.position.amount * props.close} format="money" noColor></DivInfo>
                <DivInfo label="Rentabilidade" value={(Utils.getPercentage(props.close, props.position.avg))} format="percent"></DivInfo>
            </div>
        </>
    )
}

export default stats