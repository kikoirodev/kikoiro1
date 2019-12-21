import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/editor'; // or wp.editor

const blockStyle = {
    backgroundColor: '#0000ff',
    color: '#fff',
    padding: '20px',
};

registerBlockType( 'kikoiro1/sub-info', {
    title: '補足情報',
    icon: 'universal-access-alt',
    category: 'common',
    example: {},
    edit( { className } ) {
        return (
            <div class="test2">
                <InnerBlocks allowedBlocks={ [ 'core/image', 'core/paragraph' ] }
                            template={[
                                [ 'core/paragraph', { placeholder: 'Enter side content...' } ], 
                                [ 'core/paragraph', { placeholder: 'Second Content' } ] 
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
