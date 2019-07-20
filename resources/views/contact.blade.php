@extends('layouts.app')
@section('content')
    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img d-flex align-items-center justify-content-center mb-5" style="background-image: url('images/bg-img/bg-3.jpg');">
        <div class="bradcumbContent">
            <h2>Contact us</h2>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->
    <!-- ##### Contact Area Start ##### -->
    <section class="contact-information-area">
        <div class="container">
            <div class="row">

                <!-- Single Contact Information -->
                <div class="col-12 col-lg-12">
                    <div class="single-contact-information mb-100">
                        <div class="section-text">
                            <h3>Magic Bandhan</h3>
                            <p>For any query fell free to contact us.</p>
                        </div>
                        <!-- Single Contact Information -->
                        <div class="contact-content d-flex">
                            <p>Address</p>
                            <p>www.magicbandhan.com</p>
                        </div>
                        <!-- Single Contact Information -->
                        <div class="contact-content d-flex">
                            <p>Phone</p>
                            <p>Coming Soon...</p>
                        </div>
                        <!-- Single Contact Information -->
                        <div class="contact-content d-flex">
                            <p>E-mail</p>
                            <p>magicbandhan@gmail.com </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Contact Area End ##### -->

    <!-- ##### Contact Form Area Start ##### -->
    <section class="contact-form-area mb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <div class="line-"></div>
                        <h2>Get in touch</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Contact Form -->
                    <form action="{{route('contact.storeQuery')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-lg-4">
                                <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn palatin-btn mt-50">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Contact Form Area End ##### -->

    <!-- ##### Google Maps ##### -->
    <div class="map-area mb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22236.40558254599!2d-118.25292394686001!3d34.057682914027104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2z4Kay4Ka4IOCmj-CmnuCnjeCmnOCnh-CmsuCnh-CmuCwg4KaV4KeN4Kav4Ka-4Kay4Ka_4Kar4KeL4Kaw4KeN4Kao4Ka_4Kav4Ka84Ka-LCDgpq7gpr7gprDgp43gppXgpr_gpqgg4Kav4KeB4KaV4KeN4Kak4Kaw4Ka-4Ka34KeN4Kaf4KeN4Kaw!5e0!3m2!1sbn!2sbd!4v1532328708137" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection