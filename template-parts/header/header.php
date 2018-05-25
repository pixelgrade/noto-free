<?php
/**
 * The template part for header
 *
 * This template part can be overridden by copying it to a child theme or in the same theme
 * by putting it in template-parts/header/header.php.
 *
 * HOWEVER, on occasion Pixelgrade will need to update template files and you
 * will need to copy the new files to your child theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://pixelgrade.com
 * @author     Pixelgrade
 * @package    Components/Header
 * @version    1.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php pixelgrade_get_component_template_part( Pixelgrade_Header::COMPONENT_SLUG, 'content-navbar' ); ?>

<?php if( is_single() && ! is_attachment() ) { ?>	

<div class="c-reading-progress">
	<progress value="0" min="0" max="100" class="js-reading-progress"></progress>
	<div class="c-reading-progress__label">
		<span> 
			<!-- <?php $content = get_the_content('');
			print strlen($content); ?>	 -->
			10
		</span>
		<p>mins <br> read</p>
	</div>
</div>
	
<?php } ?>