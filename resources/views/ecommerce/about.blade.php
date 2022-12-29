@extends('layouts.ecommerce')

@section('title')
<title>Jual Produk Kecantikan - Ecommerce</title>
@endsection




@section('content')
    <section class="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <div class="top center">;
            <h1>Tentang Kami</h1>
        </div>
    </section>
<!-- =====about===== -->
<section class="cat_product_area section_gap">
  <div class="container-fluid">
      <div class="row flex-row-reverse">
        <div class="container wow fadeInUp">
          <div class="row">
            @foreach ($abouts as $row)

            <div class="col-lg-4 col-md-8">

              <div class="col-lg-11 col-md-8">
                <div><br> </div>
                <div class="f_p_img">
                  <img src="/storage/abouts/{{$row->header}}" width="300px" height="250px">
                </div>
                @endforeach
              </div>

            </div>

            <div class="col-lg-6 col-md-8">
              <div>
                <br>
                <h3 style="font-family:'Times New Roman', Times, serif ;">{{$row->sideImage}}</h3>
              </div>
              <div>
                <p style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif ;">
                  {!! $row->content !!}
                </p>
              </div>

            </div>
            <h4>
            </h4>

          </div>
        </div>


      </div>
  </div>
</section>


<section id="contact">


    <!-- Uncomment below if you wan to use dynamic maps -->
    <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=2048&amp;height=380&amp;hl=en&amp;q=IZZAT STORE&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://mcpenation.com/">MCPE Nation</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:380px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:380px;}.gmap_iframe {height:380px!important;}</style></div>

    <div class="container mt-5">
        <div class="row justify-content-center">

            <div class="col-lg-3 col-md-4">

                <div class="info">
                    <div>
                        <i class="bi bi-geo-alt"></i>
                        <p>Jl. Cemp. 10 Jl. Raya Kranggan No.19, RT.008/RW.013, Jatisampurna, Kec. Jatisampurna
                            <br>
                            Kota Bekasi, Jawa Barat 17433</p>
                    </div>

                    <div>
                        <i class="bi bi-envelope"></i>
                        <p>admin@izzatstore.com</p>
                    </div>

                    <div>
                        <i class="bi bi-phone"></i>
                        <p>081285439993</p>
                    </div>
                </div>



            </div>

            <div class="col-lg-5 col-md-8">
                <div class="form">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                        </div>

                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Contact Section -->

<!--================End Category Product Area =================-->
@endsection
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=+6281285439993&text=Halo Saya Ingin Memesan Lansung Disini" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
<!--
  <section id="contact">
    <div class="container wow fadeInUp">
      <div class="section-header">
        <h3 class="section-title">Contact</h3>
        <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
      </div>
    </div>

    {{-- <div id="google-map" data-latitude="40.713732" data-longitude="-74.0092704"></div> --}}

    <div class="container wow fadeInUp">
      <div class="row justify-content-center">

        <div class="col-lg-3 col-md-4">

          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>Gedong Tengen,
                <br>Daerah Istimewa Yogyakarta</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>danyadhi4149@gmail.com</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>0831-6179-3990</p>
            </div>
          </div>

          <div class="social-links">
            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
          </div>

        </div>

        <div class="col-lg-5 col-md-8">
          <div class="form">
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>

      </div>

    </div>
  </section> -->
