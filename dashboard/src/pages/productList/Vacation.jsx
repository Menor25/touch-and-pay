import "./vacation.css";
import React from 'react'
import axios from 'axios';
import { Redirect } from 'react-router-dom';

export default function Vacation(props) {
    const addVacation = (event) => {
        event.preventDefault();
        
        const id = event.target.id.value;
        const duration = event.target.duration.value;
        const reason = event.target.reason.value;
        const title = event.target.title.value;
        const type = event.target.type.value;

        const data = {id, duration, reason, title, type};
        const url = `/vacations/create/${id}`;

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
        <div className="vacation">
            <h1 className="newUserTitle">Leave</h1>
            <form className="newUserForm" onSubmit={addVacation}>
                <div className="newUserItem">
                    <label >User ID</label>
                    <input type="number" name='id' className='form-control' id="id" placeholder="Enter user id" />
                </div>
                <div className="newUserItem">
                    <label >Duration</label>
                    <input type="number" name='duration' className='form-control' id="duration" placeholder="Enter duration" />
                </div>
                <div className="newUserItem">
                    <label >Reason for Vacation</label>
                    <input type="text" name='reason' className='form-control' id="reason" placeholder="Enter reason for vacation" />
                </div>
                <div className="newUserItem">
                    <label >Title</label>
                    <input type="text" name='title' className='form-control' id="title" placeholder="Enter vacation title" />
                </div>
                <div className="newUserItem">
                    <label >Type</label>
                    <input type="text" name='type' className='form-control' id="type" placeholder="Enter type" />
                </div>
                <br />
                <div>
                    <button type="submit" className="newUserButton" >Create Vacation</button>
                </div>
              
            </form>
        </div>
    )
}

