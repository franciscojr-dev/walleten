import React, { useEffect, useState } from 'react'

import './index.css'
import Ticker from '../ticker'

function getTickers(tickers) {
    let tickersTmp = [];
    for(const ticker in tickers) {
        tickersTmp.push(tickers[ticker]);
    }
    
    return tickersTmp.map((info) => <Ticker key={info.id} {...info}></Ticker>)
}

function Position(props) {
    const [tickers, setTickers] = useState([]);

    useEffect(() => {
        fetch(`https://api.walleten.com.br/wallet/tickers/${props.wallet}`)
        .then(response => response.json())
        .then(data => {
            if (data.statusCode === 200) {
                setTickers(data.data);
            }
        });
    }, [props.wallet]);

    return (
        <>
            <div className="tickers">
                {getTickers(tickers)}
            </div>
        </>
    )
}

export default Position