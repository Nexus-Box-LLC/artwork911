import Link from 'next/link';
import Image from "next/image";
export default function GoogleReviews() {
  return (
   <div>   <div className="container">
    <div className="flex justify-between row">
      <div className="col-sm-12">
        <h2>Our reviews?</h2>
      </div>
    </div>
  </div>
  <div className="google_reviews_section"><Image className="art_resc_img" src="/home/google_reviews.png" alt="about_solutions " width={2189} height={328} priority /></div>
</div>
  );
}