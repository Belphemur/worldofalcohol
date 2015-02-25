{assign var='site_link' value='http://worldofalcohols.com'}

<header class="top-margin-5 hide-all show-large show-xlarge">
    <nav class="ink-navigation">
        <ul class="breadcrumbs red flat rounded shadowed">
            <li><a href="index.php">World</a></li>
            <li><a href="{$place.country_code}-alcohols">{$place.country}</a></li>
            {* <li><a href="{$site_link}">{$alcohol.type}</a></li> *}
            <li class="active"><a href="#"><b>{$place.name}</b></a></li>
        </ul>
    </nav>
</header>
<header class="top-margin-gap hide-all show-medium show-small show-tiny">
    <nav class="ink-navigation">
        <ul class="breadcrumbs red flat rounded shadowed">
            <li><a href="index.php">Home</a></li>
            <li><a href="{$place.country_code}-alcohols">{$place.country}</a></li>
            {* <li><a href="{$site_link}">{$alcohol.type}</a></li> *}
            <li class="active"><a href="#"><b>{$place.name}</b></a></li>
        </ul>
    </nav>
</header>

{literal}
<script type="text/javascript">
$( document ).ready(function() {

$("#rating_options input[name='rb']").click(function () {
$("#rating_options input[name='rb']").each(function(i) {
$(this).attr('disabled', 'disabled');
});
rateAlcohol($(this).attr("rel"), $(this).attr("value"));
});

function rateAlcohol(place_id, value) {
var req_ratePlace = $("#my-progress-bar").attr("data-req-id");
var request = $.ajax({
url: "req_ratePlace.php?action=create&req_ratePlace="+req_ratePlace+"",
type: "POST",
data: { 'place_id': place_id, 'value': value },
dataType: 'json',
success: function (res) {
if(res.result == "OK") {
$('#rating_options').html("<div class='ink-alert basic success'>Thanks for rating! </div>");
}
else
{
$('#rating_options').html("<div class='ink-alert basic error'>" + res.msg + "</div>");
}
}
});
};

});

</script>
{/literal}

<div class="column-group gutters">
    <div class="xlarge-20 large-20 medium-30 small-100">
        <figure class="ink-image">
            <img width="200" src="places_mini/{$place.image|getJPEG}" alt="" class="imagequery">
            <figcaption class="dark over-bottom">{$place.name}</figcaption>
        </figure>
        <a href="checkin.php?place={$place.name_code}" class="ink-button green half-top-space">Check in</a>
    </div>
    <div class="xlarge-45 large-45 medium-60 small-100" style="margin: 0.5em">
        {dynamic}
        <div class="small-100">
            <h3 id="country_name" rel="{$place.country}" data="{$place.city}, {$place.country}" data-req-id="{$nonce.req_alcByCountryCity_id}">{$place.name}</h3>
            {/dynamic}
            Description: {$place.description}<br>
            Type: {$place.type}<br>
            Address: {$place.address}<br>
            Location: {$place.city}, {$place.country}<br><br>

            Tel: {$place.telephone}<br>
            Opening Hours: {$place.opening_hours}<br>

        </div>
        <br>
        <span class='st_pinterest_hcount' displayText='Pinterest'></span>
        <span class='st_twitter_hcount' displayText='Tweet'></span>
        <span class='st_googleplus_hcount' displayText='Google +'></span>
        <span class='st_facebook_hcount' displayText='Facebook'></span>
        <span class='st_reddit_hcount' displayText='Reddit'></span>
        <div class="small-100" id="visualization"></div>

        {* Alcohols from this bar *}
        {if $place_alcohols|count > 0}
            <h4>Alcohols from {$place.name} </h4>
            <div class="column-group gutters">
                {foreach $place_alcohols as $alcohol_item}
                    <div class="xlarge-20 large-20 medium-25 small-25">
                        <a href="{$alcohol_item.name_code}_{$alcohol_item.country_code}-{$alcohol_item.type_code}">
                            <figure class="ink-image">
                                <img width="140" src="{$site_link}/mini/{$alcohol_item.image|getJPEG}" alt="" class="imagequery">
                                <figcaption class="dark over-bottom">{$alcohol_item.name}</figcaption>
                            </figure></a>
                    </div>
                {/foreach}
            </div>
        {/if}

    </div>
    <div class="xlarge-30 large-30 medium-50 small-100">
        <form class="ink-form">
            <fieldset>
                <legend>Rate this {$place.type|strtolower|ucfirst}</legend>
                {dynamic}
                    <div id="my-progress-bar" class="ink-progress-bar grey" data-req-id="{$nonce.req_ratePlace}" data-start-value="{$rating.value}">
                        <span class="caption">{$rating.value} ({$rating.total} Ratings)</span>
                        {if $rating.value > 10 }
                            <div class="bar green"></div>
                        {elseif $rating.value > 0}
                            <div class="bar orange"></div>
                        {else}
                            <div class="bar red"></div>
                        {/if}
                    </div>
                {/dynamic}
                <div class="control-group">
                    <p class="label">Been to this {$place.type|strtolower|ucfirst} already? Let us know your opinion</p>
                    <div id="rating_options">
                        <ul class="control unstyled">
                            <li class="tip" data-tip-text="+2" data-tip-where="up" data-tip-color="green"><input type="radio" id="rb1" name="rb" rel="{$place.id}" value="2"><label for="rb1" class="rating_option"><b>Awesome {$place.type|strtolower|ucfirst} !</b></label></li>
                            <li class="tip" data-tip-text="+1" data-tip-where="up" data-tip-color="green"><input type="radio" id="rb2" name="rb" rel="{$place.id}" value="1"><label for="rb2" class="rating_option"><b>Great {$place.type|strtolower|ucfirst} to have fun</b></label></li>
                            <li class="tip" data-tip-text="ok" data-tip-where="up" data-tip-color="orange"><input type="radio" id="rb3" name="rb" rel="{$place.id}" value="0"><label for="rb3" class="rating_option"><b>Good memories from this place</b></label></li>
                            <li class="tip" data-tip-text="-1" data-tip-where="up" data-tip-color="red"><input type="radio" id="rb4" name="rb" rel="{$place.id}" value="-1"><label for="rb4" class="rating_option"><b>Still OK if no other choices</b></label></li>
                            <li class="tip" data-tip-text="-2" data-tip-where="up" data-tip-color="red"><input type="radio" id="rb5" name="rb" rel="{$place.id}" value="-2"><label for="rb5" class="rating_option"><b>I will avoid this place next time</b> !</label></li>
                        </ul>
                    </div>
                </div>
            </fieldset>
        </form>
        <div class="ink-alert basic warning all-100">
            <h5>Do you know any other alcohol from {$place.name} ? Feel free to share it with us </h5>
            <a href="submit.php?place={$place.name_code}" class="ink-button green">Submit alcohol from this {$place.type|strtolower|ucfirst}</a>
        </div>
    </div>
</div>

{* Popular Alcohols *}
{if $place_alcohols|count > 0}
    <h3><i class='icon-trophy'></i> Popular Alcohols from {$place.name} </h3>
    <div class="column-group gutters">
        {foreach $place_alcohols as $alcohol_item}
            <div class="xlarge-10 large-10 medium-15 small-25">
                <a href="{$alcohol_item.name_code}_{$alcohol_item.country_code}-{$alcohol_item.type_code}">
                    <figure class="ink-image">
                        <img width="140" src="{$site_link}/mini/{$alcohol_item.image|getJPEG}" alt="" class="imagequery">
                        <figcaption class="dark over-bottom">{$alcohol_item.name}</figcaption>
                    </figure></a>
            </div>
        {/foreach}
    </div>
{/if}

{* Needed for the Rating bar*}
<script>
    Ink.requireModules( ['Ink.UI.ProgressBar_1'], function(ProgressBar){
        var myProgressBar = new ProgressBar( '#my-progress-bar' );
    });
</script>
{* Needed for tooltip*}
<script>
    Ink.requireModules( ['Ink.UI.Tooltip_1'], function( Tooltip ){
        var Tooltip = new Tooltip( '#rating_options .tip');
    });
</script>
