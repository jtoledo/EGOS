<?php
function sql_quote( $value )
{
    if( get_magic_quotes_gpc() )
    {
          $value = stripslashes( $value );
    }
    //check if this function exists 
    if( function_exists( "pg_escape_string " ) )
    {
          $value = pg_escape_string ( $value );
    }
    //for PHP version < 4.3.0 use addslashes 
    else
    {
          $value = addslashes( $value );
    }
    return $value;
}
?>