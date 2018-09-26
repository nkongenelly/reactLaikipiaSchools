import React from "react";
import ReactDOM from "react-dom";
import "./index.css";
import App from "./App";
import registerServiceWorker from "./registerServiceWorker";
import Product from "./components/product";

ReactDOM.render(<Product />, document.getElementById("root"));
registerServiceWorker();
