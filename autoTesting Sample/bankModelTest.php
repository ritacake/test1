<?php
// 用 ModelTest.php 去測試 model.php
require("bankModel.php");

echo "\ntest newAccount\n";
// 定義 testcase
$testcase=[
    // [x, y, expected]
    // [輸入的第一個值, 輸入的第二個值, 預期得到的數值]
    [100,1], 
    [200,2], 
    [0,2], 
    [-50,2], 
    [-200,2] 
];
// 測試 開帳戶 (array)
foreach ($testcase as $t) {
    echo "testing {$t[0]}";
    if (newAccount($t[0]) == $t[1]) {
        echo "... pass\n"; // 通過
    } else {
        echo "... failed\n"; // 不通過	
    }
}

echo "\ntest deposit\n";
// 定義 testcase
$testcase=[
    // [x, y, expected]
    [0,0,false], // 不合理 id  
    [1,100,true],
    [2,200,true],
    [100,-20,false]
];
// 測試 存款 (T or F)
foreach ($testcase as $t) {
    echo "testing {$t[0]}, {$t[1]}";
    if (deposit($t[0], $t[1]) == $t[2]) {
        echo "... pass\n"; // 通過
    } else {
        echo "... failed\n"; // 不通過	
    }
}

echo "\ntest withdraw\n";
// 定義 testcase
$testcase=[
    // [x, y, expected]
    [0,150000,false], 
    [0,-200,false],
    [-1,100,false],
    [1,10,true],
    [1,150000,false], // 沒錢不能領
    [100,-20,false] // 領錢金額不能輸入負號
];
// 測試 提款 (T or F)
foreach ($testcase as $t) {
    echo "testing {$t[0]}, {$t[1]}";
    if (withdraw($t[0], $t[1]) == $t[2]) {
        echo "... pass\n"; // 通過
    } else {
        echo "... failed\n"; // 不通過	
    }
}


echo "\ntest transfer\n";
// 定義 testcase
$testcase=[
    // [x, y, expected]
    [0,1,10,false], 
    [1,2,-200,false],
    [1,0,100,false],
    [1,2,10,true],
    [2,1,15,true], // 沒錢不能領
    [2,1,20000000,false] // 領錢金額不能輸入負號
];
// 測試 轉帳 (T or F)
foreach ($testcase as $t) {
    echo "testing {$t[0]}, {$t[1]}, {$t[2]}";
    if (transfer($t[0], $t[1], $t[2]) == $t[3]) {
        echo "... pass\n"; // 通過
    } else {
        echo "... failed\n"; // 不通過	
    }
}

echo "\ntest getBalance\n";
// 定義 testcase
$testcase=[
    // [x, y, expected]
    // [輸入的第一個值, 輸入的第二個值, 預期得到的數值]
    [0,null], 
    [1,0],
    [2,1], 
    [3,1], 
    [4,1], 
    [5,1], 
    [6,null],
    [7,null],
    [-1,null]
];
// 測試 查存款餘額 (int)
foreach ($testcase as $t) {
    echo "testing {$t[0]}";
    if (getBalance($t[0]) == $t[1]) {
        echo "... pass\n"; // 通過
    } else {
        echo "... failed\n"; // 不通過	
    }
}

echo "\ntest resetAccount\n";
// 定義 testcase
$testcase=[
    // [x, y, expected]
    // [輸入的第一個值, 輸入的第二個值, 預期得到的數值]
    [0,0], 
    [1,0],
    [2,0], 
    [3,0], 
    [4,0], 
    [5,0], 
    [6,0]
];
// 測試 重設系統 (空 array)
foreach ($testcase as $t) {
    echo "testing {$t[0]}";
    resetAccount();
    if (getBalance($t[0]) == $t[1]) {
        echo "... pass\n"; // 通過
    } else {
        echo "... failed\n"; // 不通過	
    }
}

?>