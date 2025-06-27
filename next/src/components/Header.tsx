import Link from 'next/link';
import Image from "next/image";
import Button from '../components/Button';
import TopButton from '../components/TopButton';
import Navbar from '../components/Navbar';

export default function Header() {
  return (
    <header>
      <div className="container">
        <div className="flex justify-between row">
        <div className="col-sm-4">
        <Image
              className="dark:invert"
              src="/logo.svg"
              alt="Vercel logomark"
              width={245}
              height={97}
            />
            </div>
            <div className="col-sm-8 flex">
            <Navbar />
       
        <TopButton text="Log in" onClick="/" />
        </div>
        </div>
      </div>
    </header>
  );
}