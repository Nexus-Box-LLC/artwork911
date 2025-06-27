// components/Navbar.js
import Link from 'next/link';

const navLinks = [
  { href: '/', label: 'Home' },
  { href: '/embroidery_digitizing', label: 'Embroidery Digitizing' },
  { href: '/art_services', label: 'Art Services' },
  { href: '/contact_us', label: 'Contact Us' },
  { href: '/register', label: 'Register' },
];

export default function Navbar() {
  return (
    <nav className="navbar">
       <div className="nav-links">
        {navLinks.map((link) => (
          <Link key={link.href} href={link.href}>
            {link.label}
          </Link>
        ))}
      </div>
    </nav>
  );
}