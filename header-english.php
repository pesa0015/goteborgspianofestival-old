<?php
session_start();
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
} elseif ($_SESSION['lang'] !== 'en') {
    $_SESSION['lang'] = 'en';
}
$translate = getTranslations();
$pageId = PAGE_DATES;
$home = home();
$logo = ' <span id="piano">Piano</span>';
$logo .= '<span id="festival">festival</span>';
$logo .= '<br />';
$logo .= '<div id="when">' . begins() . ' - ' . ends() . ' ' . $translate['august'] . ' ' . year();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0">
    <title>Göteborgs Pianofestival</title>
    <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/style.css" />
    <?php wp_head(); ?>
</head>
<body>
    <script>var templateUrl = '<?php echo get_bloginfo("template_url"); ?>';</script>
    <div id="menu-modal" class="md-modal md-effect-1">
        <div class="md-content">
            <ul>
                <li>
                    <a href="<?php bloginfo('home'); ?>"><?=$translate['home']; ?></a>
                </li>
                <li>
                    <a href="" class="go-to-program"><?=$translate['festivalprogram']; ?></a>
                </li>
                <li>
                    <a href="#" class="sub-link open-video">Video <img src="<?php bloginfo('template_url'); ?>/img/video/youtube.png" alt=""></a>
                </li>
                <li>
                    <a href="#" class="open-modal" data-modal="member"><?=$translate['member']; ?></a>
                </li>
                <li>
                    <?php $text = $translate['signup_menu_children']; ?>
                    <a href="#" class="open-modal" data-modal="signup-children"><?php echo $text; ?></a>
                </li>
                <li>
                    <?php $text = $translate['signup_menu_adults']; ?>
                    <a href="#" class="open-modal" data-modal="signup-adults"><?php echo $text; ?></a>
                </li>
                <li id="volonteers" class="open-modal" data-modal="signup-volonteers">
                    <a href="#" class="sub-link"><?=$translate['signup_volonteers']; ?></a>
                </li>
                <li>
                    <?php
                    $board_link = $translate['management_board_link'];
                    $board = $translate['management_board'];
                    ?>
                    <a href="<?php bloginfo('home'); ?>/<?php echo $board_link; ?>"><?php echo $board; ?></a>
                </li>
                <li>
                    <a href="#" class="open-modal" data-modal="contact"><?=$translate['contact']; ?></a>
                </li>
            </ul>
        </div>
        <div id="flags-menu">
            <a href="<?php echo $home; ?>">
                <img src="<?php bloginfo('template_url'); ?>/img/flags/sv.png" alt="">
            </a>
        </div>
        <img src="<?php bloginfo('template_url'); ?>/img/close.png" id="close-menu" class="close-modal" alt="">
    </div>
    <div id="modal-signup-children" class="md-modal md-effect-1">
        <div class="md-content">
            <button class="close-modal">Stäng</button>
            <?php echo getForm('Anmälan - Barn och unga'); ?>
        </div>
    </div>
    <div id="modal-signup-adults" class="md-modal md-effect-1">
        <div class="md-content">
            <button class="close-modal">Stäng</button>
            <?php echo getForm('Anmälan - Folk-Högskolenivå'); ?>
        </div>
    </div>
    <div id="modal-signup-volonteers" class="md-modal md-effect-1">
        <div class="md-content">
            <button class="close-modal">Stäng</button>
            <?php echo getForm('Anmälan - Volontärer'); ?>
        </div>
    </div>
    <div id="modal-contact" class="md-modal md-effect-1">
        <div class="md-content">
            <button class="close-modal">Stäng</button>
            <?php echo getForm('Kontakt'); ?>
        </div>
    </div>
    <div id="modal-member" class="md-modal md-effect-1">
        <div class="md-content">
            <button class="close-modal">Stäng</button>
            <?php echo $translate['member_info']; ?>
            <?php echo getForm('Bli medlem'); ?>
        </div>
    </div>
    <div id="modal-video" class="md-modal md-effect-1">
        <div class="md-content">
            <img src="<?php bloginfo('template_url'); ?>/img/video/close.png" id="video-close-btn" class="close-modal">
            <div id="player"></div>
        </div>
    </div>
    <div class="md-overlay"></div>
    <header>
        <nav>
            <div id="logo">
                <a href="<?php bloginfo('home'); ?>"><?=$translate['gothenburg'] . $logo; ?></div></a>
            </div>
            <div id="flags">
                <a href="<?php echo $home; ?>">
                    <img src="<?php bloginfo('template_url'); ?>/img/flags/sv.png" class="flag" data-lang="sv" alt="">
                </a>
            </div>
            <img src="<?php bloginfo('template_url'); ?>/img/menu.png" id="menu-icon" class="only-mobile" alt="">
            <ul>
                <li class="menu-item"><a href="<?php bloginfo('home'); ?>"><?=str_replace(['<p>', '</p>'], '', $translate['home']); ?></a></li>
                <li class="sub menu-item">
                    <span>
                        <?php $p = $home . '/#festivalprogram'; ?>
                        <a href="<?php echo $p; ?>" class="go"><?=$translate['festivalprogram']; ?></a>
                    </span>
                    <ul>
                        <li>
                            <span id="year-2016">Festivalprogram 2016</span>
                            <ul id="program-2016">
                                <li>
                                    <a href="<?php echo $home; ?>/pedagoger" class="sub-link"><?=$translate['pedagoger']; ?></a>
                                </li>
                                <li>
                                    <?php $musik = $home . '/sagornas-musik'; ?>
                                    <a href="<?php echo $musik; ?>" class="sub-link"><?=$translate['sagornas_musik']; ?></a>
                                </li>
                                <li>
                                    <?php $games = $home . '/pedagoger/#magdalena-prahl'; ?>
                                    <a href="<?php echo $games; ?>" class="sub-link">Music Mind Games</a>
                                </li>
                                <li><span id="young-pianists-span">Unga och lovande pianister</span>
                                    <ul id="young-pianists">
                                        <li>
                                            <?php
                                            $part1 = $home . '/unga-och-lovande-pianister-del-1';
                                            $text = $translate['part'];
                                            ?>
                                            <a href="<?php echo $part1; ?>" class="sub-link"><?php echo $text; ?> 1</a>
                                        </li>
                                        <li>
                                            <?php $part2 = $home . '/unga-och-lovande-pianister-del-2'; ?>
                                            <a href="<?php echo $part2; ?>" class="sub-link"><?php echo $text; ?> 2</a>
                                        </li>
                                        <li>
                                            <?php $part3 = $home . '/unga-och-lovande-pianister-del-3'; ?>
                                            <a href="<?php echo $part3; ?>" class="sub-link"><?php echo $text; ?> 3</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php
                                $concert = $home . '/konsert-med-goteborgs-pianosallskap';
                                $concert_text = $translate['konsert_göteborgs_pianosällskap'];
                                ?>
                                <li><a href="<?php echo $concert; ?>" class="sub-link"><?php echo $concert_text; ?></a></li>
                                <li><a href="<?php bloginfo('home'); ?>/maratonkonsert" class="sub-link">Maratonkonsert</a></li>
                                <li><a href="<?php bloginfo('home'); ?>/finalkonsert" class="sub-link">Finalkonsert</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li id="participate" class="sub menu-item">
                    <span><?=$translate['signup']; ?></span>
                    <ul id="signup">
                        <li id="volonteers" class="open-modal" data-modal="signup-volonteers">
                            <a href="#" class="sub-link"><?=$translate['signup_volonteers']; ?></a>
                        </li>
                        <li id="children" class="open-modal" data-modal="signup-children">
                            <a href="#" class="sub-link"><?=$translate['signup_children']; ?></a>
                        </li>
                        <li id="adults" class="open-modal" data-modal="signup-adults">
                            <a href="#" class="sub-link"><?=$translate['signup_adults']; ?></a>
                        </li>
                    </ul>
                </li>
                <li id="media" class="sub menu-item">
                    <span>Media</span>
                    <ul>
                        <li>
                            <a href="#" class="sub-link open-video">Video Pianofestival 2016</a>
                        </li>
                    </ul>
                </li>
                <li id="more" class="sub menu-item">
                    <span>Mer <img src="<?php bloginfo('template_url'); ?>/img/more.png" alt=""></span>
                    <ul>
                        <li>
                            <a href="#" class="sub-link open-modal" data-modal="contact"><?=$translate['contact']; ?></a>
                        </li>
                        <li>
                            <a href="#" class="sub-link open-modal" data-modal="member"><?=$translate['member']; ?></a>
                        </li>
                        <li>
                            <?php $management_board = $home . '/' . $translate['management_board_link']; ?>
                            <a href="<?php echo $management_board; ?>" class="sub-link"><?=$translate['management_board']; ?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <div id="wrapper">