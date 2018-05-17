import $ from 'jquery';
import { BaseTheme, JQueryExtended } from '../../../components/base/ts/BaseTheme';
import { Helper } from '../../../components/base/ts/services/Helper';

export class Pierot extends BaseTheme {
  public mouseX = 0;
  public mouseY = 0;

  constructor() {
    super();

    const that = this;

    this.handleContent();

    function loop() {
      that.updateCardsPosition();
      requestAnimationFrame( loop );
    }

    requestAnimationFrame( loop );
  }

  public updateCardsPosition() {
    const that = this;

    $( '.c-card' ).each( (i, obj) => {
      const thereshold = 20;
      const el = (obj as HTMLElement);
      const cardRect = el.getBoundingClientRect();
      const cardWidth = el.offsetWidth;
      const cardHeight = el.offsetHeight;

      const distanceX = that.mouseX - (cardRect.left + cardWidth/2);
      const distanceY = that.mouseY - (cardRect.top + cardHeight/2) - window.scrollY;

      const moveX = thereshold * 2 * distanceX / cardWidth;
      const moveY = thereshold * 2 * distanceY / cardHeight;

      const images = (el.parentNode as Element).querySelectorAll( '.c-card__frame' );

      for (let i = 0; i < images.length; ++i) {
        (images[i] as HTMLElement).style.transform = 'translate(' + moveX + 'px,' + moveY + 'px)';
      }
    } );
  }

  public bindEvents() {
    super.bindEvents();

    const that = this;

    $( 'body' ).on( 'mousemove', (e) => {
      that.mouseX = e.pageX;
      that.mouseY = e.pageY;
    });
  }

  public onLoadAction() {
    super.onLoadAction();

    this.adjustLayout();
  }

  public onResizeAction() {
    super.onResizeAction();
    this.adjustLayout();
  }

  public onJetpackPostLoad() {
    const $container = ($( '#posts-container' ) as JQueryExtended );

    this.handleContent( $container );
    this.adjustLayout();
  }

  public appendSvgToIntro( $container: JQuery = this.$body ) {
    const $intro = $container.find( '.intro' );
    const $waveTemplate = $( '.js-wave-pattern-template' );

    $intro.each( ( i, obj ) => {
      const $obj = $( obj );
      $waveTemplate.clone().prependTo( $obj ).show();
    });
  }

  public handleContent( $container: JQuery = this.$body ) {

    Helper.unwrapImages( $container.find( '.entry-content' ) );
    Helper.wrapEmbeds( $container.find( '.entry-content' ) );
    Helper.handleVideos( $container );
    Helper.handleCustomCSS( $container );

    this.appendSvgToIntro( $container );
    this.eventHandlers( $container );
  }

  private adjustLayout() {
  }

}
