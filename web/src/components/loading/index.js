import React from 'react'

import './index.css'

function loading() {
    return (
        <>
            <div className="animated-background">
                <div className="background-masker content-first-line"></div>
                <div className="background-masker content-second-line"></div>
            </div>
        </>
    )
}

export default loading