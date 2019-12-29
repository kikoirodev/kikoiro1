import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/annotation', {
    title: '注釈',
    icon: 'editor-ul',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'ul',
            type: 'array',
            source: 'children'
        },
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <div class={ "annotation" + getClassNameFromProperty(props.attributes, "className") }>
            <hr class={ "contentSeparator fullWidth" } />
            <RichText
                tagName="ul"
                multiline="li"
                value={ content }
                onChange={ onChangeContent } />
            </div>
        );
    },
    save(props) {
        return (
            <div class={ "annotation" + getClassNameFromProperty(props.attributes, "className") }>
            <hr class={ "contentSeparator fullWidth" } />
            <RichText.Content
                tagName="ul"
                value={ props.attributes.content } />
            </div>
        );
    },
});
