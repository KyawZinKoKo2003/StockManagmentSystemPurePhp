<?php 
require 'init.php';
query(
    'delete from category'
);
query(
    'alter table category auto_increment=1'
);
query('
    delete from product
');
query('
    alter table product auto_increment=1
');
$category=['Drink','Electronic','Hat','Shirt'];
foreach($category as $c){
    query(
        'insert into category (slug,name) value( ? ,? )',
        [slug($c),$c]
    );
}
query('
delete from product_buy');
query('delete from product_sale');
query('
    alter table product_buy auto_increment=1'
);
query('
    alter table product_sale auto_increment=1
');