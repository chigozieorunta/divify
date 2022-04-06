import React, { Component, Fragment } from 'react';
	
import './gallery.css';
	
class MyGallery extends Component {
	
  static slug = 'my_gallery';

  state = {
    photos: []
  }

  componentDidMount() {

    fetch('http://divify.local/wp-json/wp/v2/gallery')
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
        <p className="my-gallery-footnote">{this.props.content()}</p>
        <div className="my-gallery">
          {
            this.state.photos.map(photo => {

              return (
                <div>
                  <img src={photo.id} alt={photo.id} />
                  <p>{photo.title.rendered}</p>
                </div>
              )
            })
          }
       </div>
     </Fragment>
    );
  }
}
          	
export default MyGallery;