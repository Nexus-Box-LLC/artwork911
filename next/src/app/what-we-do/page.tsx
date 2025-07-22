import React from 'react';
import Image from "next/image";
import Button from '../../components/Button';
import GoogleReviews from '../../components/GoogleReviews';
import QualityGuaranteed from '../../components/QualityGuaranteed';


type Feature = {
  icon: string;
  text: string;
};

export default function WhatWeDoPage() {


const features: Feature[] = [
  {
    icon: "/what_we_do/wcpli1.png",
    text: "Customizable customer portal you can white label for your business",
  },
  {
    icon: "/what_we_do/wcpli2.png",
    text: "Accommodates minor enhancements to existing designs",
  },
  {
    icon: "/what_we_do/wcpli3.png",
    text: "Extensive experience in the print and decorated apparel industries.",
  },
  {
    icon: "/what_we_do/wcpli4.png",
    text: "Excellent creative and technical skills of our team",
  },
  {
    icon: "/what_we_do/wcpli5.png",
    text: "Convenient communications and timely support from highly responsive customer service",
  },
  {
    icon: "/what_we_do/wcpli6.png",
    text: "24-hour turnaround for approval",
  },
  {
    icon: "/what_we_do/wcpli7.png",
    text: "Integrates customer comments to the recreated artwork to improve accuracy in execution",
  },
  {
    icon: "/what_we_do/wcpli8.png",
    text: "Quality guaranteed – or your money back!",
  },
  {
    icon: "/what_we_do/wcpli9.png",
    text: "File format compliance as per requirement",
  },
];

 const columns: Feature[][] = [[], [], []];
  features.forEach((feature, i) => {
    columns[i % 3].push(feature);
  });

  return (
    <div className="whatwedo_page">

      <div className="topbanner_area">
        <div className="container">
          <div className="flex justify-between row">
            <div className="col-sm-6">
              <div className="topbanner">
                <Image
                    className="wwdbannerimg"
                    src="/what_we_do/wwd_banner.jpg"
                    alt="Artwork911 "
                    width={793}
                    height={913}
                    priority
                  />
              </div>
            </div> 
            <div className="col-sm-6">
              <div className="wwd_top_content">
                <h1>What We Do In Artwork911</h1>
                <p>Artwork911 provides digitization services for businesses and individual customers alike. We turn your designs into high-quality vector art or machine-ready formats for embroidery. </p>

<p>We understand that not everyone will have a digital file of their designs. Whether you have existing file formats of your designs, jpeg images of your artworks, or even just an old calling card or a photo of your logo or the design you want to use, we can recreate them as digital artwork in the format you need for your various application requirements. </p>

<p>Think of us as your art department on call. We may not be in your office, but we’re just one customer portal away. You can count on us to work on your artwork digitization requirements ASAP.</p>
<div className="buttons">
        <Button text="Sign Me Up" onClick="/"  className="btn_white"/>
        <Button text="Get quote" onClick="/" className="btn_alpha_white"/>
        </div>

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
            </div>
        </div>

       

  <div className="wcp_section">
      <div className="container">
        <div className="flex justify-between row">
          <div className="col-sm-5">
            <h5>Art Digitizing </h5>
            <h2>The Artwork911 Way</h2>
          <div className="wcp_img">
          <Image
          className="aboutsolutionimg"
          src="/home/solution/about_solutions.jpg"
          alt="Artwork911 "
          width={800}
          height={800}
          priority
        />
          </div>
          </div>
          <div className="col-sm-7">
            <div className="wcp_content">
              
              <p>Artwork digitizing is the process of turning a design into a digital format that can be translated by machines into patterns of stitches and threads for embroidery or recognized by printers as colors of ink for vector art. These processes require a keen eye for detail, precision, and considerable technical knowledge and skill to achieve the most accurate rendition of your designs in the format needed.</p>
              <p>As a registered DBA of Nexus Box, LLC, Artwork911 offers customers the benefits of our nearly 20 years of extensive experience in the decorated apparel industry. The Artwork911 team also comprises seasoned and talented artists who are well-versed in the technical and creative skills required to render your designs into the print and apparel industry-recognized formats you need. </p>
              <p>We strictly do not create original artwork. However, we are open to accommodating minor enhancements to your existing designs. We do our best to execute artwork digitization projects with speed, precision, and attention to detail. All designs are submitted for approval and must be given explicit approval by the client before the order is closed.</p>
              
            </div>
            <div className="why_wcp_content">
            <h2>Why Choose Artwork911?</h2>
              <div className="why_wcp_bimage"></div>
          </div>
          </div>
        </div>
      </div>
    </div>



<div className="why_wcp_content_listing">
  <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-12">
        <div className="wcp_content_listing_area">

 {columns.map((col, colIdx) => (
        <ul key={colIdx} className="">
          {col.map((feature, idx) => (
            <li key={idx}>
              <div className="wcp_list_icon"><Image className="wcpli" src={feature.icon} alt="Why Choose Artwork911 " width={77} height={59} priority /></div>
              <h3>{feature.text}</h3>
            </li>
          ))}
        </ul>
      ))}

    </div>
      </div>
    </div>
  </div>
</div>



<div className="our_reviews_section">
  <GoogleReviews />
</div>
               
<div className="get_free_quote_section">
  <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-6">
        <div className="gfq_img"><Image className="art_resc_img" src="/home/solution/gfq.jpg" alt="about_solutions " width={634} height={428} priority /></div>
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
        <div className="pricing_section_content">
        <p>From simple to complex designs, our drawing boards are always open to accommodate your projects. While not all tasks are created and cost equal, we maintain the same high quality in all our outputs. Get in touch with us today for a free quote on your artwork digitization requirements. </p>
        <h4>Rates start at $25</h4>
       <p>*IMPORTANT NOTE: We do not create entirely new designs. We provide digitizing and enhancement services for existing artwork.</p>
      </div>
      </div>
    </div>
  </div>
</div>

<div className="quality_section">
  <QualityGuaranteed />
</div>




      </div>
  );
}