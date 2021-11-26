# 随机图片 API 修改版 by 七夏浅笑

## 直接食用

API 地址： <https://img.xhtml.love/random/index.html>

## 调用地址

```plain
http://example.com/api.php
```

## 调用参数

### 返回协议头

```plain
ssl = true / false / auto
```

true: 默认值，返回 https 链接

false: 返回 http 链接

auto: 自适应，返回值为 `//example.com/example`

### 返回图片大小

```plain
size = large / mw1024 / mw690 / bmiddle / small / thumb180 / thumbnail / square
```

默认 large

### 返回数据类型

```plain
return = redirect / json / jsonpro / url / img
```

redirect: 默认值，直接跳转到图片

json: 返回一条标准json数据(图片地址)

jsonpro: 返回十条标准json数据(图片地址)

url: 直接返回一条图片链接

img: 直接显示图片不返回图片链接

> 免费程序，遵循开源协议，请勿用于商业用途 转载请加出处 多谢合作~
>  
> 原出处： `https://github.com/Suxiaoqinx/acgimgurl`
