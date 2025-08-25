<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true" style="background: #2c54a3;">
    <div class="sidebar-header" style="background: #2c54a3;">
        <div>
            <img src="{{ asset('assets/images/LogoIcon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <img src="{{ asset('assets/images/LogoText.png')}}" class="logo-text" style="width: 140px;" alt="logo text">
            <!-- <h4 class="logo-text">Triplecos</h4> -->
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-gauge"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="#" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
        </li>
        <li>
            <a href="{{ route('category.index') }}" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="menu-title">Categories</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="menu-title">Chapters</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('chapter.index') }}">
                        <i class="bi bi-circle"></i>
                        List
                    </a>
                </li>
                <li>
                    <a href="{{ route('mcq.index') }}">
                        <i class="bi bi-circle"></i>
                        Mcqs
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-circle"></i>
                        Mcq Options
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="DriverInvoice.php" class="">
                <div class="parent-icon">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <div class="menu-title">Past Papers</div>
            </a>
        </li>
        <li>
            <a href="WagesList.php" class="">
                <div class="parent-icon">
                    <i class="fa-regular fa-hourglass-half"></i>
                </div>
                <div class="menu-title">References</div>
            </a>
        </li>
        <li>
            <a href="WagesList.php" class="">
                <div class="parent-icon">
                    <i class="fa-regular fa-hourglass-half"></i>
                </div>
                <div class="menu-title">Subscriptions</div>
            </a>
        </li>

        <!-- <li class="menu-label">Others</li> -->
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->