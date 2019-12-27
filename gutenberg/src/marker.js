
import { compose, ifCondition } from '@wordpress/compose';
import { RichTextToolbarButton } from '@wordpress/block-editor';
import { withSelect } from '@wordpress/data';
import { registerFormatType, toggleFormat } from '@wordpress/rich-text';

const markerButton = props => {
	return <RichTextToolbarButton
		icon='admin-appearance'
		title='マーカー'
		onClick={ () => {
			props.onChange( toggleFormat(
				props.value,
				{ type: 'my-custom-format/sample-output' }
			) );
		} }
		isActive={ props.isActive }
	/>
};

const ConditionalButton = compose(
	withSelect( function( select ) {
		return {
			selectedBlock: select( 'core/editor' ).getSelectedBlock()
		}
	} ),
	ifCondition( function( props ) {
		return (
			props.selectedBlock &&
            props.selectedBlock.name !== 'core/heading' 
		);
	} )
)( markerButton );

registerFormatType(
	'kikoiro1/marker', {
		title: 'マーカー',
        tagName: 'span',
        className: 'emphasize',
		edit: ConditionalButton,
	}
);