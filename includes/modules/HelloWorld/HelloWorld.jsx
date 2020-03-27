// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class HelloWorld extends Component {

  static slug = 'uad_hello_world';

  static css(props) {
    const additionalCss = [];
    //const utils         = window.ET_Builder.API.Utils;
    // Process text-align value into style
    if ( props.icon_color_uad ) {
      additionalCss.push([{
        selector:    '%%order_class%% .uad-wrap .uad-icon',
        declaration: `color: ${props.icon_color_uad};`,
      }]);
    }
    if ( props.title_text_color ) {
      additionalCss.push([{
        selector:    '%%order_class%% .uad-wrap .uad-heading',
        declaration: `color: ${props.title_text_color};`,
      }]);
    }
    return additionalCss;
  }
  render() {
    const icon = this.props.icon;
    const utils = window.ET_Builder.API.Utils;
    const icon_display         = icon ? utils.processFontIcon(icon) : false;

    return (
      <Fragment>
        <div className="uad-wrap">
          <span className="uad-icon">{icon_display }</span>
          <h1 className="uad-heading">
            {this.props.heading}
          </h1>
            {this.props.content()}
        </div>
      </Fragment>
    );
  }
}

export default HelloWorld;
