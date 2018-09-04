  <table border="1">
    <thead>
      <td>ID</td>
      <td>Name</td>
      <td>Age</td>
      <td>City</td>
    </thead>
    <?php foreach ($query->result() as $row){
    ?>
    <tr>
      <td><?php echo $row->id?></td>
      <td><?php echo $row->name?></td>
      <td><?php echo $row->age?></td>
      <td><?php echo $row->city?></td>
    </tr>
    <?php } ?>
  </table>
  <table>
    <tr>
      <td>
        <?php if($page>0){ ?>
        <form method="post" action="<?php echo $page-1?>">
        <input type="submit" value="previous"/>
        </form>
        <?php } ?>
      </td>
      <td>
        <h3>Page <?php echo $page ?></h3>
      </td>
      <td>
        <?php if($query->num_rows()==5){ ?>
        <form method="post" action="<?php echo $page+1?>">
        <input type="submit" value="next"/>
        </form>
        <?php } ?>
      </td>
    </tr>
  </table>
</body>
</html>
