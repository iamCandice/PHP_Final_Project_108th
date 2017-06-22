
<div class="user_info_wrap">

<h1 class="user_name"><?php echo $user['name'] ?></h1>

<?php if (empty($user['is_admin'])) {
    $admin = "否";
} else {
      $admin = "是";
  } ?>

<table class="user_info">
	<tr>
		<td>信箱</td>
		<td><?php echo $user['email'] ?></td>
	</tr>
	<tr>
		<td>密碼</td>
		<td><?php echo $user['password'] ?></td>
	</tr>
		<tr>
		<td>建立帳號時間</td>
		<td><?php echo $user['created_at'] ?></td>
	</tr>
		<tr>
		<td>上次登入時間</td>
		<td><?php echo $user['updated_at'] ?></td>
	</tr>
		<tr>
		<td>管理員</td>
		<td><?php echo $admin ?></td>
	</tr>
</table>

</div>