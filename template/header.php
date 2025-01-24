<?php
/**
    *   Grab Mixes Downloader based Mixcloud API
    *
    *   @package        Mixes Downloader
    *   @author         NamPT.Me   <nampt.me@gmail.com>
    *   @version        1.0
    *   @createdate     01/2025
    *   @note           Không xóa bản quyền khi bạn còn sử dụng bất cứ dòng code nào của tôi.
    *   Code sạch trước khi chuyển giao, tôi không chịu trách nhiệm với nội dung trang này.
*/

?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
	<meta content="yes" name="apple-mobile-web-app-capable">
	<meta name="HandheldFriendly" content="true">
	<meta name="MobileOptimized" content="width">
	<meta name="copyright" content="Copyright 2019 M.VuiZ.Net - All rights Reserved." />
	<meta name="robots" content="noodp,index,follow" />
	<meta name='revisit-after' content='1 days' />
	<meta name="language" content="English" />

	<meta name="description" content="<?php echo $desc; ?>" />
	<meta name="keywords" content="<?php echo $kword . ', ' . $desc; ?>" />
	<meta name="author" content="<?php echo $site_name; ?>" />
	<meta name="owner" content="<?php echo $site_name; ?>" />
	<meta name="distribution" content="global" />

	<meta property="og:type" content="website">
	<meta property="og:title" content="<?php echo $title; ?>">
	<meta property="og:description" content="<?php echo $desc; ?>">
	<meta property="og:url" content="<?php echo $canonical; ?>">
	<meta property="og:site_name" content="<?php echo $site_name; ?>">
	<meta property="og:image" content="<?php echo isset($site_thumbnail) ? $site_thumbnail : '/template/style/img/default.thumbnail.jpg'; ?>">
	<link rel="canonical" href="<?php echo $canonical; ?>">
	<link rel="apple-touch-icon" sizes="57x57" href="/template/style/img/icon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/template/style/img/icon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/template/style/img/icon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/template/style/img/icon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/template/style/img/icon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/template/style/img/icon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/template/style/img/icon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/template/style/img/icon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/template/style/img/icon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/template/style/img/icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/template/style/img/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/template/style/img/icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/template/style/img/icon/favicon-16x16.png">
	<link rel="shortcut icon" href="/template/style/img/icon/favicon.ico" />
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/template/style/img/icon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" />
	<link rel="stylesheet" href="/template/style/css/milligram.css" type="text/css" media="all, handheld" />
	<link rel="stylesheet" href="/template/style/css/mixstyle.css" type="text/css" media="all, handheld" />
</head>

 <body>
    <main class="wrapper">
        <nav class="navigation">
            <section class="container">
                <div class="row">
                    <div class="column">
                        <a title="<?php echo $site_name; ?>" href="/"><img alt="<?php echo $site_name; ?>" src="/template/style/img/mix.nampt.logo.png" /></a>
                    </div>
                </div>

                </div>
            </section>
        </nav>
        <header class="header" id="home">
            <section class="container center" style="text-align: center">
                <h1>Best DJ Mixes & Podcasts</h1>

                <form class="lead" id="search" action="/search" method="get">
                    <div class="form-group">
                        <input required="required" placeholder="What do you want to play?" class="form-control" type="search" autofocus="autofocus" placeholder="Enter Keyword" id="q" name="q" value="" />
                    </div>
                    <div class="form-group" style="padding-top: 10px;">
	                    <button class="button-primary" type="submit">
	                        SEARCH
	                    </button>
	                </div>
                </form>
            </section>
        </header>
