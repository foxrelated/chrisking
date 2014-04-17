<?php 
include('settings.php');
$title = 'VSEO: Build';
ob_start();

?>
		<h3>ADMIN VIEW ONLY</h3>
		<form	method="post" enctype="multipart/form-data" name="form1" id="form1" action="build_step2.php" >
		<table width="100%" border="0" cellspacing="4" cellpadding="4">
		  <tr>
		    <td colspan="3">&nbsp;</td>
	      </tr>
		  <tr>
		    <td colspan="3"><strong>Select Video(s) to Build</strong></td>
	      </tr>
		<tr>
		  <td width="12%">Select DVS:</td>
		  <td width="32%"><select name="select" id="select">
		    <option selected="selected">Collin Motors</option>
		    <option>Gervais Ford</option>
		    <option>Acton Toyota</option>
	      </select></td>
		  <td width="56%"><em>Choose DVS we're going to create VSEO videos for.</em></td>
		  </tr>
		<tr>
		  <td>Video Type:</td>
		  <td><select name="select2" id="select2">
		    <option>1onOne+ (New Models)</option>
		    <option>New2U (Used Models)</option>
	      </select></td>
		  <td><p><em>Determines which video snippets to use  (1onOne+ or New2U). 1onOne+ = New models. New2U = Used models.</em></p></td>
		  </tr>
		<tr>
		  <td>Year:</td>
		  <td><select name="select3" id="select3">
		    <option selected="selected">2014</option>
		    <option>2013</option>
		    <option>*All Years*</option>
	      </select></td>
		  <td><em>Determines which model year videos to create (default is newest year) based on Video Type chosen. We have a DVS admin setting that specifies &quot;new&quot; model years and &quot;used&quot; model years. The years shown will filter based on Video Type selected (new vs. used).</em></td>
		  </tr>
		<tr>
		  <td>Make:</td>
		  <td><select name="select" id="select5">
		    <option selected="selected">Toyota</option>
		    <option>Chevrolet</option>
		    <option>Ford</option>
		    </select></td>
		  <td><em>Defaults to list of brand(s) chosen DVS supports. We will allow only this tool to create videos one brand at a time (for now).</em></td>
		  </tr>
		<tr>
		  <td>Model:</td>
		  <td><select name="select2" id="select6">
		    <option selected="selected">*All Models*</option>
		    <option>Corolla</option>
		    <option>Yaris</option>
		    </select></td>
		  <td><em>Choose single Model video to create, or *All Models*. Defaults to All Models.</em></td>
		  </tr>
		<tr>
			<td>Total Videos to Create:</td>
			<td>23</td>
			<td><em>This reports the number of videos that will be generated based on all of the above selected values.</em></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3"><strong>Select Video Branding</strong></td>
			</tr>
		<tr>
		  <td>Dealer Logo (optional):</td>
		  <td><label for="fileField6">Upload: </label>
	      <input name="fileField2" type="file" id="fileField" size="10" /></td>
		  <td><em>Used for pre/post/overlay branding. Text is used, if necessary, if no logo is provided.</em></td>
		  </tr>
		<tr>
			<td>Bumpers (pre/post roll) (required):</td>
			<td><p>
			  <label for="radio">Auto Generate: </label>
			  <input type="radio" name="radio" id="radio" value="radio" />
			  Custom: 
			  <input type="radio" name="radio" id="radio4" value="radio" />
			  <br /> <br />
			  <label for="fileField">Upload: </label>
	            <input name="fileField" type="file" id="fileField2" size="10" />
	        </p></td> 
			<td><em>Default is Auto-Generate. Upload form shows if Custom is chosen, otherwise it's hidden by default.</em></td>
		</tr>
		<tr>
			<td>Overlay (required):</td>
			<td><label for="fileField"></label>
			<!-- <input type="file" name="fileField2" id="fileField" />
				-or-
				<input type="checkbox" name="checkbox4" id="checkbox4" />
				Auto-create -->
			<label for="radio4">Auto Generate: </label>
	        <input type="radio" name="radio" id="radio4" value="radio" />
	Custom:
	<input type="radio" name="radio" id="radio2" value="radio" />
	<br />
	        <br />
	        <label for="fileField4">Upload: </label>
	        <input name="fileField3" type="file" id="fileField3" size="10" /></td>
			<td><em>Default is Auto-Generate. Upload form shows if Custom is chosen, otherwise it's hidden by default.</em></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3"><strong>Select Video Meta Data Template</strong></td>
		</tr>
		<tr>
			<td>Title(s) Template:</td>
			<td><label for="textfield2"></label>
				<input name="textfield2" type="text" id="textfield2" value="{year} {make} {model} - {dealer_name} - {dealer_city}, {dealer_state}" size="60" /></td>
			<td><em>Editable text field. Variables used for dynamic data insertion from DVS.</em></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>Live Preview: 2014 Toyota Corolla - Collin's Cars - Los Angeles, CA</td>
			<td><em>Live preview of title based on title template that's set.</em></td>
		</tr>
		<tr>
			<td valign="top"> Description(s) Template:</td>
			<td><label for="textarea"></label>
				<textarea name="textarea" id="textarea" cols="45" rows="5">Get a great deal on this {year} {make} {model} from {dealer_name} in {dealer_city}, {dealer_state}.
					Click the link to check out our {model} Inventory Listings: {dvs_url}</textarea>
				<br /></td>
			<td><em>Editable description. Pre-filled with auto-generate description, as shown.</em></td>
		</tr>
		<tr>
			<td>Tags Template:</td>
			<td><label for="textfield2"></label>
				<input name="textfield2" type="text" id="textfield2" value="{year},{make},{model},{dealer_name},{dealer_city},{dealer_state}" size="40" maxlength="100" /></td>
			<td><em>Comma-separated tags. Pre-filled with auto-generated tags. Editable text field.</em></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		<tr>
			<td>&nbsp;</td>
			<td><div align="left">
			  <p>
			    <input type="submit" name="build_video" id="button" value="Continue" />
		      </p>
	</div></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>	
<?php

$content = ob_get_clean();

html_page_start();

html_header($title);

html_body($content);

html_page_end();
