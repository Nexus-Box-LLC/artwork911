'use client';

import { useRef, useEffect, useState } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import Image from 'next/image';

type SlideItem = {
type: 'stacked' | 'tall'| 'mixit';
images: string[]; // array of image URLs
content?: string;
};

interface Props {
spslides: SlideItem[];
}

export default function SampleProductSliderRows({ spslides }: Props) {
const prevRef = useRef<HTMLButtonElement>(null);
const nextRef = useRef<HTMLButtonElement>(null);
const [isReady, setIsReady] = useState(false);
const [swiperInstance, setSwiperInstance] = useState<any>(null);

useEffect(() => {
setIsReady(true);
}, []);

useEffect(() => {
if (
isReady &&
swiperInstance &&
prevRef.current &&
nextRef.current &&
swiperInstance.params
) {
swiperInstance.params.navigation.prevEl = prevRef.current;
swiperInstance.params.navigation.nextEl = nextRef.current;

 swiperInstance.navigation.destroy();
  swiperInstance.navigation.init();
  swiperInstance.navigation.update();
}

}, [isReady, swiperInstance]);

return (
  <div className="relative sps">
<div className="swsr_container spsr_container">
{/* Navigation Buttons */}
<button ref={prevRef} className="absolute left-2 top-1/2 z-10 -translate-y-1/2" aria-label="Previous" >
<svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M35 28C35.5523 28 36 27.5523 36 27C36 26.4477 35.5523 26 35 26L35 28ZM18.7929 26.2929C18.4024 26.6834 18.4024 27.3166 18.7929 27.7071L25.1569 34.0711C25.5474 34.4616 26.1805 34.4616 26.5711 34.0711C26.9616 33.6805 26.9616 33.0474 26.5711 32.6569L20.9142 27L26.5711 21.3431C26.9616 20.9526 26.9616 20.3195 26.5711 19.9289C26.1805 19.5384 25.5474 19.5384 25.1569 19.9289L18.7929 26.2929ZM35 26L19.5 26L19.5 28L35 28L35 26Z" fill="#D1C9C9" />
<circle cx="27.5" cy="27.5" r="26.5" transform="rotate(-180 27.5 27.5)" stroke="#D1C9C9" strokeWidth="2" />
</svg>
</button>

<button
    ref={nextRef}
    className="absolute right-2 top-1/2 z-10 -translate-y-1/2"
    aria-label="Next"
  >
    <svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M20 27C19.4477 27 19 27.4477 19 28C19 28.5523 19.4477 29 20 29V27ZM36.2071 28.7071C36.5976 28.3166 36.5976 27.6834 36.2071 27.2929L29.8431 20.9289C29.4526 20.5384 28.8195 20.5384 28.4289 20.9289C28.0384 21.3195 28.0384 21.9526 28.4289 22.3431L34.0858 28L28.4289 33.6569C28.0384 34.0474 28.0384 34.6805 28.4289 35.0711C28.8195 35.4616 29.4526 35.4616 29.8431 35.0711L36.2071 28.7071ZM20 29L35.5 29V27L20 27V29Z" fill="#D1C9C9" />
      <circle cx="27.5" cy="27.5" r="26.5" stroke="#D1C9C9" strokeWidth="2" />
    </svg>
  </button>

  {/* Swiper */}
  <Swiper
    spaceBetween={30}
    slidesPerView={3}
    loop={true}
    onSwiper={setSwiperInstance}
    modules={[Navigation]}
    className="w-full"
    breakpoints={{
        320:  { slidesPerView: 1 }, // Tablet
        520:  { slidesPerView: 2 }, // Tablet
        991: { slidesPerView: 3 }, // Desktop
      }}
  >
    {spslides.map((slide, index) => (
      <SwiperSlide key={index}>
        {slide.type === 'stacked' ? (
          <div className="swsr_timg">
            {slide.images.map((img, i) => (
              <div className="swsr_img" key={i}><Image
                
                src={img}
                width={500}
                height={300}
                alt={`Slide ${index + 1} - Image ${i + 1}`}
                className="stacked_img"
              /></div>
            ))}
          </div>
        ) : slide.type === 'mixit' ? (
          <div className="swsr_img_whead">
             
              {slide.content && ( 
                  <div className="swsr_content"><h2>Sample Works</h2>{slide.content}</div> 
                 )}
              {slide.images.map((img, i) => ( 
                <div className="swsr_img" key={i}> 
                  <Image src={img} width={500} height={300} alt={`Slide ${index + 1} - Image ${i + 1}`} className="sw_img" /> 
               </div> 
                ))} 
             
          </div>
        ) : (
          <div className="swsr_oimg">
            <div className="swsr_img"><Image
              src={slide.images[0]}
              width={500}
              height={650}
              alt={`Slide ${index + 1}`}
              className="tall_imgs"
            />
          </div>
          </div>
        )}
      </SwiperSlide>
    ))}
  </Swiper>
</div>
</div>
);
}