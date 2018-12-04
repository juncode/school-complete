###接口文档

#### 登录
```
    user/auth
        Method:post
        参数：
            code
            nickname
            gender
            avatar_url
    
        返回 token
            {code:200, data:{toekn:xxx}}             
```

#### 获取用户信息
```
    user/info
        Method:get
        header: token
        参数：
            nickname
            gender
            avatar_url
    
        返回 token
            {code:200, data:{nickname:xxx,...}}             
```

#### 获取用户关注作者信息
```
    user/author
        Method:get
        header: token
        参数：
        返回 token
            {code:200, data:[{author:xxx,user_id:xxxx,type_name:xxx,avatar:xx,intro:xx,fans_count}]}             
```

#### 获取用户关注电影信息
```
    user/video
        Method:get
        header: token
        参数：
        返回 token
            {code:200, data:[{title:xxx,conver:xxxx,video_id:xxx,user_id:xx,tag:xx,play_count:xxx,add_time:xxx,browse_count:xxx,duration:xxx}]}             
```

#### 获取热门电影信息
```
    video/list
        Method:get
        参数：type，title,author （具体作者的user_id 值）
        header: token（可选）
        参数：
        返回 token
            {code:200, data:[{title:xxx,conver:xxxx,video_id:xxx,user_id:xx,tag:xx,play_count:xxx,add_time:xxx,browse_count:xxx,duration:xxx}]}             
```
#### 获取电影详情信息
```
    video/detail
        Method:get
        参数：video_id
        header: token(可选）
        参数：
        返回 token
            {code:200, data:[{title:xxx,conver:xxxx,video_id:xxx,user_id:xx,tag:xx,play_count:xxx,add_time:xxx,browse_count:xxx,duration:xxx}]}             
```


#### 分类列表
```
    video/type
        Method:get
        参数：
        返回 token
            {code:200, data:[{name:,sort:}]}             
```


#### 按分类搜索作者
```
    video/author
        Method:get
        参数：type
        返回 token
            {code:200, data:[{author:,type_name,avatar,intro,fans_count}]}             
```


#### 关注 作者
```
    user/sub
        Method:post
        参数：author, 作者列表id,非user_id
        返回 token
            {code:200, data:}             
```


#### 收藏电影
```
    user/col
        Method:post
        参数：video, 列表id,非video_id
        返回 token
            {code:200, data:}             
```



#### 域名：
#### https://video.acwxo.cn
#### 自拍列表
```
    url:
        http://video.acwxo.cn/zp/list?page=1&limit=20
```
#### 自拍详细
```
     url:
        https://video.acwxo.cn/zp/detail?cid=meinv155063&page=1limit=20
```

