import React, { Component, Fragment } from 'react';
	
import './gallery.css';
	
class MyGallery extends Component {
	
  static slug = 'my_gallery';

  state = {
    photos: []
  }
  	
  render() {
    return (
     <Fragment>
       <h1 className="my-gallery-heading">{this.props.heading}</h1>
       <div className="my-gallery-content">{this.props.content()}</div>
     </Fragment>
    );
  }
}
          	
export default MyGallery;