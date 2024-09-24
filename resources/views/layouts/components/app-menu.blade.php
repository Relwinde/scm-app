<div class="main-sidemenu">
    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
            fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
        </svg></div>
    <ul class="side-menu">
        <li>
            <a class="side-menu__item has-link" href="{{url('/')}}"><i class="side-menu__icon fe fe-package"></i><span
            class="side-menu__label">Acceuil</span></a>
        </li>
        <li class="sub-category">
            <h3>Opérations</h3>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon fe fe-airplay"></i><span
                class="side-menu__label">Dossiers</span><i
                class="angle fe fe-chevron-right"></i>
            </a>
            <ul class="slide-menu">
                <li class="panel sidetab-menu">
                    {{-- <div class="tab-menu-heading p-0 pb-2 border-0">
                        <div class="tabs-menu "> -->
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                <li><a href="#side1" class="d-flex active" data-bs-toggle="tab"><i class="fe fe-monitor me-2"></i><p>Home</p></a></li>
                                <li><a href="#side2" data-bs-toggle="tab" class="d-flex"><i class="fe fe-message-square me-2"></i><p>Chat</p></a></li>
                            </ul>
                        </div>
                    </div> --}}
                    <div class="panel-body tabs-menu-body p-0 border-0">
                        <div class="tab-content">
                            <div class="tab-pane" id="side1">
                                <ul class="sidemenu-list">
                                    <li class="side-menu-label1"><a href="javascript:void(0);">Dashboards</a></li>
                                    <li><a href="{{url('index')}}" class="slide-item">Imports / Exports</a></li>
                                    <li><a href="{{url('index2')}}" class="slide-item"> Transports internes</a></li>
                                </ul>
                                {{-- <div class="menutabs-content mt-5 p-0">
                                    <div class="Annoucement_card">
                                        <div class="text-center">
                                            <div>
                                                <h5 class="title mt-0 mb-1 ms-2 font-weight-bold fs-12"> Go for Premium Account </h5>
                                                <div class="bg-layer">
                                                    <img src="{{asset('build/assets/images/pngs/24.png')}}" alt="img" class="text-center mx-auto">
                                                </div>
                                                <p class="subtext mt-0 mb-0 ms-2 fs-17 fw-semibold text-center my-2"> $399.9 /Monthly</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-block btn-primary mt-4 fs-14"> Upgrade</button>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="tab-pane" id="side2">
                                <h5 class="mt-3 fw-bold mb-4 tab-title">Recent Chats</h5>
                                <div class="main-chat-list tab-pane">
                                    <div class="media border-0 px-1 new border-top-0">
                                        <div class="main-img-user online">
                                            <img alt="" src="{{asset('build/assets/images/users/5.jpg')}}">
                                        </div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Raymart Santiago</span> <span>10 min</span>
                                            </div>
                                            <p> Hey! there I'm available </p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <div class="main-img-user">
                                            <img alt="" src="{{asset('build/assets/images/users/6.jpg')}}"> <span>3</span>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Ariana Monino</span> <span>30 min</span>
                                            </div>
                                            <p>Good Morning</p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <div class="main-img-user online"><img alt="" src="{{asset('build/assets/images/users/9.jpg')}}"></div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Reynante Labares</span> <span>9.40 am</span>
                                            </div>
                                            <p> Nice to meet you </p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <span class="avatar avatar-md brround bg-danger-transparent text-danger">J</span>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Joyce Chua</span> <span>11.20 am</span>
                                            </div>
                                            <p> Hi, How are you? </p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <div class="main-img-user"><img alt="" src="{{asset('build/assets/images/users/4.jpg')}}"></div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Rolando Paloso</span> <span>1.38 pm</span>
                                            </div>
                                            <p> Hey! there I'm available </p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <div class="main-img-user">
                                            <div class="avatar avatar-md brround bg-primary-transparent text-primary">D</div><span>1</span>
                                        </div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Dexter dela Cruz</span> <span>4.08 pm</span>
                                            </div>
                                            <p>Typing...</p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <div class="main-img-user"><img alt="" src="{{asset('build/assets/images/users/20.jpg')}}"></div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Maricel Villalon</span> <span>8.09 pm</span>
                                            </div>
                                            <p> Hey! there I'm available </p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <span class="avatar avatar-md brround bg-success-transparent text-success">M</span>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Maryjane Pechon</span> <span>1 day ago</span>
                                            </div>
                                            <p>I have some work</p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <div class="main-img-user"><img alt="" src="{{asset('build/assets/images/users/5.jpg')}}"></div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Lovely Dela Cruz</span> <span>3 days ago</span>
                                            </div>
                                            <p>I have some work</p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <div class="avatar avatar-md brround bg-secondary-transparent"><i class="fe fe-user text-secondary"></i></div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Daniel Padilla</span> <span>5 days ago</span>
                                            </div>
                                            <p>I have some work</p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <div class="main-img-user"><img alt="" src="{{asset('build/assets/images/users/3.jpg')}}"></div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>John Pratts</span> <span>20/06/2021</span>
                                            </div>
                                            <p>I have some work</p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new">
                                        <div class="main-img-user"><img alt="" src="{{asset('build/assets/images/users/7.jpg')}}"></div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Socrates Itumay</span> <span>18/07/2021</span>
                                            </div>
                                            <p> Hey! there I'm available </p>
                                        </div>
                                    </div>
                                    <div class="media border-0 px-1 new border-bottom-0">
                                        <div class="main-img-user"><img alt="" src="{{asset('build/assets/images/users/6.jpg')}}"></div>
                                        <div class="media-body">
                                            <div class="media-contact-name">
                                                <span>Samuel Lerin</span> <span>29/07/2021</span>
                                            </div>
                                            <p> Hey! there I'm available </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        <li>
            <a class="side-menu__item has-link" href="{{url('widgets')}}"><i class="side-menu__icon fe fe-package"></i><span
            class="side-menu__label">Bons de caisses</span></a>
        </li>
        <li>
            <a class="side-menu__item has-link" href="{{url('widgets')}}"><i class="side-menu__icon fe fe-package"></i><span
            class="side-menu__label">Caisses</span></a>
        </li>
        <li class="sub-category">
            <h3>Paramètres</h3>
        </li>
        <li>
            <a class="side-menu__item has-link" href="{{url('widgets')}}"><i class="side-menu__icon fe fe-package"></i><span
                    class="side-menu__label">Clients</span></a>
        </li>
        <li>
            <a class="side-menu__item has-link" href="{{url('widgets')}}"><i class="side-menu__icon fe fe-package"></i><span
                    class="side-menu__label">Destinations</span></a>
        </li>
    </ul>
    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
            width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg></div>
</div>
