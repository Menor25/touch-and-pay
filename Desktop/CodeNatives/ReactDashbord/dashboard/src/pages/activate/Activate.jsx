import React from 'react';
import "./activate.css";
import axios from 'axios';
import { Redirect } from 'react-router-dom';

export default function Activate(props) {
    const activateUser = (event) => {
        event.preventDefault();
        
        const id = event.target.id.value;

        const data = {id};
        const url = `/user/activate/${id}`;

        axios.post(url, data)
        .then((response) => {
            console.log(response);
            return <Redirect to="/" />;
        })
        .catch((error) => {
            console.log(error);
        });
    };

    
    return (
        <div className='activate'>
            <h1 className="newUserTitle">Activate User</h1>
            <form className="newUserForm" onSubmit={activateUser}>
                <div className="newUserItem">
                    <label >Enter User Id</label>
                    <input type="text" name='id' className='form-control' id="id" placeholder="id" />
                </div>
                <br />
                <div>
                    <button type="submit" className="newUserButton" >Activate</button>
                </div>
              
            </form>
        </div>
    )
}
