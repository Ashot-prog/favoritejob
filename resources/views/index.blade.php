<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<button><a href="{{asset('/register')}}">Register</a></button>
<button><a href="{{asset('/login')}}">Login</a></button>
@foreach($jobs as $job)
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{$job->job_title}}</h5>
            <p class="card-text">{{$job->about}}</p>
            @if(\Illuminate\Support\Facades\Auth::id())
                @if($job->user_favorites_count > 0)
                    <div class="request2" data-id="{{$job->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             fill="currentColor"
                             class="bi bi-star-fill " viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                        </svg>
                    </div>
                @else
                    <div class="request1" data-id="{{$job->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-star request"
                             viewBox="0 0 16 16">
                            <path
                                d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                        </svg>
                    </div>
                @endif
            @endif

        </div>
    </div>


@endforeach

<script type="text/javascript">
    $(document).ready(function () {

        $('.request1').click(function () {
            $.ajax({
                type: "GET",
                url: "/favoritejob",
                data: {'job_id': $(this).data('id'), 'candidate_id': {{\Illuminate\Support\Facades\Auth::id()}}}
            })
        })
        $('.request2').click(function () {
            $.ajax({
                type: "GET",
                url: "/destroy",
                data: {'job_id': $(this).data('id')}
            })
        })
    })


</script>

</body>
</html>
