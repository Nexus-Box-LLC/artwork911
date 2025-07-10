// components/FooterNav.tsx
import Link from 'next/link';

const footnavLinks = [
  { href: '/', label: 'Home' },
  { href: '/embroidery-digitizing', label: 'Embroidery Digitizing' },
  { href: '/art-services', label: 'Art Services' },
  { href: '/faq', label: 'FAQ' },
  { href: '/terms-of-use', label: 'Terms of Use' },
  { href: '/privacy-policy', label: 'Privacy policy' },
];

export default function Navbar() {
  return (
    <nav className="footernavbar">
      <h6>Links</h6>
       <div className="nav-links">
        {footnavLinks.map((link) => (
          <Link key={link.href} href={link.href}>
            {link.label}
          </Link>
        ))}
      </div>
    </nav>
  );
}