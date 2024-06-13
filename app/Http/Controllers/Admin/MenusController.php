<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
use App\User;
use App\Models\Admin;
use App\Models\UserMenuAccess;
use Route;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Menu::orderby('order_menu', 'asc')->with('submenus')->get();
        return view('admin.backmenu.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = ["fa fa-address-book", "fa fa-address-card", "fa fa-adjust", "fa fa-align-center", "fa fa-align-justify", "fa fa-align-left", "fa fa-align-right", "fa fa-allergies", "fa fa-ambulance", "fa fa-american-sign-language-interpreting", "fa fa-anchor", "fa fa-angle-double-down", "fa fa-angle-double-left", "fa fa-angle-double-right", "fa fa-angle-double-up", "fa fa-angle-down", "fa fa-angle-left", "fa fa-angle-right", "fa fa-angle-up", "fa fa-archive", "fa fa-arrow-alt-circle-down", "fa fa-arrow-alt-circle-left", "fa fa-arrow-alt-circle-right", "fa fa-arrow-alt-circle-up", "fa fa-arrow-circle-down", "fa fa-arrow-circle-left", "fa fa-arrow-circle-right", "fa fa-arrow-circle-up", "fa fa-arrow-down", "fa fa-arrow-left", "fa fa-arrow-right", "fa fa-arrow-up", "fa fa-arrows-alt", "fa fa-arrows-alt-h", "fa fa-arrows-alt-v", "fa fa-assistive-listening-systems", "fa fa-asterisk", "fa fa-at", "fa fa-audio-description", "fa fa-backward", "fa fa-balance-scale", "fa fa-ban", "fa fa-band-aid", "fa fa-barcode", "fa fa-bars", "fa fa-baseball-ball", "fa fa-basketball-ball", "fa fa-bath", "fa fa-battery-empty", "fa fa-battery-full", "fa fa-battery-half", "fa fa-battery-quarter", "fa fa-battery-three-quarters", "fa fa-bed", "fa fa-beer", "fa fa-bell", "fa fa-bell-slash", "fa fa-bicycle", "fa fa-binoculars", "fa fa-birthday-cake", "fa fa-blind", "fa fa-bold", "fa fa-bolt", "fa fa-bomb", "fa fa-book", "fa fa-bookmark", "fa fa-bowling-ball", "fa fa-box", "fa fa-box-open", "fa fa-boxes", "fa fa-braille", "fa fa-briefcase", "fa fa-briefcase-medical", "fa fa-bug", "fa fa-building", "fa fa-bullhorn", "fa fa-bullseye", "fa fa-burn", "fa fa-bus", "fa fa-calculator", "fa fa-calendar", "fa fa-calendar-alt", "fa fa-calendar-check", "fa fa-calendar-minus", "fa fa-calendar-plus", "fa fa-calendar-times", "fa fa-camera", "fa fa-camera-retro", "fa fa-capsules", "fa fa-car", "fa fa-caret-down", "fa fa-caret-left", "fa fa-caret-right", "fa fa-caret-square-down", "fa fa-caret-square-left", "fa fa-caret-square-right", "fa fa-caret-square-up", "fa fa-caret-up", "fa fa-cart-arrow-down", "fa fa-cart-plus", "fa fa-certificate", "fa fa-chart-area", "fa fa-chart-bar", "fa fa-chart-line", "fa fa-chart-pie", "fa fa-check", "fa fa-check-circle", "fa fa-check-square", "fa fa-chess", "fa fa-chess-bishop", "fa fa-chess-board", "fa fa-chess-king", "fa fa-chess-knight", "fa fa-chess-pawn", "fa fa-chess-queen", "fa fa-chess-rook", "fa fa-chevron-circle-down", "fa fa-chevron-circle-left", "fa fa-chevron-circle-right", "fa fa-chevron-circle-up", "fa fa-chevron-down", "fa fa-chevron-left", "fa fa-chevron-right", "fa fa-chevron-up", "fa fa-child", "fa fa-circle", "fa fa-circle-notch", "fa fa-clipboard", "fa fa-clipboard-check", "fa fa-clipboard-list", "fa fa-clock", "fa fa-clone", "fa fa-closed-captioning", "fa fa-cloud", "fa fa-cloud-download-alt", "fa fa-cloud-upload-alt", "fa fa-code", "fa fa-code-branch", "fa fa-coffee", "fa fa-cog", "fa fa-cogs", "fa fa-columns", "fa fa-comment", "fa fa-comment-alt", "fa fa-comment-dots", "fa fa-comment-slash", "fa fa-comments", "fa fa-compass", "fa fa-compress", "fa fa-copy", "fa fa-copyright", "fa fa-couch", "fa fa-credit-card", "fa fa-crop", "fa fa-crosshairs", "fa fa-cube", "fa fa-cubes", "fa fa-cut", "fa fa-database", "fa fa-deaf", "fa fa-desktop", "fa fa-diagnoses", "fa fa-dna", "fa fa-dollar-sign", "fa fa-dolly", "fa fa-dolly-flatbed", "fa fa-donate", "fa fa-dot-circle", "fa fa-dove", "fa fa-download", "fa fa-edit", "fa fa-eject", "fa fa-ellipsis-h", "fa fa-ellipsis-v", "fa fa-envelope", "fa fa-envelope-open", "fa fa-envelope-square", "fa fa-eraser", "fa fa-euro-sign", "fa fa-exchange-alt", "fa fa-exclamation", "fa fa-exclamation-circle", "fa fa-exclamation-triangle", "fa fa-expand", "fa fa-expand-arrows-alt", "fa fa-external-link-alt", "fa fa-external-link-square-alt", "fa fa-eye", "fa fa-eye-dropper", "fa fa-eye-slash", "fa fa-fat-backward", "fa fa-fat-forward", "fa fa-fax", "fa fa-female", "fa fa-fighter-jet", "fa fa-file", "fa fa-file-alt", "fa fa-file-archive", "fa fa-file-audio", "fa fa-file-code", "fa fa-file-excel", "fa fa-file-image", "fa fa-file-medical", "fa fa-file-medical-alt", "fa fa-file-pdf", "fa fa-file-powerpoint", "fa fa-file-video", "fa fa-file-word", "fa fa-film", "fa fa-filter", "fa fa-fire", "fa fa-fire-extinguisher", "fa fa-first-aid", "fa fa-flag", "fa fa-flag-checkered", "fa fa-flask", "fa fa-folder", "fa fa-folder-open", "fa fa-font", "fa fa-football-ball", "fa fa-forward", "fa fa-frown", "fa fa-futbol", "fa fa-gamepad", "fa fa-gavel", "fa fa-gem", "fa fa-genderless", "fa fa-gift", "fa fa-glass-martini", "fa fa-globe", "fa fa-golf-ball", "fa fa-graduation-cap", "fa fa-h-square", "fa fa-hand-holding", "fa fa-hand-holding-heart", "fa fa-hand-holding-usd", "fa fa-hand-lizard", "fa fa-hand-paper", "fa fa-hand-peace", "fa fa-hand-point-down", "fa fa-hand-point-left", "fa fa-hand-point-right", "fa fa-hand-point-up", "fa fa-hand-pointer", "fa fa-hand-rock", "fa fa-hand-scissors", "fa fa-hand-spock", "fa fa-hands", "fa fa-hands-helping", "fa fa-handshake", "fa fa-hashtag", "fa fa-hdd", "fa fa-heading", "fa fa-headphones", "fa fa-heart", "fa fa-heartbeat", "fa fa-history", "fa fa-hockey-puck", "fa fa-home", "fa fa-hospital", "fa fa-hospital-alt", "fa fa-hospital-symbol", "fa fa-hourglass", "fa fa-hourglass-end", "fa fa-hourglass-half", "fa fa-hourglass-start", "fa fa-i-cursor", "fa fa-id-badge", "fa fa-id-card", "fa fa-id-card-alt", "fa fa-image", "fa fa-images", "fa fa-inbox", "fa fa-indent", "fa fa-industry", "fa fa-info", "fa fa-info-circle", "fa fa-italic", "fa fa-key", "fa fa-keyboard", "fa fa-language", "fa fa-laptop", "fa fa-leaf", "fa fa-lemon", "fa fa-level-down-alt", "fa fa-level-up-alt", "fa fa-life-ring", "fa fa-lightbulb", "fa fa-link", "fa fa-lira-sign", "fa fa-list", "fa fa-list-alt", "fa fa-list-ol", "fa fa-list-ul", "fa fa-location-arrow", "fa fa-lock", "fa fa-lock-open", "fa fa-long-arrow-alt-down", "fa fa-long-arrow-alt-left", "fa fa-long-arrow-alt-right", "fa fa-long-arrow-alt-up", "fa fa-low-vision", "fa fa-magic", "fa fa-magnet", "fa fa-male", "fa fa-map", "fa fa-map-marker", "fa fa-map-marker-alt", "fa fa-map-pin", "fa fa-map-signs", "fa fa-mars", "fa fa-mars-double", "fa fa-mars-stroke", "fa fa-mars-stroke-h", "fa fa-mars-stroke-v", "fa fa-medkit", "fa fa-meh", "fa fa-mercury", "fa fa-microchip", "fa fa-microphone", "fa fa-microphone-slash", "fa fa-minus", "fa fa-minus-circle", "fa fa-minus-square", "fa fa-mobile", "fa fa-mobile-alt", "fa fa-money-bill-alt", "fa fa-moon", "fa fa-motorcycle", "fa fa-mouse-pointer", "fa fa-music", "fa fa-neuter", "fa fa-newspaper", "fa fa-notes-medical", "fa fa-object-group", "fa fa-object-ungroup", "fa fa-outdent", "fa fa-paint-brush", "fa fa-pallet", "fa fa-paper-plane", "fa fa-paperclip", "fa fa-parachute-box", "fa fa-paragraph", "fa fa-paste", "fa fa-pause", "fa fa-pause-circle", "fa fa-paw", "fa fa-pen-square", "fa fa-pencil-alt", "fa fa-people-carry", "fa fa-percent", "fa fa-phone", "fa fa-phone-slash", "fa fa-phone-square", "fa fa-phone-volume", "fa fa-piggy-bank", "fa fa-pills", "fa fa-plane", "fa fa-play", "fa fa-play-circle", "fa fa-plug", "fa fa-plus", "fa fa-plus-circle", "fa fa-plus-square", "fa fa-podcast", "fa fa-poo", "fa fa-pound-sign", "fa fa-power-off", "fa fa-prescription-bottle", "fa fa-prescription-bottle-alt", "fa fa-print", "fa fa-procedures", "fa fa-puzzle-piece", "fa fa-qrcode", "fa fa-question", "fa fa-question-circle", "fa fa-quidditch", "fa fa-quote-left", "fa fa-quote-right", "fa fa-random", "fa fa-recycle", "fa fa-redo", "fa fa-redo-alt", "fa fa-registered", "fa fa-reply", "fa fa-reply-all", "fa fa-retweet", "fa fa-ribbon", "fa fa-road", "fa fa-rocket", "fa fa-rss", "fa fa-rss-square", "fa fa-ruble-sign", "fa fa-rupee-sign", "fa fa-save", "fa fa-search", "fa fa-search-minus", "fa fa-search-plus", "fa fa-seedling", "fa fa-server", "fa fa-share", "fa fa-share-alt", "fa fa-share-alt-square", "fa fa-share-square", "fa fa-shekel-sign", "fa fa-shield-alt", "fa fa-ship", "fa fa-shipping-fat", "fa fa-shopping-bag", "fa fa-shopping-basket", "fa fa-shopping-cart", "fa fa-shower", "fa fa-sign", "fa fa-sign-in-alt", "fa fa-sign-language", "fa fa-sign-out-alt", "fa fa-signal", "fa fa-sitemap", "fa fa-sliders-h", "fa fa-smile", "fa fa-smoking", "fa fa-snowflake", "fa fa-sort", "fa fa-sort-alpha-down", "fa fa-sort-alpha-up", "fa fa-sort-amount-down", "fa fa-sort-amount-up", "fa fa-sort-down", "fa fa-sort-numeric-down", "fa fa-sort-numeric-up", "fa fa-sort-up", "fa fa-space-shuttle", "fa fa-spinner", "fa fa-square", "fa fa-square-full", "fa fa-star", "fa fa-star-half", "fa fa-step-backward", "fa fa-step-forward", "fa fa-stethoscope", "fa fa-sticky-note", "fa fa-stop", "fa fa-stop-circle", "fa fa-stopwatch", "fa fa-street-view", "fa fa-strikethrough", "fa fa-subscript", "fa fa-subway", "fa fa-suitcase", "fa fa-sun", "fa fa-superscript", "fa fa-sync", "fa fa-sync-alt", "fa fa-syringe", "fa fa-table", "fa fa-table-tennis", "fa fa-tablet", "fa fa-tablet-alt", "fa fa-tablets", "fa fa-tachometer-alt", "fa fa-tag", "fa fa-tags", "fa fa-tape", "fa fa-tasks", "fa fa-taxi", "fa fa-terminal", "fa fa-text-height", "fa fa-text-width", "fa fa-th", "fa fa-th-large", "fa fa-th-list", "fa fa-thermometer", "fa fa-thermometer-empty", "fa fa-thermometer-full", "fa fa-thermometer-half", "fa fa-thermometer-quarter", "fa fa-thermometer-three-quarters", "fa fa-thumbs-down", "fa fa-thumbs-up", "fa fa-thumbtack", "fa fa-ticket-alt", "fa fa-times", "fa fa-times-circle", "fa fa-tint", "fa fa-toggle-off", "fa fa-toggle-on", "fa fa-trademark", "fa fa-train", "fa fa-transgender", "fa fa-transgender-alt", "fa fa-trash", "fa fa-trash-alt", "fa fa-tree", "fa fa-trophy", "fa fa-truck", "fa fa-truck-loading", "fa fa-truck-moving", "fa fa-tty", "fa fa-tv", "fa fa-umbrella", "fa fa-underline", "fa fa-undo", "fa fa-undo-alt", "fa fa-universal-access", "fa fa-university", "fa fa-unlink", "fa fa-unlock", "fa fa-unlock-alt", "fa fa-upload", "fa fa-user", "fa fa-user-circle", "fa fa-user-md", "fa fa-user-plus", "fa fa-user-secret", "fa fa-user-times", "fa fa-users", "fa fa-utensil-spoon", "fa fa-utensils", "fa fa-venus", "fa fa-venus-double", "fa fa-venus-mars", "fa fa-vial", "fa fa-vials", "fa fa-video", "fa fa-video-slash", "fa fa-volleyball-ball", "fa fa-volume-down", "fa fa-volume-off", "fa fa-volume-up", "fa fa-warehouse", "fa fa-weight", "fa fa-wheelchair", "fa fa-wifi", "fa fa-window-close", "fa fa-window-maximize", "fa fa-window-minimize", "fa fa-window-restore", "fa fa-wine-glass", "fa fa-won-sign", "fa fa-wrench", "fa fa-x-ray", "fa fa-yen-sign", "fa fa-address-book", "fa fa-address-card", "fa fa-arrow-alt-circle-down", "fa fa-arrow-alt-circle-left", "fa fa-arrow-alt-circle-right", "fa fa-arrow-alt-circle-up", "fa fa-bell", "fa fa-bell-slash", "fa fa-bookmark", "fa fa-building", "fa fa-calendar", "fa fa-calendar-alt", "fa fa-calendar-check", "fa fa-calendar-minus", "fa fa-calendar-plus", "fa fa-calendar-times", "fa fa-caret-square-down", "fa fa-caret-square-left", "fa fa-caret-square-right", "fa fa-caret-square-up", "fa fa-chart-bar", "fa fa-check-circle", "fa fa-check-square", "fa fa-circle", "fa fa-clipboard", "fa fa-clock", "fa fa-clone", "fa fa-closed-captioning", "fa fa-comment", "fa fa-comment-alt", "fa fa-comments", "fa fa-compass", "fa fa-copy", "fa fa-copyright", "fa fa-credit-card", "fa fa-dot-circle", "fa fa-edit", "fa fa-envelope", "fa fa-envelope-open", "fa fa-eye-slash", "fa fa-file", "fa fa-file-alt", "fa fa-file-archive", "fa fa-file-audio", "fa fa-file-code", "fa fa-file-excel", "fa fa-file-image", "fa fa-file-pdf", "fa fa-file-powerpoint", "fa fa-file-video", "fa fa-file-word", "fa fa-flag", "fa fa-folder", "fa fa-folder-open", "fa fa-frown", "fa fa-futbol", "fa fa-gem", "fa fa-hand-lizard", "fa fa-hand-paper", "fa fa-hand-peace", "fa fa-hand-point-down", "fa fa-hand-point-left", "fa fa-hand-point-right", "fa fa-hand-point-up", "fa fa-hand-pointer", "fa fa-hand-rock", "fa fa-hand-scissors", "fa fa-hand-spock", "fa fa-handshake", "fa fa-hdd", "fa fa-heart", "fa fa-hospital", "fa fa-hourglass", "fa fa-id-badge", "fa fa-id-card", "fa fa-image", "fa fa-images", "fa fa-keyboard", "fa fa-lemon", "fa fa-life-ring", "fa fa-lightbulb", "fa fa-list-alt", "fa fa-map", "fa fa-meh", "fa fa-minus-square", "fa fa-money-bill-alt", "fa fa-moon", "fa fa-newspaper", "fa fa-object-group", "fa fa-object-ungroup", "fa fa-paper-plane", "fa fa-pause-circle", "fa fa-play-circle", "fa fa-plus-square", "fa fa-question-circle", "fa fa-registered", "fa fa-save", "fa fa-share-square", "fa fa-smile", "fa fa-snowflake", "fa fa-square", "fa fa-star", "fa fa-star-half", "fa fa-sticky-note", "fa fa-stop-circle", "fa fa-sun", "fa fa-thumbs-down", "fa fa-thumbs-up", "fa fa-times-circle", "fa fa-trash-alt", "fa fa-user", "fa fa-user-circle", "fa fa-window-close", "fa fa-window-maximize", "fa fa-window-minimize", "fa fa-window-restore", "fa fa-500px", "fa fa-accessible-icon", "fa fa-accusoft", "fa fa-adn", "fa fa-adversal", "fa fa-affiliatetheme", "fa fa-algolia", "fa fa-amazon", "fa fa-amazon-pay", "fa fa-amilia", "fa fa-android", "fa fa-angellist", "fa fa-angrycreative", "fa fa-angular", "fa fa-app-store", "fa fa-app-store-ios", "fa fa-apper", "fa fa-apple", "fa fa-apple-pay", "fa fa-asymmetrik", "fa fa-audible", "fa fa-autoprefixer", "fa fa-avianex", "fa fa-aviato", "fa fa-aws", "fa fa-bandcamp", "fa fa-behance", "fa fa-behance-square", "fa fa-bimobject", "fa fa-bitbucket", "fa fa-bitcoin", "fa fa-bity", "fa fa-black-tie", "fa fa-blackberry", "fa fa-blogger", "fa fa-blogger-b", "fa fa-bluetooth", "fa fa-bluetooth-b", "fa fa-btc", "fa fa-buromobelexperte", "fa fa-buysellads", "fa fa-cc-amazon-pay", "fa fa-cc-amex", "fa fa-cc-apple-pay", "fa fa-cc-diners-club", "fa fa-cc-discover", "fa fa-cc-jcb", "fa fa-cc-mastercard", "fa fa-cc-paypal", "fa fa-cc-stripe", "fa fa-cc-visa", "fa fa-centercode", "fa fa-chrome", "fa fa-cloudscale", "fa fa-cloudsmith", "fa fa-cloudversify", "fa fa-codepen", "fa fa-codiepie", "fa fa-connectdevelop", "fa fa-contao", "fa fa-cpanel", "fa fa-creative-commons", "fa fa-css3", "fa fa-css3-alt", "fa fa-cuttlefish", "fa fa-d-and-d", "fa fa-dashcube", "fa fa-delicious", "fa fa-deploydog", "fa fa-deskpro", "fa fa-deviantart", "fa fa-digg", "fa fa-digital-ocean", "fa fa-discord", "fa fa-discourse", "fa fa-dochub", "fa fa-docker", "fa fa-draft2digital", "fa fa-dribbble", "fa fa-dribbble-square", "fa fa-dropbox", "fa fa-drupal", "fa fa-dyalog", "fa fa-earlybirds", "fa fa-edge", "fa fa-elementor", "fa fa-ember", "fa fa-empire", "fa fa-envira", "fa fa-erlang", "fa fa-ethereum", "fa fa-etsy", "fa fa-expeditedssl", "fa-brands fa-facebook", "fa-brands fa-facebook-f", "fa-brands fa-facebook-messenger", "fa-brands fa-facebook-square", "fa fa-firefox", "fa fa-first-order", "fa fa-firstdraft", "fa fa-flickr", "fa fa-flipboard", "fa fa-fly", "fa fa-font-awesome", "fa fa-font-awesome-alt", "fa fa-font-awesome-flag", "fa fa-fonticons", "fa fa-fonticons-fi", "fa fa-fort-awesome", "fa fa-fort-awesome-alt", "fa fa-forumbee", "fa fa-foursquare", "fa fa-free-code-camp", "fa fa-freebsd", "fa fa-get-pocket", "fa fa-gg", "fa fa-gg-circle", "fa fa-git", "fa fa-git-square", "fa-brands fa-github", "fa-brands fa-github-alt", "fa-brands fa-github-square", "fa fa-gitkraken", "fa fa-gitlab", "fa fa-gitter", "fa fa-glide", "fa fa-glide-g", "fa fa-gofore", "fa fa-goodreads", "fa fa-goodreads-g", "fa fa-google", "fa fa-google-drive", "fa fa-google-play", "fa fa-google-plus", "fa fa-google-plus-g", "fa fa-google-plus-square", "fa fa-google-wallet", "fa fa-gratipay", "fa fa-grav", "fa fa-gripfire", "fa fa-grunt", "fa fa-gulp", "fa fa-hacker-news", "fa fa-hacker-news-square", "fa fa-hips", "fa fa-hire-a-helper", "fa fa-hooli", "fa fa-hotjar", "fa fa-houzz", "fa fa-html5", "fa fa-hubspot", "fa fa-imdb", "fa-brands fa-instagram", "fa fa-internet-explorer", "fa fa-ioxhost", "fa fa-itunes", "fa fa-itunes-note", "fa fa-jenkins", "fa fa-joget", "fa fa-joomla", "fa fa-js", "fa fa-js-square", "fa fa-jsfiddle", "fa fa-keycdn", "fa fa-kickstarter", "fa fa-kickstarter-k", "fa fa-korvue", "fa fa-laravel", "fa fa-lastfm", "fa fa-lastfm-square", "fa fa-leanpub", "fa fa-less", "fa fa-line", "fa-brands fa-linkedin", "fa-brands fa-linkedin-in", "fa fa-linode", "fa fa-linux", "fa fa-lyft", "fa fa-magento", "fa fa-maxcdn", "fa fa-medapps", "fa fa-medium", "fa fa-medium-m", "fa fa-medrt", "fa fa-meetup", "fa fa-microsoft", "fa fa-mix", "fa fa-mixcloud", "fa fa-mizuni", "fa fa-modx", "fa fa-monero", "fa fa-napster", "fa fa-nintendo-switch", "fa fa-node", "fa fa-node-js", "fa fa-npm", "fa fa-ns8", "fa fa-nutritionix", "fa fa-odnoklassniki", "fa fa-odnoklassniki-square", "fa fa-opencart", "fa fa-openid", "fa fa-opera", "fa fa-optin-monster", "fa fa-osi", "fa fa-page4", "fa fa-pagelines", "fa fa-palfed", "fa fa-patreon", "fa fa-paypal", "fa fa-periscope", "fa fa-phabricator", "fa fa-phoenix-framework", "fa fa-php", "fa fa-pied-piper", "fa fa-pied-piper-alt", "fa fa-pied-piper-pp", "fa fa-pinterest", "fa fa-pinterest-p", "fa fa-pinterest-square", "fa fa-playstation", "fa fa-product-hunt", "fa fa-pushed", "fa fa-python", "fa fa-qq", "fa fa-quinscape", "fa fa-quora", "fa fa-ravelry", "fa fa-react", "fa fa-readme", "fa fa-rebel", "fa fa-red-river", "fa fa-reddit", "fa fa-reddit-alien", "fa fa-reddit-square", "fa fa-rendact", "fa fa-renren", "fa fa-replyd", "fa fa-resolving", "fa fa-rocketchat", "fa fa-rockrms", "fa fa-safai", "fa fa-sass", "fa fa-schlix", "fa fa-scribd", "fa fa-searchengin", "fa fa-sellcast", "fa fa-sellsy", "fa fa-servicestack", "fa fa-shirtsinbulk", "fa fa-simplybuilt", "fa fa-sistrix", "fa fa-skyatlas", "fa fa-skype", "fa fa-slack", "fa fa-slack-hash", "fa fa-slideshare", "fa fa-snapchat", "fa fa-snapchat-ghost", "fa fa-snapchat-square", "fa fa-soundcloud", "fa fa-speakap", "fa fa-spotify", "fa fa-stack-exchange", "fa fa-stack-overflow", "fa fa-staylinked", "fa fa-steam", "fa fa-steam-square", "fa fa-steam-symbol", "fa fa-sticker-mule", "fa fa-strava", "fa fa-stripe", "fa fa-stripe-s", "fa fa-studiovinari", "fa fa-stumbleupon", "fa fa-stumbleupon-circle", "fa fa-superpowers", "fa fa-supple", "fa fa-telegram", "fa fa-telegram-plane", "fa fa-tencent-weibo", "fa fa-themeisle", "fa fa-trello", "fa fa-tripadvisor", "fa fa-tumblr", "fa fa-tumblr-square", "fa fa-twitch", "fa-brands fa-twitter", "fa-brands fa-twitter-square", "fa fa-typo3", "fa fa-uber", "fa fa-uikit", "fa fa-uniregistry", "fa fa-untappd", "fa fa-usb", "fa fa-ussunnah", "fa fa-vaadin", "fa fa-viacoin", "fa fa-viadeo", "fa fa-viadeo-square", "fa fa-viber", "fa fa-vimeo", "fa fa-vimeo-square", "fa fa-vimeo-v", "fa fa-vine", "fa fa-vk", "fa fa-vnv", "fa fa-vuejs", "fa fa-weibo", "fa fa-weixin", "fa-brands fa-whatsapp", "fa-brands fa-whatsapp-square", "fa fa-whmcs", "fa fa-wikipedia-w", "fa fa-windows", "fa fa-wordpress", "fa fa-wordpress-simple", "fa fa-wpbeginner", "fa fa-wpexplorer", "fa fa-wpforms", "fa fa-xbox", "fa fa-xing", "fa fa-xing-square", "fa fa-y-combinator", "fa fa-yahoo", "fa fa-yandex", "fa fa-yandex-international", "fa fa-yelp", "fa fa-yoast", "fa fa-youtube", "fa fa-youtube-square"];
        return view('admin.backmenu.create', compact('icons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->has('submenu'));
        $hassubmenu = $request->has('hassubmenu') ? 1 : 0;
        $lastmenu = Menu::orderBy('order_menu')->get()->last();
        $lastmenuCount = $lastmenu != null ? $lastmenu->order_menu : 0;

        $validatedData = [
            'parentMenu' => 'required',
            'menuicon' => 'required',
        ];
        $validator = Validator::make($request->all(), $validatedData);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }
        if (!$hassubmenu) {
            $validatedData = [
                'parentroutename' => 'required',
            ];
            $validator = Validator::make($request->all(), $validatedData);
            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', 'All Fields are required');
            }
        }

        if ($hassubmenu) {
            if($request->submenu == null) {
                return redirect()->back()->withInput()->with('error', 'At least one Submenu is required');
            }
            foreach ($request->submenu as $key => $value) {
                $subMenuValidator = Validator::make(
                    ['submenu' => $value, 'submenuroute' => $request->submenuroute[$key]],
                    ['submenu' => 'required', 'submenuroute' => 'required']
                );
                if ($subMenuValidator->fails()) {
                    return redirect()->back()->withInput()->with('error', 'All Fields are required');
                }
            }
        }




        DB::transaction(function () use ($request, $hassubmenu, $lastmenuCount) {
            $menu = Menu::create([
                "menu" => $request->parentMenu,
                'has_submenu' => $hassubmenu,
                'icon' => $request->menuicon,
                'order_menu' => ++$lastmenuCount
            ]);

            $users = Admin::all();
            if (!$hassubmenu) {
                $submenu = SubMenu::create([
                    "submenu" => $request->parentMenu,
                    "menu_id" => $menu->id,
                    "route_name" => $request->parentroutename
                ]);
                foreach ($users as $userKey => $userValue) {
                    UserMenuAccess::create([
                        'user_id' => $userValue->id,
                        'sub_menu_id' => $submenu->id,
                        'menu_id' => $menu->id,
                    ]);
                }
            } else {
                foreach ($request->submenu as $key => $value) {
                    $submenu = SubMenu::create([
                        "submenu" => $value,
                        "menu_id" => $menu->id,
                        "route_name" => $request->submenuroute[$key],
                    ]);
                    foreach ($users as $userKey => $userValue) {
                        UserMenuAccess::create([
                            'user_id' => $userValue->id,
                            'sub_menu_id' => $submenu->id,
                            'menu_id' => $menu->id,
                        ]);
                    }
                }
            }
        });

        return redirect()->route("menus.index")->with('success', 'Menu Added successfully');
        ;
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menus = Menu::find($id);
        $icons = ["fa fa-address-book", "fa fa-address-card", "fa fa-adjust", "fa fa-align-center", "fa fa-align-justify", "fa fa-align-left", "fa fa-align-right", "fa fa-allergies", "fa fa-ambulance", "fa fa-american-sign-language-interpreting", "fa fa-anchor", "fa fa-angle-double-down", "fa fa-angle-double-left", "fa fa-angle-double-right", "fa fa-angle-double-up", "fa fa-angle-down", "fa fa-angle-left", "fa fa-angle-right", "fa fa-angle-up", "fa fa-archive", "fa fa-arrow-alt-circle-down", "fa fa-arrow-alt-circle-left", "fa fa-arrow-alt-circle-right", "fa fa-arrow-alt-circle-up", "fa fa-arrow-circle-down", "fa fa-arrow-circle-left", "fa fa-arrow-circle-right", "fa fa-arrow-circle-up", "fa fa-arrow-down", "fa fa-arrow-left", "fa fa-arrow-right", "fa fa-arrow-up", "fa fa-arrows-alt", "fa fa-arrows-alt-h", "fa fa-arrows-alt-v", "fa fa-assistive-listening-systems", "fa fa-asterisk", "fa fa-at", "fa fa-audio-description", "fa fa-backward", "fa fa-balance-scale", "fa fa-ban", "fa fa-band-aid", "fa fa-barcode", "fa fa-bars", "fa fa-baseball-ball", "fa fa-basketball-ball", "fa fa-bath", "fa fa-battery-empty", "fa fa-battery-full", "fa fa-battery-half", "fa fa-battery-quarter", "fa fa-battery-three-quarters", "fa fa-bed", "fa fa-beer", "fa fa-bell", "fa fa-bell-slash", "fa fa-bicycle", "fa fa-binoculars", "fa fa-birthday-cake", "fa fa-blind", "fa fa-bold", "fa fa-bolt", "fa fa-bomb", "fa fa-book", "fa fa-bookmark", "fa fa-bowling-ball", "fa fa-box", "fa fa-box-open", "fa fa-boxes", "fa fa-braille", "fa fa-briefcase", "fa fa-briefcase-medical", "fa fa-bug", "fa fa-building", "fa fa-bullhorn", "fa fa-bullseye", "fa fa-burn", "fa fa-bus", "fa fa-calculator", "fa fa-calendar", "fa fa-calendar-alt", "fa fa-calendar-check", "fa fa-calendar-minus", "fa fa-calendar-plus", "fa fa-calendar-times", "fa fa-camera", "fa fa-camera-retro", "fa fa-capsules", "fa fa-car", "fa fa-caret-down", "fa fa-caret-left", "fa fa-caret-right", "fa fa-caret-square-down", "fa fa-caret-square-left", "fa fa-caret-square-right", "fa fa-caret-square-up", "fa fa-caret-up", "fa fa-cart-arrow-down", "fa fa-cart-plus", "fa fa-certificate", "fa fa-chart-area", "fa fa-chart-bar", "fa fa-chart-line", "fa fa-chart-pie", "fa fa-check", "fa fa-check-circle", "fa fa-check-square", "fa fa-chess", "fa fa-chess-bishop", "fa fa-chess-board", "fa fa-chess-king", "fa fa-chess-knight", "fa fa-chess-pawn", "fa fa-chess-queen", "fa fa-chess-rook", "fa fa-chevron-circle-down", "fa fa-chevron-circle-left", "fa fa-chevron-circle-right", "fa fa-chevron-circle-up", "fa fa-chevron-down", "fa fa-chevron-left", "fa fa-chevron-right", "fa fa-chevron-up", "fa fa-child", "fa fa-circle", "fa fa-circle-notch", "fa fa-clipboard", "fa fa-clipboard-check", "fa fa-clipboard-list", "fa fa-clock", "fa fa-clone", "fa fa-closed-captioning", "fa fa-cloud", "fa fa-cloud-download-alt", "fa fa-cloud-upload-alt", "fa fa-code", "fa fa-code-branch", "fa fa-coffee", "fa fa-cog", "fa fa-cogs", "fa fa-columns", "fa fa-comment", "fa fa-comment-alt", "fa fa-comment-dots", "fa fa-comment-slash", "fa fa-comments", "fa fa-compass", "fa fa-compress", "fa fa-copy", "fa fa-copyright", "fa fa-couch", "fa fa-credit-card", "fa fa-crop", "fa fa-crosshairs", "fa fa-cube", "fa fa-cubes", "fa fa-cut", "fa fa-database", "fa fa-deaf", "fa fa-desktop", "fa fa-diagnoses", "fa fa-dna", "fa fa-dollar-sign", "fa fa-dolly", "fa fa-dolly-flatbed", "fa fa-donate", "fa fa-dot-circle", "fa fa-dove", "fa fa-download", "fa fa-edit", "fa fa-eject", "fa fa-ellipsis-h", "fa fa-ellipsis-v", "fa fa-envelope", "fa fa-envelope-open", "fa fa-envelope-square", "fa fa-eraser", "fa fa-euro-sign", "fa fa-exchange-alt", "fa fa-exclamation", "fa fa-exclamation-circle", "fa fa-exclamation-triangle", "fa fa-expand", "fa fa-expand-arrows-alt", "fa fa-external-link-alt", "fa fa-external-link-square-alt", "fa fa-eye", "fa fa-eye-dropper", "fa fa-eye-slash", "fa fa-fat-backward", "fa fa-fat-forward", "fa fa-fax", "fa fa-female", "fa fa-fighter-jet", "fa fa-file", "fa fa-file-alt", "fa fa-file-archive", "fa fa-file-audio", "fa fa-file-code", "fa fa-file-excel", "fa fa-file-image", "fa fa-file-medical", "fa fa-file-medical-alt", "fa fa-file-pdf", "fa fa-file-powerpoint", "fa fa-file-video", "fa fa-file-word", "fa fa-film", "fa fa-filter", "fa fa-fire", "fa fa-fire-extinguisher", "fa fa-first-aid", "fa fa-flag", "fa fa-flag-checkered", "fa fa-flask", "fa fa-folder", "fa fa-folder-open", "fa fa-font", "fa fa-football-ball", "fa fa-forward", "fa fa-frown", "fa fa-futbol", "fa fa-gamepad", "fa fa-gavel", "fa fa-gem", "fa fa-genderless", "fa fa-gift", "fa fa-glass-martini", "fa fa-globe", "fa fa-golf-ball", "fa fa-graduation-cap", "fa fa-h-square", "fa fa-hand-holding", "fa fa-hand-holding-heart", "fa fa-hand-holding-usd", "fa fa-hand-lizard", "fa fa-hand-paper", "fa fa-hand-peace", "fa fa-hand-point-down", "fa fa-hand-point-left", "fa fa-hand-point-right", "fa fa-hand-point-up", "fa fa-hand-pointer", "fa fa-hand-rock", "fa fa-hand-scissors", "fa fa-hand-spock", "fa fa-hands", "fa fa-hands-helping", "fa fa-handshake", "fa fa-hashtag", "fa fa-hdd", "fa fa-heading", "fa fa-headphones", "fa fa-heart", "fa fa-heartbeat", "fa fa-history", "fa fa-hockey-puck", "fa fa-home", "fa fa-hospital", "fa fa-hospital-alt", "fa fa-hospital-symbol", "fa fa-hourglass", "fa fa-hourglass-end", "fa fa-hourglass-half", "fa fa-hourglass-start", "fa fa-i-cursor", "fa fa-id-badge", "fa fa-id-card", "fa fa-id-card-alt", "fa fa-image", "fa fa-images", "fa fa-inbox", "fa fa-indent", "fa fa-industry", "fa fa-info", "fa fa-info-circle", "fa fa-italic", "fa fa-key", "fa fa-keyboard", "fa fa-language", "fa fa-laptop", "fa fa-leaf", "fa fa-lemon", "fa fa-level-down-alt", "fa fa-level-up-alt", "fa fa-life-ring", "fa fa-lightbulb", "fa fa-link", "fa fa-lira-sign", "fa fa-list", "fa fa-list-alt", "fa fa-list-ol", "fa fa-list-ul", "fa fa-location-arrow", "fa fa-lock", "fa fa-lock-open", "fa fa-long-arrow-alt-down", "fa fa-long-arrow-alt-left", "fa fa-long-arrow-alt-right", "fa fa-long-arrow-alt-up", "fa fa-low-vision", "fa fa-magic", "fa fa-magnet", "fa fa-male", "fa fa-map", "fa fa-map-marker", "fa fa-map-marker-alt", "fa fa-map-pin", "fa fa-map-signs", "fa fa-mars", "fa fa-mars-double", "fa fa-mars-stroke", "fa fa-mars-stroke-h", "fa fa-mars-stroke-v", "fa fa-medkit", "fa fa-meh", "fa fa-mercury", "fa fa-microchip", "fa fa-microphone", "fa fa-microphone-slash", "fa fa-minus", "fa fa-minus-circle", "fa fa-minus-square", "fa fa-mobile", "fa fa-mobile-alt", "fa fa-money-bill-alt", "fa fa-moon", "fa fa-motorcycle", "fa fa-mouse-pointer", "fa fa-music", "fa fa-neuter", "fa fa-newspaper", "fa fa-notes-medical", "fa fa-object-group", "fa fa-object-ungroup", "fa fa-outdent", "fa fa-paint-brush", "fa fa-pallet", "fa fa-paper-plane", "fa fa-paperclip", "fa fa-parachute-box", "fa fa-paragraph", "fa fa-paste", "fa fa-pause", "fa fa-pause-circle", "fa fa-paw", "fa fa-pen-square", "fa fa-pencil-alt", "fa fa-people-carry", "fa fa-percent", "fa fa-phone", "fa fa-phone-slash", "fa fa-phone-square", "fa fa-phone-volume", "fa fa-piggy-bank", "fa fa-pills", "fa fa-plane", "fa fa-play", "fa fa-play-circle", "fa fa-plug", "fa fa-plus", "fa fa-plus-circle", "fa fa-plus-square", "fa fa-podcast", "fa fa-poo", "fa fa-pound-sign", "fa fa-power-off", "fa fa-prescription-bottle", "fa fa-prescription-bottle-alt", "fa fa-print", "fa fa-procedures", "fa fa-puzzle-piece", "fa fa-qrcode", "fa fa-question", "fa fa-question-circle", "fa fa-quidditch", "fa fa-quote-left", "fa fa-quote-right", "fa fa-random", "fa fa-recycle", "fa fa-redo", "fa fa-redo-alt", "fa fa-registered", "fa fa-reply", "fa fa-reply-all", "fa fa-retweet", "fa fa-ribbon", "fa fa-road", "fa fa-rocket", "fa fa-rss", "fa fa-rss-square", "fa fa-ruble-sign", "fa fa-rupee-sign", "fa fa-save", "fa fa-search", "fa fa-search-minus", "fa fa-search-plus", "fa fa-seedling", "fa fa-server", "fa fa-share", "fa fa-share-alt", "fa fa-share-alt-square", "fa fa-share-square", "fa fa-shekel-sign", "fa fa-shield-alt", "fa fa-ship", "fa fa-shipping-fat", "fa fa-shopping-bag", "fa fa-shopping-basket", "fa fa-shopping-cart", "fa fa-shower", "fa fa-sign", "fa fa-sign-in-alt", "fa fa-sign-language", "fa fa-sign-out-alt", "fa fa-signal", "fa fa-sitemap", "fa fa-sliders-h", "fa fa-smile", "fa fa-smoking", "fa fa-snowflake", "fa fa-sort", "fa fa-sort-alpha-down", "fa fa-sort-alpha-up", "fa fa-sort-amount-down", "fa fa-sort-amount-up", "fa fa-sort-down", "fa fa-sort-numeric-down", "fa fa-sort-numeric-up", "fa fa-sort-up", "fa fa-space-shuttle", "fa fa-spinner", "fa fa-square", "fa fa-square-full", "fa fa-star", "fa fa-star-half", "fa fa-step-backward", "fa fa-step-forward", "fa fa-stethoscope", "fa fa-sticky-note", "fa fa-stop", "fa fa-stop-circle", "fa fa-stopwatch", "fa fa-street-view", "fa fa-strikethrough", "fa fa-subscript", "fa fa-subway", "fa fa-suitcase", "fa fa-sun", "fa fa-superscript", "fa fa-sync", "fa fa-sync-alt", "fa fa-syringe", "fa fa-table", "fa fa-table-tennis", "fa fa-tablet", "fa fa-tablet-alt", "fa fa-tablets", "fa fa-tachometer-alt", "fa fa-tag", "fa fa-tags", "fa fa-tape", "fa fa-tasks", "fa fa-taxi", "fa fa-terminal", "fa fa-text-height", "fa fa-text-width", "fa fa-th", "fa fa-th-large", "fa fa-th-list", "fa fa-thermometer", "fa fa-thermometer-empty", "fa fa-thermometer-full", "fa fa-thermometer-half", "fa fa-thermometer-quarter", "fa fa-thermometer-three-quarters", "fa fa-thumbs-down", "fa fa-thumbs-up", "fa fa-thumbtack", "fa fa-ticket-alt", "fa fa-times", "fa fa-times-circle", "fa fa-tint", "fa fa-toggle-off", "fa fa-toggle-on", "fa fa-trademark", "fa fa-train", "fa fa-transgender", "fa fa-transgender-alt", "fa fa-trash", "fa fa-trash-alt", "fa fa-tree", "fa fa-trophy", "fa fa-truck", "fa fa-truck-loading", "fa fa-truck-moving", "fa fa-tty", "fa fa-tv", "fa fa-umbrella", "fa fa-underline", "fa fa-undo", "fa fa-undo-alt", "fa fa-universal-access", "fa fa-university", "fa fa-unlink", "fa fa-unlock", "fa fa-unlock-alt", "fa fa-upload", "fa fa-user", "fa fa-user-circle", "fa fa-user-md", "fa fa-user-plus", "fa fa-user-secret", "fa fa-user-times", "fa fa-users", "fa fa-utensil-spoon", "fa fa-utensils", "fa fa-venus", "fa fa-venus-double", "fa fa-venus-mars", "fa fa-vial", "fa fa-vials", "fa fa-video", "fa fa-video-slash", "fa fa-volleyball-ball", "fa fa-volume-down", "fa fa-volume-off", "fa fa-volume-up", "fa fa-warehouse", "fa fa-weight", "fa fa-wheelchair", "fa fa-wifi", "fa fa-window-close", "fa fa-window-maximize", "fa fa-window-minimize", "fa fa-window-restore", "fa fa-wine-glass", "fa fa-won-sign", "fa fa-wrench", "fa fa-x-ray", "fa fa-yen-sign", "fa fa-address-book", "fa fa-address-card", "fa fa-arrow-alt-circle-down", "fa fa-arrow-alt-circle-left", "fa fa-arrow-alt-circle-right", "fa fa-arrow-alt-circle-up", "fa fa-bell", "fa fa-bell-slash", "fa fa-bookmark", "fa fa-building", "fa fa-calendar", "fa fa-calendar-alt", "fa fa-calendar-check", "fa fa-calendar-minus", "fa fa-calendar-plus", "fa fa-calendar-times", "fa fa-caret-square-down", "fa fa-caret-square-left", "fa fa-caret-square-right", "fa fa-caret-square-up", "fa fa-chart-bar", "fa fa-check-circle", "fa fa-check-square", "fa fa-circle", "fa fa-clipboard", "fa fa-clock", "fa fa-clone", "fa fa-closed-captioning", "fa fa-comment", "fa fa-comment-alt", "fa fa-comments", "fa fa-compass", "fa fa-copy", "fa fa-copyright", "fa fa-credit-card", "fa fa-dot-circle", "fa fa-edit", "fa fa-envelope", "fa fa-envelope-open", "fa fa-eye-slash", "fa fa-file", "fa fa-file-alt", "fa fa-file-archive", "fa fa-file-audio", "fa fa-file-code", "fa fa-file-excel", "fa fa-file-image", "fa fa-file-pdf", "fa fa-file-powerpoint", "fa fa-file-video", "fa fa-file-word", "fa fa-flag", "fa fa-folder", "fa fa-folder-open", "fa fa-frown", "fa fa-futbol", "fa fa-gem", "fa fa-hand-lizard", "fa fa-hand-paper", "fa fa-hand-peace", "fa fa-hand-point-down", "fa fa-hand-point-left", "fa fa-hand-point-right", "fa fa-hand-point-up", "fa fa-hand-pointer", "fa fa-hand-rock", "fa fa-hand-scissors", "fa fa-hand-spock", "fa fa-handshake", "fa fa-hdd", "fa fa-heart", "fa fa-hospital", "fa fa-hourglass", "fa fa-id-badge", "fa fa-id-card", "fa fa-image", "fa fa-images", "fa fa-keyboard", "fa fa-lemon", "fa fa-life-ring", "fa fa-lightbulb", "fa fa-list-alt", "fa fa-map", "fa fa-meh", "fa fa-minus-square", "fa fa-money-bill-alt", "fa fa-moon", "fa fa-newspaper", "fa fa-object-group", "fa fa-object-ungroup", "fa fa-paper-plane", "fa fa-pause-circle", "fa fa-play-circle", "fa fa-plus-square", "fa fa-question-circle", "fa fa-registered", "fa fa-save", "fa fa-share-square", "fa fa-smile", "fa fa-snowflake", "fa fa-square", "fa fa-star", "fa fa-star-half", "fa fa-sticky-note", "fa fa-stop-circle", "fa fa-sun", "fa fa-thumbs-down", "fa fa-thumbs-up", "fa fa-times-circle", "fa fa-trash-alt", "fa fa-user", "fa fa-user-circle", "fa fa-window-close", "fa fa-window-maximize", "fa fa-window-minimize", "fa fa-window-restore", "fa fa-500px", "fa fa-accessible-icon", "fa fa-accusoft", "fa fa-adn", "fa fa-adversal", "fa fa-affiliatetheme", "fa fa-algolia", "fa fa-amazon", "fa fa-amazon-pay", "fa fa-amilia", "fa fa-android", "fa fa-angellist", "fa fa-angrycreative", "fa fa-angular", "fa fa-app-store", "fa fa-app-store-ios", "fa fa-apper", "fa fa-apple", "fa fa-apple-pay", "fa fa-asymmetrik", "fa fa-audible", "fa fa-autoprefixer", "fa fa-avianex", "fa fa-aviato", "fa fa-aws", "fa fa-bandcamp", "fa fa-behance", "fa fa-behance-square", "fa fa-bimobject", "fa fa-bitbucket", "fa fa-bitcoin", "fa fa-bity", "fa fa-black-tie", "fa fa-blackberry", "fa fa-blogger", "fa fa-blogger-b", "fa fa-bluetooth", "fa fa-bluetooth-b", "fa fa-btc", "fa fa-buromobelexperte", "fa fa-buysellads", "fa fa-cc-amazon-pay", "fa fa-cc-amex", "fa fa-cc-apple-pay", "fa fa-cc-diners-club", "fa fa-cc-discover", "fa fa-cc-jcb", "fa fa-cc-mastercard", "fa fa-cc-paypal", "fa fa-cc-stripe", "fa fa-cc-visa", "fa fa-centercode", "fa fa-chrome", "fa fa-cloudscale", "fa fa-cloudsmith", "fa fa-cloudversify", "fa fa-codepen", "fa fa-codiepie", "fa fa-connectdevelop", "fa fa-contao", "fa fa-cpanel", "fa fa-creative-commons", "fa fa-css3", "fa fa-css3-alt", "fa fa-cuttlefish", "fa fa-d-and-d", "fa fa-dashcube", "fa fa-delicious", "fa fa-deploydog", "fa fa-deskpro", "fa fa-deviantart", "fa fa-digg", "fa fa-digital-ocean", "fa fa-discord", "fa fa-discourse", "fa fa-dochub", "fa fa-docker", "fa fa-draft2digital", "fa fa-dribbble", "fa fa-dribbble-square", "fa fa-dropbox", "fa fa-drupal", "fa fa-dyalog", "fa fa-earlybirds", "fa fa-edge", "fa fa-elementor", "fa fa-ember", "fa fa-empire", "fa fa-envira", "fa fa-erlang", "fa fa-ethereum", "fa fa-etsy", "fa fa-expeditedssl", "fa-brands fa-facebook", "fa-brands fa-facebook-f", "fa-brands fa-facebook-messenger", "fa-brands fa-facebook-square", "fa fa-firefox", "fa fa-first-order", "fa fa-firstdraft", "fa fa-flickr", "fa fa-flipboard", "fa fa-fly", "fa fa-font-awesome", "fa fa-font-awesome-alt", "fa fa-font-awesome-flag", "fa fa-fonticons", "fa fa-fonticons-fi", "fa fa-fort-awesome", "fa fa-fort-awesome-alt", "fa fa-forumbee", "fa fa-foursquare", "fa fa-free-code-camp", "fa fa-freebsd", "fa fa-get-pocket", "fa fa-gg", "fa fa-gg-circle", "fa fa-git", "fa fa-git-square", "fa-brands fa-github", "fa-brands fa-github-alt", "fa-brands fa-github-square", "fa fa-gitkraken", "fa fa-gitlab", "fa fa-gitter", "fa fa-glide", "fa fa-glide-g", "fa fa-gofore", "fa fa-goodreads", "fa fa-goodreads-g", "fa fa-google", "fa fa-google-drive", "fa fa-google-play", "fa fa-google-plus", "fa fa-google-plus-g", "fa fa-google-plus-square", "fa fa-google-wallet", "fa fa-gratipay", "fa fa-grav", "fa fa-gripfire", "fa fa-grunt", "fa fa-gulp", "fa fa-hacker-news", "fa fa-hacker-news-square", "fa fa-hips", "fa fa-hire-a-helper", "fa fa-hooli", "fa fa-hotjar", "fa fa-houzz", "fa fa-html5", "fa fa-hubspot", "fa fa-imdb", "fa-brands fa-instagram", "fa fa-internet-explorer", "fa fa-ioxhost", "fa fa-itunes", "fa fa-itunes-note", "fa fa-jenkins", "fa fa-joget", "fa fa-joomla", "fa fa-js", "fa fa-js-square", "fa fa-jsfiddle", "fa fa-keycdn", "fa fa-kickstarter", "fa fa-kickstarter-k", "fa fa-korvue", "fa fa-laravel", "fa fa-lastfm", "fa fa-lastfm-square", "fa fa-leanpub", "fa fa-less", "fa fa-line", "fa-brands fa-linkedin", "fa-brands fa-linkedin-in", "fa fa-linode", "fa fa-linux", "fa fa-lyft", "fa fa-magento", "fa fa-maxcdn", "fa fa-medapps", "fa fa-medium", "fa fa-medium-m", "fa fa-medrt", "fa fa-meetup", "fa fa-microsoft", "fa fa-mix", "fa fa-mixcloud", "fa fa-mizuni", "fa fa-modx", "fa fa-monero", "fa fa-napster", "fa fa-nintendo-switch", "fa fa-node", "fa fa-node-js", "fa fa-npm", "fa fa-ns8", "fa fa-nutritionix", "fa fa-odnoklassniki", "fa fa-odnoklassniki-square", "fa fa-opencart", "fa fa-openid", "fa fa-opera", "fa fa-optin-monster", "fa fa-osi", "fa fa-page4", "fa fa-pagelines", "fa fa-palfed", "fa fa-patreon", "fa fa-paypal", "fa fa-periscope", "fa fa-phabricator", "fa fa-phoenix-framework", "fa fa-php", "fa fa-pied-piper", "fa fa-pied-piper-alt", "fa fa-pied-piper-pp", "fa fa-pinterest", "fa fa-pinterest-p", "fa fa-pinterest-square", "fa fa-playstation", "fa fa-product-hunt", "fa fa-pushed", "fa fa-python", "fa fa-qq", "fa fa-quinscape", "fa fa-quora", "fa fa-ravelry", "fa fa-react", "fa fa-readme", "fa fa-rebel", "fa fa-red-river", "fa fa-reddit", "fa fa-reddit-alien", "fa fa-reddit-square", "fa fa-rendact", "fa fa-renren", "fa fa-replyd", "fa fa-resolving", "fa fa-rocketchat", "fa fa-rockrms", "fa fa-safai", "fa fa-sass", "fa fa-schlix", "fa fa-scribd", "fa fa-searchengin", "fa fa-sellcast", "fa fa-sellsy", "fa fa-servicestack", "fa fa-shirtsinbulk", "fa fa-simplybuilt", "fa fa-sistrix", "fa fa-skyatlas", "fa fa-skype", "fa fa-slack", "fa fa-slack-hash", "fa fa-slideshare", "fa fa-snapchat", "fa fa-snapchat-ghost", "fa fa-snapchat-square", "fa fa-soundcloud", "fa fa-speakap", "fa fa-spotify", "fa fa-stack-exchange", "fa fa-stack-overflow", "fa fa-staylinked", "fa fa-steam", "fa fa-steam-square", "fa fa-steam-symbol", "fa fa-sticker-mule", "fa fa-strava", "fa fa-stripe", "fa fa-stripe-s", "fa fa-studiovinari", "fa fa-stumbleupon", "fa fa-stumbleupon-circle", "fa fa-superpowers", "fa fa-supple", "fa fa-telegram", "fa fa-telegram-plane", "fa fa-tencent-weibo", "fa fa-themeisle", "fa fa-trello", "fa fa-tripadvisor", "fa fa-tumblr", "fa fa-tumblr-square", "fa fa-twitch", "fa-brands fa-twitter", "fa-brands fa-twitter-square", "fa fa-typo3", "fa fa-uber", "fa fa-uikit", "fa fa-uniregistry", "fa fa-untappd", "fa fa-usb", "fa fa-ussunnah", "fa fa-vaadin", "fa fa-viacoin", "fa fa-viadeo", "fa fa-viadeo-square", "fa fa-viber", "fa fa-vimeo", "fa fa-vimeo-square", "fa fa-vimeo-v", "fa fa-vine", "fa fa-vk", "fa fa-vnv", "fa fa-vuejs", "fa fa-weibo", "fa fa-weixin", "fa-brands fa-whatsapp", "fa-brands fa-whatsapp-square", "fa fa-whmcs", "fa fa-wikipedia-w", "fa fa-windows", "fa fa-wordpress", "fa fa-wordpress-simple", "fa fa-wpbeginner", "fa fa-wpexplorer", "fa fa-wpforms", "fa fa-xbox", "fa fa-xing", "fa fa-xing-square", "fa fa-y-combinator", "fa fa-yahoo", "fa fa-yandex", "fa fa-yandex-international", "fa fa-yelp", "fa fa-yoast", "fa fa-youtube", "fa fa-youtube-square"];
        return view("admin.backmenu.edit", compact('menus', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hassubmenu = $request->has('hassubmenu') ? 1 : 0;
        $lastmenu = Menu::orderBy('order_menu')->get()->last();
        $lastmenuCount = $lastmenu != null ? $lastmenu->order_menu : 0;

        $validatedData = [
            'parentMenu' => 'required',
            'menuicon' => 'required',
        ];
        $validator = Validator::make($request->all(), $validatedData);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }
        // dd($request->has('submenu'));

        if($request->submenu == null) {
            return redirect()->back()->withInput()->with('error', 'At least one Submenu is required');
        }
        foreach ($request->submenu as $key => $value) {
            $subMenuValidator = Validator::make(
                ['submenu' => $value, 'submenuroute' => $request->submenuroute[$key]],
                ['submenu' => 'required', 'submenuroute' => 'required']
            );
            if ($subMenuValidator->fails()) {
                return redirect()->back()->withInput()->with('error', 'All Fields are required');
            }
        }


        DB::transaction(function () use ($request, $id) {
            $menu = Menu::find($id);
            if ($menu != null) {
                // if($menu->menu != $request->parentMenu)
                // {
                $menu->menu = $request->parentMenu;
                $menu->has_submenu = count($request->submenuId) > 1 ? 1 : 0;
                $menu->icon = $request->menuicon;
                $menu->save();
                // }
                $users = Admin::all();
                if (count($request->submenuId) > 1) {
                    foreach ($request->submenuId as $key => $value) {
                        if ($value == 0) {
                            $submenu = SubMenu::create([
                                "submenu" => $request->submenu[$key],
                                "menu_id" => $menu->id,
                                "route_name" => $request->submenuroute[$key]
                            ]);

                            foreach ($users as $userKey => $userValue) {

                                UserMenuAccess::create([
                                    'user_id' => $userValue->id,
                                    'sub_menu_id' => $submenu->id,
                                    'menu_id' => $menu->id,

                                ]);
                            }
                        } else {
                            SubMenu::find($request->submenuId[$key])->update([
                                "submenu" => $request->submenu[$key],
                                "menu_id" => $menu->id,
                                "route_name" => $request->submenuroute[$key]
                            ]);
                        }
                    }
                } else {
                    SubMenu::find($request->submenuId[0])->update([
                        "submenu" => $request->submenu[0],
                        "menu_id" => $menu->id,
                        "route_name" => $request->submenuroute[0]
                    ]);
                }
            }
        }, 3);
        return redirect()->route("menus.index")->with('success', 'Menu Updated successfully');
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $menu = Menu::find($id);
            $submenus = SubMenu::where('menu_id', $menu->id);
            $userAccess = UserMenuAccess::whereIn('sub_menu_id', SubMenu::where('menu_id', $menu->id)->select('id')->get()->toArray());
            $userAccess->delete();
            $submenus->delete();
            $menu->delete();
        }, 3);
        return response()->json(["status" => true]);
    }


    public function subMenuDelete(Request $request)
    {
        $status = false;
        DB::transaction(function () use ($request, &$status) {
            $subMenu = SubMenu::find($request->subMenuId);
            if ($subMenu != null) {
                UserMenuAccess::where("sub_menu_id", $subMenu->id)->delete();
                $subMenu->delete();
                $status = true;
            } else {
                $status = false;
            }
        }, 3);
        return response()->json(["status" => $status]);
    }
    public function sort()
    {
        $menus = Menu::orderBy('order_menu')->get();
        return view('admin.backmenu.sortmenu', compact('menus'));
    }
    public function sortPost(Request $request)
    {
        foreach ($request->menus as $key => $item) {
            $menu = Menu::find($item);
            $menu->order_menu = $key;
            $menu->save();
        }
        return response()->json(['status' => true]);
    }
    public function sortMenu(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $update = Menu::where('id', $value)->update(['order_menu' => $key]);
        }
        $collection = Menu::orderby('order_menu', 'asc')->with('submenus')->get();

        return response()->json($collection);
    }
}
