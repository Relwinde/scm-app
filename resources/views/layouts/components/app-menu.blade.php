<div class="main-sidemenu">
    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
            fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
        </svg></div>
    <ul class="side-menu">
        <li>
            <a class="side-menu__item has-link" href="{{url('/')}}"><i class="side-menu__icon icon icon-home"></i><span
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

                    <div class="panel-body tabs-menu-body p-0 border-0">
                        <div class="tab-content">
                            <div class="tab-pane" id="side1">
                                <ul class="sidemenu-list">
                                    <li><a href="{{url('/dossiers-import')}}" class="slide-item">Dossiers Imports</a></li>
                                    <li><a href="{{url('/dossiers-export')}}" class="slide-item">Dossiers Exports</a></li>
                                    <li><a href="{{url('/dossiers-internes')}}" class="slide-item"> Transports internes</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
        <li>
            <a class="side-menu__item has-link" href="javascript:void(0);"><i class="side-menu__icon fe fe-package"></i><span
            class="side-menu__label">Bons de caisses</span></a>
        </li>
        <li>
            <a class="side-menu__item has-link" href="javascript:void(0);"><i class="side-menu__icon fe fe-package"></i><span
            class="side-menu__label">Caisses</span></a>
        </li>
        <li class="sub-category">
            <h3>Paramètres</h3>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon icon-wrench"></i><span
                class="side-menu__label">Outils</span><i
                class="angle fe fe-chevron-right"></i>
            </a>
            <ul class="slide-menu">
                <li class="panel sidetab-menu">

                    <div class="panel-body tabs-menu-body p-0 border-0">
                        <div class="tab-content">
                            <div class="tab-pane" id="side1">
                                <ul class="sidemenu-list">
                                    <li><a href="{{url('/clients')}}" class="slide-item">Clients</a></li>
                                    {{-- <li><a href="{{url('/fournisseurs')}}" class="slide-item">Fournisseurs</a></li> --}}
                                    <li><a href="{{url('/bureaux-de-douane')}}" class="slide-item">Bureaux de douane</a></li>
                                    <li><a href="{{url('/chauffeurs')}}" class="slide-item">Chauffeurs</a></li>
                                    <li><a href="{{url('/vehicules')}}" class="slide-item">Véhicules</a></li>
                                    <li><a href="{{url('/destinations')}}" class="slide-item">Destinations</a></li>
                                    <li><a href="{{url('/marchandises')}}" class="slide-item">Marchandises</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
            width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg></div>
</div>
