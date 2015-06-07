<?php
/***************************
EBAY FUNCTIONS AND SUCH HERE
***************************/

/**
 * Queries eBay and returns the response body.
 */
function searchEbay($query)
{
  $response = wp_remote_get($query);  # Sends the HTTP GET request to $url.
  return wp_remote_retrieve_body($response);  # Returns the response which is a json str.
}

/**
 * This function just makes URL we need to do the eBay search.
 * We are using FindItemsAdvanced from the Finding API.
 * http://developer.ebay.com/DevZone/finding/CallRef/findItemsAdvanced.html
 * @param $shortcode all the params in an array
 * @return string
 */
function findItemsAdvancedQuery($publisher_id, $api_key, $shortcode)
{
  // Basics
  $url = "http://svcs.ebay.com/services/search/FindingService/v1";
  $url .= "?OPERATION-NAME=findItemsAdvanced";
  $url .= "&SERVICE-VERSION=1.0.0";
  $url .= "&SECURITY-APPNAME=$api_key";
  $url .= "&RESPONSE-DATA-FORMAT=JSON";  # XML also works.
  $url .= "&REST-PAYLOAD";
  $url .= "&GLOBAL-ID=" . $shortcode['global_id'];
  $url .= "&keywords=" . urlencode($shortcode['keywords']);
  if(!is_null($shortcode['categories'])){
    $url .= "&categoryId=" . $shortcode['categories'];
  }

  // Item filters
  $filter = 0;

  if(!is_null($shortcode['condition'])){
    if($shortcode['condition'] == "new") {
      $url .= "&itemFilter($filter).name=Condition";
      $url .= "&itemFilter($filter).value=New";
      $filter += 1;
    }elseif($shortcode['condition'] == "used"){
      $url .= "&itemFilter($filter).name=Condition";
      $url .= "&itemFilter($filter).value=Used";
      $filter += 1;
    }# no else because it defaults to new and used..
  }

  if(!is_null($shortcode['exclude_category'])){
    $categories = explode(',', $shortcode['exclude_category']);
    $url .= "&itemFilter($filter).name=ExcludeCategory";
    $value = 0;
    foreach($categories as $category){
      $url .= "&itemFilter($filter).value[$value]=$category";
      $value += 1;
    }
    $filter += 1;
  }

  if(!is_null($shortcode['exclude_seller'])){
    $sellers = explode(',', $shortcode['exclude_seller']);
    $url .= "&itemFilter($filter).name=ExcludeSeller";
    $value = 0;
    foreach($sellers as $seller){
      $url .= "&itemFilter($filter).value[$value]=$seller";
      $value += 1;
    }
    $filter += 1;
  }

  if (!is_null($shortcode['free_shipping'])) {
    $url .= "&itemFilter($filter).name=FreeShippingOnly";
    $url .= "&itemFilter($filter).value=true";
    $filter += 1;
  }

  if (!is_null($shortcode['fixed_price'])) {
    $url .= "&itemFilter($filter).name=ListingType";
    $url .= "&itemFilter($filter).value=true";
    $filter += 1;
  }

  if (!is_null($shortcode['min_price'])) {
    $url .= "&itemFilter($filter).name=MinPrice";
    $url .= "&itemFilter($filter).value=" . $shortcode['min_price'];
    $filter += 1;
  }

  if (!is_null($shortcode['max_price'])) {
    $url .= "&itemFilter($filter).name=MaxPrice";
    $url .= "&itemFilter($filter).value=" . $shortcode['max_price'];
    $filter += 1;
  }

  if (!is_null($shortcode['outlet_only'])) {
    $url .= "&itemFilter($filter).name=OutletSellerOnly";
    $url .= "&itemFilter($filter).value=true";
    $filter += 1;
  }

  if(!is_null($shortcode['sellers'])){
    $categories = explode(',', $shortcode['sellers']);
    $url .= "&itemFilter($filter).name=Seller";
    $value = 0;
    foreach($categories as $category){
      $url .= "&itemFilter($filter).value[$value]=$category";
      $value += 1;
    }
    #$filter += 1;
  }

  // Pagination
  $url .= "&paginationInput.entriesPerPage=" . $shortcode['count'];

  // Affiliates
  $url .= "&affiliate.networkId=9";
  $url .= "&affiliate.trackingId=$publisher_id";

  return $url;
}


/**
 * Takes a response from the eBay Finding::findItemsAdvanced API and returns HTML (<ul>).
 * @param $response     json String
 * @param $hide_title   boolean
 * @return string       HTML <ul><li>item</li>...</ul>
 */
function ebayResponseToHTML($response, $hide_title){

  $json = json_decode($response, True);
  if ($json['findItemsAdvancedResponse'][0]['ack'][0] != "Success") {
    return Null;
  }
  if (count($json['findItemsAdvancedResponse'][0]['searchResult'][0]['item']) < 1) {
    return Null;  # TODO: Is this the correct way to detect an empty result?
  }

  # If we're still here then the eBay response has items we can use.
  $li = "";
  foreach ($json['findItemsAdvancedResponse'][0]['searchResult'][0]['item'] as $r) {
    $title = ($hide_title)?'':$r['title'][0];
    $link = $r['viewItemURL'][0];
    $img = $r['galleryURL'][0];
    $price = $r['sellingStatus'][0]['currentPrice'][0]['__value__'];
    $li .= "<li><a href='$link'>$title <img src='$img' /> $price</a></li>";
  }

  # TODO: Should we check for errors and return Null or an empty str?
  return $html = "<ul class='s64-ebay-slider'>$li</ul>";;
}


/**
 * Anything but "true" returns false.
 * @param $var
 * @return bool
 */
function init_bool($var){
  if(!is_null($var)){
    if($var == "true"){
      return True;
    }else{
      return False;
    }
  }else{
    return False;
  }
}