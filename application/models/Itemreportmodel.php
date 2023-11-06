<?php

    ini_set('memory_limit', '-1');

class Itemreportmodel extends CI_Model
{
    public function __construct()
    {
        $this->table = 'category';
    }

    function getItemReport ($restaurant_id)
    {

       	$query = $this->db->query("select item_name, count(bill_head.invoice_no) as order_count , (select sum(bill_head.total) from bill_head where restaurant_id = $restaurant_id ) as total_bill, sum(kot_item.price) as 'total_price' , sum(bill_head.discount_amt) as discount_amount , sum(bill_head.tax_amt) as tax_amt ,sum(kot_item.price + bill_head.tax_amt ) as grand_total , category.created_date from bill_head left join kot_head on bill_head.Id= kot_head.bill_id left join kot_item on kot_head.Id = kot_item.kot_id left join items on kot_item.item_id = items.item_id left join category on category.category_id = items.cat_id where category.restaurant_id = $restaurant_id and bill_head.is_deleted = 0 Group by item_name");    
 		$result = $query->result_array();
        return $result;
        

     
	}
}