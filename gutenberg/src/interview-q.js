import { registerBlockType } from '@wordpress/blocks';
import { RichText } from '@wordpress/editor';
import { createBlock } from '@wordpress/blocks';

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
    transforms: {
        from: [
            {
                type: 'block',
                blocks: [ 'core/paragraph' ],
                transform: ( { content } ) => {
                    return createBlock( 'kikoiro1/interview-q', {
                        content,
                    } );
                },
            },
        ],
        to: [
            {
                type: 'block',
                blocks: [ 'core/paragraph' ],
                transform: ( { content } ) => createBlock('core/paragraph', { content } ),
            }
        ],
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
