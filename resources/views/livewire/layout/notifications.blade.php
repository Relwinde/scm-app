<div>
    <div class="dropdown  d-flex notifications" style="z-index: 100;" wire:poll.keep-alive.3s="notify">
        {{-- <a class="nav-link icon" data-bs-toggle="dropdown"><i
                class="fe fe-bell"></i> @if ($notificator)
                    <span class=" pulse">*</span>
                @endif 
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <div class="drop-heading border-bottom">
                <div class="d-flex">
                    <h6 class="mt-1 mb-0 fs-16 fw-semibold text-dark">Notifications
                    </h6>
                    
                </div>
            </div>
            <div class="notifications-menu">
                @if ($notificator)
                    <a class="dropdown-item d-flex" href="{{url('notify-list')}}">
                        <div class="me-3 notifyimg  bg-primary brround box-shadow-primary my-auto">
                            <i class="fe fe-mail"></i>
                        </div>
                        <div class="mt-1 wd-80p">
                            <h5 class="notification-label mb-1">Un ou plusieurs de vos bons de caisse ont connu un mouvement
                            </h5>
                        </div>
                    </a>
                @endif
                
                
            </div>
            <div class="dropdown-divider m-0"></div>
                <div class="dropdown-footer p-4">
                    <a class="btn btn-primary btn-pill w-sm btn-sm py-2 btn-block fs-14" href="{{url('notify-list')}}">View All</a>

            </div>
        </div> --}}
    </div>
</div>
@script
        <script>
            $wire.on('notificator', () => {
                (function () {
                    $(function () {
                        var audio = new Audio('/public/audio/notify.mp3');
                        audio.play();
                        return $.growl({
                            title: "Notification :",
                            message: "L'un de vos bons de caisse a connu un mouvement",
                            fixed: true,
                        });
                    });   
                }).call(this);

                
            });
        </script>
    @endscript