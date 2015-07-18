## s64-ebay
The SUPER64 Wordpress Ebay plugin!

This is a free WordPress plugin which makes it easy to display eBay listings on your blog. Fully compatible with the eBay Partner Network.

If you include our very simple shortcode in a blog post then the user will see a *widget* showing eBay listings.

Specify your eBay Partner Network publisher id on the plugin configuration page and all eBay links become roverised. You earn a commission on any sales from traffic you refer to eBay.

## Demo website
http://wpepn.super64.net/

## Code Example

    [s64-ebay keywords="galaxy s4" min_price=50 max_price=500 count=12 category=9355]

## Motivation

The best way to get data on eBay listings is to use an eBay API called FindItemsAdvanced. If you aren't a software developer then you can't use it. Since any one can run a Wordpress blog and anyone can link to eBay it seamed strange that it should be so difficult. Other plugins either don't work well or their developers want a share of your commission from eBay Partner Network.

We wanted a simple solution which **anyone** can use. The shortcode is straight forward and is typed right into a posts text area. You keep 100% of the commission. You just concentrate on running a great website.

## Installation

1. Download the latest release (.zip file): https://github.com/Super64/wordpress-ebay/releases/download/v0.2-beta/super64_wordpress_ebay_v2b.zip
1. Log into WordPress, go to the Plugins page and click "Add New".
1. Click "Upload Plugin" and choose the .zip file you just downloaded.
1. Then once it's uploaded just click the "Activate" link.
1. Create a new post, paste in this shortcode and finally preview the post:

    [s64-ebay keywords="lego" count=12]

You should see Lego for sale on eBay!

## S64-EPN Shortcode Parameters ##

|#|Parameter|Type|Default|Description|  
|-------------|-------------|-------------|-------------|:-------------|
|1|global_id|string|'EBAY-GB'|Specify an eBay website by it's global id. Defaults to ebay.co.uk.|
|2|keywords|string|get_title()|We search eBay with these! Example "intel i5 cpu", 350 characters max|
|3|count|int|3|The number of items to display, 100 max|
|4|hide_title|true or false|false|Hides the eBay item title|
|5|categories|comma separated values|null|Only items from these categories. Maximum of 3.|
|6|condition|new or used|null|New items, second hand items or leave empty for both.|
|7|exclude_category|comma separated values|null|Excludes items in these categories. Example: '168093,168094,168095'|
|8|exclude_seller|comma separated values|null|Excludes items from these sellers. Example: 'seller01,seller02,seller03'|
|9|free_shipping|true or false|false|Only items with free delivery as an option.|
|10|fixed_price|true or false|false|Only include items with an option to purchase for a fixed price (BuyItNow).|
|11|min_price|decimal|null|Ignore items cheaper than this price.|
|12|max_price|decimal|null|Ignore items more expensive than this price. Example 99.95 (no symbol)|
|13|outlet_only|true or false|false|Only include items from eBay outlet sellers.|
|14|sellers|comma separated values|null|Only items from these sellers. Example 'seller01,seller02,seller03'.|
|15|top_rated|true or false|false|True for items where the seller qualifies as a top-rated seller.|
|16|min_feedback|int|null|Returns items from sellers with a feedback score greater than this value. A value of 50 would exclude very new sellers.|
|17|max_feedback|int|null|Returns items from sellers with a feedback score less than this value. A value of 150 would exclude the larger power sellers.|

## Screen grabs
![argos laptops](http://i.imgur.com/v9gSYli.png)
![lego espana](http://i.imgur.com/cWwxnja.png)

## License

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
