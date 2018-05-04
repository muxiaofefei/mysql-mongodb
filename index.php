<?php 

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "lute";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "SELECT * FROM news";
$result = $conn->query($sql);


$m = new \MongoClient();    //建立连接
$db = $m->wlzz;     //选择数据库

$collection = $db->question;    // 选择集合



if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {


        $document = array(
            // "newstitle" => $row['newstitle'],
            'title'=>$row['newstitle'],
            'author'=>new\MongoId('5aeb2356636a21ec1700002c'),
            'cont'=>$row['newscontent'],
            'tags'=>['测试数据'],
            "createtime" => time(),
            "click" => 0,
        );

        $collection->insert($document);    //插入数据



        echo "成功";
        echo "<br>";

    }
} else {
    echo "0 结果";
}
$conn->close();



 ?>