<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')

    <style>
        #search {
            display: none;
        }
    </style>
</head>



<body>
    <div class="Background">
        <div class="cont">

            @include('home.header')
            @if (session('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session('message') }}
                </div>
            @endif

            <section>
                <div class="contact-body">
                    <h2 class="contact-header">Contact</h2>

                    <form action="#" method="post" class="contact-form">
                        <input type="text" name="name" class="contact-name" placeholder="Name">
                        <input type="email" name="email" class="contact-email" placeholder="E-mail">
                        <textarea name="message" placeholder="Message"></textarea>
                        <button class="contact-btn">send message</button>
                    </form>
                </div>
            </section>

        </div>

        @include('home.footer')
    </div>
</body>

</html>
