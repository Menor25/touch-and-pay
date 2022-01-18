import axios from 'axios';
import React, {useState, useEffect} from 'react';
import {Redirect } from 'react-router-dom';
import "./login.css"

export default function Login() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");

    useEffect(() =>{
        if(localStorage.getItem('user-info')){
            return <Redirect to="/" />;
        }
    })

    async function login(){
        const config = {
            headers: {
                'Content-Type': 'application/json',
            },
        };
        const body = JSON.stringify({email, password});

        try{
            const res = await axios.post('user/login', body, config);
            localStorage.setItem("user-info", res.data.accessToken);
            console.log(res.data)
            return <Redirect to="/" />;
        } catch (err) {
            console.log(err)
        }
        
    }

    return (
        <div className='login'>
            <h1 className='navheader'>Login Here</h1>
            <div className='col-sm-6 offset-sm-3'>
                <input type="text" placeholder='Email' onChange={(e)=>setEmail(e.target.value)} className='form-control' />
                <br />
                <input type="password" placeholder='Password' onChange={(e)=>setPassword(e.target.value)} className='form-control' />
                <br />
                <button onClick={login} className='btn btn-primary'> Login </button>
            </div>
        </div>
    )
}
