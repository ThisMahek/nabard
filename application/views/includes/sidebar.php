<style>
    .mm-active ul li a:hover{background-color:#667eea!important;color:#fff!important;z-index:99;}
    .mm-active ul li a:hover> svg {color:#fff!important;}
</style>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="<?php echo base_url()?>Admin/index" class="active">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>Admin/manage_user">
                                    <i data-feather="users"></i>
                                    <span data-key="t-users">Manage Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>
                                    <span data-key="t-apps">Manage Vendors</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo base_url()?>Admin/manage_vendor">
                                            <span data-key="t-calendar">Manage FPO/SHG</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>Admin/manage_farmer">
                                            <span data-key="t-calendar">Manage Farmer</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                          <!--   <li>
                                <a href="<?php echo base_url()?>Category/manage_category">
                                    <i data-feather="grid"></i>
                                    <span data-key="t-users">Manage Category</span>
                                </a>
                            </li> -->



                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>
                                    <span data-key="t-apps">Manage Category</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo base_url()?>category/manage_category">
                                            <span data-key="t-calendar">Manage Category</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>category/manage_subcategory">
                                            <span data-key="t-chat"></span>Manage Subcategory</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>Product/manage_product">
                                    <i data-feather="gift"></i>
                                    <span data-key="t-users">Manage Products</span>
                                </a>
                            </li>
                            
                            <li>
                            <a href="<?php echo base_url()?>Admin/product_request">
                            <i data-feather="grid"></i>
                            <span data-key="t-users">Products Request</span>
                            </a>
                            </li>
                                  <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="settings"></i>
                                    <span data-key="t-apps">Enquiry</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                       <li>
                                        <a href="<?php echo base_url()?>Admin/vendor_enquiry">
                                            <span data-key="t-chat"></span>General Enquiry</span>
                                        </a>
                                    </li>
                                      <li>
                                <a href="<?php echo base_url()?>Admin/enquiry">
                                  
                                    <span data-key="t-users">Product Enquiry</span>
                                </a>
                            </li>
                               <li>
                                <a href="<?php echo base_url()?>Admin/user_enquiry">      
                                    <span data-key="t-users">User Enquiry</span>
                                </a>
                            </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>Master/manage_notification">
                                    <i data-feather="bell"></i>
                                    <span data-key="t-users">Manage Notifications</span>
                                </a>
                            </li>
                              <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>
                                    <span data-key="t-apps">Manage Sliders</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo base_url()?>Master/manage_slider">
                                            <span data-key="t-calendar">Manage Slider</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>Master/manage_banner">
                                            <span data-key="t-chat"></span>Manage Banner</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>Admin/manage_team">
                                    <i data-feather="users"></i>
                                    <span data-key="t-users">Manage Team</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>Master/subscriber_list">
                                    <i data-feather="layout"></i>
                                    <span data-key="t-users">Subscriber List</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>Master/manage_faq">
                                    <i data-feather="briefcase"></i>
                                    <span data-key="t-users">Manage FAQ</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>Master/manage_testimonials">
                                    <i data-feather="box"></i>
                                    <span data-key="t-users">Manage Testimonials</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>
                                    <span data-key="t-apps">Manage News/Advisory</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo base_url()?>Master/manage_news">
                                            <span data-key="t-calendar">Manage News</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>Master/manage_events">
                                            <span data-key="t-chat"></span>Manage Events</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--<li>-->
                            <!--    <a href="#">-->
                            <!--        <i data-feather="pie-chart"></i>-->
                            <!--        <span data-key="t-users">Manage Product Stock</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                            <!--<li>-->
                            <!--    <a href="<?php echo base_url()?>Admin/customer_feedback">-->
                            <!--        <i data-feather="edit"></i>-->
                            <!--        <span data-key="t-users">Custumoer Feedback</span>-->
                            <!--    </a>-->
                            <!--</li>-->
                      
                           <!--  <li>
                                <a href="<?php echo base_url()?>Admin/manage_state">
                                    <i data-feather="grid"></i>
                                    <span data-key="t-users">Manage State/District</span>
                                </a>
                            </li> -->


                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>
                                    <span data-key="t-apps">Manage District/Block</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo base_url()?>admin/manage_state">
                                            <span data-key="t-calendar">Manage District</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>admin/manage_block">
                                            <span data-key="t-chat"></span>Manage Block</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            
                         
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="settings"></i>
                                    <span data-key="t-apps">Page Settings</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo base_url()?>Admin/terms_condition">
                                            <span data-key="t-calendar">Terms & Conditions</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()?>Admin/privacy_policies">
                                            <span data-key="t-chat">Privacy Policy</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!--<div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">-->
                        <!--    <div class="card-body">-->
                        <!--        <img src="assets/images/giftbox.png" alt="">-->
                        <!--        <div class="mt-4">-->
                        <!--            <h5 class="alertcard-title font-size-16">Unlimited Access</h5>-->
                        <!--            <p class="font-size-13">Upgrade your plan from a Free trial, to select ‘Business Plan’.</p>-->
                        <!--            <a href="#!" class="btn btn-primary mt-2">Upgrade Now</a>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->