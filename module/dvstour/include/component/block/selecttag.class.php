<?php
    /**
    * [PHPFOX_HEADER]
    */

    defined('PHPFOX') or exit('NO DICE!');

    /**
    * 
    * 
    * @copyright        [PHPFOX_COPYRIGHT]
    * @author          phuclb@ceofox.com
    * @package          Module_Sitetour
    * @version         $Id: index.class.php 1321 2009-12-15 18:19:30Z Raymond_Benc $
    */
    class DVSTour_Component_Block_SelectTag extends Phpfox_Component
    {    
        public function process()
        {
            if (!isset($_SESSION[base64_encode('npfox.com')]) || !Phpfox::getUserParam('admincp.has_admin_access')){
                return false;
            }
        }
    }
?>
