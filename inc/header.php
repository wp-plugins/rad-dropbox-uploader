<link rel="stylesheet" href="<?php echo WP_PLUGIN_URL ?>/rad-dropbox-uploader/assets/style.css" type="text/css" />
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js'></script>
<script type="text/javascript">
var MYBLOG_LIMIT = 5;
var MYWRAPPER_CLASS = 'blog-posts';
 
var WP={open:function(b){var a={posts:function(){var d=MYBLOG_LIMIT;var e=0;var c={all:function(g){var f=b+"/api/get_recent_posts/";f+="?count="+d+"&page="+e+"&callback=?";jQuery.getJSON(f,function(l){var k=l.posts;for(var j=0;j<k.length;j++){var h=k[j];h.createComment=function(i,m){i.postId=h.id;a.comments().create(i,m)}}g(k)})},findBySlug:function(f,h){var g=b+"/api/get_post/";g+="?slug="+f+"&callback=?";jQuery.getJSON(g,function(i){h(i.post)})},limit:function(f){d=f;return c},page:function(f){e=f;return c}};return c},pages:function(){var c={findBySlug:function(d,f){var e=b+"/api/get_page/";e+="?slug="+d+"&callback=?";jQuery.getJSON(e,function(g){f(g.page)})}};return c},categories:function(){var c={all:function(e){var d=b+"/api/get_category_index/";d+="?callback=?";jQuery.getJSON(d,function(f){e(f.categories)})}};return c},tags:function(){var c={all:function(e){var d=b+"/api/get_tag_index/";d+="?callback=?";jQuery.getJSON(d,function(f){e(f.tags)})}};return c},comments:function(){var c={create:function(f,e){var d=b+"/api/submit_comment/";d+="?post_id="+f.postId+"&name="+f.name+"&email="+f.email+"&content="+f.content+"&callback=?";jQuery.getJSON(d,function(g){e(g)})}};return c}};return a}};
 
var blog = WP.open('http://www.afcreative.ca');
blog.posts().all(function(posts){
  for(var i = 0; i < posts.length; i++){
    jQuery('.'+MYWRAPPER_CLASS).append(function(){
      return (posts[i].thumbnail) ? '<li><a href="'+posts[i].url+'" target="_blank">'+posts[i].title+'</a></li>' : 'Test';
 
    });
  }
});
</script>
<div class="dropbox-uploader-header">
<div class="title">RAD Dropbox Uploader</div>
<div class="sub">Version 1.1.3</div>
</div>