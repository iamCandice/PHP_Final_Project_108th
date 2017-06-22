<div class="manage_wrap">
	<p>管理會員資訊</p>
	<table>
    <thead>
      <tr>
        <th>名稱</th>
				<th>信箱</th>
        <th>密碼</th>
				<th>建立時間</th>
				<th></th>
				<th></th>
				<th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
         	<td><?php echo $user['name'] ?></td>
					<td><?php echo $user['email'] ?></td>
          <td><?php echo $user['password'] ?></td>
          <td><?php echo $user['created_at'] ?></td>
         	<td><a href="<?php echo site_url('admin/users/'.$user['id']) ?>">查看</a></td>
			<td><a href="<?php echo site_url('admin/users/'.$user['id'].'/edit') ?>">編輯</a></td>
            <td><a href="<?php echo site_url('admin/users/'.$user['id'].'/destroy') ?>">刪除</a></td>
       	</tr>
      <?php endforeach; ?>
    </tbody>
	</table>
</div>