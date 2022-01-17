import React from 'react'
import "./expense.css";
import axios from 'axios';
import { Redirect } from 'react-router-dom';

export default function Expense() {
    const addExpense = (event) => {
        event.preventDefault();

        const id = event.target.id.value;
        const amount = event.target.amount.value;
        const description = event.target.description.value;
        const title = event.target.title.value;

        const data = {id, amount, description, title};
        const url = `/expense/create/${id}`;

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
        <div className='expense'>
            <h1 className="newUserTitle">Add Expense</h1>
            <form className="newUserForm" onSubmit={addExpense}>
                <div className="newUserItem">
                    <label >User Id</label>
                    <input type="number" name="id" className='form-control' id="id" placeholder="Enter user id" />
                </div>
                <div className="newUserItem">
                    <label >Amount</label>
                    <input type="number" name="amount" className='form-control' id="amount" placeholder="Enter amount" />
                </div>
                <div className="newUserItem">
                    <label >Description</label>
                    <input type="text" name='description' className='form-control' id="description" placeholder="Enter description" />
                </div>
                <div className="newUserItem">
                    <label >Title</label>
                    <input type="text" name='title' className='form-control' id="title" placeholder="Enter vacation title" />
                </div>
                <br />
                <div>
                    <button type="submit" className="newUserButton" >Add Expense</button>
                </div>
              
            </form>
        </div>
    )
}
