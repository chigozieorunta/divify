import React, { Component, Fragment } from 'react';

import './search.css';
	
class Search extends Component {
	
  static slug = 'realify_search_module';

  state = {
    combos: []
  }
  	
  render() {
    return (
		  <Fragment>
        <ul className="realify_search">
          <li>
            <select>
							<option>Property</option>
							<option>1 Room Apartment</option>
							<option>2 Room Apartment</option>
							<option>3 Room Apartment</option>
							<option>4 Room Apartment</option>
							<option>5 Room Apartment</option>
							<option>6 Room Apartment</option>
            </select>
          </li>
          <li>
            <select>
							<option>Location</option>
							<option>Lagos</option>
							<option>Abuja</option>
							<option>Port Harcourt</option>
							<option>Kano</option>
            </select>
          </li>
          <li>
            <select>
							<option>Budget (N)</option>
							<option>10 million</option>
							<option>25 million</option>
							<option>50 million</option>
							<option>75 million</option>
							<option>100 million</option>
            </select>
          </li>
          <li>
						<button type="submit">Search</button>
          </li>
			  </ul>
		  </Fragment>
    );
  }
}
          	
export default Search;