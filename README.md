## Synopsis

Super 64 Ebay plugin (EXPLAIN MORE)

## Code Example

[s64-ebay width="100" height="100" items="4" max_price="100" min_price="10" bin="yes"]

## Motivation

A short description of the motivation behind the creation and maintenance of the project. This should explain **why** the project exists.

## Installation

Provide code examples and explanations of how to get the project.

## S64-EPN Shortcode Parameters ##
|Parameter|Type|Default|Description|
|-|-|-|:-|
|global_id|string|'EBAY-GB'|Specify an eBay website by it's global id. Defaults to ebay.co.uk.|
|keywords|string|get_title()|We search eBay with these! Example "intel i5 cpu", 350 characters max|
|count|int|3|The number of items to display, 100 max|
|alignment|string|'horizontal'|horizontal, vertical or null. That's 1 item high, wide or no styling.|
|hide_title|true or false|false|Hides the eBay item title|
|thumbnail|80 or 140|80|The x,y size of the thumbnail image.|
|currency|iso code|'gbp'|The currency you want for item prices.|
|-|-|-|-|
|best_offer|true or false|false|True for only items that have Best Offer enabled.|
|charity|true or false|false|True for only items raising money for charity.|
|condition|new or used|null|New items, second hand items or leave empty for both.|
|exclude_category|comma separated values|null|Excludes items in these categories. Example: '168093,168094,168095'|
|exclude_seller|comma separated values|null|Excludes items from these sellers. Example: 'seller01,seller02,seller03'|
|max_feedback|int|null|Only items from sellers with up to this much feedback.|
|free_shipping|true or false|false|Only items with free delivery as an option.|
|hide_duplicates|true or false|true|Items with identical titles from the same seller and same listing type are ignored for greater variety.|
|fixed_price|true or false|false|Only include items with an option to purchase immediately for a fixed price instead of bidding.|
|pickup|true or false|false|True for only items which have local pickup available.|
|max_bids|int|null|Only items with up to this many bids.|
|max_price|decimal|null|Ignore items more expensive than this price. Example 99.95 (no symbol)|
|max_quantity|int|null|Only items with this many in stock.|
|min_bids|int|null|Ignore items with less than this many bids.|
|min_price|decimal|null|Ignore items cheaper than this price.|
|min_quantity|int|null|Ignore items with less than this many in stock.|
|outlet_only|true or false|false|Only include items from eBay outlet sellers.|
|returns_accepted|true or false|false|True for only items you can return.|
|sellers|comma separated values|null|Only items from these sellers. Example 'seller01,seller02,seller03'.|
|categories|comma separated values|null|Only items from these categories.|


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
