<div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                <span></span>
            </button>
            <!--begin::Heading-->
            <div class="d-flex flex-column">
                @if(Auth::user())
                <!--begin::Title-->
                @php
                    $recent_url = Route::current();
                    $urls = explode('/', $recent_url->uri);
                    $first_title = '';
                    $second_title = '';
                    // die(print_r(strpos($urls[1], '{')));
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
                                $first_title = $menu['title'];
                            @endphp
                        @else
                            @php
                                $first_title = $urls[0];
                            @endphp
                        @endif
                        @if (count($menu['children']) > 0)
                            @foreach ($menu['children'] as $ch_menu)
                                @if(isset($urls[1]))
                                    @if(!is_numeric(strpos($urls[1], '{')))
                                        @if ($urls[1] == $ch_menu->name)
                                            @php
                                                $second_title = $ch_menu->title;
                                            @endphp
                                        @else
                                            @php
                                                $second_title = $urls[1];
                                            @endphp
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                        @else
                            @if(isset($urls[1]))
                                @if(!is_numeric(strpos($urls[1], '{')))
                                    @php
                                        $second_title = $urls[1];
                                    @endphp
                                @endif
                            @endif
                        @endif
                    @endforeach

                <h2 class="text-white font-weight-bold my-2 mr-5">
                    @if($second_title != null)
                    {{ ucwords($second_title) }}
                    @else
                    {{ ucwords($first_title) }}
                    @endif
                </h2>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <div class="d-flex align-items-center font-weight-bold my-2">
                    <!--begin::Item-->
                    <a href="{{ url('/') }}" class="opacity-75 hover-opacity-100">
                        <i class="flaticon2-shelter text-white icon-1x"></i>
                    </a>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">{{ ucwords($first_title) }}</a>
                    <!--end::Item-->
                    @if($second_title != null)
                    <!--begin::Item-->
                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                    <a href="" class="text-white text-hover-white opacity-75 hover-opacity-100">{{ ucwords($second_title) }}</a>
                    <!--end::Item-->
                    @endif
                </div>
                <!--end::Breadcrumb-->
                @endif
            </div>
            <!--end::Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
