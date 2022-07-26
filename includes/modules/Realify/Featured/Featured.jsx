import React, { Component, Fragment } from 'react';

import './featured.css';
	
class Featured extends Component {
	
  static slug = 'realify_featured_module';

  state = {
    properties: []
  }

  componentDidMount() {
    fetch(`http://realestateproperty.local/wp-json/wp/v2/${this.props.post_type}`)
    .then((response) => response.json())
    .then(allProperties => {
        this.setState({ properties: allProperties });
    })
    .catch(error => console.log('Error:', error));
  }
  	
  render() {
    return (
		<Fragment>
			<ul className="realify_featured">
          {this.state.properties.map((property) => (
            <li>
              <Property link={property.link} title={property.title.rendered} id={property.featured_media} />
            </li>
          ))}
			</ul>
		</Fragment>
    );
  }
}

class Property extends Component {
  constructor(props) {
    super(props);
    this.state = {
      image: {}
    }
  }

  componentDidMount() {
    fetch(`http://realestateproperty.local/wp-json/wp/v2/media/${this.props.id}`)
      .then((response) => response.json())
      .then(singleImage => {
        this.setState({ image: singleImage });
      });
  }

  render() {
    return (
      <a href={this.props.link}>
        <div className="realify_featured__img" style={{ backgroundImage: `url(${this.state.image.source_url})` }}>
        </div>
        <div className="realify_featured__title">
          <h2>{this.props.title}</h2>
          <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
              <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
              <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            </svg>
            <span>Lekki, Lagos</span>
          </p>
        </div>
      </a>
    );
  }
}
          	
export default Featured;