import React, { Component } from "react";
import { GoogleApiWrapper, InfoWindow, Map, Marker } from "google-maps-react";
// import REACT_APP_API_KEY from "./credentials";
// import Paper from "material-ui/core";
// import Typography from "material-ui/Typography";
// import { typography } from "material-ui/styles";
console.log(process.env.REACT_APP_API_KEY);
// console.log(`${process.env.REACT_APP_API_KEY}`);
class Maps extends Component {
  constructor(props) {
    super(props);
    this.state = {
      showingInfoWindow: false,
      activeMarker: {},
      selectedPlace: {}
    };
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
  render() {
    const style = {
      width: "60vw",
      height: "85vh",
      float: "left"
      // marginLeft: "auto",
      // marginRight: "auto"
    };
    return (
      <Map
        item
        xs={12}
        style={style}
        google={this.props.google}
        onClick={this.onMapClick}
        zoom={14}
        initialCenter={{ lat: 0.397, lng: 37.1588 }}
      >
        <Marker
          onClick={this.onMarkerClick}
          title={"Laikipia West"}
          position={{ lat: 0.0954, lng: 36.5503 }}
          name={"Muruku Primary School"}
        />
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
    );
  }
}

// export default App;
export default GoogleApiWrapper({
  api: process.env.REACT_APP_API_KEY
})(Maps);
