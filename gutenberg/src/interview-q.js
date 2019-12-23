import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';

registerBlockType( 'kikoiro1/interview-q', {
    title: 'インタビュー設問',
    icon: 'microphone',
    category: 'kikoiro1',
    attributes: {
        content: {
            selector: 'p',
            type: 'string',
            source: 'html',
            default: '設問'
        },
    },
    edit(props) {
        let content = props.attributes.content;
        let onChangeContent = function( content ) {
            props.setAttributes( { content: content } );
        }
        return (
            <RichText 
                tagName="p"
                className="interview_q"
                value={ content } 
                onChange={ onChangeContent } />
        );
    },
    save(props) {
        return (
            <RichText.Content
                tagName="p"
                className="interview_q"
                value={ props.attributes.content } />
        );
    },
});
