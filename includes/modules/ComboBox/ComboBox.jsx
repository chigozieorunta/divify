import React, { Component, Fragment } from 'react';
	
import './combobox.css';
	
class ComboBox extends Component {
	
  static slug = 'combo_box';

  state = {
    combos: []
  }

  componentDidMount() {
    fetch('http://yoursite.com/wp-json/wp/v2/gallery')
    .then((response) => response.json())
    .then(allCombos => {
        this.setState({ combos: allCombos });
    })
    .catch(error => console.log('Error:', error));
  }
  	
  render() {
    return (
		<Fragment>
			<h1 className="combo-box-heading">{this.props.heading}</h1>
			  <div className="combo-box-content">{this.props.content()}</div>
			  <div className="combo-box">
				  {this.state.combos.map((combo) => (
					  <div>
					  <img src={combo.id} alt={combo.id} />
					  <p>{combo.title.rendered}</p>
					  </div>
				  ))}
			  </div>
		  </Fragment>
    );
  }
}
          	
export default ComboBox;