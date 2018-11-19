<?php

use Illuminate\Support\Facades\Storage;

//获取对应的上传图片
if (!function_exists('getImages')) {
    function getImages($images)
    {
        $pics = [];
        if (!empty($images)) {
            $max_images = json_decode($images, true);

            if (isset($max_images['url']) && is_array(array_filter($max_images['url']))) {
                foreach ($max_images['url'] as $k => $v) {
                    if (Storage::disk('public')->exists($v)) { //检查图片是否存在  不存在则不输出
                        $pics[$k]['url'] = env('IMAGES_URL') . $v;
                        $pics[$k]['url_name'] = $v;
                        $pics[$k]['name'] = $max_images['name'][$k];
                    }
                }
                return json_encode($pics, true);
            }
        }
        return json_encode($pics, true);
    }
}
//数字求和
if (!function_exists('priceSum')) {
    function priceSum($price)
    {
        $core_price = $price->sum("core_price");
        $cost_price = $price->sum('cost_price');
        $member_price = $price->sum('member_price');
        $retail_price = $price->sum('retail_price');
        $taobao_price = $price->sum('taobao_price');
        $cooperation_price = $price->sum('cooperation_price');
        return ['core_price' => $core_price,
            'cost_price' => $cost_price,
            'member_price' => $member_price,
            'retail_price' => $retail_price,
            'taobao_price' => $taobao_price,
            'cooperation_price' => $cooperation_price];
    }
}
//去除数组为空的或者为0的字段
if (!function_exists('array_filter_empty')) {
    function array_filter_empty($array)
    {
        $filted = array_where($array, function ($value) {
            return $value;
        });
        return $filted;
    }
}
//生成26个字母

if (!function_exists('letter')) {
    function letter()
    {
        foreach (range('A', 'Z') as $v) {
            $letter[$v] = $v;
        }
        return $letter;
    }
}
//数组转换url
if (!function_exists('array_to_url')) {
    function array_to_url($array)
    {
        $url = [];
        $array = array_except($array, ['page', '_token']);
        foreach ($array as $k => $v) {
            $url[$k] = $k . '=' . $v;
        }
        $url = $url ? '&' . implode('&', $url) : '';
        return $url;
    }
}
////运算符
if (!function_exists('json_filter')) {
    function json_filter($collect, $query, $operator, $condition)
    {
        return collect($collect->filter(function ($item, $key) use ($query, $operator, $condition) {
            return assert($item->details[$query].$operator.$condition);
        })->all());
    }
}
//将网页的wordoc 输出下载
if (!function_exists('Doc')) {
    function Doc($contents, $name)
    {
        ob_start(); //打开缓冲区
        return response($contents)
            ->withHeaders([
                "Cache-Control" => 'must-revalidate, post-check=0, pre-check=0',
                "Content-type" => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                "Accept-Ranges" => 'bytes',
                "Content-Disposition" => 'File Transfer',
                "Content-Disposition" => 'attachment; filename=' . $name . '.docx',
                "Content-Transfer-Encoding" => 'binary',
                "Pragma" => 'no-cache',
                "Expires" => 0
            ]);
        ob_end_flush();//输出全部内容到浏览器
    }
}
/**
 * 人民币小写转大写
 *
 * @param string $number 数值
 * @param string $int_unit 币种单位，默认"元"，有的需求可能为"圆"
 * @param bool $is_round 是否对小数进行四舍五入
 * @param bool $is_extra_zero 是否对整数部分以0结尾，小数存在的数字附加0,比如1960.30，
 *             有的系统要求输出"壹仟玖佰陆拾元零叁角"，实际上"壹仟玖佰陆拾元叁角"也是对的
 * @return string
 */
if (!function_exists('num2rmb')) {
    function num2rmb($number = 0, $int_unit = '元', $is_round = TRUE, $is_extra_zero = FALSE)
    {
        // 将数字切分成两段
        $parts = explode('.', $number, 2);
        $int = isset($parts[0]) ? strval($parts[0]) : '0';
        $dec = isset($parts[1]) ? strval($parts[1]) : '';

        // 如果小数点后多于2位，不四舍五入就直接截，否则就处理
        $dec_len = strlen($dec);
        if (isset($parts[1]) && $dec_len > 2) {
            $dec = $is_round
                ? substr(strrchr(strval(round(floatval("0." . $dec), 2)), '.'), 1)
                : substr($parts[1], 0, 2);
        }

        // 当number为0.001时，小数点后的金额为0元
        if (empty($int) && empty($dec)) {
            return '零';
        }

        // 定义
        $chs = array('0', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖');
        $uni = array('', '拾', '佰', '仟');
        $dec_uni = array('角', '分');
        $exp = array('', '万');
        $res = '';

        // 整数部分从右向左找
        for ($i = strlen($int) - 1, $k = 0; $i >= 0; $k++) {
            $str = '';
            // 按照中文读写习惯，每4个字为一段进行转化，i一直在减
            for ($j = 0; $j < 4 && $i >= 0; $j++, $i--) {
                $u = $int{$i} > 0 ? $uni[$j] : ''; // 非0的数字后面添加单位
                $str = $chs[$int{$i}] . $u . $str;
            }
            //echo $str."|".($k - 2)."<br>";
            $str = rtrim($str, '0');// 去掉末尾的0
            $str = preg_replace("/0+/", "零", $str); // 替换多个连续的0
            if (!isset($exp[$k])) {
                $exp[$k] = $exp[$k - 2] . '亿'; // 构建单位
            }
            $u2 = $str != '' ? $exp[$k] : '';
            $res = $str . $u2 . $res;
        }
        // 如果小数部分处理完之后是00，需要处理下
        $dec = rtrim($dec, '0');

        // 小数部分从左向右找
        if (!empty($dec)) {
            $res .= $int_unit;
            // 是否要在整数部分以0结尾的数字后附加0，有的系统有这要求
            if ($is_extra_zero) {
                if (substr($int, -1) === '0') {
                    $res .= '零';
                }
            }
            for ($i = 0, $cnt = strlen($dec); $i < $cnt; $i++) {
                $u = $dec{$i} > 0 ? $dec_uni[$i] : ''; // 非0的数字后面添加单位
                $res .= $chs[$dec{$i}] . $u;
            }
            $res = rtrim($res, '0');// 去掉末尾的0
            $res = preg_replace("/0+/", "零", $res); // 替换多个连续的0
        } else {
            $res .= $int_unit . '整';
        }
        return $res;
    }
}
//数字转大写
if (!function_exists('number_uppercase')) {
    function number_uppercase($num)
    {
        $number_uppercase = array('零', '壹', '貳', '叁', '肆', '伍', '陆', '柒', '捌', '玖');
        return $number_uppercase[$num];
    }
}
//chart 随机颜色
if (!function_exists('randomColor')) {
    function randomColor()
    {
        $str = '#';
        $arr = array('990066', '009933', '33CC99', '339999', '003399', 'FF9966', 'F00000', 'CC3333', '003366', '6699CC',
            'CCCC00', '9933CC', '99CC00', 'CC0033', 'FF0033', 'FF9900', '009966', '993333', '663366', 'CCCC99',
            'CCCC33', '99CC33', 'FF9999', '663399', 'CC3399', '666699', '99CC66', '0099CC', 'FFCC99', '336699');
        $random_keys = array_rand($arr, 1);
        $str = $str . $arr[$random_keys];
        return $str;
    }

//获取后台管理员信息
    if (!function_exists('admin')) {
        function admin()
        {
            return auth('admin')->user();
        }
    }
    //获取前台用户信息
    if (!function_exists('user')) {
        function user()
        {
            return auth('user')->user();
        }
    }
    //获取配件信息
    if (!function_exists('product')) {
        function product()
        {
            return \App\Models\Product::oldest('bianhao')->get();
        }
    }
    //返回成功信息
    if (!function_exists('success')) {
        function success($message, $status = 200)
        {
            if (!is_array($message)) {
                $message = ['info' => $message];
            }
            return response()->json($message, $status);
        }
    }
    //返回错误信息
    if (!function_exists('error')) {
        function error($message, $status = 404)
        {
            if (!is_array($message)) {
                $message = ['info' => $message];
            }
            return response()->json($message, $status);
        }
    }
    //获取整机中机箱或者平台的图片
    if (!function_exists('order_complete_machine_pic')) {
        function order_complete_machine_pic($goods, $all = null)
        {

            $pic = [];
            $crate = $goods->firstWhere('product_id', 20);
            $terrace = $goods->firstWhere('product_id', 23);
            if ($terrace) {
                $pic = json_decode($terrace->pic, true);
            } else {
                if ($crate) {
                    $pic = json_decode($crate->pic, true);
                }
            }
            if ($pic && $all) {
                return $pic;
            } else {
                if ($pic) {
                    return $pic[0]['url'];
                }
            }
        }
    }
    //获取图片
    if (!function_exists('pic')) {
        function pic($pics, $all = null)
        {
            return json_decode($pics, true);
        }
    }
    //将字符串拆分成数组
    if (!function_exists('mbStrSplit')) {
        function mbStrSplit($string, $len = 1)
        {
            $start = 0;
            $strlen = mb_strlen($string);
            while ($strlen) {
                $array[] = mb_substr($string, $start, $len, "utf8");
                $string = mb_substr($string, $len, $strlen, "utf8");
                $strlen = mb_strlen($string);
            }
            return $array;
        }
    }
    //生成随机用户名
    if (!function_exists('RandomName')) {
        function RandomName($name, $len = 1)
        {
            $nameStr = mbStrSplit($name);
            $str = $nameStr[array_rand($nameStr, $len)];
            $arrStr = array('*', $str, '*', '*', '*', '*', '*');
            shuffle($arrStr);
            return implode('', $arrStr);
        }
    }
    //生成随机用户名
    if (!function_exists('drive')) {
        function drive($product_goods)
        {
            $arr=collect([]);
            foreach ($product_goods as $product_good){
                if($product_good->drive->isNotEmpty()){
                    $arr=$arr->push($product_good->drive);
                }
                if($product_good->series->drive->isNotEmpty()){
                    $arr=$arr->push($product_good->series->drive);
                }
            }

           // $filtered=[];
//            foreach ($arr->collapse() as $product_good){
//                $filtered[$product_good->file['url']]=$product_good->file['name'];
//            }
//            dd($filtered);dsad
        return $arr->collapse();
        }
    }
    //生成随机用户名
    if (!function_exists('send_baidu_url')) {
        function send_baidu_url($url){
            if($url){
                $urls =$url;
                $api = 'http://data.zz.baidu.com/urls?site=https://www.waso.com.cn&token=FmbEWJq9CfnlbgUs';
                $ch = curl_init();
                $options =  array(
                    CURLOPT_URL => $api,
                    CURLOPT_POST => true,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => implode("\n", $urls),
                    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
                );
                curl_setopt_array($ch, $options);
                $result = curl_exec($ch);
                return json_decode($result,true);
            }else{
                return false;
            }
        }
    }

}
