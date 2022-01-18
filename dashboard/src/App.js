import Topbar from "./compnents/topbar/Topbar";
import Sidebar from "./compnents/sidebar/Sidebar";
import Home from "./pages/home/Home";
import "./app.css";
import {BrowserRouter as Router, Switch, Route} from "react-router-dom";
import UserList from "./pages/userList/UserList";
import User from "./pages/user/User";
import NewUser from "./pages/newUser/NewUser";
import Product from "./pages/product/Product";
import NewProduct from "./pages/newProduct/NewProduct";
import Login from "./pages/login/Login";
import Activate from "./pages/activate/Activate";
import Vacation from "./pages/productList/Vacation";
import Task from "./pages/task/Task";
import Payroll from "./pages/payroll/Payroll";
import Expense from "./pages/expense/Expense";

function App() {
  const token = localStorage.getItem('user-info');

  if(!token) {
    return <Login />
  }
  return (
    <Router>
      <Topbar/>
      <div className="container">
          <Sidebar />
          <Switch>
            <Route exact path="/">
              <Home />
            </Route>
            <Route path="/users">
              <UserList />
            </Route>
            <Route path="/user/:userId">
              <User/>
            </Route>
            <Route path="/newUser">
              <NewUser/>
            </Route>
            <Route path="/vacation">
              <Vacation />
            </Route>
            <Route path="/product/:productId">
              <Product/>
            </Route>
            <Route path="/newProduct">
              <NewProduct/>
            </Route>
            <Route path="/activate">
              <Activate />
            </Route>
            <Route path="/task">
              <Task />
            </Route>
            <Route path="/payroll">
              <Payroll />
            </Route>
            <Route path="/expense">
              <Expense />
            </Route>
          </Switch>
          
      </div>

    </Router>
  );
}

export default App;
