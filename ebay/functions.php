<?php
/***************************
EBAY FUNCTIONS AND SUCH HERE
***************************/

/**
 * Queries eBay and returns the response body.
 * @param null $publisher_id
 * @param null $api_key
 * @param null $keywords
 * @param null $count
 * @param null $listing_type
 * @param null $category
 * @param null $min_price
 * @param null $max_price
 * @param null $global_id
 * @param null $alignment
 * @return mixed
 */
function searchEbay(
    $publisher_id=Null, $api_key=Null, $keywords=Null, $count=Null, $listing_type=Null,
    $category=Null, $min_price=Null, $max_price=Null, $global_id=Null, $alignment=Null)
{
  //$url = "http://httpbin.org/get";  # for debug mode
  $url = findItemsAdvancedQuery(
      $publisher_id,
      $api_key,
      $keywords,
      $count,
      $listing_type,
      $category,
      $min_price,
      $max_price,
      $global_id
  );
  $response = wp_remote_get($url);  # Sends the HTTP GET request to $url.
  return wp_remote_retrieve_body($response);  # Returns the response which is json.
}

/**
 * This function just makes URL we need to do the eBay search.
 * We are using FindItemsAdvanced from the Finding API.
 * http://developer.ebay.com/DevZone/finding/CallRef/findItemsAdvanced.html
 * @param $publisher_id
 * @param $api_key
 * @param $keywords
 * @param $count
 * @param $listing_type
 * @param $category
 * @param $min_price
 * @param $max_price
 * @param $global_id
 * @return string
 */
function findItemsAdvancedQuery(
  $publisher_id,
  $api_key,
  $keywords,
  $count,
  $listing_type,
  $category,
  $min_price,
  $max_price,
  $global_id
)
{
  $url = "http://svcs.ebay.com/services/search/FindingService/v1";
  $url .= "?OPERATION-NAME=findItemsAdvanced";
  $url .= "&SERVICE-VERSION=1.0.0";
  $url .= "&SECURITY-APPNAME=$api_key";
  $url .= "&RESPONSE-DATA-FORMAT=JSON";  # XML also works.
  $url .= "&REST-PAYLOAD";
  $url .= "&GLOBAL-ID=$global_id";
  $url .= "&keywords=" . urlencode($keywords);

  if(!is_null($category)){
    $url .= "&categoryId=$category";
  }

  $filter = 0;
  if (!is_null($min_price)) {
    $url .= "&itemFilter($filter).name=MinPrice";
    $url .= "&itemFilter($filter).value=$min_price";
    $filter += 1;
  }
  if (!is_null($max_price)) {
    $url .= "&itemFilter($filter).name=MaxPrice";
    $url .= "&itemFilter($filter).value=$max_price";
    $filter += 1;
  }

  if (!is_null($listing_type)) {
    $url .= "&itemFilter($filter).name=ListingType";
    $url .= "&itemFilter($filter).value=$listing_type";
    #$filter += 1;
  }

  $url .= "&paginationInput.entriesPerPage=$count";
  $url .= "&affiliate.networkId=9";
  $url .= "&affiliate.trackingId=$publisher_id";

  return $url;
}