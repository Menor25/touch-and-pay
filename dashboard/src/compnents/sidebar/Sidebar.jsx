import "./sidebar.css"
import { LineStyle, Timeline, TrendingUp, Report, WorkOutline, PermIdentity, Storefront, AttachMoney, BarChart, MailOutline, DynamicFeed, ChatBubbleOutline } from "@material-ui/icons"
import { Link } from "react-router-dom"

export default function Sidebar() {
    return (
        <div className="sidebar">
            <div className="sidebarWrapper">
                <div className="sidebarMenu">
                    <h3 className="sidebarTitle">Dashboard</h3>
                    <ul className="sidebarList">
                        <Link to="/" className="link">
                            <li className="sidebarListItem active">
                                <LineStyle className="sidebarIcon"/>Home
                            </li>
                        </Link>
                        <li className="sidebarListItem">
                            <Timeline className="sidebarIcon"/>Analytics
                        </li>
                        <li className="sidebarListItem">
                            <TrendingUp className="sidebarIcon"/>Sales
                        </li>
                    </ul>
                </div>
                <div className="sidebarMenu">
                    <h3 className="sidebarTitle">Quick Menu</h3>
                    <ul className="sidebarList">
                        <Link to="/users" className="link">
                            <li className="sidebarListItem">
                                    <PermIdentity className="sidebarIcon"/>Users
                            </li>
                        </Link>
                        <Link to="/vacation" className="link">
                            <li className="sidebarListItem">
                                <Storefront className="sidebarIcon"/>Leave
                            </li>
                        </Link>
                        <Link to="/expense" className="link">
                            <li className="sidebarListItem">
                                <AttachMoney className="sidebarIcon"/>Expense
                            </li>
                        </Link>
                        <Link to="/payroll" className="link">
                            <li className="sidebarListItem">
                                <AttachMoney className="sidebarIcon"/>Payroll
                            </li>
                        </Link>
                        <Link to="/task" className="link">
                            <li className="sidebarListItem">
                                <WorkOutline className="sidebarIcon"/>Task
                            </li>
                        </Link>
                        <Link to="/activate" className="link">
                            <li className="sidebarListItem">
                                <PermIdentity className="sidebarIcon"/>Activate User
                            </li>
                        </Link>
                    </ul>
                </div>
                <div className="sidebarMenu">
                    <h3 className="sidebarTitle">Notifications</h3>
                    <ul className="sidebarList">
                        <li className="sidebarListItem">
                            <MailOutline className="sidebarIcon"/>Mail
                        </li>
                        <li className="sidebarListItem">
                            <DynamicFeed className="sidebarIcon"/>Feedback
                        </li>
                        <li className="sidebarListItem">
                            <ChatBubbleOutline className="sidebarIcon"/>Messages
                        </li>
                    </ul>
                </div>
                <div className="sidebarMenu">
                    <h3 className="sidebarTitle">Staff</h3>
                    <ul className="sidebarList">
                        <li className="sidebarListItem">
                            <Timeline className="sidebarIcon"/>Attendance
                        </li>
                        <li className="sidebarListItem">
                            <Report className="sidebarIcon"/>Misconduct
                        </li>
                        <li className="sidebarListItem">
                            <DynamicFeed className="sidebarIcon"/>Task
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    )
}
