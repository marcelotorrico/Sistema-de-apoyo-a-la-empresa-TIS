<?php
set_time_limit(300);
class CreadorDirectorios {
    
    public static function copiar( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                self::copiar( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }
 
        $d->close();
        }else {
            copy( $source, $target );
        }
    }
    function removeDirectory($path){
        
        $path = rtrim( strval( $path ), '/' ) ;
    
        $d = dir( $path );
    
        if( ! $d )
            return false;
    
        while ( false !== ($current = $d->read()) ){
            if( $current === '.' || $current === '..')
            continue;
        
            $file = $d->path . '/' . $current;
        
            if( is_dir($file) )
                removeDirectory($file);
        
            if( is_file($file) )
                unlink($file);
        }
    
        rmdir( $d->path );
        $d->close();
        return true;
    }
}
