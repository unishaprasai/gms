@extends('frontend.layouts.main')


@section('main-container')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="frontend/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb-text">
                    <h2>Classes detail</h2>
                    <div class="bt-option">
                        <a href="/user">Home</a>
                        <span>Classes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->


<!-- Class Timetable Section Begin -->
<section class="class-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="class-details-timetable_title">
                    <h5>Classes timetable</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="class-timetable details-timetable">
                    <table class="table">

                        <thead>
                            <tr>
                                <th></th>
                                <th>Sunday</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $previousClassTime = null;
                            @endphp

                            @foreach($classes as $class)
                            @if ($class->class_time !== $previousClassTime)
                            @php
                            $previousClassTime = $class->class_time;
                            $classesByTime = $classes->where('class_time', $class->class_time);
                            @endphp
                            <tr>
                                <td class="class-time">{{ $class->class_time }}</td>
                                @foreach($classesByTime as $classByTime)
                                <td class="hover-dp ts-meta" data-tsmeta="fitness">
                                    @if ($classByTime->shift === 'Sunday')
                                    @if ($classByTime->class_time === $previousClassTime)
                                    <h5>{{ $classByTime->ClassName }}</h5>
                                    <span>{{ $classByTime->venue }}</span>
                                    @endif
                                    @elseif ($classByTime->shift === 'Monday')
                                    @if ($classByTime->class_time === $previousClassTime)
                                    <h5>{{ $classByTime->ClassName }}</h5>
                                    <span>{{ $classByTime->venue }}</span>
                                    @endif
                                    @elseif ($classByTime->shift === 'Tuesday')
                                    @if ($classByTime->class_time === $previousClassTime)
                                    <h5>{{ $classByTime->ClassName }}</h5>
                                    <span>{{ $classByTime->venue }}</span>
                                    @endif
                                    @elseif ($classByTime->shift === 'Wednesday')
                                    @if ($classByTime->class_time === $previousClassTime)
                                    <h5>{{ $classByTime->ClassName }}</h5>
                                    <span>{{ $classByTime->venue }}</span>
                                    @endif
                                    @elseif ($classByTime->shift === 'Thursday')
                                    @if ($classByTime->class_time === $previousClassTime)
                                    <h5>{{ $classByTime->ClassName }}</h5>
                                    <span>{{ $classByTime->venue }}</span>
                                    @endif
                                    @elseif ($classByTime->shift === 'Friday')
                                    @if ($classByTime->class_time === $previousClassTime)
                                    <h5>{{ $classByTime->ClassName }}</h5>
                                    <span>{{ $classByTime->venue }}</span>
                                    @endif
                                    @endif
                                </td>
                                @endforeach
                               
                            </tr>
                            @endif
                            @endforeach
                        </tbody>




                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Class Timetable Section End -->
@endsection