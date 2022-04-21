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
				  {this.state.combos.map((combo) => (
            <div>
              <a href="google.html">
                <Image id={combo.featured_media} alt={combo.title.rendered} />
              </a>
              <div>
                <h3>{combo.title.rendered}</h3>
                <div>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, iusto sunt! Modi, saepe, dolorem magni earum officia doloremque harum vitae nesciunt architecto soluta corrupti quo?
                </div>
              </div>
            </div>
				  ))}
			  </section>
		  </Fragment>
    );
  }
}
          	
export default ComboBox;