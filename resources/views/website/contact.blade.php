@extends('layouts.webmaster')

@section('content')

<!-- contact -->
<div class="contact-agile">
    <div class="faq">
        <h4 class="latest-text w3_latest_text">Contact Us</h4>
        <div class="container">
            <div class="col-md-6 mail-wthree">
                <div class="icon-w3">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                </div>
                <h3>Email</h3>
                <h4><a href="mailto:info@example.com">example1@mail.com</a></h4>
                <h4><a href="mailto:info@example.com">example2@mail.com</a></h4>
                <h4><a href="mailto:info@example.com">example3@mail.com</a></h4>
            </div>
            <div class="col-md-6 social-w3l">
                <div class="icon-w3">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </div>
                <h3>Social media</h3>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i><span class="text">Facebook</span></a></li>
                    <li class="twt"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i><span class="text">Twitter</span></a></li>
                    <li class="ggp"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i><span class="text">Google+</span></a></li>	
                </ul>
            </div>
            <div class="clearfix"></div>
            {!! Form::open(['method'=>'POST','action'=>'indexmoviepage@message']) !!}
            <input type="text" name="firstname" placeholder="FIRST NAME" required="">
                <input type="text" name="lastname" placeholder="LAST NAME" required="">
                <input type="text" name="email" placeholder="EMAIL" required="">
                <input type="text" name="subject" placeholder="SUBJECT" required="">
                <textarea  name="message" placeholder="YOUR MESSAGE" required=""></textarea>
                <input type="submit" value="SEND MESSAGE">
                {!! Form::close() !!}
            </div>
    </div>
</div>			
@endsection