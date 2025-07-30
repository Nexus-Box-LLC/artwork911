import React from 'react';
import Image from "next/image";
import Button from '../../components/Button';
import GoogleReviews from '../../components/GoogleReviews';
import QualityGuaranteed from '../../components/QualityGuaranteed';




export default function HowToGetHelp() {


  return (
    <div className="howtogethelp_page">
    <div className="topbanner_area">
    <div className="container">
    <div className="topbanner">
      <Image
          className="edbannerimg"
          src="/how-to-get-help/help_header.jpg"
          alt="Artwork911 "
          width={1550}
          height={740}
          priority
        />
    </div>   
  </div>
  <div className="floating_icon"><Image
          className="flotingiconimg"
          src="/home/slider/floating_icon.png"
          alt="Artwork911 "
          width={180}
          height={38}
          priority
        />
        </div>
    </div>

    <div className="wearehere_section">
      <div className="container">
        <div className="flex justify-between row">
        
          <div className="col-sm-12">
            <div className="wrhth_content">
              <h2>We’re Here To Help</h2>
              <p><strong>Hit a roadblock with your Artwork911 project and unsure of the next step/s to take? </strong></p>
              <p>We are dedicated to ensuring you have an amazing Artwork911 experience. If you have questions, concerns, or encounter any issues about your Artwork911 project/s, there are a number of ways you can get help.   </p>
     
            </div>
          
          </div>
        </div>
      </div>
    </div>


 <div className="helpingbox_section">
      <div className="container">
        <div className="flex justify-between row">
        
          <div className="col-sm-12">
            <ul className="helpingbox_container first_aid">
              <li className="helpingbox_text">
                <h2>First Aid: Artwork911 Knowledge Base</h2>
                <p>We want to make things as convenient as possible for you and we’ve created a knowledge base all about how Artwork911 works. We hope this collection of answers to frequently asked questions can help you find the answers you need right away. </p>
                <div className=""><a href="#">Take Me To The Knowledge Base  &gt;</a></div>
              </li>
              <li className="helpingbox_img">
                <Image className="help_img" src="/how-to-get-help/first_aid.jpg" alt="Artwork911 " width={600} height={754} priority />
              </li>
            </ul>
            <ul className="helpingbox_container priorityportal">
              <li className="helpingbox_icon">
                <Image className="help_img" src="/how-to-get-help/drawing_bulb.png" alt="Artwork911 " width={353} height={502} priority />
              </li>
              <li className="helpingbox_text ">
                <h2>Priority: Customer Help Portal</h2>
                <p>We do our best to process your orders as smoothly as possible, but there can be unforeseen issues that may cause a few hiccups along the way.</p> 

<p>If you didn’t find the answers you’re looking for in our knowledge base, you can get support from our customer service via the <b><a href="">Help Portal</a></b> located in your customer account. </p>
                <div className=""><a href="#">Open The Help Portal &gt;</a></div>
              </li>
            </ul>
          <ul className="helpingbox_container urgent">
              <li className="helpingbox_text">
                <h2>Urgent: Contact Us!</h2>
                <p>Contact Artwork911 customer service directly and we’ll make sure to address your concerns as soon as possible. </p>

<p>There are two ways you can get in touch with us:</p>

<p>Email us at <u><a href="">support@artwork911.com</a></u> </p>

<p>Chat with us through the chat button located in the [location] of the page</p>
                
              </li>
              <li className="helpingbox_img">
                <Image className="help_img" src="/how-to-get-help/urgent_contact.jpg" alt="Artwork911 " width={568} height={716} priority />
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>






<div className="our_reviews_section">
  <GoogleReviews />
</div>
<div className="quality_section">
  <QualityGuaranteed />
</div>
    </div>
  );
}