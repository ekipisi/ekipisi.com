import { getTranslations } from 'next-intl/server';
import Image from 'next/image';

import { env } from '@/utils/env';

type Params = Promise<{ locale: string }>;

export async function generateMetadata({ params }: { params: Params }) {
  const { locale } = await params;
  const t = await getTranslations({ locale, namespace: 'Home' });

  const baseMetadata = {
    title: t('title'),
    description: t('description'),
  };

  return {
    ...baseMetadata,
    openGraph: {
      ...baseMetadata,
      url: new URL(env.SITE_URL).toString(),
    },
    twitter: {
      ...baseMetadata,
      card: 'summary_large_image',
    },
  };
}

export default async function Home() {
  const t = await getTranslations('Home');

  return (
    <div className="grid grid-rows-[20px_1fr_20px] items-center justify-items-center min-h-screen p-8 pb-20 gap-16 sm:p-20 font-[family-name:var(--font-geist-sans)]">
      <main className="flex flex-col gap-[32px] row-start-2 items-center">
        <Image
          src="/images/logo.svg"
          alt={t('title')}
          width={180}
          height={66}
          priority
        />
        <p className="text-center font-[family-name:var(--font-geist-mono)]">
          {t('underconstruction')}
        </p>
      </main>
    </div>
  );
}
