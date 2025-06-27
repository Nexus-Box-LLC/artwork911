import React from 'react';
import Image from "next/image";
import Button from '../components/Button';
import Slider from '../components/Slider';

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
  <p>Having trouble seeing video? <a href="#">Watch on YouTube</a> ></p>
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

       
      </main>
      


  

  );


}
