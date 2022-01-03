function loadAddForm(title, note){
    let tableStr = "<table width='200' border='1'>";
    tableStr += "<tr><td>title</td><td>note</td><td></td></tr>";
    tableStr += "<tr><form method='post' action=>"
}
<table width="200" border="1">
  <tr>
    <td>title</td>
    <td>note</td>
    <td></td>
  </tr>

  <tr><form method="post" action="todoControl.php">
  <input name="act" type="hidden" value='addJob' />
    <td><label>
      <input name="title" type="text" id="title" />
    </label></td>
    <td><label>
      <input name="note" type="text" id="note" />
    </label></td>
    <td><label>
      <input type="submit" name="Submit" value="送出" />
    </label></td>
    </form>
  </tr>
</table>

function postAddForm(title, note){
    fetch("todoControlAjax.php?act=addJob&title=" + title + "&note=" + note)
    .then(function(resp){
        console.log(resp);
        return resp.text(); // 因為是要印出 OK，所以不轉成 JSON，而是轉成 text
    })
    .then(function(rr) {
        if (rr){
            console.log(rr)
            // 因為是更新清單畫面，所以直接 call loadList(3) 就可以了~
            // 列出所有工作
            loadList(3)
        }
    })
}