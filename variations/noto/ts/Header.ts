import $ from 'jquery';
import * as imagesLoaded from 'imagesloaded';
import 'jquery-hoverintent';
import { BaseComponent } from '../../../components/base/ts/models/DefaultComponent';
import { Helper } from '../../../components/base/ts/services/Helper';
import { WindowService } from '../../../components/base/ts/services/window.service';
import { TimelineMax } from 'gsap';

interface JQueryExtended extends JQuery {
    hoverIntent?( params: any ): void;
    imagesLoaded?( params: any );
}

export class NotoHeader extends BaseComponent {

    private $body: JQuery = $( 'body' );
    private $document: JQuery = $( document );

    // private documentHeight = $( document ).height();
    private windowHeight = $( window ).height();

    private $headerGrid: JQuery = $( '.c-noto--header' );
    private headerHeight = this.$headerGrid.outerHeight();

    private $bodyGrid: JQuery = $( '.c-noto--body' );

    private $footer: JQuery = $( '.site-footer' );
    private footerOffset = this.$footer.offset();
    private footerHeight = this.$footer.outerHeight();

    private $mainMenu: JQuery = $( '.menu--primary' );
    private $mainMenuItems: JQueryExtended = this.$mainMenu.find( 'li' );
    private $menuToggle: JQuery = $( '#menu-toggle' );
    private isMobileHeaderInitialised: boolean = false;
    private isDesktopHeaderInitialised: boolean = false;
    private areMobileBindingsDone: boolean = false;
    private subscriptionActive: boolean = true;
    private preventOneSelector: string = 'a.prevent-one';

    constructor() {
        super();

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

        this.$mainMenuItems.hoverIntent( {
            out: (e) => this.toggleSubMenu(e, false),
            over: (e) => this.toggleSubMenu(e, true),
            timeout: 300
        } );

        const $accentLayer = $( '.c-footer-layers__accent' );
        const $darkLayer = $( '.c-footer-layers__dark' );
        const timeline = new TimelineMax( { paused: true } );

        timeline.to( $accentLayer, .5, { rotation: 0, y: this.headerHeight * 0.64, x: -10 }, 0 );
        timeline.to( $darkLayer, .5, { rotation: 0 }, 0 );

        WindowService
            .onScroll()
            .takeWhile( () => this.subscriptionActive )
            .subscribe( () => {
                const scroll = window.scrollY;
                const progressTop = scroll / ( 3 * this.headerHeight );
                const progressBottom = 1 - ( scroll + this.windowHeight - this.footerOffset.top ) / this.footerHeight;
                const progress = Math.max( 0, Math.min( 1, progressTop, progressBottom ) );
                timeline.progress( progress );
                console.log( progress );
            } );

        WindowService
            .onResize()
            .takeWhile( () => this.subscriptionActive )
            .subscribe( () => {
                this.windowHeight = $( window ).height();
                this.updateOnResize();
            } );
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
        const headerWidth = this.$headerGrid.width();
        const headerHeight = this.$headerGrid.outerHeight();
        // const footerWidth = this.$footer.width();
        const footerHeight = this.$footer.outerHeight();
        const adminBarHeight = $( '#wpadminbar' ).outerHeight();

        this.$headerGrid.css({
            height: headerHeight,
            left: this.$headerGrid.offset().left,
            position: 'fixed',
            top: adminBarHeight,
            width: headerWidth,
        });

        this.$footer.css({
            bottom: 0,
            height: footerHeight,
            left: 0,
            position: 'fixed',
            width: '100%',
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
