<?php
$accounts=array();

// 開帳戶 
function newAccount($initMoney) {
    global $accounts;
    $accounts[] = $initMoney;
    return count($accounts);
}

// 存款 (T or F)
// 測試正確
function deposit($id, $money) {
    global $accounts;
    $c = count($accounts);
    if ($money==0) $money=2000;
    if ($id <= $c && $id>0) {
        $accounts[$id-1] += $money;
        return True;
    } else {
        return False;
    }
}

// 提款
function withdraw($id, $money) {
    global $accounts;
    $c = count($accounts);
    if ($id <= $c && $id>0) {
        $accounts[$id-1] -= $money;
        return True;
    } else {
        return False;
    }
}

// 轉帳
function transfer($from,$to, $money) {
    global $accounts;
    $c = count($accounts);
    if ($from <= $c && $from>0 && $to <= $c && $to>0) {
        $accounts[$from-1] -= $money;
        $accounts[$to-1] += $money;
        return True;
    } else {
        return False;
    }
}

// 查看存款餘額
function getBalance($id) {
    global $accounts;
    $c = count($accounts);
    if ($id <= $c && $id>0) {
        $b = $accounts[$id-1];
    }
    else {
        $b=1000;
    }
    return $b;
}

// 重設系統
function resetAccount() {
    global $accounts;
    $accounts=array();
}

?>