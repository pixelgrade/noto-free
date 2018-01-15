import { BaseTheme, JQueryExtended } from '../../../components/base/ts/BaseTheme';
import { Helper } from '../../../components/base/ts/services/Helper';

export class Boilerplate extends BaseTheme {

  constructor() {
    super();

    this.handleContent();
  }

  public bindEvents() {
    super.bindEvents();
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

  public handleContent( $container: JQuery = this.$body ) {

    Helper.unwrapImages( $container.find( '.entry-content' ) );
    Helper.wrapEmbeds( $container.find( '.entry-content' ) );
    Helper.handleVideos( $container );
    Helper.handleCustomCSS( $container );

    this.eventHandlers( $container );
  }

  private adjustLayout() {
  }

}
