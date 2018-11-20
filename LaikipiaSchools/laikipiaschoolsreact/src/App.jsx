import React, { Component } from "react";
import logo from "./logo.svg";
import "./App.css";
import Maps from "./components/Maps";
import SidePage from "./components/SidePage";
import Progress from "./components/Progress";

class App extends Component {
  state = {};
  render() {
    return (
      <React.Fragment>
        <Progress />
        <Maps />
        <SidePage />
      </React.Fragment>
    );
  }
}

export default App;
