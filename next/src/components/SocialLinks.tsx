import { FaFacebook,  FaYoutube, FaInstagram } from 'react-icons/fa';
import {  FaTwitter, FaBasketball  } from 'react-icons/fa6';
const socialLinks = [
  {
    name: 'Facebook',
    url: '#',
    icon: FaFacebook,
    color: '#ffffff',
  },
  {
    name: 'Twitter',
    url: '#',
    icon: FaTwitter ,
    color: '#ffffff',
  },
  {
    name: 'YouTube',
    url: '#',
    icon: FaYoutube,
    color: '#ffffff',
  },
  {
    name: 'Instagram',
    url: '#',
    icon: FaInstagram,
    color: '#ffffff',
  },
  {
    name: 'Web',
    url: '#',
    icon: FaBasketball ,
    color: '#ffffff',
  },
];

export default function SocialLinks() {
  return (


      <div style={{ display: 'flex', gap: '16px' }} className="social_icons">
      {socialLinks.map(({ name, url, icon: Icon, color }) => (
        <a
          key={name}
          href={url}
          target="_blank"
          rel="noopener noreferrer"
          title={name}
        >
          <Icon size={32} color={color} />
        </a>
      ))}
    </div>

  );
}