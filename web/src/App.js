import React, { useEffect, useState } from 'react'

import Wallet from './components/wallet'

function App() {
    const [wallets, setWallets] = useState([]);

    useEffect(() => {
        fetch('https://api.walleten.com.br/wallet/1')
        .then(response => response.json())
        .then(data => {
            if (data.statusCode === 200) {
                const walletResponse = data.data;
                for(const wallet in walletResponse) {
                    if (walletResponse[wallet].primary === 'y') {
                        setWallets({load: true, ...walletResponse[wallet]});
                    }
                }
            }
        });
    }, []);

    return (
        <>
            <Wallet {...wallets}></Wallet>
        </>
    )
}

export default App