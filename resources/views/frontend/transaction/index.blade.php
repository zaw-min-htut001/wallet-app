<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-5 mb-8">

        <div class="max-w-4xl lg:mx-auto sm:px-6 lg:px-8 mx-4">
            <div id="data-wrapper"
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg min-h-full p-5">
                @include('frontend.components.paginate')
            </div>

                  <!-- Data Loader -->
                  <div class="auto-load text-center m-5" style="display: none;">
                    <svg class="text-center" version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60" viewBox="0 0 100 100"
                        enable-background="new 0 0 0 0" xml:space="preserve">
                        <path fill="#000"
                            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                                from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                        </path>
                    </svg>
                </div>
        </div>
    </div>
</x-app-layout>


<script>
    var ENDPOINT = "{{ route('transaction.index') }}";
    var page = 1;

    /*------------------------------------------
    --------------------------------------------
    Call on Scroll
    --------------------------------------------
    --------------------------------------------*/
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
            page++;
            infinteLoadMore(page);
        }
    });

    /*------------------------------------------
    --------------------------------------------
    call infinteLoadMore()
    --------------------------------------------
    --------------------------------------------*/
    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function() {
                    $('.auto-load').show();
                }
            })
            .done(function(response) {
                if (response.html == '') {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }

                $('.auto-load').hide();
                $("#data-wrapper").append(response.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
