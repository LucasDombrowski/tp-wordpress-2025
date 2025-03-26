import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
} from '@wordpress/block-editor';
import {
	PanelBody,
	RangeControl,
	SelectControl
} from '@wordpress/components';
import { useState, useEffect } from '@wordpress/element';
import "./editor.scss";

export default function Edit({ attributes, setAttributes }) {
	const { numberOfRooms, orderBy, taxonomy } = attributes;
	const [taxonomies, setTaxonomies] = useState([]);

	// Fetch taxonomies associated with the 'guest-room' post type
	useEffect(() => {
		// Fetch taxonomies using the REST API
		wp.apiFetch({ path: '/wp/v2/taxonomies' }).then((taxonomies) => {
			// Filter only taxonomies associated with 'guest-room'
			const associatedTaxonomies = Object.keys(taxonomies)
				.filter((key) => taxonomies[key].types.includes(guestRoomData.postTypeSlug))
				.map((key) => ({
					label: __(taxonomies[key].name),
					value: key,
				}));

			setTaxonomies(associatedTaxonomies);
		});
	}, []);

	// Block props for styling
	const blockProps = useBlockProps();

	// Generate skeleton grid elements based on the number of rooms
	const skeletonGrid = [];
	for (let i = 0; i < numberOfRooms; i++) {
		skeletonGrid.push(
			<div key={i} className="skeleton-item">
				<div className="skeleton-title" />
				<div className="skeleton-description" />
			</div>
		);
	}

	return (
		<div {...blockProps}>
			<InspectorControls>
				<PanelBody title={__('Settings', 'related-guest-rooms')} initialOpen={true}>
					<RangeControl
						label={__('Number of guest rooms', 'related-guest-rooms')}
						value={numberOfRooms}
						onChange={(value) => setAttributes({ numberOfRooms: value })}
						min={1}
						max={10}
					/>
					<SelectControl
						label={__('Order by', 'related-guest-rooms')}
						value={orderBy}
						options={[
							{ label: __('Date', 'related-guest-rooms'), value: 'date' },
							{ label: __('Title', 'related-guest-rooms'), value: 'title' },
							{ label: __('Random', 'related-guest-rooms'), value: 'rand' },
						]}
						onChange={(value) => setAttributes({ orderBy: value })}
					/>
					<SelectControl
						label={__('Select Taxonomy', 'related-guest-rooms')}
						value={taxonomy}
						options={[
							{ label: __('Select a Taxonomy', 'related-guest-rooms'), value: '' },
							{ label: __('None', 'related-guest-rooms'), value: 'none' },
							...taxonomies, // Populate options dynamically
						]}
						onChange={(value) => setAttributes({ taxonomy: value })}
					/>
				</PanelBody>
			</InspectorControls>
			<div className="skeleton-grid">
				{skeletonGrid}
			</div>
		</div>
	);
}
