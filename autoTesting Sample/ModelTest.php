<?php
// 用 ModelTest.php 去測試 model.php
require("model.php");
echo "test getAvg\n";

//  定義 testcase
$testcase=[
    // [x, y, expected]
    // [輸入的第一個值, 輸入的第二個值, 預期得到的數值]
    [0,2,1],
    [1,2,1],
    [1,1,1]
];

foreach ($testcase as $t) {
    echo "testing {$t[0]}, {$t[1]}";
    if (getAvg($t[0], $t[1]) == $t[2]) {
        echo "... pass\n";
    } else {
        echo "... failed\n";		
    }
}

echo "test getMax\n";
$testcase=[
    //[x, y, expected]
    [0,2,2],
    [1,1,1],
    [3,1,3]
];

foreach ($testcase as $t) {
    echo "testing {$t[0]}, {$t[1]}";
    if (getMax($t[0], $t[1]) == $t[2]) {
        echo "... pass\n";
    } else {
        echo "... failed\n";		
    }
}

?>