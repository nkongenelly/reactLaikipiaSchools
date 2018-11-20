import React, { Component } from "react";

class SidePage extends Component {
  state = {};
  render() {
    return (
      //Create a div element that will fit side by side with the map div
      <div>
        <div className="row" style={{ float: "right" }} id="logo">
          <img
            src="/images/screen1.png"
            alt=""
            style={{ float: "right", width: "40vw", height: "85vh" }}
          />
        </div>
        <div id="schools">
          <div className="card" style={{ width: "18rem" }}>
            <img
              className="card-img-top"
              src=".../100px180/"
              alt="Card image cap"
            />
            <div className="card-body">
              <h5 className="card-title">Card title</h5>
              <p className="card-text">
                Some quick example text to build on the card title and make up
                the bulk of the card's content.
              </p>
              <a href="#" className="btn btn-primary">
                Go somewhere
              </a>
            </div>
          </div>
        </div>
      </div>
    );
  }
  componentDidMount() {
    // document.getElementById("school").style.display = "none";
    // document.getElementById("logo").style.display = "block";
  }
}

export default SidePage;
