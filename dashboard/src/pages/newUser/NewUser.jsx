import "./newUser.css"

import axios from 'axios';


export default function NewUser(props) {
    const addUser = (event) => {
        event.preventDefault();
        
        const email = event.target.email.value;
        const firstName = event.target.firstName.value;
        const lastName = event.target.lastName.value;
        const phone = event.target.phone.value;
        const username = event.target.username.value;
        const password = event.target.password.value;

        const data = {email, firstName, lastName, phone, username, password};
        const url = '/user/create';

        axios.post(url, data)
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.log(error);
        });
    };
  

    return (
        <div className="newUser">
            <h1 className="newUserTitle">New User</h1>
            <form className="newUserForm" onSubmit={addUser}>
                <div className="newUserItem">
                    <label >Email</label>
                    <input type="email" name='email' id="email" placeholder="rebekah@gmail.com" />
                </div>
                <div className="newUserItem">
                    <label >First Name</label>
                    <input type="text" name="firstName" id="firstName" placeholder="Rebekah" />
                </div>
                <div className="newUserItem">
                    <label >Last Name</label>
                    <input type="text" name="lastName" id="lastName" placeholder="Menor" />
                </div>
                <div className="newUserItem">
                    <label >Phone</label>
                    <input type="text" name="phone" id="phone" placeholder="+2348030303030" />
                </div>
                <div className="newUserItem">
                    <label >Username</label>
                    <input type="text" name="username" id="username" placeholder="rebekah" />
                </div>
                <div className="newUserItem">
                    <label >Password</label>
                    <input type="password" name="password" id="password" placeholder="password" />
                </div>




                {/* <div className="newUserItem">
                    <label >Address</label>
                    <input type="text" placeholder="Calabar | Nigeria" />
                </div>
                <div className="newUserItem">
                    <label >Gender</label>
                    <div className="newUserGender">
                        <input type="radio" name="gender" id="male" value="male" />
                        <label for="male">Male</label>
                        <input type="radio" name="gender" id="female" value="female" />
                        <label for="female">Female</label>
                        <input type="radio" name="gender" id="other" value="other" />
                        <label for="other">Other</label>
                    </div>
                </div>
                <div className="newUserItem">
                    <label >Active</label>
                    <select name="active" id="active" className="newUserSelect">
                        <option value="yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div> */}
                <button type="submit" className="newUserButton" >Create</button>
              
            </form>
        </div>
    )
}
