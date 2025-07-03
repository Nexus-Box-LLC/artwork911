"use client";
import React, { useRef, useState } from 'react';

interface VideoWithPlayButtonProps {
  src: string;
  poster?: string;
  width?: number | string;
  height?: number | string;
  className?: string;
}

const VideoWithPlayButton: React.FC<VideoWithPlayButtonProps> = ({
  src,
  poster,
  width = "100%",
  height = "auto",
  className = "",
}) => {
  const videoRef = useRef<HTMLVideoElement>(null);
  const [isPlaying, setIsPlaying] = useState(false);

  const handlePlay = () => {
    setIsPlaying(true);
    videoRef.current?.play();
  };

  const handlePause = () => {
    setIsPlaying(false);
  };

  return (
    <div
      className={className}
      style={{
        position: 'relative',
        width,
        height,
        maxWidth: 1080,
        margin: '0 auto 35px auto',
      }}
    >
      <video
        ref={videoRef}
        src={src}
        poster={poster}
        width="100%"
        height={height}
        onPause={handlePause}
        onPlay={() => setIsPlaying(true)}
        controls={isPlaying}
        style={{ display: 'block', borderRadius: 16 }}
      >
       
      </video>
      {!isPlaying && (
        <button
          aria-label="Play Video"
          onClick={handlePlay}
          style={{
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            background: '#F5F5F5',
            border: 'none',
            borderRadius: '50%',
            width: 80,
            height: 80,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            cursor: 'pointer',
            zIndex: 2,
          }}
        >
          {/* Play icon SVG */}
          <svg width="40" height="40" viewBox="0 0 40 40" fill="white">
            <circle cx="20" cy="20" r="20" fill="rgba(0,0,0,0)" />
            <polygon points="16,12 30,20 16,28" fill="#6E35A0" />
          </svg>
        </button>
      )}
    </div>
  );
};

export default VideoWithPlayButton;