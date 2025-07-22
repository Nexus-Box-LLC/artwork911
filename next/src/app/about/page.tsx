import React from 'react';
import Image from "next/image";
import Button from '../../components/Button';
import GoogleReviews from '../../components/GoogleReviews';
import QualityGuaranteed from '../../components/QualityGuaranteed';
import ContentSlider from '../../components/ContentSlider';

type Slide = {
  title: string;
  content: string;
};

export default function AboutPage() {



  const contentslides: Slide[] = [
  { title: "Slide 1", content: "With Artwork911, there’s no need to hire your own artist or agency to digitize artworks for you - our team of seasoned and talented artists is on hand to help you with your requirements. " },
  { title: "Slide 2", content: "With Artwork911, there’s no need to hire your own artist or agency to digitize artworks for you - our team of seasoned and talented artists is on hand to help you with your requirements. " },
  { title: "Slide 3", content: "With Artwork911, there’s no need to hire your own artist or agency to digitize artworks for you - our team of seasoned and talented artists is on hand to help you with your requirements. " },
];
  return (
    <div className="about_page">

      <div className="topbanner_area">
        <div className="container">
          <div className="flex justify-between row">
            <div className="col-sm-5">
              <div className="topbanner">
                <Image
                    className="artworkemergencyimg"
                    src="/about/artwork_emergency.jpg"
                    alt="Artwork911 "
                    width={691}
                    height={856}
                    priority
                  />
              </div>
            </div> 
            <div className="col-sm-7">
              <div className="about_top_content">
                <h1>Artwork Emergency? <br />
                  Call on <span>Artwork911!</span></h1>
                <p>When you’ve got an awesome design and want to apply it to marketing collaterals, and custom-branded garments or merchandise, who will you call?</p>

                <p>Artwork911 is a U.S.based company providing quality artwork digitization services for print, screen printing, and embroidery businesses as well as direct customers. Our 24-hour turnaround for approval could be just what you need to bring those artwork emergency alert levels down.
                </p>
              </div>        
            </div>          
            </div>
          </div>
        </div>

        <div className="content_slider_area lightcolor">
          <div className="container">
             <div className="content_slider_box darkcolor">
                <ContentSlider contentslides={contentslides} />
             </div>
          </div>
        </div>

        <div className="service_featured_section">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-5">
          <div className="ed_img">
          <Image
          className="servicefeaturedsectionimg"
          src="/about/service_featured.jpg"
          alt="Artwork911 "
          width={502}
          height={774}
          priority
        />
          </div>
          </div>
          <div className="col-sm-7">
           <div className="service_featured">
            <ul>
              <li>With Artwork911, you get excellent service AND high-quality digitized artwork in as little as 24 hours! 
              <Image className="24_hours" src="/about/icon_24.png" alt="Artwork911 24 Hours " width={108} height={106} priority /></li>
              <li><Image className="artwork_digitization" src="/about/icon_pen.png" alt="Artwork911 24 Hours " width={107} height={102} priority /> Sign up with us for your own go-to provider for artwork digitization services. </li>
              <li><Image className="call_on" src="/about/call_on.png" alt="Call on Artwork911!" width={85} height={130} priority />Artwork emergency? <br/>Call on Artwork911!</li>
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