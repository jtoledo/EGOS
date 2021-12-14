
<style>
#tabs {
padding: 5px 5px;
cursor: pointer;
position: relative;
margin:1px;
margin-left:0;
margin-right:0;
font-weight:bold;
}

#tabs:hover {
color:#FFFFFF;
    background-color:#996600;
}
</style>
<br />
<?php
$perfil="perfiles";
$promo="promo";
$usua="usua";
?>
<table width="100%" border="1" style="border-collapse:collapse">
  <tr>
    <td width="27%" bgcolor="#CCCC66">
	<div align="center" id="tabs" onclick="<?php echo $perfil; ?>('<?php echo $perfil; ?>'); return false"><strong>Perfiles</strong></div>
	</td>
    <td width="41%" bgcolor="#CCCC66">
	<div align="center" id="tabs" onclick="<?php echo $promo; ?>('<?php echo $promo; ?>'); return false"><strong>Promotores</strong></div>
	</td>
    <td width="32%" bgcolor="#CCCC66">
	<div align="center" id="tabs" onclick="<?php echo $usua; ?>('<?php echo $usua; ?>'); return false"><strong>Usuarios</strong></div>
	</td>
  </tr>
</table>


<div id="perfiles">

 </div>
<div id="promo">
</div>
<div id="usuarios">
</div>
