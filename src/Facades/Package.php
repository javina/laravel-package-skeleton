<?php
namespace Vendor\Package\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Package Facade Class
 *
 * @package default
 * @author
 **/
class Package extends Facade
{

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    protected static function getFacadeAccessor()
    {
        return 'package';
    }

} // END class Package
?>
