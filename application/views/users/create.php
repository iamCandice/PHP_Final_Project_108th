<div class="wrap">
  <?php echo validation_errors(); ?>
	<?php echo form_open('users/creating') ?>
  <div class="data">
    <label for="name">名稱</label>
      <input type="input" name="name" /><br />
  </div>
		<div class="data">
			<label for="email">帳號</label>
		    <input type="input" name="email" /><br />
		</div>
		<div class="data">
		    <label for="password">密碼</label>
		    <input type="password" name="password" /><br />
		</div>
		<div class="confirm">
	    <input type="submit" name="submit" value="註冊" />
	    </div>
	</form>
</div>
