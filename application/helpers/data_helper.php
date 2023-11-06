<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}


/** 
 * link the css files 
 * @param array $array
 * @return print css links
 */
if (!function_exists('load_css')) { //checked
    function load_css(array $array) {
        foreach ($array as $uri) {
            if (strpos($uri, 'http') !== false) {
                echo "<link rel='stylesheet' type='text/css' href='" . $uri . "?i=". time()."' />\n";
            } else {
                echo "<link rel='stylesheet' type='text/css' href='" . base_url($uri) . "?i=" . time() . "' />\n";
            }
        }
    }
}

/**
 * link the javascript files 
 * 
 * @param array $array
 * @return print js links
 */
if (!function_exists('load_js')) {
    function load_js(array $array) {
        foreach ($array as $uri) {
            if (strpos($uri, 'http') !== false) {
                echo "<script type='text/javascript'  src='" . $uri . "?i=" . time() . "'></script>\n";
            }else{
                echo "<script type='text/javascript'  src='" . base_url($uri) . "?i=". time()."'></script>\n";
            }
        }
    }
}

if (!function_exists('is_exists')) {
    function is_exists($where, $table_name, $id = 0, $fldname = "id")
    {
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select($fldname);
        $ci->db->from($table_name);
        $ci->db->where($where);
        if ($id > 0) {
            $ci->db->where($fldname.' !=', $id);
        }
        $queryone    = $ci->db->get();
        $rows       = $queryone->num_rows();
        return $rows;
    }
}
if (!function_exists('getData')) {
    function getData($table_name, $restaurant_id = 0, $fldname = "id", $id = -1)
    {
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select('*');
        $ci->db->from($table_name);
        $ci->db->where('is_deleted', 0);
        if($restaurant_id > 0){
            $ci->db->where('restaurant_id', $restaurant_id);
        }
        if ($id != -1) {
            $ci->db->where($fldname, $id);
        }
        $queryone   = $ci->db->get();
        if ($id > 0) {
            $result    = $queryone->row_array();
        }else{
            $result    = $queryone->result_array();
        }
        return $result;
    }
}


if (!function_exists('getRestaurant')){
    function getRestaurant(){
        $ci=& get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT * FROM restaurant WHERE is_deleted =0");
        $query = $query->result_array();
        if( is_array( $query ) && count( $query ) > 0 ){
            $return[''] = '--Select Restaurant--';
            foreach($query as $row){
                $return[$row['restaurant_id']] = $row['restaurant_name'].' - '.$row['restaurant_address'];
            }
        }
        return $return;
    }
}

if (!function_exists('getCategory')){
    function getCategory($rid=''){
        $ci=& get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT * FROM category WHERE is_deleted = 0 AND restaurant_id=".$rid);
        $query = $query->result_array();
        if( is_array( $query ) && count( $query ) > 0 ){
            $return[''] = '--Select category--';
            foreach($query as $row){
                $return[$row['category_id']] = $row['category'];
            }
        }
        return $return;
    }
}

if (!function_exists('getUnit')){
    function getUnit(){
        $ci=& get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT * FROM master_unit");
        $query = $query->result_array();
        if( is_array( $query ) && count( $query ) > 0 ){
            $return[''] = '--Select Unit--';
            foreach($query as $row){
                $return[$row['id']] = $row['units'];
            }
        }
        return $return;
    }
}

if (!function_exists('getRawmaterial')){
    function getRawmaterial($restaurant_id){
        $ci=& get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT rm.rawmaterial_id, rm.rawmaterial, u.units FROM rawmaterial rm left join master_unit u on u.id = rm.unit WHERE rm.is_deleted = 0 AND rm.restaurant_id=".$restaurant_id);
        $query = $query->result_array();
        if( is_array( $query ) && count( $query ) > 0 ){
            $return[''] = array('' =>'--Select Raw Material --');
            foreach($query as $row){
                $return[$row['rawmaterial_id']] = array($row['units'] => $row['rawmaterial']);
            }
        }
        return $return;
    }
}

if (!function_exists('convertDate')){
    function convertDate($date, $to='mysql'){
        
        if($date){
            if($to=='mysql'){
                // $format = 'd-m-Y';
                // $date = DateTime::createFromFormat($format, $date)->format('Y-m-d');
                $date=$date;
            }if($to=='user'){
                $format = 'Y-m-d';
                $date = DateTime::createFromFormat($format, $date)->format('d-m-Y');
            }
        }
        return $date;
    }
}


/* Get list of Modules */
if (!function_exists('getModules')) {
    function getModules()
    {
        $result = array();
        $ci = &get_instance();
        $ci->load->database();

        $ci->db->select('*');
        $ci->db->from('master_modules');
        $ci->db->where('to_show',1);
        $ci->db->where('is_deleted',0);
        $ci->db->where('parent_id',0);
        $ci->db->order_by('sort_id', 'ASC');
        $query      = $ci->db->get();
        $result = $query->result_array();
        return $result;
    }
}

/* Get User Groups of Particular User */
if (!function_exists('getUserGroupByUserId')) {
    function getUserGroupByUserId($user_id)
    {

        // SELECT GROUP_CONCAT(mm.classname) as cls FROM user_group ug left join groups g on g.id = ug.group_id left join master_modules mm on FIND_IN_SET(mm.id,g.permission) where ug.user_id = 2
        //SELECT GROUP_CONCAT(mm.classname) as classname FROM master_modules mm where FIND_IN_SET(id,'1,2,3')
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select('GROUP_CONCAT(mm.classname) as permission');
        $ci->db->from('user_group ug');
        $ci->db->join('groups g','g.id = ug.group_id', 'left');
        $ci->db->join('master_modules mm','FIND_IN_SET(mm.id, g.permission)',"left",false);
        $ci->db->where('ug.user_id',$user_id);
        $query  = $ci->db->get();
        // echo $ci->db->last_query();
        $result = $query->row_array();
        return $result;
    }
}

/* Get User Groups of Particular User */
if (!function_exists('getExpenseData')) {
    function getExpenseData($table_name, $restaurant_id, $cash_type, $id)
    {
        $result = array();
        $ci = &get_instance();
        $ci->load->database();

        $ci->db->select('e.*, au.username, (CASE
            WHEN e.cash_type = "I" THEN "Cash In"
            WHEN e.cash_type = "O" THEN "Cash Out"
        END) As ctype');
        $ci->db->from($table_name.' e');
        $ci->db->join('admin_users au','au.id = e.user_id', 'left');
        $ci->db->where('e.is_deleted',0);
        $ci->db->where('e.restaurant_id',$restaurant_id);
        if($cash_type){
            $ci->db->where('e.cash_type', $cash_type);
        }
        if($id){
            $ci->db->where('e.expense_id', $id);
        }
        $query  = $ci->db->get();
        // $result = $query->result_array();
        if ($id > 0) {
            $result    = $query->row_array();
        }else{
            $result    = $query->result_array();
        }
        return $result;
    }
}


if(!function_exists('getINAmount')){
    function getINAmount($restaurant_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('sum(amount) as CashInAmount');
        $ci->db->from('cash_flow');
        $ci->db->where('restaurant_id', $restaurant_id);
        $ci->db->where('flow',0);
        $ci->db->where('cash_type','I');
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;
    }
}
if(!function_exists('getOUTAmount')){
    function getOUTAmount($restaurant_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('sum(amount) as CashOUTAmount');
        $ci->db->from('cash_flow');
        $ci->db->where('restaurant_id', $restaurant_id);
        $ci->db->where('flow',0);
        $ci->db->where('cash_type','O');
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;
    }

}

if(!function_exists('getINAmountBYBILL')){
    function getINAmountBYBILL($restaurant_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('sum(grand_total) as BillAmountTotal');
        $ci->db->from('bill_head');
        $ci->db->where('restaurant_id', $restaurant_id);
        $ci->db->where('status',"BillPaid");
        $ci->db->where('is_deleted',0);
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;
    }
}


// for Bank  start
if(!function_exists('getBANKINAmount')){
    function getBANKINAmount($restaurant_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('sum(amount) as CashBANKInAmount');
        $ci->db->from('cash_flow');
        $ci->db->where('restaurant_id', $restaurant_id);
        $ci->db->where('flow',1);
        $ci->db->where('cash_type','I');
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;
    }
}

if(!function_exists('getBANKOUTAmount')){
    function getBANKOUTAmount($restaurant_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('sum(amount) as CashBANKOUTAmount');
        $ci->db->from('cash_flow');
        $ci->db->where('restaurant_id', $restaurant_id);
        $ci->db->where('flow',1);
        $ci->db->where('cash_type','O');
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;
    }
}

/* Get User Groups of Particular User */
if (!function_exists('getGroupData')) {
    function getGroupData($groupId = null)
    {
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        
        $ci->db->select('*');
        $ci->db->from('groups');

        if(! is_null($groupId)) {
            if($groupId == 0){
                $groupId = 1;
                $where = "id != 1";
            }else{
                $where = "id = $groupId";
            }
            $ci->db->where($where);
        }
        $query  = $ci->db->get();
        $result = $query->result_array();
        return $result;
    }
}

if (!function_exists('getPaymentType')){
    function getPaymentType(){
        $ci=& get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT * FROM master_payment_type");
        $query = $query->result_array();
        if( is_array( $query ) && count( $query ) > 0 ){
            $return[''] = '--Select Payment Type--';
            foreach($query as $row){
                $return[$row['id']] = $row['ptype'];
            }
        }
        return $return;
    }
}



if (!function_exists('getPaymentTypeRestaurant')){
    function getPaymentTypeRestaurant($restaurant_id){
        $ci=& get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT DISTINCT payment_type FROM bill_head where restaurant_id = $restaurant_id ");
        $query = $query->result_array();
        if( is_array( $query ) && count( $query ) > 0 ){
            $return[''] = '--Select Payment Type (All) --';
            foreach($query as $row){
                $return[$row['payment_type']] = $row['payment_type'];
            }
        }
        return $return;
    }
}



if (!function_exists('getTableData')){
    function getTableData($restaurant_id = 0,$table_id = 0)
    {
        $ci=& get_instance();
        $ci->load->database();
        $data = array();
        $ci->db->select('*,now() as last_checked_data');
        $ci->db->from('tables');
        $ci->db->where('is_deleted',0);
        if($restaurant_id > 0 ) $ci->db->where('restaurant_id',$restaurant_id);
        if($table_id > 0 ) $ci->db->where('table_id',$table_id);
        $query  = $ci->db->get();
        $result = $query->result_array();
        foreach($result as $res){
            if($res['ord_status'] != '' && $res['ord_status'] != 'KitchenReject'){
                $ci->db->select('*');
                $ci->db->from('bill_head');
                $ci->db->where('table_id',$res['table_id']);
                $ci->db->where('is_active',1);
                $ci->db->order_by('Id','DESC');
                $ci->db->limit(1);
                $query1  = $ci->db->get();
                $result1 = $query1->result_array();
                if(count($result1) > 0 ){
                    $diff = strtotime(date('Y-m-d H:i:s')) - strtotime($result1[0]['created_date'])  ;
                    $res['table_tot']   = $result1[0]['total'];
                    $res['table_stime'] = $diff;
                    $res['bill_id']     = $result1[0]['Id'];
                }else{
                    $res['table_tot'] = '';
                    $res['table_stime'] = 0;
                    $res['bill_id']     = 0;
                }
            }else{
                $res['table_tot']   = '';
                $res['table_stime'] = 0;
                $res['bill_id']     = 0;
            }
            $data[] = $res;
        }
        return $data;
    }    
}


if (!function_exists('slugify')) { //checked
    setlocale(LC_ALL, 'en_US.UTF8');
    function slugify($text){
        $text = preg_replace('/[^A-Za-z0-9\s\-]/', '', $text); // Removes special chars.
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        //$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text)){
            return 'n-a';
        }else{
            $text = preg_replace('/-+/', '-', $text); // Replaces multiple hyphens with single one.
            return $text;
        }
    }
}



if (!function_exists('getTableOrderData')){
    function getTableOrderData($bill_id = 0)
    {
        $ci=& get_instance();
        $ci->load->database();
        $data = array();
        
        $ci->db->select('*');
        $ci->db->from('tables');
        $ci->db->where('is_deleted',0);
        if($restaurant_id > 0 ) $ci->db->where('restaurant_id',$restaurant_id);
        if($table_id > 0 ) $ci->db->where('table_id',$table_id);
        $query  = $ci->db->get();
        $result = $query->result_array();
        foreach($result as $res){
            if($res['ord_status'] != ''){
                $ci->db->select('*');
                $ci->db->from('bill_head');
                $ci->db->where('table_id',$res['table_id']);
                $ci->db->where('is_active',1);
                $ci->db->order_by('Id','DESC');
                $ci->db->limit(1);
                $query1  = $ci->db->get();
                $result1 = $query1->result_array();
                if(count($result1) > 0 ){
                    $diff = strtotime(date('Y-m-d H:i:s')) - strtotime($result1[0]['created_date'])  ;
                    $res['table_tot']   = $result1[0]['total'];
                    $res['table_stime'] = $diff;
                    $res['bill_id']     = $result1[0]['Id'];
                }else{
                    $res['table_tot'] = '';
                    $res['table_stime'] = 0;
                    $res['bill_id']     = 0;
                }
            }else{
                $res['bill_id']     = 0;
            }
            $data[] = $res;
        }
        return $data;
    }    
}

if (!function_exists('getId')) {
    function getId($data){
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select('id');
        $ci->db->from('current_stock');
        $ci->db->where('restaurant_id', $data['restaurant_id']);
        $ci->db->where('rawmaterial_id', $data['rawmaterial_id']);
        $query = $ci->db->get();
        $rows = $query->num_rows();
        if($rows > 0){
            $result = $query->row();
            $id     = $result->id;
        }else{
            $id = 0;
        }
        return $id;        
    }
}


if (!function_exists('GetUserRoles')) {
    function GetUserRoles($groupId){
        $ci = &get_instance();
        $ci->load->database();
        // SELECT mm.* FROM master_modules mm left join groups g on find_in_set( mm.id,g.permission) WHERE g.id = 1
        $ci->db->select('mm.*');
        $ci->db->from('master_modules mm');
        $ci->db->join('groups g','find_in_set(mm.id,g.permission)<>0','left');
        $ci->db->where('g.id',$groupId);
        // $ci->db->where('mm.parent_id',0);
        $ci->db->order_by('mm.parent_id','ASC');
        $ci->db->order_by('mm.sort_id','ASC');
        // $ci->db->where('FIND_IN_SET(classname,'.$data.')');
        $query = $ci->db->get();
        $result = $query->result_array();
        return $result;       
    }
}

if (!function_exists('GetDiscount')) {
    function GetDiscount($restaurant_id = 0, $id = 0){
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select('*');
        $ci->db->from('discount');
        if($restaurant_id > 0 ) $ci->db->where('restaurant_id',$restaurant_id);
        if($id > 0 ) $ci->db->where('discount_id',$id);
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;       
    }
}


if (!function_exists('GetLastBillNo')) {
    function GetLastBillNo($restaurant_id = 0){
        $result = 1;
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select('last_bill_no');
        $ci->db->from('restaurant');
        $ci->db->where('restaurant_id',$restaurant_id);
        $query  = $ci->db->get();
        $rows   = $query->num_rows();
        if($rows > 0){
            $row = $query->row_array();
            $result = $row['last_bill_no'];
            $result = intval($result) + 1;
        }
        return $result;
    }
}

if (!function_exists('UpdateLastBillNo')) {
    function UpdateLastBillNo($restaurant_id,$bill_id){
        $ci = &get_instance();
        $ci->load->database();
        $data['last_bill_no'] = $bill_id;
        $ci->db->where('restaurant_id',$restaurant_id);
        $ci->db->update('restaurant',$data);
    }
}

if (!function_exists('GetLastKOTNo')) {
    function GetLastKOTNo($restaurant_id = 0){
        $result = 1;
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select('last_kot_no');
        $ci->db->from('restaurant');
        $ci->db->where('restaurant_id',$restaurant_id);
        $query  = $ci->db->get();
        $rows   = $query->num_rows();
        if($rows > 0){
            $row = $query->row_array();
            $result = $row['last_kot_no'];
            $result = intval($result) + 1;
        }
        return $result;
    }
}

if (!function_exists('UpdateLastKOTNo')) {
    function UpdateLastKOTNo($restaurant_id,$kot_no){
        $ci = &get_instance();
        $ci->load->database();
        $data['last_kot_no'] = $kot_no;
        $ci->db->where('restaurant_id',$restaurant_id);
        $ci->db->update('restaurant',$data);
    }
}

if (!function_exists('GetBillHead')) {
    function GetBillHead($bill_id = 0){
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select('bh.*,t.tablename, concat(u.firstname,u.lastname) as username, c.c_name, c.mobile');
        $ci->db->from('bill_head bh');
        $ci->db->join('customer c','c.customer_id = bh.customer_id','left');
        $ci->db->join('tables t','bh.table_id = t.table_id','left');
        $ci->db->join('admin_users u','u.id = bh.modify_by','left');
        $ci->db->where('bh.id',$bill_id);
        $query  = $ci->db->get();
        $rows   = $query->num_rows();
        if($rows > 0){
            $result = $query->row_array();
        }
        return $result;
    }
}
if (!function_exists('GetBillItems')) {
    function GetBillItems($bill_id = 0){
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        // SELECT ki.*, im.item_name FROM kot_item ki left join kot_head kh on kh.id = ki.kot_id left join items im on ki.item_id = im.item_id WHERE kh.bill_id = 1
        $ci->db->select('ki.*, sum(ki.qty) as total_qty,sum(ki.price) as total_price, im.item_name');
        $ci->db->from('kot_item ki');
        $ci->db->join('kot_head kh','kh.id = ki.kot_id', 'left');
        $ci->db->join('items im','ki.item_id = im.item_id', 'left');
        $ci->db->where('kh.bill_id',$bill_id);
        $ci->db->group_by('im.item_id');
        $query  = $ci->db->get();
        $rows   = $query->num_rows();
        if($rows > 0){
            $result = $query->result_array();
        }
        return $result;
    }
}

if (!function_exists('GetKOTItems')) {
    function GetKOTItems($restaurant_id = 0){
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        /*
        $query = $this->db->query("SELECT h.*, t.tablename  FROM kot_head h, tables t  where t.table_id = h.table_id and h.status = 'OrderTaken' AND t.restaurant_id = ".$restaurant_id);
        $result = $query->result_array();
        //print_r($result);
        $data = array();
        foreach($result as $res){
            $query1 = $this->db->query("SELECT   i.*, n.item_name  FROM kot_item i, items n where n.item_id = i.item_id and i.kot_id = '".$res['Id']."'");
            $result1 = $query1->result_array();
            $res['ord'] = $result1;
            $data[] = $res;
        }
        */
        // SELECT ki.*, im.item_name FROM kot_item ki left join kot_head kh on kh.id = ki.kot_id left join items im on ki.item_id = im.item_id WHERE kh.bill_id = 1
        $ci->db->select('kh.Id, kh.bill_id, kh.kot, kh.status,t.table_id, t.tablename, b.bill_type');
        $ci->db->from('kot_head kh');
        $ci->db->join('tables t','t.table_id = kh.table_id', 'left');
         $ci->db->join('bill_head b','b.Id = kh.bill_id', 'left');
        if($restaurant_id > 0){
            $ci->db->where('t.restaurant_id', $restaurant_id);
        }
        $status = array('OrderTaken','OrderReady','InCooking');
        $ci->db->where_in('kh.status', $status);
        $query  = $ci->db->get();
        $result = $query->result_array();
        foreach($result as $key => $row){
            $ci->db->select('ki.*, i.item_name');
            $ci->db->from('kot_item ki');
            $ci->db->join('items i','i.item_id = ki.item_id', 'left');
            $ci->db->where('ki.kot_id',$row['Id']);
            $query  = $ci->db->get();
            $result[$key]['items'] = $query->result_array();
            
             foreach( $result[$key]['items'] as $key => $row){
                $ci->db->select('ir.item_id, r.rawmaterial, ir.quantity,mu.units');
                $ci->db->from('kot_item ki');
                $ci->db->join('item_rawmaterial ir','ir.item_id = ki.item_id', 'left');
                $ci->db->join('master_unit mu','mu.id = ir.units', 'left');
                $ci->db->join('rawmaterial r','r.rawmaterial_id = ir.rawmaterial_id', 'left');
                $ci->db->where('ki.kot_id',$row['kot_id']);
                $ci->db->where('ki.item_id',$row['item_id']);
                $query  = $ci->db->get();
                $result[$key]['rawmaterial'] = $query->result_array();
            }
        }
        return $result;
    }
}

if (!function_exists('getCustomer')){
    function getCustomer($rid){
        $ci=& get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT customer_id, c_name, mobile FROM customer WHERE restaurant_id in(0,".$rid.") order by restaurant_id, c_name") ;
        $query = $query->result_array();
        if( is_array( $query ) && count( $query ) > 0 ){
            foreach($query as $row){
                $return[$row['customer_id']] = $row['c_name'].' - '.$row['mobile'];
            }            
        }
        return $return;
    }
}

if (!function_exists('getProductType')){
    function getProductType(){
        $ci=& get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT * FROM product_types ");
        $query = $query->result_array();
        if( is_array( $query ) && count( $query ) > 0 ){
            $return[''] = '--Select Product Types--';
            foreach($query as $row){
                $return[$row['value']] = $row['types'];
            }
        }
        return $return;
    }
}





if(!function_exists('getTipAmountBYBILL')){
    function getTipAmountBYBILL($restaurant_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('sum(tip_amt) as TipAmountTotal');
        $ci->db->from('bill_head');
        $ci->db->where('tip_amt >', 0.00);
        $ci->db->where('created_date >=', date('Y-m-d'));
        $ci->db->where('restaurant_id', $restaurant_id);
        $ci->db->where('status',"BillPaid");
        $ci->db->where('is_deleted',0);
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;
    }
}


if(!function_exists('getTotalTipAmountBYBILL')){
    function getTotalTipAmountBYBILL($restaurant_id)
    {
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select('sum(tip_amt) as TotalTipAmountTotal');
        $ci->db->from('bill_head');
        $ci->db->where('tip_amt >', 0.00);
        $ci->db->where('restaurant_id', $restaurant_id);
        $ci->db->where('status',"BillPaid");
        $ci->db->where('is_deleted',0);
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;
    }
}


if (!function_exists('getBalancesheetData')) {
    function getBalancesheetData($table_name, $restaurant_id, $cash_type, $id)
    {
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select('sum(e.amount) as amount,e.amount, au.username, 
        (CASE WHEN e.cash_type = "I" THEN "Cash In" WHEN e.cash_type = "O" THEN "Cash Out" END) As ctype ');
        $ci->db->from($table_name.' e');
        $ci->db->join('admin_users au','au.id = e.user_id', 'left');
        $ci->db->where('e.is_deleted',0);
        $ci->db->where('e.restaurant_id',$restaurant_id);
        if($cash_type){
            $ci->db->where('e.cash_type', $cash_type);
        }
        if($id){
            $ci->db->where('e.expense_id', $id);
        }
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;
    }
}


if (!function_exists('getRestaurantData')) {
    function getRestaurantData($restaurant_id)
    {
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $ci->db->select('restaurant_name');
        $ci->db->from('restaurant');
        $ci->db->where('restaurant_id',$restaurant_id);
        // $ci->db->where('bill_head.created_date >=',$first_date); 
        // $ci->db->where('created_date <=',date('Y-m-d',strtotime($value['dayendtime'])).' 23:59:59');
        // $ci->db->where('bill_head.created_date <=',$second_date);
        $query  = $ci->db->get();
        $result = $query->row_array();
        return $result;
    }
}

if (!function_exists('getCurrentLiabilitiesData')) {
    function getCurrentLiabilitiesData($restaurant_id)
    {
        $year =  date("Y");
        $peryear = $year - 1; 
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT sum(bill_head.grand_total) as billAmount,bill_head.restaurant_id as restaurant_id FROM `bill_head` LEFT JOIN customer on bill_head.customer_id = customer.customer_id Right JOIN admin_users on bill_head.created_by = admin_users.id WHERE bill_head.restaurant_id = $restaurant_id and bill_head.payment_type = 'CreditPending' and  bill_head.created_date >= '$peryear/04/01' and bill_head.created_date <= '$year/03/31' ");
        $result = $query->row_array();
        return $result;
    }
}

if (!function_exists('getFixedassetsData')) {
    function getFixedassetsData($restaurant_id)
    {
        $year =  date("Y");
        $peryear = $year - 1; 
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT r.rawmaterial_id,r.rawmaterial,IF(cs.current_stock IS NULL or cs.current_stock = '', '0', cs.current_stock) as current_stock, mu.units, IF(cs.price IS NULL or cs.price = '', '0', cs.price) as price,   cs.modified_date , sum(current_stock*price) as TotalPrice  FROM rawmaterial r LEFT JOIN current_stock cs on cs.rawmaterial_id = r.rawmaterial_id AND r.is_deleted = 0 LEFT JOIN master_unit mu on r.unit = mu.id WHERE r.restaurant_id = $restaurant_id and r.product_Type = 'nonconsumable'  and   r.created_date >= '$peryear/04/01' and r.created_date <= '$year/03/31' ");
        $result = $query->result_array();
        return $result;


    }
}




// for p & l start 
if (!function_exists('getFixedassetsplData')) {
    function getFixedassetsplData($restaurant_id)
    {
        $year =  date("Y");
        $peryear = $year - 1; 
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT r.rawmaterial_id,r.rawmaterial,IF(cs.current_stock IS NULL or cs.current_stock = '', '0', cs.current_stock) as current_stock, mu.units, IF(cs.price IS NULL or cs.price = '', '0', cs.price) as price,   cs.modified_date , sum(current_stock*price) as TotalPrice  FROM rawmaterial r LEFT JOIN current_stock cs on cs.rawmaterial_id = r.rawmaterial_id AND r.is_deleted = 0 LEFT JOIN master_unit mu on r.unit = mu.id WHERE r.restaurant_id = $restaurant_id and r.product_Type = 'fixedassets'   ");
        $result = $query->result_array();
        return $result;
        // fixedassets
        
    }
}

// for p & l start 

if (!function_exists('getOpeningStockData')) {
    function getOpeningStockData($restaurant_id)
    {
        $year =  date("Y");
        $peryear = $year - 1; 
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT r.rawmaterial_id,r.rawmaterial,IF(cs.current_stock IS NULL or cs.current_stock = '', '0', cs.current_stock) as current_stock, mu.units, IF(cs.price IS NULL or cs.price = '', '0', cs.price) as price,   cs.modified_date , sum(current_stock*price) as TotalPrice  FROM rawmaterial r LEFT JOIN current_stock cs on cs.rawmaterial_id = r.rawmaterial_id AND r.is_deleted = 0 LEFT JOIN master_unit mu on r.unit = mu.id WHERE r.restaurant_id = $restaurant_id and r.product_Type != 'nonconsumable' and r.created_date >= '$peryear/04/01' and r.created_date <= '$year/03/31' ");
        $result = $query->result_array();
        
        return $result;
        
    }
}


if (!function_exists('getClosingStockData')) {
    function getClosingStockData($restaurant_id)
    {
        $year =  date("Y");
        $peryear = $year - 1; 
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT * FROM `stocks_logs` WHERE `restaurant_id` =55  ORDER by id DESC limit 1  ");
        $result = $query->row_array();
        
        return $result;
        
    }
}

if (!function_exists('getDirectExpenseData')) {
    function getDirectExpenseData($restaurant_id)
    {
        $year =  date("Y");
        $peryear = $year - 1; 
        $result = array();
        $ci = &get_instance();
        $ci->load->database();
        $return = array();
        $query = $ci->db->query("SELECT r.rawmaterial_id,r.rawmaterial,IF(cs.current_stock IS NULL or cs.current_stock = '', 'Not Available', cs.current_stock) as current_stock, mu.units, IF(cs.price IS NULL or cs.price = '', 'Not Taken', cs.price) as price,   cs.modified_date ,sum(current_stock*price) as TotalPrice  FROM rawmaterial r LEFT JOIN current_stock cs on cs.rawmaterial_id = r.rawmaterial_id AND r.is_deleted = 0 LEFT JOIN master_unit mu on r.unit = mu.id WHERE   r.rawmaterial like '%Tissue%' or r.rawmaterial like '%soap%' or  r.rawmaterial like '%gass%' and r.restaurant_id = $restaurant_id and r.product_Type = 'nonconsumable'  ");
        $result = $query->row_array();
        
        
        return $result;
        
    }
}



