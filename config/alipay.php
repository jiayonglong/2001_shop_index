<?php
return [
		//应用ID,您的APPID。
		'app_id' => "2016102400753810",

		//商户私钥
		'merchant_private_key' => "MIIEogIBAAKCAQEAq3LF2Jeiy5dOofFxkSE8j+NgS1i+k3AELfJZmK/luwRtHIEUFGJFy5g7wJOL/xX6YSZY75LLWHB5QS9UMmMGB9fMYzBnPwsJBKGT1X/xp+wsG3eIXh26AVncXEX06gpVbJm5cSyLg00hO3wAKDaItlDKmf75JAbg7knNG5sFzAqyJRnzgqq6QtefpNCiBbJKvH+awpiK2IQgdV55VnX1GNERFP/G2UNuo9acjtCDPotdC+BF1R0n7UkUP9Up9cm3KkS/Ky9rbzzRlP2+KrrOO31TsIIFNrftXHFw8/2Q/Hsp5gK5hHauwCf/X25Lyv/WFNs3F2505pmDysAd1dzjGQIDAQABAoIBABdh3c2+UHuHtTes4Bo0+Dd/gSCFh+g/vLIvfTyvsJsi7WaXzA9Dn9U2e9+1v8AYVT9upW53DLiRDlhvhgIhMy9apQtaDJqyfJZfGvRhMKoAMbvFP5nmX/nTMZR8DfzlT+UxyfK/an+Lw16DeNoDJf4HYrpB5eSd84tMEWcUa2P6UE4ZVx1tyNJUYR6AFzdjiWZDU46wYGtnc0/v7ru4S8QxJmGHZlmaIAf/IiKeW2A9RUhYfTqs0cwx+Luko2zY1ycKFUaeuimPqeWDpSKWv9Mq4/pgZ/LzCe7aXe2NoF/16Yokz9wUjYNrQsV25b2IVENsgVL4rfRfuo1NU3tuCokCgYEA1Tm65SCB3AwnJT9rq+y2lZBL8zNUaWQuI3txdVZfOr+BWeEU9fgr2j14c47R9UOu1gZ8/Qc6ZkhJ40hT5+vN6rwDsXjPkaitlJ2GlJWEjdpFhUHmP26d2J7gQXL3JsTogzjKSqh5vZtS3Hhvma6g54PamIezUAIYAQ8Ihe6iES8CgYEAzdePtl+6XGfrNaFzO6eY/FMTlLaB2b3kQok2qbtDBdWly9zaQ7Q5uy1lB8hbo/Wv+XwHTJvgOO/ffKY81LMTr5AwFquOvlQcr8lO35+GuRQYCdsmVQJGDKqnrPUJc/eUNkjoLcJ8LibQuFWPwqdIBjtIxnIdh9ksPw1K2MinbjcCgYBmZq09MNlsxmFeYBDjpnEhbwUqrTIS00vdOoGIqoxdeG80rQYWArN8whzA0ow+z9x9aOxJ0FjZmknx32B8dyCTZOwZJT36ZBnIz8Y8QXpBbdwJXVaojAU+bT6h8AaGFfbcXj+4jyS4TIoE28os8lLQHOC0dCdHe1nv2Dptp+cpfQKBgAJTzp8sQ+opjqJDmg7xnSw1MEJ9Mcipefw6mvCeWmqleMNuUtVzIzf3km3dGRQogf3bJiX6mTVrmOZK5uMsxys0AScwd2O1hcGDEC49GoPbM05hOPS7Gtmn0E+HUb0K7pUSi/WAfnDzJWcAKKj1xT20y+Tag3T2wqZP2ynKUwJPAoGALFBFj+AaXlau7UW8MfdcAqNddXZBCbqK/GWcv3PazOHVMdmpgvHR5oQ1Oiap5AilUSblK1qMoLe5lfa/8kd2NJNt+58BE8zn9Z7D2kfhMpUQ68icc8x9+vLqXzmdb7RKDGSMzQkTF79rkNE6eBqAGoq4Q8hAkbd1598K8zRLRZM=",
		
		//异步通知地址
		'notify_url' => "http://2001.shop.index.com/notify_url",
		
		//同步跳转
		'return_url' => "http://2001.shop.index.com/return_url",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
        'sign_type'=>"RSA2",
        
        "seller_id"=> "2088102180935362",     //登录沙箱  沙箱账号 里面有商家UID

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsZlwjF+AVi5HC7Y5DukMmdoZnKwKfOz/jt5+0V1lVHrbkE5aVVtYwkRsBGfy16gQeY802mk0MGvwYRoXOyrPxp/H24F9yhVeoITM/VxpmITjLyZgttzxrBaNuQOyZR3OEX5COXpzXdjeU/4tzTcWRFmi8jKUEvikanqpPqNhIo8yGimR6N6SzANCaQVi1tE4ssvIOcFexoy1n2ZV9779TA9L4Hw4r0PmfowlzwNhofykdplIkuXPEM1cdZiX2ryUTQw3rRXn/gEJ3N0Sg8kkmi+z56o3golkNjvW/iOCcD4JcRJ8AqcN8qe55ZTAxZ9MwtpoNrIHXUuRTXyvO/Ok4wIDAQAB",
		
   ];