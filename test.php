<?php 

date_default_timezone_set("PRC");
echo date('Y-m-d H:i:s', time() + (15 * 60)) . '<br>'; 
echo date('Y-m-d H:i:s');
die;

$data = '';



 //会员卡交易报表增加订单信息
 $data = $this->cardDataMergeOrderInfo(object_to_array($orderList->get()->toArray()));
 set_time_limit(0);
 ini_set("memory_limit", "1024M");
 
 //      导出到本地
 header ( "Content-type:application/vnd.ms-excel" );
 header ( "Content-Disposition:filename=aaaaaaa商品销售报表.csv" );
 header ('Cache-Control: max-age=0');
 
 $fp = fopen('php://output', 'a');                    //打开PHP文件句柄，php://output 表示直接输出到浏览器
 
 $head = ['card_number' => '会员卡号', 
 'ICmachine_no' => '卡机号', 
 'user_phone' => '手机号', 
 'user_name' => '会员姓名',
 'card_type' => '卡分类', 
 'transaction_type' => '交易类型', 
 'transaction_from' => '来源', 
 'store_name' => '门店交易',
 'open_store_name' => '首充门店', 
 'real_amount' => '交易金额', 
 'before_balance' => '交易前卡余额',
 'balance' => '交易后卡余额', 
 'pay_time' => '交易日期'];       //定义标题
 
 foreach ($head as $i => $v) {
     $head[$i] = iconv('utf-8', 'GB18030', $v);      //将中文标题转换编码，否则乱码
 }
 
 fputcsv($fp, $head);    

 foreach ($data as $k => $v) {                      //重组数组
     // x($v);
     $rows[$k]['id'] = $v['id'];
     $rows[$k]['money'] = $v['money'];
     $rows[$k]['card_number'] = $v['card_number'];
     $rows[$k]['open_store_id'] = $v['open_store_id'];
     $rows[$k]['consume_time'] = $v['consume_time'];
     $rows[$k]['created_at'] = $v['created_at'];
     $rows[$k]['user_id'] = $v['user_id'];
     $rows[$k]['balance'] = $v['balance'];
     $rows[$k]['card_id'] = $v['card_id'];
     $rows[$k]['technician_id'] = $v['technician_id'];
     $rows[$k]['refund_id'] = $v['refund_id'];
     $rows[$k]['consume_type'] = $v['consume_type'];
     $rows[$k]['order_id'] = $v['order_id'];
     // $rows[$k]['store_id'] = $v['store_id'];
     // $rows[$k]['card_type_id'] = $v['card_type_id'];
     // $rows[$k]['order_source'] = $v['order_source'];
     // $rows[$k]['order_source'] = $v['order_source'];
     // $rows[$k]['product_type'] = $v['product_type'];
 }
 
 $limit = 30000;
 $num = 0;                                         //计数器
 foreach ( $rows as $v ) {                           //循环数据
     $num++;
 
     if ($num == $limit) {
         ob_flush();         //释放内存
         flush();
     }
     $rows = array();
     foreach ($v as $kk => $vv) {
         $rs[$kk] = iconv('utf-8', 'GB18030', $vv);  //转译编码
     }
     fputcsv($fp, $rs);
 }

x('ok');
die;



// // 输出Excel文件头，可把user.csv换成你要的文件名  
// header('Content-Type: application/vnd.ms-excel');  
// header('Content-Disposition: attachment;filename="user.csv"');  
// header('Cache-Control: max-age=0');     
// // 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可  
// // $sql = 'select * from tbl where ……';  
// // $stmt = $db->query($sql);     
// // 打开PHP文件句柄，php://output 表示直接输出到浏览器  
// $fp = fopen('php://output', 'a');    
// // 输出Excel列名信息  
// $head = array('姓名', '性别', '年龄', 'Email', '电话', '……');  
// foreach ($head as $i => $v) {  
//     // CSV的Excel支持GBK编码，一定要转换，否则乱码  
//     $head[$i] = iconv('utf-8', 'gbk', $v);  
// }    
// // 将数据通过fputcsv写到文件句柄  
// fputcsv($fp, $head);   
// // 计数器  
// $cnt = 0;  
// // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小  
// $limit = 100000;    
// // 逐行取出数据，不浪费内存  
// while ($row = $stmt->fetch(Zend_Db::FETCH_NUM)) {   
//     $cnt ++;  
//     if ($limit == $cnt) { 
//         //刷新一下输出buffer，防止由于数据过多造成问题  
//         ob_flush();  
//         flush();  
//         $cnt = 0;  
//     }  
   
//     foreach ($row as $i => $v) {  
//         $row[$i] = iconv('utf-8', 'gbk', $v);  
//     }  
//     fputcsv($fp, $row);  
// }

set_time_limit(0);
ini_set("memory_limit", "1024M");
 
//      导出到本地
header ( "Content-type:application/vnd.ms-excel" );
header ( "Content-Disposition:filename=aaaaaaa商品销售报表.csv" );
header ('Cache-Control: max-age=0');
 
$fp = fopen('php://output', 'a');                    //打开PHP文件句柄，php://output 表示直接输出到浏览器
 
$head = ['商品名称','商品条码','商品分类','现有库存','销售数量','商品总价','实收金额'];       //定义标题
 
foreach ($head as $i => $v) {
    $head[$i] = iconv('utf-8', 'GB18030', $v);      //将中文标题转换编码，否则乱码
}
 
fputcsv($fp, $head);                               //将标题名称通过fputcsv写到文件句柄

$data = [
  [
    'gname' => '郭亚健',
    'barcode' => '123',
    'cname' => 'cname',
    'sl' => 'aaaa',
    'hj' => 'hjhjhjhj',
    'gname' => '郭亚健',
  ]
];
for($i=0; $i<50000; $i++){
  $data[] = [
    'gname' => '郭亚健',
    'barcode' => '123',
    'cname' => 'cname',
    'sl' => 'aaaa',
    'hj' => 'hjhjhjhj',
    'gname' => '郭亚健',
  ];
}

foreach ($data as $k => $v) {                      //重组数组
    $rows[$k]['gname'] = $v['gname'];
    $rows[$k]['barcode'] = $v['barcode'];
    $rows[$k]['cname'] = $v['cname'];
    $rows[$k]['kc'] = '1';
    $rows[$k]['sl'] = $v['sl'];
    $rows[$k]['hj'] = $v['hj'];
    $rows[$k]['ss'] = $v['hj'];
}
 
$limit = 30000;
$num = 0;                                         //计数器
foreach ( $rows as $v ) {                           //循环数据
    $num++;
 
    if ($num == $limit) {
        ob_flush();         //释放内存
        flush();
    }
    $rows = array();
    foreach ($v as $kk => $vv) {
        $rs[$kk] = iconv('utf-8', 'GB18030', $vv);  //转译编码
    }
    fputcsv($fp, $rs);
}






// header("Content-type:application/vnd.ms-excel");
// header("Content-Disposition:attachment;filename=Export_test.xls");
// $tab="\t"; $br="\n";
// $head="编号".$tab."备注".$tab."自测";
// //输出内容如下： 
// echo $head.$br;
// echo  "test321318312".$tab; 
// echo  "string1";
// echo  $br;
 
// echo  "330181199006061234".$tab;  //直接输出会被Excel识别为数字类型
// echo  "number";
// echo  $br;
 
// echo  "=\"330181199006061234\"".$tab;  //原样输出需要处理
// echo  "string2";
// echo  $br;







//$array = sprintf("%.2f",0.45777559);
//print_r($array);





// ob_end_clean();
// ob_implicit_flush(1);
// for ($i=0; $i < 10 ; $i++) {
//     echo $i;
//     //浏览器需要凑够一定的字节数才会输出
//     echo str_repeat ( " " , 1024 ) ;
//     sleep(1);
// }








/*
$p2='LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0KTUlJQklqQU5CZ2txaGtpRzl3MEJBUUVGQUFPQ0FROEFNSUlCQ2dLQ0FRRUF3VWVQOVU3N1hUV0F3Tk9FKytLOApxbHFMUGFnb3Y2YUN1bGJWc29mK2pHa28wOUtmcWFqVkhCSGh5VGtQWE13Y2I0aS96RloyZVQzVk4rbnlFeTU1ClBkQnlvNFRnNWZtaVZnQTNmTHFiS3FDczBBRVRhblMvVnNoczFNazBvcVgzYkRPMlZhdFI2Q3BsY3lFMWZkL1kKYlNxREFlaXVFbkJFMks4aU1rTWlWZWNkSFhQUjd5K25wQTMyTHhZRU1BU0hKUFdZMExKQk84UmlnY0xNeDlBQwpqQTk5M2NybEoyQlJad2FVdkVHTyt5YzFMYUZNNXF4enhMVHdQN3E0WmZ2S3FqNVdkRXdYcklMNU0xbzhxank3Clk0UWNPZU5aYUxUVkpRK0pzL1JIeXdESFFhcEJSenJmMXZNZExhNE9VNGMvM0ZxWXQyaXM5QjdneTZPZWQ1d1QKSlFJREFRQUIKLS0tLS1FTkQgUFVCTElDIEtFWS0tLS0tCg';
$pdata=['refund_reason'=>'不要了','id'=>8552,'refund_amount'=>0.1,'applay_amount'=>0.1,'is_refund_all'=>1,'refund_reason_type'=>1];
ksort($pdata);
$post = json_encode($pdata);
//----相反操作。公钥加密 
openssl_public_encrypt($post, $encrypted, base64_decode($p2));
$encrypted = base64_encode($encrypted); 
$postdata=['refund_reason'=>'不要了','id'=>8552,'refund_amount'=>0.1,'applay_amount'=>0.1,'is_refund_all'=>1,'refund_reason_type'=>1,'sign'=>$encrypted];
function curlPost($url,$postdata){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60); //设置超时
    if(0===strpos(strtolower($url),'https')){
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);// 对认证证书来源的检查
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);// 从证书中检查SSL加密算法是否存在
    }
    if(!empty($postdata)){
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    }
    $response = curl_exec($ch);//CURLOPT_RETURNTRANSFER 不设置  curl_exec返回TRUE 设置  curl_exec返回json(此处) 失败都返回FALSE   
    curl_close($ch);
    return json_decode($response);
}
return curlpost('http://yycms.test.yyhealth.com/admin/refund/userorder',$postdata);

















header('Content-Type:application/json; charset=utf-8');

$id = intval($_GET['articleId']);
// $c = file_get_contents('https://api.test.yyhealth.com/getArticleDetail?articleId='.$id);

$host = $_SERVER['HTTP_HOST'];
 if($host == 'm.test.yyhealth.com') {
        $apihost = 'https://api.test.yyhealth.com/';
      }else if($host == 'm.yyhealth.com'){
        $apihost = 'https://api.yyhealth.com/';
      }else {
        $apihost = 'https://api.test.yyhealth.com/';
      }
$apihost = 'https://api.yyhealth.com/';
$c = @file_get_contents($apihost.'getArticleDetail?articleId='.$id);

 echo $c;
*/

