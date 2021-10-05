<?php

add_filter( 'web_app_manifest', function( $manifest ) {
   $manifest['short_name'] = 'Qatar';
   $manifest['background_color'] = '#e2e469';
   $manifest['display'] = 'standalone';

   return $manifest;
} );