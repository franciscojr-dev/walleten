import React from 'react'

import Stats from './stats'
import Data from './data'

function info(props) {
    return (
        <>
            <div className="ticker-info">
                <span>{props.name}</span>
                <Stats {...props}></Stats>
                <Data {...props}></Data>
            </div>
        </>
    )
}

export default info