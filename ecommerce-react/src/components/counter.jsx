import React, { Component } from "react";
class Counter extends Component {
  //   populateTable(){
  //   this.props.counters.map(c => {
  //     var name = c.productName;
  //     var price = c.productPrice;
  //   });
  // }
  render() {
    return (
      <div>
        <span className="m-2">{this.props.counter.productName}</span>
        <span className={this.getBadgeClasses()}>{this.formatCount()}</span>
        <span className="m-2">{this.props.counter.productPrice}</span>
        <button
          onClick={() => this.props.onIncrement(this.props.counter)}
          className="btn btn-secondary btn-sm m-2"
        >
          +
        </button>
        <button
          onClick={() => this.props.onDecrease(this.props.counter)}
          className="btn btn-primary btn-sm m-2"
        >
          -
        </button>
        <button
          onClick={() => {
            this.props.onDelete(this.props.counter.id);
          }}
          className="btn btn-danger btn-sm"
        >
          Delete
        </button>
      </div>
    );
  }
  componentDidMount() {
    var counted = {
      ...this.props.counters.map(c => {
        console.log();
      })
    };
  }
  // handleDecrement = product => {
  //   console.log(product);
  //   this.setState({ value: this.props.counter.value - 1 });
  //   this.setState({ product: this.props.counter.product - 1 });
  // };

  formatCount() {
    const { value } = this.props.counter;
    return value === 0 ? "Zero" : value;
  }
  getBadgeClasses() {
    let classes = "badge m-2 badge-";
    classes += this.props.counter.value === 0 ? "warning" : "primary";
    return classes;
  }
}

export default Counter;
