import React from 'react';
import Image from "next/image";
import Button from '../../components/Button';
import GoogleReviews from '../../components/GoogleReviews';
import QualityGuaranteed from '../../components/QualityGuaranteed';
import SampleProductSlider from '../../components/SampleProductSlider';

export default function EmbroideryDigitizing() {


  const spslides: Slide[] = [
  { type: 'text', content: "We don’t just talk the talk, we walk the walk. Check out some of our previous Embroidery Digitizing works for our happy clients." },
  { type: 'image', src: '/embroidery_digitizing/sw_img1.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img2.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img3.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img4.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img5.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img1.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img2.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img3.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img4.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img5.jpg', alt: 'Slide 1' },
  { type: 'image', src: '/embroidery_digitizing/sw_img1.jpg', alt: 'Slide 1' },
];


  return (
    <div className="embroidery_digitizing_page">
    <div className="topbanner_area">
    <div className="container">
    <div className="topbanner">
      <Image
          className="dark:invert"
          src="/embroidery_digitizing/embroidery_digitizing_banner.jpg"
          alt="Artwork911 "
          width={1550}
          height={740}
          priority
        />
    </div>   
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

    <div className="embroidery_digitizing_section">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-5">
          <div className="ed_img">
          <Image
          className="dark:invert"
          src="/embroidery_digitizing/embroidery_digitizing.jpg"
          alt="Artwork911 "
          width={800}
          height={800}
          priority
        />
          </div>
          </div>
          <div className="col-sm-7">
            <div className="ed_content">
              <h2>Embroidery Digitizing</h2>
              <p>Today’s embroidery machines are computerized to swiftly and accurately apply various designs as a series of stitches using colored threads on your garment of choice. But how does the machine know the right color of thread to use or the correct pattern for the stitches to follow? That’s where embroidery digitizing comes in. </p>
              <p>This process is the key to providing an embroidery machine the right set of instructions to translate your designs into threads and stitches on a garment. Beyond considering the depth and texture factors of each design, we also optimize the digitized design to minimize thread changes, produce clean, crisp results </p>
              <Button text="Get quote" onClick="/" className="btn_alpha"/>
            </div>
            <div className="why_ed_content">
            <h2>Why Embroidery?</h2>
              <p>Nothing makes quite an impact as a professionally embroided design on custom–branded clothing. Combining the intricate details of stitching and the sophisticated finish of embroidery does wonders to establish an air of polished refinement.</p>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div className="sample_work_section darkcolor spslider">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-12">
         {/* <ul>
            <li className="sw_content">
              <h2>Sample Works</h2>
              We don’t just talk the talk, we walk the walk. Check out some of our previous Embroidery Digitizing works for our happy clients.
            </li>
            <li className="sws_img"><Image className="sw_img" src="/embroidery_digitizing/sw_img1.jpg" alt="sample_work " width={497} height={331} priority /></li>
            <li className="sws_img"><Image className="sw_img" src="/embroidery_digitizing/sw_img2.jpg" alt="sample_work " width={497} height={331} priority /></li>
            <li className="sws_img"><Image className="sw_img" src="/embroidery_digitizing/sw_img3.jpg" alt="sample_work " width={497} height={331} priority /></li>
            <li className="sws_img"><Image className="sw_img" src="/embroidery_digitizing/sw_img4.jpg" alt="sample_work " width={497} height={331} priority /></li>
            <li className="sws_img"><Image className="sw_img" src="/embroidery_digitizing/sw_img5.jpg" alt="sample_work " width={497} height={331} priority /></li>
          </ul>
*/}

           <SampleProductSlider  spslides={spslides} />

           <div className="sws_line">Line about trust in quality and delivery times?</div>

          </div>
        </div>
      </div>
    </div>

    <div className="pricing_section">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-12">
            <h2>Pricing</h2>
            <ul>
              <li>
              <h3>Small Designs</h3>
              <div className="prodesc">Small, simple designs requiring 4000 stitches or less. Perfect for monograms, small logos, or basic symbols</div>
              <div className="prodbtn"><a href="">Starts at $15<sup>*</sup></a></div>
            </li>
            <li>
              <h3>Left Chest / Hat</h3>
              <div className="prodesc">Ideal for custom-branded shirts, caps, hats, or other applications using designs that can fit inside a 6-inch-diameter circle.</div>
              <div className="prodbtn"><a href="">Starts at $25<sup>*</sup></a></div>
            </li>
            <li>
              <h3>Large Designs</h3>
              <div className="prodesc">For designs that measure more than 6 inches in diameter. Ideal for the back of jackets, monogrammed blankets, and other design applications for larger areas. </div>
              <div className="prodbtn"><a href="">Starts at $75<sup>*</sup></a></div>
            </li>
          </ul>
          <div className="sml_note">*NOTE: price is subject to change, depending on the complexity of the design</div>
          </div>
        </div>
      </div>
    </div>


    <div className="whychoose_section darkcolor">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-5">
          <div className="wc_img_title">
            <Image className="sw_img" src="/embroidery_digitizing/whychoose_idea.svg" alt="sample_work " width={137} height={211} priority />

            <h2>Why Choose 
Artwork911?</h2>
          </div>
          </div>
          <div className="col-sm-7">
            <div className="wc_content">
            <p>Artwork911 is a U.S.based company providing quality artwork digitization services. </p>

            <p>Our team comprises seasoned and talented design digitizers with extensive experience in the print, digital, and decorated apparel industries. Adapting a design for a different medium requires an eye for aesthetics and a deep understanding of how an embroidery machine works - which our digitizers have in spades. All our services also come with easily accessible customer service to assist you with your needs.</p></div>
          </div>
        </div>
      </div>
    </div>

    <div className="call_artwork_section">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-12">
           With Artwork911, you get excellent service AND high-quality digitized artwork in as little as 24 hours! Artwork emergency? Call Artwork911!
           <div className="call_btns">
           <Button text="Sign Me Up" onClick="/"  className="btn_dark"/>
            <Button text="Get quote" onClick="/" className="btn_alpha"/>
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