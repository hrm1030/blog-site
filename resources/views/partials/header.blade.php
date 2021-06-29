<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container d-flex align-items-stretch justify-content-between">
        <!--begin::Left-->
        <div class="d-flex align-items-stretch mr-3">
            <!--begin::Header Logo-->
            <div class="header-logo">
                <a href="{{ route('home') }}">
                    <img alt="Logo" src="{{ asset('assets/media/logos/logo-letter-9.png') }}" class="logo-default max-h-40px" />
                    <img alt="Logo" src="{{ asset('assets/media/logos/logo-letter-1.png') }}" class="logo-sticky max-h-40px" />
                </a>
            </div>
            <!--end::Header Logo-->
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->
                <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                    <!--begin::Header Nav-->
                    <ul class="menu-nav">
                        @if(Auth::user())

                            @php
                                $current_url = Route::current();
                                $urls = explode('/', $current_url->uri);
                            @endphp
                            @if(Auth::user()->permission == 1)
                                @php
                                    $menus = $admin_menus;
                                @endphp
                            @else
                                @php
                                    $menus = $user_menus;
                                @endphp
                            @endif
                            @foreach($menus as $menu)
                                @if($urls[0] == $menu['name'])
                                    @php

                                        $active = 'menu-item-here';
                                    @endphp
                                @else
                                    @php
                                        $active = '';
                                    @endphp
                                @endif
                                @if (count($menu['children']) > 0)
                                    <li class="menu-item {{ $active }} menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                        <a href="javascript:;" class="menu-link menu-toggle ">
                                            <span class="menu-text">{{ $menu['title'] }}</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                            <ul class="menu-subnav">
                                                @foreach ($menu['children'] as $ch_menu)
                                                    @if(isset($urls[1]))
                                                        @if ($urls[1] == $ch_menu->name)
                                                            @php
                                                                $item_active = 'menu-item-active';
                                                            @endphp
                                                        @else
                                                            @php
                                                                $item_active = '';
                                                            @endphp
                                                        @endif
                                                    @else
                                                        @php
                                                            $item_active = '';
                                                        @endphp
                                                    @endif

                                                    <li class="menu-item {{ $item_active }}" aria-haspopup="true">
                                                        <a href="{{ '/'.$menu['name'].'/'.$ch_menu->name }}" class="menu-link">
                                                            <span class="menu-text">{{ $ch_menu->title }}</span>
                                                            <span class="menu-desc"></span>
                                                        </a>
                                                    </li>


                                                @endforeach

                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    <li class="menu-item menu-item-submenu menu-item-rel {{ $active }}">
                                        <a href="{{ '/'.$menu['name'] }}" class="menu-link"><span class="menu-text">{{ $menu['title'] }}</span></a>
                                    </li>
                                @endif
                            @endforeach
                        @else
                        @php
                            $current_url = Route::current();
                            $urls = explode('/', $current_url->uri);
                        @endphp
                        @php
                            $menus = $user_menus;
                        @endphp
                        @foreach($menus as $menu)
                            @if($urls[0] == $menu['name'])
                                @php

                                    $active = 'menu-item-here';
                                @endphp
                            @else
                                @php
                                    $active = '';
                                @endphp
                            @endif
                            @if (count($menu['children']) > 0)
                                <li class="menu-item {{ $active }} menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link menu-toggle ">
                                        <span class="menu-text">{{ $menu['title'] }}</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                                        <ul class="menu-subnav">
                                            @foreach ($menu['children'] as $ch_menu)
                                                @if(isset($urls[1]))
                                                    @if ($urls[1] == $ch_menu->name)
                                                        @php
                                                            $item_active = 'menu-item-active';
                                                        @endphp
                                                    @else
                                                        @php
                                                            $item_active = '';
                                                        @endphp
                                                    @endif
                                                @else
                                                    @php
                                                        $item_active = '';
                                                    @endphp
                                                @endif

                                                <li class="menu-item {{ $item_active }}" aria-haspopup="true">
                                                    <a href="{{ '/'.$menu['name'].'/'.$ch_menu->name }}" class="menu-link">
                                                        <span class="menu-text">{{ $ch_menu->title }}</span>
                                                        <span class="menu-desc"></span>
                                                    </a>
                                                </li>


                                            @endforeach

                                        </ul>
                                    </div>
                                </li>
                            @else
                                <li class="menu-item menu-item-submenu menu-item-rel {{ $active }}">
                                    <a href="{{ '/'.$menu['name'] }}" class="menu-link"><span class="menu-text">{{ $menu['title'] }}</span></a>
                                </li>
                            @endif
                        @endforeach
                        @endif

                    </ul>
                    <!--end::Header Nav-->
                </div>
                <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
        </div>
        <!--end::Left-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::User-->
            @if(Auth::user())
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item">
                    <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
                        <span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                        <span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">{{ Auth::user()->username }}</span>
                        <span class="symbol symbol-35">
                            <span class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30">
                                {{ ucwords(Auth::user()->username[0]) }}
                            </span>
                        </span>
                    </div>
                </div>
                <!--end::Toggle-->
            </div>
            @else
            <!--begin::login-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item">
                    <a href="{{ url('/auth/login') }}" class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
                        <span class="menu-text"><i class="icon-xl la la-sign-in"></i> Sign in</span>
                    </a>
                </div>
                <!--end::Toggle-->
            </div>
            <!--end::login-->
            <!--begin::login-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item">
                    <a href="{{ url('/auth/register') }}" class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
                        <span class="menu-text"><i class="icon-xl la la-user-plus"></i> Sign up</span>
                    </a>
                </div>
                <!--end::Toggle-->
            </div>
            <!--end::login-->
            @endif
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
