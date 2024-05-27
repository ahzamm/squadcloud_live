<!--
 * This file is part of the SQUADCLOUD project.
 *
 * (c) SQUADCLOUD TEAM
 *
 * This file contains the configuration settings for the application.
 * It includes database connection details, API keys, and other sensitive information.
 *
 * IMPORTANT: DO NOT MODIFY THIS FILE UNLESS YOU ARE AN AUTHORIZED DEVELOPER.
 * Changes made to this file may cause unexpected behavior in the application.
 *
 * WARNING: DO NOT SHARE THIS FILE WITH ANYONE OR UPLOAD IT TO A PUBLIC REPOSITORY.
 *
 * Website: https://squadcloud.co
 * Created: January, 2024
 * Last Updated: 15th May, 2024
 * Author: Talha Fahim <info@squadcloud.co>
 *-->
 <!-- Code Onset -->
 <header class="sticky-header main-header sticky-header-elements-headeronly mainmenu-position-menu_in_header fixed">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mobile-nav">
                <!-- @livewire('front.front-logo') -->
                <div class="header-menu-left">
                    <img src="/site/img/logo-sm.png" alt="logo" style="width: 30px;margin-right: 10px"/>
                    <span style="font-size:20px;cursor:pointer;display:inline-block;transform:translateY(4px)" onclick="openNav()">&#9776; Menu</span>
                </div>
                <div class="header-center">
                    <div id="navbar" class="navbar navbar-default clearfix mgt-mega-menu menu-right menu-uppercase menu-style-shadow">
                        <div class="navbar-inner">
                            <div class="navbar-collapse collapse">
                                <ul id="menu-onepage-2" class="nav">
                                    @livewire('front.menu')
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="st-sidebar-trigger-effects">
                        <a class="float-sidebar-toggle-btn" data-effect="st-sidebar-effect-2"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <!-- <div class="header-right">
                    <ul class="header-nav">
                        <li class="header-advanced-menu-toggle">
                            <div class="st-sidebar-trigger-effects">
                                <a class="float-sidebar-toggle-btn" data-effect="st-sidebar-effect-2"><i class="fa fa-bars"></i></a>
                            </div>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</header>
<!-- Code Finalize -->