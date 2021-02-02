import React, { useEffect, useState } from 'react'

import Data from './data'
import Loading from '../loading'
import DivInfo from '../divInfo'

function Stats(props) {
    const [indexs, setIndexs] = useState([]);

    useEffect(() => {
        fetch('https://api.walleten.com.br/indexs')
        .then(response => response.json())
        .then(data => {
            if (data.statusCode === 200) {
                const indexResponse = data.data;
                let IndexTmp = {};
                for(const index in indexResponse) {
                    IndexTmp[indexResponse[index].name] = `${indexResponse[index].close} (${indexResponse[index].change})`;
                }

                setIndexs({load: true, ...IndexTmp});
            }
        });
    }, []);

    return (
        <>
            <div className="wallet">
                <Data>
                    {!props.load && <Loading></Loading>}
                    {props.load &&
                        <>
                            <DivInfo label="Saldo total" value={`${props.total_balance}`} format="money" noColor></DivInfo>
                            <DivInfo label="Saldo em ações" value={`${props.total_stock}`} format="money" noColor></DivInfo>
                            <DivInfo label="Saldo em FIIS" value={`${props.total_fund}`} format="money" noColor></DivInfo>
                            <DivInfo label="Rentabilidade" value={`${props.profit}`} format="percent"></DivInfo>
                            <DivInfo label="Variação R$ (dia)" value={`${props.variation_money}`} format="money"></DivInfo>
                            <DivInfo label="Variação % (dia)" value={`${props.variation}`} format="percent"></DivInfo>
                        </>
                    }
                </Data>
            </div>

            <div className="indexes">
                <Data>
                    {!indexs.load && <Loading></Loading>}
                    {indexs.load && 
                        <>
                            <DivInfo label="Indice IBOV" value={`${indexs.IBOV}`} format="index" noColor></DivInfo>
                            <DivInfo label="Indice IFIX" value={`${indexs.IFIX}`} format="index" noColor></DivInfo>
                        </>
                    }
                </Data>
            </div>
        </>
    )
}

export default Stats