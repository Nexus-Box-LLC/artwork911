import React from 'react';
import Image from "next/image";
import Button from '../../components/Button';
import GoogleReviews from '../../components/GoogleReviews';
import QualityGuaranteed from '../../components/QualityGuaranteed';
import SampleProductSliderRows from '../../components/SampleProductSliderRows';


interface Slide {
  type: 'stacked' | 'tall' | 'mixit';
  images: string[];
  content?: string;
}


export default function ArtServices() {

const slides: Slide[] = [
{ type: 'stacked', images: ['/vector_art/as_sw1.jpg', '/vector_art/as_sw2.jpg'] },
{ type: 'tall', images: ['/vector_art/as_sw3.jpg'] },
{ type: 'mixit', images: ['/vector_art/as_sw4.jpg'],content:'We don’t just talk the talk, we walk the walk. Check out some of our previous Embroidery Digitizing works for our happy clients.' },


{ type: 'stacked', images: ['/vector_art/as_sw1.jpg', '/vector_art/as_sw2.jpg'] },
{ type: 'tall', images: ['/vector_art/as_sw3.jpg'] },
{ type: 'stacked', images: ['/vector_art/as_sw4.jpg', '/vector_art/as_sw1.jpg'] },
{ type: 'stacked', images: ['/vector_art/as_sw1.jpg', '/vector_art/as_sw2.jpg'] },
{ type: 'tall', images: ['/vector_art/as_sw3.jpg'] },
{ type: 'stacked', images: ['/vector_art/as_sw4.jpg', '/vector_art/as_sw1.jpg'] },
];

  return (
    <div className="art_services_page">
    <div className="topbanner_area">
    <div className="container">
       <div className="flex justify-between row">
      <div className="col-sm-6">
        <div className="top_banner_content">
          <h1>Vector Art</h1>
          <p>One file format - endless applications. Say goodbye to problems with pixelated images when scaled beyond their limits. With vector art, you can scale your designs indefinitely without losing quality. We recreate your existing designs - whether image or artwork - into high-quality vector line art to give you the flexibility you need for various design applications.</p>
        </div>

        <div className="tb_outputfiles">
          <p>File Outputs:</p>
          <ul>
            <li>
              <div className="file_cons">
                <Image className="file_cons_img" src="/vector_art/icon_files_eps.png" alt="Artwork911 " width={50} height={50} priority />
              </div> Encapsulated PostScript (.eps) 
            </li>
            <li>
              <div className="file_cons">
                <Image className="file_cons_img" src="/vector_art/icon_files_ai.png" alt="Artwork911 " width={50} height={50} priority />
              </div> Adobe Illustrator (.ai) 
            </li>
            <li>
              <div className="file_cons">
                <Image className="file_cons_img" src="/vector_art/icon_files_svg.png" alt="Artwork911 " width={50} height={50} priority />
              </div> Scalable Vector Graphic (.svg) 
            </li>
            <li>
              <div className="file_cons">
                <Image className="file_cons_img" src="/vector_art/icon_files_psd.png" alt="Artwork911 " width={50} height={50} priority />
              </div> Photoshop Document (.psd) 
            </li>
            <li>
              <div className="file_cons">
                <Image className="file_cons_img" src="/vector_art/icon_files_cdr.png" alt="Artwork911 " width={50} height={50} priority />
              </div> Corel Draw (.cdr) 
            </li>
            <li>
              <div className="file_cons">
                <Image className="file_cons_img" src="/vector_art/icon_files_others.png" alt="Artwork911 " width={50} height={50} priority />
              </div> Other files formats available upon request
            </li>
          </ul>
        </div>
      </div>
      <div className="col-sm-6">
    <div className="topbanner">
      <Image
          className="vectorartheaderimg"
          src="/vector_art/vector_art_header.jpg"
          alt="Artwork911 "
          width={763}
          height={1019}
          priority
        />
    </div>
    </div>   
  </div>
    </div>
    </div>

    <div className="embroidery_digitizing_section whygo_floating">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-6">
            <div className="whygo">
               <div className="floating_icon"><Image
                  className="whygo_icon"
                  src="/home/slider/floating_icon.png"
                  alt="Artwork911 "
                  width={180}
                  height={38}
                  priority
                />
                </div>
              <h2>Why Go Vector? </h2>

               </div>
          </div>
          <div className="col-sm-6">
            <div className="ed_content">
            
              <p>Imagine your logo looking amazing on a tiny calling card. What if you can use the exact same file of your logo to print it on the entire backside of a T-shirt - or even a whole ginormous billboard? All these are entirely possible when your logo is created as vector art.</p>
              <div className="whygo_btn"><Button text="Get quote" onClick="/" className="btn_alpha"/></div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
    <div className="sample_work_section darkcolor awsample">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-12">
       

            <SampleProductSliderRows spslides={slides} />
          <div className="sws_line">Line about trust in quality and delivery times?</div>

          </div>
        </div>
      </div>
    </div>

    <div className="pricing_section">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-12">
            <h2 className="pricon">Pricing</h2>
            <ul>
              <li>
              <h3>Simple</h3>
              <div className="prodesc">Straightforward line art with basic texture and coloring scheme - no halftones or shading. </div>
              <div className="prodbtn"><a href="#">Starts at $25<sup>*</sup></a></div>
            </li>
            <li>
              <h3>Complex</h3>
              <div className="prodesc">More detailed line art that is rendered with multiple effects such as halftones and shading to achieve more complex textures. </div>
              <div className="prodbtn"><a href="#">Starts at $75<sup>*</sup></a></div>
            </li>
            <li>
              <h3>Extra Complex </h3>
              <div className="prodesc">Intricate line art with elaborate details, shading, textures, and other embellishments. Quoted on a per project basis. </div>
              <div className="prodbtn"><a href="#">Get a quote<sup>*</sup></a></div>
            </li>
          </ul>
          <div className="sml_note">*NOTE: price may vary, depending on the complexity of the design. Request a free quote to get the exact pricing. </div>
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