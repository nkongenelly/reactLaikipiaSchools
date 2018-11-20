import React, { Component } from "react";
import Maps from "./Maps";

class MapMarkers extends Component {
  state = {
    schools: [],
    labels: [
      { name: "laikipia Schools", id: 1 },
      { name2: "primary", id: 2 },
      { name3: "secondary" }
    ],
    isLoaded: false
  };
  componentDidMount() {
    fetch("https://nanyukiaf.azurewebsites.net/laikipiaschools/schools")
      .then(response => response.json())
      .then(response => {
        console.log(response);
        this.setState({ isLoaded: true, schools: response });
      })

      .catch(error => console.log(error));
  }

  render() {
    console.log(this.state.schools);
    const { isLoaded, schools } = this.state;
    if (!isLoaded) {
      return (
        <div>
          <h3>...loading</h3>
        </div>
      );
    } else if (schools.length > 0) {
      return <Maps schools={this.state.schools} />;
    }
  }
}

export default MapMarkers;
