<?php
$DIR_NAME = realpath($_SERVER["DOCUMENT_ROOT"]);
require $DIR_NAME . '/src/Helper.class.php';
/**
 * Class for working with MixCloud.com parsed pages to get stream media
 *
 *
 * @package    MixCloudDownloader
 * @subpackage MixCloudDownloader
 * @author     nampt.me <admin@nam.name.vn>
 * @copyright  2024 nampt.me
 */
class MixCloud
{
    private $mixCloudUrl;
    private $graphqlURL = 'https://app.mixcloud.com/graphql';
    private $decryptionKey = 'IFYOUWANTTHEARTISTSTOGETPAIDDONOTDOWNLOADFROMMIXCLOUD';
    private $thumnailPreLink = 'https://thumbnailer.mixcloud.com/unsafe/140x140/';
    private $coverPreLink = 'https://thumbnailer.mixcloud.com/unsafe/1200x628/';
    
    function __construct($mixCloudUrl = null)
    {
        $this->mixCloudUrl = $mixCloudUrl;
    }

    public function getMixChart($cursor = null)
    {
        $cursor = !empty($cursor) ? '"' . $cursor . '"' : 'null';
        $query = '{"query":"query TrendingPaginationQuery(\n  $count: Int = 10\n  $country: String\n  $cursor: String\n) {\n  viewer {\n    ...Trending_viewer_38ZmDf\n    id\n  }\n}\n\nfragment Actions_cloudcast on Cloudcast {\n  audioType\n  ...CardFavoriteButton_cloudcast\n  ...CardRepostButton_cloudcast\n  ...CardShareButton_cloudcast\n  ...CardAddToButton_cloudcast\n  ...CardHighlightButton_cloudcast\n  ...CardBoostButton_cloudcast\n  ...CardStats_cloudcast\n  ...CardMoreOptions_cloudcast\n  ...CardPlayButton_cloudcast\n}\n\nfragment Actions_viewer on Viewer {\n  ...CardFavoriteButton_viewer\n  ...CardRepostButton_viewer\n  ...CardHighlightButton_viewer\n  ...CardMoreOptions_viewer\n}\n\nfragment Artwork_cloudcast on Cloudcast {\n  slug\n  audioQuality\n  qualityScore\n  listenerMinutes\n  owner {\n    username\n    id\n  }\n  ...ImageCloudcast_cloudcast\n}\n\nfragment Artwork_user on User {\n  isStaff\n}\n\nfragment AudioCardList_cloudcastEdges on CloudcastEdgeInterface {\n  __isCloudcastEdgeInterface: __typename\n  ... on ChartCloudcastEdge {\n    position\n  }\n  ... on TrendingEdge {\n    position\n  }\n  ... on UploadNotificationEdge {\n    hasBeenViewed\n  }\n  node {\n    id\n    ...ItemAudioCardList_cloudcast\n  }\n}\n\nfragment AudioCardList_viewer on Viewer {\n  ...ItemAudioCardList_viewer\n}\n\nfragment AudioCard_cloudcast on Cloudcast {\n  audioType\n  isAwaitingAudio\n  isDraft\n  ...CardDetails_cloudcast\n  ...Tags_cloudcast\n  ...StatusOrActions_cloudcast\n  ...Artwork_cloudcast\n}\n\nfragment AudioCard_viewer on Viewer {\n  ...StatusOrActions_viewer\n  me {\n    ...Artwork_user\n    uploadLimits {\n      tracksPublishRemaining\n      showsPublishRemaining\n    }\n    id\n  }\n}\n\nfragment CardAddToButton_cloudcast on Cloudcast {\n  id\n  isUnlisted\n  isPublic\n}\n\nfragment CardBoostButton_cloudcast on Cloudcast {\n  id\n  isPublic\n  owner {\n    id\n    isViewer\n  }\n}\n\nfragment CardDetails_cloudcast on Cloudcast {\n  slug\n  name\n  audioType\n  isLiveRecording\n  isExclusive\n  owner {\n    username\n    id\n  }\n  creatorAttributions(first: 2) {\n    totalCount\n  }\n  ...Owners_cloudcast\n  ...CardPlayButton_cloudcast\n  ...ExclusiveCloudcastBadgeContainer_cloudcast\n}\n\nfragment CardFavoriteButton_cloudcast on Cloudcast {\n  id\n  isFavorited\n  isPublic\n  hiddenStats\n  favorites {\n    totalCount\n  }\n  slug\n  owner {\n    id\n    isFollowing\n    username\n    displayName\n  }\n}\n\nfragment CardFavoriteButton_viewer on Viewer {\n  me {\n    id\n  }\n}\n\nfragment CardHighlightButton_cloudcast on Cloudcast {\n  id\n  isPublic\n  isHighlighted\n  owner {\n    isViewer\n    id\n  }\n}\n\nfragment CardHighlightButton_viewer on Viewer {\n  me {\n    id\n    hasProFeatures\n    highlighted {\n      totalCount\n    }\n  }\n}\n\nfragment CardMoreOptions_cloudcast on Cloudcast {\n  id\n  isPublic\n  slug\n  isUnlisted\n  isScheduled\n  isDraft\n  audioType\n  isDisabledCopyright\n  viewerAttribution {\n    status\n    id\n  }\n  viewerAttributionRequest {\n    id\n  }\n  creatorAttributions(first: 2) {\n    totalCount\n  }\n  owner {\n    id\n    username\n    isViewer\n    viewerIsAffiliate\n    displayName\n  }\n}\n\nfragment CardMoreOptions_viewer on Viewer {\n  me {\n    id\n    hasProFeatures\n    uploadLimits {\n      tracksPublishRemaining\n      showsPublishRemaining\n    }\n  }\n}\n\nfragment CardPlayButton_cloudcast on Cloudcast {\n  id\n  restrictedReason\n  proportionListened\n  owner {\n    isSubscribedTo\n    isViewer\n    id\n  }\n  isAwaitingAudio\n  isDraft\n  isPlayable\n  streamInfo {\n    hlsUrl\n    dashUrl\n    url\n    uuid\n  }\n  audioLength\n  currentPosition\n  repeatPlayAmount\n  hasPlayCompleted\n  seekRestriction\n  previewUrl\n  isExclusive\n  isDisabledCopyright\n  ...CardStaticPlayButton_cloudcast\n  ...useAudioPreview_cloudcast\n  ...useExclusivePreviewModal_cloudcast\n  ...useExclusiveCloudcastModal_cloudcast\n}\n\nfragment CardRepostButton_cloudcast on Cloudcast {\n  id\n  isReposted\n  isExclusive\n  isPublic\n  reposts {\n    totalCount\n  }\n  owner {\n    isViewer\n    isSubscribedTo\n    id\n  }\n}\n\nfragment CardRepostButton_viewer on Viewer {\n  me {\n    id\n  }\n}\n\nfragment CardShareButton_cloudcast on Cloudcast {\n  id\n  isUnlisted\n  isPublic\n  slug\n  description\n  audioType\n  picture {\n    urlRoot\n  }\n  owner {\n    displayName\n    isViewer\n    username\n    id\n  }\n}\n\nfragment CardStaticPlayButton_cloudcast on Cloudcast {\n  owner {\n    username\n    id\n  }\n  slug\n  id\n  restrictedReason\n}\n\nfragment CardStats_cloudcast on Cloudcast {\n  isDraft\n  hiddenStats\n  plays\n  publishDate\n  audioLength\n}\n\nfragment CopyrightSupport_cloudcast on Cloudcast {\n  slug\n  name\n  owner {\n    username\n    id\n  }\n}\n\nfragment ExclusiveCloudcastBadgeContainer_cloudcast on Cloudcast {\n  isExclusive\n  isExclusivePreviewOnly\n  slug\n  id\n  owner {\n    username\n    id\n  }\n}\n\nfragment HeaderComponentTrending_viewer_38ZmDf on Viewer {\n  ...TrendingLocationDropdown_viewer_38ZmDf\n}\n\nfragment Hovercard_user on User {\n  id\n}\n\nfragment ImageCloudcast_cloudcast on Cloudcast {\n  name\n  picture {\n    urlRoot\n    primaryColor\n  }\n}\n\nfragment ItemAudioCardList_cloudcast on Cloudcast {\n  ...AudioCard_cloudcast\n}\n\nfragment ItemAudioCardList_viewer on Viewer {\n  ...AudioCard_viewer\n}\n\nfragment LocationDropdown_viewer on Viewer {\n  localisation {\n    currentCountry {\n      code\n      name\n    }\n    availableCountries {\n      code\n      name\n    }\n  }\n}\n\nfragment Owners_cloudcast on Cloudcast {\n  owner {\n    ...Username_user\n    id\n  }\n  creatorAttributions(first: 2) {\n    totalCount\n    edges {\n      node {\n        ...Username_user\n        id\n      }\n    }\n  }\n}\n\nfragment StatusOrActions_cloudcast on Cloudcast {\n  slug\n  publishDate\n  audioType\n  isAwaitingAudio\n  isDraft\n  isScheduled\n  isLiveRecording\n  isDisabledCopyright\n  restrictedReason\n  owner {\n    username\n    isViewer\n    id\n  }\n  ...CopyrightSupport_cloudcast\n  ...Actions_cloudcast\n  ...CardMoreOptions_cloudcast\n}\n\nfragment StatusOrActions_viewer on Viewer {\n  me {\n    uploadLimits {\n      tracksPublishRemaining\n      showsPublishRemaining\n    }\n    id\n  }\n  ...Actions_viewer\n  ...CardMoreOptions_viewer\n}\n\nfragment Tags_cloudcast on Cloudcast {\n  tags(country: \"GLOBAL\") {\n    tag {\n      name\n      slug\n      id\n    }\n  }\n}\n\nfragment TrendingLocationDropdown_viewer_38ZmDf on Viewer {\n  trending(first: $count, after: $cursor, country: $country) {\n    edges {\n      __typename\n    }\n  }\n  ...LocationDropdown_viewer\n}\n\nfragment Trending_viewer_38ZmDf on Viewer {\n  trending(first: $count, after: $cursor, country: $country) {\n    edges {\n      ...AudioCardList_cloudcastEdges\n      cursor\n      node {\n        __typename\n        id\n      }\n    }\n    pageInfo {\n      endCursor\n      hasNextPage\n    }\n  }\n  ...AudioCardList_viewer\n  ...HeaderComponentTrending_viewer_38ZmDf\n}\n\nfragment UserBadge_user on User {\n  hasProFeatures\n  isStaff\n  hasPremiumFeatures\n}\n\nfragment Username_user on User {\n  username\n  displayName\n  ...UserBadge_user\n  ...Hovercard_user\n}\n\nfragment useAudioPreview_cloudcast on Cloudcast {\n  id\n  previewUrl\n}\n\nfragment useExclusiveCloudcastModal_cloudcast on Cloudcast {\n  id\n  isExclusive\n  owner {\n    username\n    id\n  }\n}\n\nfragment useExclusivePreviewModal_cloudcast on Cloudcast {\n  id\n  isExclusivePreviewOnly\n  owner {\n    username\n    id\n  }\n}\n","variables":{"count":20,"country":null,"cursor": ' . $cursor . '}}';

        $response = json_decode($this->graphqlRequest($query));

        if (!is_object($response)) {
            return false;
        }
        if (empty($response->data->viewer->trending->edges)) {
            return false;
        }
        $listTrendLinks = [];
        $listTrendLinks['next'] = $response->data->viewer->trending->pageInfo->hasNextPage ? $response->data->viewer->trending->pageInfo->endCursor : null;
        $listTrendLinks['pre'] = $response->data->viewer->trending->edges[0]->cursor;
        foreach ($response->data->viewer->trending->edges as $cast) {
            $listTrendLinks['casts'][] = [
                'name' => htmlspecialchars($cast->node->name),
                'slug' => $cast->node->slug,
                'owner' => htmlspecialchars($cast->node->owner->displayName),
                'username' => $cast->node->owner->username,
                'previewUrl' => $cast->node->previewUrl,
                'publishDate' => getTimeAgo($cast->node->publishDate),
                'time' => convertSeconds($cast->node->audioLength),
                'description' => htmlspecialchars($cast->node->description),
                'picture' => $this->thumnailPreLink . $cast->node->picture->urlRoot,
                'plays' => abbreviateNumber($cast->node->plays),
            ];
        }

        return $listTrendLinks;

    }

    public function getCastDetails($username = null, $slug = null)
    {
        $query = '{"query":"query StyleOverrideQuery(\n  $lookup: CloudcastLookup!\n) {\n  cloudcast: cloudcastLookup(lookup: $lookup) {\n    picture {\n      primaryColor\n      isLight\n      lightPrimaryColor: primaryColor(lighten: 15)\n      darkPrimaryColor: primaryColor(darken: 15)\n    }\n    id\n  }\n}\n","variables":{"lookup":{"username":"' . $username . '","slug":"' . $slug . '"}}}';

        $response = json_decode($this->graphqlRequest($query));

        if (empty($response->data->cloudcast->id)) {
            return false;
        }

        $cloudcastId = $response->data->cloudcast->id;
        $query = '{"query":"query PlayerControlsQuery(\n  $cloudcastId: ID!\n) {\n  cloudcast(id: $cloudcastId) {\n    id\n    name\n    slug\n    isPublic\n    isExclusive\n    isExclusivePreviewOnly\n    repeatPlayAmount\n    owner {\n      id\n      username\n      isFollowing\n      isViewer\n      displayName\n      followers {\n        totalCount\n      }\n    }\n    picture {\n      ...UGCImage_picture\n    }\nstreamInfo \n{ \ndashUrl \nhlsUrl \nurl \n}\n    ...PlayerActions_cloudcast\n    ...PlayerSeekingActions_cloudcast\n    ...PlayerSliderComponent_cloudcast\n  }\n  viewer {\n    ...PlayerActions_viewer\n    ...PlayerSeekingActions_viewer\n    ...PlayerSliderComponent_viewer\n    me {\n      id\n    }\n    id\n  }\n}\n\nfragment PlayerActionsFavoriteButton_cloudcast on Cloudcast {\n  id\n  isPublic\n  isFavorited\n  owner {\n    id\n    username\n    displayName\n    isSelect\n    isFollowing\n    isViewer\n  }\n  favorites {\n    totalCount\n  }\n  slug\n}\n\nfragment PlayerActionsFavoriteButton_viewer on Viewer {\n  me {\n    id\n  }\n}\n\nfragment PlayerActions_cloudcast on Cloudcast {\n  isPublic\n  owner {\n    isViewer\n    id\n  }\n  ...PlayerActionsFavoriteButton_cloudcast\n  ...PlayerMoreMenuPopover_cloudcast\n}\n\nfragment PlayerActions_viewer on Viewer {\n  ...PlayerActionsFavoriteButton_viewer\n  ...PlayerMoreMenuPopover_viewer\n}\n\nfragment PlayerMenuRepostAction_cloudcast on Cloudcast {\n  id\n  isReposted\n  isPublic\n  reposts {\n    totalCount\n  }\n  owner {\n    isViewer\n    id\n  }\n}\n\nfragment PlayerMenuRepostAction_viewer on Viewer {\n  me {\n    id\n  }\n}\n\nfragment PlayerMenuShareAction_cloudcast on Cloudcast {\n  ...ShareCloudcastButton_cloudcast\n}\n\nfragment PlayerMenuViewProfileAction_cloudcast on Cloudcast {\n  owner {\n    username\n    id\n  }\n}\n\nfragment PlayerMenuViewTracklistAction_cloudcast on Cloudcast {\n  canShowTracklist\n  sections {\n    __typename\n    ... on TrackSection {\n      id\n    }\n    ... on ChapterSection {\n      id\n    }\n    ... on Node {\n      __isNode: __typename\n      id\n    }\n  }\n  slug\n  owner {\n    username\n    id\n  }\n}\n\nfragment PlayerMoreMenuPopover_cloudcast on Cloudcast {\n  ...PlayerMenuRepostAction_cloudcast\n  ...PlayerMenuViewTracklistAction_cloudcast\n  ...PlayerMenuViewProfileAction_cloudcast\n  ...PlayerMenuShareAction_cloudcast\n}\n\nfragment PlayerMoreMenuPopover_viewer on Viewer {\n  ...PlayerMenuRepostAction_viewer\n}\n\nfragment PlayerSeekingActions_cloudcast on Cloudcast {\n  id\n  repeatPlayAmount\n  seekRestriction\n  ...SeekButton_cloudcast\n}\n\nfragment PlayerSeekingActions_viewer on Viewer {\n  hasRepeatPlayFeature: featureIsActive(switch: \"repeat_play\")\n}\n\nfragment PlayerSliderComponent_cloudcast on Cloudcast {\n  id\n  waveformUrl\n  owner {\n    id\n    isFollowing\n    isViewer\n  }\n  isExclusive\n  seekRestriction\n  ...SeekWarning_cloudcast\n  sections {\n    __typename\n    ... on TrackSection {\n      artistName\n      songName\n      startSeconds\n    }\n    ... on ChapterSection {\n      chapter\n      startSeconds\n    }\n    ... on Node {\n      __isNode: __typename\n      id\n    }\n  }\n  repeatPlayAmount\n}\n\nfragment PlayerSliderComponent_viewer on Viewer {\n  restrictedPlayer: featureIsActive(switch: \"restricted_player\")\n}\n\nfragment SeekButton_cloudcast on Cloudcast {\n  id\n  repeatPlayAmount\n  seekRestriction\n  owner {\n    isSelect\n    id\n  }\n}\n\nfragment SeekWarning_cloudcast on Cloudcast {\n  owner {\n    displayName\n    isSelect\n    username\n    id\n  }\n  seekRestriction\n}\n\nfragment ShareCloudcastButton_cloudcast on Cloudcast {\n  id\n  isUnlisted\n  isPublic\n  slug\n  description\n  picture {\n    urlRoot\n  }\n  owner {\n    displayName\n    isViewer\n    username\n    id\n  }\n}\n\nfragment UGCImage_picture on Picture {\n  urlRoot\n  primaryColor\n}\n","variables":{"cloudcastId":"' . $cloudcastId . '"}}';
        $castObject = json_decode($this->graphqlRequest($query));

        $query = '{"id":"MoreFromOwnerQuery","query":"query MoreFromOwnerQuery(\n  $lookup: CloudcastLookup!\n) {\n  cloudcast: cloudcastLookup(lookup: $lookup) {\n    owner {\n      displayName\n      id\n    }\n    moreFromOwner(first: 5) {\n      edges {\n        node {\n          ...MoreFromUserCard_cloudcast\n          id\n        }\n      }\n    }\n    id\n  }\n}\n\nfragment CardPlayButton_cloudcast on Cloudcast {\n  id\n  restrictedReason\n  proportionListened\n  owner {\n    isSubscribedTo\n    isViewer\n    id\n  }\n  isAwaitingAudio\n  isDraft\n  plays\n  isPlayable\n  streamInfo {\n    hlsUrl\n    dashUrl\n    url\n    uuid\n  }\n  audioLength\n  currentPosition\n  repeatPlayAmount\n  hasPlayCompleted\n  seekRestriction\n  previewUrl\n  isExclusive\n  isDisabledCopyright\n  ...CardStaticPlayButton_cloudcast\n  ...useAudioPreview_cloudcast\n  ...useExclusivePreviewModal_cloudcast\n  ...useExclusiveCloudcastModal_cloudcast\n}\n\nfragment CardStaticPlayButton_cloudcast on Cloudcast {\n  owner {\n    username\n    id\n  }\n  slug\n  id\n  restrictedReason\n}\n\nfragment ImageCloudcast_cloudcast on Cloudcast {\n  name\n  picture {\n    urlRoot\n    primaryColor\n  }\n}\n\nfragment MoreFromUserCard_cloudcast on Cloudcast {\n  name\n  publishDate\n  slug\n  owner {\n    username\n    id\n  }\n  ...ImageCloudcast_cloudcast\n  ...CardPlayButton_cloudcast\n}\n\nfragment useAudioPreview_cloudcast on Cloudcast {\n  id\n  previewUrl\n}\n\nfragment useExclusiveCloudcastModal_cloudcast on Cloudcast {\n  id\n  isExclusive\n  owner {\n    username\n    id\n  }\n}\n\nfragment useExclusivePreviewModal_cloudcast on Cloudcast {\n  id\n  isExclusivePreviewOnly\n  owner {\n    username\n    id\n  }\n}\n","variables":{"lookup":{"username":"' . $username . '","slug":"' . $slug . '"}}}';
        $relatedObject = json_decode($this->graphqlRequest($query));

        if (!is_object($castObject)) {
            return false;
        }

        if (empty($castObject->data->cloudcast)) {
            return false;
        }

        $cloudcast = [];

        $cloudcast['cast'] = [
            'name' => htmlspecialchars($castObject->data->cloudcast->name),
            'slug' => $castObject->data->cloudcast->slug,
            'owner' => htmlspecialchars($castObject->data->cloudcast->owner->displayName),
            'username' => $castObject->data->cloudcast->owner->username,
            'picture' => $this->thumnailPreLink . $castObject->data->cloudcast->picture->urlRoot,
            'coverPicture' => $this->coverPreLink . $castObject->data->cloudcast->picture->urlRoot,
            'description' => htmlspecialchars($castObject->data->cloudcast->description),
            'stream' => $this->decryptXorCipher($this->decryptionKey, base64_decode($castObject->data->cloudcast->streamInfo->url)),
        ];

        foreach ($relatedObject->data->cloudcast->moreFromOwner->edges as $related) {
            $cloudcast['related'][] = [
                'name' => htmlspecialchars($related->node->name),
                'slug' => $related->node->slug,
                'username' => $related->node->owner->username,
                'previewUrl' => $related->node->previewUrl,
                'publishDate' => getTimeAgo($related->node->publishDate),
                'time' => convertSeconds($related->node->audioLength),
                'picture' => $this->thumnailPreLink . $related->node->picture->urlRoot,
                'plays' => abbreviateNumber($related->node->plays),
            ];
        }
        
        return $cloudcast;
    }

    public function getOwnerDetails($username = null, $cursor = null)
    {
        $cursor = !empty($cursor) ? '"' . $cursor . '"' : 'null';
        $query = '{"id":"getUserDefaultViewQuery","query":"query getUserDefaultViewQuery(\n  $lookup: UserLookup!\n  $showsAudioTypes: [AudioTypeEnum]\n  $tracksAudioTypes: [AudioTypeEnum]\n  $streamAudioTypes: [AudioTypeEnum]\n) {\n  user: userLookup(lookup: $lookup) {\n    username\n    profileNavigation(showsAudioTypes: $showsAudioTypes, tracksAudioTypes: $tracksAudioTypes, streamAudioTypes: $streamAudioTypes) {\n      defaultView {\n        __typename\n        ... on PlaylistView {\n          playlist {\n            slug\n            id\n          }\n        }\n      }\n    }\n    id\n  }\n}\n","variables":{"lookup":{"username":"' . $username . '"},"showsAudioTypes":["SHOW"],"tracksAudioTypes":["TRACK"],"streamAudioTypes":["SHOW","TRACK"]}}';

        $response = json_decode($this->graphqlRequest($query));

        if (empty($response->data->user->id)) {
            return false;
        }

        $ownerId = $response->data->user->id;
        $query = '{"id":"UserUploadsPagePaginationQuery","query":"query UserUploadsPagePaginationQuery(\n  $audioTypes: [AudioTypeEnum] = [SHOW]\n  $count: Int = 10\n  $cursor: String\n  $onlyAttributedTo: ID\n  $orderBy: CloudcastOrderByEnum = LATEST\n  $id: ID!\n) {\n  node(id: $id) {\n    __typename\n    ...UserUploadsPage_user_2uzeCj\n    id\n  }\n}\n\nfragment Actions_cloudcast on Cloudcast {\n  audioType\n  ...CardFavoriteButton_cloudcast\n  ...CardRepostButton_cloudcast\n  ...CardShareButton_cloudcast\n  ...CardAddToButton_cloudcast\n  ...CardHighlightButton_cloudcast\n  ...CardBoostButton_cloudcast\n  ...CardStats_cloudcast\n  ...CardMoreOptions_cloudcast\n  ...CardPlayButton_cloudcast\n  ...DisappearingTags_taggableInterface\n}\n\nfragment Artwork_cloudcast on Cloudcast {\n  slug\n  audioQuality\n  qualityScore\n  listenerMinutes\n  owner {\n    username\n    id\n  }\n  ...ImageCloudcast_cloudcast\n}\n\nfragment AudioCard_cloudcast on Cloudcast {\n  audioType\n  isAwaitingAudio\n  isDraft\n  ...CardDetails_cloudcast\n  ...DisappearingTags_taggableInterface\n  ...StatusOrActions_cloudcast\n  ...Artwork_cloudcast\n  ...Waveform_cloudcast\n}\n\nfragment CardAddToButton_cloudcast on Cloudcast {\n  id\n  isUnlisted\n  isPublic\n}\n\nfragment CardBoostButton_cloudcast on Cloudcast {\n  id\n  isPublic\n  owner {\n    id\n    isViewer\n  }\n}\n\nfragment CardDetails_cloudcast on Cloudcast {\n  slug\n  name\n  audioType\n  isLiveRecording\n  isExclusive\n  owner {\n    username\n    id\n  }\n  creatorAttributions(first: 2) {\n    totalCount\n  }\n  ...Owners_cloudcast\n  ...CardPlayButton_cloudcast\n  ...ExclusiveCloudcastBadgeContainer_cloudcast\n}\n\nfragment CardFavoriteButton_cloudcast on Cloudcast {\n  id\n  isFavorited\n  isPublic\n  hiddenStats\n  favorites {\n    totalCount\n  }\n  slug\n  owner {\n    id\n    isFollowing\n    username\n    displayName\n  }\n}\n\nfragment CardHighlightButton_cloudcast on Cloudcast {\n  id\n  isPublic\n  isHighlighted\n  owner {\n    isViewer\n    id\n  }\n}\n\nfragment CardMoreOptions_cloudcast on Cloudcast {\n  id\n  isPublic\n  slug\n  isUnlisted\n  isScheduled\n  isDraft\n  audioType\n  isDisabledCopyright\n  viewerAttribution {\n    status\n    id\n  }\n  viewerAttributionRequest {\n    id\n  }\n  creatorAttributions(first: 2) {\n    totalCount\n  }\n  owner {\n    id\n    username\n    isViewer\n    viewerIsAffiliate\n    displayName\n  }\n}\n\nfragment CardPlayButton_cloudcast on Cloudcast {\n  id\n  restrictedReason\n  proportionListened\n  owner {\n    isSubscribedTo\n    isViewer\n    id\n  }\n  isAwaitingAudio\n  isDraft\n  isPlayable\n  streamInfo(timestamper: false) {\n    hlsUrl\n    dashUrl\n    url\n    uuid\n  }\n  audioLength\n  currentPosition\n  repeatPlayAmount\n  hasPlayCompleted\n  seekRestriction\n  previewUrl\n  isExclusive\n  isDisabledCopyright\n  ...CardStaticPlayButton_cloudcast\n  ...useAudioPreview_cloudcast\n  ...useExclusivePreviewModal_cloudcast\n  ...useExclusiveCloudcastModal_cloudcast\n}\n\nfragment CardRepostButton_cloudcast on Cloudcast {\n  id\n  isReposted\n  isExclusive\n  isPublic\n  reposts {\n    totalCount\n  }\n  owner {\n    isViewer\n    isSubscribedTo\n    id\n  }\n}\n\nfragment CardShareButton_cloudcast on Cloudcast {\n  id\n  isUnlisted\n  isPublic\n  slug\n  description\n  audioType\n  picture {\n    urlRoot\n  }\n  owner {\n    displayName\n    isViewer\n    username\n    id\n  }\n}\n\nfragment CardStaticPlayButton_cloudcast on Cloudcast {\n  owner {\n    username\n    id\n  }\n  slug\n  id\n  restrictedReason\n}\n\nfragment CardStats_cloudcast on Cloudcast {\n  isDraft\n  hiddenStats\n  plays\n  publishDate\n  audioLength\n}\n\nfragment CopyrightSupport_cloudcast on Cloudcast {\n  slug\n  name\n  owner {\n    username\n    id\n  }\n}\n\nfragment DisappearingTags_taggableInterface on TaggableInterface {\n  __isTaggableInterface: __typename\n  tagList(first: 10, country: \"GLOBAL\") {\n    edges {\n      node {\n        name\n        slug\n        id\n      }\n    }\n  }\n}\n\nfragment ExclusiveCloudcastBadgeContainer_cloudcast on Cloudcast {\n  isExclusive\n  isExclusivePreviewOnly\n  slug\n  id\n  owner {\n    username\n    id\n  }\n}\n\nfragment Hovercard_user on User {\n  id\n}\n\nfragment ImageCloudcast_cloudcast on Cloudcast {\n  name\n  picture {\n    urlRoot\n    primaryColor\n  }\n}\n\nfragment Owners_cloudcast on Cloudcast {\n  owner {\n    ...Username_user\n    id\n  }\n  creatorAttributions(first: 2) {\n    totalCount\n    edges {\n      node {\n        ...Username_user\n        id\n      }\n    }\n  }\n}\n\nfragment ShareAudioCardList_user on User {\n  biog\n  username\n  displayName\n  id\n  isUploader\n  picture {\n    urlRoot\n  }\n  coverPicture {\n    urlRoot\n  }\n}\n\nfragment StatusOrActions_cloudcast on Cloudcast {\n  slug\n  publishDate\n  audioType\n  isAwaitingAudio\n  isDraft\n  isScheduled\n  isLiveRecording\n  isDisabledCopyright\n  restrictedReason\n  owner {\n    username\n    isViewer\n    id\n  }\n  ...CopyrightSupport_cloudcast\n  ...Actions_cloudcast\n  ...CardMoreOptions_cloudcast\n}\n\nfragment UserBadge_user on User {\n  hasProFeatures\n  isStaff\n  hasPremiumFeatures\n}\n\nfragment UserUploadsPage_user_2uzeCj on User {\n  id\n  displayName\n  username\n  isViewer\n  hasProFeatures\n  viewerIsAffiliate\n  ...ShareAudioCardList_user\n  uploads(first: $count, isPublic: true, after: $cursor, orderBy: $orderBy, audioTypes: $audioTypes, onlyAttributedTo: $onlyAttributedTo) {\n    edges {\n      node {\n        ...AudioCard_cloudcast\n        id\n        __typename\n      }\n      cursor\n    }\n    pageInfo {\n      endCursor\n      hasNextPage\n    }\n  }\n}\n\nfragment Username_user on User {\n  username\n  displayName\n  ...UserBadge_user\n  ...Hovercard_user\n}\n\nfragment Waveform_cloudcast on Cloudcast {\n  id\n  waveformUrl\n  audioLength\n  currentPosition\n  isPlayable\n  restrictedReason\n  streamInfo(timestamper: false) {\n    hlsUrl\n    dashUrl\n    url\n    uuid\n  }\n  seekRestriction\n  ...usePlayerSlider_cloudcast_4vCdM7\n}\n\nfragment useAudioPreview_cloudcast on Cloudcast {\n  id\n  previewUrl\n}\n\nfragment useExclusiveCloudcastModal_cloudcast on Cloudcast {\n  id\n  isExclusive\n  owner {\n    username\n    id\n  }\n}\n\nfragment useExclusivePreviewModal_cloudcast on Cloudcast {\n  id\n  isExclusivePreviewOnly\n  owner {\n    username\n    id\n  }\n}\n\nfragment usePlayerSlider_cloudcast_4vCdM7 on Cloudcast {\n  seekRestriction\n  audioLength\n  isExclusive\n  owner {\n    isSubscribedTo\n    isViewer\n    id\n  }\n}\n","variables":{"audioTypes":["SHOW"],"count":20,"cursor":' . $cursor . ',"onlyAttributedTo":"","orderBy":"LATEST","id":"' . $ownerId . '"}}';
        $response = json_decode($this->graphqlRequest($query));

        if (empty($response->data->node->id)) {
            return false;
        }

        $ownerDetails = [];

        $ownerDetails['details'] = [
            'id' => $response->data->node->id,
            'name' => htmlspecialchars($response->data->node->displayName),
            'username' => $response->data->node->username,
            'bio' => htmlspecialchars($response->data->node->biog),
            'picture' => $this->thumnailPreLink . $response->data->node->picture->urlRoot,
            'coverPicture' => $this->coverPreLink . $response->data->node->coverPicture->urlRoot,
        ];

        foreach ($response->data->node->uploads->edges as $cast) {
            $ownerDetails['highlighted'][] = [
                'name' => htmlspecialchars($cast->node->name),
                'slug' => $cast->node->slug,
                'username' => $cast->node->owner->username,
                'owner' => htmlspecialchars($cast->node->owner->displayName),
                'previewUrl' => $cast->node->previewUrl,
                'publishDate' => getTimeAgo($cast->node->publishDate),
                'time' => convertSeconds($cast->node->audioLength),
                'picture' => $this->thumnailPreLink . $cast->node->picture->urlRoot,
                'plays' => abbreviateNumber($cast->node->plays),
            ];
        }

        $ownerDetails['pageInfo'] = [
            'endCursor' => $response->data->node->uploads->pageInfo->endCursor,
            'hasNextPage' => $response->data->node->uploads->pageInfo->hasNextPage,
        ];

        return $ownerDetails;
    }

    public function getSearchResults($searchKey = null, $cursor = null)
    {
        $cursor = !empty($cursor) ? '"' . $cursor . '"' : 'null';

        $query = '{"id":"SearchResultsCloudcastsQuery","query":"query SearchResultsCloudcastsQuery(\n  $count: Int = 10\n  $createdAfter: CreatedAfterFilter\n  $cursor: String\n  $isTimestamped: IsTimestampedFilter\n  $term: String!\n) {\n  viewer {\n    ...SearchResultsCloudcasts_viewer_4jbhrQ\n    id\n  }\n}\n\nfragment AttributionRequestButton_cloudcast on Cloudcast {\n  id\n  viewerCanRequestAttribution\n  owner {\n    hasProFeatures\n    id\n  }\n  viewerAttribution {\n    id\n  }\n  viewerAttributionRequest {\n    id\n  }\n  creatorAttributions(first: 2) {\n    edges {\n      __typename\n    }\n  }\n}\n\nfragment AudioCardDetails_cloudcast on Cloudcast {\n  audioLength\n  plays\n  publishDate\n  tags(country: \"GLOBAL\") {\n    ...AudioCardTagsPreviewer_tag\n  }\n  ...AudioCardTags_cloudcast\n}\n\nfragment AudioCardTagsPreviewer_tag on CloudcastTag {\n  tag {\n    name\n    slug\n    id\n  }\n}\n\nfragment AudioCardTags_cloudcast on Cloudcast {\n  tags(country: \"GLOBAL\") {\n    tag {\n      name\n      slug\n      id\n    }\n  }\n}\n\nfragment ImageCloudcast_cloudcast on Cloudcast {\n  name\n  picture {\n    urlRoot\n    primaryColor\n  }\n}\n\nfragment ItemSearchAudioCardListCloudcast_cloudcast on Cloudcast {\n  id\n  ...SearchAudioCard_cloudcast\n}\n\nfragment ItemSearchAudioCardListUser_cloudcast on Cloudcast {\n  id\n  ...SearchAudioCard_cloudcast\n}\n\nfragment PlayButton_cloudcast on Cloudcast {\n  restrictedReason\n  owner {\n    isSubscribedTo\n    isViewer\n    id\n  }\n  id\n  isDraft\n  isPlayable\n  streamInfo {\n    hlsUrl\n    dashUrl\n    url\n    uuid\n  }\n  audioLength\n  currentPosition\n  proportionListened\n  repeatPlayAmount\n  hasPlayCompleted\n  seekRestriction\n  previewUrl\n  isExclusive\n  ...StaticPlayButton_cloudcast\n  ...useAudioPreview_cloudcast\n  ...useExclusivePreviewModal_cloudcast\n  ...useExclusiveCloudcastModal_cloudcast\n}\n\nfragment SearchAudioCardList_edges on CloudcastEdgeInterface {\n  __isCloudcastEdgeInterface: __typename\n  node {\n    ...ItemSearchAudioCardListCloudcast_cloudcast\n    ...ItemSearchAudioCardListUser_cloudcast\n    id\n  }\n}\n\nfragment SearchAudioCard_cloudcast on Cloudcast {\n  name\n  slug\n  isExclusive\n  owner {\n    displayName\n    username\n    ...UserBadge_user\n    id\n  }\n  ...ImageCloudcast_cloudcast\n  ...AudioCardDetails_cloudcast\n  ...PlayButton_cloudcast\n  ...AttributionRequestButton_cloudcast\n}\n\nfragment SearchResultsCloudcasts_viewer_4jbhrQ on Viewer {\n  search {\n    searchQuery(term: $term) {\n      cloudcasts(first: $count, after: $cursor, createdAfter: $createdAfter, isTimestamped: $isTimestamped) {\n        edges {\n          ...SearchAudioCardList_edges\n          cursor\n          node {\n            __typename\n            id\n          }\n        }\n        pageInfo {\n          endCursor\n          hasNextPage\n        }\n      }\n    }\n  }\n}\n\nfragment StaticPlayButton_cloudcast on Cloudcast {\n  owner {\n    username\n    id\n  }\n  slug\n  isAwaitingAudio\n  restrictedReason\n}\n\nfragment UserBadge_user on User {\n  hasProFeatures\n  isStaff\n  hasPremiumFeatures\n}\n\nfragment useAudioPreview_cloudcast on Cloudcast {\n  id\n  previewUrl\n}\n\nfragment useExclusiveCloudcastModal_cloudcast on Cloudcast {\n  id\n  isExclusive\n  owner {\n    username\n    id\n  }\n}\n\nfragment useExclusivePreviewModal_cloudcast on Cloudcast {\n  id\n  isExclusivePreviewOnly\n  owner {\n    username\n    id\n  }\n}\n","variables":{"count":10,"createdAfter":null,"cursor":' . $cursor . ',"isTimestamped":null,"term":"' . $searchKey . '"}}';
        $response = json_decode($this->graphqlRequest($query));

        if (empty($response->data->viewer->search->searchQuery->cloudcasts->edges)) {
            return false;
        }
        $results = [];

        foreach ($response->data->viewer->search->searchQuery->cloudcasts->edges as $cast) {
            $results['results'][] = [
                'name' => htmlspecialchars($cast->node->name),
                'slug' => $cast->node->slug,
                'username' => $cast->node->owner->username,
                'owner' => htmlspecialchars($cast->node->owner->displayName),
                'previewUrl' => $cast->node->previewUrl,
                'publishDate' => getTimeAgo($cast->node->publishDate),
                'time' => convertSeconds($cast->node->audioLength),
                'picture' => $this->thumnailPreLink . $cast->node->picture->urlRoot,
                'plays' => abbreviateNumber($cast->node->plays),
            ];
        }

        $results['pageInfo'] = [
            'endCursor' => $response->data->viewer->search->searchQuery->cloudcasts->pageInfo->endCursor,
            'hasNextPage' => $response->data->viewer->search->searchQuery->cloudcasts->pageInfo->hasNextPage,
        ];

        return $results;
    }

    protected function validateUrl($url)
    {
        $valid_url_pattern = '%\b(?:(?:http|https)://|www\.)[\mixcloud]+\.[a-z]{2,6}(?::\d{1,5}+)?(?:/[!$\'()*+,._a-z-]++){0,10}(?:/[!$\'()*+,._a-z-]+)?(?:\?[!$&\'()*+,.=_a-z-]*)?%i';

        if (!preg_match($valid_url_pattern, $url)) {
            throw new \Exception('Invalid url');
        }

        return true;
    }

    protected function graphqlRequest($query)
    {
        $ch = @curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->graphqlURL);
        $head[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    protected function decryptXorCipher($cipherKey, $cipherText) 
    {
        $result = '';
        $keyLength = strlen($cipherKey);
        $ciphertextLength = strlen($cipherText);
        
        for ($i = 0; $i < $ciphertextLength; $i++) {
            $result .= chr(ord($cipherText[$i]) ^ ord($cipherKey[$i % $keyLength]));
        }
        
        return $result;
    }
}