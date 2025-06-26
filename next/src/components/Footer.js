import Link from 'next/link';
import Image from "next/image";


export default function Header() {
  return (
    <header className="bg-blue-700 text-white p-4 shadow-md">
      <div className="max-w-6xl mx-auto flex justify-between items-center">
        <h1 className="text-xl font-bold">Footer</h1>
        <Image
              className="dark:invert"
              src="/logo.svg"
              alt="Vercel logomark"
              width={20}
              height={20}
            />
        <nav>
          <Link href="/" className="mx-2 hover:underline">Home</Link>
          <Link href="/about" className="mx-2 hover:underline">About</Link>
        </nav>
      </div>
    </header>
  );
}