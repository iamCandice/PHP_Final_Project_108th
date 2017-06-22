<!--article-->
<div class="article-page-wrap">
	<div class="article-page-content">
		<a href="#"><img src="<?php echo $article['pic_url']; ?>" alt=""></a>
		<div class="article-page-title"><?php echo $article['title']; ?></div>
		<div class="article-page-intro">
			<div><p><?php echo $article['created_at']; ?></p></div>
			<!-- <div><p><?php echo $author['name']; ?></p></div> -->
			<div><p>
				<?php foreach ($article_tag as $tag) {
					echo "<label>" . $tags[$tag] . "</label>" . "｜";
				}
				?>
			</p></div>
			<?php if (!empty($article['url'])): ?>
			<a href="<?php echo $article['url']; ?>">ChatBot</a>
		<?php endif; ?>
		</div>
		<div class="article-page-word">
			<?php echo $article['content']; ?>
		</div>
	</div>
  <!--Like or Dislike-->
  <div class="comment-button">
    <div class="like-buttom">
			<?php if ($liked): ?>
				<a href="<?php echo site_url('articles/'.$article['id'].'/dislike'); ?>">
					<img src="<?php echo base_url('public/images/like.png'); ?>" alt="like">
				</a>
				
			<?php else: ?>
				<a href="<?php echo site_url('articles/'.$article['id'].'/like'); ?>">
					<img src="<?php echo base_url('public/images/like.png'); ?>" alt="like">
				</a>
			<?php endif; ?>

			<!-- likes number -->
			<p><?php echo count($likes); ?></p>
	</div>
  </div>

	<!--comment-->
	<div class="comment-wrap">
		<div class="comment-title">留言</div>
		<!--leave comment-->
		<div class="leave-comment-wrap">
      <?php echo validation_errors(); ?>
      <?php echo form_open('articles/'.$article['id'].'/comment') ?>
        <textarea class="leave-comment" name="message"></textarea>
        <input class="submit-button" type="submit" name="submit" value="送出" />
      </form>
		</div>
    <!--comments-->
    <?php if (isset($comments)): ?>
      <?php foreach ($comments as $comment): ?>
        <div class="comment">
    			<div class="comment-body">
    				<!--Name & Date-->
    				<div class="comment-header">
              <?php if (empty($comment['user_id'])): ?>
                <div class="comment-author-name">匿名留言</div>
              <?php else: ?>
                <div class="comment-author-name"><?php echo $users[$comment['user_id']]['name']; ?></div>
              <?php endif; ?>
    					<div class="comment-date"><?php echo $comment['created_at']; ?></div>
    				</div>
    				<div class="comment-content"><?php echo $comment['message']; ?></div>
    			</div>
    		</div>
      <?php endforeach; ?>
    <?php endif; ?>
	</div>

</div>
