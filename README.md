Title:  Ash_Onsale Extension  
Author: Peter McWilliams  
Email:  core@augustash.com  
Date:   February 6, 2013  

# Description

Adds easy way to show all on-sale products within the store.

Installation
------------

1. Clone module with [modman](https://github.com/colinmollenhour/modman)
2. Delete all contents of the Magento cache

## Example:

* For this module to do its job, you must specify the following layout update on 
  a category via the administration interface:

<reference name="category.products">
    <block type="ash_onsale/product_list" name="product_list" template="catalog/product/list.phtml">
        <block type="catalog/product_list_toolbar" name="product_list_toolbar" template="catalog/product/list/toolbar.phtml">
            <block type="page/html_pager" name="product_list_toolbar_pager"/>
        </block>
        <action method="setColumnCount"><columns>4</columns></action>
        <action method="setToolbarBlockName"><name>product_list_toolbar</name></action>
    </block>
</reference>

```
@copyright  Copyright (c) 2013 August Ash, Inc. (http://www.augustash.com)
```
