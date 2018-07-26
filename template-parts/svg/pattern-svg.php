<?php
$color = pixelgrade_option( 'main_content_body_text_color', '#49494B' );
$pattern = pixelgrade_option( 'noto_decoration_pattern', 'triangle' );

if ( is_single() ) {
    $color = pixelgrade_option( 'secondary_color', '#E79696' );
}
?>
<svg width="25px" height="8px" viewBox="0 0 25 8" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

    <?php if ( 'triangle' === $pattern ) { ?>
        <g id="triangle" stroke="none" stroke-width="1" fill="<?php echo $color; ?>" fill-rule="evenodd">
            <polygon points="0 0 4.5 8 9 0"></polygon>
        </g>
    <?php } ?>

    <?php if ( 'wave' === $pattern ) { ?>
        <g id="wave" transform="translate(-12, 1)" stroke="<?php echo $color; ?>" stroke-width="2">
            <path d="M8,3 C8.66808837,5 10.0010521,6 11.9988911,6 C13.9967301,6 15.3304331,5 16,3"></path>
            <path d="M16,0 C16.6680884,2 18.0010521,3 19.9988911,3 C21.9967301,3 23.3304331,2 24,0" transform="translate(20, 1.5) rotate(-180) translate(-20, -1.5) "></path>
            <path d="M24,3 C24.6680884,5 26.0010521,6 27.9988911,6 C29.9967301,6 31.3304331,5 32,3"></path>
            <path d="M0,0 C0.668088373,2 2.00105206,3 3.99889107,3 C5.99673007,3 7.33043305,2 8,0" transform="translate(4, 1.5) rotate(-180) translate(-4, -1.5) "></path>
        </g>
    <?php } ?>

</svg>