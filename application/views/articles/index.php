<div class="article-wrap">
	<?php foreach ($articles as $article): ?>
	<div class="article-brief clear">

    <?php if (!empty($article['pic_url'])): ?>
      <a href="<?php echo site_url('articles/'.$article['id']) ?>"><img src="<?php echo $article['pic_url'] ?>" alt=""></a>
    <?php else: ?>
      <a href="<?php echo site_url('articles/'.$article['id']) ?>"><img src="<?php echo base_url('public/images/test.jpg'); ?>" alt=""></a>
    <?php endif; ?>
		<section class="article-brief-content">
			<div class="article-title">
				<a href="<?php echo site_url('articles/'.$article['id']) ?>"><?php echo $article['title'] ?></a>
			</div>
			<div class="article-intro">
				<?php echo $article['content'] ?>
			</div>
			<div class="article-footer">
				<?php echo $article['created_at'] ?>
			</div>
		</section>
	</div>
  <?php endforeach; ?>
</div>
