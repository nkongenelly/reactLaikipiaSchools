import React, { Component } from "react";
import { ProgressBar } from "react-bootstrap";

class Progress extends Component {
  state = {
    dignityKit: { value: 60, label: "Dignity Kit" },
    latrines: { value: 30, label: "Latrines" },
    support: { value: 10, label: "Support" },
    total: 200
  };
  calculateBalance() {
    console.log("balance calculator");
    var balance =
      this.state.total -
      (this.state.dignityKit.value +
        this.state.latrines.value +
        this.state.support.value);
    return balance === this.state.total
      ? "Complete"
      : "Ksh." + balance + " remaining";
  }
  render() {
    return (
      <React.Fragment>
        <ProgressBar min="0" max="200" style={{ height: 50 }}>
          <ProgressBar
            striped
            bsStyle="success"
            now={this.state.dignityKit.value}
            label={this.state.dignityKit.label}
            key={1}
            min="0"
            max="200"
          />
          <ProgressBar
            bsStyle="warning"
            now={this.state.latrines.value}
            label={this.state.latrines.label}
            key={2}
            min="0"
            max="200"
          />
          <ProgressBar
            active
            bsStyle="danger"
            now={this.state.support.value}
            label={this.state.support.label}
            key={3}
            min="0"
            max="200"
          />
          <h3 style={{ float: "right" }}>{this.calculateBalance()}</h3>
        </ProgressBar>
      </React.Fragment>
    );
  }
}

export default Progress;
