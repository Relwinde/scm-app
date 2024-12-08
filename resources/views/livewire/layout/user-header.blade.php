<div>
    <div class="dropdown d-flex profile-1">
        <a href="javascript:void(0);" data-bs-toggle="dropdown" class="nav-link leading-none d-flex">
            <img src="{{asset('build/assets/images/users/user.jpg')}}" alt="profile-user"
                class="avatar  profile-user brround cover-image">
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="z-index: 999 !important;">
            <div class="drop-heading">
                <div class="text-center">
                    <h5 class="text-dark mb-0 fs-14 fw-semibold">{{Auth::user()->name}}</h5>
                    <small class="text-muted">@foreach (Auth::user()->roles as $role)
                        {{$role->name}}
                    @endforeach</small>
                </div>
            </div>
            <div class="dropdown-divider m-0"></div>
            <a wire:click="$dispatch('openModal', {component: 'user-profile'})" class="dropdown-item" href="javascript:void(0);">
                <i class="dropdown-icon fe fe-user"></i> Modifier mes infos
            </a>
            {{-- <a class="dropdown-item" href="{{url('email')}}">
                <i class="dropdown-icon fe fe-mail"></i> Inbox
                <span class="badge bg-danger rounded-pill float-end">5</span>
            </a> --}}
            <a class="dropdown-item" href="{{url('lockscreen')}}">
                <i class="dropdown-icon fe fe-lock"></i>Vérouiller
            </a>
            <a class="dropdown-item" wire:click='logout' href="javascript:void(0);" >
                <i class="dropdown-icon fe fe-alert-circle"></i>Se déconnecter
            </a>
        </div>
    </div>
</div>
