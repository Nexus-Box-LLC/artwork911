// components/Navbar.js
"use client";
import Link from 'next/link';
import { useState } from "react";


export default function Navbar() {

const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

const navLinks = [
  { href: '/', label: 'Home' },
  { href: '/embroidery_digitizing', label: 'Embroidery Digitizing' },
  { href: '/art_services', label: 'Art Services' },
  { href: '/contact_us', label: 'Contact Us' },
  { href: '/register', label: 'Register' },
];

  return (
    <nav className="navbar">
       <div className="nav-links">
        <button
          className="lg:hidden"
          onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
          aria-label="Toggle menu"
        >
          <svg className="w-8 h-8" fill="none" stroke="currentColor" strokeWidth={2} viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        <ul className="hidden lg:flex space-x-8 items-center">
        {navLinks.map((link) => (
          <li key={link.label}>
            <Link key={link.href} href={link.href}>
            {link.label}
          </Link>
          </li>
        ))}
        </ul>



        <div
          className={`fixed top-0 left-0 h-full w-64 bg-slate-100 shadow-lg mobilemenu transform transition-transform duration-300 ease-in-out z-40 lg:hidden ${
            isMobileMenuOpen ? "translate-x-0" : "-translate-x-full"
          }`}
        >
          <div className="flex items-center justify-between p-4 border-b">
            
            <button onClick={() => setIsMobileMenuOpen(false)}>
              <svg className="w-8 h-8 text-slate-600 hover:text-red-500" fill="none" stroke="currentColor" strokeWidth={2} viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <ul className="flex flex-col gap-4 p-4">
            {navLinks.map((link) => (
              <li key={link.label}>
                <Link
                  href={link.href}
                  className="text-lg text-slate-600 hover:text-red-500"
                  onClick={() => setIsMobileMenuOpen(false)}
                >
                  {link.label}
                </Link>
              </li>
            ))}
            
          </ul>
        </div>


        {isMobileMenuOpen && (
          <div
            className="fixed menuoverlaybg inset-0 bg-black bg-opacity-30 z-30 lg:hidden"
            onClick={() => setIsMobileMenuOpen(false)}
          />
        )}



      </div>
    </nav>
  );
}