// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class SimpleHeader extends Component {

  static slug = 'simp_simple_header';

  render() {
    return (
      <Fragment>
        <h1 className="simp-simple-header-heading">{this.props.heading}</h1>
        <p>
          {this.props.content()}
        </p>
      </Fragment>
    );
  }
}

export default SimpleHeader;