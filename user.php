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


/* LOGIC GET OWNER */
$ownerDetails = new MixCloud();
$ownerDetails = $ownerDetails->getOwnerDetails($_GET['username'] ?? null, $_GET['next'] ?? null);
if (empty($ownerDetails['details'])) {
    http_response_code(404);
    $title = 'Page Not Found | ' . $site_name;
    require './template/header.php';
    require './template/404.template.php';
    die();
}
$htmlTrend = '';
if (isset($ownerDetails['highlighted'])) {
    foreach ($ownerDetails['highlighted'] as $mix) {
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
                                <div class="col-50"><i class="icon-time"></i> ' . $mix['publishDate'] . '</div>
                                <div class="col-50"><i class="icon-play-sign"></i> ' . $mix['time'] . '</div>
                            </div>
                        </div>
                    </div>
                </div>
            </blockquote>';
    }
} else {
    $htmlTrend .= '<blockquote><p><em>ERROR!! Couldn\'t connect to data. Please try again..</em> <a class="button button-outline" href="/"> Home </a></p></blockquote>';
}

// Config 
$title = $ownerDetails['details']['name'] . ' | ' . $site_name;
$canonical = $canonical . '/' . $ownerDetails['details']['username'] . '/';
$site_thumbnail = $ownerDetails['details']['coverPicture'];

require './template/header.php';
?>

    <section class="container" style="padding-top: 2rem;">
        <h2><?php echo $ownerDetails['details']['name']; ?></h2>
        <div>
        	<?php echo $ownerDetails['details']['bio']; ?>
        </div>
    </section>
    <section class="container" style="padding-top: 2rem;">
        <h2>All Tracks of <?php echo $ownerDetails['details']['name']; ?></h2>
        <?php echo $htmlTrend; ?>
        <div class="container">
            <?php echo !empty($ownerDetails['pageInfo']['hasNextPage']) ? '<div class="page"><a class="button button-outline page-item" href="' . $canonical . '?next=' . $ownerDetails['pageInfo']['endCursor'] . '"> >> Next >> </a></div>' : '' ?>
        </div>
    </section>

<?php
require './template/footer.php';
?>