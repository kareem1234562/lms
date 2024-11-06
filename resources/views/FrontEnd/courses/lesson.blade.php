<!doctype html>
<html lang="{{ trans('common.thisLang') }}" dir="{{ trans('common.dir') }}">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('FrontendAssets/assets/css/plugins.css') }}">
    <!-- Icon Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('FrontendAssets/assets/css/iconplugins.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('FrontendAssets/assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('FrontendAssets/assets/css/responsive.css') }}">
    <!-- Theme Dark CSS -->
    <link rel="stylesheet" href="{{ asset('FrontendAssets/assets/css/theme-dark.css') }}">
    @if (session()->get('Lang') == 'ar')
        <!-- RTL CSS -->
        <link rel="stylesheet" href="{{ asset('FrontendAssets/assets/css/rtl.css') }}">
    @endif
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Title -->
    <title>{{ getSettingValue('website_title') }}</title>
    <meta name="description" content="{{ isset($seo_description) ? $seo_description : getSettingValue('website_title') }}">
    <meta name="keywords" content="{{ isset($seo_keywords) ? $seo_keywords : getSettingValue('website_keywords') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('FrontendAssets/assets/images/favicon.png') }}">
    @yield('new_style')
    {!! getSettingValue('website_header_codes') !!}
</head>
<body>
    <div id="main-wrapper" class="d-flex flex-column">
        <header id="swl-header" class="d-flex justify-content-between">
            <div class="text-start">
                <a href="{{ route('website.index') }}" class="brand-icon">
                    <img src="{{ getSettingImageLink('logo') }}" alt="">
                </a>
            </div>
            <div class="right align-self-center">
                <ul class="d-inline-block my-0 list-inline header-menu user-menu">
                    <li class="list-inline-item"><a href="{{ route('user.dashboard.index') }}"><i class="fa fa-user-circle-o"></i></a></li>
                </ul>
            </div>
        </header>
        <section id="swl-body" class="d-flex align-items-stretch">
            <aside id="swl-nav" class="d-flex flex-column">
                <ul class="list-unstyled course-list">
                    @if (count($lessons) > 0)
                        <li class="course-unit">
                            <div class="my-3">
                                <h4>{{ trans('learning.lessons') }}</h4>
                            </div>
                            <ul class="list-unstyled unit-lessons">
                                @foreach($lessons as $lesson)
                                    <li data-lesson-status="seen">
                                        <a class="d-flex @if($lesson->checkUser() == 0 || $lesson->id == $lesson_details->id) disabled_url @endif" href="{{ route('website.courses.lesson', [$lesson->course_id, $lesson->id]) }}">
                                            <span>{{ $lesson['name_ar'] }}</span>
                                            <strong>{!! $lesson->checkUserCanWatchInList() !!}</strong>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    @foreach ($sections as $section_key => $section_value)
                        <li class="course-unit">
                            <div class="my-3">
                                <h4>{{ $section_value['name_ar'] }}</h4>
                            </div>
                            <ul class="list-unstyled unit-lessons">
                                @foreach($section_value->lessons as $lesson)
                                    <li data-lesson-status="seen">
                                        <a class="d-flex @if($lesson->checkUser() == 0 || $lesson->id == $lesson_details->id) disabled_url @endif" href="{{ route('website.courses.lesson', [$lesson->course_id, $lesson->id]) }}">
                                            <span>{{ $lesson['name_ar'] }}</span>
                                            <strong>{!! $lesson->checkUserCanWatchInList() !!}</strong>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </aside>
            <div id="swl-content" class="d-flex flex-column">
                @if ($lesson_details->getVideoLink() != '')
                    <div class="video-player-container">
                        <video id="LessonVideo">
                            <source src="{{ $lesson_details->getVideoLink() }}" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                        <div class="player-controls d-flex align-items-center">
                            <button class="btn btn-sm btn-outline-secondary player-button playPause" title="Toggle Play"><i class="fa fa-fw fa-play"></i></button>
                            <div class="progress d-flex">
                                <div class="progress-filled"></div>
                            </div>
                            <div class="d-flex">
                                <small><i class="fa fa-volume-up"></i></small>
                                <input type="range" name="volume" id="volume" class="player-slider" min="0" max="1" step="0.05" value="1">
                            </div>
                            <div class="d-flex">
                                <small><i class="fa fa-fast-forward"></i></small>
                                <input type="range" name="playbackRate" id="playbackRate" class="player-slider" min="1" max="3" step="0.5" value="1">
                                <small id="speedRateValue">x1</small>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary player-button fs-button" id="fullscreenToggle"><i class="fa fa-fw fa-expand"></i></button>
                            <button class="btn btn-sm btn-outline-secondary player-button skip-button" id="skip-back" data-skip="-10"><i class="fa fa-fw fa-backward"></i> 10s.</button>
                            <button class="btn btn-sm btn-outline-secondary player-button skip-button" id="skip-ahead" data-skip="10">10s. <i class="fa fa-fw fa-forward"></i></button>
                        </div>
                    </div>
                @endif
                <div class="lesson-content container-fluid">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <h2 class="my-0">{{ $lesson_details['name_ar'] }}</h2>
                            <em><small>{{ $lesson_details->section->name_ar ?? '' }} &mdash; #{{ $lesson_details->getNumber() ?? '' }}</small></em>
                        </div>
                    </div>
                    <hr>
                </div>
        </section>
    </div>

    <style>
        #main-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        #swl-header {
            padding: 5px;
            border-bottom: 3px solid #323232;
            background: #fff;
        }

        #swl-header .brand-icon {
            display: block;
            height: 50px;
            width: 230px;
        }

        #swl-header .brand-icon img {
            max-height: 100%;
        }

        #swl-header .header-menu li a {
            display: block;
            color: #323232;
            padding: 10px 12px;
        }

        #swl-header .header-menu li a:hover,
        #swl-header .header-menu li a:focus {
            background: rgba(0, 0, 0, 0.08);
            text-decoration: none;
        }

        #swl-body {
            flex: 1;
            background: #F2F2F2;
        }

        #swl-nav {
            flex: 0 0 400px;
            background: #3F4249;
        }

        #swl-nav * {
            color: #FFF;
        }

        #swl-nav .course-list {
            flex-grow: 1;
            overflow-y: auto;
            height: 0px;
            margin: 0;
        }

        #swl-nav .course-list .course-unit > div {
            padding: 0 15px;
        }

        #swl-nav .course-list > li:not(:last-child) {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        #swl-nav .course-list .unit-lessons {
            position: relative;
        }

        #swl-nav .course-list .unit-lessons:after {
            content: "";
            display: block;
            height: 100%;
            width: 3px;
            background: rgba(255, 255, 255, 0.08);
            position: absolute;
            top: 0;
            left: 23px;
            bottom: 0;
            z-index: 1;
        }

        #swl-nav .course-list .unit-lessons > li {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.04);
            margin: 0 15px 10px 30px;
            border-radius: 6px;
        }

        #swl-nav .course-list .unit-lessons > li a {
            padding: 5px 15px;
        }

        #swl-content {
            flex-grow: 1;
            overflow-y: auto;
            position: relative;
        }

        #swl-content .video-player-container {
            padding: 15px;
        }

        #swl-content .video-player-container video {
            width: 100%;
        }

        #swl-content .video-player-container .player-controls {
            padding: 8px;
            border-radius: 0 0 4px 4px;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            flex-wrap: wrap;
        }

        #swl-content .video-player-container .player-controls .player-button {
            padding: 0px 10px;
        }

        #swl-content .video-player-container .player-controls .progress {
            flex: 1;
            padding: 0 15px;
            height: 10px;
            position: relative;
        }

        #swl-content .video-player-container .player-controls .progress .progress-filled {
            height: 100%;
            width: 0%;
            background: rgba(255, 255, 255, 0.6);
            position: absolute;
            top: 0;
            left: 0;
        }

        #swl-content .video-player-container .player-controls input[type="range"] {
            background: transparent;
            padding: 0px;
            height: auto;
        }

        #swl-content .video-player-container .player-controls input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            height: 20px;
            width: 10px;
        }

        #swl-content .video-player-container .player-controls input[type="range"]:focus {
            outline: none;
        }

        @media (max-width: 767px) {
            #swl-nav {
                flex: 0 0 100px;
                height: auto;
            }

            #swl-nav .course-list {
                flex-direction: row;
                overflow-x: auto;
            }

            #swl-nav .course-list .course-unit > div,
            #swl-nav .course-list .unit-lessons > li {
                display: inline-block;
                margin: 0 5px;
            }

            #swl-content .video-player-container {
                padding: 5px;
            }

            #swl-content .video-player-container .player-controls {
                flex-direction: column;
                align-items: flex-start;
            }

            #swl-content .video-player-container .player-controls .player-button,
            #swl-content .video-player-container .player-controls input[type="range"],
            #swl-content .video-player-container .player-controls .progress {
                flex: 1 0 auto;
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('FrontendAssets/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('FrontendAssets/assets/js/main.js') }}"></script>
    @yield('new_script')

    <script>
        (function() {
            const video = document.getElementById('LessonVideo');
            const playPauseButton = document.querySelector('.playPause');
            const volumeSlider = document.getElementById('volume');
            const playbackRateSlider = document.getElementById('playbackRate');
            const speedRateValue = document.getElementById('speedRateValue');
            const progress = document.querySelector('.progress');
            const progressFilled = document.querySelector('.progress-filled');
            const fullscreenToggle = document.getElementById('fullscreenToggle');
            const skipButtons = document.querySelectorAll('.skip-button');

            function togglePlayPause() {
                if (video.paused) {
                    video.play();
                    playPauseButton.innerHTML = '<i class="fa fa-fw fa-pause"></i>';
                } else {
                    video.pause();
                    playPauseButton.innerHTML = '<i class="fa fa-fw fa-play"></i>';
                }
            }

            function updateVolume() {
                video.volume = volumeSlider.value;
            }

            function updatePlaybackRate() {
                video.playbackRate = playbackRateSlider.value;
                speedRateValue.textContent = `x${playbackRateSlider.value}`;
            }

            function updateProgress() {
                const percent = (video.currentTime / video.duration) * 100;
                progressFilled.style.width = `${percent}%`;
            }

            function handleProgressClick(e) {
                const scrubTime = (e.offsetX / progress.offsetWidth) * video.duration;
                video.currentTime = scrubTime;
            }

            function handleTouchProgress(e) {
                const touch = e.touches[0];
                const scrubTime = ((touch.clientX - progress.getBoundingClientRect().left) / progress.offsetWidth) * video.duration;
                video.currentTime = scrubTime;
            }

            function handleSkip() {
                video.currentTime += parseFloat(this.dataset.skip);
            }

            function toggleFullscreen() {
                if (video.requestFullscreen) {
                    video.requestFullscreen();
                } else if (video.mozRequestFullScreen) {
                    video.mozRequestFullScreen();
                } else if (video.webkitRequestFullscreen) {
                    video.webkitRequestFullscreen();
                } else if (video.msRequestFullscreen) {
                    video.msRequestFullscreen();
                }
            }

            playPauseButton.addEventListener('click', togglePlayPause);
            volumeSlider.addEventListener('input', updateVolume);
            playbackRateSlider.addEventListener('input', updatePlaybackRate);
            video.addEventListener('timeupdate', updateProgress);
            progress.addEventListener('click', handleProgressClick);
            progress.addEventListener('touchmove', handleTouchProgress);
            fullscreenToggle.addEventListener('click', toggleFullscreen);

            skipButtons.forEach(button => button.addEventListener('click', handleSkip));
        })();
    </script>
</body>
</html>
