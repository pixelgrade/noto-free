import $ from 'jquery';
import * as imagesLoaded from 'imagesloaded';
import 'jquery-hoverintent';
import { BaseComponent } from '../../../components/base/ts/models/DefaultComponent';
import { Helper } from '../../../components/base/ts/services/Helper';
import { WindowService } from '../../../components/base/ts/services/window.service';
import { TweenLite, TimelineMax } from 'gsap';

interface JQueryExtended extends JQuery {
    hoverIntent?( params: any ): void;
    imagesLoaded?( params: any );
}

export class NotoHeader extends BaseComponent {

    private $body: JQuery = $( 'body' );
    private $document: JQuery = $( document );

    // private documentHeight = $( document ).height();
    private windowHeight = $( window ).height();
    private adminBarHeight = $( '#wpadminbar' ).outerHeight() || 0;

    private footerPinned = false;
    private headerPinned = true;

    private $headerGrid: JQuery = $( '.c-noto--header' );
    private headerHeight = this.$headerGrid.outerHeight();

    private $bodyGrid: JQuery = $( '.c-noto--body' );

    private $footer: JQuery = $( '.site-footer' );
    private footerOffset = this.$footer.offset();
    private footerHeight = this.$footer.outerHeight();

    private $mainMenu: JQueryExtended = $( '.c-navbar__zone--left .menu' );
    private $mainMenuItems: JQueryExtended = this.$mainMenu.find( 'li' );
    private $menuToggle: JQuery = $( '#menu-toggle' );
    private isMobileHeaderInitialised: boolean = false;
    private isDesktopHeaderInitialised: boolean = false;
    private areMobileBindingsDone: boolean = false;
    private subscriptionActive: boolean = true;
    private preventOneSelector: string = 'a.prevent-one';

    constructor() {
        super();
        console.log( this.$mainMenu );

        $( '.c-navbar__zone' ).each( (i, obj) => {
            const $obj = $(obj);

            if ( $obj.find( '.c-branding' ).length ) {
                $obj.addClass( 'c-navbar__zone--branding' );
            }

            if ( $obj.find( '.jetpack-social-navigation' ).length ) {
                $obj.addClass( 'c-navbar__zone--social' );
            }
        });

        imagesLoaded( $( '.c-navbar .c-logo' ), () => {

            this.bindEvents();
            this.eventHandlers();
            this.updateOnResize();
            this.toggleNavStateClass();

        });
    }

    public destroy() {
        this.subscriptionActive = false;
    }

    public bindEvents() {

        this.$menuToggle.on( 'change', this.onMenuToggleChange.bind(this));

        this.$mainMenuItems.filter( '.menu-item-has-children' ).on( 'mouseenter', () => {
            $( '.c-navbar__zone--right' ).addClass( 'is-hidden' );
        } );

        this.$mainMenuItems.filter( '.menu-item-has-children' ).on( 'mouseleave', () => {
            $( '.c-navbar__zone--right' ).removeClass( 'is-hidden' );
        } );

        this.$mainMenuItems.hoverIntent( {
            out: (e) => this.toggleSubMenu(e, false),
            over: (e) => this.toggleSubMenu(e, true),
            timeout: 200
        } );

        const $accentLayer = $( '.c-footer-layers__accent' );
        const $darkLayer = $( '.c-footer-layers__dark' );
        const timeline = new TimelineMax( { paused: true } );

        timeline.to( $accentLayer, 1, { rotation: 0, y: this.headerHeight * 0.64, x: -10 }, 0 );
        timeline.to( $darkLayer, 1, { rotation: 0 }, 0 );
        timeline.to( $( '.c-navbar__zone--right' ), .5, { opacity: 0 }, 0 );
        timeline.to( $( '.c-navbar__zone--left' ), 0, { opacity: 0 }, 1 );
        timeline.to( $darkLayer, 1, { rotation: 1 }, 1 );
        timeline.to( $accentLayer, 1, { rotation: 1, y: 0, x: 0 }, 1 );

        WindowService
            .onScroll()
            .takeWhile( () => this.subscriptionActive )
            .subscribe( () => {
                const scroll = window.scrollY;
                const progressTop = scroll / ( 3 * this.headerHeight );
                const progressBottom = ( scroll + this.windowHeight - this.footerOffset.top )
                    / Math.min( this.footerHeight, this.windowHeight );

                let progress = 0.5 * Math.max(0, Math.min( 1, progressTop ) );
                progress = progress + 0.5 * Math.max(0, Math.min( 1, progressBottom ) );

                this.pinFooter( scroll );
                this.pinHeader( scroll );

                timeline.progress( progress );
            } );

        WindowService
            .onResize()
            .takeWhile( () => this.subscriptionActive )
            .subscribe( () => {
                this.windowHeight = $( window ).height();
                this.adminBarHeight = $( '#wpadminbar' ).outerHeight() || 0;
                this.updateOnResize();
            } );
    }

    public pinFooter( scroll ) {
        if ( scroll >= this.footerOffset.top ) {
            if ( ! this.footerPinned ) {
                TweenLite.set( $( '.c-noto--body' ), { marginBottom: 0 } );
                TweenLite.set( $( '.site-footer' ), { position: 'static' } );
                this.footerPinned = true;
            }
        } else if ( this.footerPinned ) {
            TweenLite.set( $( '.c-noto--body' ), { marginBottom: this.footerHeight } );
            TweenLite.set( $( '.site-footer' ), { position: 'fixed' } );
            this.footerPinned = false;
        }
    }

    public pinHeader( scroll ) {
        if ( scroll >= 25 ) {
            if ( ! this.headerPinned ) {
                TweenLite.set( this.$headerGrid, {
                    pointerEvents: 'none',
                    zIndex: 100,
                } );
                this.headerPinned = true;
            }
        } else if ( this.headerPinned ) {
            TweenLite.set( this.$headerGrid, {
                pointerEvents: '',
                zIndex: ''
            } );
            this.headerPinned = false;
        }
    }

    public eventHandlers() {
        if ( Helper.below( 'lap' ) && !this.areMobileBindingsDone ) {
            this.$document.on( 'click', this.preventOneSelector, this.onMobileMenuExpand.bind(this) );
            this.areMobileBindingsDone = true;
        }

        if ( Helper.above( 'lap' ) && this.areMobileBindingsDone ) {
            this.$document.off( 'click', this.preventOneSelector, this.onMobileMenuExpand.bind(this) );
            this.areMobileBindingsDone = false;
        }
    }

    private updateOnResize() {
        this.eventHandlers();

        this.$headerGrid.css({
            height: '',
            left: '',
            position: '',
            top: '',
            width: '',
        });

        this.$footer.css({
            bottom: '',
            height: '',
            left: '',
            position: '',
            width: '',
        });

        if ( Helper.below( 'lap' ) ) {
            this.prepareMobileMenuMarkup();
        } else {
            this.prepareDesktopMenuMarkup();
        }
    }

    private prepareDesktopMenuMarkup(): void {
        const headerWidth = this.$headerGrid.outerWidth();
        const headerHeight = this.$headerGrid.outerHeight();
        const footerWidth = this.$footer.outerWidth();
        const footerHeight = this.$footer.outerHeight();

        this.$headerGrid.css({
            height: headerHeight,
            left: this.$headerGrid.offset().left,
            position: 'fixed',
            top: this.adminBarHeight,
            width: headerWidth,
        });

        this.$footer.css({
            bottom: this.windowHeight - footerHeight,
            height: footerHeight,
            left: this.footerOffset.left,
            position: 'fixed',
            width: footerWidth,
        });

        this.$bodyGrid.css({
            marginBottom: footerHeight,
            marginTop: headerHeight,
        });

        if ( this.isDesktopHeaderInitialised ) {
            return;
        }

        this.isDesktopHeaderInitialised = true;
    }

    private prepareMobileMenuMarkup(): void {
        // If if has not been done yet, prepare the mark-up for the mobile navigation
        if ( this.isMobileHeaderInitialised ) {
            return;
        }

        // Append the branding
        const $branding = $( '.c-branding' );
        $branding.clone().addClass('c-branding--mobile');
        $branding.find( 'img' ).removeClass( 'is--loading' );

        // Create the mobile site header
        const $siteHeaderMobile = $( '<div class="site-header-mobile  u-header-sides-spacing"></div>' );

        // Append the social menu
        const $searchTrigger = $( '.js-mobile-search-trigger' );

        $siteHeaderMobile.append( $branding.clone() );
        $siteHeaderMobile.append( $searchTrigger.clone().show() );
        $siteHeaderMobile.appendTo( '.c-navbar' );

        // Handle sub menus:
        // Make sure there are no open menu items
        $( '.menu-item-has-children' ).removeClass( 'hover' );

        // Add a class so we know the items to handle
        $( '.menu-item-has-children > a' ).each( ( index, element ) => {
            $( element ).addClass( 'prevent-one' );
        } );

        this.isMobileHeaderInitialised = true;
    }

    private toggleSubMenu(e: JQuery.Event, toggle: boolean) {
        $( e.currentTarget ).toggleClass( 'hover', toggle );
    }

    private onMobileMenuExpand(e: JQuery.Event): void {
        e.preventDefault();
        e.stopPropagation();

        const $button = $( e.currentTarget );
        const activeClass = 'active';
        const hoverClass = 'hover';

        if ( $button.hasClass( activeClass ) ) {
            window.location.href = $button.attr( 'href' );
            return;
        }

        $( this.preventOneSelector ).removeClass( activeClass );
        $button.addClass( activeClass );

        // When a parent menu item is activated,
        // close other menu items on the same level
        $button.parent().siblings().removeClass( hoverClass );

        // Open the sub menu of this parent item
        $button.parent().addClass( hoverClass );
    }

    private toggleNavStateClass(): boolean {
        const isMenuOpen = this.$menuToggle.prop( 'checked' );

        this.$body.toggleClass( 'nav--is-open', isMenuOpen );

        return isMenuOpen;
    }

    private onMenuToggleChange( e: JQuery.Event ): void {

        if ( ! this.toggleNavStateClass() ) {
            setTimeout( () => {
                // Close the open submenus in the mobile menu overlay
                this.$mainMenuItems.removeClass( 'hover' );
                this.$mainMenuItems.find('a').removeClass( 'active' );
            }, 300 );
        }
    }
}
