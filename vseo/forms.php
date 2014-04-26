<?php 
/*
$edit_form = <<<END
<form	method="post" enctype="multipart/form-data" name="form1" id="form1" action="" >
	<table width="100%" border="0" cellspacing="4" cellpadding="4">
		<tr>
		<td colspan="3"><strong>Dealer Video Settings.</strong></td>
		</tr>
		<tr>
			<td>Pre-Roll:</td>
			<td><label for="fileField"></label>
				<!-- <input type="file" name="pre_roll" id="fileField" /> -->
				<input type="text" name="pre_roll" id="fileField" value="{$_REQUEST['pre_roll']}"/>
			</td>
		</tr>
		<tr>
			<td>Overlay:</td>
			<td><label for="fileField"></label>
				<!-- <input type="file" name="overlay" id="fileField" /> -->
				<input type="text" name="overlay" id="fileField"	value="{$_REQUEST['overlay']}"/>
			</td>
		</tr>
		<tr>
			<td>Post-Roll:</td>
			<td><label for="fileField"></label>
				<!-- <input type="file" name="post_roll" id="fileField" /> -->
				<input type="text" name="post_roll" id="fileField"	value="{$_REQUEST['post_roll']}"/>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><div align="center">
				<input type="submit" name="save" id="button" value="Save " />
			</div></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
END;
*/

$edit_form = <<<END
<form	method="post" enctype="multipart/form-data" name="form1" id="form1" action="" >
	<table width="100%" border="0" cellspacing="4" cellpadding="4">
		<tr>
		<td colspan="3"><strong>Dealer Video Settings.</strong></td>
		</tr>
		<tr>
			<td>Bumper:</td>
			<td><label for="fileField"></label>
				<!-- <input type="file" name="pre_roll" id="fileField" /> -->
				<input type="text" name="pre_roll" id="fileField" value="{$_REQUEST['pre_roll']}"/>
			</td>
		</tr>
		<tr>
			<td>Overlay:</td>
			<td><label for="fileField"></label>
				<!-- <input type="file" name="overlay" id="fileField" /> -->
				<input type="text" name="overlay" id="fileField"	value="{$_REQUEST['overlay']}"/>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><div align="center">
				<input type="submit" name="save" id="button" value="Save " />
			</div></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
END;


$add_form = <<<END
<form	method="post" enctype="multipart/form-data" name="form1" id="form1" action="status.php" >
	<table width="100%" border="0" cellspacing="4" cellpadding="4">
	<tr>
		<td colspan="3"><strong>Create your Video(s).</strong></td>
		</tr>
	<tr>
		<td>Video Type:</td>
		<td><label for="select"></label>
			<select name="select" id="select">
				<option selected="selected">Test Drive</option>
				<option>Promo</option>
				<option>Special Offer</option>
			</select></td>
		<td width="34%"><em>This selection dictates fields that show/hide via ajax. Defaults to Test Drive.</em></td>
	</tr>
	<tr>
		<td>Year:</td>
		<td><label for="select2"></label>
			<select name="select2" id="select2">
				<option>2014</option>
				<option>2013</option>
				<option>2012</option>
			</select></td>
		<td><em>Choose Year of model. Defaults to 2014.</em></td>
	</tr>
	<tr>
		<td>Make:</td>
		<td><select name="select3" id="select3">
			<option selected="selected">Toyota</option>
			<option>Chevrolet</option>
			<option>Ford</option>
		</select></td>
		<td><em>Choose Make for video. Defaults to Toyota</em></td>
	</tr>
	<tr>
		<td>Model:</td>
		<td><select name="select4" id="select4">
			<option>*All Models*</option>
			<option selected="selected">Corolla</option>
			<option>Yaris</option>
		</select></td>
		<td><em>Choose single Model or *All Models*. Defaults to Corolla.</em></td>
	</tr>
	<tr>
		<td>Video Sections:</td>
		<td colspan="2">
		<input name="checkbox" type="checkbox" id="checkbox" value="Features" checked="checked" />
		<label for="checkbox">Features</label>
		<input name="checkbox" type="checkbox" id="checkbox" value="Performance" checked="checked" />
		<label for="checkbox">Performance</label>
		<input name="checkbox" type="checkbox" id="checkbox" value="Fuel" checked="checked" />
		<label for="checkbox">Fuel </label>
		<input name="checkbox" type="checkbox" id="checkbox" value="Price" checked="checked" />
		<label for="checkbox">Price</label>
		<input name="checkbox" type="checkbox" id="checkbox" value="Safety" checked="checked" />
		<label for="checkbox">Safety</label>
		<input name="checkbox" type="checkbox" id="checkbox" value="Warranty" checked="checked" />
		<label for="checkbox">Warranty</label></tr>
	<tr>
		<td>Music Soundtrack:</td>
		<td><label for="select5"></label>
			<select name="select5" id="select5">
				<option>Happy</option>
				<option selected="selected">Mellow</option>
				<option>Dramatic</option>
				<option>Energetic</option>
			</select>
			<input name="checkbox2" type="checkbox" id="checkbox2" checked="checked" />
			<label for="checkbox2">Auto-select</label></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Voiceover:</td>
		<td><select name="select6" id="select6">
			<option selected="selected">Male</option>
			<option>Female</option>
		</select></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><strong>Add Video Branding (optional)</strong></td>
		</tr>
	<tr>
		<td>Pre-Roll:</td>
		<td><label for="fileField"></label>
			<!-- <input type="file" name="fileField" id="fileField" /> 
			-or- 
			<input type="checkbox" name="checkbox3" id="checkbox3" />
			Auto-create --> 
			<input type="text" readonly name="pre_roll" value="{$_REQUEST['pre_roll']}" >
		</td> 
		<td><em>Optional pre-roll branding.</em></td>
	</tr>
	<tr>
		<td>Overlay:</td>
		<td><label for="fileField"></label>
			<!-- <input type="file" name="fileField2" id="fileField" />
			-or-
			<input type="checkbox" name="checkbox4" id="checkbox4" />
			Auto-create -->
			<input type="text" readonly name="overlay" value="{$_REQUEST['overlay']}" >
		</td>
		<td><em>Optional post-roll branding.</em></td>
	</tr>
	<tr>
		<td>Post-Roll:</td>
		<td><label for="fileField"></label>
			<!-- <input type="file" name="fileField2" id="fileField" />
			-or-
			<input type="checkbox" name="checkbox4" id="checkbox4" />
			Auto-create -->
			<input type="text" readonly name="post_roll" value="{$_REQUEST['post_roll']}" >
		</td>
		<td><em>Optional post-roll branding.</em></td>
	</tr>
	<tr>
		<td>Select	Call to Action:</td>
		<td><label for="textfield"></label>
			<label for="select7"></label>
			<select name="select7" id="select7">
				<option selected="selected">Link</option>
				<option>Email Lead</option>
				<option>Phone Lead</option>
			</select>
			&nbsp;&nbsp;URL:
			<input type="text" name="textfield" id="textfield" /></td>
		<td><em>URL text field shows only if &quot;Link&quot; is chosen.</em></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3"><strong>Preview Video Meta Data Templates.</strong></td>
	</tr>
	<tr>
		<td>Title(s) Template:</td>
		<td><label for="textfield2"></label>
			<input name="textfield2" type="text" id="textfield2" value="{year} {make} {model} - {dealer_name} - {dealer_city}, {dealer_state}" size="60" /></td>
		<td><em> Variables not removeable, but can be re-ordered. Separators and text can be added or edited.</em></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>Preview: 2014 Toyota Corolla -Collin's Cars - Los Angeles, CA</td>
		<td><em>Live preview of title based on title template that's set.</em></td>
	</tr>
	<tr>
		<td valign="top"> Description(s) Template:</td>
		<td><label for="textarea"></label>
			<textarea name="textarea" id="textarea" cols="45" rows="5">Get a great deal on this {year} {make} {model} from {dealer_name} in {dealer_city}, {dealer_state}.
				Click the link to check out our {model} Inventory Listings: {call_to_action_url}</textarea>
			<br /></td>
		<td><em>Pre-filled with auto-generated description. Link derived from call-to-action link. Fully editable.</em></td>
	</tr>
	<tr>
		<td>Tags Template:</td>
		<td><label for="textfield2"></label>
			<input name="textfield2" type="text" id="textfield2" value="{year},{make},{model},{dealer_name},{dealer_city},{dealer_state}" size="40" maxlength="100" /></td>
		<td><em>Comma-separated tags.</em></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><div align="center">
			<input type="submit" name="build_video" id="button" value="Build Video" />
		</div></td>
		<td>&nbsp;</td>
	</tr>
</table>
</form>
END;
