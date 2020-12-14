<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>文章列表</title>
<meta name="keywords"  content="DeathGhost" />
<meta name="description" content="DeathGhost" />
<meta name="author" content="DeathGhost,deathghost@deathghost.cn">
<link rel="icon" href="/jyl/images/icon/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="/jyl/css/style.css" /><script src="/jyl/js/html5.js"></script>
<script src="/jyl/js/jquery.js"></script>
<script>
$(document).ready(function(){
  $("nav .indexAsideNav").hide();
  $("nav .category").mouseover(function(){
	  $(".asideNav").slideDown();
	  });
  $("nav .asideNav").mouseleave(function(){
	  $(".asideNav").slideUp();
	  });
});
</script>
</head>
<body>
<!--header-->
@include('layout.header')
 <script>
 $(document).ready(function(){
   //测试效果，程序对接如需变动重新编辑
   $(".switchNav li").click(function(){
     $(this).addClass("active").siblings().removeClass("active");
     });
   $("#chanpin").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入产品关键词或货号");
     });
   $("#shangjia").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入商家店铺名");
     });
   $("#zixun").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入关键词查找文章内容");
     });
   $("#wenku").click(function(){
     $(".inputWrap input[type='text']").attr("placeholder","输入关键词查找文库内容");
     });
   });
   
 </script>
 
 <!--导航指向-->
<aside class="wrap insideLink">
  <a href="index.html">首页</a>
  <a href="article_list.html">最新资讯</a>
</aside>
<section class="wrap atc_list">
 <article>
  <!--循环atcLi-->
  <div class="atcLi">
   <h2><a href="article_read.html">习近平上任3年多出访40多国 行程可绕地球7圈</a></h2>
   <p>习近平出访行程2015年，我们的习总可是相当操劳，国内事务繁重不说，光是出访他国，就达到了11次，其中不乏俄美英等大国，总行程超过42天。</p>
  </div>
  <div class="atcLi">
   <h2><a href="article_read.html">元旦雾霾“锁杭城” 游客霾中探西湖(图)</a></h2>
   <p>据浙江省环保厅1月1日10时的实时监测数据，杭州PM2.5实时浓度为193，达到重度污染级别。</p>
  </div>
  <div class="atcLi">
   <h2><a href="article_read.html">数百民众参加中国海岸线最高峰新年晓钟祈福</a></h2>
   <p>随着“新年第一钟”的敲响，一年一度的崂山“太平晓钟”新年祈福拜寿活动在仰口游览区拉开序幕。数百民众参加了一年一度的中国海岸线最高峰新年祈福传统活动。</p>
  </div>
  <div class="atcLi">
   <h2><a href="article_read.html">北京东城居民楼突发火灾致3人遇难(图)</a></h2>
   <p>昨晚11点，夕照寺西里六号楼的一居民楼突发起火，燃烧到2点。据居民介绍，一层收废品夫妻家的堆垃圾起火引发火灾。</p>
  </div>
  <div class="atcLi">
   <h2><a href="article_read.html">房企大佬：一线城市房价不涨开发商就死定了</a></h2>
   <p>黄文仔认为，目前，二、三线城市的房地产库存量较大，“基本上都是亏本销售”，一线城市则面临着土地成本高企的问题。</p>
  </div>
  <div class="atcLi">
   <h2><a href="article_read.html">成龙捐赠台北故宫“圆明园12生肖兽首”被指统战</a></h2>
   <p>两个多月前得知成龙有意捐赠后，经故宫器物处评估也获台北故宫南院设计师姚仁喜同意规划在中庭做为公共艺术。</p>
  </div>
   <!--分页-->
   <div class="paging">
    <a>第一页</a>
    <a class="active">2</a>
    <a>3</a>
    <a>...</a>
    <a>89</a>
    <a>最后一页</a>
   </div>
 </article>
 <aside>
  <!--相关文章-->
  <div class="rlvt_atc">
   <h3>招标资讯</h3>
   <ul>
    <li><a href="article_read.html">组图：巨型乌木根雕《清明上河图》亮相深圳</a></li>
    <li><a href="article_read.html">习近平陪同莫迪参观大雁塔 莫迪赠送菩提树</a></li>
    <li><a href="article_read.html">载40人旅游大巴在陕西咸阳坠入山沟 已35人</a></li>
    <li><a href="article_read.html">国务院部署宽带降费提速 运营商今公布新方</a></li>
    <li><a href="article_read.html">贵州惠水一公职人员死于家中 胃内发现71枚硬币</a></li>
    <li><a href="article_read.html">缅甸两枚炮弹再次落入中国云南境内 致4人受</a></li>
    <li><a href="article_read.html">三大运营商公布提速降费方案 资费最高降35%</a></li>
    <li><a href="article_read.html">合肥少女被毁容案宣判 受害少女周岩获赔172</a></li>
    <li><a href="article_read.html">马英九引三国论两岸关系：天下大势分久必合</a></li>
    <li><a href="article_read.html">李克强：机关事业单位工资6月底前调整到位</a></li>
   </ul>
  </div>
 </aside>
</section>
<!--footer-->
@include('layout.foot')
</body>
</html>
