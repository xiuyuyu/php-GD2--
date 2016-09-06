<?php include_once("conn/conn.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>饼形图分析图书市场占有率</title>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
-->
</style></head>
<body>
<table width="550" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#999999">

  <tr>
    <td colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" align="center"><table width="100%" border="0">
            <?php 
	         $query=mysql_query("select sum(product_count) as total from  tb_data ");
	         $myrow=mysql_fetch_array($query);
		     $product_counts=$myrow[total];
		?>
            <tr>
              <td colspan="2" align="center">总的图书销量:<?php echo $product_counts;?>&nbsp;&nbsp;</td>
              </tr>
        </table></td>
      </tr>
      <tr>
        <td width="64%" height="180" align="center"><img src="caky_img.php?counts=<?php echo $product_counts;?>"/></td>
      </tr>
    </table></td>
  </tr>
  
</table>
</body>
</html>