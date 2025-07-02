import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import '../styles/custom.css';
import '../styles/custom_media.css';
import { ReactNode } from 'react';
import Header from '@/components/Header';
import Footer from '@/components/Footer';

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata = {
  title: "Artwork911",
  description: "Embroidery Digitizing Service : Quality Custom Digitising Designs : Embroidery Patterns Digitization : Logo Digitizers",
};




export default function RootLayout({ children }: { children: ReactNode }) {
  return (
    <html lang="en">
      <body>
        <Header />
  
          {children}

        <Footer />
      </body>
    </html>
  );
}
