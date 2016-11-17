<?php
/**
 * Created by PhpStorm.
 * User: michal
 * Date: 26.07.16
 * Time: 15:35
 */
$categories = get_categories();
$query = get_query_var('query');
$checkedTerms = get_query_var('term');
if(isset($_POST['term'])){
$checkedTerms = $_POST['term'];
}
$selectedRange = get_query_var('time-range');
$customSearch = get_query_var('custom_search');
$timeLimit = array(
    0 => 'time',
    7 => 'last 7 days',
    30 => 'last 30 days',
    365 => 'last year',
);
?>
    <form action="<?php home_url(add_query_arg(array(),$wp->request)) ?>" method="get">
      <input type="hidden" name="s" value=""/>
      <input type="hidden" name="custom_search" value="1"/>
      <div class="search-component__search-area">
        <input type="text" value="<?php echo($query); ?>" name="query" placeholder="search"/>
      </div><!-- search-component__search-area -->
      <div class="search-component__select-area">

    <div class="multiselect">
        <div class="selectBox" onclick="showCheckboxes()">
            <select>
                <option><?php pll_e('Select type'); ?></option>
            </select>
            <div class="overSelect"></div>
        </div>
<?php 
$url = explode('/', add_query_arg(array(),$wp->request));
$categorySlug = $url[1];
?>
        <div id="checkboxes"
<?php 
if(!empty($categorySlug)){
?>
data-category-slug="
<?php 
echo $categorySlug;
?>
"
<?php
}

?>
>
        <?php
          foreach ($categories as $category) {
              ?>
              <div class="search-component__checkbox">
              <input type="checkbox" value="<?php echo($category->term_id) ?>"
              <?php
              if (is_array($checkedTerms) && !empty($checkedTerms)) {
                  if (in_array($category->term_id, $checkedTerms) ) {
                      ?>
                      checked="true"
                  <?php
                  }
              } elseif (empty($checkedTerms) && empty($customSearch)) {
                  ?>
                  checked="true"
              <?php
              }
 if ($category->slug === $categorySlug) {
                  ?>
                  checked="true"
              <?php
              }elseif($category->slug !== $categorySlug && !empty($categorySlug)){
?>
data-clear-checkbox="true"
<?php
}

          ?>
               name="term[]"><?php echo($category->name) ?>
          </div><!-- search-component__checkbox -->
          <?php
          }
          ?>
        </div><!-- checlboxes -->
    </div><!-- multiselect -->
          <div class="search-component__time">
            <select name="time-range" id="time-range">
            <?php
            foreach ($timeLimit as $key => $option) {
              ?>
              <option <?php
              if ($key == $selectedRange) {
                  ?>
                  selected="selected"
              <?php
              }
              ?> value="<?php echo($key); ?>"><?php echo($option); ?></option>
            <?php
            }
            ?>
            </select>
          </div><!-- search-component__time -->
          <a class="search-component__reset js-search-component__reset"><?php pll_e('reset'); ?></a>
					<input type="submit" value="<?php pll_e('submit'); ?>" id="search-component__submit" />
        </div><!-- search-component__select-area -->
                <!-- class="button button-blue search-component__reset js-search-component__reset" -->
                <!-- class="button button-transparent search-component__submit -->
          <!-- <input type="submit"/> -->
    </form>
      <?php

      ?>
