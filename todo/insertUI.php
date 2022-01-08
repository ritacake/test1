<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>新增工作-AJAX</title>
  
  <script>
    function AddNewJob(){
      let title = document.getElementsByID('title').value;
      let note = document.getElementsByID('note').value;
      console.log(title);
      console.log(note);
    }
  </script>

</head>

<body>
  <p>Add new Job!!</p>
  <hr />

  <table width="200" border="1">
    <tr>
      <td>title</td>
      <td>note</td>
      <td></td>
    </tr>
    <tr>
      <form method="post" onclick="AddNewJob()">
        <!-- 多送一個參數，名字叫"act", 不顯示, value='addJob'(value的值可以自己取)  -->
        <!-- 多送一個訊息說我現在要做甚麼事 ，也就是 'addJob' -->
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
</body>

</html>