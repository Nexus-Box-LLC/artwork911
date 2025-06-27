"use client";
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination, Autoplay } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import Image from "next/image";
const images = [
  "/home/slider/slider_img1.jpg",
  "/home/slider/slider_img1.jpg",
  "/home/slider/slider_img1.jpg",
];


export default function Slider() {
  return (
    <Swiper
      modules={[Pagination, Autoplay]}
      spaceBetween={30}
      slidesPerView={1}
      pagination={{ clickable: true }}
      autoplay={{ delay: 3000, disableOnInteraction: false }}
      loop={true}
    >
      {images.map((src, idx) => (
        <SwiperSlide key={idx}>
          <img src={src} alt={`Slide ${idx + 1}`} style={{ width: "100%" }} />

        </SwiperSlide>
      ))}
    </Swiper>
  );
};
