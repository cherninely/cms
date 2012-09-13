<!DOCTYPE HTML>
<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="/css/style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
  <?=$header?>
  <title></title>
</head>

<body>
    
    <div id="main">
        <div id="header">
            <div id="logo_block">
                <div id="logo">
                    <a href="/" alt="logo">
                        <img width="138px" height="109px" src="/i/logo.png" />
                    </a>
                </div>
            </div>
            <div id="menu_block">
                <div id="left_menu_block"></div>                
                <div id="center_menu_block">
                    <?=$top_menu?>
                    <div id="search"><?=$search?></div>
                </div>
                <div id="right_menu_block"></div>
            </div>
        </div>
        <div id="content"><?=$content?></div>
    </div>
    <div id="footer">
        <div id="copyright">©  2012 «Хаверим»</div>
        <div id="evelsoniya"><span id="name"><a title="Рекламное агентство" href="http://evelsoniya.ru/">Evelsoniya</a></span> <br> <span id="desc">разработка и продвижение</span></div>
    </div>

</body>

</html>