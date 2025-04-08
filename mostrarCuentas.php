<table>
<tr>
    <td>ID</td>
    <td>Uusario</td>
    <td>Contrasena</td>
    <td>Mail</td>
</tr>
<?php
include_once("connectDB.php");

$table = mysqli_query($nombreConexion, "SELECT * FROM `cuentas`");
if (mysqli_num_rows($table)){
    while($cuenta = mysqli_fetch_assoc($table)){
        echo "<tr><td>".$cuenta['id']."</td>";
        echo "<td>".$cuenta['usuario']."</td>";
        echo "<td>".$cuenta['contrasena']."</td>";
        echo "<td>".$cuenta['mail']."</td></tr>";
    }
}
?>
</table>