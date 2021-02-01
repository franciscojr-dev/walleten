import React from 'react'

import DivInfo from '../divInfo'

function data(props) {
    return (
        <>
            <div className="ticker-data">
                <DivInfo label="Máximo (dia)" value={props.max} format="money" noColor></DivInfo>
                <DivInfo label="Mínimo (dia)" value={props.min} format="money" noColor></DivInfo>
                <DivInfo label="Cotação Atual" value={props.current} format="money" noColor></DivInfo>
                <DivInfo label="Valorização (dia)" value={props.change_abs * props.amount} format="money"></DivInfo>
                <DivInfo label="Variação R$ (dia)" value={props.change_abs} format="money"></DivInfo>
                <DivInfo label="Variação % (dia)" value={props.change} format="percent"></DivInfo>
            </div>
        </>
    )
}

export default data