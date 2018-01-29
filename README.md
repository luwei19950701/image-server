### 说明
搭建一个像阿里云oss一样处理图片的服务器
### 安装
```shell
git clone https://gitee.com/addelete/image-server.git
cd image-server
composer install
```
### nginx 配置
```nginx
server {
    listen 8001;
    index index.html index.htm index.php;
    root /path/image-server/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ^~ /storage/ {
        if ( $query_string ~* x-oss-process.* ){
            rewrite ^/.*$ /index.php;
        }
    }

    location ~ \.php {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        set $real_script_name $fastcgi_script_name;
        if ($fastcgi_script_name ~ "^(.+?\.php)(/.+)$") {
            set $real_script_name $1;
        }
        fastcgi_param SCRIPT_FILENAME $document_root$real_script_name;
        fastcgi_param SCRIPT_NAME $real_script_name;
    }
}
```

### 配置
如果环境中安装了ImageMagick, 并且php-imagick扩展也开了，就不需要改配置了.  
否则condig/image.php 修改为如下配置:
```php
'driver' => 'gd'
```
当然，最好装一下ImageMagick，据说输出的图会更好看点

### 用法
打开 http://127.0.0.1:8001/example