@include('Dashboard.layouts.header')
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    @include('Dashboard.layouts.sidebar')

    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->

      @include('Dashboard.layouts.navbar')


      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y mt-5">
          <!-- Layout Demo -->
          <div class="row">
            <div class="col-md-12">
              <!-- Balance  Card -->
              <div class="card border-solid-1 bg-none border-radius-0 shadow-nones">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-5 m-auto">
                      <div class="cards py-3">
                        <div class="card-bodys">
                          @if($data['locked'])
                          <h5 class="card-title badge rounded-pill alert-warning text-dark px-4 mt-2"> {!!$data['plan']['icon']!!} {{$data['plan']['name']}}</h5>
                          <h5 class="card-title badge rounded-pill alert-danger px-4 effective"><i class="bx bxs-lock"></i> Locked</h5>
                          @else
                          <h5 class="card-title badge rounded-pill alert-primary px-4 effective"><i class="bx bxs-lock-open"></i> Effective</h5>
                          @endif
                          <div class="balance mb-2 mt-2">
                            <div class="title"> <i class="bx bx-task"></i> Order Mission</div>
                            <div>
                              <div class="text-dark mt-2">

                                <span class="balance"><span class="currency">₮</span>{{$data['plan']['comission']}}</span>
                                <small class="text-success mx-1 chart"> {{currency('USDT')}} </small>
                                <small class="text-dark mx-1 f-14"> <i class="bx bx-info-circles"></i></small>
                              </div>
                              <!-- <h5 class="text-success mx-1"> (0.00%)</h5> -->
                              <!-- <div class="demo-inline-spacing">
                                <button type="button" class="btn rounded-pill btn-dark btn-sm">Deposit</button>
                                <button type="button" class="btn rounded-pill btn-outline-dark btn-sm">Withdraw</button>
                              </div> -->
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="cards py-3">
                        <div class="card-bodys">

                         <!--  <div class="balance">
                            <div class="title"> <i class="bx bx-task"></i> Order Mission</div>
                            <div> -->

                              <!-- <h5 class="text-success mx-1"> (0.00%)</h5> -->
                              <ul class="list-group">
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                  <strong class="f-14 text-dark">{{__('Date')}}</strong>
                                  <span class="balance"><span class="currency"></span> <span class="charts f-14">{{$data['mission']['complete_date'] ?? 'N/A'}}</span></span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                  <strong class="f-14 text-dark">{{__('Status')}}</strong>
                                  <span class="balance"><span class="currency"></span> <span class="charts f-14">{{$data['completed'] ? 'completed' : 'pending'}}</span></span>
                                </li>
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                  <strong class="f-14 text-dark">{{__('Comission')}}</strong>
                                  <span class="balance"><span class="currency"></span> <span class="chart f-14">₮{{$data['plan']['comission']}}</span></span>
                                </li>
                                @if($data['completed'])
                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                  <strong class="f-14 text-dark">{{__('Next Mission')}}</strong>
                                  <span class="balance"><span class="currency"></span> <span class="charts f-14 timer" id="timer2">--:--</span></span>
                                </li>
                                @endif

                              </ul>
                              <div class="demo-inline-spacing">
                                @if(!$data['completed'])
                                <button class="btn rounded-pill btn-dark w-100 btn-lg" id="completeBtn" onclick="doTask(<?= $data['plan']['id'] ?>)"> <i class="bx bx-task"></i> <span class="msg">Complete</span></button>
                                @else
                                <button class="btn btn-dark rounded-pill w-100 disbaled" disabled id="timer">
                                  <i class="bx bx-time"></i>
                                  <span class="timer">00:00:00:00</span>
                                </button>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 mt-1">
                      
                      @include('Dashboard.widgets.filter')
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- / Content -->
        <div class="me-xl-0 d-xl-none" style="height: 200px;"></div>


        <div class="content-backdrop fade"></div>
      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
</div>

@include('Dashboard.widgets.modals.message')

<script>

function startTimer(duration, display) {

  if(duration <= 0 ) return;
    var timer = duration, minutes, seconds, days, hours;
    setInterval(function () {
        hours = parseInt((timer/(60*60)) % 24, 10);
        minutes = parseInt((timer/60) % 60, 10);
        seconds = parseInt(timer % 60, 10);
         

        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        $('.timer').html( hours + ":" + minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
            location.reload()
        }
    }, 1000);
}

startTimer(<?= $data['next'] ?>);

  function doTask(id) {


    $('#completeBtn').attr('disabled', '1');
    $('#completeBtn .bx').removeClass('bx-task');
    $('#completeBtn .bx').addClass('spinner-border spinner-border-sm');

    $.post("{{route('dashboard.doTask')}}", {
      id: 3,
      csrf_token: '{{generate_csrf()}}',
    }, function(response) {
      try {

        response = JSON.parse(response);
      } catch (e) {
        response = {
          error: 1,
          message: '{{__("Error try Again")}}'
        }
      }

      
      $('#modal-message').removeClass('text-dark');
      $('#modal-message').removeClass('text-danger');
      
      if (response.error) {
        
        $('#completeBtn .bx').removeClass('spinner-border spinner-border-sm').addClass('bx-task');
        $('#completeBtn').removeClass('disabled')

        $('#modal-message').addClass('text-danger');
      } else {
        $('#completeBtn').attr('disabled', '1').removeClass('btn-dark').addClass('alert-success text-dark')
        $('#completeBtn .bx').removeClass('spinner-border spinner-border-sm').addClass('bx-check')
        $('#completeBtn .msg').html('Done');
        $('#modal-message').addClass('text-dark');

        setTimeout(() => {
          location.reload();
        }, 500);
      }

      $('#modal-message').html(response.message);

      $('#messageModal').modal('show');

    });
  }
</script>
<!-- / Layout wrapper -->
@include('Dashboard.layouts.footer')