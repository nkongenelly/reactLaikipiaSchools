import React, { Component } from "react";
class NavBar extends Component {
  // state = {
  // totalCounters = {this.state.counters.filter(c => c.value > 0).length}
  // }
  render() {
    return (
      <nav className="navbar navbar-light bg-light">
        <a className="navbar-brand" href="#">
          Navbar{" "}
          <span className="badge badge-secondary">
            {this.props.totalCounters}
          </span>
        </a>
      </nav>
    );
  }
}
// const NavBar = props => {
//   return (
//     <nav className="navbar navbar-light bg-light">
//       <a className="navbar-brand" href="#">
//         Navbar
//       </a>
//     </nav>
//   );
// };

export default NavBar;
