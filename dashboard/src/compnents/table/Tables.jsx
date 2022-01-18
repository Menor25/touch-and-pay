import React from 'react'

export default function Tables(item) {
    return (
        <div>
             <tr key={item.id}>
                <td>{item.id}</td>
                <td>{item.email}</td>
                <td>{item.firstName}</td>
                <td>{item.lastName}</td>
            </tr>
        </div>
    )
}
