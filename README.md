## Synopsis

Super 64 Ebay plugin (EXPLAIN MORE)

## Code Example

[s64-ebay width="100" height="100" items="4" max_price="100" min_price="10" bin="yes"]

## Motivation

A short description of the motivation behind the creation and maintenance of the project. This should explain **why** the project exists.

## Installation

Provide code examples and explanations of how to get the project.

## S64-EPN Shortcode Parameters ##
|#|Parameter|Type|Default|Description|
|-|-|-|-|:-|
|1|global_id|string|'EBAY-GB'|Specify an eBay website by it's global id. Defaults to ebay.co.uk.|
|2|keywords|string|get_title()|We search eBay with these! Example "intel i5 cpu", 350 characters max|
|3|count|int|3|The number of items to display, 100 max|
|4|hide_title|true or false|false|Hides the eBay item title|
|5|categories|comma separated values|null|Only items from these categories. Maximum of 3.|
|6|condition|new or used|null|New items, second hand items or leave empty for both.|
|7|exclude_category|comma separated values|null|Excludes items in these categories. Example: '168093,168094,168095'|
|8|exclude_seller|comma separated values|null|Excludes items from these sellers. Example: 'seller01,seller02,seller03'|
|9|free_shipping|true or false|false|Only items with free delivery as an option.|
|10|fixed_price|true or false|false|Only include items with an option to purchase immediately for a fixed price instead of bidding.|
|11|min_price|decimal|null|Ignore items cheaper than this price.|
|12|max_price|decimal|null|Ignore items more expensive than this price. Example 99.95 (no symbol)|
|13|outlet_only|true or false|false|Only include items from eBay outlet sellers.|
|14|sellers|comma separated values|null|Only items from these sellers. Example 'seller01,seller02,seller03'.|
|15|top_rated|true or false|false|True for items where the seller qualifies as a top-rated seller.|
|16|min_feedback|int|null|Returns items from sellers with a feedback score greater than this value. A value of 20 would exclude very new sellers.|
|17|max_feedback|int|null|Returns items from sellers with a feedback score less than this value. A value of 150 would exclude the larger power sellers.|
|18|buy_now|true or false|false|Ignore auctions and show only "BuyItNow" items.|

## License

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
