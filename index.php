<?php

 require_once('./function.php');


 const  APPPRIKEY='MIIEpAIBAAKCAQEA7xCFR+0kqbqXccvJ1W6b7hAFJj93LZ8fnhx1hhrAxjMyxEyS4U35X11D9M2w/2WLOgjIOUpKoqkEZcMmhUVpf0WzLa1DW0rNj/b3NAE65z+rTjDoqQ3zTHuH91crPXmX5Fsf2QGQyvscKKsYVRLmMdxc/GAZYmBApEMbjt5jJZ4lQlwPigrF6i4Y9E9LePUPu5yGFR3NdQP5lVRyeSaYOWfg3XTQvD3hBg6jax2XI1z2WUtmU9O18D9wXOvcb5DUGO/JUB401dGO01+KLcwwt0NoHAyZH8YOfZ3Bl/xghwqIXHAEV9iDDPjhoEgmWSrck0eaC7XHkMNQGMq4Yb1zIwIDAQABAoIBABZ5Vh5B4+101iHjh5Dh+hSyOtmyo7CNQfqqMD4wK6k2TPJ5RGGb4/KcIPRVlescj68f/jqsikGqY/hxFSD4Ooe1dLe5jxh4+sQq8mhYKUJuENuj62thHVs2Tbzp2+3GjYnxKxhKdmMuoiIMm5f709oiHje3jQtbgxguGtweefGiMtP7vFc5IqyrdFwgqLKOmj3DWq238eKyfhca+KhkeQ32+MU8s/EaRLwEieKz8+qYprJAb2L0+LpCQ+At61h0OlivRT5D3BuSF2hZjvWcYLbWzEyWl1cjlfXqCBdW64YYxKLwPYXgO7s00bwZZ+ZjHaTz/genJjAyc39loZIM0skCgYEA/rUTF21HLyw52J8nb/8BUUzOtnO0CvcCQp7+Qd24DvKN0ZixCq2jLH4s/RQrd1B4MdWn7U0/hV+FtDuSFEIKILbBfuM0E+PlFIBWCNsQisCTP39C7Dvk+GDkSVqtK4QkJWbY4XKcrZbr3mLMBqUxLWsQPt4S6damY7OPC3c04N0CgYEA8EcfUigWfRzaUmIpHHRJ45CaL3y9FlvAnK0+o9CczmaN/U9B9W8ew2T3d+qV79mvPKTqf+gwj9VzzDvehI7GXb/FatBCqO0DKnw3XYpGCyIL+24BUOfprvXKds+yEHH0m7ssftgyVbaEJNE8ogSLHSQ+C/Q0TbxpzoatR3XMY/8CgYEAhQOpGbXe09rDxsWuwcUpOfzjgtK/tm4yhvojC+CvC1dOCqQz6MCvE0A9XFkZLfEfI99RGBMcVhmBaJMngV7PjTADsrESdESyUFeJFozYga15+FIMb/QDalanQUuSXcRfYAzqvCmvetPzD6sGo33HRdHApSQyOl33fN+7lyBExB0CgYALx6DceUSo+5okgdV8JKNeub8lZtsqVnM5+zBf/aFCaTq62YDlVH5QnAmZ4nFZYfW6Zmdsv+hplNBpieHd49YL0JQQKYerGnuWQKLCPj4y24d02y7LVaNaRYiYjJQxRDT20ZVb3qORGjKeT3fGhayAUD+OfHl3+i3Bx06Fe1v65wKBgQD2sUnVBrvZ6bQ/nBrCw2GyWPZ/lfWLyyHa2Pt5l0+Abce1FB6TjIW+k3jZ0JbSqWDOALDH7tM6IEopFo+FMHcwNglk1UFRedoB83HcBZcPGNaDr1EfRb9BKfFTFCFECnkyx556p7Ui9NKW6uuM6uVwiuKOdssboSp3NQu5oWp7FA==';

const NEW_PAYGATEWAY = 'https://openapi.alipaydev.com/gateway.do';
 $pub_params = [
            'app_id'    => '2016091100484352',
            'method'    =>  'alipay.trade.page.pay', //接口名称 应填写固定值alipay.trade.page.pay
            'format'    =>  'JSON', //目前仅支持JSON
            'return_url'    => 'http://localhost/pay2/return.php', //同步返回地址
            'charset'    =>  'UTF-8',
            'sign_type'    =>  'RSA2',//签名方式
            'sign'    =>  '', //签名
            'timestamp'    => date('Y-m-d H:i:s'), //发送时间 格式0000-00-00 00:00:00
            'version'    =>  '1.0', //固定为1.0
            'notify_url'    => 'http://localhost/pay2/notify.php', //异步通知地址
            'biz_content'    =>  '', //业务请求参数的集合
        ];
 $api_params = [
            'out_trade_no'  => date('YmdHis'),//商户订单号
            'product_code'  => 'FAST_INSTANT_TRADE_PAY', //销售产品码 固定值
            'total_amount'  => 1.68, //总价 单位为元
            'subject'  => '新版支付宝支付', //订单标题
        ];

 $pub_params['biz_content'] = json_encode($api_params,JSON_UNESCAPED_UNICODE);


 $pub_params =setRsa2Sign($pub_params);
 $url = NEW_PAYGATEWAY . '?' .getUrl($pub_params);

   header("location:" . $url);
 

     


