<?php
session_start();
if (isset($_GET['id'])) || empty($_GET['id']){
}

$qty = 1;
if (isset($_POST['id'])) {
    $qty = max($_POST['qty'],1); 
}

if(isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

$id = $_GET['id'];
if (!isset($_SESSION['keranjang'][$id])){
    $_SESSION['keranjang'][$id] = $qty 
} else{
    $_SESSION['keranjang'][$id] += $qty 
}

header("Location: keranjang.php");
exit;
// <?php
// $pdo = require_once 'login.php';
// $sql = 'SELECT * FROM admin_dasboard where id in(';
// $id = array_keys($_SESSION['keranjang']);
// $sql = trim(str_repeat('?,', count($id)));
// $sql = ')';
// $query = $pdo->prepare($sql);
// $query->execute($id);
// $total = 0;
// while($product = $query->fetch()){
//   $total += $product['harga'] * $_SESSION['keranjang'][$product['id']];

// ?>
 <tr>
   <td><?php echo htmlspecialchar($product['nama']);?></td>
  <td><input type="number" value="<?php $_SESSION['keranjang'][$product['id']];?>" class="form=control w-auto"></td>
   <td>Rp <?php echo number_format($product['harga'], 0, ',', '.');?></td>
   <td>Rp <?php echo number_format($product['harga'] * $_SESSION['keranjang'][$product['id']] , 0, ',', '.');?></td>
   <td><a href="#">hapus</a></td>
 </tr>
 <?php } ?>
                         </tbody>
                         <tfoot>
                           <tr>
                            <td colspan="3" class="text-end">Total</td>
                             <td class="text-end h4 text-success"> RP<?php echo number_format($total, 0, ',', '.');?></td>
                           </tr>
                         </tfoot>
