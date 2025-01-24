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
require './src/MixCloud.class.php';


/* LOGIC GET TREND MIXS */
$castDetails = new MixCloud();
$castDetails = $castDetails->getCastDetails($_GET['username'], $_GET['slug']);
if (!isset($castDetails['cast'])) {
    $title = 'Page Not Found | ' . $site_name;
    http_response_code(404);
    require './template/header.php';
    require './template/404.template.php';
    die();
}
/* Related Cast*/
$relatedTag = '';
if (!empty($castDetails['related'])) {
    foreach ($castDetails['related'] as $related) {
        $relatedTag .= '
            <blockquote class="post" style="margin: 1px 0">
                <div class="row">
                    <div class="column column-20">
                        <a href="/' . $related['username'] . '/' . $related['slug'] . '/" class="album-art"><img loading="lazy" alt="' . $related['name'] . '" src="' . $related['picture'] . '"></a>
                    </div>
                    <div class="column column-80 row" style="text-align: left">
                        <h4 class="column"><a href="/' . $related['username'] . '/' . $related['slug'] . '/"><i class="icon-music"></i> ' . $related['name'] . '</a></h4>
                        <strong class="column"><a href="/' . $related['username'] . '/" style="color:#1f1f1f"><i class="icon-user"></i> ' . $castDetails['cast']['owner'] . '</a></strong>
                        <div class="column">
                            <div class="row-a">
                                <div class="col-30"><i class="icon-time"></i> ' . $related['publishDate'] . '</div>
                                <div class="col-30"><i class="icon-play-sign"></i> ' . $related['time'] . '</div>
                                <div class="col-30"><i class="icon-eye-open"></i> ' . $related['plays'] . '</div>
                            </div>
                        </div>
                    </div>
                </div>
            </blockquote>';
    }
} else {
    $relatedTag = '<blockquote><p><em>No results.</em> <a class="button button-outline" href="/"> Home </a></p></blockquote>';
}

// Config 
$title = $castDetails['cast']['name'] . ' | ' . $site_name;
$canonical = $canonical . '/' . $castDetails['cast']['username'] . '/' . $castDetails['cast']['slug'];
$site_thumbnail = $castDetails['cast']['coverPicture'];

require './template/header.php';
?>
    <section class="container" style="padding-top: 2rem;">
        <h1><a href="/<?php echo $castDetails['cast']['username'] . '/' . $castDetails['cast']['slug']; ?>/"/>DOWNLOAD <?php echo $castDetails['cast']['name']; ?> .MP3</a></h1>
        <span>By <a href="/<?php echo $castDetails['cast']['username']; ?>/"><?php echo $castDetails['cast']['owner']; ?></a></span>
        <div id="player1" class="aplayer"></div>
        <?php echo $castDetails['cast']['description'] ? '<blockquote>' . $castDetails['cast']['description'] . '</blockquote>' : null; ?>
        <div class="container" style="padding-top: 10px">
            <a target="_blank" rel="noreferrer noopener" href="<?php echo $castDetails['cast']['stream']; ?>"><button class="button button-outline"><span class="pln">Download</span></button></a>
        </div>
    </section>
    <section class="container" style="padding-top: 2rem;">
        <h2><a href="/<?php echo $castDetails['cast']['username']; ?>/"/>More from <?php echo $castDetails['cast']['owner']; ?></a></h2>
        <?php echo $relatedTag; ?>
    </section>

<link rel="stylesheet" href="/template/style/css/zaudio.css" />
<script src="/template/style/js/zaudio.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        new zAudio({divId:'player1',autoplay:false,color:'#9b4dca',defaultVolume:70}, [
            {
                title:'<?php echo $castDetails['cast']['name']; ?>',
                artist:'<?php echo $castDetails['cast']['owner']; ?>',
                albumArturl:'<?php echo $castDetails['cast']['picture']; ?>',
                url:'<?php echo $castDetails['cast']['stream']; ?>'
            }
        ]);
    });
</script>
<?php
require './template/footer.php';
?>