import $ from 'jquery';
import { BaseTheme, JQueryExtended } from '../../../components/base/ts/BaseTheme';
import { Helper } from '../../../components/base/ts/services/Helper';
import { SearchOverlay } from '../../../components/base/ts/components/SearchOverlay';
import { ProgressBar } from '../../../components/base/ts/components/ProgressBar';
import { NotoHeader } from './Header';

const cq = require('cq-prolyfill')({ /* configuration */ });

export class Noto extends BaseTheme {
    public ProgressBar: ProgressBar;
    public SearchOverlay: SearchOverlay;
    public Header: NotoHeader;
    public mouseX = 0;
    public mouseY = 0;

    constructor() {
        super();

        this.handleContent();

        function loop() {
            requestAnimationFrame(loop);
        }

        requestAnimationFrame(loop);

        this.initProgressBar();
        this.initMobileNavigation();
    }

    public initMobileNavigation() {
        const $nav = $( '<div class="c-navbar__content">' );
        const $shadow = $( '<div class="c-navbar__shadow">' );

        $( '.c-navbar__zone--left, .c-navbar__zone--right' ).clone().appendTo( $nav );
        $nav.appendTo( '.c-noto' );
        $shadow.appendTo( '.c-noto' );
    }

    public initProgressBar() {
        const content = $( '.content-area' );

        if ( content.length ) {
            const contentAreaHeight = content.outerHeight();
            const offsetTop = content.offset().top;

            this.ProgressBar = new ProgressBar({
                canShow: true,
                max: contentAreaHeight - offsetTop,
                offset: offsetTop
            });
        }
    }

    public insertWidgetsBetweenPosts($container: JQuery = this.$body) {
        const $noto = $container.find( '.c-noto--body' );
        const $posts = $noto.children( '.c-noto__item--post' );
        const $widgets = $noto.children( '.c-noto__item--widget' );

        let w = 0;

        for ( let p = 0; p < $posts.length; p++ ) {

            if ( ! $widgets.length ) {
                break;
            }

            if ( ( p % 12 === 8 ) || ( p % 12 === 4 ) ) {
                const $widget = ( $widgets as JQueryExtended ).splice(0, 1);
                const $post = $posts.slice(p - w - 1, p - w);

                $post.before( $widget );
                w++;
            }
        }
    }

    public adjustPostsMargins($container: JQuery = this.$body) {
        const $noto = $container.find( '.c-noto--body' );
        const $posts = $noto.children( '.c-noto__item' ).not( '.c-noto__item--post-it' );

        for ( let p = 0; p < $posts.length; p++ ) {
            const $post = $posts.slice(p - 1, p);
            let $target;

            if ( p % 12 === 8 || p % 12 === 9 ) {
                $target = $( $posts.get( p - 4 ) );
                if ( $target.is( '.c-noto__item--post' ) ) {
                    const targetOffset = $target.find( '.c-card__excerpt' ).offset().top;
                    const currentOffset = $post.offset().top;
                    const oldMarginTop = parseInt( $post.css( 'marginTop' ), 10 );
                    const newMarginTop = targetOffset - currentOffset + oldMarginTop;
                    $post.css('marginTop', newMarginTop );
                }
            }

            if ( p > 1 && p % 12 === 1 ) {
                $target = $( $posts.get( p - 3 ) );
                if ( $target.is( '.c-noto__item--post' ) ) {
                    const targetOffset = $target.find( '.c-card__excerpt' ).offset().top;
                    const currentOffset = $post.offset().top;
                    const oldMarginTop = parseInt( $post.css( 'marginTop' ), 10 );
                    const newMarginTop = targetOffset - currentOffset + oldMarginTop;
                    $post.css('marginTop', newMarginTop );
                }
            }

            if ( p > 4 && p % 12 === 4 ) {
                $target = $( $posts.get( p - 5 ) );
                if ( $target.is( '.c-noto__item--post' ) ) {
                    const targetOffset = $target.find( '.c-card__excerpt' ).offset().top;
                    const currentOffset = $post.offset().top;
                    const oldMarginTop = parseInt( $post.css( 'marginTop' ), 10 );
                    const newMarginTop = targetOffset - currentOffset + oldMarginTop;
                    $post.css('marginTop', newMarginTop );
                }
            }
        }
    }

    public bindEvents() {
        super.bindEvents();

        const that = this;

        $( 'body' ).on('mousemove', (e) => {
            that.mouseX = e.pageX;
            that.mouseY = e.pageY;
        });
    }

    public onLoadAction() {
        super.onLoadAction();

        this.SearchOverlay = new SearchOverlay();
        this.Header = new NotoHeader();

        this.adjustLayout();
    }

    public onResizeAction() {
        super.onResizeAction();
        this.adjustLayout();
    }

    public onJetpackPostLoad() {
        const $container = ( $( '#posts-container' ) as JQueryExtended );

        this.handleContent($container);
        this.adjustLayout();
    }

    public appendSvgToIntro($container: JQuery = this.$body) {
        const $intro = $container.find( '.intro, .post-it, hr.decoration' );
        const $waveTemplate = $( '.js-pattern-template' );

        $intro.each(( i, obj ) => {
            const $obj = $(obj);
            const $wave = $waveTemplate.clone();
            const $pattern = $wave.find( 'pattern' );
            const patternID = $pattern.attr('id');

            $pattern.attr( 'id', patternID + i );
            $wave.find( 'rect' ).css( 'fill', 'url(#wavePattern-intro' + i + ')');

            if ( $obj.is( '.intro' ) ) {
                $wave.prependTo( $obj ).show();
            } else {
                $wave.appendTo( $obj ).show();
            }
        });
    }

    public appendSvgToBlockquote($container: JQuery = this.$body) {
        const $blockquote = $container.find('.content-area blockquote');
        const $waveTemplate = $('.js-pattern-template');

        $blockquote.each((i, obj) => {
            const $obj = $(obj);
            const $wave = $waveTemplate.clone();
            const $pattern = $wave.find( 'pattern' );
            const patternID = $pattern.attr('id');

            $pattern.attr( 'id', patternID + i );
            $wave.find( 'rect' ).css( 'fill', 'url(#wavePattern-quote' + i + ')');
            $wave.prependTo($obj).show();
        });
    }

    public autoStyleIntro() {
        const $body = $( 'body' );
        const $content = $( '.content-area' );

        if ( ! $body.is( '.u-intro-autostyle' ) ) {
            return;
        }

        const $firstElement = $content.children().not( 'div' ).first();

        if ( ( $firstElement ).is( 'p' ) ) {
            $firstElement.addClass( 'intro' );
        }
    }

    public handleContent($container: JQuery = this.$body) {

        Helper.unwrapImages($container.find('.entry-content'));
        Helper.wrapEmbeds($container.find('.entry-content'));
        Helper.handleVideos($container);
        Helper.handleCustomCSS($container);

        this.autoStyleIntro();

        this.appendSvgToIntro($container);
        this.appendSvgToBlockquote($container);
        this.eventHandlers($container);

        this.insertWidgetsBetweenPosts($container);
        this.adjustPostsMargins($container);

        $container.find('.sharedaddy').each((i, obj) => {
            const $sharedaddy = $(obj);

            if ($sharedaddy.find('.sd-social-official').length) {
                $sharedaddy.addClass('sharedaddy--official');
            }
        });
    }

    private adjustLayout() {
        cq.reevaluate(false, () => {
            // Do something after all elements were updated
        });
    }

}
