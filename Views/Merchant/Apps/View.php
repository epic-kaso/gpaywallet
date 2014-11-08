<?php include_once './Views/Merchant/Common/Navbar.php'; ?>

<div class="container" style="padding-top: 100px">
   <div class="row">
       <div class="col-sm-4">
           <div class="list-group">
               <a class="list-group-item" href="">Dashboard</a>
               <a class="list-group-item" href="?action=users">Users</a>
               <a class="list-group-item" href="?action=transactions">Transactions</a>
               <a class="list-group-item" href="?action=api">Api</a>
           </div>
       </div>
       <div class="col-sm-8">
           <div class="panel">
               <div class="panel-heading">
                   <h3><?= $app->name ?></h3>
                   <p><?= $app->app_url ?></p>
               </div>
               <table class="table">
                   <tr>
                       <td>Users Count: </td>
                       <td>0</td>
                   </tr>
                   <tr>
                       <td>Transactions Today: </td>
                       <td>0</td>
                   </tr>
                   <tr>
                       <td>Transactions All Time: </td>
                       <td>0</td>
                   </tr>
                   <tr>
                       <td>Earning Today: </td>
                       <td>0</td>
                   </tr>
                   <tr>
                       <td>Earnings All Time: </td>
                       <td>0</td>
                   </tr>

               </table>
           </div>
       </div>
   </div>
</div>