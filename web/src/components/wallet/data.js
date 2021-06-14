import React from 'react'

function data(props) {
    return (
        <>
            <div className="wallet-stats">
                {props.children}
            </div>
        </>
    )
}

export default data