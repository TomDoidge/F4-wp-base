<?php
// Setting the style for of the default sidebar search field
?>
 <form action="<?php echo home_url(); ?>" id="searchform" method="get">
  <div class="row">
    <div class="large-12 columns">
      <div class="row collapse">
        <div class="small-9 columns">
          <input type="text" placeholder="Search here" value="" name="s" id="s">
        </div>
        <div class="small-3 columns">
        <input type="submit" id="searchsubmit" value="Search" class="button prefix" />
        </div>
      </div>
    </div>
</form>