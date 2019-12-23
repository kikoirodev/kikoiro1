import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/editor';

registerBlockType( 'kikoiro1/sub-info', {
    title: '補足情報',
    icon: 'editor-ul',
    category: 'kikoiro1',
    example: {},
    edit( { className } ) {
        return (
            <div class="test2">
                <InnerBlocks allowedBlocks={ [ 'core/image', 'core/paragraph' ] }
                            template={[
                                [ 'core/paragraph', { placeholder: 'title' } ], 
                                [ 'core/paragraph', { placeholder: 'content' } ] 
                            ]}
                />
            </div>
        );
    },
    save() {
        return (
            <div>
                <InnerBlocks.Content />
            </div>
        );
    },
} );
