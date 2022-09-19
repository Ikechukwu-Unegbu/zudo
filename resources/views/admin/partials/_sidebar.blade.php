<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">Navigation</li>

                    <li class="nav-item">
                        <a href="{{route('admin.home')}}" class="nav-link active">
                            <i class="icon icon-speedometer"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-target"></i>Users<i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            @if($loggedUser->access == 'admin')
                            <li class="nav-item">
                                <a href="{{route('admin.agents')}}" class="nav-link">
                                    <i class="icon icon-target"></i> Agents
                                </a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a href="{{route('admin.customers')}}" class="nav-link">
                                    <i class="icon icon-target"></i> Customers
                                </a>
                            </li>

                            <!-- <li class="nav-item">
                                <a href="{{route('admin.channels')}}" class="nav-link">
                                    <i class="icon icon-target"></i> Channels
                                </a>
                            </li> -->



                            <!-- <li class="nav-item">
                                <a href="layouts-hidden-sidebar.html" class="nav-link">
                                    <i class="icon icon-target"></i> Hidden Sidebar
                                </a>
                            </li> -->
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-energy"></i> Transaction<i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{route('admin.customer.deposit')}}" class="nav-link">
                                    <i class="icon icon-energy"></i> Credits
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.customer.withdrawal')}}" class="nav-link">
                                    <i class="icon icon-target"></i> Debit
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('all.transactions')}}" class="nav-link">
                                    <i class="icon icon-target"></i> All
                                </a>
                            </li>
                            @if(Auth::user()->access == 'admin')
                            <li class="nav-item">
                                <a href="{{route('admin.requests')}}" class="nav-link">
                                    <i class="icon icon-target"></i> Requests
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{route('comments')}}" class="nav-link">
                                    <i class="icon icon-target"></i> Comments
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{--<li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-energy"></i> Transaction<i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{route('admin.customer.deposit')}}" class="nav-link">
                                    <i class="icon icon-energy"></i> Credits
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.customer.withdrawal')}}" class="nav-link">
                                    <i class="icon icon-target"></i> Debit
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('all.transactions')}}" class="nav-link">
                                    <i class="icon icon-target"></i> All
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.support')}}" class="nav-link">
                                    <i class="icon icon-energy"></i> Support
                                </a>
                            </li>


                        </ul>
                    </li>--}}

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-energy"></i> Loan Mgt<i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{route('admin.loan')}}" class="nav-link">
                                    <i class="icon icon-energy"></i> Loans
                                </a>
                            </li>
                           
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-graph"></i> Analytics<i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{route('charts')}}" class="nav-link">
                                    <i class="icon icon-graph"></i> Charts
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="fa fa-question-circle"></i> FAQ's<i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{route('admin.faq.category.index')}}" class="nav-link">
                                    <i class="fa fa-question-circle"></i> FAQ Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.faq.index')}}" class="nav-link">
                                    <i class="fa fa-question-circle"></i> FAQ
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="nav-item">
                        <a href="forms.html" class="nav-link">
                            <i class="icon icon-puzzle"></i> Forms
                        </a>
                    </li> -->

                    <!-- <li class="nav-item">
                        <a href="tables.html" class="nav-link">
                            <i class="icon icon-grid"></i> Tables
                        </a>
                    </li> -->

                    <li class="nav-title">More</li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-umbrella"></i> More <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="{{route('panel.site.settings')}}" class="nav-link">
                                    <i class="icon icon-umbrella"></i> Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.support')}}" class="nav-link">
                                    <i class="icon icon-energy"></i> Support
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
