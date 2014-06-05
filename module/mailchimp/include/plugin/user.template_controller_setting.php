<?php
/**
 * Disable this function.
 */
if (false && Phpfox::isModule('mailchimp'))
{
    $aLists = Phpfox::getService('mailchimp')->getAvailableListforUserToSubscribe();

    if (is_array($aLists) && count($aLists) > 0)
    {
        echo '<ul class="block_listing">';
        foreach ($aLists as $aList)
        {
            echo '  <li>';
            echo '      <div class="block_listing_title">';
            echo '          <div>';
            echo '              <b>' . $aList['name'] . '</b>';
            echo '              <span style="display: none;" class="mailchimp-subcribe-list-id">' . $aList['id'] . '</span>';
            echo '              <span style="color: blue;" class="mailchimp-subcribe">Subcribe</span>';
            echo '          </div>';
            echo '      </div>';
            echo '      <div class="clear"></div>';
            echo '  </li>';
        }
        echo '</ul>';
    }
    
    echo '<script type="text/javascript">
    $Behavior.mailchimp_subcribe = function (){
        var aMailChimpSubcribe = $(".mailchimp-subcribe");
        
        aMailChimpSubcribe.each(function(){
            var oSubcribe = $(this);
            
            oSubcribe.click(function(oEvent){
                oSubcribe.parent().parent().parent().hide();
                
                var oListId = oSubcribe.parent().find(".mailchimp-subcribe-list-id");
                
                if (oListId.length)
                {
                    $.ajaxCall("mailchimp.subcribe", "sListId=" + oListId.text());
                }
            });
        });
    }
</script>
';
}
?>