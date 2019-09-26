<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-02-12 20:06:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ''move_product_id' AS productuniqueid_forimages,
             c.`name` AS cat_nam' at line 3 - Invalid query: SELECT a.*, 
             b.id AS productid, b.`name` AS productname, b.`main_image` AS productimage, 
             b.`price` AS product_price, b.`tax` AS product_tax, b.`description` AS product_description, b.'move_product_id' AS productuniqueid_forimages,
             c.`name` AS cat_name, c.`image` AS cat_image, d.`name` AS subcat_name, d.`image` AS subcat_image
             FROM warehouse_products a INNER JOIN products b ON a.product=b.`id` INNER JOIN category c ON b.`category_id` = c.`category_id` LEFT JOIN category d 
ON b.`sub_category_id` = d.`category_id` WHERE a.`warehouse` = 1  ORDER BY c.`name`, d.`name`
ERROR - 2019-02-12 21:20:17 --> Query error: Not unique table/alias: 'b' - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
INNER JOIN customers b ON a.customer_id=b.`id`
INNER JOIN tb_shippingaddress b ON a.shipping_addressid=c.`id`
WHERE a.`user_id` =2 ORDER BY a.`id` DESC
ERROR - 2019-02-12 21:20:42 --> Query error: Unknown column 'c.id' in 'on clause' - Invalid query: SELECT a.*, 
b.id AS customerid,b.`first_name` AS customer_firstname, b.`last_name` AS customer_lastname, b.`phone` AS customer_phone,
c.`address_name` AS shipping_addressname, c.`address_location` AS shipping_addresslocation, c.`address_lat` AS shipping_addresslat, c.`address_lng` AS shipping_addresslng
FROM orders a 
INNER JOIN customers b ON a.customer_id=b.`id`
INNER JOIN tb_shippingaddress c ON a.shipping_addressid=c.`id`
WHERE a.`user_id` =2 ORDER BY a.`id` DESC
