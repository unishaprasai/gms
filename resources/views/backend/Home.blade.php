<!DOCTYPE html>
<html lang="en">

<head>
  @include('backend.layouts.css')
</head>

@include('backend.layouts.slidebar')
@include('backend.layouts.header')

<body>
  <div class="page-wrapper">
    <div class="content">
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <div class="dash-count">
            <div class="dash-counts">
              <h4>{{$user}}</h4>
              <h5>Users</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="user"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <div class="dash-count das1">
            <div class="dash-counts">
              <h4>{{$member}}</h4>
              <h5>Members</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="user-check"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <div class="dash-count ">
            <div class="dash-counts">
              <h4>{{$trainer}}</h4>
              <h5>Trainers</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="user-check"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <div class="dash-count das3">
            <div class="dash-counts">
              <h4>{{$enrollments}}</h4>
              <h5>Today's New Enrollments</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="file"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6 col-12">
                        <div class="dash-widget dash3">
                            <div class="dash-widgetimg">
                                <span><img src="backend/assets/img/icons/dash4.svg" alt="img"></span>
                            </div>
                            <div class="dash-widgetcontent">
                                <h5>$<span class="counters" data-count="{{$totalAmountToday}}">{{$totalAmountToday}}</span></h5>
                                <h6>Today's Total Amount</h6>
                            </div>
                        </div>
                    </div>

      <div class="row">
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Pie Chart</div>
            </div>
            <div class="card-body chart-set">
              <canvas class="h-420" id="userPieChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('backend.layouts.footer')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <script>
    var ctx = document.getElementById('userPieChart').getContext('2d');
    var userPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Trainers', 'Members', 'Admins'],
            datasets: [{
                label: 'User Distribution',
                data: [{{ $trainer }}, {{ $member }}, {{ $user - $trainer - $member }}],
                backgroundColor: [
                    'rgb(41, 128, 185)', // Darker Blue
                    'rgb(192, 57, 43)', // Darker Red
                    'rgb(26, 188, 156)' // Darker Greenish-Blue
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            }
        }
    });
</script>

</body>

</html>
