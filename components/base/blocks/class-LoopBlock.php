<?php
/**
 * Loop Block class, a minor extension of the Layout block.
 * It simply displays the child blocks in a WP loop.
 *
 * @see 	    https://pixelgrade.com
 * @author 		Pixelgrade
 * @package 	Components/Base
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pixelgrade_LoopBlock class.
 */
class Pixelgrade_LoopBlock extends Pixelgrade_LayoutBlock {

	/**
	 * Block's Type ID.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'loop';

	/**
	 * Constructor.
	 *
	 * Supplied `$args` override class property defaults.
	 *
	 * @param Pixelgrade_BlocksManager $manager Pixelgrade_BlocksManager instance.
	 * @param string               $id      Block ID.
	 * @param array                $args    {
	 *     Optional. Arguments to override class property defaults.
	 *
	 *     @type int                  $instance_number Order in which this instance was created in relation
	 *                                                 to other instances.
	 *     @type string               $id              Block ID.
	 *     @type int                  $priority        Order priority to load the block. Default 10.
	 *     @type string|array         $wrappers        The block's wrappers. It can be a string or an array of Pixelgrade_BlockWrapper instances.
	 *     @type string               $end_wrappers    The block's end wrappers if $wrappers was string.
	 *     @type array                $checks          The checks config to determine at render time if this block should be rendered.
	 *     @type string               $type            Block type. Core blocks include 'layout', 'template', 'callback'.
	 *                                                 Default 'layout'.
	 *     @type array                $blocks          Child blocks definition.
	 * }
	 * @param Pixelgrade_Block $parent Optional. The block instance that contains the definition of this block (that first instantiated this block).
	 */
	public function __construct( $manager, $id, $args = array(), $parent = null ) {
		parent::__construct( $manager, $id, $args, $parent );
	}

	/**
	 * Render the loop with each child blocks group.
	 *
	 * Allows the content to be overridden without having to rewrite the wrapper in `$this::render()`.
	 *
	 * Block content can alternately be rendered in JS. See Pixelgrade_Block::printTemplate().
	 *
	 * @param array $blocks_trail The current trail of parent blocks (aka the anti-looping machine).
	 */
	protected function renderContent( $blocks_trail = array() ) {
		// Initialize blocks trail if empty
		if ( empty( $blocks_trail ) ) {
			$blocks_trail = array( $this );
		}

		/**
		 * Fires before a loop block's content is rendered.
		 *
		 * @param Pixelgrade_Block $this Pixelgrade_Block instance.
		 * @param array $blocks_trail The current trail of parent blocks.
		 */
		do_action( 'pixelgrade_before_render_loop_block_content', $this, $blocks_trail );

		/**
		 * Fires before a specific loop block's content is rendered.
		 *
		 * The dynamic portion of the hook name, `$this->id`, refers to
		 * the block ID.
		 *
		 * @param Pixelgrade_Block $this Pixelgrade_Block instance.
		 * @param array $blocks_trail The current trail of parent blocks.
		 */
		do_action( "pixelgrade_before_render_loop_block_{$this->id}_content", $this, $blocks_trail );

		/* =====================
		 * Do the WordPress loop
		 */
		while ( have_posts() ) : the_post();

			/* =======================
			 * Render the child blocks
			 */
			parent::renderContent( $blocks_trail );

		endwhile; // End of the loop.

		/**
		 * Fires after a loop block's content has been rendered.
		 *
		 * @param Pixelgrade_Block $this Pixelgrade_Block instance.
		 * @param array $blocks_trail The current trail of parent blocks.
		 */
		do_action( 'pixelgrade_after_render_loop_block_content', $this, $blocks_trail );

		/**
		 * Fires after a specific loop block's content has been rendered.
		 *
		 * The dynamic portion of the hook name, `$this->id`, refers to
		 * the block ID.
		 *
		 * @param Pixelgrade_Block $this Pixelgrade_Block instance.
		 * @param array $blocks_trail The current trail of parent blocks.
		 */
		do_action( "pixelgrade_after_render_loop_block_{$this->id}_content", $this, $blocks_trail );
	}
}