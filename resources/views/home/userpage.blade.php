<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')

    <style>
        #search{
            display: none;
        }
    </style>
</head>



<body>
    @include('sweetalert::alert')

    <div class="Background">
        <div class="cont">

            @include('home.header')

            <section>
                <div class="home-body">

                    @include('home.poster')
                    <br>

                    @include('home.product')

                    @include('home.different')

                    @include('home.email')

                </div>
            </section>

        </div>

        @include('home.footer')
    </div>
</body>

</html>
