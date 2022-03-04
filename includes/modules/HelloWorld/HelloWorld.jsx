// External Dependencies
import React, { Component } from 'react';

class HelloWorld extends Component {

  static slug = 'divi_hello_world';

  render() {
    const Content = this.props.content;

    return (
      <h1>
        <div>Hello <Content/></div>
      </h1>
    );
  }
}

export default HelloWorld;
