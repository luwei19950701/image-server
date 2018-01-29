<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Example</title>
</head>
<body>
<p>原图</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg" alt="">
<h2>图片缩放</h2>
<h4>单边缩略</h4>
<p>将图缩略成高度为100，宽度按比例处理。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,h_100" alt="">
<h4>强制宽高缩略</h4>
<p>将图强制缩略成宽度为100，高度为100。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,m_fixed,h_100,w_100" alt="">
<h4>等比缩放，限定在矩形框内</h4>
<p>将图缩略成宽度为100，高度为100，按长边优先。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,m_lfit,h_100,w_100" alt="">
<p>将图缩略成宽度为100，高度为100，按长边优先，将图片保存成png格式。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,m_lfit,h_100,w_100/format,png" alt="">
<h4>等比缩放，限定在矩形框外</h4>
<p>将图缩略成宽度为100，高度为100，按短边优先。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,m_mfit,h_100,w_100" alt="">
<h4>固定宽高，自动裁剪</h4>
<p>将图自动裁剪成宽度为100，高度为100的效果图。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,m_fill,h_100,w_100" alt="">
<h4>固定宽高，缩略填充</h4>
<p>将原图指定按短边缩略100x100, 剩余的部分以单色填充。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,m_pad,h_100,w_100" alt="">
<p>将图按短边缩略到100x100, 然后按红色填充。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,m_pad,h_100,w_100,color_FF0000" alt="">
<p>将图按比例缩略到原来的1/2。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,p_50" alt="">
<h2>内切圆</h2>
<p>裁剪半径是100, 保存圆是原来大小。如果保存成jpeg格式，外围是以白色填充。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/circle,r_100" alt="">
<p>裁剪半径是100, 保存圆是能包含圆的最小正方形，如果保存成png格式，外围是以透明色填充</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/circle,r_100/format,png" alt="">
<h2>裁剪</h2>
<p>裁剪图从起点(100, 50)到图的结束</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/crop,x_100,y_50" alt="">
<p>裁剪图从起点(100, 50)到裁剪100x100的大小</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/crop,x_100,y_50,w_100,h_100" alt="">
<p>裁剪图右下角格子的左上角起200x200的大小，超出原图部分只裁剪到原图结尾</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/crop,x_0,y_0,w_200,h_200,g_se" alt="">
<p>裁剪图右下角格子的左上角往下10x10起200x200的大小，超出原图部分只裁剪到原图结尾</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/crop,x_10,y_10,w_200,h_200,g_se" alt="">
<h2>索引切割</h2>
<p>对图片 x 轴按 100 平分，取出第一块。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/indexcrop,x_100,i_0" alt="">
<p>对图片 x 轴按 100 平分，取出第一百块，仍然是原图。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/indexcrop,x_100,i_100" alt="">
<h2>圆角矩形</h2>
<p>裁剪圆角半径是 30, 格式是 jpg。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/rounded-corners,r_30" alt="">
<p>图片先自动裁剪成 100x100, 然后保存成圆角半径是 10，格式是 png。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/crop,w_100,h_100/rounded-corners,r_10/format,png" alt="">
<hr>
<h2>自适应方向</h2>
<p>将图缩略成宽度为 100，对图片不做自动旋转处理。</p>
<img src="http://127.0.0.1:8001/storage/images/f.jpg?x-oss-process=image/resize,w_100/auto-orient,0" alt="">
<p>将图缩略成宽度为 100，对图片进行自动旋转, 得到的目标效果图宽度是 100，高度是 127。</p>
<img src="http://127.0.0.1:8001/storage/images/f.jpg?x-oss-process=image/resize,w_100/auto-orient,1" alt="">


<p>将原图按顺时针旋转 90 度。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/rotate,90" alt="">
<p>将原图缩略成宽度为 200，高度为 200，并按顺时针旋转 90 度。</p>
<img src="http://127.0.0.1:8001/storage/images/example.jpg?x-oss-process=image/resize,w_200,h_200/rotate,90" alt="">














</body>
</html>