<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$g_title?></title>
</head>
<body>
the goods detail--<?=$goodsId?>
</br>
b64Crypt:<?=$b64Crypt?>
<ul>
<?foreach($goodsList as $g):?>
<li><?=$g['goodsName']?> (<?=$g['goodsId']?>)</li>
<?endforeach:?>
</ul>
</body>
</html>
