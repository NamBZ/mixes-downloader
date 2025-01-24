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

require './template/index.config.php';
require './template/header.php';
require './src/MixCloud.class.php';


/* LOGIC GET TREND MIXS */
$mixsTrend = new MixCloud();
$mixsTrend = $mixsTrend->getMixChart($_GET['next'] ?? null);
$htmlTrend = '';
if (isset($mixsTrend['casts'])) {
    foreach ($mixsTrend['casts'] as $mix) {
        $htmlTrend .= '
            <blockquote class="post" style="margin: 2px 0">
                <div class="row">
                    <div class="column column-20">
                        <a href="/' . $mix['username'] . '/' . $mix['slug'] . '/" class="album-art"><img loading="lazy" alt="' . $mix['name'] . '" src="' . $mix['picture'] . '"></a>
                    </div>
                    <div class="column column-80 row" style="text-align: left">
                        <h4 class="column"><a href="/' . $mix['username'] . '/' . $mix['slug'] . '/"><i class="icon-music"></i> ' . $mix['name'] . '</a></h4>
                        <strong class="column"><a href="/' . $mix['username'] . '/" style="color:#1f1f1f"><i class="icon-user"></i> ' . $mix['owner'] . '</a></strong>
                        <div class="column">
                            <div class="row-a">
                                <div class="col-30"><i class="icon-time"></i> ' . $mix['publishDate'] . '</div>
                                <div class="col-30"><i class="icon-play-sign"></i> ' . $mix['time'] . '</div>
                                <div class="col-30"><i class="icon-eye-open"></i> ' . $mix['plays'] . '</div>
                            </div>
                        </div>
                    </div>
                </div>
            </blockquote>';
    }
} else {
    $htmlTrend .= '<blockquote><p><em>ERROR!! Couldn\'t connect to data. Please try again..</em> <a class="button button-outline" href="/"> Home </a></p></blockquote>';
}

?>


    <section class="container" style="padding-top: 2rem;">
        <h2>Top Mixes</h2>
        <?php echo $htmlTrend; ?>
        <div class="container">
            <?php echo isset($mixsTrend['next']) ? '<div class="page"><a class="button button-outline page-item" href="?next=' . $mixsTrend['next'] . '"> >> Next >> </a></div>' : '' ?>
        </div>
    </section>


<?php
require './template/footer.php';
?>