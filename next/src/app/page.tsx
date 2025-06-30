import React from 'react';
import Image from "next/image";
import Button from '../components/Button';
import Slider from '../components/Slider';
import GoogleReviews from '../components/GoogleReviews';

export default function Home() {
  return (

<main>
<div className="main_slider lightcolor">
  <div className="width50 leftbx">
      <div className="maincontent">
          <h1>Artwork <br />
        Emergency? <br />
        Call Artwork911!</h1>
        <p>Artwork911 digitizes your artwork - and we do it fast! When you need your designs to be print, screen printing, or embroidery-ready, we deliver in as little as 24 hours…even if you don’t have any digital design files to begin with.</p>
        <div className="buttons">
        <Button text="Sign Me Up" onClick="/"  className="btn_dark"/>
        <Button text="Get quote" onClick="/" className="btn_alpha"/>
        </div>
        <div className="floating_icon"><Image
          className="dark:invert"
          src="/home/slider/floating_icon.png"
          alt="Artwork911 "
          width={180}
          height={38}
          priority
        />
        </div>
      </div>
  </div>
  <div className="width50 rightbx"><Slider /></div>
</div>
<div className="about_video_section">
  <div className="av_content">
    <h2>Headline<br />
about video
</h2>
    <p>A handcrafted, small-batch, artisinal pour-over version of the classic lorem ipsum generator, Hipster Ipsum will give your mocks that blue collar touch.</p>
  </div>
<div className="av_video">
  <video
        src="/home/video/mic_handcrafted.mp4" controls controlsList="nodownload" disablePictureInPicture width="1028" poster="/home/video/video_poster.png">
      </video>
  <p>Having trouble seeing video? <a href="#">Watch on YouTube</a> &nbsp;&gt;</p>
</div>
</div>



<div className="about_solution_section">
  <div className="container">
        <div className="flex justify-between row">
      <div className="col-sm-6">
    <div className="as_image">
<Image
          className="dark:invert"
          src="/home/solution/about_solutions.jpg"
          alt="about_solutions "
          width={633}
          height={992}
          priority
        />
  
</div>
</div>
  <div className="col-sm-6">
    <div className="as_content">
      <h2>Headline<br />about soultions</h2>
      <ul>
        <li>
          <h4>What’s Your Artwork Emergency?</h4>
          <p>It’s Artwork911 to the rescue when you’ve got to get your designs ready to go to the printers. We digitize your designs for your application requirements…FAST!</p>
        </li>
        <li>
          <h4>Artwork Digitization: Who Will You Call? </h4>
          <p>Trusted by customers, screen printers, and embroiderers across the country, Artwork911 delivers digitized artwork with speed, accuracy, and efficiency.</p>
        </li>
        <li>
          <h4>Hassle-Free Artwork Digitization</h4>
          <p>No need to stress about the format and/or quality. We work with what you’ve got - photos, low-resolution images, plus other digital formats are all welcome - and turn it into the design that fits your requirements.</p>
        </li>
      </ul>
    </div>
  </div>
</div>
</div>
</div>


<div className="artwork_rescue_section darkcolor">
  <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-6">
        <div className="art_resc_content">
          <h2>Artwork911<br /> To The<br /> Rescue</h2>
            <Image
          className="art_resc_img"
          src="/home/resque/resque_bg.png"
          alt="about_solutions "
          width={650}
          height={342}
          priority
        />
        </div>
      </div>
      <div className="col-sm-6">
        <div className="art_resc_content_details">
          <p><strong>Got an awesome design?</strong></p> 
<p><strong>Want to apply it to marketing collaterals or merchandise?</strong> </p>

<p>There’s a crucial step you need to take in order to ensure that your artwork translates properly onto the material. Artwork911 fills in that gap. We’re a <strong>U.S.-based company providing quality artwork digitization services for print, screen printing, and embroidery businesses</strong> as well as direct customers. </p>

<p>At Artwork911, we help bring those artwork emergency alert levels down. No need to hire your own artist or agency to digitize artworks for you - our team of seasoned and talented artists is on hand to help you with your requirements. Sign up with us for your own go-to provider for artwork digitization services. </p>


<p><a href="#">Secondary CTA button  &nbsp;&gt;</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
<div className="ourservices_section">
  <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-12">
        <h2>Our Services</h2>
        <div className="service_boxes">
          <div className="servicebox">
            <ul>
              <li>
                <div className="servicebox_content">
                  <h3>Embroidery Digitizing</h3>
                  <p>Want to have your designs embroidered? <br/>
                  We convert your images, logos, and other designs into the format an embroidery machine can translate into stitches and threads.  </p>
                  <p><a href="">Learn more  &nbsp;&gt;</a></p>
                </div>
                <div className="servicebox_img">
                  <Image
                    className="art_resc_img"
                    src="/home/blank/blank.png"
                    alt="about_solutions "
                    width={763}
                    height={420}
                    priority
                  />
                </div>
              </li>
              <li>
                <div className="servicebox_content">
                  <h3>Vector art</h3>
                  <p>Scale your designs to infinity and beyond - or at least fill up spaces with crisp and clearly defined artwork. We convert your designs into vector art that can give you the flexibility you need for various applications. </p>
                  <p><a href="">Learn more  &nbsp;&gt;</a></p>
                </div>
                <div className="servicebox_img">
                  <Image
                    className="art_resc_img"
                    src="/home/blank/blank.png"
                    alt="about_solutions "
                    width={763}
                    height={420}
                    priority
                  />
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div className="expert_artwork_services_section">
  <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-12">
       
   <h3>Expert Artwork Digitizers At Your Service</h3>
          <div className="easervicebox">
         
                <div className="easervicebox_content">
                  
                  <p>Artwork digitization is a quick and easy process when you have the Artwork911 team working with you. We’ve been around the block and know the industry like the back of our hands. Whether you’ve got an artwork emergency or simply need to get your designs ready for screen printing, embroidery, or other similar applications, the Artwork911 team has your back every step of the way!</p>
                </div>
                <div className="easervicebox_icons">
                 <ul>
                  <li>
                    <div className="eas_icon">
                      <Image className="art_resc_img" src="/home/icons/24hours.svg" alt="about_solutions " width={60} height={54} priority />
                    </div>
                    <p>24-hour turnaround for approval</p>
                  </li>
                  <li>
                    <div className="eas_icon">
                      <Image className="art_resc_img" src="/home/icons/accommodates.svg" alt="about_solutions " width={60} height={54} priority />
                    </div>
                    <p>Accommodates revisions</p>
                  </li>
                  <li>
                    <div className="eas_icon"><Image className="art_resc_img" src="/home/icons/fileformat.svg" alt="about_solutions " width={60} height={54} priority /></div>
                    <p>File format compliance as per requirement</p>
                  </li>
                </ul>
                </div>
 
     
        </div>
      </div>
    </div>
  </div>
</div>


<div className="our_reviews_section">
  <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-12">
        <h2>Our reviews?</h2>
      </div>
    </div>
  </div>
  <div className="google_reviews_section"><GoogleReviews /></div>
</div>
               
<div className="get_free_quote_section">
  <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-6">
        <div className="gfq_img"><Image className="art_resc_img" src="/home/blank/blank.png" alt="about_solutions " width={634} height={428} priority /></div>
      </div>
      <div className="col-sm-6"> 
        <div className="gfq_content">
        <h2>Get A Free Quote Today!</h2>
        <ul>
          <li>
            <p><strong>Don’t have a digital file on hand?</strong></p>
            <p>We’ll recreate the design for you!</p>
          </li>
            <li>
            <p><strong>Changing your color palette?</strong></p>
            <p>We’re happy to mix things up!</p>
          </li>
            <li>
            <p><strong>Converting designs for embroidery?</strong></p>
            <p>We work with accuracy!</p>
          </li>
            <li>
            <p><strong>Vectorizing your design elements?</strong></p>
            <p>That’s right up our alley!</p>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </div>
</div>
   
<div className="pricing_section">
  <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-12">
        <p>From simple to complex designs, our drawing boards are always open to accommodate your projects. While not all tasks are created and cost equal, we maintain the same high quality in all our outputs. Get in touch with us today for a free quote on your artwork digitization requirements. </p>
        <h4>Rates start at $25</h4>
       <p>*IMPORTANT NOTE: We do not create entirely new designs. We provide digitizing and enhancement services for existing artwork.</p>
      </div>
    </div>
  </div>
</div>

<div className="quality_section">
  <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-12">
        <h2>Quality. Guaranteed.</h2>
        <p>Different machines, different design adjustments. We understand it’s all part of the process and we’ll happily work with you to address them. If you’re still not satisfied, please contact us within 14 days for a full refund to be credited to your account.</p>
      </div>
    </div>
  </div>
</div>


      </main>
      


  

  );


}
