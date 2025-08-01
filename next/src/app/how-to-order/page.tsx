import React from 'react';
import Image from "next/image";
import Button from '../../components/Button';
import GoogleReviews from '../../components/GoogleReviews';
import QualityGuaranteed from '../../components/QualityGuaranteed';




export default function HowToOrder() {


  return (
    <div className="howtoorder_page">
    <div className="topbanner_area">
    <div className="container">
    <div className="topbanner">
      <Image
          className="edbannerimg"
          src="/how-to-order/how_to_oreder_header.jpg"
          alt="Artwork911 "
          width={1550}
          height={740}
          priority
        />
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
    </div>

    <div className="hto_section">
      <div className="container">
        <div className="flex justify-between row">
        
          <div className="col-sm-12">
            <div className="hto_content">
              <h2>How To Order?</h2>
              <p>Whether you need to get your artwork emergencies under control stay on 
top of your artwork digitization needs, all you need to do is place an order 
and you know we’ve got your back for all your artwork digitization emergencies and/or requirements. </p>
              
     
            </div>
          
          </div>
        </div>
      </div>
    </div>


 <div className="lets_started_section">
      <div className="container">
        <div className="flex justify-between row">
        
          <div className="col-sm-12">
           
           <div className="lets_started_head"><h2>Let’s get you started, shall we? </h2></div>
        
          </div>
 </div>
<div className="flex justify-between row lets_started_content">
          <div className="col-sm-6 lets_started_left">
            <div className="cana_box">
              <div className="cana_head">
                <div className="cana_icon"><Image className="cana_icon_img" src="/how-to-order/icon_create.png" alt="Artwork911 " width={62} height={66} priority /></div>
                <h2>Create A New Account:</h2>
              </div>
              <div className="cana_content">
                <ul>
                  <li><p>New customer? <br/>You need to register for an Artwork911<br/>account to begin.</p></li>
                  <li><p>Here’s how:</p></li>
                  <li><p>Simply click on Register in the<br/>Artwork911 website menu.</p></li>
                  <li><p>Or access the registration form directly via this link: <br/>https://artwork911.com/user-register </p></li>
                  <li><p>Fill out the form and wait for our <br/>email with your account details.</p></li>
                  <li><p>Important:<br/><span>Please use a valid email address when registering. This will be used to send you instructions to finish setting up your account and updates on your ongoing projects.</span></p></li>
                </ul>  
              </div>
            </div>
            <div className="cana_section_img_box">
              <Image className="cana_section_box_img" src="/how-to-order/cana_section_box_img.jpg" alt="Artwork911 " width={769} height={1045} priority />
            </div>
            <div className="cana_section_note_box">
              <div className="cana_note_icon"><Image className="cana__note_icon_img" src="/how-to-order/astric_icon.png" alt="Artwork911 " width={61} height={66} priority /></div>
              <p>NOTE: Not all artwork digitization projects are created equal. Cost will depend on size and complexity of the design. To get a free quote for your project, please head on over tp [link] and submit details of your project for assessment. </p>
            </div>
          </div>
          <div className="col-sm-6 lets_started_right">
            <div className="customer_portal_box">
              <h2>Customer Portal</h2>
              <div className="csp_text">
                <p>Once you have your Artwork911 account set up, you can begin placing orders via your Artwork911 customer portal. </p>
              </div>
              <ul className="csp_list">
                <li>
                  <div className="csp_list_icon"><Image className="csp_list_img" src="/how-to-order/icon_cart_check.png" alt="Artwork911 " width={63} height={67} priority /></div>
                  <div className="csp_list_text">Log in to your Artwork911 account. </div>
                </li>
                <li>
                  <div className="csp_list_icon"><Image className="csp_list_img" src="/how-to-order/icon_folder.png" alt="Artwork911 " width={63} height={67} priority /></div>
                  <div className="csp_list_text">In the orders section, upload the file or photo 
of the artwork to be digitized. </div>
                </li>
                <li>
                  <div className="csp_list_icon"><Image className="csp_list_img" src="/how-to-order/icon_file_format.png" alt="Artwork911 " width={63} height={67} priority /></div>
                  <div className="csp_list_text">Specify the file format of the output you need.</div>
                </li>
                <li>
                  <div className="csp_list_icon"><Image className="csp_list_img" src="/how-to-order/icon_art_approve.png" alt="Artwork911 " width={63} height={67} priority /></div>
                  <div className="csp_list_text">Your artwork will be ready for approval within 24 hours.</div>
                </li>
                <li>
                  <div className="csp_list_icon"><Image className="csp_list_img" src="/how-to-order/icon_art_download.png" alt="Artwork911 " width={63} height={67} priority /></div>
                  <div className="csp_list_text">Download yours high quality vector or embroidery files, and create something special!</div>
                </li>

              </ul>
            </div>

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