import $ from 'jquery';

import { BaseTheme, JQueryExtended } from '../../../components/base/ts/BaseTheme';

import { Helper } from '../../../components/base/ts/services/Helper';

import { SearchOverlay } from '../../../components/base/ts/components/SearchOverlay';
import { ProgressBar } from '../../../components/base/ts/components/ProgressBar';

import { NotoHeader } from './Header';

export class Noto extends BaseTheme {
    public ProgressBar: ProgressBar;
    public SearchOverlay: SearchOverlay;
    public Header: NotoHeader;
    public mouseX = 0;
    public mouseY = 0;

    public focusedCard = null;
    public newFocusedCard = false;

    constructor() {
        super();

        const that = this;

        this.handleContent();

        function loop() {
            that.updateFocusedCard();
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
        const $widgets = $noto.children( '.c-noto__item--widget' ).not( '.c-noto__item--post-it' );

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

        // revome previously set margins
        $posts.css('marginTop', '' );

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
        const $body = $( 'body' );

        let leaveFocusState;

        $body.on('mousemove', (e) => {
            that.mouseX = e.pageX;
            that.mouseY = e.pageY;
        });

        $body.on('mouseenter', '.c-noto__item--image', function() {
            clearTimeout( leaveFocusState );
            if ( this !== that.focusedCard ) {
                that.focusedCard = this;
                that.newFocusedCard = true;
            }
        });

        $body.on('mouseleave', '.c-noto__item', () => {
            leaveFocusState = setTimeout(() => {
                that.focusedCard = null;
                that.newFocusedCard = true;
            }, 100);
        });
    }

    public updateFocusedCard() {
        if ( this.newFocusedCard ) {
            $( '.c-noto__item, .c-navbar__zone--middle' ).removeClass( 'has-focus has-no-focus' );

            if ( this.focusedCard ) {
                $( '.c-noto__item' ).not( this.focusedCard ).addClass( 'has-no-focus' );
                $( '.c-navbar__zone--middle' ).addClass( 'has-no-focus' );
                $( this.focusedCard ).addClass( 'has-focus' );
            }

            this.newFocusedCard = false;
        }
    }

    public onLoadAction() {
        super.onLoadAction();

        this.SearchOverlay = new SearchOverlay();
        this.Header = new NotoHeader();

        $( '.c-noto__item--post-it' ).addClass( 'is-visible' );
        $( '.c-noto__item' ).not( '.c-noto__item--post-it' ).each((i, obj) => {
            const $card = $( obj );

            setTimeout(() => {
                $card.addClass('is-visible' );
            }, (i + 1) * 100);
        });

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

    public getDecoration(accent: boolean = false) {
        const className = accent ? 'js-pattern-accent-template' : 'js-pattern-template';
        const selector = '.' + className;
        return $( selector ).clone().removeClass( className );
    }

    public addDecorations($container: JQuery = this.$body) {
        this.appendSvgToIntro( $container );
        this.appendSvgToPostIt( $container );
        this.appendSvgToSeparator( $container );
        this.appendSvgToBlockquote( $container );
    }

    public appendSvgToIntro($container: JQuery = this.$body) {
        $container.find( '.intro' ).each(( i, obj ) => {
            this.getDecoration( true ).prependTo( obj ).show();
        });
    }

    public appendSvgToPostIt($container: JQuery = this.$body) {
        $container.find( '.post-it' ).each(( i, obj ) => {
            this.getDecoration().appendTo( obj ).show();
        });
    }

    public appendSvgToSeparator($container: JQuery = this.$body) {
        $container.find( 'hr.decoration' ).each(( i, obj ) => {
            const $target = $( obj );
            const $decoration = this.getDecoration();
            $target.attr( 'style', $decoration.attr( 'style' ) );
            $target.attr( 'class', $decoration.attr( 'class' ) );
            $decoration.remove();
        });
    }

    public appendSvgToBlockquote($container: JQuery = this.$body) {
        $container.find('.content-area blockquote').each((i, obj) => {
            this.getDecoration().prependTo(obj).show();
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

    public unwrapImages( $container: JQuery = Helper.$body ): void {

        Helper.unwrapImages( $container );

        const $paragraphs = $container.find( 'p' );
        const $imagesBlock = $container.find('.wp-block-image');

        $paragraphs.each(( i, p ) => {
            const $p = $(p);
            const $image = $p.children( 'img' );

            if ( $image.length === 1 ) {
                const className = $image.attr( 'class' );
                const $figure = $( '<figure />' ).attr( 'class', className );

                $figure.append( $image.removeAttr( 'class' ) ).insertAfter( $p );
            }
        });

        $imagesBlock.each(( i, block ) => {
            const $block = $(block);
            const $figure = $block.children('figure');

            $figure.unwrap();
        });

    }

    public handleContent($container: JQuery = this.$body) {
        this.unwrapImages($container.find('.entry-content'));
        Helper.wrapEmbeds($container.find('.entry-content'));
        Helper.handleVideos($container);
        Helper.handleCustomCSS($container);

        this.autoStyleIntro();

        this.addDecorations($container);
        this.eventHandlers($container);

        this.insertWidgetsBetweenPosts($container);

        $container.find('.sharedaddy').each((i, obj) => {
            const $sharedaddy = $(obj);

            if ($sharedaddy.find('.sd-social-official').length) {
                $sharedaddy.addClass('sharedaddy--official');
            }
        });
    }

    private adjustLayout() {
        this.adjustPostsMargins();
    }

}
