<?php
 require "dbconnect.php";
 ?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery.js"></script>

<script language="javascript">
	// new 一個 Audio 物件，要放甚麼音樂
var audio = new Audio('Explosion+3.mp3');
// 錢
var money=1000;

// 設置炸彈
function setBomb(bombID) {
	now= new Date(); //get the current time
	tday=new Date(myArray[bombID]['expire'])
	console.log(now, tday)
	if (tday <= now) {
		//alert('exploded');
		//use jQuery ajax to reset timer
		if(money >= 500) {
			$.ajax({
				url: "setBomb.php",
				dataType: 'html',
				type: 'POST',
				data: { id: myArray[bombID]['id']}, //optional, you can send field1=10, field2='abc' to URL by this
				error: function(response) { //the call back function when ajax call fails
					alert('Ajax request failed!');
					},
				success: function(txt) { //the call back function when ajax call succeed
					console.log(txt)
					myArray[bombID]['expire'] = txt;
					money -= 500
					}
			});
		} else {
			alert("You need more money to set a bomb!")
		}
	} else {
		alert("counting down, be patient.")
	}
}

// 檢查炸彈
function checkBomb() {
	// 更新錢的顯示數量
	$("#money").html(money);
	now= new Date(); //get the current time
	
	//check each bomb with a for loop
	//array length: number of items in the global array: myArray
	// myArray 目前有幾顆炸彈
	for (i=0; i < myArray.length;i++) {	
		// expire 取得炸彈爆炸時間
		tday=new Date(myArray[i]['expire']); //convert the date string into date object in javascript
		// 判斷到期了沒
		if (tday <= now) { 
			//expired, set the explode image and text
			// 把圖改成爆炸的圖
			$("#bomb" + i).attr('src',"images/explode.jpg");
			// 把說明文字，改成 exploded! (表示已爆炸)
			$("#timer"+i).html("exploded!")
			// 防呆
			if (now - tday <= 1500 ) {
				audio.play();
				money += 600
			}
		} else {
			//set the bomb image  and calculate count down
			// 設成炸彈圖
			$("#bomb" + i).attr('src',"images/bomb.jpg");
			// 顯示倒數
			$("#timer"+i).html(Math.floor((tday-now)/1000))			
		}
	}
}

//javascript, to set the timer on windows load event
window.onload = function () {
	//check the bomb status every 1 second
	// 每 1 秒鐘去檢查一次炸彈
    setInterval(function () {
		checkBomb()
    }, 1000);
};
</script>
</head>

<body >
Money:<div id="money"></div><hr>
<?php

$i=0; //counter for bombs
$sql="select * from game"; //select all bomb information from DB

// $res 抓 炸彈資料
$res=mysqli_query($conn,$sql) or die("db error");
$arr = array(); //define an array for bombs

while($row=mysqli_fetch_assoc($res)) {
	$arr[] = $row; //store the row into the array
	//generate the image tag, the div tag for timer text. Note on the use of $i in tag ID
	// 放炸彈圖
	echo "<img id='bomb$i' onclick='setBomb($i)'><div id='timer$i'></div><br />";
	$i++; //increase counter
}

?>

<script>
<?php
	//print the bomb array to the web page as a javascript object
	// myArray 炸彈資料
	echo "var myArray=" . json_encode($arr);
?>
</script>

</body></html>