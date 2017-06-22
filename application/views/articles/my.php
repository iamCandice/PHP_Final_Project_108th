<div class="manage_wrap">
	<p>我的文章</p>
	<table column="5">
    <thead>
      <tr>
        <th>標題</th>
        <th>瀏覽次數</th>
        <th>建立時間</th>
        <th ></th>
        <th ></th>
        <th ></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($articles as $article): ?>
        <tr>
        	<td><?php echo $article['title'] ?></td>
        	<td><?php echo $article['views'] ?></td>
        	<td><?php echo $article['created_at'] ?></td>
         	<td><a href="<?php echo site_url('articles/'.$article['id']) ?>">觀看</a></td>
            <td><a href="<?php echo site_url('articles/'.$article['id'].'/edit') ?>">修改</a></td>
            <td><a href="<?php echo site_url('articles/'.$article['id'].'/destroy') ?>">刪除</a></td>
       	</tr>
      <?php endforeach; ?>
    </tbody>
	</table>
</div>
