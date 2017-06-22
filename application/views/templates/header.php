<!DOCTYPE html>
<html lang="zh-TW">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="all">
	<meta name="viewport" content="width = device-width">
	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url('public/assets/all.css'); ?>" media="all">
	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url('public/assets/login.css'); ?>" media="all">
	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url('public/assets/article.css'); ?>" media="all">
	<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url('public/assets/manage.css'); ?>" media="all">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<!--[if lt IE 9]-->
　　 <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
　	<!--[endif]-->
	<title>Chatbot文章上架</title>
</head>

<body class="corporate">

<!--header-->
<div class="header" id="header">
	<div class="header-main">
		<!--logo-->
		<a class="site-logo" href="<?php echo site_url(); ?>">
			<img src="<?php echo base_url('public/images/logo.png'); ?>" alt="Chatbot文章上架-logo">
			<h1>Chatbot文章上架</h1>
		</a>

		<!--navigation-->
	    <div class="header-nav" id="nav">
	      <ul>
		    <li ><a href="#" id="close"><img src="<?php echo base_url('public/images/btnClose.png'); ?>" alt="Close"></a></li>
		     <li class="header-nav-item"><a href="<?php echo site_url(); ?>">首頁</a></li>
		    <li class="header-nav-item"><a href="<?php echo site_url('/chatbots/index'); ?>">統計分析</a></li>
		    <!-- <li class="header-nav-item"><a href="/article/">搜尋</a></li> -->
	      </ul>
	    </div>
	    
		<div class="lang-nav" id="nav">   
			<?php if ($this->session->userdata('user')): ?>	    	
				<?php if (isset($_SESSION['user']['is_admin']) && ($_SESSION['user']['is_admin']==true)): ?>
					<ul id="manage">
		            	<li><a href="<?php echo site_url('admin/users'); ?>">會員管理</a></li>
		    			<li><a href="<?php echo site_url('admin/articles'); ?>">文章管理</a></li>	
		    		</ul>
	    		<?php endif; ?>
		    			        	    	
	    		<ul>
		    	<li><a href="<?php echo site_url('articles/my'); ?>">我的文章</a></li>
				<li><a href="<?php echo site_url('articles/create'); ?>">上傳文章</a></li>
				<li><a href="<?php echo site_url('sign_out') ?>">登出</a></li>
				</ul>
			<?php else: ?>
				<ul>
				<li><a href="<?php echo site_url('sign_in') ?>">登入</a></li>
				<li><a href="<?php echo site_url('sign_up') ?>">註冊</a></li>
			<?php endif; ?>
	    	</ul>	
	    </div>
	</div>	
</div>
