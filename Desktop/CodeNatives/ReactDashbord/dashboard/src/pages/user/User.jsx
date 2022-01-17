
import "./user.css"
import userImage from "../userList/images/user.jpg"
import { CalendarToday, LocationSearching, MailOutline, PermIdentity, PhoneAndroid, Publish } from "@material-ui/icons";
import {Link} from "react-router-dom";
import "../../App";


export default function User() {
    return (
        <div className="user">
            <div className="userTitleContainer">
                <h1 className="userTitle">Edit User</h1>

                <Link to="/newUser">
                    <button className="userAddButton">Create</button>
                </Link>
            </div>
            <div className="userContainer">
                <div className="userShow">
                    <div className="userShowTop">
                        <img src={userImage} alt="UserImage" className="userShowImage" />
                        <div className="userShowTopTitle">
                            <span className="userShowUsername">Rebekah Menor</span>
                            <span className="userShowUserJob">Software Engineer</span>
                        </div>
                    </div>
                    <div className="userShowBottom">
                        <span className="userShowTitle">Account Details</span>
                        <div className="userShowInfo">
                            <PermIdentity className="userShowIcon"/>
                            <span className="userShowInfoTitle">rebekah14</span>
                        </div>
                        <div className="userShowInfo">
                            <CalendarToday className="userShowIcon"/>
                            <span className="userShowInfoTitle">19-12-2000</span>
                        </div>                        
                        <span className="userShowTitle">Contact Details</span>
                        <div className="userShowInfo">
                            <PhoneAndroid className="userShowIcon"/>
                            <span className="userShowInfoTitle">+234801919191</span>
                        </div>                        
                        <div className="userShowInfo">
                            <MailOutline className="userShowIcon"/>
                            <span className="userShowInfoTitle">rebekah@gmail.com</span>
                        </div>                        
                        <div className="userShowInfo">
                            <LocationSearching className="userShowIcon"/>
                            <span className="userShowInfoTitle">Calabar | Nigeria</span>
                        </div>
                    </div>
                </div>
                <div className="userUpdate">
                    <span className="userUpdateTitle">Edit</span>
                    <form className="userUpdateForm">
                        <div className="userUpdateLeft">
                            <div className="userUpdateItem">
                                <label>Email</label>
                                <input type="text" placeholder="rebekah@gmail.com" className="userUpdateInput" />
                            </div>
                            <div className="userUpdateItem">
                                <label>First Name</label>
                                <input type="text" placeholder="Rebekah" className="userUpdateInput" />
                            </div>
                            <div className="userUpdateItem">
                                <label>Last Name</label>
                                <input type="text" placeholder="Menor" className="userUpdateInput" />
                            </div>
                            <div className="userUpdateItem">
                                <label>Phone</label>
                                <input type="text" placeholder="rebekah14" className="userUpdateInput" />
                            </div>
                            <div className="userUpdateItem">
                                <label>Password</label>
                                <input type="password" placeholder="password" className="userUpdateInput" />
                            </div>
                            <div className="userUpdateItem">
                                <label>Username</label>
                                <input type="text" placeholder="rebekah14" className="userUpdateInput" />
                            </div>
                        </div>
                        <div className="userUpdateRight">
                            <div className="userUpdateUpload">
                                <img src={userImage} alt="UserImage" className="userUpdateImage" />
                                <label htmlFor="file"><Publish className="userUpdateIcon" /></label>
                                <input type="file" id="file" style={{display: "none"}} />
                            </div>
                            <button className="userUpdateButton">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    )
}
