import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { getClassNameFromProperty } from './tools.js';

registerBlockType( 'kikoiro1/nextpage', {
    title: '改ページ',
    icon: 'editor-break',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'strong',
            type: 'string',
            source: 'html',
            default: ''
        },
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <p class={"nextpage" + getClassNameFromProperty(props.attributes, "className")}>
                <RichText 
                    tagName="strong"
                    value={ content } 
                    onChange={ onChangeContent } />
                <span dangerouslySetInnerHTML={{__html: '<!--nextpage-->'}} />
            </p>
        );
    },
    save(props) {
        return (
            <p class={"nextpage" + getClassNameFromProperty(props.attributes, "className")}>
                <RichText.Content
                    tagName="strong"
                    value={ props.attributes.content } />
                <span dangerouslySetInnerHTML={{__html: '<!--nextpage-->'}} />
            </p>
        );
    },
});
