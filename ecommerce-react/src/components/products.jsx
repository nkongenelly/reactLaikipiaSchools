import React, { Component } from "react";
import Product from "./product";

class Products extends Component {
  state = {
    // index: 0,
    // products: []
  };
  render() {
    // console.log(this.state.products.length);
    return (
      <div className="card-group">
        {this.props.products.map(product => (
          <Product
            key={product.id}
            product={product}
            onAddCart={this.props.onAddCart}
          />
        ))}
      </div>
    );
  }
}

export default Products;
