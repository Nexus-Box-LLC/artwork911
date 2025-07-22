import Link from 'next/link';
import Image from "next/image";
import SocialLinks from '../components/SocialLinks';
import FooterNav from '../components/FooterNav';
export default function Footer() {
  return (



    <footer>
      <div className="darkcolor">
      <div className="container">
        <div className="flex justify-between row">
        <div className="col-sm-8">
        <Image
              className="footerlogoimg"
              src="/logo_footer.svg"
              alt="Vercel logomark"
              width={245}
              height={97}
            />
            <div className="foot_contact">
              <h6>Adress</h6>
              <ul>
                <li>14/05 Light City.<br />
United States</li>
                <li>
                  <a href="#">info@email.com</a>
                  <a href="#">+00 (000) 000 00 00</a></li>
              </ul>
            </div>
         </div>   
         <div className="col-sm-4">
       <SocialLinks />
       <FooterNav />
       </div>
       </div>
       <div className="flex justify-between row foot_copy">
          <div className="col-sm-8"><div className="footcontact"><a href="#">Contact Us</a></div></div>
          <div className="col-sm-4"><div className="copyright">©2025 ArtWork . All rights reserved.</div></div>
       
       </div>
       </div>
     </div>
    </footer>
  );
}