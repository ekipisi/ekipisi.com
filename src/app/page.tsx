import Image from 'next/image';

export default function Home() {
  return (
    <div className="grid grid-rows-[20px_1fr_20px] items-center justify-items-center min-h-screen p-8 pb-20 gap-16 sm:p-20 font-[family-name:var(--font-geist-sans)]">
      <main className="flex flex-col gap-[32px] row-start-2 items-center">
        <Image
          src="/images/logo.svg"
          alt="Ekipişi Yazılım ve Danışmanlık Hizmetleri"
          width={180}
          height={66}
          priority
        />
        <p className="text-center font-[family-name:var(--font-geist-mono)]">
          Site Yapım Aşamasındadır.
        </p>
      </main>
    </div>
  );
}
