
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <title>折线、多边形、圆</title>
    <link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
    <script src="https://webapi.amap.com/maps?v=1.4.10&amp;key=f196cc0a77b342559eee389235569500&amp;plugin=AMap.Driving"></script>
    <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>
</head>
<body>
<div id="container"></div>
<script>
    //基本地图加载
    var map = new AMap.Map("container", {
        resizeEnable: true,
        center: [116.400336, 39.903305],//地图中心点
        zoom: 13 //地图显示的缩放级别
    });

    //导航
    AMap.service(["AMap.Driving"], function() {
        var driving = new AMap.Driving({
            map: map,
            //选择距离最短搜索策略
            policy: AMap.DrivingPolicy.LEAST_DISTANCE,
            panel: "panel"

        }); //构造路线导航类
        // 根据起终点坐标规划步行路线,注意经纬度之间的空格
        driving.search([origin_lon, origin_lat],[destination_lon, destination_lat);
    });

</script>
</body>
