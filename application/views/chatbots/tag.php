  <html>
  <head>
  <div class="article-title"> 
  熱門標籤
  </head>
  <body>
    
   
   <div class="article-wrap">
  <?php foreach ($tags as $tag): ?>
  <div class="article-brief clear">
   
    <section class="article-brief-content">
      <div class="article-title">
        <?php echo $tag['name'] ?>
      
        <?php echo $tag['created_at'] ?>
      </div>
    </section>
  </div>
  <?php endforeach; ?>
</div> 
    
  </body>
  

</html>