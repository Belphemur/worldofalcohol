{assign var='site_link' value='http://worldofalcohols.com'}
<script type="text/javascript" src="{$site_link}/js/contact.js"></script>

<header class="top-margin-5 hide-all show-large show-xlarge">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="index.php">World</a></li>
	<li class="active"><a href="#"><b>Submit alcohol</b></a></li>
	</ul>
	</nav>
</header>
<header class="top-margin-gap hide-all show-medium show-small show-tiny">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="index.php">World</a></li>
	<li class="active"><a href="#"><b>Submit alcohol</b></a></li>
	</ul>
	</nav>
</header>
<script type="text/javascript">

    function readURL(input) {
	//check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			var fsize = input.files[0].size;
			var ftype = input.files[0].type;
			var fname = input.files[0].name;
			
			reader.onload = function (e) {
				$('#img_preview').css("max-height", "200px");
				
				if(fsize>1048576) {
					$('#img_preview').attr('src', '');
					$('#preview_error').append('<p class="ink-alert basic error">Image too big (> 1MB) choose smaller image !!</p>');
				} else{
					$('#img_preview').attr('src', e.target.result);
				}
				
				switch(ftype)
				{
					case 'image/png':
					case 'image/gif':
					case 'image/jpeg':
					case 'image/pjpeg':
						$('#file_format').val("ok");
						break;
					default:
						$('#preview_error').append('<p class="ink-alert basic error">Unsupported file format. Please choose a jpg, png or gif image</p>');
						$('#file_format').val("error");
				}
			}
			
			reader.readAsDataURL(input.files[0]);
			
		}
	}else{
		$('#preview_div').html('<p class="ink-alert basic error">Preview not supported with your borwser !</p>');
    }
}
$( document ).ready(function() {

$("#inline-image").change(function(){
	readURL(this);
	$('#preview_error').html('');
});

$("#inline-alcohol_sub_type").change(function(){
	var selected_val = $(this).find(':selected').val();
	if(selected_val!=""){
		$("#inline-other_sub_type").val("");
	}
});

$("#inline-other_sub_type").change(function(){
	$("#inline-alcohol_sub_type").val("");
});


});	
</script>
<h5 id="submit_heading"> Share with us a local alcohol you have discovered in your region ! </h5>
<form id="submitForm" action="valid_submit.php" method="post" class="ink-form" enctype="multipart/form-data">	
	<fieldset>
    <legend>Your Info:</legend>
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-name" class="all-35 align-right">Name</label>
				<div class="control all-65">
					<input type="text" name="name" id="inline-name">
				</div>
			</div>
		</div>
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-email" class="all-35 align-right">Email</label>
				<div class="control all-65">
					<input type="text" name="email" id="inline-email">
				</div>
			</div>
		</div>
	</div>
	</fieldset>
	<fieldset>
    <legend>Alcohol Info:</legend>
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-country" class="all-35 align-right required">Country</label>
				<div class="control all-65">
					<select id="inline-country" name="country">
						<option value="">Choose one:</option> 
						{foreach $countries as $country}
							{if $country.country_code|lower == $current_country_code}
								<option value="{$country.country_code}" selected>{$country.country}</option>
							{else}
								<option value="{$country.country_code}">{$country.country}</option>
							{/if}
						{/foreach}
					</select>
				</div>
			</div>
		</div>
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-city" class="all-35 align-right">City</label>
				<div class="control all-65">
					<input type="text" name="city" id="inline-city">
				</div>
			</div>
		</div>
	</div>
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-alcohol_name" class="all-35 align-right">Alcohol Name</label>
				<div class="control all-65">
					<input type="text" name="alcohol_name" id="inline-alcohol_name">
				</div>
			</div>
		</div>		
		
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-alcohol_type" class="all-35 align-right required">Alcohol Type</label>
				<div class="control all-65">
					<select id="inline-alcohol_type" name="alcohol_type">
						<option value="">Choose one:</option> 
						{foreach $types as $type}
							{if $type.type_code|lower == $current_type}
								<option value="{$type.type_code}" selected>{$type.type}</option>
							{else}
								<option value="{$type.type_code}">{$type.type}</option>
							{/if}
						{/foreach}
					</select>
					<p class="align-right tip">(Beer, Rum, Whisky, ..)</p>				
				</div>
			</div>
		</div>	
	</div>
	
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-company" class="all-35 align-right">Company</label>
				<div class="control all-65">
					<input type="text" name="company" id="inline-company">
				</div>
			</div>
		</div>
	
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-alcohol_sub_type" class="all-45 align-right required">Alcohol Sub Type</label>
				<div class="control all-55">
					<select id="inline-alcohol_sub_type" name="alcohol_sub_type">
						<option value="">Choose one:</option> 
						{foreach $sub_types as $sub_type}
							{if $sub_type.sub_type_code|lower == $current_sub_type}
								<option value="{$sub_type.sub_type_code}" selected>{$sub_type.sub_type}</option>
							{else}
								<option value="{$sub_type.sub_type_code}">{$sub_type.sub_type}</option>
							{/if}
						{/foreach}
					</select>
					Other : <input type="text" name="other_sub_type" id="inline-other_sub_type">
					<p class="align-right tip">(Pale Lager, brown rum, ...)</p>				
				</div>
			</div>
		</div>
	</div>
	
	<div class="column-group quarter-gutters">
		<div class="control-group all-33 small-100 required">
			<div class="column-group quarter-gutters">
				<label for="inline-alcohol_degree" class="all-60 align-right">Alcohol Percentage (ABV)</label>
				<div class="control all-40">
					<input type="text" name="alcohol_degree" id="inline-alcohol_degree">
				</div>
			</div>
		</div>
		<div class="control-group all-33 small-100">
			<div class="column-group quarter-gutters">
				<label for="inline-year" class="all-35 align-right">Year</label>
				<div class="control all-65">
					<input type="text" name="year" id="inline-year">
				</div>
			</div>
		</div>
	</div>
	
	<div class="control-group all-33 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-image" class="all-35 align-right">Image</label>
			<div class="control all-65">
				<input type="file" name="image" id="inline-image">
				<input type="hidden" name="file_format" id="file_format" value="ok"/>
				<div id="preview_div"><img id="img_preview" width="200" src="#" alt="" /><div id="preview_error"></div></div>
			</div>
		</div>
	</div>
	
	<div class="control-group all-33 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-code" class="all-45 align-right">Captcha code <img title="Captcha" src="captcha.php" alt="Captcha" class="quarter-top-space"/></label>
			<div class="control all-55">
				<input type="text" name="code" id="inline-code">
				<p class="align-right tip">Please copy the Captcha code !</p>
			</div>
		</div>
	</div>
	
	<div class="control-group all-33 small-100">
		<div class="column-group quarter-gutters">
			<div class="control all-50">
				<input type="submit" class="ink-button blue" id="contactButton" value="Send" />
			</div>
			<div class="control all-50">
				<img id="loading" src="img/loading_s.gif" alt="working.." />
			</div>
		</div>
	</div>
	<div id="error" class="ink-alert basic error"></div>	
	</fieldset>
</form>

