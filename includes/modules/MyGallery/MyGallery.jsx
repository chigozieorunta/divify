import React, { Component, Fragment } from 'react';
	
import './gallery.css';
	
class MyGallery extends Component {
	
  static slug = 'my_gallery';

  state = {
    photos: []
  }

  componentDidMount() {
    fetch('http://yoursite.com/wp-json/wp/v2/gallery')
    .then((response) => response.json())
    .then(allPhotos => {
        this.setState({ photos: allPhotos });
    })
    .catch(error => console.log('Error:', error));
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