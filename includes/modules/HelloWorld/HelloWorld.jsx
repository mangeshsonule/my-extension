// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class HelloWorld extends Component {

  static slug = 'uad_hello_world';
  render() {
    const icon = this.props.icon;

    return (
      <Fragment>
        <div className="uad-wrap">
          <span className="uad-icon">{icon}</span>
          <h1 className="uad-heading">
            {this.props.heading}
          </h1>
          <p>
            {this.props.content()}
          </p>
        </div>
      </Fragment>
    );
  }
}

export default HelloWorld;
