import "./widgetSm.css"
import userImage from "../topbar/images/rebekah.jpg"
import { Visibility } from "@material-ui/icons"

export default function WidgetSm() {
    return (
        <div className="widgetSm">
            <span className="widgetSmTitle">New Members</span>
            <ul className="widgetSmList">
                <li className="widgetSmListItem">
                    <img src={userImage} alt="UserImage" className="widgetSmImage" />
                    <div className="widgetSmUser">
                        <span className="widgetSmUsername">Rebekah Menor</span>
                        <span className="widgetSmJobTitle">Software Engineer</span> 
                    </div>
                    <button className="widgetSmButton">
                        <Visibility className="widgetSmIcon"/>Display
                    </button>
                </li>
                <li className="widgetSmListItem">
                    <img src={userImage} alt="UserImage" className="widgetSmImage" />
                    <div className="widgetSmUser">
                        <span className="widgetSmUsername">Rebekah Menor</span>
                        <span className="widgetSmJobTitle">Software Engineer</span> 
                    </div>
                    <button className="widgetSmButton">
                        <Visibility className="widgetSmIcon"/>Display
                    </button>
                </li>
                <li className="widgetSmListItem">
                    <img src={userImage} alt="UserImage" className="widgetSmImage" />
                    <div className="widgetSmUser">
                        <span className="widgetSmUsername">Rebekah Menor</span>
                        <span className="widgetSmJobTitle">Software Engineer</span> 
                    </div>
                    <button className="widgetSmButton">
                        <Visibility className="widgetSmIcon"/>Display
                    </button>
                </li>
                <li className="widgetSmListItem">
                    <img src={userImage} alt="UserImage" className="widgetSmImage" />
                    <div className="widgetSmUser">
                        <span className="widgetSmUsername">Rebekah Menor</span>
                        <span className="widgetSmJobTitle">Software Engineer</span> 
                    </div>
                    <button className="widgetSmButton">
                        <Visibility className="widgetSmIcon"/>Display
                    </button>
                </li>
                <li className="widgetSmListItem">
                    <img src={userImage} alt="UserImage" className="widgetSmImage" />
                    <div className="widgetSmUser">
                        <span className="widgetSmUsername">Rebekah Menor</span>
                        <span className="widgetSmJobTitle">Software Engineer</span> 
                    </div>
                    <button className="widgetSmButton">
                        <Visibility className="widgetSmIcon"/>Display
                    </button>
                </li>
            </ul>
        </div>
    )
}
