<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="ميزانية,حسابات, الارباح,حسابات مالية, المشاريع الصغيرة والمتوسطة, السعودية">
    <meta name="description"
        content="بعد رحلة طويلة من التجارب للبرامج العالمية والمحلية في الحسابات والإدارة أخرجنا لكم برنامج ميزانية بشكل سهل وبدون تعقيد ليجمع لك حساباتك المالية وارباحك لحظة بلحظة من خلال لوحة تحكم واحدة.">
    <meta property="og:site_name" content="budget">
    <meta property="og:type" content="website">
    <meta property="og:title" content="budget: تم تصميمه للمشاريع الصغيرة والمتوسطة التي تعمل في السعودية">
    <meta name='og:image' content='images/assets/ogg.png'>
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('partials.assets')

    <!-- For Window Tab Color -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#2a2a2a">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#2a2a2a">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#2a2a2a">
    <title>ميزانية | تم تصميمه للمشاريع الصغيرة والمتوسطة التي تعمل في السعودية</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="{{asset('website/images/fav-icon/fav.png')}}">
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('website/fonts/recoleta/stylesheet.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('website/fonts/gordita/stylesheet.css')}}">
    <!-- Main style sheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/main-style.css')}}">
    <!-- responsive style sheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/responsive.css')}}">

    <!-- Fix Internet Explorer ______________________________________-->
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="{{asset('website/vendor/html5shiv.js')}}"></script>
    <script src="{{asset('website/vendor/respond.js')}}"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#one-page-nav" data-offset="120">
    <div class="main-page-wrapper font-gordita">

        <!-- ===================================================
				Loading Transition
			==================================================== -->
        <!-- <section>
            <div id="preloader">
                <div id="ctn-preloader" class="ctn-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="مي" class="letters-loading">
                                مي
                            </span>
                            <span data-text-preloader="ز" class="letters-loading">
                                ز
                            </span>
                            <span data-text-preloader="ا" class="letters-loading">
                                ا
                            </span>
                            <span data-text-preloader="ن" class="letters-loading">
                                ن
                            </span>
                            <span data-text-preloader="ية" class="letters-loading">
                                ية
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <div class="theme-main-menu sticky-menu theme-menu-five">
            <div class="d-flex align-items-center justify-content-center">
                <div class="logo">
                    <a href="#"><img src="{{asset('website/images/logo/logo.png')}}" alt="ميزانية" title="ميزانية"></a>
                </div>

                <nav id="mega-menu-holder" class="navbar navbar-expand-lg">
                    <div class="container nav-container">
                        <button class="navbar-toggler">
                            <span></span>
                        </button>
                        <div class="navbar-collapse collapse" id="navbarSupportedContent">
                            <div class="d-lg-flex justify-content-between align-items-center">
                                <ul class="navbar-nav main-side-nav font-gordita" id="one-page-nav">
                                    <li class="nav-item dropdown position-static">
                                        <a class="nav-link" href="#">الرئيسية</a>


                                    </li>
                                    <li class="nav-item">
                                        <a href="#feature" class="nav-link">مميزات البرنامج</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#pricing" class="nav-link">كيف يعمل البرنامج</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#about" class="nav-link">من نحن</a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="#feedback" class="nav-link">تواصل معنا</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="right-widget">
                    {{--                    <a href="{{url('ar/dashboard')}}" data-toggle="modal"
                    data-target="#contactModal" class="demo-button"><span>--}}
                        {{--                            سجل لمدة 15 يوم مجاناً</span> <img src="{{asset('website/images/icon/user.svg')}}"--}}
                        {{--                            alt=""></a> --}}


                        <a href="{{url('ar/dashboard')}}" class="demo-button"><span>
                                سجل لمدة 15 يوم مجاناً</span> <img src="{{asset('website/images/icon/user.svg')}}"
                                alt=""></a>
                </div>
            </div>
        </div>
        <!-- /.theme-main-menu -->



        <!--
        =============================================
            Theme Hero Banner
        ==============================================
        -->
        <div class="hero-banner-five">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-11 col-md-10 m-auto">
                        <h1 class="font-recoleta hero-heading">تم تصميم <span>ميزانية</span> للمشاريع الصغيرة و المتوسطة
                            التي تعمل في السعودية.</h1>
                        <p class="hero-sub-heading">تابع حساباتك وارباحك لجميع فروع شركتك وشؤون موظفينك من مكان واحد فقط
                            سهل جداً وبدون تعقيد :).
                        </p>
                    </div>
                </div>

                <p class="sing-in-call">تبغى تجربه؟<a href="#" data-toggle="modal" data-target="#contactModal"> تواصل
                        معنا</a></p>
            </div>

            <div class="img-gallery">
                <div class="container text-center">
                    <div class="screen-container">
                        <img src="{{asset('website/images/Budget.png')}}" alt="" class="main-screen">
                        <img src="{{asset('website/images/assets/screen_01.1.png')}}" alt="" class="shapes screen-one">
                        <img src="{{asset('website/images/assets/screen_01.2.png')}}" alt="" class="shapes screen-two">
                    </div>
                    <!-- /.screen-container -->
                </div>
            </div>
            <!-- /.img-gallery -->
            <img src="{{asset('website/images/banner-clock.png')}}" alt="" class="shapes shape-one" width="200">
            <img src="{{asset('website/images/banner-wallet.png')}}" alt="" class="shapes shape-two" width="80">
            <img src="{{asset('website/images/banner-rocket.png')}}" alt="" class="shapes shape-three" width="100">
            <!-- <img src="images/banner-human.png" alt="" class="shapes shape-four"> -->

            <div class="partner-slider-two mt-110 md-mt-80">
                <div class="container">
                    <p class="text-center">يعمل على البرنامج أكثر من <span>20+</span>شركة ناشئة ومتوسطة
                    </p>
                    <div class="partnerSliderTwo">
                        <div class="item">
                            <div class="img-meta d-flex align-items-center justify-content-center"><img
                                    src="{{asset('website/images/logo/logo3.png')}}" alt=""></div>
                        </div>
                        <div class="item">
                            <div class="img-meta d-flex align-items-center justify-content-center"><img
                                    src="{{asset('website/images/logo/logo2.png')}}" alt=""></div>
                        </div>
                        <div class="item">
                            <div class="img-meta d-flex align-items-center justify-content-center"><img
                                    src="{{asset('website/images/logo/logo4.png')}}" alt=""></div>
                        </div>
                        <div class="item">
                            <div class="img-meta d-flex align-items-center justify-content-center"><img
                                    src="{{asset('website/images/logo/logo5.png')}}" alt=""></div>
                        </div>
                        <div class="item">
                            <div class="img-meta d-flex align-items-center justify-content-center"><img
                                    src="{{asset('website/images/logo/logo1.png')}}" alt=""></div>
                        </div>
                        <div class="item">
                            <div class="img-meta d-flex align-items-center justify-content-center"><img
                                    src="{{asset('website/images/logo/logo3.png')}}" alt=""></div>
                        </div>
                        <div class="item">
                            <div class="img-meta d-flex align-items-center justify-content-center"><img
                                    src="{{asset('website/images/logo/logo5.png')}}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.partner-slider-two -->
        </div>
        <!-- /.hero-banner-five -->



        <!--
        =============================================
            Fancy Feature Ten
        ==============================================
        -->
        <div class="fancy-feature-ten mt-100 md-mt-70" id="feature">
            <div class="bg-wrapper">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-6" data-aos="fade-left" data-aos-duration="1200">
                            <div class="title-style-six">
                                <h2>ماذا يقدم برنامج ؟
                                    <span>ميزانية</span>
                                </h2>
                            </div>
                            <!-- /.title-style-six -->
                        </div>
                        <div class="col-lg-5 col-md-6" data-aos="fade-right" data-aos-duration="1200">
                            <p class="sub-text pt-30 pb-30">بعد رحلة طويلة من التجارب للبرامج العالمية والمحلية في
                                الحسابات والإدارة أخرجنا لكم برنامج ميزانية بشكل سهل وبدون تعقيد ليجمع لك حساباتك
                                المالية وارباحك لحظة بلحظة من خلال لوحة تحكم واحدة.

                            </p>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-35 md-mt-20">
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200">
                            <div class="block-style-fifteen mt-40">
                                <div class="icon d-flex align-items-center justify-content-center"><img
                                        src="{{asset('website/images/global-payment-icon-1.png')}}" alt=""></div>
                                <h3>إدارة كاملة
                                </h3>
                                <p>برنامج كامل لإدارة مؤسستك وشركتك وتذكيرك بإنتهاء اي بيانات ستنتهي او تحتاج الى تجديد
                                    من فروع أو موظفين.

                                </p>
                                <!-- <a href="#" class="mt-30"><img src="images/icon/69.svg" alt=""></a> -->
                            </div>
                            <!-- /.block-style-fifteen -->
                        </div>
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                            <div class="block-style-fifteen mt-40">
                                <div class="icon d-flex align-items-center justify-content-center"><img
                                        src="{{asset('website/images/global-payment-icon-2.png')}}" alt=""></div>
                                <h3>المبيعات والمحاسبة
                                </h3>
                                <p>شاهد المبيعات اليومية مباشرة والفواتير والحسابات والقيود اليومية ورصيد الحسابات
                                    البنكية والأرباح والخسائر لاسمح الله بشكل مباشر.

                                </p>
                                <!-- <a href="#" class="mt-30"><img src="images/icon/69.svg" alt=""></a> -->
                            </div>
                            <!-- /.block-style-fifteen -->
                        </div>
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                            <div class="block-style-fifteen mt-40">
                                <div class="icon d-flex align-items-center justify-content-center"><img
                                        src="{{asset('website/images/global-payment-icon-3.png')}}" alt=""></div>
                                <h3>شؤون الموظفين
                                </h3>
                                <p>بيانات الموظفين ورواتبهم والحضور والإنصراف وتاريخ انتهاء العقود ومهامهم اليومية ولكل
                                    موظف صفحة خاصة مرتبطة بالشركة.

                                </p>
                                <!-- <a href="#" class="mt-30"><img src="images/icon/69.svg" alt=""></a> -->
                            </div>
                            <!-- /.block-style-fifteen -->
                        </div>
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                            <div class="block-style-fifteen mt-40">
                                <div class="icon d-flex align-items-center justify-content-center"><img
                                        src="{{asset('website/images/global-payment-icon-4.png')}}" alt=""></div>
                                <h3>حساب ضريبة القيمة المضافة

                                </h3>
                                <p>ميزانية سيقوم بإصدار تقرير تلقائي لحساب ضريبة القيمة المضافة تلقائياً بحسب المدة التي
                                    تريدها.

                                </p>
                                <!-- <a href="#" class="mt-30"><img src="images/icon/69.svg" alt=""></a> -->
                            </div>
                            <!-- /.block-style-fifteen -->
                        </div>
                    </div>
                </div>
                <img src="{{asset('website/images/banner-rocket.png')}}" alt="" class="shapes shape-one">
            </div>
            <!-- /.bg-wrapper -->
        </div>
        <!-- /.fancy-feature-ten -->



        <!--
        =============================================
            Fancy Text block Twenty One
        ==============================================
        -->
        <div class="fancy-text-block-twentyOne mt-75 md-mt-100" id="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-7 m-auto" data-aos="fade-left" data-aos-duration="1200">
                        <div class="img-meta">
                            <img src="{{asset('website/images/banner-human.png')}}" alt=""
                                class="m-auto w-50 bg-white block-style-twentyOne">
                            <img src="{{asset('website/images/shape/138.svg')}}" alt="" class="shapes shape-one">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 mr-auto" data-aos="fade-right" data-aos-duration="1200">
                        <div class="text-wrapper md-pt-50">
                            <!-- <a class="fancybox" data-fancybox="" href="https://www.youtube.com/embed/aXFSJTjVjw0">
                            <img src="images/icon/71.svg" alt="" class="icon"> -->
                            </a>
                            <div class="client-info">كل شئ اصبح اسهل الان
                            </div>
                            <p>
                                <span>ميزانية من جوالك</span>
                            <ul class="li-items">
                                <li>إرسال الفواتير وإدارة العملاء بضغطة زر.</li>
                                <li>دخول آمن من خلال ربط حسابك في Google Authenticator
                                </li>
                                <li>مشاهدة أرباح وخسائر المشاريع والفروع مباشرة.
                                </li>
                                <li>شاهد رسائل الموظفين وحضورهم ومهامهم مباشرة.
                                </li>
                            </ul>
                            </p>

                        </div>
                        <!-- /.text-wrapper -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.fancy-text-block-twentyOne -->



        <!--
        =====================================================
            Counter Style Two
        =====================================================
        -->
        <div class="counter-style-two mt-150 md-mt-60">
            <div class="border-bottom">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="1200">
                            <div class="counter-box-four">
                                <h2 class="number"><span class="timer" data-from="0" data-to="600" data-speed="1500"
                                        data-refresh-interval="5">0</span>+</h2>
                                <p>مهمة يتم إضافتها يومياً
                                </p>
                            </div>
                            <!-- /.counter-box-four -->
                        </div>
                        <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                            <div class="counter-box-four">
                                <h2 class="number"><span class="timer" data-from="0" data-to="2" data-speed="1200"
                                        data-refresh-interval="5">0</span>k</h2>
                                <p>فاتورة يومية يتم إصدارها</p>
                            </div>
                            <!-- /.counter-box-four -->
                        </div>
                        <div class="col-lg-4 col-sm-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                            <div class="counter-box-four">
                                <h2 class="number"><span class="timer" data-from="0" data-to="1000" data-speed="1200"
                                        data-refresh-interval="5">0</span>+</h2>
                                <p>موظف يستخدم ميزانية
                                </p>
                            </div>
                            <!-- /.counter-box-four -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.counter-style-two -->



        <!--
        =====================================================
            Fancy Feature Eleven
        =====================================================
        -->
        <div class="fancy-feature-eleven mt-130 md-mt-80" id="product">
            <div class="inner-container">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-10 col-md-9 m-auto">
                            <div class="title-style-six text-center">
                                <h6>لماذا ميزانية؟</h6>
                                <h2><span>ميزانية </span>أمن وسهل وسريع
                                </h2>
                                <p>نساعدك في التركيز على عملك وعدم الإنشغال خلف الحسابات والضريبة ومهام الموظفين.

                                </p>
                            </div>
                            <!-- /.title-style-six -->
                        </div>
                    </div>
                </div>

                <div class="block-style-sixteen" style="background:#dfe5ff;">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 mr-auto" data-aos="fade-right" data-aos-duration="1200">
                                <div class="icon d-flex align-items-center justify-content-center"><img
                                        src="{{asset('website/images/icon/f1.png')}}" alt=""></div>
                                <h3 class="title">صممه حسب نشاطك
                                </h3>
                                <p>يمكنك تصميم البرنامج حسب نشاطك من خلال صفحة واحدة لكل الشركات والفروع التابعة لها

                                </p>
                                <a href="#"><img src="{{asset('website/images/icon/72.svg')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <img src="{{asset('website/images/b4.jpg')}}" alt="" class="shapes screen-one">
                </div>
                <!-- /.block-style-sixteen -->

                <div class="block-style-sixteen" style="background:#EDF3F9;">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 ml-auto" data-aos="fade-left" data-aos-duration="1200">
                                <div class="icon d-flex align-items-center justify-content-center"><img
                                        src="{{asset('website/images/icon/f3.png')}}" alt=""></div>
                                <h3 class="title">عين مسؤول لكل قسم
                                </h3>
                                <p>يمكنك إعطاء صلاحية لكل مسؤول كمثال: يمكنك إعطاء صلاحية لمدير قسم الموظفين لمتابعة قسم
                                    الموظفين فقط داخل البرنامج

                                </p>
                                <a href="#"><img src="{{asset('website/images/icon/72.svg')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <img src="{{asset('website/images/b1.jpg')}}" alt="" class="shapes screen-two">
                </div>
                <!-- /.block-style-sixteen -->

                <div class="block-style-sixteen" style="background:#e1e2fb;">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 mr-auto" data-aos="fade-right" data-aos-duration="1200">
                                <div class="icon d-flex align-items-center justify-content-center"><img
                                        src="{{asset('website/images/icon/f4.png')}}" alt=""></div>
                                <h3 class="title">تصميم خاص لهوية عملك
                                </h3>
                                <p>يمكنك انشاء رابط خاص بأسم شركتك لدخول الموظفين من خلاله ويمكنك تغيير الألوان والشعار
                                    ليتوافق مع هوية عملك ويشعر موظفينك أنهم داخل برنامج خاص بالشركة.








                                </p>
                                <a href="#"><img src="{{asset('website/images/icon/72.svg')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <img src="{{asset('website/images/b3.jpg')}}" alt="" class="shapes screen-three">
                </div>
                <!-- /.block-style-sixteen -->
                <div class="block-style-sixteen" style="background:#d2d8f1;">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-6 ml-auto" data-aos="fade-left" data-aos-duration="1200">
                                <div class="icon d-flex align-items-center justify-content-center"><img
                                        src="{{asset('website/images/icon/f2.png')}}" alt=""></div>
                                <h3 class="title">تعيين مسؤول حسابات او محاسب
                                </h3>
                                <p>
                                    يمكنك تعيين محاسب لإضافة الفواتير او تعديلها بحسب الصلاحية التي تمنحها له بدون أن
                                    يشاهد الحسابات العامة والأرباح.
                                </p>
                                <a href="#"><img src="{{asset('website/images/icon/72.svg')}}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <img src="{{asset('website/images/b2.jpg')}}" alt="" class="shapes screen-two">
                </div>
                <!-- /.block-style-sixteen -->
            </div>
            <!-- /.inner-container -->
            <img src="{{asset('website/images/shape/139.svg')}}" alt="" class="shapes shape-one">
            <img src="{{asset('website/images/shape/140.svg')}}" alt="" class="shapes shape-two">
        </div>
        <!-- /.fancy-feature-eleven -->



        <!--
        =====================================================
            Pricing Section Four
        =====================================================
        -->
        <div class="pricing-section-four mt-200 md-mt-100 how-it-works" id="pricing">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10  m-auto">
                        <div class="title-style-six text-center">
                            <h2>كيف يعمل برنامج
                                <span>ميزانية</span>
                            </h2>
                            <p>خطوات بسيطة فقط للبدء بإستخدام ميزانية

                            </p>
                        </div>
                        <!-- /.title-style-six -->
                    </div>
                </div>




                <div class="row cus-mar mt-100 ">
                    <div class="col-xl-3 col-sm-6 col-6">
                        <div class="single-item first text-center">
                            <img src="{{asset('website/images/icon/how-works-icon-1.png')}}" alt="icon">
                            <h5>سجل مجاناً</h5>
                            <p>جرب البرنامج مجاناً لمدة 14 يوم</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-6">
                        <div class="single-item second text-center">
                            <img src="{{asset('website/images/icon/how-works-icon-2.png')}}" alt="icon">
                            <h5>أكمل إعدادت حسابك</h5>
                            <p>سجل شركتك او مؤسستك وفروعها وموظفينك</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-6">
                        <div class="single-item first text-center">
                            <img src="{{asset('website/images/icon/how-works-icon-3.png')}}" alt="icon">
                            <h5>جرب اضافة فواتيرك ومبيعاتك</h5>
                            <p>ادخل الفواتير والحسابات لتجربة البرنامج قبل ربطها مع هيئة الضريبة والجمارك</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-6">
                        <div class="single-item text-center">
                            <img src="{{asset('website/images/icon/how-works-icon-4.png')}}" alt="icon">
                            <h5>أنت جاهز!</h5>
                            <p>مبروك, انت الأن جاهز للعمل وترتيب حساباتك في برنامج ميزانية والدعم الفني ومركز المساعدة
                                بين ايديك.</p>
                        </div>
                    </div>
                </div>
                <!-- /.pricing-table-area-four -->
            </div>
        </div>

        <!-- /.pricing-section-four -->


        <!--
        =====================================================
            Client Feedback Slider Four
        =====================================================
        -->
        <div class="client-feedback-slider-four mt-200 md-mt-100" id="feedback">
            <div class="inner-container">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-9 col-md-8 m-auto">
                            <div class="title-style-six text-center">
                                <h2>وش يقولون مستخدمين برنامج
                                    <span>ميزانية</span> ؟
                                </h2>
                                <p>بفضل الله مستخدمين البرنامج سعداء ونحن سعيدين كفريق ميزانية لمساعدتهم على إدارة
                                    اعمالهم وحساباتهم بشكل سهل.

                                </p>
                            </div>
                            <!-- /.title-style-six -->
                        </div>
                    </div>
                </div>
                <div class="clientSliderFour">
                    <div class="item">
                        <div class="feedback-wrapper">
                            <img src="{{asset('website/images/icon/77.svg')}}" alt="" class="icon">
                            <p>أسهل برنامج لإدارة الموظفين فى المملكة العربية السعودية سهل الاستخدام دعم فنى متميز
                                وسريع.
                            </p>
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h6 class="name">احمد سعدون <span>الرياض</span></h6>
                                <ul class="d-flex">
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.feedback-wrapper -->
                    </div>
                    <div class="item">
                        <div class="feedback-wrapper">
                            <img src="{{asset('website/images/icon/77.svg')}}" alt="" class="icon">
                            <p>شكرا لكم برنامج ميزانية سهل عملية ادارة المهام عندنا في الشركة </p>
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h6 class="name">عمر الفايز <span>الرياض</span></h6>
                                <ul class="d-flex">
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.feedback-wrapper -->
                    </div>
                    <div class="item">
                        <div class="feedback-wrapper">
                            <img src="{{asset('website/images/icon/77.svg')}}" alt="" class="icon">
                            <p>شكرا لكم استخدمت البرنامج لفترة تجربية وكان رائع جدا
                            </p>
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h6 class="name">سعود الاحمد <span>الرياض</span></h6>
                                <ul class="d-flex">
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.feedback-wrapper -->
                    </div>
                    <div class="item">
                        <div class="feedback-wrapper">
                            <img src="{{asset('website/images/icon/77.svg')}}" alt="" class="icon">
                            <p>برنامج سهل وسريع جدا ووجهاته بسيطة ومنظمة انصح الكل بتجربته
                            </p>
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h6 class="name">علي عبد الرحمن, <span>الرياض</span></h6>
                                <ul class="d-flex">
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.feedback-wrapper -->
                    </div>
                    <div class="item">
                        <div class="feedback-wrapper">
                            <img src="{{asset('website/images/icon/77.svg')}}" alt="" class="icon">
                            <p>برنامج ممتاز لادارة شؤون الموظفين وتنظيم المهام بطريقة سهلة وسريعة</p>
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h6 class="name">مريم احمد <span>السعودية</span></h6>
                                <ul class="d-flex">
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.feedback-wrapper -->
                    </div>
                    <div class="item">
                        <div class="feedback-wrapper">
                            <img src="{{asset('website/images/icon/77.svg')}}" alt="" class="icon">
                            <p>برنامج ميزانية رائع جدا وانصح الكل بتجربته
                            </p>
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h6 class="name">عبد الله محمد, <span>الرياض</span></h6>
                                <ul class="d-flex">
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.feedback-wrapper -->
                    </div>
                    <div class="item">
                        <div class="feedback-wrapper">
                            <img src="{{asset('website/images/icon/77.svg')}}" alt="" class="icon">
                            <p> سهل سريع ..استخدمت البرنامج لفترة تجريبية
                            </p>
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h6 class="name">محمد نبيل قنديل, <span>مصر</span></h6>
                                <ul class="d-flex">
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.feedback-wrapper -->
                    </div>
                </div>
                <img src="{{asset('website/images/shape/141.svg')}}" alt="" class="shapes shape-one">
                <img src="{{asset('website/images/shape/142.svg')}}" alt="" class="shapes shape-two">
            </div>
            <!-- /.inner-container -->
        </div>
        <!-- /.client-feedback-slider-four -->






        <!--
        =====================================================
            Footer Style Five
        =====================================================
        -->
        <footer class="theme-footer-five mt-130 md-mt-100">
            <div class="inner-container">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-4">
                            <div class="logo">
                                <a href="index.html"><img src="{{asset('website/images/logo/logo.png')}}" alt=""
                                        width="150"></a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="title">تجدنا على وسائل التواصل الاجتماعي
                            </div>
                            <ul class="d-flex justify-content-center social-icon">
                                <li><a href="https://www.instagram.com/budgethelpyou/"><i class="fa fa-instagram"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="https://twitter.com/budgethelpyou"><i class="fa fa-twitter"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <div class="title">يسعدنا دائمًا تقديم المساعدة.
                            </div>
                            <div class="text-center"><a href="#" class="email">hello@budget.help</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.inner-container -->
            <p class="copyright">حقوق النشر © 2022 ميزانية كل الحقوق محفوظة.

            </p>
        </footer>
        <!-- /.theme-footer-five -->



        <!-- Scroll Top Button -->
        <button class="scroll-top">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
        </button>

        <!-- Optional JavaScript _____________________________  -->

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- jQuery -->
        <script src="{{asset('website/vendor/jquery.min.js')}}"></script>
        <!-- Popper js -->
        <script src="{{asset('website/vendor/popper.js/popper.min.js')}}"></script>
        <!-- Bootstrap JS -->
        <script src="{{asset('website/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- menu  -->
        <script src="{{asset('website/vendor/mega-menu/assets/js/custom.js')}}"></script>
        <!-- AOS js -->
        <script src="{{asset('website/vendor/aos-next/dist/aos.js')}}"></script>
        <!-- js count to -->
        <script src="{{asset('website/vendor/jquery.appear.js')}}"></script>
        <script src="{{asset('website/vendor/jquery.countTo.js')}}"></script>
        <!-- Slick Slider -->
        <script src="{{asset('website/vendor/slick/slick.min.js')}}"></script>
        <!-- validator js -->
        <script src="{{asset('website/vendor/validator.js')}}"></script>
        <!-- Fancybox -->
        <script src="{{asset('website/vendor/fancybox/dist/jquery.fancybox.min.js')}}"></script>

        <!-- Theme js -->
        <script src="{{asset('website/js/theme.js')}}"></script>
    </div>
    <!-- /.main-page-wrapper -->
</body>

</html>