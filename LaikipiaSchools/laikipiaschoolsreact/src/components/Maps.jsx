import React, { Component } from "react";
import { GoogleApiWrapper, InfoWindow, Map, Marker } from "google-maps-react";
import SidePage from "./SidePage";
// import REACT_APP_API_KEY from "./credentials";
// import Paper from "material-ui/core";
// import Typography from "material-ui/Typography";
// import { typography } from "material-ui/styles";
// console.log(process.env.REACT_APP_API_KEY);
// console.log(`${process.env.REACT_APP_API_KEY}`);
class Maps extends Component {
  constructor(props) {
    super(props);
    console.log(props);
    this.state = {
      showingInfoWindow: false,
      activeMarker: {},
      selectedPlace: {},
      showDetailsClicked: false,
      school: []
    };
    console.log(this.props.schools.map(school => school.school_name));
    // binding this to event-handler functions
    this.onMarkerClick = this.onMarkerClick.bind(this);
    this.onMapClick = this.onMapClick.bind(this);
  }
  onMarkerClick = (props, marker, e) => {
    this.setState({
      selectedPlace: props,
      activeMarker: marker,
      showingInfoWindow: true
    });
  };
  onMapClick = props => {
    if (this.state.showingInfoWindow) {
      this.setState({
        showingInfoWindow: false,
        activeMarker: null
      });
    }
  };
  showDetails = school => {
    this.setState({ showDetailsClicked: true, school: school });
    console.log(this.state.showDetailsClicked == false);
    console.log(school);
    // return school;
  };
  render() {
    console.log(this.state.schools);
    console.log(this.state.showDetailsClicked == false);
    const style = {
      width: "60vw",
      height: "85vh",
      float: "left"
      // marginLeft: "auto",
      // marginRight: "auto"
    };
    return (
      <div>
        <Map
          item
          xs={12}
          style={style}
          google={this.props.google}
          onClick={this.onMapClick}
          zoom={14}
          initialCenter={{ lat: 0.397, lng: 37.1588 }}
        >
          {/* <Marker */}
          {this.props.schools.map(school => (
            <div>
              <button
                style={{ float: "right" }}
                onClick={() => this.showDetails(school)}
              >
                School Position
              </button>
              <Marker
                onClick={() => this.showDetails(this.props.schools)}
                title={school.school_name}
                position={{ lat: school.latitude, lng: school.longitude }}
                name={school.school_name}
              />
            </div>
          ))}
          {/* <Marker
          onClick={this.onMarkerClick}
          title={"Laikipia West"}
          position={{ lat: 0.0954, lng: 36.5503 }}
          name={"Muruku Primary School"}
        /> */}
          <InfoWindow
            marker={this.state.activeMarker}
            visible={this.state.showingInfoWindow}
          >
            {/* <Paper>
            <Typography variant="headline" component="h4">
              Changing Colors Garage
            </Typography>
            <Typography component="p">
              98G Albe Dr Newark, DE 19702 <br />
              302-293-8627
            </Typography>
          </Paper> */}
          </InfoWindow>
        </Map>
        <SidePage
          school={this.state.school}
          showDetailsClicked={this.state.showDetailsClicked}
        />
      </div>
    );
  }
}

// export default App;
export default GoogleApiWrapper({
  api: process.env.REACT_APP_API_KEY
})(Maps);
