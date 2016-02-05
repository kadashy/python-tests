<!DOCTYPE html>
<html>
<head>


<style>

.right 
{
    position: absolute;
    right: 0px;
}

.center 
{
    position: absolute;
    font-size: 18px;
    left: 0%;
    top: 50%;
    width: 100%;
}

table {    text-align: center;    border-collapse: collapse; }
th {         font-weight: normal;     padding: 8px;  border-top: 4px ;    border-bottom: 1px ; }

td {    padding: 8px;      border-bottom: 1px ;     border-top: 1px ; }

</style>

</head>
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','kadashy','123456789','shop');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


mysqli_select_db($con,"ajax_demo");
$sql="SELECT id_ingreso, Costo, Proveedor, Cambio, Cantidad, Peso, Fecha FROM kardex  WHERE id_producto_kard = '".$q."'";
//$sql="SELECT id_product, Costo, Proveedor, Cambio, Cantidad, Peso, Fecha FROM ps_product ";
$result = mysqli_query($con,$sql);
$casilla_a_modificar = mysqli_query($con,$sql);


echo "<table id='dataTable'>
<tr>
    <tr>
        <td></td>
        <td><strong>ID </strong> &nbsp;&nbsp;</td>
        <td><strong>Precio de costo</strong></td>
        <td><strong>Proveedor</strong></td>
        <td><strong>Tasa de cambio</strong></td>
        <td><strong>Cantidad adquirida</strong></td>
        <td><strong>Peso (g)</strong></td>
        <td><strong>Fecha</strong></td>
    </tr>
</tr>";

echo"   <p class='center' >Historico de datos </p> ";


while($row = mysqli_fetch_array($result)) 
{
    echo "<tr>";
    echo "<td> <input type='checkbox' name='sel'>   </td>";
    echo "<td>" . $row['id_ingreso'] . "</td>";
    echo "<td>" . $row['Costo'] . "</td>";
    echo "<td>" . $row['Proveedor'] . "</td>";
    echo "<td>" . $row['Cambio'] . "</td>";
    echo "<td>" . $row['Cantidad'] . "</td>";
    echo "<td>" . $row['Peso'] . "</td>";
    echo "<td>" . $row['Fecha'] . "</td>";
    echo "</tr>";
}
echo "</table>";



mysqli_close($con);




?>
</body>
</html>