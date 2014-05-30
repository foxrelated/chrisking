<?php 
/**
 * [PHPFOX_HEADER]
 * 
 * @copyright   [PHPFOX_COPYRIGHT]
 * @author      Raymond Benc
 * @package     Phpfox
 * @version     $Id: inventory.html.php 4095 2012-04-16 13:29:01Z flit77 $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>

{literal}
<script type="text/javascript">
  connectorUpdated = function(connector_id){
    // get updated values
    var connector_row   = $('#connector_row_' + connector_id);
    var con_title       = $('#edit_connector-name_popup').val();
    var con_guid        = $('#edit_connector-guid_popup').val();
    var con_description = $('#edit_connector-notes_popup').val();

    // update row value
    connector_row.find('.connector_title').text(con_title);
    connector_row.find('.connector_guid').text(con_guid);
    connector_row.find('.connector_description').text(con_description);

    // clear form values
    $('#edit_connector-name_popup').val('');
    $('#edit_connector-guid_popup').val('');
    $('#edit_connector-notes_popup').val('');
    $('#dvs_inventory_connector_id').val('');

    $('.edit_connector_popup_wrapper').hide();
    alert('Connector updated');
  };
  connectorDeleted = function(connector_id){
    $('#connector_row_' + connector_id).remove();
  };
  clearWarnings = function(){
    $("#add_connector_form :input").removeClass('warning');
    $('#errorwarn').text('');
  };
  connectorCreated = function(connector_id){
    var dvs_inventory_name  = $('#dvs_inventory_name').val();
    var dvs_inventory_guid  = $('#dvs_inventory_guid').val();
    var dvs_inventory_notes = $('#dvs_inventory_notes').val();

    $('#dvs_inventory_name').val('');
    $('#dvs_inventory_guid').val('');
    $('#dvs_inventory_notes').val('');
    clearWarnings();

    $('#connector_row_0').clone()
                         .show()
                         .prependTo('.connector_row_wrapper')
                         .attr('id', 'connector_row_' + connector_id);

    var recent_connector_row = $('#connector_row_' + connector_id);
    recent_connector_row.find('#edit_connector_link').attr('connector_id', connector_id);
    recent_connector_row.find('#delete_connector_link').attr('connector_id', connector_id);

    recent_connector_row.find('.connector_title').text(dvs_inventory_name);
    recent_connector_row.find('.connector_guid').text(dvs_inventory_guid);
    recent_connector_row.find('.connector_description').text(dvs_inventory_notes);
    
  };
  $Behavior.domReady = function(){
    $('#add_connector_form').on('submit', function(){
      var errors = 0;
      var params = '';
      $("#add_connector_form :input").map(function(){
        if( $(this).attr('name') != 'dvs_inventory_notes' && $(this).attr('type') != 'hidden' ) {
          if( !$(this).val() ) {
            $(this).parents('td').addClass('warning');
            errors++;
          } else if ($(this).val()) {
            $(this).parents('td').removeClass('warning');
          }
        }
        if($(this).attr('type') == 'text'){
          if(params != ''){
            params += '&';
          }
          params += $(this).attr('name') + '=' + $(this).val();
        }
      });
      if(errors > 0){
        $('#errorwarn').text('{/literal}{phrase var='dvs.fields_warning_message'}{literal}');
        return false;
      }

      clearWarnings();

      $.ajaxCall('dvs.addInventoryConnector', params);
      return false;
    });
    $('body').on('click', '#delete_connector_link', function(){
      var result = confirm("Are you sure?");
      if (result == true) {
        var params = 'connector_id=' + $(this).attr('connector_id');
        $.ajaxCall('dvs.deleteInventoryConnector', params);
      }
      return false;
    });
    $('body').on('click', '#edit_connector_link', function(){
      var connector_id    = $(this).attr('connector_id');
      var connector_row   = $('#connector_row_' + connector_id);
      var con_title       = connector_row.find('.connector_title').text();
      var con_guid        = connector_row.find('.connector_guid').text();
      var con_description = connector_row.find('.connector_description').text();

      $('#edit_connector-name_popup').val(con_title);
      $('#edit_connector-guid_popup').val(con_guid);
      $('#edit_connector-notes_popup').val(con_description);
      $('#dvs_inventory_connector_id').val(connector_id);

      $('.edit_connector_popup_wrapper').show();
      return false;
    });
    $('#close_edit_connector_popup').on('click', function(){
      // clear form values
      $('#edit_connector-name_popup').val('');
      $('#edit_connector-guid_popup').val('');
      $('#edit_connector-notes_popup').val('');

      $('.edit_connector_popup_wrapper').hide();
    });
    $('#edit_connectorform_popup').on('submit', function(){
      var connector_id    = $('#dvs_inventory_connector_id').val();
      var con_title       = $('#edit_connector-name_popup').val();
      var con_guid        = $('#edit_connector-guid_popup').val();
      var con_description = $('#edit_connector-notes_popup').val();

      var params = "connector_id=" + connector_id + "&title=" + con_title + "&guid=" + con_guid + "&description=" + con_description;

      $.ajaxCall('dvs.updateInventoryConnector', params);
      return false;
    });
  };
</script>
{/literal}

<div class="importio_settings">
  <h1>{phrase var='dvs.importio_settings'}</h1>

  <form action="" method="post">
    <table class="dvs_inventory_guid_table">
      <thead>
        <tr>
          <th>{phrase var='dvs.user_guid'}</th>
          <th>{phrase var='dvs.api_key'}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <input type="text" name="dvs_inventory_guid" value="{$dvs_inventory_guid}" />
          </td>
          <td>
            <input type="text" name="dvs_inventory_api_key" value="{$dvs_inventory_api_key}" />
          </td>
          <td>
            <input type="submit" name="save" value="save" class="button">
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>

<div class="importio_settings_wrapper">
  <h1>{phrase var='dvs.inventory_connectors'}</h1>

  <table class="dvs_inventory_guid_table dvs_inventory_connectors_table">
    <thead>
      <tr>
        <th>{phrase var='dvs.inventory_connectors_name'}</th>
        <th>{phrase var='dvs.inventory_connectors_guid'}</th>
        <th>{phrase var='dvs.inventory_connectors_notes'}</th>
        <th>{phrase var='dvs.inventory_connectors_action'}</th>
      </tr>
    </thead>
    <tbody class="connector_row_wrapper">
      {if $connectors}
        {foreach from=$connectors item=connector name=iConnector}
          <tr id="connector_row_{$connector.connector_id}">
            <td class="connector_title">{$connector.title}</td>
            <td class="connector_guid">{$connector.guid}</td>
            <td class="connector_description">{$connector.description}</td>
            <td>
              <a href="javascript:void(0);" title="{phrase var='dvs.inventory_connectors_edit'}" id="edit_connector_link" connector_id="{$connector.connector_id}">{phrase var='dvs.inventory_connectors_edit'}</a> | <a href="javascript:void(0);" title="{phrase var='dvs.inventory_connectors_delete'}" id="delete_connector_link" connector_id="{$connector.connector_id}">{phrase var='dvs.inventory_connectors_delete'}</a>
            </td>
          </tr>
        {/foreach}
          <tr id="connector_row_0" style="display: none;">
            <td class="connector_title"></td>
            <td class="connector_guid"></td>
            <td class="connector_description"></td>
            <td>
              <a href="javascript:void(0);" title="{phrase var='dvs.inventory_connectors_edit'}" id="edit_connector_link" connector_id="0">{phrase var='dvs.inventory_connectors_edit'}</a> | <a href="javascript:void(0);" title="{phrase var='dvs.inventory_connectors_delete'}" id="delete_connector_link" connector_id="0">{phrase var='dvs.inventory_connectors_delete'}</a>
            </td>
          </tr>
      {else}
        <tr>
          <td colspan="4">
            {phrase var='dvs.inventory_connectors_empty'}
          </td>
        </tr>
      {/if}
    </tbody>
  </table>
</div>

<div class="importio_addnew_settings_wrapper">
  <h1>{phrase var='dvs.inventory_connectors_addnew'}</h1>

  <div id="errorwarn"></div>

  <form action="" method="post" id="add_connector_form">
    <table class="dvs_inventory_guid_table">
      <thead>
        <tr>
          <th>{phrase var='dvs.inventory_connectors_name'}</th>
          <th>{phrase var='dvs.inventory_connectors_addnew_connectorguid'}</th>
          <th>{phrase var='dvs.inventory_connectors_notes'}</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <input type="text" name="dvs_inventory_name" id="dvs_inventory_name" value="" />
          </td>
          <td>
            <input type="text" name="dvs_inventory_guid" id="dvs_inventory_guid" value="" />
          </td>
          <td>
            <input type="text" name="dvs_inventory_notes" id="dvs_inventory_notes" value="" />
          </td>
          <td>
            <input type="hidden" name="dvs_inventory_connector_id" id="dvs_inventory_connector_id" value="" />
            <input type="submit" name="add" value="add" class="button" id="add_connector_link" />
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>

<div class="edit_connector_popup_wrapper">
    <div id="edit_connector_popup">
      <div id="close_edit_connector_popup">X</div>
      <div id="popup_title">Edit Connector</div>
      <div id="edit_connector-form">
        <form id="edit_connectorform_popup" method="post" action="">
          <input type="text" value="" placeholder="Name" name="edit_connector-name" id="edit_connector-name_popup">
          <input type="text" value="" placeholder="GUID" name="edit_connector-guid" id="edit_connector-guid_popup">
          <input type="text" value="" placeholder="Notes" name="edit_connector-notes" id="edit_connector-notes_popup">
          <input type="submit" class="btn btn-large" value="Save" id="button-edit_connector_popup" name="button-edit_connector">
        </form>
      </div>
    </div>
</div>