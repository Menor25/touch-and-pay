import React from 'react'
import "./task.css";

export default function Task() {
    return (
        <div className='task'>
            <h1 className="newUserTitle">Assign Task</h1>
            <form className="newUserForm">
                <div className="newUserItem">
                    <label >Description</label>
                    <input type="text" name='description' className='form-control' id="description" placeholder="Enter task description" />
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
                    <label >Title</label>
                    <input type="text" name='title' className='form-control' id="title" placeholder="Enter title" />
                </div>
                <br />
                <div>
                    <button type="submit" className="newUserButton" >Create Task</button>
                </div>
              
            </form>
        </div>
    )
}
