import React from 'react'
import "./payroll.css";
import axios from 'axios';
import { Redirect } from 'react-router-dom';

export default function Payroll(id) {
    const addPayroll = (event) => {
        event.preventDefault();
        
        const amount = event.target.amount.value;
        const description = event.target.description.value;
        const firstName = event.target.firstName.value;
        const lastName = event.target.lastName.value;
        const month = event.target.month.value;

        const data = {amount, description, firstName, lastName, month};
        const url = `/payroll/create/${id}`;

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
        <div className='payroll'>
             <h1 className="newUserTitle">Create Payroll</h1>
            <form className="newUserForm" onSubmit={addPayroll}>
                <div className="newUserItem">
                    <label >Amount</label>
                    <input type="number" name='amount' className='form-control' id="amount" placeholder="Enter amount" />
                </div>
                <div className="newUserItem">
                    <label >Description</label>
                    <input type="text" name='description' className='form-control' id="description" placeholder="Enter description" />
                </div>
                <div className="newUserItem">
                    <label >First Name</label>
                    <input type="text" name='firstName' className='form-control' id="firstName" placeholder="Enter first name" />
                </div>
                <div className="newUserItem">
                    <label >Last Name</label>
                    <input type="text" name='lastName' className='form-control' id="lastName" placeholder="Enter last name" />
                </div>
                <div className="newUserItem">
                    <label >Month</label>
                    <input type="month" name='month' className='form-control' id="month" placeholder="Enter month" />
                </div>
                <br />
                <div>
                    <button type="submit" className="newUserButton" >Create Payroll</button>
                </div>
              
            </form>
        </div>
    )
}
