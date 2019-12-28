import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { createBlock } from '@wordpress/blocks';
import { PlainText } from '@wordpress/block-editor';
import { RawHTML } from '@wordpress/element';

registerBlockType( 'kikoiro1/embed', {
    title: '埋め込み',
    icon: 'editor-paragraph',
    category: 'kikoiro1',
    attributes: {
        content: {
            type: 'string',
            source: 'html',
        },
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <p>
                <PlainText   
                    value={ content } 
                    onChange={ onChangeContent } />
                <RawHTML>{ props.attributes.content }</RawHTML>
            </p>
        );
    },
    save(props) {
        return (
            <p>
            <RawHTML>{ props.attributes.content }</RawHTML></p>
        );
    },
});
