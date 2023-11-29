<html>
<header>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet/less" type="text/css" href="carousel.less" />
</header>

<body>
    <div class="row" style="height:300px">
        <div class="container">
            <h1>Use Bootstrap's carousel to show multiple items per slide.</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel slide multi-item-carousel" id="theCarousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-xs-2"><a href="#1"><img src="http://placehold.it/300/f44336/000000" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-2"><a href="#1"><img src="http://placehold.it/300/e91e63/000000" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-2"><a href="#1"><img src="http://placehold.it/300/9c27b0/000000" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-2"><a href="#1"><img src="http://placehold.it/300/673ab7/000000" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-2"><a href="#1"><img src="http://placehold.it/300/4caf50/000000" class="img-responsive"></a></div>
                            </div>
                            <div class="item">
                                <div class="col-xs-2"><a href="#1"><img src="http://placehold.it/300/8bc34a/000000" class="img-responsive"></a></div>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    // Instantiate the Bootstrap carousel
    $('.multi-item-carousel').carousel({
        interval: false
    });

    // for every slide in carousel, copy the next slide's item in the slide.
    // Do the same for the next, next item.
    $('.multi-item-carousel .item').each(function() {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        if (next.next().length > 0) {
            next.next().children(':first-child').clone().appendTo($(this));
        } else {
            $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
        }
    });
</script>

</html>