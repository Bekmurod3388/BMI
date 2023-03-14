<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="https://www.ubtuit.uz/img/tuit_logo.png" alt="Brand Logo" class="img-fluid">
              </span>
            <span class=" demo menu-text fw-bolder ms-2">BMI | Kurs ishi</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @if(auth()->check())
            @if(auth()->user()->role=='mudir')

                <li class="menu-item active ">
                    <a href="{{route('statistics-teacher')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-chart"></i>
                        <div data-i18n="Analytics">Statistika O'qituvchilar</div>
                    </a>
                </li><li class="menu-item active ">
                    <a href="{{route('statistics-student')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-bar-chart-alt"></i>
                        <div data-i18n="Analytics">Statistika Talabalar</div>
                    </a>
                </li>
            <li class="menu-item active ">
                <a href="{{route('teachers.index')}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-plus"></i>
                    <div data-i18n="Analytics">O'qituvchilar</div>
                </a>
            </li>
            <li class="menu-item active ">
                <a href="{{route('mudir-themes')}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book"></i>
                    <div data-i18n="Analytics">Mavzular</div>
                </a>

            @else
                <li class="menu-item active ">
                    <a href="{{route('themes')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-book"></i>
                        <div data-i18n="Analytics">Mavzular</div>
                    </a>
                </li>
            @endif
        @endif




        @if(auth()->check())

        @else
                <li class="menu-item active ">
                    <a href="{{route('student-themes')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-book"></i>
                        <div data-i18n="Analytics">Mavzular</div>
                    </a>
                </li>
            <li class="menu-item active ">
                <a href="{{route('process')}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book"></i>
                    <div data-i18n="Analytics">Jarayon</div>
                </a>
            </li>
        @endif


    </ul>
</aside>
