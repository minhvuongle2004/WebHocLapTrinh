<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>HTAV2 - Hãy học theo cách của bạn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap-icons.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/user/css/enrolled-courses.css') }}">



    <link rel='stylesheet' id='mpay-style-css'
        href="{{ asset('assets/user/wp-content/plugins/bck-tu-dong-xac-nhan-thanh-toan-chuyen-khoan-ngan-hang/assets/css/style9704.css?ver=6.7.1') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='masterstudy-bootstrap-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/vendors/bootstrap.mindd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='masterstudy-bootstrap-custom-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/vendors/ms-bootstrap-customdd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='hfe-widgets-style-css'
        href="{{ asset('assets/user/wp-content/plugins/header-footer-elementor/inc/widgets-css/frontend3601.css?ver=2.2.0') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='font-awesome-min-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/vendors/font-awesome.mindd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='stm_lms_icons-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/icons/styledd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='video.js-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/vendors/video-js.mindd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='masterstudy-lms-learning-management-system-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/stm_lmsdd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='stm-lms-noconflict/main-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/parts/noconflict/main7223.css?ver=65') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='woocommerce-layout-css'
        href="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/css/woocommerce-layoutc2dd.css?ver=9.6.2') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='woocommerce-smallscreen-css'
        href="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreenc2dd.css?ver=9.6.2') }}"
        type='text/css' media='only screen and (max-width: 768px)' />
    <link rel='stylesheet' id='woocommerce-general-css'
        href="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/css/woocommercec2dd.css?ver=9.6.2') }}"
        type='text/css' media='all' />
    <style id='woocommerce-inline-inline-css' type='text/css'>
        .woocommerce form .form-row .required {
            visibility: visible;
        }
    </style>

    <link rel='stylesheet' id='hfe-style-css'
        href="{{ asset('assets/user/wp-content/plugins/header-footer-elementor/assets/css/header-footer-elementor3601.css?ver=2.2.0') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-icons-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.minf25c.css?ver=5.35.0') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-frontend-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/css/frontend.min3dd9.css?ver=3.27.6') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-post-884-css'
        href="{{ asset('assets/user/wp-content/uploads/elementor/css/post-8840c1f.css?ver=1734793550') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-post-48181-css'
        href="{{ asset('assets/user/wp-content/uploads/elementor/css/post-48181b618.css?ver=1734793551') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-post-48178-css'
        href="{{ asset('assets/user/wp-content/uploads/elementor/css/post-48178b618.css?ver=1734793551') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='brands-styles-css'
        href="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/css/brandsc2dd.css?ver=9.6.2') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='stm_megamenu-css'
        href="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/includes/megamenu/assets/css/megamenu9704.css?ver=6.7.1') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='starter-style-css'
        href="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/styleffdc.css?ver=2.0.9') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='starter-base-css'
        href="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/assets/css/styleffdc.css?ver=2.0.9') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='google-fonts-css'
        href="{{ asset('assets/user/fonts.googleapis.com/cssdd6d.css?family=Montserrat%3A700%2C600%2C500%2C400%7COpen+Sans%3A700%2C400&amp;ver=2.0.9#038;subset=latin%2Clatin-ext') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='starter-navigation-css'
        href="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/assets/css/components/header/navigationffdc.css?ver=2.0.9') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='starter-icons-css'
        href="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/assets/fonts/ms/styleffdc.css?ver=2.0.9') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='starter-single-post-css'
        href="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/assets/css/components/post/single/single-postffdc.css?ver=2.0.9') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='starter-comments-css'
        href="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/assets/css/components/comments/commentsffdc.css?ver=2.0.9') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='masterstudy-starter-elementor-icons-css'
        href="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/assets/fonts/elementor/icons/styleffdc.css?ver=2.0.9') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='hfe-elementor-icons-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min705c.css?ver=5.34.0') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='hfe-icons-list-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/css/widget-icon-list.min44b4.css?ver=3.24.3') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='hfe-social-icons-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/css/widget-social-icons.min2401.css?ver=3.24.0') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='hfe-social-share-icons-brands-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands52d5.css?ver=5.15.3') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='hfe-social-share-icons-fontawesome-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome52d5.css?ver=5.15.3') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='hfe-nav-menu-icons-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid52d5.css?ver=5.15.3') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='hcb-style-css'
        href="{{ asset('assets/user/wp-content/plugins/highlighting-code-block/build/css/hcb--light7406.css?ver=2.0.1') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='google-fonts-1-css'
        href="{{ asset('assets/user/fonts.googleapis.com/csse306.css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CMontserrat%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&amp;display=swap&amp;subset=vietnamese&amp;ver=6.7.1') }}"
        type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-icons-shared-0-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min52d5.css?ver=5.15.3') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='elementor-icons-fa-solid-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min52d5.css?ver=5.15.3') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='elementor-icons-fa-regular-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/lib/font-awesome/css/regular.min52d5.css?ver=5.15.3') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='elementor-icons-fa-brands-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min52d5.css?ver=5.15.3') }}"
        type='text/css' media='all' />

    <link rel="preconnect" href="{{ asset('fonts.gstatic.com/index.html') }}" crossorigin>

    {{--
    <script type="text/javascript" src="{{ asset('assets/user/wp-includes/js/jquery/jquery.minf43b.js?ver=3.7.1') }}"
        id="jquery-core-js"></script> --}}

    {{--
    <script type="text/javascript"
        src="{{ asset('assets/user/wp-includes/js/jquery/jquery-migrate.min5589.js?ver=3.4.1') }}"
        id="jquery-migrate-js"></script> --}}
    {{--
    <script type="text/javascript" id="jquery-js-after">
        /* <![CDATA[ */ ! function ($) {
            "use strict";
            $(document).ready(function () {
                $(this).scrollTop() > 100 && $(".hfe-scroll-to-top-wrap").removeClass("hfe-scroll-to-top-hide"), $(window).scroll(function () {
                    $(this).scrollTop() < 100 ? $(".hfe-scroll-to-top-wrap").fadeOut(300) : $(".hfe-scroll-to-top-wrap").fadeIn(300)
                }), $(".hfe-scroll-to-top-wrap").on("click", function () {
                    $("html, body").animate({
                        scrollTop: 0
                    }, 300);
                    return !1
                })
            })
        }(jQuery);
        /* ]]> */
    </script> --}}
    <script type="text/javascript" id="stm-lms-lms-js-extra">
        /* <![CDATA[ */
        var stm_lms_vars = {
            "symbol": " \u0111",
            "position": "right",
            "currency_thousands": ",",
            "wp_rest_nonce": "4a0d69b401",
            "translate": {
                "delete": "Are you sure you want to delete this course from cart?"
            }
        };
        /* ]]> */
    </script>
    {{--
    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/js/lms7223.js?ver=65') }}"
        id="stm-lms-lms-js"></script> --}}

    {{--
    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min9e57.js?ver=2.7.0-wc.9.6.2') }}"
        id="jquery-blockui-js" defer="defer" data-wp-strategy="defer"></script> --}}
    <script type="text/javascript" id="wc-add-to-cart-js-extra">
        /* <![CDATA[ */
        var wc_add_to_cart_params = {
            "ajax_url": "\/wp-admin\/admin-ajax.php",
            "wc_ajax_url": "\/?wc-ajax=%%endpoint%%",
            "i18n_view_cart": "Xem gi\u1ecf h\u00e0ng",
            "cart_url": "https:\/\/titv.vn\/gio-hang\/",
            "is_cart": "",
            "cart_redirect_after_add": "no"
        };
        /* ]]> */
    </script>
    {{--
    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.minc2dd.js?ver=9.6.2') }}"
        id="wc-add-to-cart-js" defer="defer" data-wp-strategy="defer"></script> --}}

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.minaef8.js?ver=2.1.4-wc.9.6.2') }}"
        id="js-cookie-js" defer="defer" data-wp-strategy="defer"></script>

    <script type="text/javascript" id="woocommerce-js-extra">
        /* <![CDATA[ */
        var woocommerce_params = {
            "ajax_url": "\/wp-admin\/admin-ajax.php",
            "wc_ajax_url": "\/?wc-ajax=%%endpoint%%"
        };
        /* ]]> */
    </script>
    {{--
    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.minc2dd.js?ver=9.6.2') }}"
        id="woocommerce-js" defer="defer" data-wp-strategy="defer"></script> --}}

    {{--
    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/includes/megamenu/assets/js/megamenu9704.js?ver=6.7.1') }}"
        id="stm_megamenu-js"></script> --}}

    <script type="text/javascript" src="{{ asset('assets/user/www.googletagmanager.com/gtag/jsf7e5?id=GT-TB6VKD3') }}"
        id="google_gtagjs-js" async></script>

    <script type="text/javascript" id="google_gtagjs-js-after">
        /* <![CDATA[ */
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("set", "linker", {
            "domains": ["titv.vn"]
        });
        gtag("js", new Date());
        gtag("set", "developer_id.dZTNiMT", true);
        gtag("config", "GT-TB6VKD3");
        /* ]]> */
    </script>

    <link rel="https://api.w.org/" href="{{ asset('assets/uesr/wp-json/index.html') }}" />

    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/favicon.png') }}" />

    <noscript>
        <style>
            .woocommerce-product-gallery {
                opacity: 1 !important;
            }
        </style>
    </noscript>
    <meta name="generator"
        content="Elementor 3.27.6; features: additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-swap">

    <link rel='stylesheet' id='elementor-post-55605-css'
        href="{{ asset('assets/user/wp-content/uploads/elementor/css/post-556056be9.css?ver=1734793615') }}"
        type='text/css' media='all' />


    <link rel='stylesheet' id='ms_lms_courses-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/elementor-widgets/courses/coursesdd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />
    <link rel='stylesheet' id='ms_lms_courses_select2-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/vendors/select2.mindd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />

    <link rel='stylesheet' id='stm-lms-wishlist-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/parts/wishlist7223.css?ver=65') }}"
        type='text/css' media='all' />



    <link rel='stylesheet' id='course_category_style_1-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/vc_modules/course_category/style_1dd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />
    <link rel='stylesheet' id='course_category_style_2-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/vc_modules/course_category/style_2dd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />
    <link rel='stylesheet' id='course_category_style_3-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/vc_modules/course_category/style_3dd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />
    <link rel='stylesheet' id='course_category_style_4-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/vc_modules/course_category/style_4dd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />
    <link rel='stylesheet' id='course_category_style_5-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/vc_modules/course_category/style_5dd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />
    <link rel='stylesheet' id='course_category_style_6-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/vc_modules/course_category/style_6dd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />
    <link rel='stylesheet' id='wc-blocks-style-css'
        href="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks15b4.css?ver=wc-9.6.2') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='profile-auth-links-style-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/elementor-widgets/auth-linksdd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />

    <link rel='stylesheet' id='linear-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/libraries/nuxy/taxonomy_meta/assets/linearicons/lineardd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='stm-lms-user-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/parts/userdd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />

    <link rel='stylesheet' id='ms_lms_courses_searchbox-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/elementor-widgets/course-search-box/course-search-boxdd8b.css?ver=3.5.16') }}"
        type='text/css' media='' />

    <link rel='stylesheet' id='masterstudy-fonts-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/variables/fontsdd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='masterstudy-single-course-components-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/components/course/maindd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='masterstudy-single-course-sleek-sidebar-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system-pro/assets/css/course/sleek-sidebarc9a9.css?ver=4.6.10') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='masterstudy-buy-button-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/components/buy-buttondd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='masterstudy-hint-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/components/hintdd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='masterstudy-button-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/components/buttondd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='masterstudy-single-course-complete-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/components/course/completedd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='widget-heading-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/css/widget-heading.min3dd9.css?ver=3.27.6') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='widget-icon-list-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/css/widget-icon-list.min3dd9.css?ver=3.27.6') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='widget-menu-anchor-css'
        href="{{ asset('assets/user/wp-content/plugins/elementor/assets/css/widget-menu-anchor.min3dd9.css?ver=3.27.6') }}"
        type='text/css' media='all' />

    <link rel='stylesheet' id='masterstudy-authorization-css'
        href="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/css/components/authorizationdd8b.css?ver=3.5.16') }}"
        type='text/css' media='all' />
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bao gồm thanh navigation từ file navbar.blade.php -->
    @auth
        @include('user.layouts.navbarLogin')
        @include('user.layouts.sidebar')
    @else
        @include('user.layouts.navbar')
    @endauth


    <div class="container">
        @yield('content')
    </div>

    @include('user.layouts.footer')

    <!-- Thư viện jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Thư viện Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const lazyloadRunObserver = () => {
            const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
            const lazyloadBackgroundObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        let lazyloadBackground = entry.target;
                        if (lazyloadBackground) {
                            lazyloadBackground.classList.add('e-lazyloaded');
                        }
                        lazyloadBackgroundObserver.unobserve(entry.target);
                    }
                });
            }, {
                rootMargin: '200px 0px 200px 0px'
            });
            lazyloadBackgrounds.forEach((lazyloadBackground) => {
                lazyloadBackgroundObserver.observe(lazyloadBackground);
            });
        };
        const events = [
            'DOMContentLoaded',
            'elementor/lazyload/observe',
        ];
        events.forEach((event) => {
            document.addEventListener(event, lazyloadRunObserver);
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        });
    </script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/bck-tu-dong-xac-nhan-thanh-toan-chuyen-khoan-ngan-hang/assets/js/easy.qrcode9704.js?ver=6.7.1') }}"
        id="mpay-qrcode-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/themes/ms-lms-starter-theme/assets/js/commentsffdc.js?ver=2.0.9') }}"
        id="starter-comments-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/js/sourcebuster/sourcebuster.minc2dd.js?ver=9.6.2') }}"
        id="sourcebuster-js-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/woocommerce/assets/js/frontend/order-attribution.minc2dd.js?ver=9.6.2') }}"
        id="wc-order-attribution-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/highlighting-code-block/assets/js/prism7406.js?ver=2.0.1') }}"
        id="hcb-prism-js"></script>

    <script type="text/javascript" src="{{ asset('assets/user/wp-includes/js/clipboard.min3c89.js?ver=2.0.11') }}"
        id="clipboard-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/highlighting-code-block/build/js/hcb_script7406.js?ver=2.0.1') }}"
        id="hcb-script-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/libraries/nuxy/metaboxes/assets/js/vue.mindd8b.js?ver=3.5.16') }}"
        id="vue.js-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/vendors/vue2-autocompletedd8b.js?ver=3.5.16') }}"
        id="vue2-autocomplete-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/vendors/vue2-autocompletedd8b.js?ver=3.5.16') }}"
        id="ms_lms_courses_searchbox_autocomplete-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/vendors/plyr/plyrdd8b.js?ver=3.5.16') }}"
        id="plyr-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system-pro/assets/js/certificate-builder/jspdf.umdc9a9.js?ver=4.6.10') }}"
        id="jspdf-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system-pro/assets/js/certificate-builder/qrcode.minc9a9.js?ver=4.6.10') }}"
        id="qrcode-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/masterstudy-lms-learning-management-system-pro/assets/js/certificate-builder/certificates-fontsc9a9.js?ver=4.6.10') }}"
        id="masterstudy_certificate_fonts-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/elementor/assets/js/webpack.runtime.min3dd9.js?ver=3.27.6') }}"
        id="elementor-webpack-runtime-js"></script>

    <script type="text/javascript"
        src="{{ asset('assets/user/wp-content/plugins/elementor/assets/js/frontend.min3dd9.js?ver=3.27.6') }}"
        id="elementor-frontend-js"></script>

</body>

</html>
