<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <form id="upload-form" action="/admin.php/Index/upLoadFile" method="post" enctype="multipart/form-data">
        <label>filename:</label>
        <input type="file" name="file" id="file">
        <br><br>
    	<div id="progress" class="progress" style="margin-bottom:15px;display:none;">
    		<div class="label">0%</div>
		</div>
        <input type="submit" value="Submit">
    </form>
</body>
 <script type="text/javascript" src="/Public/js/jquery-3.2.1.min.js"></script>
 <script type="text/javascript">

 	function fetch_progress(){
    $.get('/admin.php/Index/getUploadProcess',{ '<?php echo ini_get("session.upload_progress.name"); ?>' : 'test'}, function(data){
        var progress = parseInt(data);
        $('#progress .label').append(progress + '%<br>');
        if(progress < 100){
            setTimeout('fetch_progress()', 1);    //当上传进度小于100%时，显示上传百分比
        }else{
            $('#progress .label').append('完成!'); //当上传进度等于100%时，显示上传完成
        }
    }, 'html');
}

$('#upload-form').submit(function(){
    $('#progress').show();
    fetch_progress();
    // setTimeout('fetch_progress()', 100);//每0.1秒执行一次fetch_progress()，查询文件上传进度
});
 </script>
</html>