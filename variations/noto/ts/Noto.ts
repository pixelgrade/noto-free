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

    public updateCardsPosition($container: JQuery = this.$body) {
        const $noto = $container.find( '.c-noto--body' );
        const $posts = $noto.children( '.post' );
        const $widgets = $noto.children( '.widget--misto' );

        const step = $posts.length / $widgets.length;

        $widgets.each( ( i, obj ) => {
            const $widget = $( obj );
            $widget.insertAfter( $posts.eq( i * step ) );
        } );
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
        const $intro = $container.find('.intro, .post-it' );
        const $waveTemplate = $( '.js-wave-intro-template' );

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
        const $waveTemplate = $('.js-wave-quote-template');

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

    public handleContent($container: JQuery = this.$body) {

        Helper.unwrapImages($container.find('.entry-content'));
        Helper.wrapEmbeds($container.find('.entry-content'));
        Helper.handleVideos($container);
        Helper.handleCustomCSS($container);

        this.appendSvgToIntro($container);
        this.appendSvgToBlockquote($container);
        this.eventHandlers($container);
        this.updateCardsPosition($container);

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
