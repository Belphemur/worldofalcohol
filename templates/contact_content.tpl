{assign var='site_link' value='http://worldofalcohols.com'}
<script type="text/javascript" src="{$site_link}/js/contact.js"></script>

<header class="top-margin-5 hide-all show-large show-xlarge">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="index.php">World</a></li>
	<li class="active"><a href="#"><b>Contact</b></a></li>
	</ul>
	</nav>
</header>
<header class="top-margin-gap hide-all show-medium show-small show-tiny">     
<nav class="ink-navigation">
	<ul class="breadcrumbs red flat rounded shadowed">
	<li><a href="index.php">World</a></li>
	<li class="active"><a href="#"><b>Contact</b></a></li>
	</ul>
	</nav>
</header>

<h5> Please fill the following form to contact us! </h5>
<form id="contactForm" action="valid_contact.php" method="post" class="ink-form">	
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-name" class="all-35 align-right">Name</label>
			<div class="control all-65">
				<input type="text" name="name" id="inline-name">
			</div>
		</div>
	</div>	
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-mail" class="all-35 align-right">Email</label>
			<div class="control all-65">
				<input type="text" name="mail" id="inline-mail">
			</div>
		</div>
	</div>		
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-subject" class="all-35 align-right">Subject</label>
			<div class="control all-65">
				<input type="text" name="subject" id="inline-subject">
			</div>
		</div>
	</div>
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-message" class="all-35 align-right">Message</label>
			<div class="control all-65">
				<textarea name="message" id="inline-message" rows="7" cols="50"></textarea>
			</div>
		</div>
	</div>	
	<div class="control-group all-50 small-100 required">
		<div class="column-group quarter-gutters">
			<label for="inline-code" class="all-45 align-right">Captcha code <img title="Captcha" src="captcha.php" alt="Captcha" class="quarter-top-space"/></label>
			<div class="control all-55">
				<input type="text" name="code" id="inline-code">
				<p class="align-right tip">Please copy the Captcha code !</p>
			</div>
		</div>
	</div> 
	<div class="control-group all-50 small-100">
		<div class="column-group quarter-gutters">
			<div class="control all-50">
				<input type="submit" class="ink-button blue" id="contactButton" value="Send" />
			</div>
			<div class="control all-50">
				<img id="loading" src="img/loading_s.gif" alt="working.." />
			</div>
		</div>
	</div>
</form>

<div id="error" class="ink-alert basic error"></div>