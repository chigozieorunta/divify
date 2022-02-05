// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class DivifyBlurb extends Component {

  static slug = 'divify_blurb';

  render() {
    const Content = this.props.content;

    return (
      <h1>
        <div>Hello <Content/></div>
      </h1>
    );
  }
}

export default DivifyBlurb;
