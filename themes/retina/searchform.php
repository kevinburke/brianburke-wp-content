<?php
$retina_s_value = ( get_search_query() )? get_search_query() : 'Search' ;
?>
<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label for="s" class="assistive-text">Search for:</label>
  <input type="text" class="field" name="s" id="s" value="<?php echo $retina_s_value; ?>"  onfocus="this.value=(this.value=='Search') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Search' : this.value;" />
  <input type="submit" class="submit" name="submit" id="searchsubmit" value="Search" />
  <div class="clear"></div>
</form>