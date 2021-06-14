import React from 'react'

import './index.css'
import Info from './info'

function ticker(props) {
    return (
        <>
            <div className="ticker">
                <Info {...props}></Info>
            </div>
        </>
    )
}

export default ticker