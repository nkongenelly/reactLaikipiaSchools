import React, { Component } from "react";

class SidePage extends Component {
  state = {};
  render() {
    if (this.props.showDetailsClicked == false) {
      return (
        //Create a div element that will fit side by side with the map div
        <div>
          <div className="row" style={{ float: "right" }} id="logo" refs="logo">
            <img
              src="/images/screen1.png"
              alt=""
              style={{ float: "right", width: "40vw", height: "85vh" }}
            />
          </div>
        </div>
      );
    } else if (this.props.showDetailsClicked == true) {
      return (
        <div id="schools" refs="schools">
          <div className="card" style={{ width: "38rem", float: "right" }}>
            <div class="card-header">
              <img
                src="/images/screen1.png"
                alt=""
                style={{ float: "right", width: "40vw", height: "25vh" }}
              />
            </div>
            <div className="card-body">
              <h5 className="card-title">{this.props.school.school_name}</h5>
              <p className="card-text">{this.props.school.about}</p>
              <p className="card-text">
                No. of boys = {this.props.school.boys}{" "}
              </p>
              <p className="card-text">
                No. of girls = {this.props.school.girls}
              </p>
              <a href="#" className="btn btn-primary">
                Import details
              </a>
            </div>
          </div>
        </div>
      );
    }
  }
}

export default SidePage;
