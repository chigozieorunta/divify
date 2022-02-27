// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';

const HelloWorld = props => {
  return (
    <h1>
      {props.content}
    </h1>
  )
}

export default HelloWorld;


/*class HelloWorld extends Component {

  static slug = 'divi_hello_world';

  render() {
    const Content = this.props.content;

    return (
      <h1>
        <Content/>
      </h1>
    );
  }
}

export default HelloWorld;*/
