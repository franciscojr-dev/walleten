import React from 'react'

import './index.css'
import Stats from './stats'
import PositionTicker from '../positionTicker'

function wallet(props) {
    return (
        <>
            <section className="grid grid-template">
                <Stats {...props}></Stats>
                {props.id && <PositionTicker wallet={props.id}></PositionTicker>}
            </section>

        </>
    )
}

export default wallet