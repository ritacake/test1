function baseOBJ() {
	// 宣告一整個 function 層級的變數
	var baseApp;
	// 定義一個模板
	const template=`
<form id='baseForm'>
編號<input type='text' v-model='dat.id' disabled ><br>
姓名<input type='text' v-model='dat.name'  /><br>
性別<select v-model='dat.sex'  ><option value='男'>男</option><option value='女'>女</option></select>
<br>
類別<select v-model='dat.type'  ><option v-for='rec in litOpts' :value='rec.v'>{{rec.o}}</option></select>
<br>
<hr style='clear:both;'/>
<input type='button' v-on:click='submitit()' value='Save'>
<br/>
</form>
`;
	
	// 宣告的函數可以透過 this 去取用，變成 public function
	this.loadRecord=function (id,div) {
		// let 宣告區塊層級的變數，有效層只有在這個 block 裡面
		let elmnt = document.getElementById(div);
		/*search for elements with a certain atrribute:*/
		if (elmnt) {
			// 把模板的資料塞進 elmnt
			elmnt.innerHTML = template;
			let url="getData.php";
			
			// 用 GET 的方式傳給後台
			fetch(url+"?id=" + id.toString())
			// 把 promise 物件轉成 json 物件，然後再傳給下一個 call back function
			.then(function(resp){return resp.json();})
			.then(function(json) {
					//console.log(json.group_no);
					//return;
					baseApp=Vue.createApp( {
						data() {
							return {
								dat: json,
								xid: id,
								// 定義選單的選項
								litOpts: [{v:1,o:'a'},{v:2,o:'b'},{v:3,o:'c'}]
							}
						},
						methods: {
							// 把使用者在表單填的東西，包在一個虛擬表單，傳給後台
							submitit() {									
								let mydat = new FormData();
								//console.log(this.dat);
								//this is one way
								mydat.append( "dat", JSON.stringify(this.dat) );
								mydat.append( "i", this.xid);
								
								/*
								//this is another way
								for (key in dat) {
									mydat.append(key, dat[key])
								}
								mydat.append( "i", this.xid);
								*/
								//console.log(mydat)
								let url="saveData.php";
								fetch(url,{
									method: 'POST', 
									body: mydat									
								})
								// 後臺處理完訊息後，傳回來
								.then(function(res){return res.text(); })
								.then(function(data){ 
									console.log(data)
								})
							}
						}
					});
					// 把剛剛宣告的物件 (baseApp)，綁定到 div 上
					baseApp.mount("#"+div);
				})
		} //end if
	} //end loadrecord
} //end of baseObj function
