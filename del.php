<?php
$con = mysqli_connect("localhost", "root", "", "tmmun");
// 检测连接
if (mysqli_connect_errno()) {
    echo "连接失败: " . mysqli_connect_error();
}

mysqli_query($con, "DELETE FROM chat WHERE Id>0");

mysqli_close($con);
?>