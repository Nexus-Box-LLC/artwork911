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


<div className="lightcolor">asdwaewq</div>
        <Image
          className="dark:invert"
          src="/next.svg"
          alt="Next.js logo"
          width={180}
          height={38}
          priority
        />
       <Button text="Click me!" onClick="/" />
      </main>
      


  

  );


}
