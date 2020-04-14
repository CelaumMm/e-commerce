<?php

function filterItemsByStoreId($items, $storeId)
{
    array_filter($items, function($line) use($storeId){
        return $line['store_id'] == $storeId;
    });
}