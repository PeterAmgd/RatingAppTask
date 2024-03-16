import React, { Component } from 'react';
import { createRoot } from 'react-dom';
import axios from "axios";
import Swal from "sweetalert2";
import { sum } from "lodash";

class Order extends Component {
    constructor(props) {
        super(props);
        this.state = {
          orders: [],
          loading: true,
        };
      }

      componentDidMount() {
        axios.get('/admin/orders') // Replace '/api/orders' with your actual Laravel backend route
          .then(response => {
            this.setState({
              orders: response.data,
              loading: false,
            });
          })
          .catch(error => {
            console.error('Error fetching data:', error);
            this.setState({ loading: false });
          });
      }

      render() {
        const { orders, loading } = this.state;

        return (
          <div>
            <h1>Order List</h1>
            {loading ? (
              <p>Loading...</p>
            ) : (
              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Order Number</th>
                    {/* Add more table headers as needed */}
                  </tr>
                </thead>
                <tbody>
                  {orders.map(order => (
                    <tr key={order.id}>
                      <td>{order.id}</td>
                      <td>{order.order_number}</td>
                      {/* Add more table cells as needed */}
                    </tr>
                  ))}
                </tbody>
              </table>
            )}
          </div>
        );
      }
    }

export default Order;

const root = document.getElementById('order');
if (root) {
    const rootInstance = createRoot(root);
    rootInstance.render(<Order />);
}
