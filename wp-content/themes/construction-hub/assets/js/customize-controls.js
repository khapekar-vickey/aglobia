( function( api ) {

	// Extends our custom "construction-hub" section.
	api.sectionConstructor['construction-hub'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );