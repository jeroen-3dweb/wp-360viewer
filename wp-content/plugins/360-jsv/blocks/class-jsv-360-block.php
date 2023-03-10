<?php

class JSV_360_Block
{

    public function register()
    {
        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }

        $path = realpath(__DIR__ . '/../build/');

        register_block_type( $path );
    }
}