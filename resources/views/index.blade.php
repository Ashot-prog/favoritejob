<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('../index.css')}}">
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
        <div class="card-body ">
            <h5 class="card-title">{{$job->job_title}}</h5>
            <p class="card-text">{{$job->about}}</p>
            @if(\Illuminate\Support\Facades\Auth::id())
                @if($job->user_favorites_count > 0)
                    <div class="request1 star" data-id="{{$job->id}}">
                        <i class="fas fa-star"></i>
                    </div>
                @else
                    <div class="request1 class" data-id="{{$job->id}}">
                        <i class="far fa-star"></i>
                    </div>
                @endif
            @endif

        </div>
    </div>


@endforeach

<script type="text/javascript">
    let ready = false
    $(document).ready(function () {

        $('.request1').click(function () {
            var self = this;
            $.ajax({
                type: "GET",
                url: "/favoritejob",
                data: {'job_id': $(this).data('id')},
                success: function (data) {
                    if (data['action'] == 'created') {
                        $(self).find('i.fa-star').attr('class', 'fas fa-star');
                    } else {
                        $(self).find('i.fa-star').attr('class', 'far fa-star');
                    }
                }
            })

        })
    })


</script>

</body>
</html>
