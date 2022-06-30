import React, { Component, Fragment } from 'react';

import './featured.css';
	
class Featured extends Component {
	
  static slug = 'realify_featured_module';

  state = {
    combos: []
  }
  	
  render() {
    return (
		<Fragment>
			<ul>
				<li>Jesus is coming soon...</li>
			</ul>
		</Fragment>
    );
  }
}
          	
export default Featured;