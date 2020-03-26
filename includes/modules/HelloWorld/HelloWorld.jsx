// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class HelloWorld extends Component {

  static slug = 'uad_hello_world';
  render() {
    return (
      <Fragment>
        <h1 className="uad-heading">
        {this.props.heading}
        </h1>
        <p>
          {this.props.content()}
        </p>
      </Fragment>
    );
  }
}

export default HelloWorld;
