import React, {useState, useEffect} from 'react';
import "./userList.css";
import { DataGrid } from '@mui/x-data-grid';
import userImage from "./images/user.jpg"
import { DeleteOutline } from "@material-ui/icons";
import {Link} from "react-router-dom";
import {Card, CardBody, CardHeader, Col, Row, Table} from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.css';
import Tables from "../../compnents/table/Tables";

import axios from 'axios';

const url = '/user/all';
function UserList() {

    const [post, setPost] = React.useState(null);

    React.useEffect(() => {
        axios.get(url).then((response) => {
          setPost(response.data);
        });
      }, []);

      if (!post) return null;

    
    return (
        <div className="userList">
            <Row>
                <Col>
                    <Card>
                        <CardHeader className="fa fa-align-justify">User List</CardHeader>
                        <CardBody>
                            <Table hover bordered striped responsive size="sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <h1>{post.firstName}</h1>
                                </tbody>
                            </Table>
                        </CardBody>
                    </Card>
                </Col>
            </Row>
            <Link to="/newUser">
            <button className="userAddButton">Create</button>
            </Link>
        </div>
    )
}
export default UserList;