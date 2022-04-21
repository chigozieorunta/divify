import React, { Component, Fragment } from 'react';
	
import './combobox.css';
	
class ComboBox extends Component {
	
  static slug = 'combo_box';

  state = {
    combos: []
  }

  componentDidMount() {
    fetch(`http://divify.local/wp-json/wp/v2/${this.props.post_type}`)
    .then((response) => response.json())
    .then(allCombos => {
        this.setState({ combos: allCombos });
    })
    .catch(error => console.log('Error:', error));
  }
  	
  render() {
    return (
		  <Fragment>
			  <section class="combo-box">
          {this.state.combos.map((combo) => {
            const Content = combo.content.rendered;
            return (
              <div>
                <a href={combo.link}>
                  <Image id={combo.featured_media} alt={combo.title.rendered} />
                </a>
                <div>
                  <h3>
                    <a href={combo.link}>{combo.title.rendered}</a>
                  </h3>
                  <div>
                    <Content />
                  </div>
                </div>
              </div>
            );
          })}
			  </section>
		  </Fragment>
    );
  }
}

class Image extends Component {
  constructor(props) {
    super(props);
    this.state = {
      image: {}
    }
  }

  componentDidMount() {
    fetch(`http://divify.local/wp-json/wp/v2/media/${this.props.id}`)
      .then((response) => response.json())
      .then(singleImage => {
        this.setState({ image: singleImage });
      });
  }

  render() {
    return <img src={this.state.image.source_url} alt={this.props.alt} />;
  }
}
          	
export default ComboBox;