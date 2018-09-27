import React, { Component } from "react";
import ReactDOM from "react-dom";
import "./App.css";
import NavBar from "./components/navBar";
import Counters from "./components/counters";
import Products from "./components/products";

class App extends Component {
  state = {
    counters: [
      // { id: 1, value: 0 },
      // { id: 2, value: 3 },
      // { id: 3, value: 7 },
      // { id: 4, value: 5 }
    ],
    index: 0,
    products: []
  };
  handleReset = () => {
    const counters = this.state.counters.map(c => {
      c.value = 0;
      return c;
    });
    this.setState({ counters });
  };
  handleDelete = counterId => {
    const counters = this.state.counters.filter(c => c.id !== counterId);
    this.setState({ counters });
  };
  handleIncrement = counter => {
    const counters = [...this.state.counters]; //3 dots means clone the object
    const index = counters.indexOf(counter);
    counters[index] = { ...counter };
    counters[index].value++;
    this.setState({ counters });
  };
  handleCount = product => {
    var counters = [...this.state.counters];
    var index = 0;
    var toPush = {
      id: product.id,
      productName: product.productName,
      productPrice: product.productPrice,
      value: 1
    };
    counters.push(toPush);
    this.setState({ counters });
    console.log(counters.length);
  };
  handleDecrement = counter => {
    const counters = [...this.state.counters]; //3 dots means clone the object
    const index = counters.indexOf(counter);
    counters[index] = { ...counter };
    counters[index].value--;
    this.setState({ counters });
  };

  render() {
    return (
      <React.Fragment>
        <NavBar
          totalCounters={this.state.counters.filter(c => c.value > 0).length}
        />
        <div className="container">
          <div className="row">
            <div className="col-sm-07">
              <Products
                onAddCart={this.handleCount}
                products={this.state.products}
                fetchData={this.fetchData}
              />
            </div>
            <div className="col-sm-04">
              <Counters
                counters={this.state.counters}
                onReset={this.handleReset}
                onIncrement={this.handleIncrement}
                onDecrease={this.handleDecrement}
                onDelete={this.handleDelete}
              />
            </div>
          </div>
        </div>
      </React.Fragment>
    );
  }
  componentDidMount() {
    this.fetchData();
  }
  fetchData() {
    fetch("https://ecommerce-nelly.azurewebsites.net/productsbuyers")
      .then(response => response.json())
      .then(result =>
        result.map(
          result => {
            console.log(result);
            // const products = [...this.state.products]; //3 dots means clone the object
            // const index = products.indexOf(result);
            // products[index] = { ...result };
            // let productname = {
            //   ...this.state.products.productName.push(result.product_name)
            // };
            // this.state.products.productName = ${result.product_name};
            var products = [...this.state.products];
            var index = 0;
            var toPush = {
              id: result.id,
              productName: result.product_name,
              productPrice: result.product_price,
              value: 1,
              productImage: result.product_image
            };
            products.push(toPush);
            console.log(products);
            this.setState(
              { products }
              //   products: [
              //     {
              //       id: `${result.id}`,
              //       productName: `${result.product_name}`,
              //       productPrice: `${result.product_price}`
              //     }
              //   ]

              //   productName: `${result.product_name}`,
              //   productPrice: `${result.product_price}`,
              //   id: `${result.id}`
              // }
            );
            // console.log(result);
          }

          //   .then(result => {
          //     this.setState({
          //       productName: `${result}`,
          //       productPrice: `${result}`
          //     });
          // }
        )
      )
      .catch(error => console.log("parsing failed", error));
    // console.log(fetch);
  }
}

export default App;
