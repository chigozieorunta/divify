import React, { Component, Fragment } from 'react';
	
import './gallery.css';

class Photo extends Component {
  constructor(props) {
    super(props);
    this.state = {
      photo: {}
    }
  }

  componentDidMount() {
    fetch(`http://localhost:10003/wp-json/wp/v2/media/${this.props.id}`)
      .then((response) => response.json())
      .then(singlePhoto => {
        this.setState({ photo: singlePhoto });
      });
  }

  render() {
    return <img src={this.state.photo.source_url} alt={this.props.alt} />;
  }
}
	
class MyGallery extends Component {
	
  static slug = 'my_gallery';

  state = {
    photos: []
  }

  componentDidMount() {
    fetch('http://localhost:10003/wp-json/wp/v2/gallery')
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
			  <div className="my-gallery">
				  {this.state.photos.map((photo) => (
					  <div key={photo.id}>
					  <Photo id={photo.featured_media} alt={photo.title.rendered} />
					  <p>{photo.title.rendered}</p>
					  </div>
				  ))}
			  </div>
		  </Fragment>
    );
  }
}
          	
export default MyGallery;