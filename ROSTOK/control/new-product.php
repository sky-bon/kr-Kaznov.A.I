<html>
<head>

<style type='text/css'>

.table-plane{
  border: 1px dashed #cdcdcd;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
  margin-top: 20px;
  margin-right: 25%; /* Отступ справа */
  margin-left: 25%; /* Отступ слева */
}

table{
text-align: center;
width:100%;
}

.input-text{
width:100%;
}

.td-input-text{
width:80%;
}

table, th, td{
  padding-top: 5px;
  padding-bottom: 5px;
}

button{
    width: 200px;
    height: 50px;
}

</style>

</head>
<body>
<div class="table-plane">
<table>

<tr>
<td><strong>Название</strong></td>
<td class ="td-input-text"><input name="NAME" class = "input-text" maxlength="25" size="40" value=""></td>
</tr>

<tr>
<td><strong>Описание</strong></td>
<td><textarea name="DESCRIPTION" class = "input-text" style="height:200px; maxlength="2500" placeholder="подробное описание товара""></textarea></td>
</tr>

<tr>
<td><strong>URL фото</strong></td>
<td>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple>
    <button type="submit">Загрузить</button>
  </form>
</td>
</tr>

<tr>
<td><strong>Старая цена</strong></td>
<td><input name="OLDPRICE" class = "input-text" maxlength="25" size="40" value=""></td>
</tr>

<tr>
<td><strong>Актуальная цена</strong></td>
<td><input name="PRICE" class = "input-text" maxlength="25" size="40" value=""></td>
</tr>

<tr>
<td><strong>Количество</strong></td>
<td><input name="AMOUNT" class = "input-text" maxlength="25" size="40" value=""></td>
</tr>

<tr>
<td><strong>Теги (через ;)</strong></td>
<td><input name="TAG" class = "input-text" maxlength="25" size="40" value="" placeholder="Новаинка;Лучший сорт"></td>
</tr>

<tr>
<td colspan="2"><b>Отображать в каталоге?</b>
<input checked="checked" type="radio" name="AVAILABILITY" value="true">Да
<input type="radio" name="AVAILABILITY" value="false">Нет</td>
</tr>

<tr>
<td colspan="2">


</td>
</tr>

</table>
</div>

<div class="table-plane">
<table>
  <tr>
  <td><strong>ЧПУ</strong></td>
  <td><input name = "4PU" class = "input-text" maxlength="30" size="30" value="" placeholder="Краткое название для адресной строки"></td>
  <td><input class = "input-text" maxlength="30" size="30" value="" placeholder="Эта строчка генерируется автоматически"></td>
  </tr>
  <tr>
  <td><strong>SKU</strong></td>
  <td><input maxlength="5" size="10" value=""></td>
  <td><input checked="checked" type="radio" name="SKU" value="rnd">Слуйчайно</td>
  </tr>
  <tr>
  <td colspan="3"><p style="text-align: center"><button>Проверить и отправить</button></td>
  </tr>
</table>
</div>
</body>
</html>
