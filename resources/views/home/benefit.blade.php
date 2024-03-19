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

            <section>
                <div class="health-body">
                    <div class="health-img">
                        <h2 class="health-slide-text">Experience Better Health with Standing Desks</h2>
                        <p class="health-slide-stext">Discover the Transformative Benefits of Ergonomic Work Solutions</p>
                        <a href="javascript::void(0)" class="health-slide-btn">Explore Benefits</a>
                    </div>

                    <div class="health-text-gp">
                        <div class="health-header">Health Benefits of Standing Desks</div>
                        <ul class="health-list">
                            <li class="health-list-item"><i class="fa-solid fa-circle"></i>
                                <div>Standing desks can help decrease the risk of obesity by promoting movement and
                                    increasing calorie expenditure compared to sitting for extended periods. Standing
                                    engages more muscles and burns more calories than sitting, contributing to weight
                                    management and metabolic health.</div>
                            </li>
                            <li class="health-list-item"><i class="fa-solid fa-circle"></i>
                                <div>Standing desks encourage better posture by engaging core muscles and aligning the spine
                                    more naturally. Many individuals experience relief from chronic back pain and discomfort
                                    associated with prolonged sitting by using standing desks, as standing helps alleviate
                                    pressure on the lower back.</div>
                            </li>
                            <li class="health-list-item"><i class="fa-solid fa-circle"></i>
                                <div>Studies suggest that alternating between sitting and standing throughout the day can
                                    improve blood sugar levels and insulin sensitivity. Standing after meals, for example,
                                    can help regulate blood glucose levels more effectively than prolonged sitting, reducing
                                    the risk of type 2 diabetes and metabolic disorders.</div>
                            </li>
                            <li class="health-list-item"><i class="fa-solid fa-circle"></i>
                                <div>Standing desks can boost energy levels and productivity by promoting better circulation
                                    and reducing feelings of lethargy associated with sedentary behavior. Standing
                                    encourages greater alertness and engagement, leading to improved focus and cognitive
                                    function throughout the workday.</div>
                            </li>
                            <li class="health-list-item"><i class="fa-solid fa-circle"></i>
                                <div>Sedentary lifestyles are linked to an increased risk of cardiovascular disease,
                                    including heart attacks and strokes. Using a standing desk can help mitigate this risk
                                    by encouraging light activity and reducing prolonged periods of sitting, thereby
                                    improving heart health and circulation.</div>
                            </li>
                            <li class="health-list-item"><i class="fa-solid fa-circle"></i>
                                <div>Some research suggests that reducing sedentary time and incorporating more standing and
                                    movement into daily routines may increase lifespan. While standing desks alone may not
                                    guarantee longevity, they can be part of a broader approach to maintaining an active
                                    lifestyle and promoting overall health and well-being.</div>
                            </li>
                        </ul>
                    </div>

                    <div class="health-trust container">
                        <div class="health-trust-header">
                            <div class="trust-header-line"></div>
                            <div class="trust-header">Why you should turst us</div>
                        </div>
                        <div class="health-trust-img">
                            <img src="./images/AA180Ddr.jpg" alt="standing-dask-img">
                        </div>
                        <div class="health-turst-text">
                            <div class="trust-text-item">We’ve been covering height-adjustable standing desks since 2013,
                                when we conducted the first head-to-head standing-desks test. Across four authors (and
                                multiple testing panels), we’ve reviewed and tested more than 40 standing desks.</div>
                            <div class="trust-text-item">Kaitlyn Wells is a senior staff writer covering the intersection of
                                home office, productivity, and technology. She’s been working from home in some capacity for
                                over a decade and understands the value of a great home-office setup.</div>
                            <div class="trust-text-item">This guide builds on extensive work by Wirecutter’s Melanie Pinola,
                                who has also written about working from home for sites such as Lifehacker, PCWorld, and
                                Laptop Mag.</div>
                        </div>
                    </div>



                    <div class="health-vdo">
                        <iframe src="https://www.youtube.com/embed/p4OeVn6QIcc?si=ioSGPgHy2Ex0bTTf"
                            title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>


                </div>
            </section>

        </div>

        @include('home.footer')
    </div>
</body>

</html>
