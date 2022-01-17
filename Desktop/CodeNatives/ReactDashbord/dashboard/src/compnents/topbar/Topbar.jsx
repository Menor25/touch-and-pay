import React from 'react';
import "./topbar.css";
import {NotificationsNone, Language, Settings, LogoutIcon} from '@material-ui/icons';
import userImage from "./images/rebekah.jpg";
import { Link } from "react-router-dom";
import { Redirect } from 'react-router-dom';



export default function Topbar() {
    function logout(){
        localStorage.removeItem("user-info");
        return <Redirect to="/login" />;
        
    }
    return (
        <div className="topbar">
            <div className='topbarWrapper'>
                <Link to="/" className='link'>
                    <div className='topLeft'>
                        <span className='logo'>Touch And Pay Technologies</span>
                    </div>
                </Link>
                <div className='topRight'>
                    <div className='topbarIconContainer'>
                        <NotificationsNone/>
                        <span className="topIconBadge">2</span>
                    </div>
                    <div className='topbarIconContainer'>
                        <Language/>
                        <span className="topIconBadge">2</span>
                    </div>
                    <div className='topbarIconContainer'>
                        <Settings/>
                    </div>
                    <img src={userImage} alt="UserImage" className="userImage" />

                    <div className='topbarIconContainer'>
                        <p className='logout' onClick={logout}>Logout</p>
                    </div>
                </div>
            </div>
        </div>
    )
}
