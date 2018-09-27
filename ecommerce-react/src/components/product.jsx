import React, { Component } from "react";
import ReactDOM from "react-dom";

class Product extends Component {
  render() {
    return (
      <React.Fragment>
        <div className="card">
          <img
            className="card-img-top"
            src=".../100px180/"
            alt="Card image cap"
          />
          <div className="card-body">
            <h5 className="card-title">
              Product Name :{this.props.product.productName}
            </h5>
            <p>Product Name :{this.props.product.productName} </p>
            <p>Product Price KES :{this.props.product.productPrice} </p>
            <button
              onClick={() => this.props.onAddCart(this.props.product)}
              className="btn btn-primary m-2"
            >
              Add to Cart
            </button>
          </div>
        </div>
      </React.Fragment>
    );
  }
}

export default Product;
