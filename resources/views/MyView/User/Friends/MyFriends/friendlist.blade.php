@extends('layouts.site_layout.master')

@section('page_css')

@endsection


@section('content')

    {{-- Request List --}}
    <h4 style="font-weight: 100; margin-top: 20px;">My Friends</h4>
    <div class="row mt-3" id="friendslist_space"></div>

@endsection

@section('page_script')


    <script>

        getRequestlist();

        setInterval(getRequestlist, 5000);

        function cancelFollow(user_id) {
            $.ajax({
                type: 'POST',
                url: "{!! route('friend.unfollow') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'user_id': user_id,
                },
                success: function (data) {

                    getRequestlist();

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Follow Request Rejected.',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            });
        }

        {{--function acceptFollow(user_id) {--}}
            {{--$.ajax({--}}
                {{--type: 'POST',--}}
                {{--url: "{!! route('new.request.accept') !!}",--}}
                {{--cache: false,--}}
                {{--data: {--}}
                    {{--_token: "{{csrf_token()}}",--}}
                    {{--'user_id': user_id,--}}
                {{--},--}}
                {{--success: function (data) {--}}

                    {{--getRequestlist();--}}

                    {{--Swal.fire({--}}
                        {{--position: 'top-end',--}}
                        {{--type: 'success',--}}
                        {{--title: 'Follow Request Accepted.',--}}
                        {{--showConfirmButton: false,--}}
                        {{--timer: 2000--}}
                    {{--})--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

        // GET USELIST AJAX
        function getRequestlist(){
            $.ajax({
                type: 'POST',
                url: "{!! route('friends.list.get') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                },
                success: function (data) {
                    $('#friendslist_space').html(data);
                }
            });
        }


    </script>
@endsection