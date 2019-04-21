<?php

class SpecialPhpInfo extends SpecialPage {
    function __construct() {
        parent::__construct( 'PhpInfo' );
    }

    function execute( $par ) {
        $request = $this->getRequest();
        $out = $this->getOutput();

        $parserOptions = $out->parserOptions();
        $parserOptions->setAllowUnsafeRawHtml( true );

        $this->setHeaders();

        ob_start();
        phpinfo();
        $wikitext = ob_get_contents();
        ob_clean();

        $wikitext = preg_replace( '/<!DOCTYPE [^>]+>/', '', $wikitext );

        $out->addWikiText( $wikitext );
    }

    function getGroupName() {
        return 'other';
    }
}
