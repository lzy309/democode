## 需求1:模拟抓取

自行注册帐号,模拟登录 https://www.chengmi.cn/ ,并获取账户余额

解析:该形题目主要考察开发人员对于curl和正则的掌握

- 使用curl模拟情况保存cookie为后续调用
- 使用第三方API解析预抓取网站验证码
- 登录完成后通过正则表达式匹配出所需数据
- 以php-cli模式运行: php login/index.php
- <a href="http://www.baidu.com">代码参考</a>
- 运行方式:以cli模式运行 `php login/index.php`

 

## 需求2:域名注册
自行研究域名注册流程,实现域名注册功能.
其中需要用到的各种api,例如:域名注册状态,提交域名注册 自行模拟返回即可.

解析:笔者以腾讯云提供的API为参考完成该需求
使用方式:

- 添加域名

`$domain = new Domain();`

`$domain->addDomain('baidu.com')`


- 设置域名状态

`$domain = new Domain();` 

`$domain->setDomainStatus('baidu.com', true)`

- 删除域名状态

`$domain = new Domain();`

`$domain->setDomainStatus('baidu.com', true)`



## 需求3:域名品相分析
分析域名是否 数字 字母 拼音 几拼 杂米

解析:主要通过正则判断是否为包含数字和字母,域名如果只包含字母通过分割字符串提取拼音方来判断为几拼,
通过判断字符串是否包含数字、字母、- 来判断是否为杂米字符串
    
  


